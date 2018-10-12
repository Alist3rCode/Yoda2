<?php 
require_once "ajaxDatabaseInit.php";

if($_REQUEST['type'] == 'version'){
    if ($_REQUEST['search'] != 'all'){
        
        $search = $bdd->queryObj('SELECT COUNT(CLI_ID) as Nombre, '
            . 'CLI_NUM_VERSION as Version '
            . 'FROM YDA_CLIENT '
            . 'WHERE CLI_VERSION = "'.$_REQUEST['search'].'" '
            . 'AND CLI_VALID=1 '
            . 'AND CLI_UID IS NULL '
            . 'GROUP BY Version');
        $searchWithoutUID = $bdd->queryObj('SELECT CLI_ID '
            . 'FROM YDA_CLIENT '
            . 'WHERE CLI_VERSION = "'.$_REQUEST['search'].'" '
            . 'AND CLI_VALID=1 '
            . 'AND CLI_UID IS NOT NULL');
    
//    $search2 = $bdd2->queryObj('SELECT count(y.CLI_ID) as Nombre, '
//            . 'concat(e.version, '.', e.hotfix) as Version '
//            . 'FROM ecsupgrader.wrk_client e '
//            . 'INNER JOIN yoda.yda_client y on e.uid = y.CLI_UID '
//            . 'WHERE CLI_VERSION = "v7" '
//            . 'AND CLI_VALID = 1 '
//            . 'AND CLI_UID IS NOT NULL '
//            . 'GROUP BY Version');
    
        var_dump($search, $searchWithoutUID);
    }else{
        $search = $bdd->queryObj('SELECT COUNT(CLI_ID) as Nombre, '
            . 'CLI_NUM_VERSION as Version '
            . 'FROM YDA_CLIENT '
            . 'WHERE CLI_VALID=1 '
            . 'AND CLI_UID IS NULL '
            . 'GROUP BY Version');
             
    
        $search2 = $bdd2->queryObj('SELECT count(y.CLI_ID) as Nombre, '
            . 'concat(e.version, ".", e.hotfix) as Version '
            . 'FROM ecsupgrader.wrk_client e '
            . 'INNER JOIN yoda.yda_client y on e.uid = y.CLI_UID '
            . 'WHERE CLI_VERSION = "v7" '
            . 'AND CLI_VALID = 1 '
            . 'AND CLI_UID IS NOT NULL '
            . 'GROUP BY Version');
    
        var_dump($search,$search2);
    }
    
    

}


//
// header("content-type:application/json");
//    echo json_encode($search);



?>