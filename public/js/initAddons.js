/* global demo */

function initAddons(type, value){
    $.ajax({
        method: "GET",
        url: "ajax/CreateXML.php?search="+value,
        dataType : "JSON",
        async: false,
        success: function(json) {
        }
    });                

    initMap(type);

    $.ajax({
        method: "GET",
        url: "ajax/initChart.php?search="+value+"&type="+type,
        dataType : "JSON",
        async: false,
        success: function(json) {
        }
    });   


    demo.initDashboardPageCharts();

    $('#addonsDiv').css('visibility', 'visible');
//    $('#addonsDiv').removeClass('d-flex');
    
   
    
    
}
            