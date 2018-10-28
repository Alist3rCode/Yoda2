<?php 
require_once "../ajaxDatabaseInit.php";

$array = [];

$select = $bdd->queryObj('SELECT * '
        . 'FROM YDA_PROFIL '
        . 'WHERE PRO_VALID = 1');

foreach($select as $key=>$value){
        $arrayTemp = [];
        
        $arrayTemp['id'] = $value->PRO_ID;
        $arrayTemp['name'] = $value->PRO_NAME;
        
        array_push($array, $arrayTemp);
}

 header("content-type:application/json");

echo json_encode($array);
    
?>