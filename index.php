<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="public/css/yoda.css">
    </head>
    <body>
        
        
        <div class="content">
            <div class="menu">
                <a href="#">Filtre version</a>
                <a href="#">Filtre activité</a>
                <a href="#">Recherche</a>


            </div>
            <div class="sidebar">
                <a href="#">Accueil</a>
                <a href="#">Clients</a>
                <a href="#">Carte</a>
                <a href="#">Lien Interne</a> 
            </div>
            <div class="clients"> 
                <?php
                require 'class/Autoloader.php';
                Autoloader::register();

                $db = new Database('yoda');

                foreach($db->query('SELECT * FROM YDA_CLIENT', 'Clients') as $config):?>

                <div class="vignette">
                    <h2><?=$config->CLI_VILLE?></h2>
                    <br>
                    <h3><?=$config->CLI_NOM?></h3>

                </div>
                <?php // var_dump($config);?>

                <?php endforeach; ?>
            </div>
        </div>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>