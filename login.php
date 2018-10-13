<?php
session_start();

header('Content-Type: text/html; charset=utf-8');
require('class/Autoloader.php');
Autoloader::register();

$bdd = new Database('yoda');
$bdd2 = new Database('ecsupgrader');

require('public/dashboard.php');
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
        <link rel="stylesheet" href="public/css/dark.css">         
        <link rel="stylesheet" href="public/css/login.css">
        <link rel="stylesheet" href="public/css/filters.css">
        
        <!--Add Jquery-->
        <script  src="https://code.jquery.com/jquery-3.2.1.js"  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="   crossorigin="anonymous"></script>

    </head>
    <body>
        <div class="content">
            <?php 
            require 'public/navbar2.php';
            ?>
                
            <div class=" mx-auto login">
                <div class="card-header headLogin">
                    Vous enregistrer vous devez...
                </div>
                <div class="card-body cardInput" style="background-color:#f7f7f7">
                    <div class="d-flex">

                        <span class="iconLogin"><i class="fas fa-at"></i></span>
                        <input class="loginInput" id="inputEmail" type="email" placeholder="Adresse eMail">
                    </div>
                    <div class="d-flex">

                        <span class="iconLogin"><i class="fas fa-unlock-alt"></i></span>
                         <input class="loginInput" id="inputPassword" type="password" placeholder="Mot de Passe"> 
                    </div>
                    <a class="btn btn-success btn-block" id="login">Connexion</a>

                    <div class="text-center">
                        <button type="button"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal" style="margin-top:10px;">Rejoindre YODA</button>

                   </div>
                    <div class="text-center">

                         <button type="button"  class="btn btn-warning btn-sm" data-toggle="modal" data-target="#forgetModal" style="margin-top:10px;">Mot de Passe oublié</button>
                    </div>
                    <div id='alertSlideUp' class="alert d-none text-center" style="margin-top:15px;"></div>

                </div>
            </div>
            <!-- Modal Create-->
            <div class="modal fade " id="createModal" tabindex="-1" role="dialog">
              <?php require 'public/modale/modaleCreateAccount.php'?>
            </div>

            <!-- Forget Modal -->
            <div class="modal fade" id="forgetModal" tabindex="-1" role="dialog" aria-hidden="true">
              <?php require 'public/modale/modaleForgetPassword.php'?>
            </div>

            <!-- New password Modal -->
            <div class="modal fade" id="newPasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
              <?php require 'public/modale/modaleChangePassword.php'?>
            </div>
        </div>      
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="./public/js/login/login.js"></script>
        <script src="./public/js/displayAlert.js"></script>
                     
    </body>

</html>