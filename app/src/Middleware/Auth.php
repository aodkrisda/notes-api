<?php

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Firebase\JWT\JWT;
use Slim\App;

class Auth
{
    private $app;

    function __construct(App $app) {
        $this->app = $app;
    }

    /**
     * Handle authentication
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response, $next)
    {
        $path = $request->getUri()->getPath();
        if ($path && $path != 'login') {
            $serverParams = $request->getServerParams();
            $authHeader = isset($serverParams['HTTP_X_AUTHORIZATION']) ? $serverParams['HTTP_X_AUTHORIZATION']: null;
            list($jwt) = sscanf($authHeader, 'Bearer %s');

            if (!$jwt) {
                return $response->withStatus(401)->write(json_encode([
                    'message' => '401 Unauthorized'
                ]));
            }

            try {
                $settings = $this->app->getContainer()->get('settings');

                $secretKey = base64_decode($settings->get('jwt')['key']);

                $token = JWT::decode($jwt, $secretKey, [$settings->get('jwt')['algorithm']]);

                // Get the user info and add to the container
                $this->app->getContainer()['currentUser'] = function ($c) use ($token) {
                    return $token->data; // user attributes
                };
            } catch (\Exception $e) {
                return $response->withStatus(401)->write(json_encode([
                    'message' => $e->getMessage()
                ]));
            }
        }

        $response = $next($request, $response);
        return $response;
    }
}
