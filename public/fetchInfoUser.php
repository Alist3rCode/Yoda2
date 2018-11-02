<?php

$bdd = new Database('yoda');

if(isset($_SESSION['id_user']) && $_SESSION['id_user'] != ''){
    
    $selectUser = $bdd->queryObj('SELECT * '
            . 'FROM YDA_USERS '
            . 'INNER JOIN CFG_PREFERENCES ON USR_ID = CPR_ID_USR '
            . 'WHERE USR_ID="' . $_SESSION['id_user'] . '"');
    
        $mail = $selectUser[0]->USR_MAIL;
        $profil = $selectUser[0]->USR_ID_PRO;
        $name = ucfirst($selectUser[0]->USR_FIRST_NAME);
        $lastName = ucfirst($selectUser[0]->USR_NAME);
        $surname = $selectUser[0]->USR_SURNAME;
        $page = $selectUser[0]->USR_PAGE;
        
        if($selectUser[0]->CPR_THEME == 0){
            $dark = '';
            $light = "d-none";
        }else{
            $dark = 'd-none';
            $light = "";
        }
    
}