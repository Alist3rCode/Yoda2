<?php 
require_once "ajaxDatabaseInit.php";

if($_REQUEST['tech'] == "0"){
    $tech = ' ';
} else {
    $tech = ' AND SLO_ID_USR = "'.$_REQUEST['tech'].'"';
    
}

if($_REQUEST['slot'] == "0"){
    $slot = ' ';
} else {
    $slot = ' AND SLO_ID_SCO = "'.$_REQUEST['slot'].'"';
    
}


$search = $bdd->queryObj('SELECT * '
        . 'FROM PLA_SLOT '
        . 'INNER JOIN YDA_USERS ON SLO_ID_USR = USR_ID '
        . 'INNER JOIN PLA_SLOT_CONFIG ON SLO_ID_SCO = SCO_ID '
        . 'WHERE SLO_VALID = 1 '
        . 'AND SLO_DATE BETWEEN "'.$_REQUEST['start'].'" AND "'.$_REQUEST['end'].'"'
        . $tech 
        . $slot);



$arraySlot = [];

foreach($search as $key=>$value):
    $arraySlot['nameTech'] = ucfirst($value->USR_FIRST_NAME). ' ' . ucfirst($value->USR_NAME);
    $arraySlot['nameSlot'] = ucfirst($value->SCO_NAME);
    $arraySlot['dateSlot'] = DateTime::createFromFormat('Y-m-d',$value->SLO_DATE)->format('d/m/Y');
    ?>    
    <tr id="resultTrSlot_<?=$value->SLO_ID?>">
        <th scope="row">
            <button class="btn btn-secondary" onclick='modifSlotAssoc(<?=$value->SLO_ID?>)'>
                <i class="far fa-edit"></i>
            </button>
        </th>
        <td id="resultTech_<?=$value->SLO_ID?>" data-idTech="<?=$value->SLO_ID_USR?>"><?=$arraySlot['nameTech']?></td>
        <td id="resultSlot_<?=$value->SLO_ID?>" data-idSlot="<?=$value->SLO_ID_SCO?>"><?=$arraySlot['nameSlot']?></td>
        <td id="resultDate_<?=$value->SLO_ID?>"><?=$arraySlot['dateSlot']?></td>
        <td>
            <button class="btn btn-danger" onclick='deleteSlotAssoc(<?=$value->SLO_ID?>)'>
                <i class="far fa-trash-alt"></i>
            </button>
        </td>
    </tr>
<?php endforeach;


