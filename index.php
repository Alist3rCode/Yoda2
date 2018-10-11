<?php
header('Content-Type: text/html; charset=utf-8');
require 'class/Autoloader.php';
Autoloader::register();

$bdd = new Database('yoda');
$bdd2 = new Database('ecsupgrader');

require 'public/dashboard.php';
?>

<!doctype html>
<html lang="en">
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
        <link rel="stylesheet" href="public/css/flip.css">
        <link rel="stylesheet" href="public/css/modale.css">
        <link rel="stylesheet" href="public/css/tags.css">
        <link rel="stylesheet" href="public/css/phones.css">
        <link rel="stylesheet" href="public/css/filters.css">
        
        <!--Add Jquery-->
        <script  src="https://code.jquery.com/jquery-3.2.1.js"  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="   crossorigin="anonymous"></script>


    </head>
    <body>
        <?php
        $rightTV = 'd-none';
        ?>
        <div id='rightTV' class="d-none"><?=$rightTV?></div>
        <div id='idUser' class="d-none">1</div>
        <div id="filter" class="d-none" >none</div>
        
        <div class="content">
            
            <?php 
            require 'public/navbar2.php';
            require 'public/sidebar2.php';
            ?>
            
            <div class="clients">
                
                <div class="col-md-3 mt-3">
                    <div class="card">
                        <div class="card-header text-left" style="background-image: url('public/img/v7_dashboard_dark.png');background-position:right;color:white;padding-left: 60px;">
                            <span class="card-title"><span class="display-4"><?=$selectAll[0]->Nb?></span> Clients</span>

                        </div>
                        <div class="card-footer text-muted text-center">
                            <p class="card-text"><?=$selectAllSite[0]->Nb?> Sites</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mt-3">
                    <div class="card">
                        <div class="card-header text-left" style="background-image: url('public/img/v6_dashboard_dark.png');color:white;padding-left: 60px;">
                            <span class="card-title"><span class="display-4"><?=$selectV6[0]->Nb?></span> Clients</span>

                        </div>
                        <div class="card-footer text-muted text-center">
                            <p class="card-text"><?=$selectV6Site[0]->Nb?> Sites</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mt-3">
                    <div class="card">
                        <div class="card-header text-left" style="background-image: url('public/img/v7_dashboard_dark.png');color:white;padding-left: 60px;">
                            <span class="card-title"><span class="display-4"><?=$selectV7[0]->Nb?></span> Clients</span>

                        </div>
                        <div class="card-footer text-muted text-center">
                            <p class="card-text"><?=$selectV7Site[0]->Nb?> Sites</p>
                        </div>
                    </div>
                </div>
                
                   <div class="col-md-3 mt-3">
                    <div class="card">
                        <div class="card-header text-left" style="background-image: url('public/img/v8_dashboard_dark.png');color:white;padding-left: 60px;">
                            <span class="card-title"><span class="display-4"><?=$selectV8[0]->Nb?></span> Clients</span>

                        </div>
                        <div class="card-footer text-muted text-center">
                            <p class="card-text"><?=$selectV8Site[0]->Nb?> Sites</p>
                        </div>
                    </div>
                </div>
                
                
                
                
                
            </div>      
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="./public/js/yoda_style.js"></script>
        <script src="./public/js/yoda_action.js"></script>
        <script src="./public/js/searchBar.js"></script>
        <script src="./public/js/displayPhones.js"></script>
        <script src="./public/js/filters.js"></script>
        
        
    </body>

</html>