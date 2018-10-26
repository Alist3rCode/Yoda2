
function displayModaleConfig(){

    $.ajax({
       url: 'ajax/loadModaleConfigPlanning.php',
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
    
    
$('.searchTech').click(function(){
   
   var techName = $(this).html();
   $('#btnTech').html(techName);
    
});

$('.searchSlot').click(function(){
   
   var slotName = $(this).html();
   $('#btnSlot').html(slotName);
    
});

$('.createTech').click(function(){
   
   var techName = $(this).html();
   $('#btnAddTech').html(techName);
    
});

$('.createSlot').click(function(){
   
   var slotName = $(this).html();
   $('#btnAddSlot').html(slotName);
    
});


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
    
    $.post("ajax/savePlanningTime.php",
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