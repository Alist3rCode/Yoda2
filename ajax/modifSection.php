<?php 
require_once "ajaxDatabaseInit.php";

$select = $bdd->queryObj('SELECT SEC_NAME FROM INT_SECTION WHERE SEC_ID ="'.$_REQUEST['id'].'"');


$req = $bdd->prepare('UPDATE INT_SECTION '
        . 'SET SEC_NAME = :name, '
        . 'SEC_VALID = :valid '
        . 'WHERE SEC_ID = :id');

$req->execute(array(
    'name' => ucfirst($_REQUEST['value']),
    'valid' => $_REQUEST['valid'],
    'id' => $_REQUEST['id']
    )) or die(print_r($req->errorInfo()));

$array['ok'] = 'ok';
$array['name'] = $select[0]->SEC_NAME;




 header("content-type:application/json");
    echo json_encode($array);



?>