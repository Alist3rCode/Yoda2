<?php 
require_once "ajaxDatabaseInit.php";


$idProfil = '';
$name = '';
$hook = $_REQUEST['hook'];
$valid = '';

if ($_REQUEST['mode'] == 'update' && $_REQUEST['id'] != 'NEW'){
    
    $select = $bdd->queryObj('SELECT * '
            . 'FROM YDA_PROFIL '
            . 'WHERE PRO_ID="' . $_REQUEST["id"] . '"');

   
    $idProfil = $_REQUEST["id"];
    $name = ucfirst(strtolower($_REQUEST['name']));
    $valid = $select[0]->PRO_VALID;
        
    $delete = $bdd->exec('DELETE FROM YDA_HOOK '
            . 'WHERE HOK_ID_TYPE="' . $_REQUEST["id"] . '"'
            . 'AND HOK_TYPE = "Profil"');

    for($i=0; $i<count($hook); $i++){
    
    $req = $bdd->prepare('INSERT INTO YDA_HOOK( HOK_ID_TYPE, HOK_ID_RGT, HOK_TYPE) '
            . 'VALUES (:idProfil, :right, :type)');
    
    $req->execute(array(
	'idProfil' => $idProfil,
	'right' => $hook[$i],
        'type' => "Profil")) or die(print_r($req->errorInfo()));
    
    }
    $retour = 'ok';
     
}else if($_REQUEST['mode'] == 'update' && $_REQUEST['id'] == 'NEW'){
    

$req = $bdd->prepare('INSERT INTO YDA_PROFIL(PRO_NAME, PRO_VALID) '
        . 'VALUES (:name, :valid)');
    
    $req->execute(array(
        'name' => ucfirst(strtolower($_REQUEST['name'])),
        'valid' => 1)) or die(print_r($req->errorInfo()));

    $retour = 'id-'.$bdd->lastInsertId();
    
    for($i=0; $i<strlen($hook); $i++){
    
    $req = $bdd->prepare('INSERT INTO YDA_HOOK( HOK_ID_TYPE, HOK_ID_RGT, HOK_TYPE) '
            . 'VALUES (:idProfil, :right, :type)');
    
    $req->execute(array(
	'idProfil' => substr($retour, 0, 3),
	'right' => $hook[$i],
        'type' => "Profil")) or die(print_r($req->errorInfo()));
    }
}

if ($_REQUEST['mode'] == 'valid'){
        
    $select = $bdd->query('SELECT * '
            . 'FROM YDA_PROFIL '
            . 'WHERE PRO_ID="' . $_REQUEST["id"] . '"');

   
    $idProfil = $_REQUEST["id"];
    $name = $select[0]->PRO_NAME;
    $valid = $_REQUEST['valid'];
    $retour = 'ok';
    
}

$update = $bdd->prepare('UPDATE YDA_PROFIL SET PRO_NAME = :name, PRO_VALID = :valid WHERE PRO_ID = :id');
$update ->execute(array(
    'id' => $idProfil,
    'name' => $name,
    'valid' => $valid
    ));

echo $retour;


// echo '</pre>';