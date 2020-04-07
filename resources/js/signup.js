var id = 0;
var datos = "";


function next(){
    $('#card').animate({
        left: '250px',
        opacity: '0',
    },500, function(){
        $('#section' + id).css('display', 'none');
        $('#section' + (++id)).css('display', 'block');
        if (id == 1){
            $('#next').css('display','none');
            $('.page-title').animate({
                left: '8rem',
            },500, "swing");
        }else if (id > 1){
            $('#next').css('display','inline-block');
            $('#next').html('Finalizar');
            $('#next').prop('href', '/');
            $('#next').off('click');
        }
    });
        
    $('#card').animate({
        opacity: '1',
    },500);
}

$('#next').click(function(e){
    e.preventDefault();
    next();
});

$('#form-datos').submit(function(e){
    e.preventDefault();

    let dateStr = $('#fecha_nacimiento').prop('value');
    var diff = Math.abs(new Date() - new Date(dateStr.replace(/-/g,'/')));

    if ((Math.floor(diff / 31536000000)) >= 18){
        $('#modal-loading').modal('show');
        $('#fecha_nacimiento').removeClass('is-invalid');

        datos = $(this).serialize();
        datos += `&tipo_usuario=${$('#tipo_usuario :selected').val()}`;
        datos += `&genero=${$('#genero :selected').val()}`;
        
        $('#modal-loading').on('shown.bs.modal', function (e) {
            $.ajax({
                url:'/registrar',
                data: datos,
                datatype:'Json',
                method: 'POST'
            })
            .done(function(response){
                $('#modal-loading').modal('hide');
                next();
            })
            .fail(function(data){
                $('#modal-loading').modal('hide');
                $('#error-message-error').text(data.responseJSON.message);
                $('#modal-error').modal('show');
            });
        });

    }else{
        $('#fecha_nacimiento').addClass('is-invalid');
    }
});