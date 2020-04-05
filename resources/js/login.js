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