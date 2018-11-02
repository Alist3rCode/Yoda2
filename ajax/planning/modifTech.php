<?php 
require_once "../ajaxDatabaseInit.php";

        
$req = $bdd->prepare('UPDATE YDA_USERS '
        . 'SET USR_SURNAME = :surname, '
        . 'USR_COLOR = :color '
        . 'WHERE USR_ID = :id');

$req ->execute(array(
       'surname' => strtoupper($_REQUEST['surname']),
       'color' => $_REQUEST['color'],
       'id' => $_REQUEST['id']));

?>

<tr id="trTech_<?=$_REQUEST['id']?>">
    <th scope="row">
        <button class="btn btn-secondary" onclick='switchTech(<?=$_REQUEST['id']?>)'>
            <i class="far fa-edit"></i>
        </button>
    </th>
    <td id="techName_<?=$_REQUEST['id']?>"><?=ucfirst($_REQUEST['name'])?></td>
    <td id="techSurname_<?=$_REQUEST['id']?>"><?= strtoupper($_REQUEST['surname'])?></td>
    <td><input  id="techColor_<?=$_REQUEST['id']?>" type="color" disabled value="<?=$_REQUEST['color']?>"></td>
</tr>
