<?php 
require_once "../ajaxDatabaseInit.php";

require "../../public/fetchInfoPlanning.php";

$select = $bdd->queryObj('SELECT * '
        . 'FROM YDA_USERS '
        . 'WHERE USR_ID = "'.$_REQUEST['tech'].'"');

$idxTech = 0;

$nameSelected = ucfirst($select[0]->USR_NAME);
$firstNameSelected = ucfirst($select[0]->USR_FIRST_NAME);
$idSelected = $select[0]->USR_ID;


$select2 = $bdd->queryObj('SELECT * '
        . 'FROM PLA_SLOT_CONFIG '
        . 'WHERE SCO_ID = "'.$_REQUEST['slot'].'"');

$nameSlotSelected = ucfirst($select2[0]->SCO_NAME);
$idSlotSelected = $select2[0]->SCO_ID;


 
?>




    <th scope="col" style="width: 5%">
        <button class="btn btn-warning" onclick="resetModif(<?=$_REQUEST['id']?>)">
            <i class="fas fa-undo-alt"></i>
        </button>
    </th>
    <th scope="col">
        <button id="btnModifTech_<?=$_REQUEST['id']?>" type="button" data-id="<?=$idSelected?>" class="btn btn-secondary dropdown-toggle col-md-12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding:0">
            <?=$firstNameSelected.' '.$nameSelected?>
        </button>
        <div class="dropdown-menu" aria-labelledby="btnModifTech">
         
            <?php for($i=0;$i < count($arrayTech);$i++):?>
                <a class="dropdown-item searchModifTech" onclick="dropdown('btnModifTech_<?=$_REQUEST['id']?>','<?=$arrayTech[$i]['firstName'].' '.$arrayTech[$i]['name']?>',<?=$arrayTech[$i]['id']?>)">
                    <?=$arrayTech[$i]['firstName'].' '.$arrayTech[$i]['name']?>
                </a>
            <?php endfor;?>
        </div>
    </th>
    <th scope="col">
        <button id="btnModifSlot_<?=$_REQUEST['id']?>" type="button" data-id="<?=$idSlotSelected?>" class="btn btn-secondary dropdown-toggle col-md-12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding:0">
            <?=$nameSlotSelected?>
        </button>
        <div class="dropdown-menu" aria-labelledby="btnModifSlot">
       
            <?php for($i=0;$i < count($arrayConfig);$i++):?>
                <a class="dropdown-item searchSlot" onclick="dropdown('btnModifSlot_<?=$_REQUEST['id']?>','<?=$arrayConfig[$i]['name']?>',<?=$arrayConfig[$i]['id']?>)">
                    <?=$arrayConfig[$i]['name']?>
                </a>
            <?php endfor;?>
        </div>
    </th>
    <th scope="col">
        <input class="loginInput inputTimeWithText" type="date" id="dateModifSlot_<?=$_REQUEST['id']?>" value="<?=DateTime::createFromFormat('d/m/Y', $_REQUEST['date'])->format('Y-m-d')?>">
    </th>
    <th scope="col" style="width: 5%">
        <button class="btn btn-success" onclick="modifSlotAssoc('valid',<?=$_REQUEST['id']?>)">
            <i class="fas fa-check"></i>
        </button>
    </th>


