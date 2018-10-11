function ucFirst(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}


$(".vignette").click(function(e){  
    console.log(e);
    if ($(e.target).hasClass('version') || $(e.target).hasClass('tag') || $(e.target).hasClass('hr') || $(e.target).hasClass('spanVersion')){
        flip($(this)[0].id);
    }else if ($(e.target).hasClass('infoClientBack') || $(e.target).hasClass('back')){
        unflip($(this)[0].id);
    }
});

/**
 * gère l'affichage des bubbles avec les actions sur chaque client
 * @argument elem : objet jquery représentant la div vignette sur laquelle a été fait le clic  
 */
function flip(elem) {
    element = elem?$('#'+elem):$('.vignette');
    $('.vignette').removeClass('clicked');  
    element.addClass('clicked'); 
}
     
/**
 * gère la fermeture des bubbles avec les actions sur chaque client
 * @argument elem : objet jquery représentant la div vignette sur laquelle a été fait le clic  
 */
function unflip(elem) {
    element = elem?$('#'+elem):$('.vignette');
    $('.vignette').removeClass('clicked');
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

function findPlaceNewCustomer(ville,nom){
    var array=[];
    var flag = 0;
    var retour = '';
   
    ville = ville.toLowerCase();
    nom = nom.toLowerCase();
    
    $('.clients .vignette').each(function(i,e){
        if($(this).find(".ville").html() === ville ){
            array.push(this.id);
            flag = 1;
        }else if ($(this).find(".ville").html() > ville && flag === 0){
            if ($(this).prev(".clients .vignette").length !== 0){
                retour = $(this).prev(".clients .vignette")[0].id;
            }else{
                retour = this.id;
            }
            
            return false;
        }
    });
    
    if (retour === ''){
        flag = 0;
        $.each(array, function (key, value){
           if($('#'+value).find(".nom").html() > nom){
               retour = array[key-1];
               flag = 1;
               return false;
           }
        });
        if (flag === 0){
            retour = array[array.length-1];
        }
           
    }
    return retour;
}
    
$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('collapsed');
    });
    var page = window.location.pathname.split("/")[2].split('.')[0];
    if (page === ''){
        page = 'index';
    }
    console.log(page);
    $('#sidebar_'+page).addClass('activeSidebarElement');
    
    
});