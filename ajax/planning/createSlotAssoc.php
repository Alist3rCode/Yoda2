<?php 
require_once "../ajaxDatabaseInit.php";

$arrayDays =[];

$arrayWeekdays = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
$arrayWeekdaysFr = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];

$period = new DatePeriod(
     new DateTime($_REQUEST['start']),
     new DateInterval('P1W'),
     new DateTime($_REQUEST['endAssocSlot'])
);
foreach ($period as $key => $value) {
    var_dump($value->format('Y-m-d'));     
}


if($_REQUEST['mode']== 'hebdo'){
    
    if($_REQUEST['endAssocSlot'] != ''){
        $end = $_REQUEST['endAssocSlot'];
    } else if ($_REQUEST['repeatAssocSlot'] != ''){
        
    }
    
}else if($_REQUEST['mode']== 'month'){
    
}


//$search = $bdd->queryObj('SELECT * '
//        . 'FROM PLA_SLOT '
//        . 'INNER JOIN YDA_USERS ON SLO_ID_USR = USR_ID '
//        . 'INNER JOIN PLA_SLOT_CONFIG ON SLO_ID_SCO = SCO_ID '
//        . 'WHERE SLO_VALID = 1 '
//        . 'AND SLO_DATE BETWEEN "'.$_REQUEST['start'].'" AND "'.$_REQUEST['end'].'"'
//        . 'AND SLO_ID_USR = "'.$_REQUEST['idTech'].'" ' 
//        . 'AND SLO_ID_SCO = "'.$_REQUEST['idSlot'].'"');
//
//
//
//$arraySlot = [];
//
//foreach($search as $key=>$value):
//    $arraySlot['nameTech'] = ucfirst($value->USR_FIRST_NAME). ' ' . ucfirst($value->USR_NAME);
//    $arraySlot['nameSlot'] = ucfirst($value->SCO_NAME);
//    $arraySlot['dateSlot'] = DateTime::createFromFormat('Y-m-d',$value->SLO_DATE)->format('d/m/Y');
//    list($r, $g, $b) = sscanf('#'.$value->SCO_COLOR, "#%02x%02x%02x");
//    ?>    
<!--    <tr id="resultTrSlot_//<?=$value->SLO_ID?>" style="background:rgba(<?=$r?>,<?=$g?>,<?=$b?>,0.2)">
        <th scope="row">
            <button class="btn btn-secondary" onclick='switchSlotAssoc(//<?=$value->SLO_ID?>)'>
                <i class="far fa-edit"></i>
            </button>
        </th>
        <td id="resultTech_//<?=$value->SLO_ID?>" data-idTech="<?=$value->SLO_ID_USR?>"><?=$arraySlot['nameTech']?></td>
        <td id="resultSlot_//<?=$value->SLO_ID?>" data-idSlot="<?=$value->SLO_ID_SCO?>"><?=$arraySlot['nameSlot']?></td>
        <td id="resultDate_//<?=$value->SLO_ID?>"><?=$arraySlot['dateSlot']?></td>
        <td>
            <button class="btn btn-danger" onclick='modifSlotAssoc("delete",//<?=$value->SLO_ID?>)'>
                <i class="far fa-trash-alt"></i>
            </button>
        </td>
    </tr>-->
<?php //endforeach;
//
//
