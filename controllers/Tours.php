<?php
namespace CONTROLLERS;

use RPF\core\SimpleResponse;
use Psr\Http\Message\ServerRequestInterface;

final class Tours{
    public static function index(ServerRequestInterface $request){
        return components('tours')
            ->then(function(){

                return db()->query('SELECT * FROM pais')->then(function(){
                    return view('tours/index', ['tours' => db()->getLastResult(), 'paises' => db()->getResult()]);
                });
            });
    }

    public static function modificar(ServerRequestInterface $request, $id){
        return components('tours', $id)
            ->then(function() use($id){

                $tour = db()->getResult()[0];

                return db()->query('SELECT * FROM lugares WHERE pais_id = ?', [$tour['pais_id']])->then(function(array $paises) use ($tour, $id) {
                            
                    return db()->query('SELECT * FROM rutas_tour WHERE id = ?', [$id])->then(function() use($tour){
                        
                        return view('tours/modificar', ['tour' => $tour, 'rutas' => db()->getResult(), 'lugares' => db()->getLastResult()]);
                        });
                });
            });
    }

    public static function crearTour(ServerRequestInterface $request){
        $pais = $request->getParsedBody()['pais_id'];
        db()->query('set @out_id = 0;');
        db()->query('call final.nuevo_tour(?, @out_id);',[$pais]);
        return db()->query('SELECT @out_id')
            ->then(function(array $valores){
                
                $id = $valores[0];
                return SimpleResponse::OK($id)->toJson('message');
            });
    }

    public static function modificarDescripcion(ServerRequestInterface $request, $id){
        return components('tours', $id)
            ->then(function() use ($request, $id){

                if (empty(db()->getResult())) {
                    return SimpleResponse::NOT_FOUND();
                }

                $datos = $request->getParsedBody();
                array_push($datos, $id);

                db()->query('UPDATE tour SET nombre = ?, costo = ?, descripcion = ? WHERE id = ?', $datos);
                return SimpleResponse::OK('Hecho')->toJson('message');
            });
    }

    public static function nuevaRuta(ServerRequestInterface $request, $id){
        return components('tours', $id)
            ->then(function() use ($request, $id){

                if (empty(db()->getResult())) {
                    return SimpleResponse::NOT_FOUND();
                }

                $datos = $request->getParsedBody();
                $datos['id'] = $id;
                
                db()->query('INSERT INTO tour_has_lugar (tour_id, lugar_id, fecha_inicio, fecha_salida) VALUES(?, ?, ?, ?)', [
                    $datos['id'],
                    $datos['lugar'],
                    $datos['fecha_inicio'],
                    $datos['fecha_fin']
                ]);
                return SimpleResponse::OK('Hecho')->toJson('message');
            });
    }

    public static function borrarRuta(ServerRequestInterface $request, $id){
        return components('tours', $id)
            ->then(function() use ($request, $id){

                if (empty(db()->getResult())) {
                    return SimpleResponse::NOT_FOUND();
                }
                $datos = $request->getParsedBody();

                db()->query('DELETE FROM tour_has_lugar WHERE tour_id = ? AND lugar_id = ?', [$id, $datos['id']]);
                return SimpleResponse::ACCEPTED('Hecho')->toJson('message');
            });
    }

    public static function eliminar(ServerRequestInterface $request, $id){
        return db()->query('call delete_tour(?);', [$id])
            ->then(function(){
                return SimpleResponse::ACCEPTED('Hecho')->toJson('message');
            });
    }
}