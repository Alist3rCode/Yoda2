<?php 
require_once "../ajaxDatabaseInit.php";

if(isset($_REQUEST["email"]) && $_REQUEST["email"] != ''){
    $select = $bdd->queryObj('SELECT USR_ID '
            . 'FROM YDA_USERS '
            . 'WHERE USR_MAIL="' . $_REQUEST["email"] . '"');

    if (count($select) > 0) {

        $retour = $select[0]->USR_ID;
    } else {
        $retour = '';
    }
}

echo $retour;

?>