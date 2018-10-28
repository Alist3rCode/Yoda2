<?php 
require_once "../ajaxDatabaseInit.php";

$user = [];
$customer = [];
$avantPhone = '';
$select = $bdd->queryObj('SELECT * '
        . 'FROM YDA_NOTIF '
        . 'INNER JOIN YDA_USERS ON NTF_ID_USR = USR_ID '
        . 'WHERE NTF_MODIF = 1 '
        . 'AND USR_DELETE IS NULL');
$idx = 0;
foreach($select as $key=>$value){
    $user[$idx]['mail'] = $value->USR_MAIL;
    $user[$idx]['name'] = $value->USR_FIRST_NAME;
    $user[$idx]['lastName'] = $value->USR_NAME;

    $idx++;
}

    
$selectModifier = $bdd->queryObj('SELECT * '
        . 'FROM YDA_USERS '
        . 'WHERE USR_ID ="'.$_REQUEST['idUser'] .'"');

$userModif['name'] = $selectCreator[0]->USR_FIRST_NAME;
$userModif['lastName'] = $selectCreator[0]->USR_NAME;
    

$count = max(count($_REQUEST['avant']['phone']), count($_REQUEST['apres']['phone']));
$tab = '<tr><th scope="row" style="border-bottom: 1px solid #ddd;">Sites</th>'."\n";

for($i=0;$i < $count; $i++){

    if(array_key_exists($i,$_REQUEST['avant']['phone'])){
        $tab = $tab . '<td style="border-bottom: 1px solid #ddd;">Site : '. $_REQUEST['avant']['phone'][$i]['site'] . '<br>Tel : '. $_REQUEST['avant']['phone'][$i]['phone'] . '<br>Latitude : '. $_REQUEST['avant']['phone'][$i]['lat'] . '<br>Longitude : '. $_REQUEST['avant']['phone'][$i]['lon'] . '</br>Mail : '. $_REQUEST['avant']['phone'][$i]['mail'] . '</br>Adresse TX : '. $_REQUEST['avant']['phone'][$i]['TX'] . '</br></td>'."\n";
    }else{
        $tab = $tab . '<td style="border-bottom: 1px solid #ddd;">Site : <br>Tel : <br>Latitude : <br>Longitude : <br></td>'."\n";
    }
    if(array_key_exists($i,$_REQUEST['apres']['phone'])){
        $tab = $tab . '<td style="border-bottom: 1px solid #ddd;">Site : '. $_REQUEST['apres']['phone'][$i]['site'] . '<br>Tel : '. $_REQUEST['apres']['phone'][$i]['phone'] . '<br>Latitude : '. $_REQUEST['apres']['phone'][$i]['lat'] . '<br>Longitude : '. $_REQUEST['apres']['phone'][$i]['lon'] . '<br>Mail : '. $_REQUEST['apres']['phone'][$i]['mail'] . '<br>Adresse TX : '. $_REQUEST['apres']['phone'][$i]['TX'] . '<br></td>'."\n";
    }else{
        $tab = $tab . '<td style="border-bottom: 1px solid #ddd;">Site : <br>Tel : <br>Latitude : <br>Longitude : <br></td>'."\n";
    }
    if($i != $count - 1){
        $tab = $tab . '</tr><tr><th scope="row" style="border-bottom: 1px solid #ddd;">Sites</th>'."\n";
    }
}
$tab = $tab .'</tr>'."\n";

for($y=0;$y < count($user); $y++){

     $toUser  = $user[$y]['mail'];
     $subjectUser = "Modification d'un client dans YODA ";
     $messageUser = '
     <div>
	<div style="margin:0;">
		<font face="Calibri,sans-serif" size="2">
			<span style="font-size:11pt;"><p>
			Bonjour '.ucfirst($user[$y]["name"]).' '.strtoupper($user[$y]["lastName"]).',
			<br>
			<br>
		</p></span>
		</font>
	</div>
	<div style="margin:0;">
		<font face="Calibri,sans-serif" size="2">
			<span style="font-size:11pt;"><p>
			Le client <b>'. ucfirst($_REQUEST['avant']['ville']).' - '.ucfirst($_REQUEST['avant']['nom']).'</b> vient d\'être modifié dans YODA</b> par l\'utilisateur '. ucfirst($userModif['name']).' '.ucfirst($userModif['lastName']).'.  
			<br>
			<br>
			Voici les modifications effectuées : <br><br>
			<table class="table" style="text-align: center;">
              <thead>
                <tr>
                    <th scope="col" style="border-bottom: 1px solid #ddd;">#</th>
                  <th scope="col" style="border-bottom: 1px solid #ddd;">Avant</th>
                  <th scope="col" style="border-bottom: 1px solid #ddd;">Après</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <th scope="row" style="border-bottom: 1px solid #ddd;">Ville</th>    
                  <td style="border-bottom: 1px solid #ddd;">'.ucfirst($_REQUEST['avant']['ville']).'</td>
                  <td style="border-bottom: 1px solid #ddd;color:'.$_REQUEST['apres']['ville-change'].'">'.ucfirst($_REQUEST['apres']['ville']).'</td>
                </tr>
                <tr>
                <th scope="row" style="border-bottom: 1px solid #ddd;">Nom</th>    
                  <td style="border-bottom: 1px solid #ddd;">'.ucfirst($_REQUEST['avant']['nom']).'</td>
                  <td style="border-bottom: 1px solid #ddd;color:'.$_REQUEST['apres']['nom-change'].'">'.ucfirst($_REQUEST['apres']['nom']).'</td>
                </tr>
                <tr>
                <th scope="row" style="border-bottom: 1px solid #ddd;">URL</th>    
                  <td style="border-bottom: 1px solid #ddd;">'.$_REQUEST['avant']['url'].'</td>
                  <td style="border-bottom: 1px solid #ddd;color:'.$_REQUEST['apres']['url-change'].'">'.$_REQUEST['apres']['url'].'</td>
                </tr>
                <tr>
                <th scope="row" style="border-bottom: 1px solid #ddd;">Version</th>    
                  <td style="border-bottom: 1px solid #ddd;">'.$_REQUEST['avant']['version'].'</td>
                  <td style="border-bottom: 1px solid #ddd;color:'.$_REQUEST['apres']['version-change'].'">'.$_REQUEST['apres']['version'].'</td>
                </tr>
                <tr>
                <th scope="row" style="border-bottom: 1px solid #ddd;">Tag</th>    
                  <td style="border-bottom: 1px solid #ddd;">'.$_REQUEST['avant']['tag'].'</td>
                  <td style="border-bottom: 1px solid #ddd;color:'.$_REQUEST['apres']['tag-change'].'">'.$_REQUEST['apres']['tag'].'</td>
                </tr>
                <tr>
                <th scope="row" style="border-bottom: 1px solid #ddd;">RIS</th>    
                  <td style="border-bottom: 1px solid #ddd;">'.$_REQUEST['avant']['ris'].'</td>
                  <td style="border-bottom: 1px solid #ddd;color:'.$_REQUEST['apres']['ris-change'].'">'.$_REQUEST['apres']['ris'].'</td>
                   </tr>
                <tr>
                <th scope="row" style="border-bottom: 1px solid #ddd;">PACS</th>    
                  <td style="border-bottom: 1px solid #ddd;">'.$_REQUEST['avant']['pacs'].'</td>
                  <td style="border-bottom: 1px solid #ddd;color:'.$_REQUEST['apres']['pacs-change'].'">'.$_REQUEST['apres']['pacs'].'</td>
                </tr>
                <tr>
                <th scope="row" style="border-bottom: 1px solid #ddd;">V Imaging</th>    
                  <td style="border-bottom: 1px solid #ddd;">'.$_REQUEST['avant']['imaging'].'</td>
                  <td style="border-bottom: 1px solid #ddd;color:'.$_REQUEST['apres']['imaging-change'].'">'.$_REQUEST['apres']['imaging'].'</td>
                </tr>
                <tr>
                <th scope="row" style="border-bottom: 1px solid #ddd;">V View</th>    
                  <td style="border-bottom: 1px solid #ddd;">'.$_REQUEST['avant']['view'].'</td>
                  <td style="border-bottom: 1px solid #ddd;color:'.$_REQUEST['apres']['view-change'].'">'.$_REQUEST['apres']['view'].'</td>
                </tr>
                <tr>
                <th scope="row" style="border-bottom: 1px solid #ddd;">V uView</th>    
                  <td style="border-bottom: 1px solid #ddd;">'.$_REQUEST['avant']['uview'].'</td>
                  <td style="border-bottom: 1px solid #ddd;color:'.$_REQUEST['apres']['uview-change'].'">'.$_REQUEST['apres']['uview'].'</td>
                </tr>
                <tr>
                '.$tab.'
                
              </tbody>
            </table>
			<br>
			
			
			
		    Si vous souhaitez modifier les notifications que vous recevez de la part de YODA, cliquer sur ce lien : <a href="https://maj-imaging.evolucare.com/yoda/notif.php" target="_blank">https://maj-imaging.evolucare.com/yoda/notif.php</a>
		</p>
		<br>
		
		
		
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
    //  var_dump($_REQUEST);
    //  echo $messageUser;
    
    }
   
?>