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
    changeVignetteBackground();

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


function changeVignetteBackground(){
    if ( $('.filterActivity').hasClass('showFilter') && (!$('.filterVersionHead').hasClass('showFilter'))){
     
        $('.vignette').removeClass('v6 v7 v8');
        $('.vignette').each(function(id,elem){
           console.log(1);
            switch($(elem).attr('data-activity')) {
                case "0,0":
                    $(elem).addClass('none');
                    break;
                case "1,0":
                    $(elem).addClass('ris');
                    break;
                case "0,1":
                    $(elem).addClass('pacs');
                    break;
                case "1,1":
                    $(elem).addClass('ris-pacs');
                    break;
            }
           
        });
        
    } else if ( (!$('.filterActivity').hasClass('showFilter')) || $('.filterVersionHead').hasClass('showFilter')){
     
        $('.vignette').removeClass('none ris pacs ris-pacs');
        $('.vignette').each(function(id,elem){
           console.log(2);
            switch($(elem).attr('data-version')) {
                case "v6":
                    $(elem).addClass('v6');
                    break;
                case "v7":
                    $(elem).addClass('v7');
                    break;
                case "v8":
                    $(elem).addClass('v8');
                    break;
               
            }
           
        });
        
    }   
}


$('.folderCollapseFilters').click(function(){
   
    if ($(this).hasClass('collapsed')){
        $(this).removeClass('fa-folder');
        $(this).addClass('fa-folder-open');
    }else if(!$(this).hasClass('collapsed')){
        $(this).addClass('fa-folder');
        $(this).removeClass('fa-folder-open');
    }
});

function AdvancedFiltersParent(filter){
    
    if (!$('#advancedVersionFilterButton' + filter).hasClass('active')){
        $('#'+ filter +'Collapse').children('a').each(function () {
            addVersionToAdvancedFilters($(this).data('color'),$(this).data('version'));
            $(this).addClass('active');            
        }); 
        $('#advancedVersionFilterButton' + filter).addClass('active');
        
    }else if ($('#advancedVersionFilterButton' + filter).hasClass('active')){
        $('#'+ filter +'Collapse').children('a').each(function () {
            removeVersionToAdvancedFilters($(this).data('version'));
            $(this).removeClass('active');
        }); 
        $('#advancedVersionFilterButton' + filter).removeClass('active');
    }
}

function addVersionToAdvancedFilters(color,version){
    
    var htmlToAdd = '<a href="#" id="AdvancedFilterVersionSelected_'+version+'" class="badge badge-'+color+' spacingFilters" onclick="AdvancedFilters('+version+')">'+version+'</a>';
    if (!document.getElementById('AdvancedFilterVersionSelected_'+version)){
        document.getElementById('advancedVersionFilters').innerHTML += htmlToAdd;
    }
    
};

function removeVersionToAdvancedFilters(version){
    
    document.getElementById('AdvancedFilterVersionSelected_'+version).remove();
    
};

function AdvancedFiltersActivity(filter, color){
    
    if (!$('#advancedActivityFilterButton' + filter).hasClass('active')){
        
        addActivityToAdvancedFilters(color,filter);
        $('#advancedActivityFilterButton' + filter).addClass('active');
        
    }else if ($('#advancedActivityFilterButton' + filter).hasClass('active')){
       
        removeActivityToAdvancedFilters(filter);
        $('#advancedActivityFilterButton' + filter).removeClass('active');
        
    }
}

function addActivityToAdvancedFilters(color,activity){
    
    var htmlToAdd = '<a href="#" id="AdvancedFilterActivitySelected_'+activity+'" class="badge badge-'+color+' spacingFilters" onclick="AdvancedFilters('+activity+')">'+activity+'</a>';
    
    document.getElementById('advancedActivityFilters').innerHTML += htmlToAdd;
};

function removeActivityToAdvancedFilters(activity){
    
    document.getElementById('AdvancedFilterActivitySelected_'+activity).remove();
    
};

function switchFilters(value){
    
    if (value === 'OR'){
        $('#switchFiltersOR').addClass('active');
        $('#switchFiltersAND').removeClass('active');
    }
    if (value === 'AND'){
        $('#switchFiltersAND').addClass('active');
        $('#switchFiltersOR').removeClass('active');
        
    }
    
}


function AdvancedFilters(color,filter,parent){
    var flagActive = 1;
    var filterBtn = document.getElementById('advancedVersionFilter' + filter);
    if (!filterBtn.classList.contains('active')){
        addVersionToAdvancedFilters(color, filter);    
        filterBtn.classList.add('active');
        $('#'+ parent +'Collapse').children('a').each(function () {
            
            if (!$(this).hasClass('active')){
               flagActive = 0; 
            }
            
        }); 
        if (flagActive === 1){
            $('#advancedVersionFilterButton' + parent).addClass('active');
        }
        
    }else if (filterBtn.classList.contains('active')){
        
        removeVersionToAdvancedFilters(filter);
        filterBtn.classList.remove('active');
        $('#advancedVersionFilterButton' + parent).removeClass('active');
        
    }
    
    
}