function displayAlert(alerte,type,message){
    $("#"+alerte).html(message);
    $("#"+alerte).addClass('alert-'+type);
    $("#"+alerte).removeClass('d-none');
    $("#"+alerte).fadeTo(5000, 500).slideUp(500, function() {
        $("#"+alerte).slideUp(500);
        $("#"+alerte).addClass('d-none');
        $("#"+alerte).removeClass('alert-'+type);
    });
}