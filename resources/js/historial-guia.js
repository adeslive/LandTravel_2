$('#descargar').click(function(){
    $params = location.search;
    location.href = '/guias/historial/descargar' + $params;
})