$('#form-recuperar').submit(function (e) {
    e.preventDefault();
    $('#modal-loading').modal('show');
    $('#modal-loading').on('shown.bs.modal', function () {
        $.ajax({
            type: "POST",
            url: "/recuperar",
            data: $('#form-recuperar').serialize(),
            datatype: "JSON"
        })
        .done(function (data) {
            $('#div-correo').css('display','none');
            $('#div-recuperar').css('display','block');
            $('#modal-loading').modal('hide');
        })
        .fail(function (data) {
            
            $('#modal-loading').modal('hide');
            $('#error-message-error').text(data.responseJSON.message);
            $('#modal-error').modal('show');
        })
    })
})