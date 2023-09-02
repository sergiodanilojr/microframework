<?php

return [
    'path' => __DIR__ . '/../app/Console/Commands',
    'default_namespace' => 'App\Console\Commands',
    'commands' => [
        \Core\Console\MakeCommand::class,
    ],
];