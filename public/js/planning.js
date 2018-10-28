
function displayModaleConfig(){

    $.ajax({
       url: 'ajax/planning/loadModaleConfigPlanning.php',
       type: 'POST',
       dataType: 'html',
       success : function(data){
           $("#modaleConfigPlanning").empty();
           $("#modaleConfigPlanning").append(data);
           $('#modaleConfigPlanning').modal('show');
       }
    });
    
}

 
$('.inputDateWithText').focus(function (){

   if(this.value == ''){
       this.type = "date";
   }
});

$('.inputDateWithText').blur(function (){

   if(this.value == ''){
       this.type = "text";
   }
});

$('.inputTimeWithText').focus(function (){

   if(this.value == ''){
       this.type = "time";
   }
});

$('.inputTimeWithText').blur(function (){

   if(this.value == ''){
       this.type = "text";
   }
});
    
$('.daysButton').click(function(){
   
    if($(this).hasClass('active')){
        $(this).removeClass('active');
    }else{
        $(this).addClass('active');
    }
});  
    
    
function dropdown(btn, content, id){
    $('#'+btn).html(content);
    document.getElementById(btn).dataset.id = id;
}


$('#validPlanningTime').click(function(){
   
   var start = document.getElementById('startPlanning').value;
   var end = document.getElementById('endPlanning').value;
   var workingDays = $('#workingDaysButton button');
   var workingDaysArray = [];
   
    for (var i = 0; i < workingDays.length; i++) {
        if(workingDays[i].classList.contains('active')){
            workingDaysArray.push(workingDays[i].innerHTML);
        }

    }
    console.log(workingDaysArray)
    
    $.post("ajax/planning/savePlanningTime.php",
    {
        start: start,
        end : end,
        workingday : workingDaysArray

    }, 
    function(retour){

        if( retour['ok'] == 'ok'){
            displayAlert('alertPlanningTime', 'success', 'Les modifications effectuées ont été enregistrées.');
        }else{
            displayAlert('alertPlanningTime', 'danger', 'Une erreur est survenue');
        }
    });
   
});

function switchHeadTable(type){
    if(type == 'inputSlot'){
        $('#theadSlot').addClass('d-none');
        $('#theadSlotInput').removeClass('d-none');
    }
    if(type == 'headSlot'){
        $('#theadSlot').removeClass('d-none');
        $('#theadSlotInput').addClass('d-none');
    }
    if(type == 'inputOff'){
        $('#theadOff').addClass('d-none');
        $('#theadOffInput').removeClass('d-none');
    }
    if(type == 'headOff'){
        $('#theadOff').removeClass('d-none');
        $('#theadOffInput').addClass('d-none');
    }
}

$('.collapse').on('shown.bs.collapse', function () {
    if(!$('#resultSlotSearch').hasClass('show') && !$('#createAssocSlot').hasClass('show')){
        $('#noSearchNorCreate').collapse('show');
    } else {
        $('#noSearchNorCreate').collapse('hide');
    }
});

$('.collapse').on('hidden.bs.collapse', function () {
    if(!$('#resultSlotSearch').hasClass('show') && !$('#createAssocSlot').hasClass('show')){
        $('#noSearchNorCreate').collapse('show');
    } else {
        $('#noSearchNorCreate').collapse('hide');
    }
});

$('#slotSearch').click(function(e){
    
    var tech = document.getElementById('btnTech').dataset.id;
    var slot = document.getElementById('btnSlot').dataset.id;
    var start = $('#startSearchSlot').val();
    var end = $('#endSearchSlot').val();  
    var flag = 0;
    var errors = [];
    
    $('#createAssocSlot').collapse('hide');

        if(tech == ''){
            flag = 1;
            errors.push('Technicien non renseigné');
        }
        if(slot == ''){
            flag = 1;
            errors.push('Créneau non renseigné');
        }
        if(start == ''){
            flag = 1;
            errors.push('Saisir une date de début de recherche');
        }
        if(end == ''){
            flag = 1;
            errors.push('Saisir une date de fin de recherche');
        }
        
        if(flag == 1){
            displayAlert('alertSearchOrCreate','danger',errors.join("<br>"));
        } else{
            console.log('tech : '+tech, 'slot : '+slot, 'start : '+start, 'end : '+end);
            $('#tableResultSlot').html('');
            $.ajax({
                url: "ajax/planning/loadSlotAssoc.php", 
                type: "POST", 
                data: {
                    start: start,
                    end : end,
                    tech : tech,
                    slot : slot
                }, 
                async : false,
                success: function(retour){
                    $('#tableResultSlot').html(retour);
                }
            });
            $('#resultSlotSearch').collapse('show');
        }
});

function switchSlotAssoc(id){
    var tr = document.getElementById('resultTrSlot_'+id);
    var tech = document.getElementById('resultTech_'+id).dataset.idtech;
    var slot = document.getElementById('resultSlot_'+id).dataset.idslot;
    var date = document.getElementById('resultDate_'+id).innerHTML;
    
    console.log('imin');
    
    console.log(tr, tech, slot, date);
    
    tr.innerHTML = '';
    
    $.ajax({
        url: "ajax/planning/loadInputModifSlotAssoc.php", 
        type: "POST", 
        data: {
            tech: tech,
            slot : slot,
            date : date,
            id : id
        }, 
        async : false,
        success: function(retour){
//            console.log(retour);
            tr.innerHTML = retour;
        }
    });
}

function resetModif(id){
    
    var tr = document.getElementById('resultTrSlot_'+id);
    console.log(id);
    $.ajax({
        url: "ajax/planning/resetSlotAssoc.php", 
        type: "POST", 
        data: {
            id : id
        }, 
        async : false,
        success: function(retour){
//            console.log(retour);
            tr.innerHTML = retour;
        }
    });
}

function modifSlotAssoc(mode, id){
   
   
    if (mode == 'valid'){

        var tr = document.getElementById('resultTrSlot_'+id);
        var tech = document.getElementById('btnModifTech_'+id).dataset.id;
        var slot = document.getElementById('btnModifSlot_'+id).dataset.id;
        var date = document.getElementById('dateModifSlot_'+id).value;
        
    } else if (mode == 'delete'){
        
        var tr = document.getElementById('resultTrSlot_'+id);
        var tech = document.getElementById('resultTech_'+id).dataset.idtech;
        var slot = document.getElementById('resultSlot_'+id).dataset.idslot;
        var date = document.getElementById('resultDate_'+id).innerHTML;
    }   
    
    $.ajax({
        url: "ajax/planning/modifSlotAssoc.php", 
        type: "POST", 
        data: {
            id : id,
            tech : tech,
            slot : slot,
            date : date, 
            mode : mode
        }, 
        async : false,
        success: function(retour){
            if (mode == 'valid'){
                tr.innerHTML = retour;
                displayAlert('alertSearchOrCreate','success','Les modifications ont été enregistrées.');
            } else if (mode == 'delete'){
                if (retour == 'ok'){
                    tr.innerHTML = '';
                    displayAlert('alertSearchOrCreate','success','La ligne a été supprimée avec succès.');
                }
            }
        }
    });
}


function addNewSlot(){
    var code = $('#codeSlot').val();
    var name = $('#nameSlot').val();
    var start = $('#startSlot').val();
    var end = $('#endSlot').val();
    var color = $('#colorSlot').val();
    
    var flag = 0;
    var errors = [];
    
    if(code == ''){
        flag = 1;
        errors.push('Merci de renseigner un code pour ce créneau');
    }
    if(name == ''){
        flag = 1;
        errors.push('Merci de renseigner un nom pour ce créneau');
    }
    if(start == ''){
        flag = 1;
        errors.push('Merci de renseigner une heure de début pour ce créneau');
    }
    if(end == ''){
        flag = 1;
        errors.push('Merci de renseigner une heure de fin pour ce créneau');
    }
    if(color == ''){
        flag = 1;
        errors.push('Merci de renseigner une couleur pour ce créneau');
    }
    
    if (flag == 1){
        displayAlert('alertSlot','danger',errors.join('<br>'));
    } else{
        
        $.ajax({
            url: "ajax/planning/addSlot.php", 
            type: "POST", 
            data: {
                code : code,
                name : name,
                start : start,
                stop : end, 
                color : color
            }, 
            async : false,
            success: function(retour){
                if (retour['ok'] == 'ok'){
                    displayAlert('alertSlot','success','Le créneau a bien été ajouté.');
                    $('#tableSlot').append(retour['html']);
                } else if (retour['ok'] == 'nok'){
                    displayAlert('alertSlot','danger',retour['error'].join('<br>'));
                }
                
            }
        });
        
    }
}

