<?php

namespace RPF\Middleware;

use Exception;
use Psr\Http\Message\ServerRequestInterface;
use ReflectionMethod;

final class Activator
{
    private $to_activate;
    
    public function __construct(string $to_activate) {
        $this->to_activate = $to_activate;
    }

    public function __invoke(ServerRequestInterface $request, ... $params) {
        $func = findController($this->to_activate);
        
        if (is_callable($func)){
            if (count($params) > 0) return call_user_func($func, $request, $params[0]);
            return call_user_func($func, $request);
        }else{
            return call_user_func("\CONTROLLERS" . "\\Mock::handle", $request);
        }
    }
}