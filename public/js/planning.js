
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