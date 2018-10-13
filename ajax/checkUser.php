<?php 
require_once "ajaxDatabaseInit.php";

$today = date("Y-m-d H:i:s");  

if(isset($_REQUEST["email"]) && $_REQUEST["email"] != ''){
    $select = $bdd->queryObj('SELECT * FROM YDA_USERS WHERE USR_MAIL="' . $_REQUEST["email"] . '"');

    $dateCrea = $select[0]->USR_CREATE;
    $dateSupp = $select[0]->USR_DELETE;
    $mailSql = $select[0]->USR_MAIL;
    
}
if ($dateCrea == '' && $mailSql !=''){
    echo 'WAIT';
}else if($dateCrea < $today && $dateCrea != ''){
    if($dateSupp > $today && $dateSupp != ''){
        echo 'NOPE';
    }else{
        echo 'WELCOME';
    }
}else{
    echo 'DUNNO';
}
    
