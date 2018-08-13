$(".vignette").click(function(e){     
   
    if($(this).hasClass('clicked')){
        closeBubble($(this));
    }else{
        openBubble($(this));
    }
    
});

/**
 * gère l'affichage des bubbles avec les actions sur chaque client
 * @argument elem : objet jquery représentant la div vignette sur laquelle a été fait le clic  
 */
function openBubble(elem) {
    $('.vignette').removeClass('clicked');
    $('.subBall').css('z-index', '-1');
   
    elem.children('.subBall').css('z-index', '1');  
    elem.addClass('clicked'); 
}
     
/**
 * gère la fermeture des bubbles avec les actions sur chaque client
 * @argument elem : objet jquery représentant la div vignette sur laquelle a été fait le clic  
 */
function closeBubble(elem) {
    $('.vignette').removeClass('clicked');
    $('.subBall').css('z-index', '-1');
    
    elem.children('.subBall').css('z-index', '-1');  
    elem.removeClass('clicked'); 
}     
     