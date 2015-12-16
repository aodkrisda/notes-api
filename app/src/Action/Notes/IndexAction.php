<?php

namespace App\Action\Notes;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Model\User;
use App\Model\Note;
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
        $id = isset($args['id']) ? (int)$args['id']: null;
        $notes = [];

        if ($id) {
            $note = Note::where('id', $id)->where('user_id', $user->userId)->firstOrFail();
            $notes = [$note];
        } else {
            $notes = User::findOrFail($user->userId)->notes;
        }

        return $response->write(json_encode([
            'message' => 'List of Notes',
            'data' => $notes
        ]));
    }
};
