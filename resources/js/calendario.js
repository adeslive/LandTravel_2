$(function () {
    var loaded = false;
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        timeZone: 'UTC',
        plugins: ['timeGrid'],
        defaultView: 'timeGridWeek',
        nowIndicator: true,
        eventSources: [
            {
                url: 'guias/feed', // use the `url` property
            }
        ],
        eventMouseEnter: function (mouseEnterInfo) {
            $('.fc-event').popover({ container: 'body' });

        },
        loading: function (isLoading) {
            if (this.getEvents().length > 0 && !loaded) {
                loaded = true;
                let next = this.getEvents()[0];
                this.gotoDate(next.start)
                check();
            }
        }
    });

    setInterval(function () {
        if (calendar.getEvents().length > 0 ){
            let next = calendar.getEvents()[0];
            calendar.gotoDate(next.start);
            $('#titulo').html(next.title);

            if (moment().diff(moment(next.start)) >= 0 && moment().diff(moment(next.end)) <= 0) {
                $('.active-dot').removeClass('bg-danger');
                $('.active-dot').addClass('bg-success');
                $('#marcar').removeClass('disabled');
                $('#marcar').prop('disabled', false);
            }else if(moment().diff(moment(next.end)) >= 0){
                $('.active-dot').addClass('bg-danger');
                $('#marcar').removeClass('disabled');
                $('#marcar').prop('disabled', true);
                $('#titulo').html('Sin evento');
                
            }
        }
    }, 2000);

    setInterval(function () {
        check();
        calendar.render();
    }, 30000);

    function check() {
        if (calendar.getEvents().length > 0){
            let next = calendar.getEvents()[0];
            $('#titulo').html(next.title);

            $.ajax({
                type: "GET",
                url: "guias/rutas/" + next.id,
                dataType: "JSON",
            })
            .done(function(response){
                $('#rutas').html('');
                response.forEach( element => {
                    crearRuta(element.lugar, element.fecha_inicio, element.fecha_salida, element.pais, element.ciudad)
                });
            });
        }
    }

    function crearRuta(inicio, hi, hs, pais, ciudad){

        let template = 
        `
            <div class="list-group rutas">
                <div class="ruta list-group-item list-group-item-action flex-column align-items-start">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm">
                                <small class="mb-1"><i class="fas fa-map-marker-alt"></i> Inicio: ${inicio}</small><br>
                                <small class="mb-1"><i class="fas fa-map"></i> Pais: ${pais}</small><br>
                                <small class="mb-1"><i class="fas fa-hourglass-start"></i> Hora Inicio: ${hi}</small>
                            </div>
                            <div class="col-sm">
                                <br>
                                <small class="mb-1"><i class="fas fa-map"></i> Ciudad: ${ciudad}</small><br>
                                <small class="mb-1"><i class="fas fa-hourglass-end"></i> Hora Salida: ${hs}</small>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        `;
 
    $(template).appendTo("#rutas")
    }

    calendar.render();

    $('#descargar').click(function(){
        html2canvas(document.querySelector('#region')).then(canvas => {
            var img = canvas.toDataURL('image/jpeg');
            var doc = new jsPDF();
            doc.addImage(img, 'JPEG', 15, 40, 180, 120)
            download(doc.output(), "Calendario.pdf", 'text/pdf');
        });
    });

    $('#marcar').click(function () {
        $('#modal-loading').modal('show');
        $('#modal-loading').on('shown.bs.modal', function () {
            $.ajax({
                type: "POST",
                data: {'id': calendar.getEvents()[0].id},
                url: "guias/marcar",
                dataType: "JSON",
            })
            .done(function(response){
                $('#div-correo').css('display','none');
                $('#div-recuperar').css('display','block');
                $('#modal-loading').modal('hide');
                
                $('#marcar').addClass('disabled');
                $('#marcar').prop('disabled', true);
                $('#ok-message-ok').text(response.message);
                $('#modal-ok').modal('show');

                setTimeout(function(){
                    $('#modal-ok').modal('hide');
                    $('#marcar').removeClass('disabled');
                    $('#marcar').prop('disabled', false);
                }, 5000);
            })
            .fail(function(response){
                $('#modal-loading').modal('hide');
                $('#error-message-error').text(response.responseJSON.message);
                $('#modal-error').modal('show');
            });
        });
    })



    function download(strData, strFileName, strMimeType) {
        var D = document,
            A = arguments,
            a = D.createElement("a"),
            d = A[0],
            n = A[1],
            t = A[2] || "text/plain";
    
        //build download link:
        a.href = "data:" + strMimeType + "," + escape(strData);
    
        if (window.MSBlobBuilder) {
            var bb = new MSBlobBuilder();
            bb.append(strData);
            return navigator.msSaveBlob(bb, strFileName);
        } /* end if(window.MSBlobBuilder) */
    
        if ('download' in a) {
            a.setAttribute("download", n);
            a.innerHTML = "downloading...";
            D.body.appendChild(a);
            setTimeout(function() {
                var e = D.createEvent("MouseEvents");
                e.initMouseEvent("click", true, false, window, 0, 0, 0, 0, 0, false, false,
    false, false, 0, null);
                a.dispatchEvent(e);
                D.body.removeChild(a);
            }, 66);
            return true;
        } /* end if('download' in a) */    
    
        //do iframe dataURL download:
        var f = D.createElement("iframe");
        D.body.appendChild(f);
        f.src = "data:" + (A[2] ? A[2] : "application/octet-stream") + (window.btoa ? ";base64"
    : "") + "," + (window.btoa ? window.btoa : escape)(strData);
        setTimeout(function() {
            D.body.removeChild(f);
        }, 333);
        return true;
    }
});

