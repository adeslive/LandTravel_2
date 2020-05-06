<?php
namespace CONTROLLERS;

use Psr\Http\Message\ServerRequestInterface;

final class Reportes {

    public static function reporte_empleados(ServerRequestInterface $request){
        if (!empty($request->getQueryParams())) {

            $datos = $request->getQueryParams();
      
            return db()->query('SELECT año FROM pagos')
                ->then(function() use ($datos) {

                    return db()->query('SELECT * FROM pagos WHERE año = ? AND mes = ?', $datos)
                        ->then(function(array $valores) use ($datos){
                            $años = [];

                            foreach(db()->getLastResult() as $valor){
                                if (!isset($años[$valor['año']])){
                                    array_push($años, $valor['año']);
                                }
                            }
                            return view('admin/reporte-empleados', ['pagos' => $valores, 'años' => $años, 'mes' => $datos['mes'], 'año' => $datos['año']]);
                        });
                });
        }

        return db()->query('SELECT año FROM pagos')
            ->then(function() {

                return db()->query('SELECT * FROM pagos WHERE mes = 1')
                    ->then(function(array $valores){
                        $años = [];
                        $pagos = [];

                        foreach(db()->getLastResult() as $valor){
                            if (!isset($años[$valor['año']])){
                                array_push($años, $valor['año']);
                            }
                        }

                        foreach($valores as $valor){
                            if($valor['año'] == $años[0]) array_push($pagos, $valor);
                        }
                        
                        return view('admin/reporte-turistas', ['pagos' => $valores, 'años' => $años, 'mes' => 1, 'año' => $años[0]]);
                    });
            });
    }

    public static function reporte_ganancias(ServerRequestInterface $request){
        if (!empty($request->getQueryParams())) {

            $datos = $request->getQueryParams();
      
            return db()->query('SELECT año FROM historiales')
                ->then(function() use ($datos) {

                    return db()->query('SELECT * FROM historiales WHERE año = ? AND mes = ?', $datos)
                        ->then(function(array $valores) use ($datos){
                            $años = [];
                            $ganancias = 0.0;

                            foreach ($valores as $valor){
                                $ganancias += $valor['monto_pagado'];
                            }

                            $ganancias = number_format(($ganancias*0.3)/1.3, 2, '.', '');

                            foreach(db()->getLastResult() as $valor){
                                if (!isset($años[$valor['año']])){
                                    array_push($años, $valor['año']);
                                }
                            }
                            return db()->query('SELECT * FROM pagos WHERE año = ? AND mes = ?', $datos)
                                ->then(function() use ($ganancias, $años, $datos){
                                    $pagos = db()->getResult();
                                    $planilla = 0.0;

                                    foreach($pagos as $pago)
                                    {
                                        $planilla += $pago['mensual'] + $pago['extra'] - $pago['deducido'];
                                    }
                                    $planilla = number_format($planilla, 2, '.', '');

                                    return view('admin/reporte-ganancias', ['ganancias' => $ganancias, 'planilla' => $planilla, 'años' => $años, 'mes' => $datos['mes'], 'año' => $datos['año']]);
                            });
                            
                        });
                });
        }

        return db()->query('SELECT año FROM historiales')
            ->then(function() {

                return db()->query('SELECT * FROM historiales WHERE mes = 1')
                    ->then(function(array $valores){
                        $años = [];
                        $pagos = [];

                        foreach(db()->getLastResult() as $valor){
                            if (!isset($años[$valor['año']])){
                                array_push($años, $valor['año']);
                            }
                        }

                        foreach($valores as $valor){
                            if($valor['año'] == $años[0]) array_push($pagos, $valor);
                        }
                        
                        return view('admin/reporte-ganancias', ['pagos' => $valores, 'años' => $años, 'mes' => 1, 'año' => $años[0]]);
                    });
            });
    }


    public static function reporte_turistas(ServerRequestInterface $request){
        if (!empty($request->getQueryParams())) {

            $datos = $request->getQueryParams();
      
            return db()->query('SELECT año FROM historiales')
                ->then(function() use ($datos) {

                    return db()->query('SELECT * FROM historiales WHERE año = ? AND mes = ?', $datos)
                        ->then(function(array $valores) use ($datos){
                            $años = [];

                            foreach(db()->getLastResult() as $valor){
                                if (!isset($años[$valor['año']])){
                                    array_push($años, $valor['año']);
                                }
                            }
                            return view('admin/reporte-turistas', ['pagos' => $valores, 'años' => $años, 'mes' => $datos['mes'], 'año' => $datos['año']]);
                        });
                });
        }

        return db()->query('SELECT año FROM historiales')
            ->then(function() {

                return db()->query('SELECT * FROM historiales WHERE mes = 1')
                    ->then(function(array $valores){
                        $años = [];
                        $pagos = [];

                        foreach(db()->getLastResult() as $valor){
                            if (!isset($años[$valor['año']])){
                                array_push($años, $valor['año']);
                            }
                        }

                        foreach($valores as $valor){
                            if($valor['año'] == $años[0]) array_push($pagos, $valor);
                        }
                        
                        return view('admin/reporte-turistas', ['pagos' => $valores, 'años' => $años, 'mes' => 1, 'año' => $años[0]]);
                    });
            });
    }
}