<?php
namespace CONTROLLERS;

use Psr\Http\Message\ServerRequestInterface;
use RPF\Core\Controller;
use RPF\core\SimpleResponse;

final class Pais extends Controller
{

    public static function getDestinos(ServerRequestInterface $request, $id)
    {
        return db()->query('SELECT * FROM destino WHERE pais_id = ?', [$id])
            ->then(function(){
                $destinos = db()->getResult();
                return SimpleResponse::OK(['destinos' => $destinos])->toJson();
            });
    }

    public static function getHoteles(ServerRequestInterface $request, $id)
    {
        return db()->query('SELECT * FROM hoteles WHERE pais_id = ?', [$id])
            ->then(function(){
                $hoteles = db()->getResult();
                return SimpleResponse::OK(['hoteles' => $hoteles])->toJson();
            });
    }

    public static function getTransportes(ServerRequestInterface $request, $id)
    {
        return db()->query('SELECT * FROM transportes WHERE pais_id = ?', [$id])
            ->then(function(){
                $transportes = db()->getResult();
                return SimpleResponse::OK(['transportes' => $transportes])->toJson();
            });
    }

    public static function getTours(ServerRequestInterface $request, $id)
    {
        return db()->query('SELECT * FROM tours WHERE pais_id = ?', [$id])
            ->then(function(){
                $tours = db()->getResult();
                return SimpleResponse::OK(['tours' => $tours])->toJson();
            });
    }

    public static function getLugares(ServerRequestInterface $request, $id)
    {
        return db()->query('SELECT * FROM lugares WHERE pais_id = ?', [$id])
            ->then(function(){
                $tours = db()->getResult();
                return SimpleResponse::OK(['lugares' => $tours])->toJson();
            });
    }
}