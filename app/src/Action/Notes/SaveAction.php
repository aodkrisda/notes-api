<?php

namespace App\Action\Notes;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Validator as v;
use Slim\Container;
use App\Model\Note;

/**
 * Add a new note for the current user, or update a note if given its id
 */
final class SaveAction
{
    private $container;

    function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Handle notes validation, creation and update
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function dispatch(Request $request, Response $response, $args)
    {
        $id = isset($args['id']) ? (int)$args['id']: null;

        $input = $request->getParsedBody();

        $validator = v::key('body', v::stringType()->notEmpty()->length(5, null, true));

        $validator->assert($input);

        if ($id === null) {
            $note = $this->create($input);
        } else {
            $note = $this->update($input, $id);
        }

        return $response->write(json_encode([$note]));
    }

    /**
     * Add a new note to the current user
     *
     * @param array request input
     *
     * @return App\Model\Note
     */
    public function create($input) {
        $user = $this->container->get('currentUser');

        return Note::create([
            'body' => $input['body'],
            'user_id' => $user->userId
        ]);
    }

    /**
     * Update a specific note. Besides notes id, the user_id has to match, if it
     * doesn't, throw not found exception
     *
     * @param array request input
     * @param int   note's id
     *
     * @return App\Model\Note
     */
    public function update($input, $id) {
        $user = $this->container->get('currentUser');

        $note = Note::where('id', $id)->where('user_id', $user->userId)->firstOrFail();

        $note->body = $input['body'];
        $note->save();

        return $note;
    }
};
