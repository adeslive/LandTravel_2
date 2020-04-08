<?php

use function Config\Routes\web;
use Psr\Http\Message\ServerRequestInterface;

web()->addGroup('/', function () {
    // Index
    web()->addRoute(['GET'], '', controller('Index/index'));

    // Pagina de registro
    web()->addRoute(['GET'], 'registrar', controller('Auth/registrarse'));

    // Crear el usuario
    web()->addRoute(['POST'], 'registrar', controller('Auth/nuevo'));

    // Recuperar contraseña
    web()->addRoute(['POST', 'GET'], 'recuperar', controller('Auth/recuperar'));
    web()->addRoute(['POST', 'GET'], 'recuperar/{codigo}', controller('Auth/cambiarContraseña'));

    // Login
    web()->addRoute(['POST'], 'login', controller('Auth/login'));

    // logout
    web()->addRoute('GET', 'logout', controller('Auth/logout'));

    // Rutas Viaje
    web()->addGroup('viajes/', function () {
        // Todos
        web()->addRoute(['GET'], '', controller('Viaje/index'));

        // Solo uno
        web()->addRoute(['GET'], '{id:\d+}', controller('Viaje/show'));

        // Comprar un viaje
        web()->addRoute(['GET'], '{id:\d+}/comprar', controller('Viaje/paginaComprar'));

        web()->addRoute(['GET'], '{id:\d+}/reservar', controller('Viaje/paginaReservar'));

        web()->addRoute(['GET'], '{id:\d+}/modificar', controller('Viaje/paginaModificar'));
    });
});
