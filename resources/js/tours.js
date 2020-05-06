$('#new-tour').click(function(e){
    e.preventDefault();
    $('#modal-decision').modal('show');

    $('#pais-form').submit(function(e){
        e.preventDefault();
        $.post("crearTour", {pais_id: $('#pais-form :selected').val()},
            function (data, textStatus, jqXHR) {
                let id = data['@out_id'];
                window.location = `${id}/modificar`;
            },
            "JSON"
        );
    });
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