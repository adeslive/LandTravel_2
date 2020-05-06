<?php
namespace CONTROLLERS;

use Psr\Http\Message\ServerRequestInterface;
use RPF\core\SimpleResponse;

final class RutaViaje
{
    public static function get_ruta(ServerRequestInterface $request, $ruta_id){
        
        return db()->query('SELECT * FROM rutas WHERE rutas.ruta_id = ?', [$ruta_id])
            ->then(function(){
                return SimpleResponse::OK('Hecho')->toJson('message');
            });
    }

    public static function nueva_ruta(ServerRequestInterface $request, $viaje_id){
        $datos = $request->getParsedBody();
        $datos['hora_salida'] .= ":00";
      
        return db()->query('call final.nueva_ruta_viaje(?, ?, ?, ?, ?, ?, ?, ?, ?)', 
        [
            $viaje_id, 
            $datos['transporte'],
            $datos['hotel'],
            $datos['tour'],
            $datos['inicio'],
            $datos['destino'],
            $datos['hora_salida'],
            $datos['horas_viaje'],
            $datos['minutos_viaje']
        ])
            ->then(function(){
                return SimpleResponse::OK('Hecho')->toJson('message');
            });
    }

    public static function borrar_ruta(ServerRequestInterface $request, $ruta_id){
        
        return db()->query('DELETE FROM ruta WHERE ruta.id = ?', [$ruta_id])
            ->then(function(){
                return SimpleResponse::OK('Hecho')->toJson('message');
            });
    }
}