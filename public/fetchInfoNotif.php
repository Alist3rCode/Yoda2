<?php

$bdd = new Database('yoda');

$arrayCustomer = [];
$select2 = $bdd->queryObj('SELECT * '
        . 'FROM YDA_CLIENT '
        . 'WHERE CLI_VALID = 1 '
        . 'ORDER BY CLI_VILLE ASC ');

$arrayCustomer['client'] = [];

foreach($select2 as $key=>$value){

    $arrayTemp['id']= $value->CLI_ID;
    $arrayTemp['ville'] = $value->CLI_VILLE;
    $arrayTemp['nom'] = $value->CLI_NOM;
    array_push($arrayCustomer['client'], $arrayTemp);

}

$select3 = $bdd->queryObj('SELECT * '
        . 'FROM YDA_NOTIF '
        . 'WHERE NTF_ID_USR="' . $_SESSION['id_user'] . '"');

foreach($select3 as $key=>$value){

    $arrayCustomer['notif'] = explode(',',$value->NTF_UPDATE);
    $arrayCustomer['create'] = $value->NTF_CREATE;
    $arrayCustomer['modif'] = $value->NTF_MODIF;
    $arrayCustomer['new_custo'] = $value->NTF_NEW_CUSTO;

}

$arrayUser = [];
$selectUser = $bdd->queryObj('SELECT * '
        . 'FROM YDA_USERS '
        . 'WHERE USR_DELETE IS NULL '
        . 'ORDER BY USR_FIRST_NAME ASC');
$arrayUser['user'] = [];

foreach($selectUser as $key=>$value){

    $arrayTempUser['id']= $value->USR_ID;
    $arrayTempUser['mail'] = $value->USR_MAIL;
    $arrayTempUser['profil'] = $value->USR_ID_PRO;
    $arrayTempUser['prenom'] = $value->USR_FIRST_NAME;
    $arrayTempUser['nom'] = $value->USR_NAME;

    array_push($arrayUser['user'], $arrayTempUser);

}

$selectProfil = $bdd->queryObj('SELECT * '
        . 'FROM YDA_PROFIL '
        . 'WHERE PRO_VALID = 1');
$arrayUser['profil'] = [];
foreach($selectProfil as $key=>$value){

    $arrayTempProf['id'] = $value->PRO_ID;
    $arrayTempProf['name'] = $value->PRO_NAME;

    array_push($arrayUser['profil'], $arrayTempProf);
}
