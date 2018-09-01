<?php

function loadVersion($v){

    $bdd = new Database('yoda');
   
    
    $array=[];
    $version = $bdd->queryObj('SELECT distinct(CLI_NUM_VERSION) '
            . 'FROM YDA_CLIENT '
            . 'WHERE CLI_VALID = 1 '
            . 'AND CLI_VERSION = "'.$v.'"'
            . 'AND CLI_NUM_VERSION IS NOT NULL '
            . 'AND CLI_UID IS NULL '
            . 'ORDER BY CLI_NUM_VERSION ASC');

     $version2 = $bdd->queryObj('SELECT distinct(upg.version), upg.hotfix '
             . 'FROM yoda.YDA_CLIENT cli '
             . 'INNER JOIN ecsupgrader.wrk_client upg ON upg.uid = cli.CLI_UID '
             . 'WHERE cli.CLI_VALID = 1 '
             . 'AND cli.CLI_VERSION = "'.$v.'"'
             . 'AND cli.CLI_UID IS NOT NULL '
             . 'ORDER BY upg.version ASC, upg.hotfix ASC');

    foreach($version2 as $key=>$value){
        $array[$key] = $value->version . '.' . $value->hotfix; 
    }

    foreach($version as $key => $value){
       if (!in_array($value->CLI_NUM_VERSION, $array)){
           array_push($array, $value->CLI_NUM_VERSION  );
       }
    }
    rsort($array);

    return $array;
}

