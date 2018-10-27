<?php 
require_once "ajaxDatabaseInit.php";

if ($_REQUEST['mode'] == 'valid'){
    $valid = 1;
    $date = $_REQUEST['date'];
} else if($_REQUEST['mode'] == 'delete'){
    $valid = 0;
    $date = DateTime::createFromFormat('d/m/Y', $_REQUEST['date'])->format('Y-m-d');
}

$req = $bdd->prepare('UPDATE PLA_SLOT '
        . 'SET SLO_ID_USR = :tech ,'
        . 'SLO_ID_SCO = :slot, '
        . 'SLO_DATE = :date, '
        . 'SLO_VALID = :valid '
        . 'WHERE SLO_ID = :id');

$req ->execute(array(
       'tech' => $_REQUEST['tech'],
       'slot' => $_REQUEST['slot'],
       'date' => $date,
       'valid' => $valid,
       'id' => $_REQUEST['id']));


if($_REQUEST['mode'] == 'valid'){
    
    $search = $bdd->queryObj('SELECT * '
        . 'FROM PLA_SLOT '
        . 'INNER JOIN YDA_USERS ON SLO_ID_USR = USR_ID '
        . 'INNER JOIN PLA_SLOT_CONFIG ON SLO_ID_SCO = SCO_ID '
        . 'WHERE SLO_ID = "'.$_REQUEST['id'].'"');



    $arraySlot = [];

    foreach($search as $key=>$value):
        $arraySlot['nameTech'] = ucfirst($value->USR_FIRST_NAME). ' ' . ucfirst($value->USR_NAME);
        $arraySlot['nameSlot'] = ucfirst($value->SCO_NAME);
        $arraySlot['dateSlot'] = DateTime::createFromFormat('Y-m-d',$value->SLO_DATE)->format('d/m/Y');
        ?>    

        <th scope="row">
            <button class="btn btn-secondary" onclick='switchSlotAssoc(<?=$value->SLO_ID?>)'>
                <i class="far fa-edit"></i>
            </button>
        </th>
        <td id="resultTech_<?=$value->SLO_ID?>" data-idTech="<?=$value->SLO_ID_USR?>"><?=$arraySlot['nameTech']?></td>
        <td id="resultSlot_<?=$value->SLO_ID?>" data-idSlot="<?=$value->SLO_ID_SCO?>"><?=$arraySlot['nameSlot']?></td>
        <td id="resultDate_<?=$value->SLO_ID?>"><?=$arraySlot['dateSlot']?></td>
        <td>
            <button class="btn btn-danger" onclick='modifSlotAssoc("delete",<?=$value->SLO_ID?>)'>
                <i class="far fa-trash-alt"></i>
            </button>
        </td>

    <?php endforeach;
} else if ($_REQUEST['mode'] == 'delete'){
    echo 'ok';
}



