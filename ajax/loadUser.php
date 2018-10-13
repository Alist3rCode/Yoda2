<?php 
require_once "ajaxDatabaseInit.php";


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
    $array['isRef'] = $select[0]->USR_REFERING;
    $array['isDirection'] = $select[0]->USR_DIRECTION;
    $array['surname'] = $select[0]->USR_SURNAME;
    $array['teamviewer'] = $select[0]->USR_TEAMVIEWER;

    
}
echo json_encode($array);
    
?>