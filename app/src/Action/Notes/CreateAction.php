<?php

namespace App\Action\Notes;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Validator as v;
use Slim\Container;
use App\Model\Note;

/**
 * Add a new note for the current user
 */
final class CreateAction
{
    private $container;

    function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function dispatch(Request $request, Response $response, $args)
    {
        $user = $this->container->get('currentUser');

        $input = $request->getParsedBody();

        $validator = v::key('body', v::stringType()->notEmpty()->length(5, null, true));

        $validator->assert($input);

        $note = Note::create([
            'body' => $input['body'],
            'user_id' => $user->userId
        ]);

        return $response->write(json_encode([
            'message' => 'A new note has been added successfully',
            'data' => [$note]
        ]));
    }
};
