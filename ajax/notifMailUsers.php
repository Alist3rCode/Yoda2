<?php 
session_start();
require_once "ajaxDatabaseInit.php";

$user = [];
$customer = [];
$avantPhone = '';
$destinataires = implode(',',$_REQUEST['destinataires']);

$select = $bdd->queryObj('SELECT * '
        . 'FROM YDA_USERS '
        . 'WHERE USR_ID in ('.$destinataires.')');
$idx = 0;
foreach($select as $key=>$value){
    
    $user[$idx]['mail'] = $value->USR_MAIL;
    $user[$idx]['name'] = $value->USR_FIRST_NAME;
    $user[$idx]['lastName'] = $value->USR_NAME;

    $idx ++;
}

$sender = $bdd->queryObj('SELECT USR_FIRST_NAME, USR_NAME, USR_MAIL '
        . 'FROM YDA_USERS '
        . 'WHERE USR_ID = "'.$_SESSION['id_user'].'"');

for($y=0;$y < count($user); $y++){
    

     $toUser  = $user[$y]['mail'];

     // Sujet
     $subjectUser = $_REQUEST['objet'];

      
     $messageUser = $_REQUEST['message'];
     $messageUser .= 		
     '<br><br><p style="color:red;"><b>Ceci est un mail automatique, merci de ne pas y répondre directement.</b></p>
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
</div>';

     // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
     $headersUser  = 'MIME-Version: 1.0' . "\r\n";
     $headersUser .= 'Content-type: text/html; charset="utf-8"' . "\r\n";

     // En-têtes additionnels
    //  $headers .= 'To: Yohann <y.lopez@evolucare.com>' . "\r\n";
     $headersUser .= 'From: '.ucfirst($sender->USR_FIRST_NAME) . ' '. ucfirst($sender->USR_NAME).' YODA <'. ucfirst($sender->USR_MAIL).'>' . "\r\n";
     $headersUser .= 'Reply-To: '. ucfirst($sender->USR_MAIL)."\r\n";
    //  $headers .= 'Cc: anniversaire_archive@example.com' . "\r\n";
    //  $headers .= 'Bcc: anniversaire_verif@example.com' . "\r\n";
     // Envoi
     mail($toUser, $subjectUser, $messageUser, $headersUser);
    //  var_dump($_REQUEST);
    //  echo $messageUser;
    
    }
   echo 'ok';
?>