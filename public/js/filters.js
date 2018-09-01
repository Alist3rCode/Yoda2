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
    }
    else if (family === 'activity'){
        $('.filterActivity').removeClass('showFilter');
    }
}

function showVersionFilter(version){
    if ($('.filterVersion.filter'+version).hasClass('showFilter')){
        $('.filterVersion.filter'+version).removeClass('showFilter');
    }else{
        $('.filterVersion.filter'+version).addClass('showFilter');
    }
}




var arrayVersion = [];

function displayVersionFilter(){

    if(arrayVersion.length === 0){
            
        $('.vignette').removeClass('d-none');
            
    }else{        
            
        $.post("ajax/searchVersion.php",
        {search: arrayVersion}, 
        function(json){
                $('.vignette').addClass('d-none');
                for (i = 0; i < json.length; i++) {
                   
                   $('#vignette_' + json[i]).removeClass('d-none');
                }
        });
    }
    
unflip();
    
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
    $('#searchVersion_' + numVersion).removeClass("searchActive"+version);
    }else{
        console.dir(document.getElementById('searchVersion_' + numVersion));
        $('#searchVersion_' + numVersion).addClass('searchActive' + version);
        arrayVersion.push(numVersion);
    }
    
    displayVersionFilter();
}




function searchActivity(i){
    
    $('.collapsePhone').remove();
    $('.vignette').removeClass('selectColor');
    document.getElementById("searchBar").value = "";
    
    if (arrayVersion.includes(i)){
        var index = arrayVersion.indexOf(i);
        if (index > -1) {
            arrayVersion.splice(index, 1);
        }
    document.getElementById('SearchActivity' + i).classList.remove("searchActiveActivity");
    }else{
        document.getElementById('SearchActivity' + i).classList.add("searchActiveActivity");
        arrayVersion.push(i);
    }

    
    displayVersionFilter();
}
