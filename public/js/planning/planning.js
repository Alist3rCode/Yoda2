function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}


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

$('.daysButtonCreate').click(function(){

    if($(this).hasClass('active')){
        $(this).removeClass('active');
    }else{
        $(this).addClass('active');
    }
}); 

    
function dropdown(btn, content, id){
    $('#'+btn).html(content);
    $('#'+btn).removeClass('btn-outline-secondary');
    $('#'+btn).addClass('btn-secondary');
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

$('#slotCreate').click(function(e){
    
   
    $('#createAssocSlot').collapse('show');
    $('#resultSlotSearch').collapse('hide');
    switchRecurrSlotCreation('one');
    $('#createErrorResult').collapse('hide');

    
});

$('#slotSearch').click(function(e){
    
    var tech = document.getElementById('btnTech').dataset.id;
    var slot = document.getElementById('btnSlot').dataset.id;
    var start = $('#startSearchSlot').val();
    var end = $('#endSearchSlot').val();  
    var flag = 0;
    var errors = [];
    
    $('#createAssocSlot').collapse('hide');
    $('#createErrorResult').collapse('hide');


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
    
//    console.log('imin');
    
//    console.log(tr, tech, slot, date);
    
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
    var repeat = $('#repeatOff').hasClass('active')? 1 : 0 ;
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

function switchRecurrSlotCreation(mode){
    
//    console.log(document.getElementById('startAssocSlot').value);
    
    if(mode == 'one'){
        
        $('#hebdoCreate').collapse('hide');
        $('#monthCreate').collapse('hide');
        $('#btnOneCreate').addClass('active');
        $('#btnHebdoCreate').removeClass('active');
        $('#btnMonthCreate').removeClass('active');
        
        document.getElementById('endAssocSlot').value = document.getElementById('startAssocSlot').value;
        document.getElementById('endAssocSlot').disabled = true;
        $('#endAfterCreateSlot').addClass('d-none');
        
    } else if (mode == 'hebdo'){
        
        $('#hebdoCreate').collapse('show');
        $('#monthCreate').collapse('hide');
        $('#btnOneCreate').removeClass('active');
        $('#btnHebdoCreate').addClass('active');
        $('#btnMonthCreate').removeClass('active');
        
        document.getElementById('endAssocSlot').value = '';
        document.getElementById('endAssocSlot').disabled = false;
        $('#endAfterCreateSlot').removeClass('d-none');
         
        
    } else if (mode == 'mois'){
        
        $('#hebdoCreate').collapse('hide');
        $('#monthCreate').collapse('show');
        $('#btnOneCreate').removeClass('active');
        $('#btnHebdoCreate').removeClass('active');
        $('#btnMonthCreate').addClass('active');
        document.getElementById('endAssocSlot').value = '';
        document.getElementById('endAssocSlot').disabled = false;
        $('#endAfterCreateSlot').removeClass('d-none');

        
    } else if (mode == "tout"){
        $('#hebdoCreate').collapse('hide');
        $('#monthCreate').collapse('hide');
        $('#btnOneCreate').removeClass('active');
        $('#btnHebdoCreate').removeClass('active');
        $('#btnMonthCreate').removeClass('active');
        document.getElementById('endAssocSlot').value = '';
        document.getElementById('endAssocSlot').disabled = false;
        $('#endAfterCreateSlot').removeClass('d-none');

    }
}

$('#startAssocSlot').keyup(function(){
    if($('#btnOneCreate').hasClass('active')){
        document.getElementById('endAssocSlot').value = document.getElementById('startAssocSlot').value;
    }
});


function resetCreateAssoc(){
    document.getElementById('btnAddTech').innerHTML = 'Technicien';
    document.getElementById('btnAddTech').dataset.id = '';
    $('#btnAddTech').addClass('btn-outline-secondary');
    $('#btnAddTech').removeClass('btn-secondary');
    
    document.getElementById('btnAddSlot').innerHTML = 'Créneaux';
    document.getElementById('btnAddSlot').dataset.id = '';
    $('#btnAddSlot').addClass('btn-outline-secondary');
    $('#btnAddSlot').removeClass('btn-secondary');
    
    document.getElementById('startAssocSlot').value = '';
    
    switchRecurrSlotCreation('one');
    
    $('.daysButtonCreate').removeClass('active');
    
    document.getElementById('dayMonthCreate').value = '';
    document.getElementById('repeatMonthCreate').value = '';
    document.getElementById('endAssocSlot').value = '';
    document.getElementById('repeatAssocSlot').value = '';
       
}

$('#endAssocSlot').change(function(){
   
   if(document.getElementById('endAssocSlot').value != ''){
       
       $('#repeatAssocSlot').val('');
       $('#spanRepeatAssocSlot1').removeClass('h5');
       $('#spanRepeatAssocSlot1').addClass('text-muted pt-1');
       $('#spanRepeatAssocSlot2').removeClass('h5');
       $('#spanRepeatAssocSlot2').addClass('text-muted pt-1');
       
       $('#spanEndAssocSlot').addClass('h5');
       $('#spanEndAssocSlot').removeClass('text-muted pt-1');

       
   } else{
       
       $('#spanRepeatAssocSlot1').addClass('h5');
       $('#spanRepeatAssocSlot1').removeClass('text-muted pt-1');
       $('#spanRepeatAssocSlot2').addClass('h5');
       $('#spanRepeatAssocSlot2').removeClass('text-muted pt-1');
       $('#spanEndAssocSlot').addClass('h5');
       $('#spanEndAssocSlot').removeClass('text-muted pt-1');
   }
    
    
});

$('#repeatAssocSlot').keyup(function(){

    if(document.getElementById('repeatAssocSlot').value != ''){
        
       $('#endAssocSlot').val('');
       $('#spanEndAssocSlot').removeClass('h5');
       $('#spanEndAssocSlot').addClass('text-muted pt-1');
       $('#spanRepeatAssocSlot1').addClass('h5');
       $('#spanRepeatAssocSlot1').removeClass('text-muted pt-1');
       $('#spanRepeatAssocSlot2').addClass('h5');
       $('#spanRepeatAssocSlot2').removeClass('text-muted pt-1');
       
      
       
   } else{
       
       $('#spanEndAssocSlot').addClass('h5');
       $('#spanEndAssocSlot').removeClass('text-muted pt-1');
       $('#spanRepeatAssocSlot1').addClass('h5');
       $('#spanRepeatAssocSlot1').removeClass('text-muted pt-1');
       $('#spanRepeatAssocSlot2').addClass('h5');
       $('#spanRepeatAssocSlot2').removeClass('text-muted pt-1');
       
       
   }
    
});





function createSlotAssoc(){

    $('#createErrorResult').collapse('hide');
    
    var idTech = document.getElementById('btnAddTech').dataset.id;
    var idSlot = document.getElementById('btnAddSlot').dataset.id;
    
    var start = document.getElementById('startAssocSlot').value;
    console.log(start);
    var one = $('#btnOneCreate').hasClass('active');
    var hebdo = $('#btnHebdoCreate').hasClass('active');
    var month = $('#btnMonthCreate').hasClass('active');
    
    var workingDays = $('.daysButtonCreate');
    var workingDaysArray = [];
    
    for (var i = 0; i < workingDays.length; i++) {
        if(workingDays[i].classList.contains('active')){
            workingDaysArray.push(workingDays[i].innerHTML);
        }
    }
    var dateStart = new Date(start);
    var today = new Date();
    var dd = today.getDate();

    var mm = today.getMonth()+1; 
    var yyyy = today.getFullYear();
    if(dd<10) 
    {
        dd='0'+dd;
    } 

    if(mm<10) 
    {
        mm='0'+mm;
    } 
    today = yyyy+'-'+mm+'-'+dd;
 
    
    var dayMonthCreate = document.getElementById('dayMonthCreate').value;
    var repeatMonthCreate = document.getElementById('repeatMonthCreate').value;
    
    var endAssocSlot = document.getElementById('endAssocSlot').value;
    var repeatAssocSlot = document.getElementById('repeatAssocSlot').value;
    var mode = '';
    
    var flag = 0;
    var errors = [];
    
    if(idSlot == ''){
        flag = 1;
        errors.push('Merci de choisir un créneau');
    }
    if(idTech == ''){
        flag = 1;
        errors.push('Merci de choisir un technicien');
    }
    if(start == '' && (dateStart < today)){
        flag = 1;
        errors.push('Merci de choisir une date de début supérieure à la date du jour.');
    }
    if (hebdo){
        mode = 'hebdo';
        if(workingDaysArray.length == 0){
            flag = 1;
            errors.push('Merci de renseigner des jours de répétition hebdomadaire');
        }
    } else if (month){
        mode = 'month'; 
        if(dayMonthCreate == '' || !isNumber(dayMonthCreate)){
            flag = 1;
            errors.push('Merci de renseigner un jours de répétition mensuel');
        }
        if(repeatMonthCreate == '' || !isNumber(dayMonthCreate)){
            flag = 1;
            errors.push('Merci de renseigner un nombre de répétition mensuel.');
        }
    } else if (one){
        mode = 'one';
        
    }else if (!one && !hebdo && !month){
        flag = 1;
        errors.push('Merci de renseigner selectionner un mode de répétition');
    }
    if($('#spanEndAssocSlot').hasClass('h5')){
        if(endAssocSlot == '' && !checkDate('date', start, endAssocSlot)){
            flag = 1;
            errors.push('Merci de renseigner une date de fin à la série en cours de création supérieure à la date de début');
        }
        
    } else if ($('#spanRepeatAssocSlot').hasClass('h5')){
        if(repeatAssocSlot > 20 || repeatAssocSlot == ''){
            flag = 1;
            errors.push('Merci de renseigner un nombre de répétition à la série en cours de création entre 1 et 20');
        }
    }
    
    if (flag == 1){
        $("#loaderCreate").addClass('d-none');
        displayAlert('alertSearchOrCreate','danger',errors.join('<br>'));
       
    } else{
//        console.log(idTech, idSlot, start, one, hebdo, month, workingDaysArray, dayMonthCreate, repeatMonthCreate, endAssocSlot, repeatAssocSlot);
        
        $.ajax({
            url: "ajax/planning/addSlotAssoc.php", 
            type: "POST", 
            data: {
                idTech : idTech, 
                idSlot : idSlot, 
                start : start, 
                mode : mode, 
                workingDaysArray : workingDaysArray, 
                dayMonthCreate : dayMonthCreate, 
                repeatMonthCreate : repeatMonthCreate, 
                endAssocSlot : endAssocSlot, 
                repeatAssocSlot : repeatAssocSlot
            }, 
            async : false,
            beforeSend: function (){
                
                console.log('just before the ajax');
                
            },
            success: function(retour){
                if (retour['ok'] == 'ok'){
                    displayAlert('alertSearchOrCreate','success','Les créneaux ont bien été créés. <br> Une liste des erreurs bloquantes ou non est disponible ci-dessous.')

                    $('#createAssocSlot').collapse('hide');
                    
                    document.getElementById('createErrorResult').innerHTML = '';
                    
                    if(retour['flag'].length > 0){
                        var color = '';
                        for (i=0; i<retour['flag'].length;i++){

                            if(retour['flag'][i] == "W"){
                                color = "orange";

                            }else if (retour['flag'][i] == "D"){
                                color = 'red'; 
                            }
                            document.getElementById('createErrorResult').innerHTML += '<span style="color:'+color+'">'+ retour['error'][i]+'</span><br><br>';
                        }
                        $('#createErrorResult').collapse('show');
                    }
                    
                    $('#noSearchNorCreate').collapse('hide');
                }
            }
        });
        
         
    }

   
};

function checkDate(mode, start, end){
    
    var flag = 0;
    
    if(start == ''){
        flag = 1;
        return false;
    }else if (end == ''){
        flag = 1; 
        return false;
    }else if (mode == 'time' && flag == 0){
        var timeStart  = start.split(':');
        var timeEnd = end.split(':');
        if(timeStart[0] > timeEnd[0]){
            return false;
        } else if(timeStart[0] < timeEnd[0]){
            return true;
        } else if (timeStart[0] == timeEnd[0]){
            if(timeStart[1] > timeEnd[1]){
                return false;
            } else if(timeStart[1] == timeEnd[1]){
                return false;
            } else if (timeStart[1] < timeEnd[1]){
                return true;
            }
        }
    } else if (mode == 'date'&& flag == 0){
        var dateStart  = start.split('-');
        var dateEnd = end.split('-');
        if(timeStart[0] > timeEnd[0]){
            return false;
        } else if(timeStart[0] < timeEnd[0]){
            return true;
        } else if (timeStart[0] == timeEnd[0]){
            if(timeStart[1] > timeEnd[1]){
                return false;
            } else if(timeStart[1] < timeEnd[1]){
                return true;
            } else if (timeStart[1] == timeEnd[1]){
                if(timeStart[2] > timeEnd[2]){
                    return false;
                } else if(timeStart[2] < timeEnd[2]){
                    return true;
                } else if (timeStart[2] == timeEnd[2]){
                    return false;
                }
            }
        }
    }
}

function switchTech(id){
    var tr = document.getElementById('trTech_'+id);
    var name = document.getElementById('techName_'+id).innerHTML;
    var surname = document.getElementById('techSurname_'+id).innerHTML;
    var color = document.getElementById('techColor_'+id).value;
    
    tr.innerHTML = '';
    
    $.ajax({
        url: "ajax/planning/loadInputModifTech.php", 
        type: "POST", 
        data: {
           
            name : name,
            surname : surname,
            color : color,
            id : id
        }, 
        async : false,
        success: function(retour){
            tr.innerHTML = retour;
        }
    });
}

function resetModifTech(id){
    
    var tr = document.getElementById('trTech_'+id);
    

    $.ajax({
        url: "ajax/planning/resetTech.php", 
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

function modifTech(id){
    
    var flag = 0;
    var errors = [];

    var tr = document.getElementById('trTech_'+id);
    var name = document.getElementById('techName_'+id).innerHTML;
    var surname = document.getElementById('techSurname_'+id).value;
    var color = document.getElementById('techColor_'+id).value;   
        
    
    $.ajax({
        url: "ajax/planning/modifTech.php", 
        type: "POST", 
        data: {
            surname : surname,
            name : name,
            color : color,
            id : id
        }, 
        async : false,
        success: function(retour){
           
            tr.innerHTML = retour;
            displayAlert('alertTech','success','Les modifications ont été enregistrées.');
           
        }
    });
    
}