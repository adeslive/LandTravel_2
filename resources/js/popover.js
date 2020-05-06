$('#new-viaje').click(function(e){
    e.preventDefault();
    $.post("crearViaje", {},
        function (data, textStatus, jqXHR) {
            let id = data['@out_id'];
            window.location = `${id}/modificar`;
        },
        "JSON"
    );
});

$('.eliminar').click(function(e){
    e.preventDefault();
    $.ajax({
        type: "DELETE",
        url: $(this).prop('href'),
        dataType: "JSON",
        success: function (response) {
            location.reload();
        }
    });
});