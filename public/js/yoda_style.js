$(".vignette").click(function(e){     
    console.log($(this)[0].id);
    if($(this).hasClass('clicked')){
        closeBubble($(this)[0].id);
    }else{
        openBubble($(this)[0].id);
    }
 });

/**
 * gère l'affichage des bubbles avec les actions sur chaque client
 * @argument elem : objet jquery représentant la div vignette sur laquelle a été fait le clic  
 */
function openBubble(elem) {
    element = elem?$('#'+elem):$('.vignette');
    $('.vignette').removeClass('clicked');
    $('.subBall').css('z-index', '-1');
   
    element.children('.subBall').css('z-index', '1');  
    element.addClass('clicked'); 
}
     
/**
 * gère la fermeture des bubbles avec les actions sur chaque client
 * @argument elem : objet jquery représentant la div vignette sur laquelle a été fait le clic  
 */
function closeBubble(elem) {
    element = elem?$('#'+elem):$('.vignette');
    $('.vignette').removeClass('clicked');
    $('.subBall').css('z-index', '-1');
    
    element.children('.subBall').css('z-index', '-1');  
    element.removeClass('clicked'); 
}     

function displayAlertModale(type,message){
    $("#alerte").html(message);
    $('#alerte').addClass('alert-'+type);
    $("#alerte").removeClass('d-none');
    $("#alerte").fadeTo(3000, 500).slideUp(500, function() {
        $("#alerte").slideUp(500);
        $("#alerte").addClass('d-none');
        $('#alerte').removeClass('alert-'+type);
    });
}