<?php

use RPF\Middleware\Activator;
use RPF\Middleware\Protect;

function findController(string $name, bool $in_parts = false)
{
    assert($name != '');
    $path = explode("/", $name);
    if (!$in_parts){
        if (sizeof($path) == 1) {
            return "\CONTROLLERS". "\\$path[0]::default";
        }
        return "\CONTROLLERS". "\\$path[0]::$path[1]";
    }
    $final = array('\CONTROLLERS\\');
    foreach($path as $part){
        array_push($final, $part);
    }
    return ;
}

function controller(string $name, array $access = null){
    if ($access != null) {
        return new Protect($name, $access);
    }
    return new Activator($name);
}

