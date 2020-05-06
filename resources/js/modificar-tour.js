$(function(){

    $('#agregar-ruta').submit(function(e){
        e.preventDefault();
        $.post(location.pathname + "/nuevaRuta", $(this).serialize(),
            function (data, textStatus, jqXHR) {
                location.reload();
            },
            "JSON"
        );
    });

    $('.ruta').last().css('background-color', '#f45d5d')
    $('.ruta').last().css('color', 'white')

    $('.ruta').last().click(function(){
        if (confirm('¿Desea eliminarlo?')){

            $.ajax({
                type: "DELETE",
                url: location.pathname + "/borrarRuta",
                data: {'id': $(this).data('lugar')},
                dataType: "JSON",
                success: function (response) {
                    location.reload();
                }
            });
        }
    });

    $('#descripcion-form').submit(function(e){
        e.preventDefault();

        $.post(location.pathname + "/descripcion", $(this).serialize(),
            function (data, textStatus, jqXHR) {
                console.log(data);
            },
            "JSON"
        );
    });
});