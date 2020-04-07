<?php

namespace CONTROLLERS;

use Psr\Http\Message\ServerRequestInterface;

final class Index 
{
    public static function index(ServerRequestInterface $request)
    {
        return view('index');
    }
}