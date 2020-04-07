<?php

require 'vendor/autoload.php';

use RPF\core\Router;
use React\Http\Server;
use React\Cache\ArrayCache;
use React\EventLoop\Factory;
use React\Http\Response;
use RPF\Middleware\Initiator;
use RPF\Middleware\ErrorHandler;
use RPF\Middleware\ResourceHandler;
use React\Socket\Server as SocketServer;
use WyriHaximus\React\Http\Middleware\SessionMiddleware;


$port = 80;

if (PHP_SAPI === 'cli') {
    if (!empty($argv[1])) {
        $port = $argv[1];
    }
}

$loop = Factory::create();
$cache = new ArrayCache();

$api = new Server([
    new ErrorHandler(),
    new Router()
]);

$web = new Server([
    new ResourceHandler(__DIR__ . DIRECTORY_SEPARATOR . 'resources'),
    new SessionMiddleware('REACTPHP_SESSION',$cache,[600 ,'','',false,false]),
    new Initiator($loop),
    new Router(ROUTER::WEB)
]);

$ftp = new Server([new Router(Router::FTP)]);


//$api->listen(new SocketServer(8080, $loop)),
$web->listen(new SocketServer($port, $loop));
//$ftp->listen(new SocketServer(21, $loop))
$loop->run();
