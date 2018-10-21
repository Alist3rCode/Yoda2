<?php 
require_once "ajaxDatabaseInit.php";


$req = $bdd->prepare('REPLACE INTO YDA_NOTIF'
        . '( NTF_ID_USR, NTF_UPDATE, NTF_CREATE, NTF_MODIF, NTF_NEW_CUSTO) '
        . 'VALUES (:id, :update, :create, :modif, :new_custo)');
    
    $req->execute(array(
	'id' => $_REQUEST['id'],
	'update' => implode(",", $_REQUEST['update']),
	'create' => $_REQUEST['create'],
	'modif' => $_REQUEST['modif'],
	'new_custo' => $_REQUEST['new_custo'])) or die(print_r($req->errorInfo()));
	
$retour = 'ok'; 

echo $retour;


?>