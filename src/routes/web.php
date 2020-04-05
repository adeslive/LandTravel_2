<?php

use function Config\Routes\web;
use function React\Promise\reject;
use function React\Promise\resolve;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Response;
use React\Promise\Promise;
use RPF\Core\Mailer;

web()->addGroup('/',function()
{
    web()->addRoute(['HEAD','GET'], '', function(ServerRequestInterface $request) {
        return view('index');
    });
    
    // Registrarse
    web()->addRoute(['GET'], 'registrar', function(ServerRequestInterface $request) {
        return db()->query('SELECT * FROM pais')
                ->then(function(array $values){
                        return view('usuarios/registrar', ['paises' => $values]);
                });
    });

    web()->addRoute(['POST'], 'registrar', function(ServerRequestInterface $request) {
        $data = $request->getParsedBody();
        
        /*return db()->query('SELECT 1 FROM usuarios WHERE email = ?', [$data['correo']])
            ->then(function(array $values){
                return empty($values) ? resolve() : reject(new RuntimeException('El correo ya existe'));
            })
            ->then(function() use ($data) {
                return db()->query('SELECT 1 FROM usuarios WHERE pasaporte = ?', [$data['pasaporte']])
                    ->then(function(array $values){
                        return empty($values) ? resolve() : reject(new RuntimeException('El pasaporte ya existe'));
                    });
            })
            ->then(function() use ($data) {
                return db()->query('SELECT 1 FROM usuarios WHERE telefono = ?', [$data['telefono']])
                    ->then(function(array $values){
                        return empty($values) ? resolve() : reject(new RuntimeException('El telefono ya existe'));
                    });
            })
            ->then(function() use ($data) {
                return db()->query('call final.nueva_persona(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', $data)
                    ->then(function(){
                        return getResponse();
                    });
            })
            ->otherwise(function(RuntimeException $e){
                return new Response(500, ['Content-type' => 'application/json'], json_encode(['message' => $e->getMessage()]));
            });*/

        try{
            Mailer::emailConfirmacion($data);
        } catch (Exception $e) {
            print $e->getMessage();
        }
        return getResponse();
    });

    // Recuperar contraseña
    web()->addRoute(['GET'], 'recuperar', function(ServerRequestInterface $request) {
        return view('viajes/viajes');
    });

    web()->addRoute(['POST'], 'login', function(ServerRequestInterface $request) {
        return view('viajes/viajes');
    });

    // Rutas Viaje
    web()->addGroup('viajes/',function() {
        web()->addRoute(['GET'], '', function(ServerRequestInterface $request) {
            $ip = $request->getServerParams()['REMOTE_ADDR'];
            if ($ip == '127.0.0.1'){
                return components('viajes')->then(function(array $viajes){
                    return view('viajes/viajes', ['viajes' => $viajes]);
                });
            }else{
                $data = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
                var_export($data);
                return db()->query('SELECT * FROM viajes WHERE codigo_pais = ?',[$data['geoplugin_countryCode']])->then(function(array $viajes){
                    return view('viajes/viajes', ['viajes' => $viajes]);
                });
            }
            
        });


        web()->addRoute(['GET'], '{id:\d+}', function(ServerRequestInterface $request, string $id) {
                
        
                return components('viajes', $id)
                    ->then(function(array $viaje){

                        if (empty($viaje)){
                            return redirect('/');
                        }

                        return components('rutas')
                            ->then(function(array $rutas) use ($viaje){
                                return view('viajes/viaje', ['viaje' => $viaje[0], 'rutas' => $rutas]);
                            });
                    });
                    
        });

        web()->addRoute(['GET'], '{id:\d+}/comprar', function(ServerRequestInterface $request, string $id) {
           
    
            return components('viajes', $id)
                ->then(function(array $viaje){

                    if (empty($viaje)){
                        return redirect('/');
                    }

                    return view('viajes/comprar', ['viaje' => $viaje[0]]);
                }); 
        });

        web()->addRoute(['GET'], '{id:\d+}/reservar', function(ServerRequestInterface $request, string $id) {
            
    
            return components('viajes', $id)
                ->then(function(array $viaje){

                    if (empty($viaje)){
                        return redirect('/');
                    }

                    return view('viajes/reservar', ['viaje' => $viaje[0]]);
                }); 
        });
    });
});