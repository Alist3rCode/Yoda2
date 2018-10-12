/* global demo */

function initAddons(type, value){
    $.ajax({
        method: "GET",
        url: "ajax/CreateXML.php?search="+value,
        dataType : "JSON",
        async: false,
        success: function() {
            
        }
    });                
    initMap(type);
    
    var couleur;
    switch(value) {
    case 'all':
        couleur = '#999999';
        break;
    case 'v6':
        couleur = '#f6e18b';
        break;
    case 'v7':
        couleur = '#87cdf1';
        break;
    case 'v8':
        couleur = '#cacaca';
        break;
    case 'ris':
        couleur = '#dc3545';
        break;
    case 'pacs':
        couleur = '#28a745';
        break;
    case 'rispacs':
        couleur = '#17a2b8';
        break;
    case 'none':
        couleur = '#f8f9fa';
        break;
}

    $.ajax({
        method: "GET",
        url: "ajax/initChart.php?search="+value+"&type="+type,
        dataType : "JSON",
        async: false,
        success: function(retour) {
            $('#lineChart').remove();
            $('#lineChartArea').html('<canvas id="lineChart"></canvas>')
            demo.initDashboardPageCharts(retour, couleur);
        }
    });   


    

    $('#addonsDiv').css('visibility', 'visible');

    
   
    
    
}
            