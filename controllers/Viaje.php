<?php
namespace CONTROLLERS;

use Psr\Http\Message\ServerRequestInterface;
use RPF\Core\Controller;
use RPF\core\SimpleResponse;

final class Viaje extends Controller
{
    public static function index(){
        return components('viajes')->then(function (array $viajes) {
            return view('viajes/viajes', ['viajes' => $viajes]);
        });
    }

    public static function show(ServerRequestInterface $request, string $id){
       
        return components('viajes', "1")
                ->then(function (array $viaje) {

                    if (empty($viaje)) {
                        return redirect('/');
                    }

                    return components('rutas')
                        ->then(function (array $rutas) use ($viaje) {
                            return view('viajes/viaje', ['viaje' => $viaje[0], 'rutas' => $rutas]);
                        });
                });
        
    }

    public static function comprar (ServerRequestInterface $request, string $id) {

        if( $request->getMethod() == 'POST')
        {
            $usuario_id = 1;
            return db()->query('SELECT 1 FROM historial WHERE usuario_id = ? AND viaje_id = ?',[$usuario_id, $id])
                ->then(function(array $valores) use ($usuario_id, $id) {
                    if (!empty($valores)) return SimpleResponse::BAD_REQUEST('El viaje ya se compro')->toJson('message');

                    return db()->query('SELECT * FROM viajes WHERE id = ?', [$id])
                        ->then(function($array) use ($usuario_id, $id) {
                            if (empty($array)) return SimpleResponse::BAD_REQUEST('No existe el tour')->toJson('message');

                            $viaje = $array[0];

                            return db()->query('call final.nuevo_historial(?, ?, ?, ?);', [$usuario_id, $id, $viaje['costo'], 0])
                                ->then(function(){
                                    return SimpleResponse::OK('Hecho!')->toJson('message');
                                });
                        });
                });
        }
        return components('viajes', $id)
            ->then(function (array $viaje) {

                /*if (empty($viaje) || !getSession()->isActive()) {
                    return redirect('/');
                }*/

                return view('viajes/comprar', ['viaje' => $viaje[0]]);
            });
    }

    public static function reservar (ServerRequestInterface $request, string $id) {

        if( $request->getMethod() == 'POST')
        {
            $usuario_id = 1;
            return db()->query('SELECT 1 FROM historial WHERE usuario_id = ? AND viaje_id = ?',[$usuario_id, $id])
                ->then(function(array $valores) use ($usuario_id, $id) {
                    if (!empty($valores)) return SimpleResponse::BAD_REQUEST('El viaje ya se compro')->toJson('message');

                    db()->query('SELECT * FROM viaje WHERE id = ?', [$id])
                        ->then(function($array) use ($usuario_id, $id) {
                            if (empty($array)) return SimpleResponse::BAD_REQUEST('No existe el tour')->toJson('message');

                            $viaje = $array[0];

                            return db()->query('call final.nuevo_historial(?, ?, ?, ?);', [$usuario_id, $id, $viaje['costo']*0.3, $viaje['costo']*0.7])
                                ->then(function(){
                                    return SimpleResponse::OK('Hecho!')->toJson('message');
                                });
                        });
                });
        }
        return components('viajes', $id)
            ->then(function (array $viaje) {
            

                if (empty($viaje) || !getSession()->isActive()) {
                    return redirect('/');
                }

                return view('viajes/reservar', ['viaje' => $viaje[0]]);
            });
    }

    public static function paginaModificar (ServerRequestInterface $request, string $id) {

        return components('viajes', $id)
            ->then(function (array $viaje) {

                if (empty($viaje)) {
                    return redirect('/');
                }

                return components('rutas')
                    ->then(function (array $rutas) use ($viaje) {
                        return view('viajes/modificar', ['viaje' => $viaje[0], 'rutas' => $rutas]);
                    });
            });
    }
}