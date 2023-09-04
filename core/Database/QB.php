<?php

namespace Core\Database;

use ElePHPant\LightQueryBuilder;

class QB extends LightQueryBuilder
{
    public function __construct(string $table)
    {
        $dsn = self::dsn();
        $config = self::configs();

        parent::__construct([
            'dsn' => $dsn,
            'user' => $config['username'],
            'password' => $config['password'],
            'options' => $config['options']
        ]);

        $this->setTable($table);
    }

    private static function dsn(): string
    {
        $configs = self::configs();

        $query = http_build_query([
            'host' => $configs['host'],
            'dbname' => $configs['database'],
            'charset' => $configs['charset'],
            'port' => $configs['port'],
        ], arg_separator: ';');

        if ($configs['driver'] == 'sqlite') {
            $query = http_build_query(['host' => $configs['host']]);
        }

        return $configs['driver'] . ":" . $query;
    }

    private static function configs()
    {
        $connection = config('database.connection');
        return config("database.connections.$connection");
    }
}