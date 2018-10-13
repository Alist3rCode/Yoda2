<?php

require_once "ajaxDatabaseInit.php";

$user = [];

$select = $bdd->queryObj('SELECT * FROM YDA_USERS WHERE USR_ID="' . $_REQUEST['id'] . '"');
    
$user['mail'] = $select[0]->USR_MAIL;
$user['name'] = $select[0]->USR_FIRST_NAME;
$user['lastName'] = $select[0]->USR_NAME;
    
    // destinataire utilisateur
     $toUser  = $user['mail'];

     // Sujet
     $subjectUser = 'Réinitialisation du mot de passe de votre compte YODA';

      
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
			<span style="font-size:11pt;"><p>Vous recevez cet eMail car votre compte sur la plateforme YODA a été activé par un adminitrateur.</p></span>
		</font>
	</div><br>
	<div style="margin:0;">
		<font face="Calibri,sans-serif" size="2">
			<span style="font-size:11pt;"><p>
			Vous pouvez à présent vous connecter en cliquant directement sur ce lien : 
			<a href="https://maj-imaging.evolucare.com/yoda" target="_blank">https://maj-imaging.evolucare.com/yoda</a><br>
		<p style="color:red;"><b>Ceci est un mail automatique, merci de ne pas y répondre directement.</b></p><br>
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
    //  $headersUser .= 'To: '.ucfirst($user["name"]).' '.strtoupper($user["lastName"]).' <'.$user["mail"].'> '. "\r\n";
     $headersUser .= 'From: YODA <noreply@mailevolucare.pictime.fr>' . "\r\n";
     
     // Envoi
    //  echo $messageUser;
    mail($toUser, $subjectUser, $messageUser, $headersUser);
     

?>