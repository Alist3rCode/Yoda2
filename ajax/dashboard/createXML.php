<?php
require_once "ajaxDatabaseInit.php";

switch ($_REQUEST['search']) {
    case 'all':
        $select = $bdd->queryObj("SELECT MPS_ID, "
        . "CONCAT(CLI_VILLE, ' - ', CLI_NOM) as 'Name', "
        . "PHO_SITE, "
        . "MPS_LAT, "
        . "MPS_LON, "
        . "CLI_RIS, "
        . "CLI_PACS, "
        . "CLI_VERSION "
        . "FROM YDA_MAPS "
        . "JOIN YDA_CLIENT ON MPS_ID_CLI = CLI_ID "
        . "JOIN YDA_PHONE ON MPS_ID_PHO = PHO_ID "
        . "WHERE CLI_VALID = 1 "
        . "AND PHO_VALID = 1");
        break;
    case 'v6':
        $select = $bdd->queryObj("SELECT MPS_ID, "
        . "CONCAT(CLI_VILLE, ' - ', CLI_NOM) as 'Name', "
        . "PHO_SITE, "
        . "MPS_LAT, "
        . "MPS_LON, "
        . "CLI_RIS, "
        . "CLI_PACS, "
        . "CLI_VERSION "
        . "FROM YDA_MAPS "
        . "JOIN YDA_CLIENT ON MPS_ID_CLI = CLI_ID "
        . "JOIN YDA_PHONE ON MPS_ID_PHO = PHO_ID "
        . "WHERE CLI_VALID = 1 "
        . "AND PHO_VALID = 1 "
        . "AND CLI_VERSION = 'v6'");
        break;
    case 'v7':
        $select = $bdd->queryObj("SELECT MPS_ID, "
        . "CONCAT(CLI_VILLE, ' - ', CLI_NOM) as 'Name', "
        . "PHO_SITE, "
        . "MPS_LAT, "
        . "MPS_LON, "
        . "CLI_RIS, "
        . "CLI_PACS, "
        . "CLI_VERSION "
        . "FROM YDA_MAPS "
        . "JOIN YDA_CLIENT ON MPS_ID_CLI = CLI_ID "
        . "JOIN YDA_PHONE ON MPS_ID_PHO = PHO_ID "
        . "WHERE CLI_VALID = 1 "
        . "AND PHO_VALID = 1 "
        . "AND CLI_VERSION = 'v7'");
        break;
    case 'v8':
        $select = $bdd->queryObj("SELECT MPS_ID, "
        . "CONCAT(CLI_VILLE, ' - ', CLI_NOM) as 'Name', "
        . "PHO_SITE, "
        . "MPS_LAT, "
        . "MPS_LON, "
        . "CLI_RIS, "
        . "CLI_PACS, "
        . "CLI_VERSION "
        . "FROM YDA_MAPS "
        . "JOIN YDA_CLIENT ON MPS_ID_CLI = CLI_ID "
        . "JOIN YDA_PHONE ON MPS_ID_PHO = PHO_ID "
        . "WHERE CLI_VALID = 1 "
        . "AND PHO_VALID = 1 "
        . "AND CLI_VERSION = 'v8'");
        break;
    case 'ris':
        $select = $bdd->queryObj("SELECT MPS_ID, "
        . "CONCAT(CLI_VILLE, ' - ', CLI_NOM) as 'Name', "
        . "PHO_SITE, "
        . "MPS_LAT, "
        . "MPS_LON, "
        . "CLI_RIS, "
        . "CLI_PACS, "
        . "CLI_VERSION "
        . "FROM YDA_MAPS "
        . "JOIN YDA_CLIENT ON MPS_ID_CLI = CLI_ID "
        . "JOIN YDA_PHONE ON MPS_ID_PHO = PHO_ID "
        . "WHERE CLI_VALID = 1 "
        . "AND PHO_VALID = 1 "
        . "AND CLI_RIS = 1 "
        . "AND CLI_PACS = 0");
        break;
    case 'pacs':
        $select = $bdd->queryObj("SELECT MPS_ID, "
        . "CONCAT(CLI_VILLE, ' - ', CLI_NOM) as 'Name', "
        . "PHO_SITE, "
        . "MPS_LAT, "
        . "MPS_LON, "
        . "CLI_RIS, "
        . "CLI_PACS, "
        . "CLI_VERSION "
        . "FROM YDA_MAPS "
        . "JOIN YDA_CLIENT ON MPS_ID_CLI = CLI_ID "
        . "JOIN YDA_PHONE ON MPS_ID_PHO = PHO_ID "
        . "WHERE CLI_VALID = 1 "
        . "AND PHO_VALID = 1 "
        . "AND CLI_RIS = 0 "
        . "AND CLI_PACS = 1");
        break;
    case 'rispacs':
        $select = $bdd->queryObj("SELECT MPS_ID, "
        . "CONCAT(CLI_VILLE, ' - ', CLI_NOM) as 'Name', "
        . "PHO_SITE, "
        . "MPS_LAT, "
        . "MPS_LON, "
        . "CLI_RIS, "
        . "CLI_PACS, "
        . "CLI_VERSION "
        . "FROM YDA_MAPS "
        . "JOIN YDA_CLIENT ON MPS_ID_CLI = CLI_ID "
        . "JOIN YDA_PHONE ON MPS_ID_PHO = PHO_ID "
        . "WHERE CLI_VALID = 1 "
        . "AND PHO_VALID = 1 "
        . "AND CLI_RIS = 1 "
        . "AND CLI_PACS = 1");
        break;
    case 'none':
        $select = $bdd->queryObj("SELECT MPS_ID, "
        . "CONCAT(CLI_VILLE, ' - ', CLI_NOM) as 'Name', "
        . "PHO_SITE, "
        . "MPS_LAT, "
        . "MPS_LON, "
        . "CLI_RIS, "
        . "CLI_PACS, "
        . "CLI_VERSION "
        . "FROM YDA_MAPS "
        . "JOIN YDA_CLIENT ON MPS_ID_CLI = CLI_ID "
        . "JOIN YDA_PHONE ON MPS_ID_PHO = PHO_ID "
        . "WHERE CLI_VALID = 1 "
        . "AND PHO_VALID = 1 "
        . "AND CLI_RIS = 0 "
        . "AND CLI_PACS = 0");
        break;
}


$xml = '<markers>';

foreach($select as $key=>$value){
    
$version = $value->CLI_VERSION;

    if($value->CLI_RIS == 0 && $value->CLI_PACS == 0){
        $activity = 'nada';
    }
    if($value->CLI_RIS == 1 && $value->CLI_PACS == 0){
        $activity = 'ris';
    }
    if($value->CLI_RIS == 0 && $value->CLI_PACS == 1){
        $activity = 'pacs';
    }
    if($value->CLI_RIS == 1 && $value->CLI_PACS == 1){
        $activity = 'rispacs';
    }
    
    $xml .= '<marker id="' . $value->MPS_ID 
            . '" name="' . $value->Name
            . '" address= "' . $value->PHO_SITE
            . '" lat="' . $value->MPS_LAT 
            . '" lng="' . $value->MPS_LON 
            . '"  activity="' . $activity 
            . '"  version="' . $version . '"  />' ;
}

$xml.='</markers>';

unlink("../address.xml");
$xmlFile = fopen("../address.xml", "x+");
fwrite($xmlFile, $xml);
//file_put_contents("../address.xml",$xml);

echo $xml;

?>