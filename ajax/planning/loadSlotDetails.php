<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

require_once "../ajaxDatabaseInit.php";   
   
$i = $_REQUEST['id'];

$select = $bdd->queryObj('SELECT * FROM PLA_SLOT'
        . ' INNER JOIN YDA_USERS ON SLO_ID_USR = USR_ID '
        . ' INNER JOIN PLA_SLOT_CONFIG ON SLO_ID_SCO = SCO_ID'
        . ' WHERE SLO_ID ="' . $i . '"');
//
?>
<div style="text-align: left;background-color:grey;opacity:1!important">
    

    Détail du créneau du <br><b><?=$select[0]->SLO_DATE?></b>
    
    <br>Technicien : <b><span style="text-transform: capitalize;color:<?=$select[0]->USR_COLOR?>"><?=$select[0]->USR_FIRST_NAME?> <?=$select[0]->USR_NAME?></span></b>
    <br>Créneau : <span style="color: #<?=$select[0]->SCO_COLOR?>"><b><?=$select[0]->SCO_NAME?></b></span>
    <br>Début : <b><?=$select[0]->SCO_START?></b>
    <br>Fin : <b><?=$select[0]->SCO_STOP?></b>
       
</div>