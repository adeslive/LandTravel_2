<?php

require 'vendor/autoload.php';

use RPF\core\Router;
use React\Http\Server;
use React\Http\Response;
use React\Cache\ArrayCache;
use React\EventLoop\Factory;
use Recoil\React\ReactKernel;
use RPF\Middleware\ErrorHandler;
use RPF\Middleware\ResourceHandler;
use React\Socket\Server as SocketServer;
use Psr\Http\Message\ServerRequestInterface;
use WyriHaximus\React\Http\Middleware\SessionMiddleware;

ReactKernel::start(function () {

    $loop = Factory::create();
    $cache = new ArrayCache();

    $api = new Server([
        new ErrorHandler(),
        new Router()
    ]);

    $web = new Server([/** Other Middleware */
        new SessionMiddleware(
            'REACTPHP_SESSION',
            $cache, // Instance implementing React\Cache\CacheInterface
        ),
        /** Other Middleware */
        new Router(ROUTER::WEB)]);

    $ftp = new Server([new Router(Router::FTP)]);

    yield [
        $api->listen(new SocketServer(8080, $loop)),
        $web->listen(new SocketServer(80, $loop)),
        $ftp->listen(new SocketServer(21, $loop))
    ];

    $loop->run();
});
