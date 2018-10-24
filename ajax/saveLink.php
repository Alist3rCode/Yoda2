<?php 
require_once "ajaxDatabaseInit.php";

$select = $bdd->queryObj('SELECT count(*) as "Count" '
        . 'FROM INT_LINK '
        . 'WHERE LNK_URL ="'.$_REQUEST['url'].'"');

$selectSection = $bdd->queryObj('SELECT MAX(LNK_ORDER) as "maxOrder" '
        . 'FROM INT_LINK '
        . 'WHERE LNK_ID_SEC = "'. $_REQUEST['section'].'"' );

$order = $selectSection[0]->maxOrder + 1;
if ($select[0]->Count === '0'){
    $req = $bdd->prepare('INSERT INTO INT_LINK '
        . '(LNK_NAME, LNK_URL, LNK_ID_SEC, LNK_IMAGE, LNK_ORDER, LNK_VALID) '
        . 'values(:name, :url, :section, :image, :order, :valid) ');
    
    $req->execute(array(
    'name' => ucfirst($_REQUEST['name']),
    'url' => $_REQUEST['url'],
    'section' => $_REQUEST['section'],
    'image' => $_REQUEST['image'],
    'order' => $order,
    'valid' => 1        
    )) or die(print_r($req->errorInfo()));
    
    $array['ok'] = 'ok';
}else{
    $array['ok'] = 'nok';
    $array['error'] = 'Un lien existe déja pour cette URL.';
}

 header("content-type:application/json");
    echo json_encode($array);



?>