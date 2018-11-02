
<tr>
    <th scope="col">
        <button class="btn btn-warning" onclick="resetModifTech(<?=$_REQUEST['id']?>)">
            <i class="fas fa-undo-alt"></i>
        </button>
    </th>
    <th scope="col" id="techName_<?=$_REQUEST['id']?>">
        <?=$_REQUEST['name']?>
    </th>
    <th scope="col">
        <input class="loginInput" type="text" id="techSurname_<?=$_REQUEST['id']?>" placeholder="Trigramme" value="<?=$_REQUEST['surname']?>">
    </th>
    <th scope="col">
        <input type="color" id="techColor_<?=$_REQUEST['id']?>" value="<?=$_REQUEST['color']?>">
    </th>

    <th scope="col">
        <button class="btn btn-success" onclick="modifTech(<?=$_REQUEST['id']?>)">
            <i class="fas fa-check"></i>
        </button>
    </th>
</tr>