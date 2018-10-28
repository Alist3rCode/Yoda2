<?php 
require_once "../ajaxDatabaseInit.php";

$update = $bdd->prepare('UPDATE YDA_USERS '
        . 'SET USR_SIDEBAR = :value '
        . 'WHERE USR_ID = :id');
        
        
$update->execute(array(
        'value' => (int)$_REQUEST['value'],
        'id' => $_REQUEST['idUser']
        )) or die(print_r($bdd->errorInfo()));


?>