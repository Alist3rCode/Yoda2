$('#searchBar').keyup(function(e){
    $('.collapsePhone').remove();
    $('.vignette').removeClass('selectColor');    
    var search = $('#searchBar').val().toLowerCase();
//    var filter = document.getElementById('filter').innerHTML;
        var filter = "ok";
//    arrayVersion = [];
//    vignette = document.getElementsByClassName('vignette');
//    
//    if (document.getElementById('tabSetV7')){
//        if(document.getElementById('searchV7').getAttribute('data-ok') == '1'){
//            
//            document.getElementById('searchV7').setAttribute('data-ok','0');
//        }
//        
//        $('.bigSearchV7').removeClass('searchActiveV7');
//        var listV7 = document.querySelectorAll(".searchV7");
//
//        [].forEach.call(listV7, function(el) {
//            el.classList.remove("searchActiveV7");
//        });
//    }
//    if (document.getElementById('tabSetV8')){
//        if(document.getElementById('searchV8').getAttribute('data-ok') == '1'){
//            
//            document.getElementById('searchV8').setAttribute('data-ok','0');
//        }
//        
//        $('.bigSearchV8').removeClass('searchActiveV8');
//        var listV8 = document.querySelectorAll(".searchV8");
//
//        [].forEach.call(listV7, function(el) {
//            el.classList.remove("searchActiveV8");
//        });
//    }
//    
//    
//    if (document.getElementById('tabSetV6')){
//        if(document.getElementById('searchV6').getAttribute('data-ok') == '1'){
//            
//            document.getElementById('searchV6').setAttribute('data-ok','0');
//        }
//        $('.bigSearchV6').removeClass('searchActiveV6');
//        var listV6 = document.querySelectorAll(".searchV6");
//
//        [].forEach.call(listV6, function(el) {
//            el.classList.remove("searchActiveV6");
//        });
//    }
//    
    if(search === ''){
        
        $('.vignette').removeClass('d-none');
        $('.vignette').removeClass('selectColor');
        idxSelect = 0;
    
    }else{
        $.get("ajax/search.php?search=" + search + "&filter=" + filter, function(json){

            $('.vignette').addClass('d-none');
            unflip();
            $.each(json, function(i, item){
                $('#vignette_' + item.CLI_ID).removeClass('d-none');
            });

            if($('.vignette:not(.d-none)').length >= 1){
                // #francis
                var list = $('.vignette:not(.d-none)');
                var idVignette = 0;

                //Fleche de droite
                if (e.keyCode === 39 && idxSelect < json.length-1) {

                    $('.vignette:not(.d-none)').removeClass('selectColor');
                    idxSelect = idxSelect + 1;
                    list[idxSelect].classList.add('selectColor');

                //Fleche de gauche
                }else if (e.keyCode === 37 && idxSelect > 0) {

                    $('.vignette:not(.d-none)').removeClass('selectColor');
                    idxSelect = idxSelect - 1;
                    list[idxSelect].classList.add('selectColor');

                //Ctrl + Entrée            
                }else if (e.keyCode === 13 && e.ctrlKey) {

                    list[idxSelect].classList.add('selectColor');
                    idVignette = list[idxSelect].id.substring(9);
                    window.open(document.getElementById('vign_url_' + idVignette).href + 'sqlpacsadmin');

                //Alt + Entrée            
                }else if (e.keyCode === 13 && e.altKey) {

                    list[idxSelect].classList.add('selectColor');
                    idVignette = list[idxSelect].id.substring(9);
                    window.open(document.getElementById('vign_url_' + idVignette).href + 'patchmanager');

                //Entrée
                }else if (e.keyCode === 13) {
                    list[idxSelect].classList.add('selectColor');
                    idVignette = list[idxSelect].id.substring(9);
                    window.open(document.getElementById('vign_url_' + idVignette).href);

                // Fleche du haut           
                }else if (e.keyCode === 38) {

                    idVignette = list[idxSelect].id.substring(9);
                    list[idxSelect].classList.add('selectColor');
                    unflip(idVignette);

                //Fleche du bas            
                }else if (e.keyCode === 40) {

                    idVignette = list[idxSelect].id.substring(9);
                    list[idxSelect].classList.add('selectColor');
                    flip(idVignette);

                //Echap
                }else if (e.keyCode === 27) {

                    $('#resetSearch').click();

                //A chaque touche tappée, on remet le halo en haut à gauche.    
                }else{

                    $('.vignette:not(.d-none)').removeClass('selectColor');
                    list[0].classList.add('selectColor');
                    idxSelect = 0;
                    unflip();

                }
            //Echap si aucune vignette affichées.        
            }else if (e.keyCode === 27) {
                
                $('#resetSearch').click();
            }
        });
    }   
});
$('#resetSearch').click(function(){
    idxSelect = 0;
    $('.vignette').removeClass('d-none');
    $('.vignette').removeClass('selectColor');    

    
    $('#searchBar').val('');
    
//    if (document.getElementById('tabSetV7')){
//        if(document.getElementById('searchV7').getAttribute('data-ok') == '1'){
//            
//            document.getElementById('searchV7').setAttribute('data-ok','0');
//        }
//        $('.bigSearchV7').removeClass('searchV7');
//        var listV7 = document.querySelectorAll(".searchV7");
//
//        [].forEach.call(listV7, function(el) {
//            el.classList.remove("searchActiveV7");
//        });
//    }
//    
//    if (document.getElementById('tabSetV6')){
//        if(document.getElementById('searchV6').getAttribute('data-ok') == '1'){
//            
//            document.getElementById('searchV6').setAttribute('data-ok','0');
//        }
//         $('.bigSearchV6').removeClass('searchV6');
//        var listV6 = document.querySelectorAll(".searchV6");
//
//        [].forEach.call(listV6, function(el) {
//            el.classList.remove("searchActiveV6");
//        });
//    }
    
    
    unflip();
    
    arrayVersion = [];
    
});

var idxSelect = 0;

$( document ).ready(function(){
    $('#searchBar').focus();
    $("#alerte").hide();

});