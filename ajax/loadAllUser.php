<?php 
require_once "ajaxDatabaseInit.php";

$array2 = [];

if($_REQUEST['id'] == 'ALL'){
    if ($_REQUEST['mode'] == 'notif'){
        $select = $bdd->queryObj('SELECT * '
                . 'FROM YDA_USERS '
                . 'JOIN YDA_PROFIL ON PRO_ID = USR_ID_PRO AND USR_DELETE IS NULL '
                . 'ORDER BY USR_FIRST_NAME ');
    }
    if ($_REQUEST['mode'] == 'profil'){
        $select = $bdd->queryObj('SELECT * '
                . 'FROM YDA_USERS '
                . 'JOIN YDA_PROFIL ON PRO_ID = USR_ID_PRO '
                . 'ORDER BY USR_FIRST_NAME ');
    }
    
    foreach($select as $key=>$value){
        
        $array['id'] = $value->USR_ID;
        $array['profil'] = $value->PRO_NAME;
        $array['name'] = $value->USR_FIRST_NAME;
        $array['lastName'] = $value->USR_NAME;
        if($value->USR_CREATE == ''){
            $array['color'] = 'orange';
        }else if($value->USR_DELETE != ''){
            $array['color'] = 'red';
        }else{
            $array['color'] = 'black';
        }
        array_push($array2, $array);
    }
    
}else{
    $select = $bdd->queryObj('SELECT * '
            . 'FROM YDA_USERS '
            . 'JOIN YDA_PROFIL ON PRO_ID = USR_ID_PRO '
            . 'WHERE USR_ID in (' . $_REQUEST['id'] . ') '
            . 'ORDER BY USR_FIRST_NAME');

    $array['id'] = $select[0]->USR_ID;
    $array['profil'] = $select[0]->PRO_NAME;
    $array['name'] = $select[0]->USR_FIRST_NAME;
    $array['lastName'] = $select[0]->USR_NAME;
    if($select[0]->USR_CREATE == ''){
        $array['color'] = 'orange';
    }else if($select[0]->USR_DELETE != ''){
        $array['color'] = 'red';
    }else{
        $array['color'] = 'black';
    }
    array_push($array2, $array);
}

header("content-type:application/json");    
echo json_encode($array2);
    
?>