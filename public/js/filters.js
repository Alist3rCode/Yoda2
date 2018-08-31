function displayFilter(elem){
    console.log(elem);
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

