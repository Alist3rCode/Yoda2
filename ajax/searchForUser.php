<?php 
require_once "ajaxDatabaseInit.php";

$array =[];

$select = $bdd->queryObj('SELECT USR_ID '
        . 'FROM YDA_USERS '
        . 'WHERE ('
            . 'USR_MAIL LIKE "%' . $_REQUEST['search'] . '%" '
            . 'OR USR_FIRST_NAME LIKE "%' . $_REQUEST['search'] . '%" '
            . 'OR USR_NAME LIKE "%' . $_REQUEST['search'] . '%" '
            . 'OR USR_SURNAME LIKE "%' . $_REQUEST['search'] . '%"'
        . ')');

foreach($select as $key=>$value){
    array_push($array, $value->USR_ID); 
}


    header("content-type:application/json");
    echo json_encode($array);
    
?>