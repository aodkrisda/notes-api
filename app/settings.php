<?php
return [
    'settings' => [

        'displayErrorDetails' => true,

        // monolog settings
        'logger' => [
            'name' => 'notes-api',
            'path' => __DIR__ . '/../log/log-' . date('Y-m-d') . '.log',
        ],

        'db' => [
            'driver'    => getenv('DB_DRIVER'),
            'host'      => getenv('DB_HOST'),
            'database'  => getenv('DB_NAME'),
            'username'  => getenv('DB_USER'),
            'password'  => getenv('DB_PASS'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],

        // UTC – The World's Time Standard
        'timezone' => 'UTC',
    ]
];
