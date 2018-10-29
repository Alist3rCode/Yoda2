<?php 
require_once "../ajaxDatabaseInit.php";

$search = $bdd->queryObj('SELECT * '
        . 'FROM PLA_SLOT_CONFIG '
        . 'WHERE SCO_ID = "'.$_REQUEST['id'].'"');



$arraySlot = [];

foreach($search as $key=>$value):?>    
    
    <th scope="row">
        <button class="btn btn-secondary" onclick='switchSlot(<?=$value->SCO_ID?>)'>
            <i class="far fa-edit"></i>
        </button>
    </th>
    <td id="slotCode_<?=$value->SCO_ID?>"><?=$value->SCO_CODE?></td>
    <td id="slotName_<?=$value->SCO_ID?>"><?=$value->SCO_NAME?></td>
    <td id="slotStart_<?=$value->SCO_ID?>"><?=$value->SCO_START?></td>
    <td id="slotStop_<?=$value->SCO_ID?>"><?=$value->SCO_STOP?></td>
    <td><input  id="slotColor_<?=$value->SCO_ID?>" type="color" value="#<?=$value->SCO_COLOR?>" disabled></td>
    <td>
        <button class="btn btn-danger" onclick='modifSlot("delete",<?=$value->SCO_ID?>)'>
            <i class="far fa-trash-alt"></i>
        </button>
    </td>
    
<?php endforeach;


