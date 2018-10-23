<?php 
require_once "ajaxDatabaseInit.php";

$req = $bdd->prepare('INSERT INTO INT_SECTION(SEC_NAME,SEC_VALID) VALUES (:name, :valid)');

$req->execute(array(
    'name' => ucfirst($_REQUEST['value']),
    'valid' => 1
    )) or die(print_r($req->errorInfo()));

$array['ok'] = 'ok';

$array['id'] = $bdd->lastInsertId();


 header("content-type:application/json");
    echo json_encode($array);



?>