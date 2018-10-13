<?php 
require_once "ajaxDatabaseInit.php";


$arrayMini = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
$arrayMaj = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
$arrayNbr = ['0','1','2','3','4','5','6','7','8','9'];
$arraySpe = ['~', '!',  '@',  '#', '$', '%', '^', '&', '*', '(', ')', '-', '_', '=', '+', '[', ']', '{', '}', ';' ,':' , ',', '.', '<', '>', '/', '?'];
$arraySimi = ['0' , 'O', 'l', '1', 'I'];

$size = $_REQUEST['nbCarac'];

$array = [];

if($_REQUEST['numbers']  == 'true'){
    $array = array_merge($array, $arrayNbr);
}
if($_REQUEST['mini'] == 'true'){
    $array = array_merge($array, $arrayMini);
}
if($_REQUEST['maj']  == 'true'){
    $array = array_merge($array, $arrayMaj);
}
if($_REQUEST['spec']  == 'true'){
    $array = array_merge($array, $arraySpe);
}

// print_r($array);
$mdp = '';
$temp = '';

for($i = 0; $i < $size; $i++){
    
    
    $temp = array_rand($array, 1);
    // var_dump($array[$temp]);
    if($_REQUEST['simi'] == 'false'){
        while (in_array($array[$temp], $arraySimi)){
            $temp = array_rand($array, 1);
        }
    }
    
    $mdp = $mdp . $array[$temp];
}

$select = $bdd->queryObj('SELECT * '
        . 'FROM YDA_USERS '
        . 'WHERE USR_MAIL="' . $_REQUEST["email"] . '"');


$id = $select[0]->USR_ID;
$email = $select[0]->USR_MAIL;
$password = sha1($mdp);
$profil = $select[0]->USR_ID_PRO;
$name = $select[0]->USR_NAME;
$firstName = $select[0]->USR_FIRST_NAME;
$page = $select[0]->USR_PAGE;
$create = $select[0]->USR_CREATE;
$delete = $select[0]->USR_DELETE;

$now = new DateTime(date('Y-m-d H:i:s'));

// echo $id;
$update = $bdd->prepare('UPDATE YDA_USERS '
        . 'SET USR_MAIL = :mail, '
        . 'USR_PASSWORD = :password, '
        . 'USR_ID_PRO = :profil, '
        . 'USR_NAME = :name, '
        . 'USR_FIRST_NAME = :firstName, '
        . 'USR_CREATE = :create, '
        . 'USR_DELETE = :delete '
        . 'USR_CHANGE_PASSWORD = :change'
        . 'WHERE USR_ID = :id');

$update ->execute(array(
    'id' => $id,
    'mail' => $email,
    'password' => $password,
    'profil' => $profil,
    'name' => $name,
    'firstName' => $firstName,
    'create' => $create,
    'delete' => $delete,
    'change' => $now));

    
    
// Plusieurs destinataires
    $to  = $email; 


    // Sujet
    $subject = 'Réinitialisation du mot de passe de votre compte YODA';

    // message
    $message = '
    <div>
       <div style="margin:0;">
               <font face="Calibri,sans-serif" size="2">
                       <span style="font-size:11pt;"><p>
                       Bonjour '.ucfirst($firstName).' '.strtoupper($name).', 
               </p></span>
               </font>
       </div>
       <div style="margin:0;">
               <font face="Calibri,sans-serif" size="2">
                       <span style="font-size:11pt;"><p>Vous recevez cet eMail car vous venez de réinitaliser votre mot de passe pour la plateforme YODA.</p></span>
               </font>
       </div>
       <div style="margin:0;">
               <font face="Calibri,sans-serif" size="2">
                       <span style="font-size:11pt;"><p>
                       Voici vos nouveaux identifiants personnels, il vous sera demandé de changer de mot de passe lors de votre connexion.
                       <br>
                       <br>
                       Login : 
                       <b>'.$email.'</b>
                       <br>
                       Mot de passe : 
                       <b>'.$mdp.'</b>
               </p>
               <p>
                       Pour rappel, voici l\'adresse de la plateforme : 
                       <br>
                       <a href="https://yoda.evolucare.com/" target="_blank">https://yoda.evolucare.com/</a>
               </p>

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
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset="utf-8"' . "\r\n";

    // En-têtes additionnels
   //  $headers .= 'To: Yohann <y.lopez@evolucare.com>' . "\r\n";
    $headers .= 'From: YODA <noreply@mailevolucare.pictime.fr>' . "\r\n";
   //  $headers .= 'Cc: anniversaire_archive@example.com' . "\r\n";
   //  $headers .= 'Bcc: anniversaire_verif@example.com' . "\r\n";


    // Envoi
    mail($to, $subject, $message, $headers);

   echo 'ok';

?>