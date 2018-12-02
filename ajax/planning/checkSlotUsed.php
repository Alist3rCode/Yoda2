<?php 
require_once "../ajaxDatabaseInit.php";

$select = $bdd->queryObj('SELECT count(*) as Count '
        . 'FROM PLA_SLOT '
        . 'WHERE SLO_ID_SCO = "'.$_REQUEST['id'].'"');

if($select[0]->Count > 0){
    $retour = 'nok';
}else {
    $retour = 'ok';
}

echo $retour;