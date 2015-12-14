<?php

namespace App\Action\Notes;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Model\User;
use Slim\Container;

/**
 * Return a list of notes of a user
 */
final class IndexAction
{
    private $container;

    function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function dispatch(Request $request, Response $response, $args)
    {
        $user = $this->container->get('currentUser');
        return $response->write(json_encode([
            'message' => 'List of Notes',
            'data' => User::findOrFail($user->userId)->notes
        ]));
    }
};
