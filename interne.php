<?php
session_start();

header('Content-Type: text/html; charset=utf-8');
require 'class/Autoloader.php';
Autoloader::register();

$bdd = new Database('yoda');
$bdd2 = new Database('ecsupgrader');

require_once('./class/checkCookie.php');
checkCookie($bdd,'interne.php');

require_once('./class/checkRights.php');
$right = checkRights($bdd,$_SESSION['id_user']);
    
$selectSection = $bdd->QueryObj('SELECT * FROM INT_SECTION WHERE SEC_VALID = 1');

$selectLink = $bdd->QueryObj('SELECT * FROM INT_LINK WHERE LNK_VALID = 1 ORDER BY LNK_ID_SEC, LNK_ORDER');


?>

<!doctype html>
<html lang="fr">
    <head>
        
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Bookmarks for all the ETMI Customer Application. For RIS and PACS. Internal user Only !">
        <meta name="author" content="Yohann LOPEZ">
        <link rel="icon" type="image/png" href="public/img/yodaTitle.png" />
        <title>Liens Internes - Y.O.D.A. <?php
        $res = $bdd->queryObj('SELECT * FROM CFG_CONFIG');
        echo ' v' . $res[0]->CFG_VERSION;
        ?></title>
       
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
         
        <!--Fontawesome CSS-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

        <!--CSS Perso-->

        <link rel="stylesheet" href="public/css/yoda.css">
        <?php require 'public/checkTheme.php'; ?>        
        <link rel="stylesheet" href="public/css/dashboard.css">
        <link rel="stylesheet" href="public/css/filters.css">
        <link rel="stylesheet" href="public/css/modale.css">
        <link rel="stylesheet" href="public/css/login.css">
        
        <!--Add Jquery-->
        <script  src="https://code.jquery.com/jquery-3.2.1.js"  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="   crossorigin="anonymous"></script>


    </head>
    <body>
        
        <div id='idUser' class="d-none"><?=$_SESSION['id_user']?></div>
        
        
        <div class="content">
            
            <?php 
            require 'public/navbar_interne.php';
            require 'public/sidebar2.php';
            ?>
            
            <div class="clients">
                
                <?php foreach($selectSection as $key=>$value):?>
                   
                <div class="col-md-10 text-center section mb-3 mt-3 mx-auto" style="border-bottom:solid 1px #cacaca;">
                    <h2><?=$value->SEC_NAME?></h2>
                </div>
                <div class="col-md-12 links text-center d-flex flex-row justify-content-around flex-wrap">
                    <?php foreach($selectLink as $keyLink=>$valueLink):
                        if($valueLink->LNK_ID_SEC == $value->SEC_ID):?>
                            <div class="d-flex flex-row align-items-start" id="divLinkParent_<?=$valueLink->LNK_ID?>" data-order="<?=$valueLink->LNK_ORDER?>" data-section="<?=$value->SEC_ID?>">
                                <?php if(in_array("rgt_cod_link", $right)):?>
                                <button class="btn btn-primary buttonModifLinks d-none btnLinkBefore" onclick="moveBefore(<?=$valueLink->LNK_ID?>)">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <?php endif;?>
                                <a id="urlLink_<?=$valueLink->LNK_ID?>" href="<?=$valueLink->LNK_URL?>" target="_blank">
                                    <img id="imgLink_<?=$valueLink->LNK_ID?>" src="public/img/interne/<?= $valueLink->LNK_IMAGE?>" height="100" />
                                    <p id="nameLink_<?=$valueLink->LNK_ID?>"><?=$valueLink->LNK_NAME?></p>
                                </a>
                                <?php if(in_array("rgt_cod_link", $right)):?>
                                <div class="d-flex flex-column">
                                    <button class="btn btn-primary buttonModifLinks btnLinkAfter d-none" onclick="moveAfter(<?=$valueLink->LNK_ID?>)">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                    <button class="btn btn-secondary buttonModifLinks btnLinkModif d-none" onclick="linkEdit(<?=$valueLink->LNK_ID?>)">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    
                                </div>
                                <?php endif;?>
                                
                            </div>
                            
                        <?php endif;?>
                    <?php endforeach;?>
                </div>
                    
                <?php endforeach; ?>
                
                
                
                
                
                <div class="modal fade" id="modaleCreateInternalLink" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <?php require 'public/modale/modaleCreateInternalLink.php';?>
                </div>
                
            </div>      
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="./public/js/yoda_style.js"></script>
        <script src="./public/js/displayAlert.js"></script>
        <script src="./public/js/interne.js"></script>

       
                     
    </body>

</html>