<?php

namespace RPF\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Response;
use RuntimeException;

final class ErrorHandler {

    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        try{
            return $next($request);
        }catch(RuntimeException $e){
            return new Response(200, ['Content-Type: text/plain'], $e->getMessage());
        }
    }
}