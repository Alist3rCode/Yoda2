<?php 
require_once "ajaxDatabaseInit.php";


$arrayCustomerConfig = [];
$select = $bdd->queryObj('SELECT * '
        . 'FROM YDA_CLIENT '
        . 'WHERE CLI_VALID = 1 '
        . 'ORDER BY CLI_VILLE ASC ');
$arrayCustomerConfig['client'] = [];

foreach($select as $key=>$value){

    $arrayTempConfig['id']= $value->CLI_ID;
    $arrayTempConfig['ville'] = $value->CLI_VILLE;
    $arrayTempConfig['nom'] = $value->CLI_NOM;
    array_push($arrayCustomerConfig['client'], $arrayTempConfig);

}

$select3 = $bdd->queryObj('SELECT * '
        . 'FROM YDA_NOTIF '
        . 'WHERE NTF_ID_USR="' . $_REQUEST['id'] . '"');

foreach($select3 as $key=>$value){

    $arrayCustomerConfig['notif'] = explode(',',$value->NTF_UPDATE);
    $arrayCustomerConfig['create'] = $value->NTF_CREATE;
    $arrayCustomerConfig['modif'] = $value->NTF_MODIF;
    $arrayCustomerConfig['new_custo'] = $value->NTF_NEW_CUSTO;

}
if(empty($arrayCustomerConfig['notif'])){
    $arrayCustomerConfig['notif'] = '';
    $arrayCustomerConfig['create'] = 0;
    $arrayCustomerConfig['modif'] = 0;
    $arrayCustomerConfig['new_custo'] = 0;
}

header("content-type:application/json");
echo json_encode($arrayCustomerConfig);

?>