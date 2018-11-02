<?php 
require_once "../ajaxDatabaseInit.php";

$search = $bdd->queryObj('SELECT * '
        . 'FROM YDA_USERS '
        . 'WHERE USR_ID = "'.$_REQUEST['id'].'"');




foreach($search as $key=>$value):

    ?>    
    
    <tr id="trTech_<?=$_REQUEST['id']?>">
        <th scope="row">
            <button class="btn btn-secondary" onclick='switchTech(<?=$_REQUEST['id']?>)'>
                <i class="far fa-edit"></i>
            </button>
        </th>
        <td id="techName_<?=$_REQUEST['id']?>"><?=ucfirst($value->USR_FIRST_NAME).' '. strtoupper($value->USR_NAME)?></td>
        <td id="techSurname_<?=$_REQUEST['id']?>"><?= strtoupper($value->USR_SURNAME)?></td>
        <td><input  id="techColor_<?=$_REQUEST['id']?>" type="color" disabled value="<?=$value->USR_COLOR?>"></td>
    </tr>
    
<?php endforeach;


