<?php

$search = $bdd->queryObj('SELECT USR_SIDEBAR '
        . 'FROM YDA_USERS '
        . 'WHERE USR_ID = 1');

if($search[0]->USR_SIDEBAR == 1){
    echo 'collapsed';
}else if($search[0]->USR_SIDEBAR == 0){
    echo '';
}

?>