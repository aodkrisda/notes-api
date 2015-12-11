<?php
// DIC configuration

$container = $app->getContainer();

require __DIR__ . '/database/bootstrap.php';

// -----------------------------------------------------------------------------
// Service factories
// -----------------------------------------------------------------------------

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings');
    $logger = new \Monolog\Logger($settings['logger']['name']);
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['logger']['path'], \Monolog\Logger::DEBUG));
    return $logger;
};

// -----------------------------------------------------------------------------
// Action factories
// -----------------------------------------------------------------------------

$container['App\Action\HomeAction'] = function ($c) {
    return new App\Action\HomeAction($c->get('logger'));
};

$container['App\Action\Notes\IndexAction'] = function ($c) {
    return new App\Action\Notes\IndexAction($c->get('logger'));
};
