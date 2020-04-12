<?php
namespace CONTROLLERS;

use Psr\Http\Message\ServerRequestInterface;
use RPF\Core\Controller;

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

    public static function paginaComprar (ServerRequestInterface $request, string $id) {

        return components('viajes', $id)
            ->then(function (array $viaje) {

                if (empty($viaje) || !getSession()->isActive()) {
                    return redirect('/');
                }

                return view('viajes/comprar', ['viaje' => $viaje[0]]);
            });
    }

    public static function paginaReservar (ServerRequestInterface $request, string $id) {

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