<?php

use Psr\Http\Message\ServerRequestInterface;
use WyriHaximus\React\Http\Middleware\Session;
use WyriHaximus\React\Http\Middleware\SessionMiddleware;

$session;

function initSession(ServerRequestInterface $request) {
    global $session;
    $session = $request->getAttribute(SessionMiddleware::ATTRIBUTE_NAME);
}

function getSession() : Session {
    global $session;
    return $session;
}