$(function(){
    var estado = true;
    $('#editar').click(function(){
        
        if (!estado){
            $('#modal-loading').modal('show');
            $('#editar').html('Editar <i class="fas fa-file-signature color"></i>');
            let data = $('#form-contrato').serialize();
            $('#modal-loading').on('shown.bs.modal', function (e) {
                $.ajax({
                    type: "POST",
                    url: '/guias/contrato/modificar',
                    data: data,
                    dataType: "JSON",
                }).done(function(response){
                    $('#modal-loading').modal('hide');
                    $('#modal-ok').modal('show');
                })
                .fail(function(data){
                    $('#modal-loading').modal('hide');
                    $('#error-message-error').text(data.responseJSON.message);
                    $('#modal-error').modal('show');
                });
            });
            
        }else{
            $('#editar').html('Guardar <i class="fas fa-file-download color"></i>');
            
        }
    
        estado = !estado;
        $('#email').prop('disabled', estado);
        $('#tel').prop('disabled', estado);
    })
})