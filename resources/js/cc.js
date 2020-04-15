$('#form').submit(function(e){
    e.preventDefault();
    let uri = location.pathname.split('/');
    $('#modal-loading').modal('show');
        $('#modal-loading').on('shown.bs.modal', function () {
            $.ajax({
                type: "POST",
                url: "/viajes/" + uri[uri.length-2] + "/comprar",
                dataType: "JSON",
            })
            .done(function(response){
                $('#modal-loading').modal('hide');
                $('#ok-message-ok').text(response.message);
                $('#modal-ok').modal('show');
            })
            .fail(function(response){
                $('#modal-loading').modal('hide');
                $('#error-message-error').text(response.responseJSON.message);
                $('#modal-error').modal('show');
            });
        });
})