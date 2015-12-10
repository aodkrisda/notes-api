<?php
return [
    'settings' => [

        // monolog settings
        'logger' => [
            'name' => 'notes-api',
            'path' => __DIR__ . '/../log/log-' . date('Y-m-d') . '.log',
        ]
    ]
];
