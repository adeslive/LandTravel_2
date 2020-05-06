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


$port = 80;
$port2 = 8080;

if (PHP_SAPI === 'cli') {
    if (!empty($argv[1])) {
        $port = $argv[1];
    }

    if (!empty($argv[2])) {
        $port2 = $argv[2];
    }
}

$loop = Factory::create();
$cache = new ArrayCache();

$api = new Server([
    new ErrorHandler(),
    new Router(ROUTER::API)
]);

$web = new Server([
    new ResourceHandler(__DIR__ . DIRECTORY_SEPARATOR . 'resources'),
    new SessionMiddleware('REACTPHP_SESSION',$cache,[0 ,'/','',false,true]),
    new Initiator($loop),
    new Router(ROUTER::WEB)
]);

//$ftp = new Server([new Router(Router::FTP)]);


$api->listen(new SocketServer($port2, $loop));
$web->listen(new SocketServer($port, $loop));
//$ftp->listen(new SocketServer(21, $loop))
$loop->run();
