<?php

use function Config\Routes\web;
use Psr\Http\Message\ServerRequestInterface;

web()->addGroup('/',function(){
    web()->addRoute('GET', '', function(ServerRequestInterface $request){
        getSession()->begin();

        return view('test');
    });
});