<?php 
require_once "ajaxDatabaseInit.php";
$array = $_REQUEST['array'];

$array['viewVersion'] = !empty($array['viewVersion']) ? $array['viewVersion'] : NULL;
$array['uViewVersion'] = !empty($array['uViewVersion']) ? $array['uViewVersion'] : NULL;
$array['imagingVersion'] = !empty($array['imagingVersion']) ? $array['imagingVersion'] : NULL;


$req = $bdd->prepare('INSERT INTO YDA_CLIENT'
    . '(CLI_VILLE, CLI_NOM, CLI_URL, CLI_VERSION, CLI_TAG, CLI_VALID, CLI_RIS, CLI_PACS, CLI_VIEW, CLI_UVIEW, CLI_NUM_VERSION) '
    . 'VALUES (:ville, :nom, :url, :version, :tag, :valid, :ris, :pacs, :view, :uview, :imaging)');

$req->execute(array(
    'ville' => $array['ville'],
    'nom' => $array['nom'],
    'url' => $array['url'],
    'version' => $array['version'],
    'tag' => $array['tag'],    
    'ris' => $array['ris'],
    'pacs' => $array['pacs'],
    'view' => $array['viewVersion'],
    'uview' => $array['uViewVersion'],
    'imaging' => $array['imagingVersion'],
    'valid' => '1'
    ));

$idInsert = $bdd->lastInsertId(); 

for ($i = 0; $i < $array['nbPhone']; $i++){

    $phone1=str_replace('.', '', $array['phone'][$i]);
    $phone2=str_replace('-', '', $phone1);
    $phone=str_replace(' ', '', $phone2);

    $site = isset($array['site'][$i])?$array['site'][$i]:null;
    $lat = isset($array['lat'][$i])?$array['lat'][$i]:null;
    $lon = isset($array['lon'][$i])?$array['lon'][$i]:null;
    $email = isset($array['mail'][$i])?$array['mail'][$i]:null;
    $TX = isset($array['TX'][$i])?$array['TX'][$i]:null;
    $idTV = isset($array['idTV'][$i])?$array['idTV'][$i]:null;
    $passwordTV = isset($array['passwordTV'][$i])?$array['passwordTV'][$i]:null;
    
    $req = $bdd->prepare('INSERT INTO YDA_PHONE'
            . '(PHO_ID_CLI, PHO_SITE, PHO_PHONE, PHO_VALID, PHO_MAIL, PHO_TX, PHO_TV_ID, PHO_TV_PASSWORD)'
            . ' VALUES (:id, :site, :phone, :valid, :mail, :TX, :idTV, :passwordTV)');

    $req->execute(array(
    'id' => $idInsert,
    'site' => $site,
    'phone' => $phone,
    'valid' => '1',
    'mail' => $email,
    'TX' => $TX,
    'idTV' => $idTV,
    'passwordTV' => $passwordTV));

    $idPhoneInsert = $bdd->lastInsertId();

    $req2 = $bdd->prepare('INSERT INTO YDA_MAPS'
            . '(MPS_ID_PHO,MPS_ID_CLI,MPS_LAT,MPS_LON)'
            . ' VALUES (:id_pho, :id_cli, :lat, :lon)');
    
    $req2->execute(array(
    'id_pho' => $idPhoneInsert,
    'id_cli' => $idInsert,
    'lat' => $lat,
    'lon' => $lon));
}

$selectNewCusto = $bdd->queryObj('SELECT * '
        . ' FROM YDA_NOTIF '
        . ' INNER JOIN YDA_USERS ON USR_ID = NTF_ID_USR '
        . ' WHERE NTF_CREATE = 1'
        . ' AND USR_DELETE IS NULL');
$update = $bdd->prepare('UPDATE YDA_NOTIF SET NTF_UPDATE = :update WHERE NTF_ID_USR = :id');

foreach($selectNewCusto as $value){
    $update ->execute(array(
    'id' => $value->USR_ID,
    'update' => $value->NTF_UPDATE.','.$idInsert
    ));
}

$retour['result'] = 'ok';
$retour['id'] = $idInsert;

echo json_encode($retour);


