<?php 
require_once "ajaxDatabaseInit.php";

$array = [];
    
$select2 = $bdd->queryObj('SELECT * '
        . 'FROM YDA_RIGHT');
$array['right'] = [];


foreach($select2 as $key=>$value){
    $arrayTemp['id']= $value->RGT_ID;
    $arrayTemp['name'] = $value->RGT_NAME;
    array_push($array['right'], $arrayTemp);

}

$select = $bdd->queryObj('SELECT * '
        . 'FROM YDA_PROFIL '
        . 'WHERE PRO_ID="' . $_REQUEST["id"] . '"');


$array['profil']['name'] = $select[0]->PRO_NAME;
$array['profil']['actif'] = $select[0]->PRO_VALID;


$select3 = $bdd->queryObj('SELECT * '
        . 'FROM YDA_HOOK '
        . 'WHERE HOK_ID_TYPE="' . $_REQUEST["id"] . '"'
        . 'AND HOK_TYPE ="Profil"');
$array['hook'] = [];

foreach($select3 as $key=>$value){

    array_push($array['hook'],$value->HOK_ID_RGT);

}   

echo json_encode($array);
    
?>