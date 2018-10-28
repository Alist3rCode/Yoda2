<?php


require_once "../ajaxDatabaseInit.php";
require "../../class/convertJson.php";

$array = $_REQUEST['array'];

$array['viewVersion'] = !empty($array['viewVersion']) ? $array['viewVersion'] : NULL;
$array['uViewVersion'] = !empty($array['uViewVersion']) ? $array['uViewVersion'] : NULL;
$array['imagingVersion'] = !empty($array['imagingVersion']) ? $array['imagingVersion'] : NULL;
  
 $update = $bdd->prepare('UPDATE YDA_CLIENT '
        . 'SET CLI_VILLE = :ville, '
        . 'CLI_NOM = :nom, '
        . 'CLI_URL = :url, '
        . 'CLI_VERSION = :version, '
        . 'CLI_TAG = :tag, '
        . 'CLI_VALID = :valide, '
        . 'CLI_RIS = :ris, '
        . 'CLI_PACS = :pacs, '
        . 'CLI_VIEW = :view, '
        . 'CLI_UVIEW = :uview, '
        . 'CLI_NUM_VERSION = :imaging '
        . 'WHERE CLI_ID = :id');
        
        
$update->execute(array(
        'ville' => $array['ville'],
        'nom' => $array['nom'],
        'url' => $array['url'],
        'version' => $array['version'],
        'tag' => $array['tag'],
        'valide' => '0',
        'id' => $array['id'],
        'ris' => $array['ris'],
        'pacs' => $array['pacs'],
        'view' => $array['viewVersion'],
        'uview' => $array['uViewVersion'],
        'imaging' => $array['imagingVersion']
        )) or die(print_r($bdd->errorInfo()));

$nbPhone = $array['nbPhone'];


for ($i = 0; $i < $nbPhone; $i++){
        
    $coma = ['.','-',' ', '/', '_'];
    $phone=str_replace($coma, '', $array['phone'][$i]);

    $array['email'][$i] = !empty($array['email'][$i]) ? $array['email'][$i] : null;
    $array['lat'][$i] = !empty($array['lat'][$i]) ? $array['lat'][$i] : 'null';
    $array['lon'][$i] = !empty($array['lon'][$i]) ? $array['lon'][$i] : 'null';
    $array['site'][$i] = !empty($array['site'][$i]) ? $array['site'][$i] : null;
    $array['TX'][$i] = !empty($array['TX'][$i]) ? $array['TX'][$i] : null;
    $array['idTV'][$i] = !empty($array['idTV'][$i]) ? $array['idTV'][$i] : null;
    $array['passwordTV'][$i] = !empty($array['passwordTV'][$i]) ? $array['passwordTV'][$i] : null;

    if(!empty($array['listIdPhone'][$i]) && $array['listIdPhone'][$i] != '' ){

        $req = $bdd->prepare('UPDATE YDA_PHONE '
                . 'SET PHO_ID_CLI = :id, '
                . 'PHO_SITE = :site, '
                . 'PHO_PHONE = :phone, '
                . 'PHO_VALID = :valid, '
                . 'PHO_MAIL = :mail, '
                . 'PHO_TX = :TX, '
                . 'PHO_TV_ID = :idTV, '
                . 'PHO_TV_PASSWORD = :passwordTV '
                . 'WHERE PHO_ID ="' . $array['listIdPhone'][$i] .'"' );

        $req->execute(array(
            'id' => $array['id'],
            'site' => $array['site'][$i],
            'phone' => $phone,
            'valid' => '0',
            'mail' => $array['email'][$i],
            'TX' => $array['TX'][$i],
            'idTV' => $array['idTV'][$i],
            'passwordTV' => $array['passwordTV'][$i],
            )) or die(print_r($bdd->errorInfo()));


        $req2 = $bdd->prepare('UPDATE YDA_MAPS '
                . 'SET MPS_LAT = :lat, '
                . 'MPS_LON = :lon, '
                . 'MPS_ID_PHO = :id_pho, '
                . 'MPS_ID_CLI = :id_cli '
                . 'WHERE MPS_ID_PHO ="' . $array['listIdPhone'][$i] .'"' );

        $req2->execute(array(
            'lat' => $array['lat'][$i],
            'lon' => $array['lon'][$i],
            'id_pho' => $array['listIdPhone'][$i],
            'id_cli' => $array['id'])) or die(print_r($bdd->errorInfo()));

    }else{

        $req = $bdd->prepare('INSERT INTO YDA_PHONE(PHO_ID_CLI, PHO_SITE, PHO_PHONE, PHO_VALID, PHO_MAIL, PHO_TX) '
                . 'VALUES (:id, :site, :phone, :valid, :mail, :TX)');

        $req->execute(array(
            'id' => $array['id'],
            'site' => $array['site'][$i],
            'phone' => $phone,
            'valid' => '0',
            'mail' => $array['email'][$i],
            'TX' => $array['TX'][$i]	)) or die(print_r($bdd->errorInfo()));


        $idPhoneInsert = $bdd->lastInsertId(); 

        $req2 = $bdd->prepare('INSERT INTO YDA_MAPS(MPS_ID_PHO,MPS_ID_CLI,MPS_LAT,MPS_LON) '
                . 'VALUES (:id_pho, :id_cli, :lat, :lon)');

        $req2->execute(array(
            'id_pho' => $idPhoneInsert,
            'id_cli' => $id,
            'lat' => $array['lat'][$i],
            'lon' => $array['lon'][$i])) or die(print_r($bdd->errorInfo()));
    }
}  


echo 'ok';

// echo '</pre>';