<?php

namespace CONTROLLERS;

use RPF\Core\PDF;
use Psr\Http\Message\ServerRequestInterface;

final class Index 
{
    public static function index(ServerRequestInterface $request)
    {
        if (getSession()->isActive() && !empty(getSession()->getContents())){
            if (getSession()->getContents()['tipo_usuario'] == 'Guia') return Index::indexGuia($request);
            return Index::indexAdmin($request);
        }
        return view('index');
    }

    public static function indexGuia(ServerRequestInterface $request)
    {
        $guia_id = getSession()->getContents()['guia_id'];
        return db()->query('SELECT contrato_id FROM guias where guia_id = ?', [$guia_id])
            ->then(function($valor){
                $contrato = $valor[0]['contrato_id'];
                return view('guias/index', ['contrato' => $contrato]);
            });
        
    }

    public static function indexAdmin(ServerRequestInterface $request)
    {
        return view('index');
    }
}