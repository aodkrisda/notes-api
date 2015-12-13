<?php

namespace App\Action;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 *
 */
final class LoginAction
{
    private $logger;

    function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function dispatch(Request $request, Response $response, $args)
    {
        // $this->logger->info("User has logged in");
        return $response;
    }
};
