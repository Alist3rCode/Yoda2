<?php
session_start();

header('Content-Type: text/html; charset=utf-8');
require 'class/Autoloader.php';
Autoloader::register();

$bdd = new Database('yoda');
$bdd2 = new Database('ecsupgrader');

require_once('./class/checkCookie.php');
checkCookie($bdd, 'yoda.php');

require_once('./class/checkRights.php');
$right = checkRights($bdd, $_SESSION['id_user']);
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
        <title>Clients - Y.O.D.A. <?php
            $res = $bdd->queryObj('SELECT * FROM CFG_CONFIG');
            echo ' v' . $res[0]->CFG_VERSION;
            ?></title>


        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!--Fontawesome CSS-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

        <!--CSS Perso-->
        <link rel="stylesheet" href="public/css/yoda-mobile.css">
        <link rel="stylesheet" href="public/css/yoda.css">

        <?php require 'public/checkTheme.php'; ?>        
        <link rel="stylesheet" href="public/css/flip.css">
        <link rel="stylesheet" href="public/css/modale.css">
        <link rel="stylesheet" href="public/css/tags.css">
        <link rel="stylesheet" href="public/css/phones.css">
        <link rel="stylesheet" href="public/css/filters.css">
        <!--<link rel="icon" type="image/png" href="./public/img/yodaTitle.png" />-->

        <!--Add Jquery-->
        <script  src="https://code.jquery.com/jquery-3.2.1.js"  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="   crossorigin="anonymous"></script>


    </head>
    <body ontouchend="upHandler()">
        <?php
        $rightTV = 'd-none';
        ?>
        <div id='idUser' class="d-none"><?= $_SESSION['id_user'] ?></div>

        <div class="content">

            <?php
            require 'public/navbar.php';
            require 'public/sidebar2.php';
//            require 'public/infoClient.php';
            ?>

            <div class="clients" id="clients"> 
                <?php foreach ($bdd->query('SELECT * FROM YDA_CLIENT WHERE CLI_VALID = 1 ORDER BY CLI_VILLE ASC, CLI_NOM ASC', 'Clients') as $clients): ?>

                    <div class="vignette <?= $clients->CLI_VERSION ?> flip-container" id="vignette_<?= $clients->CLI_ID ?>" data-activity='<?= $clients->CLI_RIS ?>,<?= $clients->CLI_PACS ?>' data-version="<?= $clients->CLI_VERSION ?>" ontouchstart="downHandler(<?= $clients->CLI_ID ?>)">
                        <div class="contenu_vignette flipper">
                            <div class="front">
                                <a href="<?= $clients->urlProd() ?>" target="_blank" id="vign_url_<?= $clients->CLI_ID ?>">
                                    <div class="infoClient">
                                        <p class="ville <?= $clients->CLI_VERSION ?>"><?= $clients->CLI_VILLE ?></p>

                                        <p class="nom"><?= $clients->CLI_NOM ?></p>
                                    </div>
                                </a>

                                <div class="tag hideInMobile">
    <?= $clients->formatedTag ?>

                                </div>

                                <div class="version hideInMobile">
                                    <hr class="hr" >
                                    <span class="spanVersion">

    <?= $clients->CLI_NUM_VERSION ?>

                                    </span> 
                                </div>                     
                            </div>
                            <div class="back">
                                <div class="infoClientBack" style="top:0;">
                                    <p class="villeBack <?= $clients->CLI_VERSION ?>"><?= $clients->CLI_VILLE ?></p>

                                    <p class="nomBack"><?= $clients->CLI_NOM ?></p>
                                </div>
    <?php if (in_array("rgt_cod_database", $right)): ?>
                                    <div class="backBtn" id="databaseButton_<?= $clients->CLI_ID ?>">
                                        <a href="<?= $clients->urlSqlProd() ?>" target="_blank"><i class="fas fa-database"></i></a>
                                    </div>
    <?php endif; ?>

                                <div class="backBtn" onclick="modif(<?= $clients->CLI_ID ?>)" data-toggle="modal" data-target="#modaleClient" >
                                    <i class="far fa-file-alt"></i>
                                </div>

                                <div class="backBtn phoneIconLink" onclick="displayPhones(<?= $clients->CLI_ID ?>)">
                                    <i class="far fa-building"></i>
                                </div>

                                <div class="backBtn" data-toggle="tooltip" data-html="true"  data-id="<?= $clients->CLI_ID ?>" data-placement="bottom" data-title="test">
                                    <i class="fas fa-code-branch"></i>
                                </div>
                            </div>
                        </div>
                    </div>



<?php endforeach; ?>


            </div>
        </div>
        <div class="modal fade " id="modaleClient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
<?php require 'public/modale/modaleClient.php'; ?>
        </div>
        <div class="modal fade" id="ModaleFilter" tabindex="-1" role="dialog" aria-labelledby="filterModale" aria-hidden="true">
            <?php require "public/modale/filterModale.php"; ?>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="./public/js/yoda_style.js"></script>
        <script src="./public/js/displayAlert.js"></script>
        <script src="./public/js/yoda_action.js"></script>
        <script src="./public/js/searchBar.js"></script>
        <script src="./public/js/displayPhones.js"></script>
        <script src="./public/js/filters.js"></script>
        <script src="./public/js/tooltip.js"></script>


    </body>

</html>