<?php

namespace CONTROLLERS;

use DateTime;
use Exception;
use RPF\Core\Controller;
use Psr\Http\Message\ServerRequestInterface;
use RPF\Core\PDF;
use RPF\core\SimpleResponse;

final class Guia extends Controller
{
    public static function tours(ServerRequestInterface $request)
    {
        return view('guias/tours');
    }

    public static function pagos(ServerRequestInterface $request)
    {
        $guia_id = getSession()->getContents()['guia_id'];
        return db()->query('SELECT * FROM pagos WHERE guia_id = ?',[$guia_id])
            ->then(function(array $valores){
                $pagos = [];
                foreach($valores as $valor){
                    if (!isset($pagos[$valor['año']])){
                        $pagos[$valor['año']] = [];
                    }

                    array_push($pagos[$valor['año']], $valor);
                }

                $años = array_keys($pagos);

                return view('guias/pagos', ['pagos' => $pagos, 'años' => $años]);
            });
    }

    public static function pago(ServerRequestInterface $request, $id)
    {
        $guia_id = getSession()->getContents()['guia_id'];
        return db()->query('SELECT * FROM pagos WHERE id = ? AND guia_id = ?', [$id, $guia_id])
            ->then(function(array $valores) use ($guia_id){

                if (empty($valores)) return redirect('/guias/pagos');

                return db()->query('SELECT * FROM tours_guia WHERE guia_id = ? AND fecha_inicio >= DATE_SUB(?, INTERVAL 1 MONTH) AND fecha_salida <= ?', [$guia_id, $valores[0]['fecha_pago'], $valores[0]['fecha_pago']])
                    ->then(function($tours){
                        $valores = db()->getLastResult();
 
                        return view('guias/pago', ['pago' => $valores[0], 'tours' => $tours]);
                    });
            });
    }

    public static function descargaPago(ServerRequestInterface $request, $id)
    {
        $guia_id = getSession()->getContents()['guia_id'];
        return db()->query('SELECT * FROM pagos WHERE id = ? AND guia_id = ?', [$id, $guia_id])
            ->then(function(array $valores) use ($guia_id){

                if (empty($valores)) return redirect('/guias/pagos');

                return db()->query('SELECT * FROM tours_guia WHERE guia_id = ? AND fecha_inicio >= DATE_SUB(?, INTERVAL 1 MONTH) AND fecha_salida <= ?', [$guia_id, $valores[0]['fecha_pago'], $valores[0]['fecha_pago']])
                    ->then(function($tours){
                        $valores = db()->getLastResult();
                        $body = PDF::createPDFTemplate('pdf/historial-pago', ['pago' => $valores[0], 'tours' => $tours], ['format' => 'Letter'], true, 'css/vaucher.css')->getBody();
                        return SimpleResponse::OK($body)->toPDF();
                    });
            });
    }

    public static function historial(ServerRequestInterface $request)
    {
        $guia_id = getSession()->getContents()['guia_id'];
        return db()->query('SELECT * FROM tours_guia WHERE guia_id = ?', [$guia_id])
            ->then(function($tours){
        
                return view('guias/historial', ['tours' => $tours]);
            });
            
    }

    public static function feed(ServerRequestInterface $request)
    {
        $guia_id = getSession()->getContents()['guia_id'];
        return db()->query('SELECT * FROM feed WHERE guia_id = ?',[$guia_id])
            ->then(function($fechas){
                return SimpleResponse::OK($fechas)->toJson();
            });
    }

    public static function completar(ServerRequestInterface $request)
    {
        $data = $request->getParsedBody();
        var_export($data);
        $guia_id = getSession()->getContents()['guia_id'];
        return db()->query('call final.nuevo_guia(?, ?, ?);', [$guia_id, $data['oficio'], $data['estado_civil']])
            ->then(function(){
                return SimpleResponse::OK('Correcto')->toJson('message');
            });
    }

    public static function rutas(ServerRequestInterface $request, $id)
    {
        return db()->query('SELECT * FROM rutas_tour WHERE id = ?', [$id])
            ->then(function($fechas){
                return SimpleResponse::OK($fechas)->toJson();
            });
    }

    public static function marcar(ServerRequestInterface $request)
    {
        $id_tour = $request->getParsedBody()['id'];
        $guia_id = getSession()->getContents()['guia_id'];
        return db()->query('SELECT 1 FROM guia_has_tour WHERE guia_id = ? AND marca_inicio is null AND tour_id = ?', [$guia_id, $id_tour])
            ->then(function(array $valores) use ($guia_id, $id_tour){
                if (!empty($valores)) {
                    return db()->query('UPDATE guia_has_tour SET marca_inicio = ? WHERE guia_id = ? AND tour_id = ?',[date("Y-m-d H:i:s"), $guia_id, $id_tour])
                        ->then(function(){
                         
                            return SimpleResponse::ACCEPTED('Has marcado entrada')->toJson('message');
                        });
                }

                return db()->query('SELECT 1 FROM guia_has_tour WHERE guia_id = ? AND marca_fin is null AND tour_id = ?', [$guia_id, $id_tour])
                    ->then(function(array $valores) use ($guia_id, $id_tour){
  

                        if (!empty($valores)) {
                            return db()->query('UPDATE guia_has_tour SET marca_fin = ? WHERE guia_id = ? AND tour_id = ?',[date("Y-m-d H:i:s"), $guia_id, $id_tour])
                                ->then(function(){
                                    return SimpleResponse::ACCEPTED('Has marcado salida')->toJson('message');
                                });
                        }
                        
                        return SimpleResponse::BAD_REQUEST('Ya marcaste salida')->toJson('message');
                    });
            });
    }

    public static function contrato(ServerRequestInterface $request)
    {
        $today = new DateTime();
        $later = date_add(new DateTime(), date_interval_create_from_date_string('3 months'));
        $body = PDF::createPDFTemplate('pdf/contrato', ['today' => $today, 'later' => $later], ['format' => 'Letter'], true, 'css/contrato.css')->getBody();
        return SimpleResponse::OK($body)->toPDF();
    }

    public static function contratoGuia(ServerRequestInterface $request, string $id)
    {
        $body = PDF::createPDFTemplate('pdf/contrato', [], ['format' => 'Letter'], true, 'css/contrato.css')->getBody();
        return SimpleResponse::OK($body)->toPDF();
    }
}
