<?php 
require_once "ajaxDatabaseInit.php";


$req = $bdd->prepare('UPDATE INT_LINK '
    . 'SET LNK_ORDER = :order '
    . 'WHERE LNK_ID = :id');

$req->execute(array(
'order' => $_REQUEST['newOrder'],
'id' => $_REQUEST['id']    
)) or die(print_r($req->errorInfo()));

$req->execute(array(
'order' => $_REQUEST['order'],
'id' => $_REQUEST['idOther']    
)) or die(print_r($req->errorInfo()));

$array['ok'] = 'ok';


 header("content-type:application/json");
    echo json_encode($array);



?>