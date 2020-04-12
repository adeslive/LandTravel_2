$('#form-contraseña').submit(function (e) {
    e.preventDefault();
    let uri = location.pathname.split('/');
    $('#modal-loading').modal('show');
    $('#modal-loading').on('shown.bs.modal', function () {

        if ($('#r-contraseña').val() == $('#r-ccontraseña').val()) 
        {
            $.ajax({
                type: "POST",
                url: "/recuperar/"+ uri[uri.length-1],
                data: $('#form-contraseña').serialize(),
                datatype: "JSON"
            })
            .done(function (data) {
                $('#div-contraseña').css('display','none');
                $('#div-correcto').css('display','block');
                $('#modal-loading').modal('hide');
            })
            .fail(function (data) {
                $('#modal-loading').modal('hide');
                $('#error-message-error').text(data.responseJSON.message);
                $('#modal-error').modal('show');
            })
        } else {
            $('#modal-loading').modal('hide');
            $('#error-message-error').text("Las contraseñas no coinciden");
            $('#modal-error').modal('show');
        }
    })
})