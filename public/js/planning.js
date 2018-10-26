
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