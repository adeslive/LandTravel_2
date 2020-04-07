<?php

namespace RPF\Middleware;

use Exception;
use Psr\Http\Message\ServerRequestInterface;

final class Protect
{
    private $access;
    private $to_protect;

    public function __construct(string $to_protect, array $access)
    {
        $this->to_protect = $to_protect;
        $this->access = $access;
    }

    public function __invoke(ServerRequestInterface $request, ... $params)
    {
        if ($this->check()){
            return (new Activator($this->to_protect))($request, $params[0]);
        }
        return redirect('/');
    }

    public function check()
    {
        if (getSession()->isActive() && !empty(getSession()->getContents())) {
            if(in_array(getSession()->getContents()['tipo_usuario'], $this->access)) return true;
        }
        return false;
    }
}