<?php

namespace RPF\core;

use React\Http\Response;
use FastRoute\Dispatcher;

use function Config\routes\api;
use function Config\routes\web;
use function Config\routes\ftp;

use FastRoute\Dispatcher\GroupCountBased;
use Psr\Http\Message\ServerRequestInterface;

final class Router
{
    private $dispatcher;
    const API = 0;
    const WEB = 1;
    const FTP = 2;

    const types = [
        0 => 'api', 
        1 => 'web', 
        2 => 'ftp', 
    ];

    public function __construct(int $type = Router::API)
    {
        $this->type = $type;
        
        switch($type) {
            case 0:
                $this->dispatcher = new GroupCountBased(api()->getRoutes()->getData());
            break;
            case 1:
                $this->dispatcher = new GroupCountBased(web()->getRoutes()->getData());
            break;
            case 2:
                $this->dispatcher = new GroupCountBased(ftp()->getRoutes()->getData());      
        }
    }

    public function __invoke(ServerRequestInterface $request)
    {
        
        $info = $this->dispatcher->dispatch(
            $request->getMethod(),
            $request->getUri()->getPath()
        );

        switch ($info[0]) {
            case Dispatcher::NOT_FOUND:
                return new Response(404);
            case Dispatcher::METHOD_NOT_ALLOWED:
                return new Response(403);
            case Dispatcher::FOUND:
                initResponse();
                initSession($request);
                $params = array_values($info[2]);
                return $info[1]($request, ...$params);
        }
    }
}