<?php 
require_once "ajaxDatabaseInit.php";

$select = $bdd->queryObj('SELECT count(*) as "Count" FROM INT_LINK WHERE LNK_ID_SEC ="'.$_REQUEST['id'].'" AND LNK_VALID = 1');

if ($select[0]->Count != 0){
    $array['delete'] = "NO";
}else{
    $array['delete'] = "YES";
}


$array['ok'] = 'ok';


 header("content-type:application/json");
    echo json_encode($array);



?>