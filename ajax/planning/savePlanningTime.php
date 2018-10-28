<?php 
require_once "../ajaxDatabaseInit.php";

$req = $bdd->prepare('REPLACE INTO PLA_CONFIG '
    . '(PCO_ID, PCO_START_PLANNING, PCO_STOP_PLANNING, PCO_WEEKDAY) '
    . 'values(:id, :start, :stop, :weekday) ');

$req->execute(array(
'id' => 1,
'start' => $_REQUEST['start'],
'stop' => $_REQUEST['end'],
'weekday' => implode(', ',$_REQUEST['workingday'])       
)) or die(print_r($req->errorInfo()));

$array['ok'] = 'ok';

header("content-type:application/json");
echo json_encode($array);



?>