<?php

require __DIR__ . '/../vendor/autoload.php';

// Instantiate the app
$settings = require __DIR__ . '/../app/settings.php';
$app = new \Slim\App($settings);

$app->get('/', function ($req, $res, $args) {
    return $res->withHeader('Content-type', 'application/json')
    ->write(json_encode([
        'greeting' => 'Welcome to this awesome REST API!'
    ]));
});

// Run!
$app->run();
