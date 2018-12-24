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

$('[data-toggle="tooltip"]').tooltip();

$('[data-toggle="tooltip"]').each(function(index, element){

    var tg = $(element);
    var idx = element.getAttribute('data-id');
        $.post("ajax/planning/loadSlotDetails.php",{
          id : idx,
          mode : "display"
        } , function(data) {
            tg.attr('data-original-title', data);
        });
});

 function redBarFunction() {
                $('.redBar').remove();
                var time = new Date().toLocaleTimeString('fr-FR', { hour: "numeric", minute:"numeric"});
                var timeSplit = time.split(':');
                var startTime = Number(document.getElementsByClassName('startJquery')[0].innerHTML);
                var hour = timeSplit[0]-startTime  ;
                var min = timeSplit[1] >= 30 ? 1: 0;
                
                var nbTech = document.getElementById('nbTech').innerHTML;
                // console.log(startTime);
                $( "#today" ).append( '<div class="redBar" style="grid-row:1/'+ (parseInt(nbTech)+1) +';grid-column:'+ ((2 * hour)+1 + min) +';"></div>' );
            }
            redBarFunction();
            setInterval(redBarFunction, 30*1000);