<?php
if($_REQUEST['repeat'] == '1'){
    $date = "2018-".DateTime::createFromFormat('d/m',$_REQUEST['date'])->format('m-d');
}else if ($_REQUEST['repeat'] == '0'){
    $date = DateTime::createFromFormat('d/m/Y',$_REQUEST['date'])->format('Y-m-d');
}

?>

<tr>
    <th scope="col">
        <button class="btn btn-warning" onclick="resetModifOff(<?=$_REQUEST['id']?>)">
            <i class="fas fa-undo-alt"></i>
        </button>
    </th>
    <th scope="col">
        <button class="btn btn-outline-primary <?=($_REQUEST['repeat']==1? "active": "");?>" id="repeatOff_<?=$_REQUEST['id']?>" onclick="switchFormatOffDate(<?=$_REQUEST['id']?>)">
            <i class="fas fa-redo"></i>
        </button>
    </th>
    <th scope="col">
        <input class="loginInput inputDateWithText" type="date" id="dateOff_<?=$_REQUEST['id']?>" placeholder="Date" value="<?=$date?>">
    </th>
    <th scope="col">
        <input class="loginInput" type="text" id="nameOff_<?=$_REQUEST['id']?>" placeholder="Nom" value="<?=$_REQUEST['name']?>">
    </th>

    <th scope="col">
        <button class="btn btn-success" onclick="modifOff('valid',<?=$_REQUEST['id']?>)">
            <i class="fas fa-check"></i>
        </button>
    </th>
</tr>