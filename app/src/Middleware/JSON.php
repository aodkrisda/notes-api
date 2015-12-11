<?php

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class JSON
{
    /**
     * JSON middleware invokable class. It forces Content-Type on the response
     * to be application/json. If the request Content-Type is not json then
     * return the response with status 415 (Unsupported Media Type)
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response, $next)
    {
        $mediaType = $request->getMediaType();
        $method = strtolower($request->getMethod());

        if (in_array($method, ['post', 'put', 'patch'])
            && '' !== (string) $request->getBody()) {
            if (empty($mediaType) || $mediaType !== 'application/json') {
                return $response->withStatus(415);
            }
        }

        $response = $response->withHeader('Content-type', 'application/json');
        $response = $next($request, $response);

        return $response;
    }
}
