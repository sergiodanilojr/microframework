<?php
return [
    'connection' => env('DB_CONNECTION', 'mysql'),

    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', 3306),
            'database' => env('DB_NAME'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'charset' => 'utf8mb4',
            'options' => [
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
                \PDO::ATTR_CASE => \PDO::CASE_NATURAL
            ]
        ],

        'postgres' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', 3306),
            'database' => env('DB_NAME'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'charset' => 'utf8mb4',
        ],

        'sqlite' => [
            'driver' => 'sqlite',
            'host' => env('DB_HOST'),
            'options' => [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
                \PDO::ATTR_CASE => \PDO::CASE_NATURAL
            ],
        ],

    ],

    'migrations' => [
        'path' => __DIR__ . '/../database/migrations/',
        'namespace' => 'Database\Migrations',
        'table' => 'migrations',
    ],

];