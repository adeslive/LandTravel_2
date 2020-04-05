<?php

namespace RPF\Middleware;

use Exception;
use React\Http\Response;
use Psr\Http\Message\ServerRequestInterface;

final class ErrorHandler {

    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        return $next($request)
            ->then(function(Response $response){
                return $response;
            })
            ->otherwise(
                function (Exception $e) {
                    return new Response(500, ['Content-type' => 'text/plain'], $e->getMessage());
                }
            );
    }
}