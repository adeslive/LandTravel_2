$('#newroute').trigger('reset');
$(function(){

    var uri = location.pathname.split('/');
    var viaje_id = uri[uri.length - 2];

    var pais = 0;
    var numero_rutas = 0;
    var pais_anterior = 0;
    var nombre_destino_anterior = "";

    function init(){
        $('#newroute').trigger('reset');
        pais_inicio = $('#pais_inicio').val()
        pais = $('#pais').val();
        numero_rutas = $(".ruta").length;
        pais_anterior = $(`#ruta${numero_rutas}`).data('pais');
        nombre_destino_anterior = $(`#destino-ruta${numero_rutas}`).text().split(' ')[2];
        
        if(numero_rutas > 0 ){
            $('#msj-pasada').text('* En base a la ruta pasada');
            $('#div-destino').append(`<div class="form-group col-sm-2 mt-2 text-right" id="button-submit-ruta">
            <br><button id="add" class="btn btn-primary">Agregar</button></div>`);
            $('#div-inicio').html('');
        }else{
            
            $('#div-destino button').remove();
        }
    }

    function prepareInicio(){
        $('#inicios').html('');
        $.ajax({
            type: "GET",
            url: "/pais/" + $('#pais_inicio :selected').val() +"/destinos",
            dataType: "JSON",
            success: function (response) {
                if (response.destinos.length == 0)
                {
                    $('#add').prop('disabled', true);
                    $('#add').addClass('disabled');
                }else{

                    if ($('#add').prop('disabled') == true){ 
                        $('#add').prop('disabled', false);
                        $('#add').removeClass('disabled');
                    }

                    $('#inicios').prop('disabled', false);
                    response.destinos.forEach(destino => {
                        if (destino.nombre != nombre_destino_anterior) $('#inicios').append(`<option value="${destino.id}">${destino.nombre}</option>`);
                    });
                }
            }
        });
    }

    function prepareDestino(){
        $('#destinos').html('');
        $.ajax({
            type: "GET",
            url: "/pais/" + pais +"/destinos",
            dataType: "JSON",
            success: function (response) {
                if (response.destinos.length == 0)
                {
                    $('#add').prop('disabled', true);
                    $('#add').addClass('disabled');
                }else{

                    if ($('#add').prop('disabled') == true){ 
                        $('#add').prop('disabled', false);
                        $('#add').removeClass('disabled');
                    }

                    $('#destinos').prop('disabled', false);
                        response.destinos.forEach(destino => {
                        if (destino.nombre != nombre_destino_anterior) $('#destinos').append(`<option value="${destino.id}">${destino.nombre}</option>`);
                    });
                }
            }
        });
    }

    function prepareTransporte(){
        $('#transporte').html('<option value="0" data-cost="0" data-speed="1">Sin transporte</option>');
        if (numero_rutas > 0){
            $.ajax({
                type: "GET",
                url: "/pais/" + pais_anterior +"/transportes",
                dataType: "JSON",
                success: function (response) {
                    $('#transporte').prop('disabled', false);
                    response.transportes.forEach(transporte => {
                        $('#transporte').append(`<option data-cost="${transporte.costo}" value="${transporte.id}" data-speed="${transporte.velocidad_promedio}">${transporte.nombre}</option>`);
                    });
                }
            });
        }else{
            console.log($('#inicios :selected').val());
            $.ajax({
                type: "GET",
                url: "/pais/" + $('#pais_inicio :selected').val() +"/transportes",
                dataType: "JSON",
                success: function (response) {
                    $('#transporte').prop('disabled', false);
                    console.log(response);
                    response.transportes.forEach(transporte => {
                        $('#transporte').append(`<option data-cost="${transporte.costo}" value="${transporte.id}" data-speed="${transporte.velocidad_promedio}">${transporte.nombre}</option>`);
                    });
                }
            });
        }
    }

    function prepareHotel(){
        $('#hotel').html('<option value="0" data-cost="0" data-nights="0">Sin hotel</option>');
        $.ajax({
            type: "GET",
            url: "/pais/" + pais +"/hoteles",
            dataType: "JSON",
            success: function (response) {
                $('#hotel').prop('disabled', false);
                response.hoteles.forEach(hotel => {
                    $('#hotel').append(`<option value="${hotel.id}" data-nights="${hotel.cantidad_noches}" data-cost="${hotel.costo_noche}">${hotel.nombre}</option>`);
                });
            }
        });
    }

    function prepareTour(){
        $('#tour').html('<option value="0" data-cost="0" data-nights="0">Sin tour</option>');
        $.ajax({
            type: "GET",
            url: "/pais/" + pais +"/tours",
            dataType: "JSON",
            success: function (response) {
                $('#tour').prop('disabled', false);
                response.tours.forEach(tour => {
                    $('#tour').append(`<option value="${tour.id}" data-start="${tour.h_start}" data-end="${tour.h_end}" data-cost="${tour.costo}" data-duration="${tour.duracion}">${tour.title}</option>`);
                });
            }
        });
    }

    init();
    prepareInicio();
    prepareDestino();
    prepareTransporte();
    prepareHotel();
    prepareTour();
    
    $('#pais').change(function(){
        pais = $(this).val();
        prepareDestino();
        prepareTransporte();
        prepareHotel();
    });

    $('#pais_inicio').change(function(){
        prepareInicio();
    });

    $('#inicios').change(function(){
        prepareTransporte();
    });

    $('#destinos').change(function(){
        prepareTransporte();
    });

    $('#transporte').change(function(){
        let inicio = nombre_destino_anterior;
        let destino = $('#destinos :selected').text();

        if ($(this).val() != 0 && $('#destinos').val() != 0){
            $('#costo_transporte').val($("#transporte :selected").data("cost"));

            $.ajax({
                type: "GET",
                url: `/utils/distancia?inicio=${inicio}&destino=${destino}`, 
                success: function (response) {
                    let fecha_nueva;
                    let hora_vieja;
                    let speed = $('#transporte :selected').data('speed');
                    var hours = response.distance/speed;
                    var hours_round = parseInt(response.distance/speed);
                    var minutes = Math.round((hours - hours_round)*60);

                    if (hours_round < 10) hours_round = `0${hours_round}`;
                    if (minutes < 10) minutes = `0${minutes}`;

                    if (numero_rutas > 0){
                        fecha_nueva = moment($(`#fecha_llegada-ruta${numero_rutas}`).text().split(" ")[3], 'DD/MM/YYYY');
                        hora_vieja = $(`#hora_llegada-ruta${numero_rutas}`).text().split(" ")[3].split(':');
                    }else{
                        fecha_nueva = moment($('#fecha_inicio').val(), 'YYYY-MM-DD');
                        hora_vieja = $('#hora_salida').val().split(':');
                    }
                    
                    fecha_nueva.add(hora_vieja[0], 'h');
                    fecha_nueva.add(hora_vieja[1], 'm');
                    fecha_nueva.add(hora_vieja[2], 's');

                    fecha_nueva.add(minutes, 'm');
                    fecha_nueva.add(hours_round, 'h');
 
                    $("#tiempo_viaje").val(hours_round+":"+minutes);
                    $('#fecha_llegada').val(fecha_nueva.format('YYYY-MM-DD'));
                    $('#hora_llegada').val(fecha_nueva.format('HH:mm'))
                },
            });
        }else{
            $('#hora_llegada').val('00:00')
            $('#costo_transporte').val(0);
            $("#tiempo_viaje").val("00:00");
        }
    });

    $('#hotel').change(function(){
        let paquete = $('#hotel :selected');
        $('#costo_hotel').val(paquete.data('cost'));
        $('#numero_noches').val(paquete.data('nights'));
    });

    $('#tour').change(function(){
        let tour = $('#tour :selected');
        $('#costo_tour').val(tour.data('cost'));
        $('#duracion_tour').val(tour.data('end'));
        $('#inicio_tour').val(tour.data('start'));

        let hora_salida = tour.data('end').split(':');
        hora_salida[1] = parseInt(hora_salida[1]) + 30;
        hora_salida.pop();
        
        if (parseInt(hora_salida[1]) > 60){
            hora_salida[0] = parseInt(hora_salida[0]) + 1;
        }

        if (parseInt(hora_salida[0]) > 24){
            hora_salida[0] = "00";
        }

        $('#hora_salida').val(hora_salida.join(':'));
    });

    $('#viaje-form').submit(function(e){
        e.preventDefault();

        let data = $(this).serialize();
        
        $.ajax({
            type: "PUT",
            url: location.pathname + "/detalles",
            data: data,
            dataType: "JSON",
            success: function (response) {
                console.log(response);
            }
        });
    });

    $('#descripcion-form').submit(function(e){
        e.preventDefault();

        $.ajax({
            type: "PUT",
            url: location.pathname + "/descripcion",
            data: $(this).serialize(),
            dataType: "JSON",
            success: function (response) {
                console.log(response);
            }
        });
    });

    $('#newroute').submit(function(e){
        e.preventDefault();
        let data = $(this).serialize();
        if($('#inicios :selected').val() != $('#destinos :selected').val()) {
            data += "&horas_viaje=" + parseInt($('#tiempo_viaje').val().split(':')[0]);
            data += "&minutos_viaje=" + parseInt($('#tiempo_viaje').val().split(':')[1]);
            
            if(numero_rutas > 0) {
                data += "&inicio=" + $(`#ruta${numero_rutas}`).data('destino');
            }else{
                data += "&inicio=" + $('#inicios :selected').val();
            }

            $.post("/rutas/viaje/"+viaje_id, data,
                function (data, textStatus, jqXHR) {
                    location.reload();
                },
                "JSON"
            );
        }
    })

    $('.ruta').click(function(e){
        var ruta_id = $('#ruta'+$(this).data('number')).data('id');
        $('#modal-modificar').modal('show');

        $('#modal-modificar .btn-primary').click(function(){
            alert("AA");
        });
    
        $('#modal-modificar .btn-danger').click(function(){
            $.ajax({
                type: "DELETE",
                url: "/rutas/" + ruta_id,
                dataType: "JSON",
                success: function (response) {
                    location.reload();
                }
            });
        });
    })

    $('#habilitado').change(function(e){
        
        $.post(location.pathname + "/habilitar", {'habilitado': $(this).prop('checked') ? 1 : 0},
            function (data, textStatus, jqXHR) {
                
            },
            "JSON"
        );
    })
})




