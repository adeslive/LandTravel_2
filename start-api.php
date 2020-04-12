<?php

require __DIR__. '/vendor/autoload.php';

use RPF\core\Router;
use React\Http\Server;
use React\Cache\ArrayCache;
use React\EventLoop\Factory;
use RPF\Middleware\Initiator;
use RPF\Middleware\ErrorHandler;
use RPF\Middleware\ResourceHandler;
use React\Socket\Server as SocketServer;
use WyriHaximus\React\Http\Middleware\SessionMiddleware;


$port2 = 8080;

if (PHP_SAPI === 'cli') {
    if (!empty($argv[1])) {
        $port2 = $argv[1];
    }
}

$loop = Factory::create();
$cache = new ArrayCache();

$api = new Server([
    new ErrorHandler(),
    new Router(ROUTER::API)
]);

$api->listen(new SocketServer($port2, $loop));
//$ftp->listen(new SocketServer(21, $loop))

$loop->run();
