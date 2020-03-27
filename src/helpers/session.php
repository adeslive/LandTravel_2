<?php

use Psr\Http\Message\ServerRequestInterface;
use WyriHaximus\React\Http\Middleware\SessionMiddleware;

$session;

function initSession(ServerRequestInterface $request) {
    global $session;
    $session = $request->getAttribute(SessionMiddleware::ATTRIBUTE_NAME);
}

function getSession(){
    global $session;
    return $session;
}