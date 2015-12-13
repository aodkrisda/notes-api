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
            'driver'    => 'pgsql',
            'host'      => '127.0.0.1',
            'database'  => 'dbname',
            'username'  => 'username',
            'password'  => 'password',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],

        'jwt' => [
            'key' => '', // You may generate the key with base64_encode(openssl_random_pseudo_bytes(64))
            'algorithm' => 'HS512'
        ],

        'serverName' => 'yourdomain.com',

        'timezone' => 'UTC', // UTC – The World's Time Standard
    ]
];
