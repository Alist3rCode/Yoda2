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


<div class="vignette <?=$_REQUEST['version']?>" id="vignette_<?=$_REQUEST['id']?>">
    <div class="contenu_vignette">
        <a href="<?=$_REQUEST['url']?>" target="_blank" id="vign_url_<?=$_REQUEST['id']?>">
            <div class="infoClient">
                <p class="ville <?=$_REQUEST['version']?>"><?=$_REQUEST['ville']?></p>

                <p class="nom"><?=$_REQUEST['nom']?></p>
            </div>
        </a>
            <div class="tag">
            <?=$formatedTag?>

            </div>

            <div class="version">
                    <hr class="my-4">
                    <span>

                        <?=$_REQUEST['imagingVersion']?>

                    </span> 
            </div>                     

        </div>
</div>