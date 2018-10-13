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
    var infoChart;
    var infoPieChart;
    switch(value) {
    case 'all':
        couleur = '#999999';
        infoChart = 'Répartition des versions';
        infoPieChart = 'Répartition de l\'activité';
        break;
    case 'v6':
        couleur = '#f6e18b';
        infoChart = 'Répartition des v6';
        infoPieChart = 'Répartition de l\'activité';
        break;
    case 'v7':
        couleur = '#87cdf1';
        infoChart = 'Répartition des v7';
        infoPieChart = 'Répartition de l\'activité';
        break;
    case 'v8':
        couleur = '#cacaca';
        infoChart = 'Répartition des v8';
        infoPieChart = 'Répartition de l\'activité';
        break;
    case 'ris':
        couleur = '#dc3545';
        infoChart = 'Répartition des RIS';
        infoPieChart = 'Répartition des versions majeures';
        break;
    case 'pacs':
        couleur = '#28a745';
        infoChart = 'Répartition des PACS';
        infoPieChart = 'Répartition des versions majeures';
        break;
    case 'rispacs':
        couleur = '#17a2b8';
        infoChart = 'Répartition des RIS/PACS';
        infoPieChart = 'Répartition des versions majeures';
        break;
    case 'none':
        couleur = '#f8f9fa';
        infoChart = 'Clients sans activité renseignée';
        infoPieChart = 'Répartition des versions majeures';
        break;
}

    $.ajax({
        method: "GET",
        url: "ajax/initChart.php?search="+value+"&type="+type,
        dataType : "JSON",
        async: false,
        success: function(retour) {
            $('#lineChart').remove();
            $('#lineChartArea').html('<canvas id="lineChart"></canvas>');
            $('#infoChart').html(infoChart);
            demo.initDashboardPageCharts(retour['line'], couleur);
            
            $('#flot-pie-chart').remove();
            $('#pieChartArea').html('<div class="flot-chart-content" id="flot-pie-chart" style="height: 150px;"></div>');
            $('#infoPieChart').html(infoPieChart); 
            pieChart(retour['pie']);
        }
    });   

    $('#addonsDiv').css('visibility', 'visible');

    
   
    
    
}
            