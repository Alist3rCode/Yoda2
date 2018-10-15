<?php
session_start();

require_once "ajaxDatabaseInit.php";
require_once "../class/CalculGPS.php";
require_once('../class/checkRights.php');
$right = checkRights($bdd,$_SESSION['id_user']);

$i = $_REQUEST['id'];

$version = $bdd->queryObj('SELECT CLI_VERSION '
        . 'FROM YDA_CLIENT '
        . 'WHERE CLI_ID ="' . $i .'"');

if($version[0]->CLI_VERSION == 'v6'){
    $iconMaps = 'btn-warning';

}else if ($version[0]->CLI_VERSION == 'v7'){
    $iconMaps = 'btn-primary';
    
}else if($version[0]->CLI_VERSION == 'v8'){
    $iconMaps = 'btn-secondary';
    
}

$phones = $bdd->queryObj('SELECT * '
        . 'FROM YDA_PHONE '
        . 'LEFT JOIN YDA_CLIENT ON PHO_ID_CLI = CLI_ID '
        . 'LEFT JOIN YDA_MAPS ON MPS_ID_PHO = PHO_ID '
        . 'WHERE PHO_ID_CLI ="' . $i .'" '
        . 'AND PHO_VALID = 1');
?>   
   
<div class="phoneWithLink phoneWithLink<?=$version[0]->CLI_VERSION?>">
    <?php foreach($phones as $key => $value):?>
        <div class="d-flex flex-wrap">
            <div class='phoneNumber col-md-12'>
                
                <?php if(trim($phones[$key]->PHO_SITE) == '' || $phones[$key]->PHO_SITE == 'NULL' || is_null($phones[$key]->PHO_SITE)):?>

                        <?=$phones[$key]->CLI_VILLE . '<br>' . $phones[$key]->CLI_NOM . '<br>';?>
                
                    <?php elseif(trim($phones[$key]->PHO_SITE) !== '' && $phones[$key]->PHO_SITE != 'NULL' && !is_null($phones[$key]->PHO_SITE)):?>

                        <?=$phones[$key]->PHO_SITE . '<br>';?>

                    <?php endif;?>

                
                <a href='tel:<?=$phones[$key]->PHO_PHONE;?>'><?=$phones[$key]->PHO_PHONE;?></a>

                <div class="btn-group col-md-12" role="group" style="padding-left: 0;">
                    <a href="https://www.google.fr/maps/search/<?=DECtoDMS_LAT($phones[$key]->MPS_LAT)?>+<?=DECtoDMS_LON($phones[$key]->MPS_LON)?>/" target="_blank" class="btn btn-sm <?=$iconMaps?> iconMaps">
                            <i class=" fa fa-map-marker-alt"></i>
                        </a>
                    </a>
                    <?php if(trim($phones[$key]->PHO_TX) == '' || $phones[$key]->PHO_TX == 'NULL' || is_null($phones[$key]->PHO_TX)):?>

                        <button class="btn btn-sm btn-danger" disabled>
                            <i class=" fa fa-desktop"></i>

                        </button>
                    <?php elseif(trim($phones[$key]->PHO_TX) !== '' && $phones[$key]->PHO_TX != 'NULL' && !is_null($phones[$key]->PHO_TX)):?>

                        <a href="<?=$phones[$key]->PHO_TX?>" target="_blank" class="btn btn-sm btn-success">
                            <i class=" fa fa-desktop"></i>
                        </a>

                    <?php endif;?>

                    <?php if(trim($phones[$key]->PHO_MAIL) != '' && $phones[$key]->PHO_MAIL != 'NULL'):?>

                        <a href='mailto:<?=$phones[$key]->PHO_MAIL;?>' class="btn btn-sm btn-success">
                            <i class="fa fa-envelope"></i> 
                        </a>
                    <?php elseif(trim($phones[$key]->PHO_MAIL) == '' || $phones[$key]->PHO_MAIL == 'NULL'|| is_null($phones[$key]->PHO_MAIL)):?>
                        <button class="btn btn-sm btn-danger" disabled >
                            <i class="fa fa-envelope"></i>
                        </button>
                    <?php endif;?>

                    <?php if(trim($phones[$key]->PHO_TV_ID) != '' && $phones[$key]->PHO_TV_ID != 'NULL' && in_array("rgt_cod_teamviewer", $right)):?>
                    <a href='teamviewer10://control?device=<?=$phones[$key]->PHO_TV_ID;?>' class="rounded-circle">
                            <div style="background:dodgerBlue;width:32px;;height:32px;border-top-right-radius:.2rem;border-bottom-right-radius:.2rem;padding-top:2px;padding-left:2px;" >
                                <div class="rounded-circle" style="background:white;width:28px;height:28px;">
                                    <i class="fa fa-arrows-alt-h" style="padding-left:6px; padding-top:6px"></i> 
                                </div>
                            </div>
                        </a>
                    <?php endif;?>
                </div>
            </div>
        </div>
    <?php endforeach;?>
</div>
