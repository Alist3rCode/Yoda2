<?php 
require_once "ajaxDatabaseInit.php";

$user = [];
$admin = [];
$select = $bdd->query('SELECT * '
        . 'FROM YDA_USERS '
        . 'WHERE USR_ID="' . $_REQUEST['id'] . '"');

$user['mail'] = $select[0]->USR_MAIL;
$user['name'] = $select[0]->USR_FIRST_NAME;
$user['lastName'] = $select[0]->USR_NAME;
$user['password'] = $_REQUEST['password'];
        
    
    
    
$select2 = $bdd->query('SELECT * '
        . 'FROM YDA_USERS '
        . 'WHERE USR_ID_PRO = 1');
$idx = 0;

foreach($select2 as $key=>$value){
    $admin[$idx]['mail'] = $value->USR_MAIL;
    $admin[$idx]['name'] = $value->USR_FIRST_NAME;
    $admin[$idx]['lastName'] = $value->USR_NAME;

    $idx++;
}

    
// destinataire utilisateur
 $toUser  = $user['mail'];

 // Sujet
 $subjectUser = 'Accusé de réception de la demande de création d\'un compte YODA';


 $messageUser = '
 <div>
    <div style="margin:0;">
            <font face="Calibri,sans-serif" size="2">
                    <span style="font-size:11pt;"><p>
                    Bonjour '.ucfirst($user["name"]).' '.strtoupper($user["lastName"]).', 
            </p></span>
            </font>
    </div>
    <div style="margin:0;">
            <font face="Calibri,sans-serif" size="2">
                    <span style="font-size:11pt;"><p>Vous recevez cet eMail car vous vous êtes inscrit sur la plateforme YODA pour la société Evolucare.</p></span>
            </font>
    </div>
    <div style="margin:0;">
            <font face="Calibri,sans-serif" size="2">
                    <span style="font-size:11pt;"><p>
                    Voici vos identifiants personnels, ils seront valable une fois qu\'un administrateur aura validé votre demande. Vous recevrez un second eMail à ce moment là.
                    <br>
                    <br>
                    Login : 
                    <b>'.$user["mail"].'</b>
                    <br>
                En cas d\'oubli de votre mot de passe, un outil de réinitialisation est disponible sur la page de login.
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
 $headersUser  = 'MIME-Version: 1.0' . "\r\n";
 $headersUser .= 'Content-type: text/html; charset="utf-8"' . "\r\n";

 // En-têtes additionnels
//  $headers .= 'To: Yohann <y.lopez@evolucare.com>' . "\r\n";
 $headersUser .= 'From: YODA <noreply@mailevolucare.pictime.fr>' . "\r\n";
//  $headers .= 'Cc: anniversaire_archive@example.com' . "\r\n";
//  $headers .= 'Bcc: anniversaire_verif@example.com' . "\r\n";
 // Envoi
 mail($toUser, $subjectUser, $messageUser, $headersUser);

     
    
     
     
     
     
for($i = 0; $i < $idx; $i++){
         // destinataire utilisateur
     $toAdmin  = $admin[$i]['mail'];
    //  echo $admin[$i]['mail'];

     // Sujet
     $subjectAdmin = 'Demande de création d\'un compte YODA';

      
     $messageAdmin = '
     <head>
        
     </head>
     <div>
	<div style="margin:0;">
		<font face="Calibri,sans-serif" size="2">
			<span style="font-size:11pt;"><p>
			Bonjour '.ucfirst($admin[$i]["name"]).' '.strtoupper($admin[$i]["lastName"]).', 
		</p></span>
		</font>
	</div>
	<div style="margin:0;">
		<font face="Calibri,sans-serif" size="2">
			<span style="font-size:11pt;"><p>Un nouvel utilisateur a émit la demande de rejoindre YODA. Souhaitez vous l\'y autoriser ? </p></span>
		</font>
	</div>
	<div style="margin:0;">
		<font face="Calibri,sans-serif" size="2">
			<span style="font-size:11pt;"><p >
			Il s\'agit de <em>' .ucfirst($user["name"]).' '.strtoupper($user["lastName"]).' - <b>'.$user["mail"].'</b></em>.
			
			<div style="margin-left:15px;">
			    <p><a href="https://maj-imaging.evolucare.com/yoda/activeUser.php?idUser='.$_REQUEST['id'].'&activeUser=1" style="color:green!important;">Accepter</button></a></p>
                <p><a href="https://maj-imaging.evolucare.com/yoda/activeUser.php?idUser='.$_REQUEST['id'].'&activeUser=0" style="color:red!important;">Refuser</button></a></p>
            </div>
		</p>
		<p>
			Pour rappel, vous pouvez accéder aux profils utilisateurs sur ce lien  : 
			<br>
			<a href="https://maj-imaging.evolucare.com/yoda/profil.php" target="_blank">https://maj-imaging.evolucare.com/yoda/profil.php</a>
		</p>
		<p>Une fois votre réponse donnée, un mail sera envoyé à l\'utilisateur pour le prévenir de votre choix.</p>
			
		</span>
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
					<b>Mail automatique</b>
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
      $headersAdmin  = 'MIME-Version: 1.0' . "\r\n";
     $headersAdmin .= 'Content-type: text/html; charset="utf-8"' . "\r\n";

     // En-têtes additionnels
    //  $headers .= 'To: Yohann <y.lopez@evolucare.com>' . "\r\n";
     $headersAdmin .= 'From: YODA <noreply@mailevolucare.pictime.fr>' . "\r\n";
    //  $headers .= 'Cc: anniversaire_archive@example.com' . "\r\n";
    //  $headers .= 'Bcc: anniversaire_verif@example.com' . "\r\n";
    
     // Envoi
     mail($toAdmin, $subjectAdmin, $messageAdmin, $headersAdmin);
}
?>