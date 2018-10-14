<?php 
require_once "ajaxDatabaseInit.php";

$array = [];

if(isset($_REQUEST["id"]) && $_REQUEST["id"] != ''){
    $select = $bdd->queryObj('SELECT * '
            . 'FROM YDA_USERS '
            . 'JOIN YDA_PROFIL ON USR_ID_PRO = PRO_ID '
            . 'WHERE USR_ID="' . $_REQUEST["id"] . '"');

    $array['email'] = $select[0]->USR_MAIL;
    $array['name'] = $select[0]->USR_FIRST_NAME;
    $array['lastName'] = $select[0]->USR_NAME;
//    echo $query['page'];
    switch ($select[0]->USR_PAGE) {
        case 'index.php' :
            $array['page'] = 'Dashboard';
            break;
        case 'yoda.php' :
            $array['page'] = 'Clients';
            break;
        case 'maps.php' :
            $array['page'] = 'Carte';
            break;
        case 'interne.php' :
            $array['page'] = 'Interne';
            break;
    }
    
    if($select[0]->USR_CREATE == ''){
        $array['actif'] = 0;
    }else if($select[0]->USR_DELETE != ''){
        $array['actif'] = 1;
    }else{
        $array['actif'] = 2;
    }

    $array['profil'] = $select[0]->PRO_NAME;
    $array['idProfil'] = $select[0]->USR_ID_PRO;

    $array['isTech'] = $select[0]->USR_TECH;
    $array['surname'] = $select[0]->USR_SURNAME;
    
    $select2 = $bdd->queryObj('SELECT * '
        . 'FROM YDA_RIGHT');
    
    $array['right'] = [];


    foreach($select2 as $key=>$value){
        $arrayTemp['id']= $value->RGT_ID;
        $arrayTemp['name'] = $value->RGT_NAME;
        array_push($array['right'], $arrayTemp);

    }

    $select = $bdd->queryObj('SELECT * '
            . 'FROM YDA_USERS '
            . 'INNER JOIN YDA_PROFIL ON USR_ID_PRO = PRO_ID '
            . 'WHERE USR_ID="' . $_REQUEST["id"] . '"');

    $array['profil'] = $select[0]->PRO_NAME;
    $idProfil = $select[0]->PRO_ID;
    $array['hook'] = [];
    $array['hook']['Profil'] = [];
    $array['hook']['User'] = [];

    $select3 = $bdd->queryObj('SELECT * '
            . 'FROM YDA_HOOK '
            . 'WHERE HOK_ID_TYPE="' . $idProfil . '"'
            . 'AND HOK_TYPE ="Profil"');
    
    foreach($select3 as $key=>$value){

        array_push($array['hook']['Profil'],$value->HOK_ID_RGT);
    } 
    
    $select4 = $bdd->queryObj('SELECT * '
            . 'FROM YDA_HOOK '
            . 'WHERE HOK_ID_TYPE="' . $_REQUEST["id"] . '"'
            . 'AND HOK_TYPE ="User"');
    
    foreach($select4 as $key=>$value){

        array_push($array['hook']['User'],$value->HOK_ID_RGT);
    }  
}

header("content-type:application/json");

echo json_encode($array);
    
?>