<?php

namespace RPF\Middleware;

use React\EventLoop\LoopInterface;
use Psr\Http\Message\ServerRequestInterface;

final class Initiator{
    private $loop;

    public function __construct(LoopInterface $loop)
    {
        $this->loop = $loop;
    }

    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        initDB($this->loop);
        initSession($request);
        initResponse();
        return $next($request);
    }
}