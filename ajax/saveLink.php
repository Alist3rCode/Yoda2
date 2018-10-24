<?php 
require_once "ajaxDatabaseInit.php";

$select = $bdd->queryObj('SELECT count(*) as "Count" '
        . 'FROM INT_LINK '
        . 'WHERE LNK_URL ="'.$_REQUEST['url'].'"');

if ($select[0]->Count === '0'){
    $req = $bdd->prepare('INSERT INTO INT_LINK '
        . '(LNK_NAME, LNK_URL, LNK_ID_SEC, LNK_IMAGE, LNK_VALID) '
        . 'values(:name, :url, :section, :image, :valid) ');
    
    $req->execute(array(
    'name' => ucfirst($_REQUEST['name']),
    'url' => $_REQUEST['url'],
    'section' => $_REQUEST['section'],
    'image' => $_REQUEST['image'],
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