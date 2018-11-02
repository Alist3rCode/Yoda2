function changeColor(mode){
    var idUser = $('#idUser').text();
    $.post("ajax/planning/setColorPlanning.php",{
          idUser : idUser,
          value : mode
        });
    document.location.reload();
}

function changeLabel(mode){
    var idUser = $('#idUser').text();
    $.post("ajax/planning/setLabelPlanning.php",{
          idUser : idUser,
          value : mode
        });
    document.location.reload();
}