<?php
session_start();

header('Content-Type: text/html; charset=utf-8');
require 'class/Autoloader.php';
Autoloader::register();

$bdd = new Database('yoda');
$bdd2 = new Database('ecsupgrader');

require_once('./class/checkCookie.php');
checkCookie($bdd,'index.php');


require 'public/dashboard.php';
?>

<!doctype html>
<html lang="fr">
    <head>
        
        <!-- Required meta tags -->
        <meta charset="utf-8">
        
        
        
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
         
        <!--Fontawesome CSS-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

        <!--CSS Perso-->

        <link rel="stylesheet" href="public/css/yoda.css">
        <?php require 'public/checkTheme.php'; ?>        
        <link rel="stylesheet" href="public/css/dashboard.css">
        <link rel="stylesheet" href="public/css/filters.css">
                <!--<link rel="icon" type="image/png" href="./public/img/yodaTitle.png" />-->

        
        <!--Add Jquery-->
        <script  src="https://code.jquery.com/jquery-3.2.1.js"  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="   crossorigin="anonymous"></script>


    </head>
    <body>
        
        <div id='idUser' class="d-none"><?=$_SESSION['id_user']?></div>
        
        
        <div class="content">
            
            <?php 
            require 'public/navbar2.php';
            require 'public/sidebar2.php';
            ?>
            
            <div class="clients">
                <!--Version-->
                <div class="col-md-3 mt-3">
                    <a onclick="initAddons('version','all')" <?=$disableAll?>>
                        <div class="card" >
                            <div class="card-header text-left cardDashboard cardAll" >
                                <span class="card-title"><span class="display-4"><?=$selectAll[0]->Nb?></span> Clients</span>

                            </div>
                            <div class="card-footer text-muted text-center">
                                <p class="card-text"><?=$selectAllSite[0]->Nb?> Sites</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-md-3 mt-3">
                    <a onclick="initAddons('version','v6')" <?=$disablev6?>>
                        <div class="card">
                            <div class="card-header text-left cardDashboard cardv6">
                                <span class="card-title"><span class="display-4"><?=$selectV6[0]->Nb?></span> Clients</span>

                            </div>
                            <div class="card-footer text-muted text-center">
                                <p class="card-text"><?=$selectV6Site[0]->Nb?> Sites</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-md-3 mt-3">
                    <a onclick="initAddons('version','v7')" <?=$disablev7?>>
                        <div class="card">
                            <div class="card-header text-left cardDashboard cardv7" >
                                <span class="card-title"><span class="display-4"><?=$selectV7[0]->Nb?></span> Clients</span>

                            </div>
                            <div class="card-footer text-muted text-center">
                                <p class="card-text"><?=$selectV7Site[0]->Nb?> Sites</p>
                            </div>

                        </div>
                    </a> 
                </div>
                <div class="col-md-3 mt-3">
                    <a onclick="initAddons('version','v8')" <?=$disablev8?>>
                        <div class="card">
                            <div class="card-header text-left cardDashboard cardv8" >
                                <span class="card-title"><span class="display-4"><?=$selectV8[0]->Nb?></span> Clients</span>

                            </div>
                            <div class="card-footer text-muted text-center">
                                <p class="card-text"><?=$selectV8Site[0]->Nb?> Sites</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <!--Activité-->
                
                <div class="col-md-3 mt-3">
                    <a onclick="initAddons('activity','ris')" <?=$disableRis?>>
                        <div class="card">
                            <div class="card-header text-left cardDashboard cardRis" >
                                <span class="card-title"><span class="display-4"><?=$selectRis[0]->Nb?></span> Clients</span>

                            </div>
                            <div class="card-footer text-muted text-center">
                                <p class="card-text"><?=$selectRisSite[0]->Nb?> Sites</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mt-3">
                    <a onclick="initAddons('activity','pacs')" <?=$disablePacs?>>
                        <div class="card">
                            <div class="card-header text-left cardDashboard cardPacs" >
                                <span class="card-title"><span class="display-4"><?=$selectPacs[0]->Nb?></span> Clients</span>

                            </div>
                            <div class="card-footer text-muted text-center">
                                <p class="card-text"><?=$selectPacsSite[0]->Nb?> Sites</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mt-3">
                    <a onclick="initAddons('activity','rispacs')" <?=$disableRisPacs?>>
                        <div class="card">
                            <div class="card-header text-left cardDashboard cardRisPacs" >
                                <span class="card-title"><span class="display-4"><?=$selectRisPacs[0]->Nb?></span> Clients</span>

                            </div>
                            <div class="card-footer text-muted text-center">
                                <p class="card-text"><?=$selectRisPacsSite[0]->Nb?> Sites</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mt-3">
                    <a onclick="initAddons('activity','none')" <?=$disableNone?>>
                        <div class="card">
                            <div class="card-header text-left cardDashboard cardNone" >
                                <span class="card-title"><span class="display-4"><?=$selectNone[0]->Nb?></span> Clients</span>

                            </div>
                            <div class="card-footer text-muted text-center">
                                <p class="card-text"><?=$selectNoneSite[0]->Nb?> Sites</p>
                            </div>
                        </div>
                    </a>
                </div>
                <!--map-->
                <div class="col-md-12" id="addonsDiv" style="display:flex;visibility: hidden">
                    <div class="col-md-6" style="padding-left:0;">
                        <div id="map" class="card mt-3 " style="height: 450px;"></div>
                    </div>
                
                    <div class="col-md-6 mt-3 align-items-stretch d-flex flex-row flex-wrap justify-content-between" style="height: 450px;padding-right:0;">
                        <div class="col-md-6" style="height: 50%;padding-left:0;">
                            <div class="card" >
                                <div class="card-body">
                                    <div class="chart-area" id='lineChartArea'>
                                        <canvas id="lineChart"></canvas>
                                    </div>
                                    <div class=" text-muted text-center">
                                        <p class="card-text" id="infoChart"></p>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                        <div class="col-md-6" style="height: 50%;padding-right:0">
                            <div class="card" >
                                <div class="card-body">
                                    <div class="chart-area" id="pieChartArea">
  
                                        <div class="flot-chart-content" id="flot-pie-chart" style="height: 150px;"></div>
          
                                    </div>
                                    <div class=" text-muted text-center">
                                        <p class="card-text" id="infoPieChart"></p>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                        <div class="col-md-12 mt-3" style="height: 50%;padding:0;">
                            <div class="card" >
                                <div class="card-body text-center text-muted">
                                    <a href='yoda.php'>Accéder aux clients</a>
                                </div>
                            </div>                            
                        </div>
                        
                    </div>
                </div>
                
                
                
            </div>      
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCo_lLa3e8UeMBQdc6EYS5Wbw7udYxl3_o"></script>

        <!--Flot chart JS-->
        <script src="./public/js/flot/excanvas.min.js"></script>
        <script src="./public/js/flot/jquery.flot.js"></script>
        <script src="./public/js/flot/jquery.flot.pie.js"></script>
        <script src="./public/js/flot/jquery.flot.resize.js"></script>
        <script src="./public/js/flot/jquery.flot.time.js"></script>
        <script src="./public/js/flot-tooltip/jquery.flot.tooltip.min.js"></script>
        
        <script src="./public/js/chartjs.min.js"></script>
        <script src="./public/js/yoda_style.js"></script>
        <script src="./public/js/yoda_action.js"></script>
        <script src="./public/js/searchBar.js"></script>
        <script src="./public/js/displayPhones.js"></script>
        <script src="./public/js/filters.js"></script>
        <script src="./public/js/maps.js"></script>
        <script src="./public/js/chartIndex.js"></script>
        <script src="./public/js/initAddons.js"></script>
        <script src="./public/js/displayAlert.js"></script>

       
       
                     
    </body>

</html>