<?php

return [
    'ftp' => [
        'driver' => env('FTP_DRIVER', 'ftp'),
        'host' => env('FTP_HOST', 'ftp.example.com'),
        'username' => env('FTP_USERNAME', 'your-username'),
        'password' => env('FTP_PASSWORD', 'your-password'),

        // Optional FTP Settings...
        // 'port'     => 21,
        // 'root'     => '',
        // 'passive'  => true,
        // 'ssl'      => true,
        // 'timeout'  => 30,
    ],
];
