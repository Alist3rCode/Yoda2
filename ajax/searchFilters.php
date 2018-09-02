<?php

require_once "ajaxDatabaseInit.php";

$array =[];

$arrayRequest = $_REQUEST['search'];

if (in_array("Ris", $arrayRequest)) {

$selectRis = $bdd->queryObj('SELECT CLI_ID FROM YDA_CLIENT WHERE CLI_RIS = "1" AND CLI_PACS = "0" AND CLI_VALID = "1"');

     foreach($selectRis as $key=>$value){
        array_push($array, $value->CLI_ID);
    }
unset($arrayRequest[array_search('Ris', $arrayRequest)]);
}

if (in_array("Pacs", $arrayRequest)) {

$selectPacs = $bdd->queryObj('SELECT CLI_ID FROM YDA_CLIENT WHERE CLI_RIS = "0" AND CLI_PACS = "1" AND CLI_VALID = "1"');

     foreach($selectPacs as $key=>$value){
        array_push($array, $value->CLI_ID);
    }
unset($arrayRequest[array_search('Pacs', $arrayRequest)]);
}

if (in_array("RisPacs", $arrayRequest)) {

$selectRisPacs = $bdd->queryObj('SELECT CLI_ID FROM YDA_CLIENT WHERE CLI_RIS = "1" AND CLI_PACS = "1" AND CLI_VALID = "1"');

     foreach($selectRisPacs as $key=>$value){
        array_push($array, $value->CLI_ID);
    }
unset($arrayRequest[array_search('RisPacs', $arrayRequest)]);
}
if (in_array("None", $arrayRequest)) {

$selectNone = $bdd->queryObj('SELECT CLI_ID FROM YDA_CLIENT WHERE CLI_RIS = "0" AND CLI_PACS = "0" AND CLI_VALID = "1"');

     foreach($selectNone as $key=>$value){
        array_push($array, $value->CLI_ID);
    }
unset($arrayRequest[array_search('None', $arrayRequest)]);
}
 
foreach($arrayRequest as $key=>$value){
    
    
    $version= $bdd->queryObj('SELECT CLI_ID '
            . 'FROM YDA_CLIENT '
            . 'WHERE CLI_VALID = 1 '
            . 'AND CLI_NUM_VERSION = "'.$value.'"'
            . 'AND CLI_UID IS NULL '
            . 'ORDER BY CLI_NUM_VERSION ASC');

    $version2 = $bdd->queryObj('SELECT CLI_ID '
            . 'FROM yoda.YDA_CLIENT cli '
            . 'INNER JOIN ecsupgrader.wrk_client upg ON upg.uid = cli.CLI_UID '
            . 'WHERE cli.CLI_VALID = 1 '
            . 'AND concat(upg.version,".",upg.hotfix)= "'.$value.'" ');
    foreach($version2 as $key=>$value){
        array_push($array, $value->CLI_ID);
    }
    foreach($version as $key=>$value){
        array_push($array, $value->CLI_ID);
    }
      
}

$arrayFinal = array_unique($array);

header("content-type:application/json");
echo json_encode($arrayFinal);
    
?>