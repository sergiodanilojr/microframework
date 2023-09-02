<?php

namespace Core\Database\Crud;

use Core\Database\Connection;

class Read
{
    private ?\PDOStatement $statement;

    private ?string $class;

    private string $query;
    private string $order;
    private string $direction = 'asc';
    private int $limit;
    private int $offset;
    private array $params = [];

    public function raw(string $query)
    {
        $this->query = $query;
        return $this;
    }

    public function params(array $params)
    {
        $this->params = array_merge($this->params, $params);
        return $this;
    }

    public function order(string $column, ?string $direction = 'asc')
    {
        $this->order = $column;
        $this->direction = mb_strtolower($direction ?? 'asc');

        return $this;
    }

    public function limit(int $limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset(int $offset)
    {
        $this->offset = $offset;
        return $this;
    }

    public function first()
    {
        $statement = $this->fetch();

        if (!$statement->rowCount()) {
            return null;
        }

        return $this->statement->fetchObject($this->class ?? \stdClass::class);
    }

    public function all()
    {
        $statement = $this->fetch();

        if (!$statement->rowCount()) {
            return [];
        }

        return $statement->fetchAll(\PDO::FETCH_CLASS, $this->class ?? \stdClass::class);
    }

    private function fetch()
    {
        try {
            $this->statement = Connection::instance()->prepare(
                $this->query . " ORDER BY " . $this->order . " LIMIT " . $this->limit . " OFFSET " . $this->offset
            );

            $this->statement->execute($this->params);

            return $this->statement;

        } catch (\PDOException) {
            return null;
        }
    }

//    private function filter(array $data)
//    {
//        return array_filter($data, fn($value) => filter_var($value));
//    }
}