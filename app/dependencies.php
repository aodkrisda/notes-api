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

    // https://github.com/Seldaek/monolog/blob/master/doc/01-usage.md#customizing-the-log-format
    // allow breaking lines
    $formatter = new \Monolog\Formatter\LineFormatter(null, null, true);
    $stream = new \Monolog\Handler\StreamHandler($settings['logger']['path'], \Monolog\Logger::DEBUG);
    $stream->setFormatter($formatter);

    $logger = new \Monolog\Logger($settings['logger']['name']);
    $logger->pushHandler($stream);

    return $logger;
};


// -----------------------------------------------------------------------------
// Error Handlers
// -----------------------------------------------------------------------------

unset($container['errorHandler']);
unset($container['notFoundHandler']);

$container['errorHandler'] = function ($c) {
    $displayErrorDetails = $c->get('settings')['displayErrorDetails'];
    return new App\Handlers\Error($displayErrorDetails, $c->get('logger'));
};

$container['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $c['response']
            ->withStatus(404)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode(['message' => 'Page not found']));
    };
};


// -----------------------------------------------------------------------------
// Action factories
// -----------------------------------------------------------------------------

$container['App\Action\HomeAction'] = function ($c) {
    return new App\Action\HomeAction($c->get('logger'));
};

$container['Notes\IndexAction'] = function ($c) {
    return new App\Action\Notes\IndexAction($c);
};
$container['Notes\SaveAction'] = function ($c) {
    return new App\Action\Notes\SaveAction($c);
};
$container['Notes\DeleteAction'] = function ($c) {
    return new App\Action\Notes\DeleteAction($c);
};

$container['App\Action\LoginAction'] = function ($c) {
    return new App\Action\LoginAction($c->get('logger'), $c->get('settings'));
};
