<?php 
require_once "ajaxDatabaseInit.php";

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
    
        
    }
    
        $obj_merged = (object) array_merge((array) $search, (array) $search2);
        $obj_merged_array = json_decode(json_encode($obj_merged), True);
        $processed = array_map(function($a) {  return array_pop($a); }, $obj_merged_array);
        asort($processed);
        $count = array_count_values($processed);
        $retour = [];
        $retour['version'] = [];
        $retour['nombre'] = [];
        foreach($count as $key=>$value){
            array_push($retour['nombre'], $value);
            array_push($retour['version'], $key);
        }
        
        
    
    

}

//header("content-type:application/json");
    echo json_encode($retour);



?>