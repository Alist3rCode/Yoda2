

<tr>
    <th scope="col" style="width: 5%">
        <button class="btn btn-warning" onclick="resetModifSlot(<?=$_REQUEST['id']?>)">
            <i class="fas fa-undo-alt"></i>
        </button>
    </th>
    <th scope="col" style="width: 14.28%">
        <input class="loginInput" type="text" id="slotCode_<?=$_REQUEST['id']?>" placeholder="Code" value="<?=$_REQUEST['code']?>" maxlength="5">
    </th>
    <th scope="col" style="width: 14.28%">
        <input class="loginInput" type="text" id="slotName_<?=$_REQUEST['id']?>" placeholder="Nom" value="<?=$_REQUEST['name']?>">
    </th>
    <th scope="col" style="width: 14.28%">
        <input class="loginInput inputTimeWithText" type="time" id="slotStart_<?=$_REQUEST['id']?>" placeholder="Début" value="<?=$_REQUEST['start']?>">
    </th>
    <th scope="col" style="width: 14.28%">
        <input class="loginInput inputTimeWithText" type="time" id="slotStop_<?=$_REQUEST['id']?>" placeholder="Fin" value="<?=$_REQUEST['stop']?>">
    </th>
    <th scope="col" style="width: 5%">
        <input  type="color" id="slotColor_<?=$_REQUEST['id']?>" placeholder="Couleur" value="<?=$_REQUEST['color']?>">
    </th>
    <th scope="col" style="width: 5%">
        <button class="btn btn-success" onclick="modifSlot('valid',<?=$_REQUEST['id']?>)">
            <i class="fas fa-check"></i>
        </button>
    </th>
</tr>