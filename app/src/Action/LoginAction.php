<?php

namespace App\Action;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Firebase\JWT\JWT;
use Respect\Validation\Validator as v;
use Slim\Exception\NotFoundException;
use App\Model\User;

/**
 *
 */
final class LoginAction
{
    private $logger;
    private $settings;

    function __construct(LoggerInterface $logger, $settings)
    {
        $this->logger = $logger;
        $this->settings = $settings;
    }

    public function dispatch(Request $request, Response $response, $args)
    {
        $input = $request->getParsedBody();
        $this->validate($input);

        // TODO catch exception and send user not found message
        $user = User::where('username', $input['username'])->firstOrFail();

        if (!password_verify($input['password'], $user->password)) {
            return $response->withStatus(401)->write(json_encode([
                'message' => 'Unauthorized'
            ]));
        }

        $data = $this->createData($user);

        $secretKey = base64_decode($this->settings->get('jwt')['key']);
        $algorithm = $this->settings->get('jwt')['algorithm'];

        $jwt = JWT::encode(
            $data,      //Data to be encoded in the JWT
            $secretKey, // The signing key
            $algorithm  // Algorithm used to sign the token
        );

        return $response->write(json_encode([
            'jwt' => $jwt
        ]));
    }

    private function createData($user) {
        $tokenId    = base64_encode(mcrypt_create_iv(32));
        $issuedAt   = time();
        $notBefore  = $issuedAt + 10;  //Adding 10 seconds
        $expire     = $notBefore + 600; // Adding 600 seconds
        $serverName = $this->settings->get('serverName');

        /*
         * Create the token as an array
         */
        $data = [
            'iat'  => $issuedAt,         // Issued at: time when the token was generated
            'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
            'iss'  => $serverName,       // Issuer
            'nbf'  => $notBefore,        // Not before
            'exp'  => $expire,           // Expire
            'data' => [                  // Data related to the signer user
                'userId'   => $user->id, // userid from the users table
                'userName' => $user->username, // User name
            ]
        ];
        return $data;
    }

    private function validate($input) {
        $validator = v::key('username', v::alnum()->notEmpty()->noWhitespace())
            ->key('password', v::stringType()->notEmpty()->length(3, 20));

        $validator->assert($input);
    }
};
