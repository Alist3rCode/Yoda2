
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

$('.inputMonthWithText').focus(function (){

   if(this.value == ''){
       this.type = "month";
   }
});

$('.inputMonthWithText').blur(function (){

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
   var flag = 0;
   var errors =[];
   
   if (start == ''){
       flag = 1;
       errors.push('Merci de saisir une heure d\'ouverture');
   }
    if (end == ''){
       flag = 1;
       errors.push('Merci de saisir une heure de fermeture');
   }
   
    for (var i = 0; i < workingDays.length; i++) {
        if(workingDays[i].classList.contains('active')){
            workingDaysArray.push(workingDays[i].innerHTML);
        }

    }
    if (flag == 1){
        displayAlert('alertPlanningTime','danger',errors.join("<br>"));
    }else{
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
    }
    
    
   
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
    
    if(code.length > 5){
        flag = 1;
        errors.push('Merci de renseigner un code de 5 caractères ou moins');
    }
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
                
                console.log(retour['error']);
                if (retour['ok'] == 'ok'){
                    displayAlert('alertSlot','success','Le créneau a bien été ajouté.');
                    $('#tableSlot').append(retour['html']);
                    $('#dropdownSearchSlot').append(retour['dropdownSearch']);
                    $('#dropdownCreateSlot').append(retour['dropdownCreate']);
                    switchHeadTable('headSlot');
                    $('#codeSlot').val('');
                    $('#nameSlot').val('');
                    $('#startSlot').val('');
                    $('#endSlot').val('');
                    $('#colorSlot').val('');
                    
                    
                } else if (retour['ok'] == 'nok'){
                    displayAlert('alertSlot','danger',retour['error']);
                }
            }
        });
    }
}

function switchFormatOffDate(id){
    if (id == null){
        id = '';
    } else {
        id = '_'+id;
    }
    var currentYear = (new Date).getFullYear();
    var btn = $('#repeatOff'+id);
    
    if(btn.hasClass('active')){
        $("#dateOff"+id).attr({
           "max" : "",      
           "min" : ""  
        });
        btn.removeClass('active');
        
    } else if(!btn.hasClass('active')){
        $("#dateOff"+id).attr({
           "max" : currentYear+"-01-01",      
           "min" : currentYear+"-12-31"
        });
        btn.addClass('active');
    }
    $('#dateOff'+id).val('');
}

function addOff(){
    var date = $('#dateOff').val();
    var repeat = $('#btnRepeatOff').hasClass('active')? 1 : 0 ;
    var name = $('#nameOff').val();
    
    var flag = 0;
    var errors = [];
    
    if(date == ''){
        flag = 1;
        errors.push('Merci de renseigner une date pour ce jour fermé');
    }
    if(name == ''){
        flag = 1;
        errors.push('Merci de renseigner un nom pour ce jour fermé');
    }
    
    if (flag == 1){
        displayAlert('alertOff','danger',errors.join('<br>'));
    } else{
        
        $.ajax({
            url: "ajax/planning/addOff.php", 
            type: "POST", 
            data: {
                name : name,
                date : date,
                repeat : repeat                
            }, 
            async : false,
            success: function(retour){
                
                if (retour['ok'] == 'ok'){
                    displayAlert('alertOff','success','Le jour fermé a bien été ajouté.');
                    $('#tableOff').append(retour['html']);
                    switchHeadTable('headOff');
                    $('#nameOff').val('');
                    $('#dateOff').val('');
                    $('#btnRepeatOff').removeClass('active')
                    
                } else if (retour['ok'] == 'nok'){
                    displayAlert('alertOff','danger',retour['error']);
                }
                
            }
        });
    }
    
}

function switchSlot(id){
    var tr = document.getElementById('trSlot_'+id);
    var code = document.getElementById('slotCode_'+id).innerHTML;
    var name = document.getElementById('slotName_'+id).innerHTML;
    var start = document.getElementById('slotStart_'+id).innerHTML;
    var stop = document.getElementById('slotStop_'+id).innerHTML;
    var color = document.getElementById('slotColor_'+id).value;
    
    tr.innerHTML = '';
    
    $.ajax({
        url: "ajax/planning/loadInputModifSlot.php", 
        type: "POST", 
        data: {
            code: code,
            name : name,
            start : start,
            stop : stop,
            color: color,
            id : id
        }, 
        async : false,
        success: function(retour){
//            console.log(retour);
            tr.innerHTML = retour;
        }
    });
}

function resetModifSlot(id){
    
    var tr = document.getElementById('trSlot_'+id);
    

    $.ajax({
        url: "ajax/planning/resetSlot.php", 
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

function modifSlot(mode, id){
    
    var flag = 0;
    var errors = [];
   
    if (mode == 'delete'){

        var tr = document.getElementById('trSlot_'+id);
        var code = document.getElementById('slotCode_'+id).innerHTML;
        var name = document.getElementById('slotName_'+id).innerHTML;
        var start = document.getElementById('slotStart_'+id).innerHTML;
        var stop = document.getElementById('slotStop_'+id).innerHTML;
        var color = document.getElementById('slotColor_'+id).value;
        
        
        
    } else if (mode == 'valid'){
        
        var tr = document.getElementById('trSlot_'+id);
        var code = document.getElementById('slotCode_'+id).value;
        var name = document.getElementById('slotName_'+id).value;
        var start = document.getElementById('slotStart_'+id).value;
        var stop = document.getElementById('slotStop_'+id).value;
        var color = document.getElementById('slotColor_'+id).value;
        
        if(code.length > 5){
            flag = 1;
            errors.push('Merci de renseigner un code de 5 caractères ou moins');
        }
    }   
    if (flag == 1){
        displayAlert('alertSlot','danger',errors.join('<br>'));
    } else{
        $.ajax({
            url: "ajax/planning/modifSlot.php", 
            type: "POST", 
            data: {
                code: code,
                name : name,
                start : start,
                stop : stop,
                color: color,
                id : id,
                mode: mode
            }, 
            async : false,
            success: function(retour){
                if (mode == 'valid'){
                    tr.innerHTML = retour;
                    displayAlert('alertSlot','success','Les modifications ont été enregistrées.');
                    tr.innerHTML = retour['html'];

                    console.log(retour['dropdownSearch']);

                    document.getElementById('dropdownSlotSearch_'+id).remove();
                    document.getElementById('dropdownSearchSlot').innerHTML += retour['dropdownSearch'];
                    document.getElementById('dropdownSlotCreate_'+id).remove();
                    document.getElementById('dropdownCreateSlot').innerHTML += retour['dropdownCreate'];

                    displayAlert('alertSlot','success','Les modifications ont été enregistrées.');

                } else if (mode == 'delete'){
                    if (retour["ok"] == 'ok'){

                        tr.innerHTML = '';
                        document.getElementById('dropdownSlotSearch_'+id).remove();
                        document.getElementById('dropdownSlotCreate_'+id).remove();
                        displayAlert('alertSlot','success','La ligne a été supprimée avec succès.');

                    }
                }
            }
        });
    }
}

document.onkeyup = function(e){
   
    if(e.keyCode == 13){

        switch (document.activeElement.id) {
            case 'startSearchSlot':
                $('#slotSearch').click();
                break;
            case 'endSearchSlot':
                $('#slotSearch').click();
                break;
            case 'startPlanning':
                $('#validPlanningTime').click();
                break;
            case 'endPlanning':
                $('#validPlanningTime').click();
                break;
            case 'codeSlot':
                addNewSlot();
                break;
            case 'nameSlot':
                addNewSlot();
                break;
            case 'startSlot':
                addNewSlot();
                break;
            case 'stopSlot':
                addNewSlot();
                break;
            case 'dateOff':
                addOff();
                break;
            case 'nameOff':
                addOff();
                break;
        }
    }
};

function switchOff(id){
    var tr = document.getElementById('trOff_'+id);
    var name = document.getElementById('nameOff_'+id).innerHTML;
    var date = document.getElementById('dateOff_'+id).innerHTML;
    var repeat = document.getElementById('repeatOff_'+id).dataset.repeat;
    
    tr.innerHTML = '';
    
    $.ajax({
        url: "ajax/planning/loadInputModifOff.php", 
        type: "POST", 
        data: {
           
            name : name,
            date : date,
            repeat : repeat,
            id : id
        }, 
        async : false,
        success: function(retour){
            tr.innerHTML = retour;
        }
    });
}

function resetModifOff(id){
    
    var tr = document.getElementById('trOff_'+id);
    

    $.ajax({
        url: "ajax/planning/resetOff.php", 
        type: "POST", 
        data: {
            id : id
        }, 
        async : false,
        success: function(retour){
            tr.innerHTML = retour;
        }
    });
}

function modifOff(mode, id){
    
    var flag = 0;
    var errors = [];
   
    if (mode == 'valid'){

        var tr = document.getElementById('trOff_'+id);
        var name = document.getElementById('nameOff_'+id).value;
        var date = document.getElementById('dateOff_'+id).value;
        var repeat = $('#repeatOff_'+id).hasClass('active')? 1 : 0 ;           
        
    } else if (mode == 'delete'){
        
        var tr = document.getElementById('trOff_'+id);
        var name = document.getElementById('nameOff_'+id).innerHTML;
        var date = document.getElementById('dateOff_'+id).innerHTML;
        var repeat = document.getElementById('repeatOff_'+id).dataset.repeat;
        
    }   
    
    $.ajax({
        url: "ajax/planning/modifOff.php", 
        type: "POST", 
        data: {
            name : name,
            date : date,
            repeat : repeat,
            id : id,
            mode : mode
        }, 
        async : false,
        success: function(retour){
            if (mode == 'valid' && retour['ok'] == 'ok'){

                tr.innerHTML = retour['html'];
                displayAlert('alertOff','success','Les modifications ont été enregistrées.');


            } else if (mode == 'delete' && retour['ok'] == 'ok'){
                

                tr.innerHTML = '';
                displayAlert('alertOff','success','La ligne a été supprimée avec succès.');

                
            }
        }
    });
    
}