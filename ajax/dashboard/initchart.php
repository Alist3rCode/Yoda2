<?php 
require_once "../ajaxDatabaseInit.php";

if($_REQUEST['type'] == 'version'){
    if ($_REQUEST['search'] != 'all'){
        
        $search = $bdd->queryObj('SELECT CLI_NUM_VERSION as Version '
            . 'FROM YDA_CLIENT '
            . 'WHERE CLI_VERSION = "'.$_REQUEST['search'].'" '
            . 'AND CLI_VALID=1 '
            . 'AND CLI_UID IS NULL ');
    
        $search2 = $bdd2->queryObj('SELECT concat(e.version, ".", e.hotfix) as Version '
            . 'FROM ecsupgrader.wrk_client e '
            . 'INNER JOIN yoda.yda_client y on e.uid = y.CLI_UID '
            . 'WHERE CLI_VERSION = "'.$_REQUEST['search'].'" '
            . 'AND CLI_VALID = 1 '
            . 'AND CLI_UID IS NOT NULL ');
        
        $searchPie = $bdd->queryObj('SELECT CASE '
                . 'WHEN CLI_RIS = 1 AND CLI_PACS = 0 THEN "RIS" '
                . 'WHEN CLI_RIS = 0 AND CLI_PACS = 1 THEN "PACS" '
                . 'WHEN CLI_RIS = 1 AND CLI_PACS = 1 THEN "RIS-PACS" '
                . 'WHEN CLI_RIS = 0 AND CLI_PACS = 0 THEN "NONE" '
                . 'END '
                . 'FROM YDA_CLIENT '
                . 'WHERE CLI_VERSION = "'.$_REQUEST['search'].'" '
                . 'AND CLI_VALID = 1');
    
       
    }else{
        $search = $bdd->queryObj('SELECT CLI_NUM_VERSION as Version '
            . 'FROM YDA_CLIENT '
            . 'WHERE CLI_VALID=1 '
            . 'AND CLI_UID IS NULL ');
             
    
        $search2 = $bdd2->queryObj('SELECT concat(e.version, ".", e.hotfix) as Version '
            . 'FROM ecsupgrader.wrk_client e '
            . 'INNER JOIN yoda.yda_client y on e.uid = y.CLI_UID '
            . 'AND CLI_VALID = 1 '
            . 'AND CLI_UID IS NOT NULL ');
        
        $searchPie = $bdd->queryObj('SELECT CASE '
                . 'WHEN CLI_RIS = 1 AND CLI_PACS = 0 THEN "RIS" '
                . 'WHEN CLI_RIS = 0 AND CLI_PACS = 1 THEN "PACS" '
                . 'WHEN CLI_RIS = 1 AND CLI_PACS = 1 THEN "RIS-PACS" '
                . 'WHEN CLI_RIS = 0 AND CLI_PACS = 0 THEN "NONE" '
                . 'END '
                . 'FROM YDA_CLIENT '
                . 'WHERE CLI_VALID = 1');
    
        
    }
    
    $obj_merged = (object) array_merge((array) $search, (array) $search2);
    $obj_merged_array = json_decode(json_encode($obj_merged), True);
    $processed = array_map(function($a) {  return array_pop($a); }, $obj_merged_array);
    asort($processed);
    $count = array_count_values($processed);
    $retour = [];
    $retour['line'] = [];
    $retour['line']['version'] = [];
    $retour['line']['nombre'] = [];
    foreach($count as $key=>$value){
        array_push($retour['line']['nombre'], $value);
        array_push($retour['line']['version'], $key);
    }

    $objPie_merged_array = json_decode(json_encode($searchPie), True);
    $processedPie = array_map(function($a) {  return array_pop($a); }, $objPie_merged_array);
    asort($processedPie);
    $countPie = array_count_values($processedPie);

    $retour['pie'] = [];
    $i = 0;
    foreach($countPie as $key=>$value){
        $retour['pie'][$i] = [];
            switch ($key) {
            case 'RIS':
                $color = "#dc3545";
                break;
            case 'PACS':
                $color =  "#28a745";
                break;
            case 'RIS-PACS':
                $color = "#17a2b8";
                break;
            case 'NONE':
                $color =  "#f8f9fa";
                break;
        }

        $retour['pie'][$i]['label'] = $key;
        $retour['pie'][$i]['data'] = $value;
        $retour['pie'][$i]['color'] = $color;
        $i++;

    }
}else if($_REQUEST['type'] == 'activity'){
    if ($_REQUEST['search'] === 'ris'){
        
        $search = $bdd->queryObj('SELECT CLI_NUM_VERSION as Version '
            . 'FROM YDA_CLIENT '
            . 'WHERE CLI_RIS = 1 '
            . 'AND CLI_PACS = 0 '
            . 'AND CLI_VALID=1 '
            . 'AND CLI_UID IS NULL ');
    
        $search2 = $bdd2->queryObj('SELECT concat(e.version, ".", e.hotfix) as Version '
            . 'FROM ecsupgrader.wrk_client e '
            . 'INNER JOIN yoda.yda_client y on e.uid = y.CLI_UID '
            . 'WHERE CLI_RIS = 1 '
            . 'AND CLI_PACS = 0 '
            . 'AND CLI_VALID = 1 '
            . 'AND CLI_UID IS NOT NULL ');
        
        $searchPie = $bdd->queryObj('SELECT CLI_VERSION as Version '
                . 'FROM YDA_CLIENT '
                . 'WHERE CLI_RIS = 1 '
                . 'AND CLI_PACS = 0 '
                . 'AND CLI_VALID = 1');
    
       
    }else if ($_REQUEST['search'] === 'pacs'){
        
        $search = $bdd->queryObj('SELECT CLI_NUM_VERSION as Version '
            . 'FROM YDA_CLIENT '
            . 'WHERE CLI_RIS = 0 '
            . 'AND CLI_PACS = 1 '
            . 'AND CLI_VALID = 1 '
            . 'AND CLI_UID IS NULL ');
    
        $search2 = $bdd2->queryObj('SELECT concat(e.version, ".", e.hotfix) as Version '
            . 'FROM ecsupgrader.wrk_client e '
            . 'INNER JOIN yoda.yda_client y on e.uid = y.CLI_UID '
            . 'WHERE CLI_RIS = 0 '
            . 'AND CLI_PACS = 1 '
            . 'AND CLI_VALID = 1 '
            . 'AND CLI_UID IS NOT NULL ');
        
        $searchPie = $bdd->queryObj('SELECT CLI_VERSION as Version '
                . 'FROM YDA_CLIENT '
                . 'WHERE CLI_RIS = 0 '
                . 'AND CLI_PACS = 1 '
                . 'AND CLI_VALID = 1');
    
    }else if ($_REQUEST['search'] === 'rispacs'){
        
        $search = $bdd->queryObj('SELECT CLI_NUM_VERSION as Version '
            . 'FROM YDA_CLIENT '
            . 'WHERE CLI_RIS = 1 '
            . 'AND CLI_PACS = 1 '
            . 'AND CLI_VALID = 1 '
            . 'AND CLI_UID IS NULL ');
    
        $search2 = $bdd2->queryObj('SELECT concat(e.version, ".", e.hotfix) as Version '
            . 'FROM ecsupgrader.wrk_client e '
            . 'INNER JOIN yoda.yda_client y on e.uid = y.CLI_UID '
            . 'WHERE CLI_RIS = 1 '
            . 'AND CLI_PACS = 1 '
            . 'AND CLI_VALID = 1 '
            . 'AND CLI_UID IS NOT NULL ');
        
        $searchPie = $bdd->queryObj('SELECT CLI_VERSION as Version '
                . 'FROM YDA_CLIENT '
                . 'WHERE CLI_RIS = 1 '
                . 'AND CLI_PACS = 1 '
                . 'AND CLI_VALID = 1');
        
    }else if ($_REQUEST['search'] === 'none'){
        
        $search = $bdd->queryObj('SELECT CLI_NUM_VERSION as Version '
            . 'FROM YDA_CLIENT '
            . 'WHERE CLI_RIS = 0 '
            . 'AND CLI_PACS = 0 '
            . 'AND CLI_VALID = 1 '
            . 'AND CLI_UID IS NULL ');
    
        $search2 = $bdd2->queryObj('SELECT concat(e.version, ".", e.hotfix) as Version '
            . 'FROM ecsupgrader.wrk_client e '
            . 'INNER JOIN yoda.yda_client y on e.uid = y.CLI_UID '
            . 'WHERE CLI_RIS = 0 '
            . 'AND CLI_PACS = 0 '
            . 'AND CLI_VALID = 1 '
            . 'AND CLI_UID IS NOT NULL ');
        
        $searchPie = $bdd->queryObj('SELECT CLI_VERSION as Version '
                . 'FROM YDA_CLIENT '
                . 'WHERE CLI_RIS = 0 '
                . 'AND CLI_PACS = 0 '
                . 'AND CLI_VALID = 1');
        
    }
    
    $obj_merged = (object) array_merge((array) $search, (array) $search2);
    $obj_merged_array = json_decode(json_encode($obj_merged), True);
    $processed = array_map(function($a) {  return array_pop($a); }, $obj_merged_array);
    asort($processed);
    $count = array_count_values($processed);
    $retour = [];
    $retour['line'] = [];
    $retour['line']['version'] = [];
    $retour['line']['nombre'] = [];
    foreach($count as $key=>$value){
        array_push($retour['line']['nombre'], $value);
        array_push($retour['line']['version'], $key);
    }

    $objPie_merged_array = json_decode(json_encode($searchPie), True);
    $processedPie = array_map(function($a) {  return array_pop($a); }, $objPie_merged_array);
    asort($processedPie);
    $countPie = array_count_values($processedPie);

    $retour['pie'] = [];
    $i = 0;
    foreach($countPie as $key=>$value){
        $retour['pie'][$i] = [];
            switch ($key) {
            case 'RIS':
                $color = "#dc3545";
                break;
            case 'PACS':
                $color =  "#28a745";
                break;
            case 'RIS-PACS':
                $color = "#17a2b8";
                break;
            case 'NONE':
                $color =  "#f8f9fa";
                break;
            case 'v6':
                $color =  "#f6e18b";
                break;
            case 'v7':
                $color =  "#87cdf1";
                break;
            case 'v8':
                $color =  "#cacaca";
                break;
        }

        $retour['pie'][$i]['label'] = $key;
        $retour['pie'][$i]['data'] = $value;
        $retour['pie'][$i]['color'] = $color;
        $i++;

    }
}

header("content-type:application/json");
    echo json_encode($retour);



?>