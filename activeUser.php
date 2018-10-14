<?php
session_start();

header('Content-Type: text/html; charset=utf-8');
require 'class/Autoloader.php';
Autoloader::register();

$bdd = new Database('yoda');
$bdd2 = new Database('ecsupgrader');

require_once('./class/checkCookie.php');
checkCookie($bdd,'profil.php');
    
$selectUser = $bdd->queryObj('SELECT * '
        . 'FROM YDA_USERS '
        . 'WHERE USR_ID="' . $_SESSION['id_user'] . '"');
$mail = $selectUser[0]->USR_MAIL;
$profil = $selectUser[0]->USR_PROFIL;
$name = ucfirst($selectUser[0]->USR_FIRST_NAME);
$lastName = ucfirst($selectUser[0]->USR_NAME);
$page = $selectUser[0]->USR_PAGE;
        	
$selectUser = $bdd->queryObj('SELECT * '
        . 'FROM YDA_USERS '
        . 'WHERE USR_ID="' . $_GET['idUser'] . '"');

$mailUser = $selectUser[0]->USR_MAIL;
$nameUser = ucfirst($selectUser[0]->USR_FIRST_NAME);
$lastNameUser = strtoupper($selectUser[0]->USR_NAME);


if($_GET['activeUser'] == 1){
       // destinataire utilisateur
    $toUser  = $mailUser;

    // Sujet
    $subjectUser = 'Activation de votre compte YODA';

    $messageUser = '
    <div>
       <div style="margin:0;">
               <font face="Calibri,sans-serif" size="2">
                       <span style="font-size:11pt;"><p>
                       Bonjour '.$nameUser.' '.$lastNameUser.', 
               </p></span>
               </font>
       </div>
       <div style="margin:0;">
               <font face="Calibri,sans-serif" size="2">
                       <span style="font-size:11pt;"><p>Vous recevez cet eMail car votre compte sur la plateforme YODA a été activé par un administrateur.</p></span>
               </font>
       </div>
       <div style="margin:0;">
               <font face="Calibri,sans-serif" size="2">
                       <span style="font-size:11pt;"><p>
                       Vous pouvez à présent vous connecter en cliquant directement sur ce lien : 
                       <a href="https://maj-imaging.evolucare.com/yoda" target="_blank">https://maj-imaging.evolucare.com/yoda</a>
               <p style="color:red;"><b>Ceci est un mail automatique, merci de ne pas y répondre directement.</b></p>
               </p></span>
               </font>
       </div>
       <div style="margin:0;">
               <font face="Calibri,sans-serif" size="2">
                       <span style="font-size:11pt;"><font color="#595959">Cordialement, </font></span>
               </font>
       </div>
       <div style="margin:0;">
               <font face="Calibri,sans-serif" size="2">
                       <span style="font-size:11pt;">
                               <font color="#595959">
                                       <b>Mail automatique </b>
                               </font>
                               <font color="#595959">
                                       | YODA
                               </font>
                       </span>
               </font>
       </div>
       <div style="margin:0;">
               <font face="Calibri,sans-serif" size="2">
                       <span style="font-size:11pt;">
                               <font color="#595959">
                                       <b>Groupe Evolucare Technologies</b>
                               </font>
                       </span>
               </font>
       </div>
       <div style="margin:0;">
               <font face="Calibri,sans-serif" size="2">
                       <span style="font-size:11pt;"><font color="#595959">290 avenue Galillée, Parc Cézanne 2, Bat G </font></span>
               </font>
       </div>
       <div style="margin:0;">
               <font face="Calibri,sans-serif" size="2">
                       <span style="font-size:11pt;"><font color="#595959">13857 Aix en Provence Cedex 03</font></span>
               </font>
       </div>
       <div style="background-color:white;margin:0;">
               <font face="Calibri,sans-serif" size="2">
                       <span style="font-size:11pt;background-color:white;">
                               <font color="#E36C0A">
                                       <b>Hotline :&nbsp;01.84.86.06.00</b><br>
                                       <b>Mail Support :&nbsp;<a href="mailto:support@imaging.evolucare.com">support@imaging.evolucare.com</a></b>
                               </font>
                               <font color="#1F497D">
                                       &nbsp;
                               </font>
                       </span>
               </font>
       </div>
       <div style="margin:0;">
               <font face="Calibri,sans-serif" size="2">
                       <span style="font-size:11pt;"><img src="https://release-imaging.evolucare.com/upgrade/signatureYoda.png"></span>
               </font>
       </div>
   </div>

    ';
        
    // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
    $headersUser  = 'MIME-Version: 1.0' . "\r\n";
    $headersUser .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    // En-têtes additionnels
    // $headersUser .= 'To: '.ucfirst($user["name"]).' '.strtoupper($user["lastName"]).' <'.$user["mail"].'> '. "\r\n";
    $headersUser .= 'From: YODA <noreply@mailevolucare.pictime.fr>' . "\r\n";

    // Envoi
    mail($toUser, $subjectUser, $messageUser, $headersUser);

    $update = $bdd->prepare('UPDATE YDA_USERS '
            . 'SET USR_CREATE = :create, '
            . 'USR_CHANGE_PASSWORD = :changeMotdePasse , '
            . 'USR_DELETE = :delete '
            . 'WHERE USR_ID = :id');
    $update ->execute(array(
       'id' => $_GET['idUser'],
       'create' => date("Y-m-d H:i:s"),
       'changeMotdePasse' => date("Y-m-d H:i:s"),
       'delete' => $delete
       ));
    	        
    	        
    	        
}else if ($_GET['activeUser'] == 0){
    $update = $bdd->prepare('UPDATE YDA_USERS '
            . 'SET USR_CREATE = :create, '
            . 'USR_CHANGE_PASSWORD = :changeMotdePasse , '
            . 'USR_DELETE = :delete '
            . 'WHERE USR_ID = :id');
    $update ->execute(array(
        'id' => $_GET['idUser'],
        'create' => date("Y-m-d H:i:s"),
        'changeMotdePasse' => date("Y-m-d H:i:s"),
        'delete' => date("Y-m-d H:i:s")
        ));
}
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
                <div class="card mx-auto col-6" style="padding:0px; margin-top:15px;">
                    <div class="card-header" >
                    Activation de l'utilisateur <?=$nameUser?> <?=$lastNameUser?>
                    </div>
                    <div class="card-body mx-auto text-center">
                        <?php if($_GET['activeUser'] == '1'): ?><p class="card-text alert alert-success">L'utilisateur a été correctement activé.</p> <?php endif;?>
                        <?php if($_GET['activeUser'] == '0'): ?><p class="card-text alert alert-danger">L'utilisateur n'a pas été activé.</p> <?php endif;?>
                        <a class="btn btn-primary" id='closeTab'>Fermer l'onglet</a>
                    </div>
                </div>
                
                
                
            </div>      
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script>
        
            $("#closeTab").click(function(evt) {
                window.top.close();

             });
        </script>

       
       
                     
    </body>

</html>