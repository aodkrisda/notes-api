<?php

namespace App\Action;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 *
 */
final class HomeAction
{
    private $logger;

    function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function dispatch(Request $request, Response $response, $args)
    {
        $this->logger->info("Home page action dispatched");

        return $response->write(json_encode([
            'greeting' => 'Welcome to this awesome REST API!'
        ]));
    }
};
