<?php

$connection = config('database.default');
$driver = config("database.connections.$connection.driver", env('DB_CONNECTION', 'mysql'));
$host = config("database.connections.$connection.host", env('DB_HOST', '127.0.0.1'));
$port = config("database.connections.$connection.port", env('DB_PORT', '3306'));
$database = config("database.connections.$connection.database", env('DB_DATABASE', 'pluma'));
$username = config("database.connections.$connection.username", env('DB_USERNAME', 'pluma'));
$password = config("database.connections.$connection.password", env('DB_PASSWORD', 'pluma'));
$charset = config("database.connections.$connection.charset", env('DB_CHARSET', 'utf8'));

return [
    'paths' => [
        'seeds' => [__DIR__.'/../../database/seeds'],
        'migrations' => [__DIR__.'/../../database/migrations'],
    ],
    'migration_base_class' => '\Pluma\Support\Migration\Migration',
    'templates' => [
        'file' => dirname(__DIR__).'/../templates/migrations/updown-migration.stub'
    ],
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_database' => 'production',

        'production' => [
            'adapter' => $driver,
            'host' => $host,
            'name' => $database,
            'user' => $username,
            'pass' => $password,
            'port' => $port,
            'charset' => $charset,
        ],

        'local' => [
            'adapter' => $driver,
            'host' => $host,
            'name' => $database,
            'user' => $username,
            'pass' => $password,
            'port' => $port,
            'charset' => $charset,
        ],
    ],
];

