<?php
if(isset($_SESSION["id_user"]) && $_SESSION["id_user"] != ''){
    $selectName = $bdd->queryObj('SELECT USR_FIRST_NAME, '
            . 'USR_NAME '
            . 'FROM YDA_USERS '
            . 'WHERE USR_ID = "'.$_SESSION["id_user"].'"');

    $display = true;
}else{
    $display = false;
}
?>

<nav class=" menu navbar navbar-expand-lg">
    <span class="logo col-1">
        <img src="public/img/yoda.png">
    </span>
    <div class="collapse navbar-collapse col-11" id="navbarSupportedContent">
        <?php if($display):?>
        <span class="text-capitalize mx-auto" >
            <h3><i class="fab fa-jedi-order"></i> Bienvenue <?=$selectName[0]->USR_FIRST_NAME?> <?=$selectName[0]->USR_NAME?></h3>
        </span><?php endif;?>
        <div class="btn-group" role="group" aria-label="Basic example">
            <?php if(in_array("rgt_cod_link", $right)):?>
                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modaleCreateInternalLink">
                    <i class="far fa-plus-square"></i>
                </button>
            <?php endif;?>
            <?php if(in_array("rgt_cod_link", $right)):?>
                <button type="button" class="btn btn-outline-secondary" id="modifLinks">
                    <i class="far fa-edit"></i>
                </button>
            <?php endif;?>
        </div>
    </div>
</nav>
