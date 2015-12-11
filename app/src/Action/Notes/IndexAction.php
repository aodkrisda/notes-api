<?php

namespace App\Action\Notes;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Model\Note;

/**
 * Return a list of notes of a user
 */
final class IndexAction
{
    private $logger;

    function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function dispatch(Request $request, Response $response, $args)
    {
        return $response->write(json_encode([
            'message' => 'List of Notes',
            'data' => Note::all()
        ]));
    }
};
