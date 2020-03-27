<?php

namespace RPF\core;

use FastRoute\DataGenerator\GroupCountBased;
use FastRoute\RouteCollector;
use FastRoute\RouteParser\Std;

final class Route 
{
    private $routes;

    public function __construct()
    {
        $this->routes = new RouteCollector(new Std(), new GroupCountBased);
    }

    public function getRoutes() : RouteCollector {
        return $this->routes;
    }

    /**
     * @param array|string $methods
     * @param string $route
     * @param callable|string $controller
     */

    public function addRoute($methods, string $route, $controller){
        $this->routes->addRoute($methods, $route, $controller);
    }

    public function addGroup(string $prefix, callable $callback){
        $this->routes->addGroup($prefix, $callback);
    }
}
