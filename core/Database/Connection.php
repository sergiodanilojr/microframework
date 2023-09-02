<?php

namespace Core\Database;

use Core\Database\Exceptions\DatabaseConnectionException;

class Connection
{

    private static ?\PDO $instance = null;

    private function __construct()
    {

    }

    private function __clone()
    {

    }

    public static function instance(): \PDO
    {
        if (!self::$instance) {
            self::$instance = self::connection();
        }

        return self::$instance;
    }

    private static function connection(): \PDO
    {
        $connection = config('database.connection');

        $configs = config("database.connections.{$connection}");

        $dsn = self::dsn($configs);

        try {
            return new \PDO(
                $dsn,
                $configs['username'],
                $configs['password'],
                empty($configs['options']) ? null : $configs['options']
            );

        } catch (\PDOException $exception) {
            throw new DatabaseConnectionException();
        }
    }

    private static function dsn(array $configs): string
    {
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
}