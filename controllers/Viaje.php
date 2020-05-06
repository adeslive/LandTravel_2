<?php
namespace CONTROLLERS;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Response;
use RPF\Core\Controller;
use RPF\core\SimpleResponse;

final class Viaje extends Controller
{
    public static function index(){
        if(isset(getSession()->getContents()['tipo_usuario']) && getSession()->getContents()['tipo_usuario'] == 'Admin'){
            return db()->query('SELECT * FROM viajes')->then(function (array $viajes) {
                return view('viajes/viajes', ['viajes' => $viajes]);
            });
        }
        return db()->query('SELECT * FROM viajes WHERE viajes.habilitado = 1')->then(function (array $viajes) {
            return view('viajes/viajes', ['viajes' => $viajes]);
        });
    }

    public static function getDistancia(ServerRequestInterface $request){
        $inicio = $request->getQueryParams()['inicio'];
        $destino = $request->getQueryParams()['destino'];
        $distancia = json_decode(file_get_contents("https://www.distance24.org/route.json?stops=${inicio}|${destino}"));
        
        return new Response(200, ['Content-Type' => 'application/json'], json_encode($distancia));
    }

    public static function habilitar(ServerRequestInterface $request, $viaje_id){
        $valor = $request->getParsedBody()['habilitado'];

        return db()->query('UPDATE viaje SET habilitado = ? WHERE viaje.id = ?', [$valor, $viaje_id])
            ->then(function(){
                return SimpleResponse::ACCEPTED('Hecho')->toJson('message');
            });
    }

    public static function show(ServerRequestInterface $request, string $id){
       
        return components('viajes', $id)
                ->then(function (array $viaje) use($id) {
                    
                    if (empty($viaje)) {
                        return redirect('/');
                    }

                    return components('rutas', $id)
                        ->then(function (array $rutas) use ($viaje) {

                            return view('viajes/viaje', ['viaje' => $viaje[0], 'rutas' => $rutas]);
                        });
                });
        
    }

    public static function crearViaje(ServerRequestInterface $request)
    {
        db()->query('SET @out_id;');
        db()->query('call nuevo_viaje(@out_id);');
        return db()->query('SELECT @out_id')
            ->then(function(array $valores){
                $id = $valores[0];
                return SimpleResponse::OK($id)->toJson('message');
            });
    }

    public static function borrarViaje(ServerRequestInterface $request, $viaje_id)
    {
        return db()->query('call delete_viaje(?);', [$viaje_id])
            ->then(function(){
                return SimpleResponse::ACCEPTED('Hecho')->toJson('message');
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
            ->then(function (array $viaje) use ($id) {

                if (empty($viaje)) {
                    return redirect('/');
                }

                return components('rutas', $id)
                    ->then(function($rutas) use ($viaje) {
                        return db()->query('SELECT * FROM pais')->then(function(array $paises) use ($viaje, $rutas) {
                            
                            $paises = db()->getResult();
                            return db()->query('SELECT * FROM tipo_viaje')->then(function(array $tipos) use ($viaje, $rutas, $paises) {

                                return view('viajes/modificar', ['viaje' => $viaje[0], 'rutas' => $rutas, 'paises' => $paises, 'tipos' => $tipos]);
                            });
                        });
                    });
            });
    }


    public static function modificarDetalles (ServerRequestInterface $request, string $id) {

        return components('viajes', $id)
            ->then(function (array $viaje) use($request, $id) {

                if (empty($viaje)) {
                    return SimpleResponse::NOT_FOUND();
                }

                $datos = $request->getParsedBody();
                array_push($datos, $id);
          
                return db()->query('UPDATE viaje SET cupos = ?, tipo_viaje_id = ?, numero_adultos = ?, numero_niños = ?, fecha_inicio = ? WHERE id = ?', $datos)
                    ->then(function(){
                        return SimpleResponse::ACCEPTED('Hecho')->toJson('message');
                    })
                    ->otherwise(function(){
                        return SimpleResponse::BAD_REQUEST('Error')->toJson('message');
                    });
        });
    }

    public static function modificarDescripcion (ServerRequestInterface $request, string $id) {

        return components('viajes', $id)
            ->then(function (array $viaje) use($request, $id) {

                if (empty($viaje)) {
                    return SimpleResponse::NOT_FOUND();
                }

                $datos = $request->getParsedBody();
                array_push($datos, $id);
          
                return db()->query('UPDATE viaje SET titulo = ?, descripcion = ? WHERE id = ?', $datos)
                    ->then(function(){
                        return SimpleResponse::ACCEPTED('Hecho')->toJson('message');
                    })
                    ->otherwise(function(){
                        return SimpleResponse::BAD_REQUEST('Error')->toJson('message');
                    });
        });
    }
}