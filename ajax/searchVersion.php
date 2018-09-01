<?php

require_once "ajaxDatabaseInit.php";

$array =[];
  
 
//if (in_array("1", $_REQUEST['search'])) {
//    // echo "yeah";
//    $flagActi = 1;
//    $selectRis = $bdd->query('SELECT CLI_ID FROM YDA_CLIENT WHERE CLI_RIS = "1" AND CLI_PACS = "0" AND CLI_VALID = "1"');
//    
//        while ($query = $selectRis->fetch()){
//            array_push($array, $query['CLI_ID']); 
//        }
//    // print_r($array);
//}
//if (in_array("2", $_REQUEST['search'])) {
//    $flagActi = 1;
//
//    $selectPacs = $bdd->query('SELECT CLI_ID FROM YDA_CLIENT WHERE CLI_RIS = 0 AND CLI_PACS = 1 AND CLI_VALID = 1');
//    
//        while ($query = $selectPacs->fetch()){
//            array_push($array, $query['CLI_ID']); 
//        }
//    
//}
//if (in_array("0", $_REQUEST['search'])) {
//    $flagActi = 1;
//
//    $selectNada = $bdd->query('SELECT CLI_ID FROM YDA_CLIENT WHERE CLI_RIS = 0 AND CLI_PACS = 0 AND CLI_VALID = 1');
//    
//        while ($query = $selectNada->fetch()){
//            array_push($array, $query['CLI_ID']); 
//        }
//    
//}
//
//if (in_array("3", $_REQUEST['search'])) {
//    $flagActi = 1;
//
//    $selectRisPacs = $bdd->query('SELECT CLI_ID FROM YDA_CLIENT WHERE CLI_RIS = 1 AND CLI_PACS = 1 AND CLI_VALID = 1');
//    
//        while ($query = $selectRisPacs->fetch()){
//            array_push($array, $query['CLI_ID']); 
//        }
//    
//}
foreach($_REQUEST['search'] as $key=>$value){
    
    
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
//    var_dump($value->CLI_ID);
        array_push($array, $value->CLI_ID);
    }
    foreach($version as $key=>$value){
//    var_dump($value);
        array_push($array, $value->CLI_ID);
    }
      
}


$arrayFinal = array_unique($array);

  header("content-type:application/json");
    echo json_encode($arrayFinal);
    
?>