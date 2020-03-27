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


$port = 80;

if (PHP_SAPI === 'cli') {
    if (!empty($argv[1])) {
         $port = $argv[1];
    }
}
    
print $port;


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

    
        //$api->listen(new SocketServer(8080, $loop)),
        $web->listen(new SocketServer("0.0.0.0:$port", $loop));
        //$ftp->listen(new SocketServer(21, $loop))
    

    $loop->run();
