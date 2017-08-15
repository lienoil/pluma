<?php
// Reinitialize another instance of app.

try {
    include_once __DIR__.'/../core/helpers/helpers.php';
    include_once __DIR__.'/../core/helpers/functions.php';
    (new Dotenv\Dotenv(__DIR__.'/../'))->load();

    // $modules = get_modules_path();
    // foreach ($modules as $module) {
    //     $files = glob("$module/database/migrations/*.php");
    //     foreach ($files as $file) {
    //         $to = str_replace("$module/database/migrations/", "database/migrations/", $file);
    //         copy($file, base_path($to));
    //     }
    // }
} catch (Exception $e) {
    // dd($e->getMessage());
}

return [
    'paths' => [
        'seeds' => [__DIR__.'/database/seeds'],
        'migrations' => [__DIR__.'/database/migrations'],
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
