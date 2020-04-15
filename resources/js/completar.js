$('#completar').submit(function(e){
    e.preventDefault();

    var datos = $(this).serialize();
    $('#modal-loading').modal('show');
        $('#fecha_nacimiento').removeClass('is-invalid');
        $('#modal-loading').on('shown.bs.modal', function (e) {
            $.ajax({
                url:'/guias/completar',
                data: datos,
                datatype:'JSON',
                method: 'POST'
            })
            .done(function(response){
                $('#modal-loading').modal('hide');
                location.reload();
            })
            .fail(function(data){
                $('#modal-loading').modal('hide');
                $('#error-message-error').text(data.responseJSON.message);
                $('#modal-error').modal('show');
            });
        });
})