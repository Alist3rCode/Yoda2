<?php
$formatedTag = '';
if ($_REQUEST['tag'] != ''){

    $tags = explode(',',$_REQUEST['tag']);
    $lenght = (count($tags)<5)?count($tags):5;

        for($i=0;$i<$lenght;$i++){
            $formatedTag .= '#' . $tags[$i] . ' ';
        }
}
            

?>

<div class="contenu_vignette flipper">
    <div class="front">
        <a href="<?=$_REQUEST['url']?>" target="_blank" id="vign_url_<?=$_REQUEST['id']?>">
            <div class="infoClient">
                <p class="ville <?=$_REQUEST['version']?>"><?=$_REQUEST['ville']?></p>

                <p class="nom"><?=$_REQUEST['nom']?></p>
            </div>
        </a>

            <div class="tag">
            <?= $formatedTag?>

            </div>

            <div class="version">
                    <hr class="my-4">
                    <span>

                        <?=$_REQUEST['imagingVersion']?>

                    </span> 
            </div>                     
    </div>
    <div class="back">
        <div class="infoClientBack">
            <p class="villeBack <?=$_REQUEST['version']?>"><?=$_REQUEST['ville']?></p>

            <p class="nomBack"><?=$_REQUEST['nom']?></p>
        </div>
        <div class="backBtn">
            <i class="fas fa-database"></i>
        </div>
        <div class="backBtn" onclick="modif(<?=$_REQUEST['id']?>)" data-toggle="modal" data-target="#modaleClient" >
            <i class="fas fa-pencil-alt" ></i>
        </div>
        <div class="backBtn">
            <i class="fas fa-phone"></i>
        </div>

        <div class="backBtn" data-toggle="tooltip" data-html="true"  data-id="<?=$_REQUEST['id']?>" data-placement="bottom" data-title="test">
            <i class="fas fa-code-branch"></i>
        </div>

    </div>
</div>                 

