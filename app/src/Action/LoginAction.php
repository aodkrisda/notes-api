<?php

namespace App\Action;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Validator as v;
use App\Model\Note;

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
        $this->validate($request->getParsedBody());

        return $response;
    }

    private function validate($input) {
        $validator = v::key('username', v::alnum()->notEmpty()->noWhitespace())
            ->key('password', v::stringType()->notEmpty()->length(3, 20));

        $validator->assert($input);
    }
};
