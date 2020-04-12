<?php

namespace CONTROLLERS;

use RPF\Core\Mailer;
use RuntimeException;
use RPF\Core\Controller;
use Psr\Http\Message\ServerRequestInterface;
use RPF\core\SimpleResponse;

use function React\Promise\reject;
use function React\Promise\resolve;

final class Auth extends Controller
{
    public static function registrarse(ServerRequestInterface $request)
    {
        return db()->query('SELECT * FROM pais')
            ->then(function (array $values) {
                return view('usuarios/registrar', ['paises' => $values]);
            });
    }

    public static function nuevo(ServerRequestInterface $request)
    {
        $data = $request->getParsedBody();

        return db()->query('SELECT 1 FROM usuarios WHERE email = ?', [$data['correo']])
            ->then(function (array $values) {
                return empty($values) ? resolve() : reject(new RuntimeException('El correo ya existe'));
            })
            ->then(function () use ($data) {
                return db()->query('SELECT 1 FROM usuarios WHERE pasaporte = ?', [$data['pasaporte']])
                    ->then(function (array $values) {
                        return empty($values) ? resolve() : reject(new RuntimeException('El pasaporte ya existe'));
                    });
            })
            ->then(function () use ($data) {
                return db()->query('SELECT 1 FROM usuarios WHERE telefono = ?', [$data['telefono']])
                    ->then(function (array $values) {
                        return empty($values) ? resolve() : reject(new RuntimeException('El telefono ya existe'));
                    });
            })
            ->then(function () use ($data) {
                $data['contraseña'] = password_hash($data['contraseña'], PASSWORD_DEFAULT);
                db()->query("set @OUT_codigo = '0';");
                return db()->query('call final.nueva_persona(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, @OUT_codigo)', $data)
                    ->then(function () use ($data) {
                        return db()->query('select @OUT_codigo;')
                            ->then(function(array $codigo) use ($data){
                                $data['codigo'] = $codigo[0]['@OUT_ codigo'];
                                Mailer::emailConfirmacion($data, $data['tipo_usuario']);
                                return SimpleResponse::OK();
                            });
                    });
            })
            ->otherwise(function (RuntimeException $e) {
                return SimpleResponse::INTERNAL_ERROR($e->getMessage())->toJson('message');
            });
    }

    public static function login(ServerRequestInterface $request)
    {
        $datos = $request->getParsedBody();
        return db()->query('SELECT id, pnombre, papellido, tipo_usuario, contraseña FROM usuarios WHERE email = ?', [$datos['correo']])
            ->then(function (array $values) use ($datos) {
                if (empty($values)) {
                    return SimpleResponse::INTERNAL_ERROR('El correo no existe')->toJson('message');
                };

                if (password_verify($datos['contraseña'], $values[0]['contraseña'])) {
                    getSession()->begin();

                    unset($values[0]['contraseña']);
                    getSession()->setContents($values[0]);

                    return SimpleResponse::OK();
                } else {
                    return SimpleResponse::INTERNAL_ERROR('Contraseña incorrecta')->toJson('message');
                }
            });
    }

    public static function logout(){
        getSession()->end();
        return redirect('/');
    }

    public static function recuperar(ServerRequestInterface $request){
        if($request->getMethod() == 'POST'){
            $data = $request->getParsedBody();
    
            return db()->query('SELECT 1 FROM usuario where email = ?', [$data['correo']])
                ->then(function(array $valor) use ($data) {
                    if (empty($valor)) return SimpleResponse::BAD_REQUEST('Correo invalido')->toJson('message');
                    
                    db()->query("set @codigo = '0';");
                    return db()->query("call final.nuevo_codigo_respaldo(?, @codigo);", [$data['correo']])
                        ->then(function() use ($data){

                            return db()->query("select @codigo;")
                                ->then(function(array $resultado) use ($data) {
                                    $data['codigo'] = $resultado[0]['@codigo'];
                                    Mailer::recuperarContraseña($data);
                                    return SimpleResponse::OK();
                                })->otherwise(function(){
                                    return SimpleResponse::BAD_REQUEST('Error inesperado')->toJson('message');
                                });

                        });
                });
        }else{
            return view('usuarios/recuperar');
        }
    }

    public static function cambiarContraseña(ServerRequestInterface $request, $codigo)
    {
        if($request->getMethod() == 'POST'){
            $data = $request->getParsedBody();
           
            return db()->query('SELECT id FROM usuario WHERE codigo_respaldo = ?', [$codigo])
                ->then(function(array $values)  {
                    return !empty($values) ? resolve() : reject();
                })
                ->then(function() use ($data){
                    $data['id'] = db()->getResult()[0]['id'];
                    $data['contraseña'] = password_hash($data['contraseña'], PASSWORD_DEFAULT);
                    return db()->query('UPDATE usuario SET codigo_respaldo = null, contraseña = ? WHERE id = ?', [$data['contraseña'], $data['id']])
                        ->then(function(){
                            return SimpleResponse::OK();
                        })
                        ->otherwise(function(){
                            return SimpleResponse::INTERNAL_ERROR('Error inesperado')->toJson('message');
                        });
                })
                ->otherwise(function(){
                    return SimpleResponse::BAD_REQUEST(['message' => 'Hubo un error'])->toJson();
                });

        }else{
            return db()->query('SELECT 1 FROM usuario WHERE codigo_respaldo = ?', [$codigo])
                ->then(function(array $values)  {
                    return !empty($values) ? resolve() : reject();
                })
                ->then(function() use ($codigo){
                    return view('usuarios/cambiar-contraseña',['codigo' => $codigo]);
                })
                ->otherwise(function(){
                    return view('usuarios/cambiar-contraseña');
                });
        }
    }
}
