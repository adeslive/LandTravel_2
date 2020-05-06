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

        web()->addRoute(['POST'], 'crearViaje', controller('Viaje/crearViaje'));

        web()->addRoute(['GET'], '{id:\d+}/modificar', controller('Viaje/paginaModificar'));

        web()->addRoute('PUT', '{id:\d+}/modificar/detalles', controller('Viaje/modificarDetalles'));

        web()->addRoute('PUT', '{id:\d+}/modificar/descripcion', controller('Viaje/modificarDescripcion'));

        web()->addRoute('POST', '{id:\d+}/modificar/habilitar', controller('Viaje/habilitar'));

        web()->addRoute('DELETE', '{id:\d+}/eliminar', controller('Viaje/borrarViaje'));
    });

    // Rutas Rutas Viaje
    web()->addGroup('rutas/', function () {
        web()->addRoute(['POST'], '{ruta_id: \d+}', controller('RutaViaje/get_ruta'));
        web()->addRoute(['POST'], 'viaje/{viaje_id: \d+}', controller('RutaViaje/nueva_ruta'));
        web()->addRoute(['DELETE'], '{ruta_id: \d+}', controller('RutaViaje/borrar_ruta'));
    });


    web()->addGroup('reportes/', function () {
        web()->addRoute(['GET'], 'empleados', controller('Reportes/reporte_empleados'));
        web()->addRoute(['GET'], 'ganancias', controller('Reportes/reporte_ganancias'));
        web()->addRoute(['GET'], 'turistas', controller('Reportes/reporte_turistas'));
    });

    // Rutas Guias
    web()->addGroup('guias/', function () {

        web()->addRoute(['GET'], 'historial', controller('Guia/historial',['Guia']));
        web()->addRoute(['GET'], 'historial/descargar', controller('Guia/descargaHistorial',['Guia']));

        web()->addRoute(['GET'], 'pagos', controller('Guia/pagos',['Guia']));
        web()->addRoute(['GET'], 'pagos/{id}', controller('Guia/pago',['Guia']));
        web()->addRoute(['GET'], 'pagos/{id}/descarga', controller('Guia/descargaPago',['Guia']));


        web()->addRoute(['POST'], 'completar', controller('Guia/completar',['Guia']));

        // Guias
        web()->addRoute(['GET'], 'tours', controller('Guia/tours',['Guia']));

        web()->addRoute(['GET'], 'rutas/{id}', controller('Guia/rutas',['Guia']));

        web()->addRoute(['POST'], 'marcar', controller('Guia/marcar',['Guia']));

        web()->addRoute(['GET'], 'contrato', controller('Guia/contrato',['Guia']));
        web()->addRoute(['POST'], 'contrato/modificar', controller('Guia/modificarContrato',['Guia']));
        web()->addRoute(['GET'], 'contrato/descargar', controller('Guia/descargaContrato',['Guia']));
        /**
         *  La peticion para ver una pagina web debe ser GET para que el navegador la despliegue.
         *  primero define bien la ruta.
         */
        web()->addRoute(['GET'], 'contrato/{id}', controller('Guia/contratoGuia'));

        web()->addRoute(['GET'], 'feed', controller('Guia/feed'));
    });

    web()->addGroup('pais/', function () {
        web()->addRoute(['GET'], '{id}/destinos', controller('Pais/getDestinos'));
        web()->addRoute(['GET'], '{id}/lugares', controller('Pais/getLugares'));
        web()->addRoute(['GET'], '{id}/hoteles', controller('Pais/getHoteles'));
        web()->addRoute(['GET'], '{id}/transportes', controller('Pais/getTransportes'));
        web()->addRoute(['GET'], '{id}/tours', controller('Pais/getTours'));
    });

    web()->addGroup('tours/', function () {
        web()->addRoute(['GET'], '', controller('Tours/index'));
        web()->addRoute(['POST'], 'crearTour', controller('Tours/crearTour'));
        web()->addRoute(['DELETE'], '{id:\d+}/eliminar', controller('Tours/eliminar'));
        web()->addRoute(['GET'], '{id:\d+}/modificar', controller('Tours/modificar'));
        web()->addRoute(['POST'], '{id:\d+}/modificar/nuevaRuta', controller('Tours/nuevaRuta'));
        web()->addRoute(['DELETE'], '{id:\d+}/modificar/borrarRuta', controller('Tours/borrarRuta'));
        web()->addRoute(['POST'], '{id:\d+}/modificar/descripcion', controller('Tours/modificarDescripcion'));
    });

    web()->addGroup('utils/', function () {
        web()->addRoute(['GET'], 'distancia', controller('Viaje/getDistancia'));
    });
});
