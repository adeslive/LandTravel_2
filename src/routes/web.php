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
    web()->addRoute(['POST', 'GET'], 'activar/{codigo}', controller('Auth/activar'));

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
        web()->addRoute(['POST', 'GET'], '{id:\d+}/comprar', controller('Viaje/comprar'));

        web()->addRoute(['POST', 'GET'], '{id:\d+}/reservar', controller('Viaje/reservar'));

        web()->addRoute(['GET'], '{id:\d+}/modificar', controller('Viaje/paginaModificar'));
    });

    // Rutas Guias
    web()->addGroup('guias/', function () {

        web()->addRoute(['GET'], 'historial', controller('Guia/historial'));

        web()->addRoute(['GET'], 'pagos', controller('Guia/pagos'));
        web()->addRoute(['GET'], 'pagos/{id}', controller('Guia/pago'));
        web()->addRoute(['GET'], 'pagos/{id}/descarga', controller('Guia/descargaPago'));


        web()->addRoute(['POST'], 'completar', controller('Guia/completar'));

        // Guias
        web()->addRoute(['GET'], 'tours', controller('Guia/tours'));

        web()->addRoute(['GET'], 'rutas/{id}', controller('Guia/rutas'));

        web()->addRoute(['POST'], 'marcar', controller('Guia/marcar'));

        web()->addRoute(['GET'], 'contrato', controller('Guia/contrato'));
        web()->addRoute(['GET'], 'contrato/descargar', controller('Guia/descargaContrato'));
        /**
         *  La peticion para ver una pagina web debe ser GET para que el navegador la despliegue.
         *  primero define bien la ruta.
         */
        web()->addRoute(['GET'], 'contrato/{id}', controller('Guia/contratoGuia'));

        web()->addRoute(['GET'], 'feed', controller('Guia/feed'));
    });
});
