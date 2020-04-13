<?php

namespace CONTROLLERS;

use RPF\Core\PDF;
use Psr\Http\Message\ServerRequestInterface;

final class Index 
{
    public static function index(ServerRequestInterface $request)
    {
        return view('index');
    }
}