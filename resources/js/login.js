$('#userDropdown').click(function(e){
    if (document.getElementById("overlay").style.display == "block"){
        document.getElementById("overlay").style.display = "none";
    }else{
        document.getElementById("overlay").style.display = "block";
    }
});

$('#overlay').click(function(){
    document.getElementById("overlay").style.display = "none";
})

$('#form-login').submit(function(e){
    e.preventDefault();
    $('#modal-loading-login').modal('show');
    $('#modal-loading-login').on('shown.bs.modal', function (e) {
        $.ajax({
            type: "POST",
            url: "/login",
            datatype:'Json',
            data: $('#form-login').serialize()
        })
        .done(function(response){
            $('#modal-loading-login').modal('hide');
            location.reload();
        })
        .fail(function(response){
            $('#modal-loading-login').modal('hide');
            $('#error-message-error-login').text(response.responseJSON.message);
            $('#modal-error-login').modal('show');
        });
    });
})

