<?php

use RPF\Core\DB;

$db;

function initDB($loop, $cache = null, bool $lazy = true)
{
    global $db;
    if ($db == null){
        $db = new DB($loop, $cache, $lazy);
    }
}

function db() : DB
{
    global $db;
    return $db;
}