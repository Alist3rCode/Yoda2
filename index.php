<?php
header('Content-Type: text/html; charset=iso-8859-1');
require 'class/Autoloader.php';
Autoloader::register();

$db = new Database('yoda');

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
        <link rel="stylesheet" href="public/css/dark.css">
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
            require 'public/navbar.php';
            require 'public/sidebar2.php';
//            require 'public/infoClient.php';
            ?>
            
            <div class="clients" id="clients"> 
                <?php
              

                foreach($db->query('SELECT * FROM YDA_CLIENT WHERE CLI_VALID = 1 ORDER BY CLI_VILLE ASC, CLI_NOM ASC', 'Clients') as $clients):?>

                <div class="vignette <?=$clients->CLI_VERSION?> flip-container" id="vignette_<?=$clients->CLI_ID?>">
                    <div class="contenu_vignette flipper">
                        <div class="front">
                            <a href="<?=$clients->CLI_URL?>" target="_blank" id="vign_url_<?=$clients->CLI_ID?>">
                                <div class="infoClient">
                                    <p class="ville <?=$clients->CLI_VERSION?>"><?=$clients->CLI_VILLE?></p>

                                    <p class="nom"><?=$clients->CLI_NOM?></p>
                                </div>
                            </a>
                            
                                <div class="tag">
                                <?= $clients->formatedTag?>

                                </div>

                                <div class="version">
                                        <hr class="hr" >
                                        <span>

                                            <?=$clients->CLI_NUM_VERSION?>

                                        </span> 
                                </div>                     
                        </div>
                        <div class="back">
                            <div class="infoClientBack">
                                <p class="villeBack <?=$clients->CLI_VERSION?>"><?=$clients->CLI_VILLE?></p>

                                <p class="nomBack"><?=$clients->CLI_NOM?></p>
                            </div>
                            <div class="backBtn">
                                <i class="fas fa-database"></i>
                            </div>
                            <div class="backBtn" onclick="modif(<?=$clients->CLI_ID?>)" data-toggle="modal" data-target="#modaleClient" >
                                <i class="fas fa-pencil-alt" ></i>
                            </div>
                            <div class="backBtn phoneIconLink" onclick="displayPhones(<?=$clients->CLI_ID?>)">
                                <i class="fas fa-phone"></i>
                            </div>

                            <div class="backBtn" data-toggle="tooltip" data-html="true"  data-id="<?=$clients->CLI_ID?>" data-placement="bottom" data-title="test">
                                <i class="fas fa-code-branch"></i>
                            </div>

                        </div>
                    </div>
                    
                    
                </div>
                

                <?php endforeach; ?>
            </div>
        </div>
        <div class="modal fade" id="modaleClient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <?php 
            require 'public/modaleClient.php';
        ?>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="./public/js/yoda_style.js"></script>
        <script src="./public/js/yoda_action.js"></script>
        <script src="./public/js/searchBar.js"></script>
        <script src="./public/js/displayPhones.js"></script>
        
        
    </body>

</html>