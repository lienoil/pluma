<?php
// Reinitialize another instance of app.
(new Dotenv\Dotenv(__DIR__.'/../'))->load();

return [
    'paths' => [
        'migrations' => ['database/migrations'],
    ],
    'migration_base_class' => '\Pluma\Support\Migration\Migration',
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_database' => 'production',

        'production' => [
            'adapter' => env('DB_CONNECTION'),
            'host' => env('DB_HOST'),
            'name' => env('DB_DATABASE'),
            'user' => env('DB_USERNAME', 'root'),
            'pass' => env('DB_PASSWORD', 'root'),
            'port' => env('DB_PORT'),
        ],

        'local' => [
            'adapter' => env('DB_CONNECTION'),
            'host' => env('DB_HOST'),
            'name' => env('DB_DATABASE'),
            'user' => env('DB_USERNAME'),
            'pass' => env('DB_PASSWORD'),
            'port' => env('DB_PORT'),
        ],
    ],
];
