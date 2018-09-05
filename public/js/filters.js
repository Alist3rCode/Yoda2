function displayFilter(elem){
    
    if(elem === 'version'){
        if($('.filterVersionHead').hasClass('showFilter')){
            hideFamilyFilter('version');
        }else{
            showFamilyFilter('version');
        }
    }else if(elem === 'activity'){
         if($('.filterActivity').hasClass('showFilter')){
            hideFamilyFilter('activity');
        }else{
            showFamilyFilter('activity');
        }
    }else{
        showVersionFilter(elem);
    }
    unflip();
    displayPhones();

}

function showFamilyFilter(family){
    if(family === 'version'){
        $('.filterVersionHead').addClass('showFilter');
    }
    else if (family === 'activity'){
        $('.filterActivity').addClass('showFilter');
    }
}


function hideFamilyFilter(family){
    if(family === 'version'){
        $('.filterVersionHead').removeClass('showFilter');
        $('.filterVersion').removeClass('showFilter');
        arrayVersion = [];
        displayVersionFilter();
        $('.filterVersion').removeClass('searchActive');
    }
    else if (family === 'activity'){
        $('.filterActivity').removeClass('showFilter');
        arrayVersion = [];
        displayVersionFilter();
        $('.filterActivity').removeClass('searchActive');
    } else{
        $('.filterVersionHead').removeClass('showFilter');
        $('.filterVersion').removeClass('showFilter');
        $('.filterActivity').removeClass('showFilter');
        arrayVersion = [];
        displayVersionFilter();
        $('.filterVersion').removeClass('searchActive');
        $('.filterActivity').removeClass('searchActive');
    }
}

function showVersionFilter(version){
    if ($('.filterVersion.filter'+version).hasClass('showFilter')){
        $('.filterVersion.filter'+version).removeClass('showFilter');
        arrayVersion = [];
        displayVersionFilter();
        displayPhones();
        unflip();
        $('.filterVersion').removeClass('searchActive');
        
    }else{
        $('.filterVersion.filter'+version).addClass('showFilter');
    }
}




var arrayVersion = [];

function displayVersionFilter(){

    if(arrayVersion.length === 0){
            
        $('.vignette').removeClass('d-none');
            
    }else{        
            
        $.post("ajax/searchFilters.php",
        {search: arrayVersion}, 
        function(json){
                $('.vignette').addClass('d-none');
                for (i = 0; i < json.length; i++) {
                   
                   $('#vignette_' + json[i]).removeClass('d-none');
                }
        });
    }
    
unflip();
displayPhones();
    
}

function searchForVersion(version, numVersion){
    
    $('.vignette').removeClass('d-none');
    $('.vignette').removeClass('selectColor');    
    $('#searchBar').val('');
    unflip();
    
    if (arrayVersion.includes(numVersion)){
        var index = arrayVersion.indexOf(numVersion);
        if (index > -1) {
            arrayVersion.splice(index, 1);
        }
    document.getElementById('searchVersion_' + numVersion).classList.remove("searchActive");
    }else{
        
        document.getElementById('searchVersion_' + numVersion).classList.add('searchActive');
        arrayVersion.push(numVersion);
    }
    
    displayVersionFilter();
}

function searchForActivity(activity){
    
    $('.vignette').removeClass('d-none');
    $('.vignette').removeClass('selectColor');    
    $('#searchBar').val('');
    unflip();
    
    if (arrayVersion.includes(activity)){
        var index = arrayVersion.indexOf(activity);
        if (index > -1) {
            arrayVersion.splice(index, 1);
        }
    document.getElementById('searchActivity_' + activity).classList.remove("searchActive");
    }else{
        
        document.getElementById('searchActivity_' + activity).classList.add('searchActive');
        arrayVersion.push(activity);
    }
    
    displayVersionFilter();
}
