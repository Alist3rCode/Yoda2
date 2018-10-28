<?php 
require_once "../ajaxDatabaseInit.php";


$search = $bdd->queryObj('SELECT DISTINCT CLI_ID '
        . 'FROM YDA_CLIENT '
        . 'LEFT JOIN YDA_PHONE ON (CLI_ID = PHO_ID_CLI AND PHO_VALID = 1) '
        . 'WHERE (CLI_VILLE LIKE "%' . $_REQUEST['search'] . '%" '
        . 'OR CLI_NOM LIKE "%' . $_REQUEST['search'] . '%" '
        . 'OR CLI_URL LIKE "%' . $_REQUEST['search'] . '%" '
        . 'OR CLI_TAG LIKE "%' . $_REQUEST['search'] . '%" '
        . 'OR PHO_SITE LIKE "%' . $_REQUEST['search'] . '%" '
        . 'OR PHO_PHONE LIKE "%' . $_REQUEST['search'] . '%" '
        . 'OR PHO_MAIL LIKE "%' . $_REQUEST['search'] . '%" '
        . 'OR PHO_TX LIKE "%' . $_REQUEST['search'] . '%") '
        . 'AND CLI_VALID=1');



 header("content-type:application/json");
    echo json_encode($search);



?>