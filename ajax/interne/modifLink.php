<?php 
require_once "../ajaxDatabaseInit.php";

$select = $bdd->queryObj('SELECT count(*) as "Count" '
        . 'FROM INT_LINK '
        . 'WHERE LNK_URL ="'.$_REQUEST['url'].'"'
        . 'AND LNK_ID <> "'.$_REQUEST['id'].'"');

if ($select[0]->Count === '0'){
    
    $req = $bdd->prepare('UPDATE INT_LINK '
            . 'SET LNK_NAME = :name, '
            . 'LNK_URL = :url, '
            . 'LNK_ID_SEC = :section, '
            . 'LNK_VALID = :valid, '
            . 'LNK_IMAGE = :image '
            . 'WHERE LNK_ID = :id');
    
    $extension = explode('.', $_REQUEST['image']);
    
    $req->execute(array(
    'name' => ucfirst($_REQUEST['name']),
    'url' => $_REQUEST['url'],
    'section' => $_REQUEST['section'],
    'valid' => $_REQUEST['valid'],
    'image' => $_REQUEST['name'].'.'.$extension[(count($extension)-1)],
    'id' => $_REQUEST['id']
    )) or die(print_r($req->errorInfo()));
    
    $extension = explode('.', $_REQUEST['image']);
    
    rename("../public/img/interne/".$_REQUEST['image'], "../public/img/interne/".$_REQUEST['name'].'.'.$extension[(count($extension)-1)]);
    
    
    $array['ok'] = 'ok';
}else{
    $array['ok'] = 'nok';
    $array['error'] = 'Un autre lien existe déja pour cette URL.';
}

 header("content-type:application/json");
    echo json_encode($array);



?>