<?php
namespace config\Routes;

use RPF\core\Route;

$api;
$web;
$ftp;

function api() : Route {
    global $api;
    if ($api == null){
        $api = new Route();
    }
    return $api;
}

function web() : Route {
    global $web;
    if ($web == null){
        $web = new Route();
    }
    return $web;
}

function ftp() : Route {
    global $ftp;
    if ($ftp == null){
        $ftp = new Route();
    }
    return $ftp;
}
