<?php

namespace CONTROLLERS;

use Exception;
use RPF\Core\Mailer;
use RuntimeException;
use React\Http\Response;
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
                return db()->query('call final.nueva_persona(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', $data)
                    ->then(function () {
                        return new Response(200);
                    });
            })
            ->otherwise(function (RuntimeException $e) {
                return new Response(500, ['Content-type' => 'application/json'], json_encode(['message' => $e->getMessage()]));
            });

        try {
            Mailer::emailConfirmacion($data);
        } catch (Exception $e) {
            print $e->getMessage();
        }
        
        return new Response(200);
    }

    public static function login(ServerRequestInterface $request)
    {
        $datos = $request->getParsedBody();
        return db()->query('SELECT pnombre, papellido, tipo_usuario, contraseña FROM usuarios WHERE email = ?', [$datos['correo']])
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

    public static function recuperar(){
        return view('viajes/viajes');
    }
}
