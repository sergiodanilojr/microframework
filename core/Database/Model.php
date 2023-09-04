<?php

namespace Core\Database;

abstract class Model
{
    protected array $attributes = [];

    protected $table;

    private $qb;

    public function __construct($attributes = [])
    {
        $this->attributes = array_merge($attributes);
        $this->qb = (new QB($this->table))->setFetchClass(self::class);
    }

    public function __set(string $name, $value): void
    {
        if (!property_exists($this, $name)) {
            $this->attributes[$name] = $value;
        }
    }

    public function __get(string $name)
    {
        if (property_exists($this, $name)) {
            return $this->{$name};
        }

        return $this->attributes[$name] ?? null;
    }

    public function query()
    {
        return $this->query();
    }

    public function first(array $columns = ['*'])
    {
        return $this->query()->select(implode(',', $columns))->get();
    }

    public function all(array $columns = ["*"])
    {
        return $this->query()->select(implode(',', $columns))->get(true);
    }

    public function find($id, array $columns = ["*"])
    {
        return $this->query()
            ->select(implode(',', $columns))
            ->where("id=:id", "id=$id")
            ->get(true);
    }

    public function findOr($id, callable $callback, array $columns = ["*"])
    {
        $find = $this->query()
            ->select(implode(',', $columns))
            ->where("id=:id", "id=$id")
            ->get(true);

        if (!$find) {
            return $callback();
        }
    }

    public function create(array $data): self
    {
        $this->attributes = $data;
        $id = $this->query()->create($this->attributes);
        $this->attributes['id'] = $id;

        return $this;
    }

    public function update(array $data)
    {
        $data = array_merge($this->attributes, $data);
        $this->query()->update($data, "id=:id", "id={$this->attributes['id']}");
    }

    public function fill(array $fields)
    {
        $this->attributes = $fields;
        return $this;
    }

    public function save()
    {
        if (array_key_exists('id', $this->attributes) && !empty($this->attributes['id'])) {
            $this->update($this->attributes);
            return $this;
        }

        // criar
        return $this->create($this->attributes);
    }

}