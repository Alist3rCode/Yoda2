<?php

$search = $bdd->queryObj('SELECT CPR_SIDEBAR '
        . 'FROM CFG_PREFERENCES '
        . 'WHERE CPR_ID_USR = "'.$_SESSION['id_user'].'"');

if (count($search)>0){
    if($search[0]->CPR_SIDEBAR == 1){
        echo 'collapsed';
    }else if($search[0]->CPR_SIDEBAR == 0){
        echo '';
    }

}else{
    $update = $bdd->prepare('REPLACE INTO CFG_PREFERENCES '
        . '(CPR_SIDEBAR, CPR_ID_USR) VALUES '
        . '(:sidebar, :id)');
    
    $update ->execute(array(
        'id' => $_SESSION['id_user'],
        'sidebar' => 0
        ));
}


?>