<?php 
require_once "../ajaxDatabaseInit.php";

$search = $bdd->queryObj('SELECT * '
        . 'FROM PLA_OFF '
        . 'WHERE OFF_ID = "'.$_REQUEST['id'].'"');




foreach($search as $key=>$value):
    
 if($value->OFF_REPEAT == '1'){
    $date = DateTime::createFromFormat('j-n',$value->OFF_DAY.'-'.$value->OFF_MONTH)->format('d/m');
}else if ($value->OFF_REPEAT == '0'){
    $date = DateTime::createFromFormat('j-n-Y',$value->OFF_DAY.'-'.$value->OFF_MONTH.'-'.$value->OFF_YEAR)->format('d/m/Y');
}
    ?>    
    
    <tr id="trOff_<?=$_REQUEST['id']?>">
        <th scope="row">
            <button class="btn btn-secondary" onclick='switchOff(<?=$_REQUEST['id']?>)'>
                <i class="far fa-edit"></i>
            </button>
        </th>
        <td>
            <button class="btn btn-<?=($value->OFF_REPEAT==0? "outline-": "");?>primary " data-repeat="<?=$value->OFF_REPEAT?>" id="repeatOff_<?=$_REQUEST['id']?>" disabled>
                <i class="fas fa-redo"></i>
            </button>
        </td>
        <td id="dateOff_<?=$_REQUEST['id']?>"><?=$date?></td>
        <td id="nameOff_<?=$_REQUEST['id']?>"><?=$value->OFF_NAME?></td>

        <td>
            <button class="btn btn-danger" onclick='modifOff("delete",<?=$_REQUEST['id']?>)'>
                <i class="far fa-trash-alt"></i>
            </button>
        </td>
    </tr>
    
<?php endforeach;


