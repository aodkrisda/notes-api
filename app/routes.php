<?php

$app->get('/', function ($req, $res, $args) {
    return $res->withHeader('Content-type', 'application/json')
    ->write(json_encode([
        'greeting' => 'Welcome to this awesome REST API!'
    ]));
});
