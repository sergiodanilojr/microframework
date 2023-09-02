<?php

namespace Core\Database;

use Core\Database\Crud\Read;

class QueryBuilder
{
    private string $class;

    private array $query = [];

    private array $columns = ['*'];

    public function __construct(
        private string $table
    )
    {
    }

    public static function table(string $table)
    {
        return new self($table);
    }

    public function when(bool $condition, callable $callback): self
    {
        if ($condition) {
            call_user_func($callback, $this);
        }

        return $this;
    }

    public function fetchClass(string $class)
    {
        $this->class = $class;
        return $this;
    }

    public function dd(): void
    {
        dd($this->arrange());
    }

    public function select(array $columns = ['*'])
    {
        $this->columns = $columns;
        return $this;
    }

    public function query()
    {
        return new Read();
    }


    public function first()
    {
        $columns = implode(",", $this->columns);

        $read = $this->query()->raw("SELECT {$columns} FROM {$this->table}")
            ->limit(1)
            ->offset(0);

        $this->when(!empty($this->params), function () use (&$read) {
            $read->params($this->params);
        });

        return $read->first();
    }

    public function find($id, ?string $key = 'id')
    {
        $key = $key ?? 'id';

        $columns = implode(",", $this->columns);

        $this->params[":$key"] = $id;

        $read = $this->query()->raw("SELECT {$columns} FROM {$this->table} WHERE {$this->table}.`{$key}` = :{$key}")
            ->limit(1)
            ->offset(0);

        $this->when(!empty($this->params), function () use (&$read) {
            $read->params($this->params);
        });

        return $read->first();
    }

    public function all()
    {

    }


    private function arrange(): string
    {
        $this->prepare();

        return trim(preg_replace(
                "/\s+/",
                " ",
                implode(' ', $this->query))
        );
    }

}