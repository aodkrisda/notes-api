<?php

namespace App\Action\Notes;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Container;
use App\Model\Note;

/**
 * Delete a single note given its id or all notes (very dangerous)
 */
final class DeleteAction
{
    private $container;

    function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Delete a single note if specified its id or delete all if no id is
     * passed in the request
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function dispatch(Request $request, Response $response, $args)
    {
        $user = $this->container->get('currentUser');

        $id = isset($args['id']) ? (int)$args['id']: null;

        if ($id) {
            Note::destroy($id);
        } else {
            Note::where('user_id', $user->userId)->delete();
        }

        $response = $response->withStatus(204);
        return $response;
    }
};
