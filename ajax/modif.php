<?php


require_once "ajaxDatabaseInit.php";
require "../class/convertJson.php";

$array = $_REQUEST['array'];

$array['viewVersion'] = !empty($array['viewVersion']) ? $array['viewVersion'] : NULL;
$array['uViewVersion'] = !empty($array['uViewVersion']) ? $array['uViewVersion'] : NULL;
$array['imagingVersion'] = !empty($array['imagingVersion']) ? $array['imagingVersion'] : NULL;
  

$arrayAvant = [];
$arrayApres = [];

$avant = $bdd->query('SELECT * '
        . 'FROM YDA_CLIENT '
        . 'INNER JOIN YDA_PHONE ON CLI_ID = PHO_ID_CLI AND PHO_VALID = 1 '
        . 'INNER JOIN YDA_MAPS ON MPS_ID_PHO = PHO_ID '
        . 'WHERE CLI_ID="' . $array['id'] . '"', 'Clients');

$selectAvant = convert_json($avant);


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
        'valide' => '1',
        'id' => $array['id'],
        'ris' => $array['ris'],
        'pacs' => $array['pacs'],
        'view' => $array['viewVersion'],
        'uview' => $array['uViewVersion'],
        'imaging' => $array['imagingVersion']
        ));

//$nbPhone = $_REQUEST['nbPhone'];
//if (count($_REQUEST[listIdPhone]) != 0){
//    for ($i = 0; $i < $nbPhone; $i++){
//        $phone=str_replace('.', '', $_REQUEST[phone][$i]);
//        $phone=str_replace('-', '', $phone);
//        $phone=str_replace(' ', '', $phone);
//
//        $_REQUEST[email][$i] = !empty($_REQUEST[email][$i]) ? $_REQUEST[email][$i] : "NULL";
//        $_REQUEST[TX][$i] = !empty($_REQUEST[TX][$i]) ? $_REQUEST[TX][$i] : "NULL";
//
//            if(!empty($_REQUEST[listIdPhone][$i]) && $_REQUEST[listIdPhone][$i] != '' ){
//
//
//
//                $req = $bdd->prepare('UPDATE YDA_PHONE SET PHO_ID_CLI = :id, PHO_SITE = :site, PHO_PHONE = :phone, PHO_VALID = :valid, PHO_MAIL = :mail, PHO_TX = :TX, PHO_TV_ID = :idTV, PHO_TV_PASSWORD = :passwordTV WHERE PHO_ID ="' . $_REQUEST[listIdPhone][$i] .'"' );
//
//                $req->execute(array(
//                    'id' => $id,
//                    'site' => $_REQUEST[site][$i],
//                    'phone' => $phone,
//                'valid' => $_REQUEST[listDelete][$i],
//                'mail' => $_REQUEST[email][$i],
//                'TX' => $_REQUEST[TX][$i],
//                'idTV' => $_REQUEST[idTV][$i],
//                'passwordTV' => $_REQUEST[passwordTV][$i],
//                )) or die(print_r($bdd->errorInfo()));
//
//
//                $req2 = $bdd->prepare('UPDATE YDA_MAPS SET MPS_LAT = :lat, MPS_LON = :lon, MPS_ID_PHO = :id_pho, MPS_ID_CLI = :id_cli WHERE MPS_ID_PHO ="' . $_REQUEST[listIdPhone][$i] .'"' );
//
//                $req2->execute(array(
//                    'lat' => $_REQUEST[lat][$i],
//                    'lon' => $_REQUEST[lon][$i],
//                    'id_pho' => $_REQUEST[listIdPhone][$i],
//                'id_cli' => $id)) or die(print_r($bdd->errorInfo()));
//
//            }else{
//
//                $req = $bdd->prepare('INSERT INTO YDA_PHONE(PHO_ID_CLI, PHO_SITE, PHO_PHONE, PHO_VALID, PHO_MAIL, PHO_TX) VALUES (:id, :site, :phone, :valid, :mail, :TX)');
//
//                $req->execute(array(
//                    'id' => $id,
//                    'site' => $_REQUEST[site][$i],
//                    'phone' => $phone,
//                'valid' => '1',
//                'mail' => $_REQUEST[email][$i],
//                'TX' => $_REQUEST[TX][$i]	)) or die(print_r($bdd->errorInfo()));
//
//                $idPhoneInsert = '';
//                $select4 = $bdd->query('SELECT MAX(PHO_ID) FROM YDA_PHONE');
//
//                while ($query = $select4->fetch()){
//                    $idPhoneInsert = $query['MAX(PHO_ID)'];
//                }
//                $select4->closeCursor();
//
//
//                $req2 = $bdd->prepare('INSERT INTO YDA_MAPS(MPS_ID_PHO,MPS_ID_CLI,MPS_LAT,MPS_LON) VALUES (:id_pho, :id_cli, :lat, :lon)');
//
//                $req2->execute(array(
//                    'id_pho' => $idPhoneInsert,
//                    'id_cli' => $id,
//                    'lat' => $_REQUEST[lat][$i],
//                'lon' => $_REQUEST[lon][$i]	)) or die(print_r($bdd->errorInfo()));
//
//            }
//    }  
//}
//
//$selectApres = $bdd->query('SELECT * FROM YDA_CLIENT WHERE CLI_ID ="' . $id . '"');
//
//while ($query = $selectApres->fetch()){
//
//    $arrayApres['ville'] = $query['CLI_VILLE'];
//    if ($arrayApres['ville'] != $arrayAvant['ville']){$arrayApres['ville-change'] = 'red';}else{$arrayApres['ville-change'] = 'black';}
//
//    $arrayApres['nom'] = $query['CLI_NOM'];
//    if ($arrayApres['nom'] != $arrayAvant['nom']){$arrayApres['nom-change'] = 'red';}else{$arrayApres['nom-change'] = 'black';}
//
//    $arrayApres['url'] = $query['CLI_URL'];
//    if ($arrayApres['url'] != $arrayAvant['url']){$arrayApres['url-change'] = 'red';}else{$arrayApres['url-change'] = 'black';}
//
//    $arrayApres['version'] = $query['CLI_VERSION'];
//    if ($arrayApres['version'] != $arrayAvant['version']){$arrayApres['version-change'] = 'red';}else{$arrayApres['version-change'] = 'black';}
//
//    $arrayApres['tag'] = $query['CLI_TAG'];
//    if ($arrayApres['tag'] != $arrayAvant['tag']){$arrayApres['tag-change'] = 'red';}else{$arrayApres['tag-change'] = 'black';}
//
//    $arrayApres['ris'] = $query['CLI_RIS'];
//    if ($arrayApres['ris'] != $arrayAvant['ris']){$arrayApres['ris-change'] = 'red';}else{$arrayApres['ris-change'] = 'black';}
//
//    $arrayApres['pacs'] = $query['CLI_PACS'];
//    if ($arrayApres['pacs'] != $arrayAvant['pacs']){$arrayApres['pacs-change'] = 'red';}else{$arrayApres['pacs-change'] = 'black';}
//
//    $arrayApres['view'] = $query['CLI_VIEW'];
//    if ($arrayApres['view'] != $arrayAvant['view']){$arrayApres['view-change'] = 'red';}else{$arrayApres['view-change'] = 'black';}
//
//    $arrayApres['uview'] = $query['CLI_UVIEW'];
//    if ($arrayApres['uview'] != $arrayAvant['uview']){$arrayApres['uview-change'] = 'red';}else{$arrayApres['uview-change'] = 'black';}
//
//    $arrayApres['imaging'] = $query['CLI_NUM_VERSION'];
//    if ($arrayApres['imaging'] != $arrayAvant['imaging']){$arrayApres['imaging-change'] = 'red';}else{$arrayApres['imaging-change'] = 'black';}
//
//
//    $selectApresPhone = $bdd->query('SELECT * FROM YDA_PHONE INNER JOIN YDA_MAPS ON MPS_ID_PHO = PHO_ID WHERE PHO_ID_CLI ="' . $id . '" AND PHO_VALID = 1');
//    $idx = 0;            
//    while ($query2 = $selectApresPhone->fetch()){
//
//        $arrayApres['phone'][$idx]['site'] = $query2['PHO_SITE'];
//        $arrayApres['phone'][$idx]['phone'] = $query2['PHO_PHONE'];
//        $arrayApres['phone'][$idx]['lat'] = $query2['MPS_LAT'];
//        $arrayApres['phone'][$idx]['lon'] = $query2['MPS_LON'];
//        $arrayApres['phone'][$idx]['mail'] = $query2['PHO_MAIL'];
//        $arrayApres['phone'][$idx]['TX'] = $query2['PHO_TX'];
//        $idx = $idx + 1;    
//    }
//
//
//}
//
//
//
//$array['ok'] = 'ok';
//$array['avant'] = $arrayAvant;
//$array['apres'] = $arrayApres;
//
//echo json_encode($array);
//// echo '</pre>';