<?php

namespace CONTROLLERS;

use Exception;
use RPF\Core\Controller;
use Psr\Http\Message\ServerRequestInterface;
use RPF\core\SimpleResponse;

final class Guia extends Controller
{
    public static function tours(ServerRequestInterface $request)
    {
        return view('guias/tours');
    }

    public static function feed(ServerRequestInterface $request)
    {
        $get = $request->getQueryParams();
        return db()->query('SELECT CONCAT("/tours/", id) as url,nombre as title, fecha_inicio as start, fecha_salida as end FROM tour WHERE habilitado = 1;')
            ->then(function($fechas){
     
                return SimpleResponse::OK($fechas)->toJson();
            });
    }

    public static function contrato(ServerRequestInterface $request, string $id)
    {
        return view('guias/tours');
    }
}
