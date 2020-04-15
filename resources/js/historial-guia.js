$('#descargar').click(function(){
    html2canvas(document.querySelector('#region')).then(canvas => {
        var image = canvas.toDataURL('image/jpeg');
        console.log(image);
    });
})