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
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
         
        <!--Fontawesome CSS-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

        <!--CSS Perso-->

        <link rel="stylesheet" href="public/css/yoda.css">
        <link rel="stylesheet" href="public/css/bubble.css">

    </head>
    <body>
        
        
        <div class="content">
            
            <?php 
            require 'public/menu.php';
            require 'public/sidebar.php';
            ?>
            
            <div class="clients"> 
                <?php
              

                foreach($db->query('SELECT * FROM YDA_CLIENT WHERE CLI_VALID = 1 ORDER BY CLI_VILLE', 'Clients') as $clients):?>

                <div class="vignette">
                    <!--<a href="<?=$clients->CLI_URL?>" target="_blank">-->
                        <div class="contenu_vignette">
                            <div class="infoClient">
                                <p><?=$clients->CLI_VILLE?></p>
                                <br>
                                <p><?=$clients->CLI_NOM?></p>
                            </div>
                            <div class="tag">
                            <?= $clients->formatedTag()?>
        
                            </div>
                            
                            <div class="version">
                                <!--<a href="plop.com">-->
                                    <hr class="my-4">
                                    <span>
                                        <?=$clients->CLI_NUM_VERSION?>
                                    </span> 
                                <!--</a>-->
                            </div>                     

                        </div>
                    <!--</a>-->
                        <div class="linkedIn subBall ">
                            <i class="bubble fab fa-linkedin-in"></i>
                        </div>
                        <div class="facebook subBall ">
                            <i class="bubble fab fa-facebook-f"></i>
                        </div>
                        <div class="twitter subBall ">
                            <i class="bubble fab fa-twitter"></i>
                        </div> 
                        <div class="github subBall ">
                            <i class="bubble fab fa-github"></i>
                        </div> 
                </div>
                

                <?php endforeach; ?>
            </div>
        </div>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="./public/js/yoda_style.js"></script>
        
    </body>

</html>