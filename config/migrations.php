<?php

$defaultMigrationsPaths = ['database/migrations', 'resources/migrations'];

return [
    'paths' => [
        'migrations' => $defaultMigrationsPaths,
    ],
    'migration_base_class' => '\Pluma\Support\Migration\Migration',
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_database' => 'production',

        'production' => [
            'adapter' => env('DB_CONNECTION'),
            'host' => env('DB_HOST'),
            'name' => env('DB_NAME'),
            'user' => env('DB_USER'),
            'pass' => env('DB_PASSWORD'),
            'port' => env('DB_PORT'),
        ],

        'local' => [
            'adapter' => env('DB_CONNECTION'),
            'host' => env('DB_HOST'),
            'name' => env('DB_NAME'),
            'user' => env('DB_USER'),
            'pass' => env('DB_PASSWORD'),
            'port' => env('DB_PORT'),
        ],
    ],
];
