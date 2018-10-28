<?php

require_once "../ajaxDatabaseInit.php";

$array =[];
$arrayFinal = [];
$arrayFilterTemp = [];
$arrayRequest = $_REQUEST['search'];
if (!array_key_exists(3, $arrayRequest)){
    

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
}else if (array_key_exists(3, $arrayRequest) && $arrayRequest[3] == 'advanced'){
    $arrayFilterVersion = [];
    $arrayFilterActivity = [];
    
    foreach($arrayRequest[0] as $key=>$value){


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
            array_push($arrayFilterVersion, $value->CLI_ID);
        }
        foreach($version as $key=>$value){
            array_push($arrayFilterVersion, $value->CLI_ID);
        }

    }
    
    $arrayFinalVersion = array_unique($arrayFilterVersion);
    
    
    
    foreach($arrayRequest[1] as $key=>$value){

        switch ($value) {
            case "RIS":
                $selectActivity = $bdd->queryObj('SELECT CLI_ID FROM YDA_CLIENT WHERE CLI_RIS = "1" AND CLI_PACS = "0" AND CLI_VALID = "1"');
                break;
            case "PACS":
                $selectActivity = $bdd->queryObj('SELECT CLI_ID FROM YDA_CLIENT WHERE CLI_RIS = "0" AND CLI_PACS = "1" AND CLI_VALID = "1"');
                break;
            case "RIS-PACS":
                $selectActivity = $bdd->queryObj('SELECT CLI_ID FROM YDA_CLIENT WHERE CLI_RIS = "1" AND CLI_PACS = "1" AND CLI_VALID = "1"');
                break;
            case "NONE":
                $selectActivity = $bdd->queryObj('SELECT CLI_ID FROM YDA_CLIENT WHERE CLI_RIS = "0" AND CLI_PACS = "0" AND CLI_VALID = "0"');
                break;
            }
        foreach($selectActivity as $key=>$value){
            array_push($arrayFilterActivity, $value->CLI_ID);
         }

    } 
    
    
    $arrayFinalActivity = array_unique($arrayFilterActivity);
    
    if ($arrayRequest[2] == 'OR'){
        $arrayFinal = array_merge($arrayFinalActivity, $arrayFinalVersion);
    }else if ($arrayRequest[2] == 'AND'){
        foreach($arrayFinalActivity as $key=>$value){
            if(in_array($value, $arrayFinalVersion)){
                array_push($arrayFilterTemp, $value);
            }
        }
        foreach($arrayFinalVersion as $key=>$value){
            if(in_array($value, $arrayFinalActivity)){
                array_push($arrayFilterTemp, $value);
            }
        }
        $arrayFinal = array_unique($arrayFilterTemp);
    }
}

if (count($arrayFinal) === 0){
    $arrayFinal = 'Aucun client trouvé pour cette recherche';
}


header("content-type:application/json");
echo json_encode($arrayFinal);
    
?>