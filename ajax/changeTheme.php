<?php 

require_once "ajaxDatabaseInit.php";
header('Content-Type: text/plain; charset=utf-8');

if ($_REQUEST['theme'] == 'light'){
    $theme = 1;
}else{
    $theme = 0;
}

$update = $bdd->prepare('UPDATE YDA_USERS '
        . 'SET USR_THEME = :theme '
        . 'WHERE USR_ID = :id');
    
$update ->execute(array(
    'id' => $_REQUEST['id'],
    'theme' => $theme
    ));


echo 'ok';

?>