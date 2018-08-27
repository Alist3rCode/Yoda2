<?php

require_once "ajaxDatabaseInit.php";
    
require "../class/convertJson.php";

$client = $bdd->query('SELECT * '
        . 'FROM YDA_CLIENT '
        . 'INNER JOIN YDA_PHONE ON CLI_ID = PHO_ID_CLI AND PHO_VALID = 1 '
        . 'INNER JOIN YDA_MAPS ON MPS_ID_PHO = PHO_ID '
        . 'WHERE CLI_ID="' . $_REQUEST['id'] . '"', 'Clients');

header("content-type:application/json");
echo json_encode(convert_json($client));
