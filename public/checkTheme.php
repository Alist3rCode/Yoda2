<?php
$search = $bdd->queryObj('SELECT CPR_THEME '
        . 'FROM CFG_PREFERENCES '
        . 'WHERE CPR_ID_USR = "'.$_SESSION['id_user'].'"');

if (count($search)>0){
    if($search[0]->CPR_THEME == 1){
        echo '<link rel="stylesheet" href="./public/css/light.css">';
    }else if($search[0]->CPR_THEME == 0){
        echo '<link rel="stylesheet" href="./public/css/dark.css">';
    }

}else{
    $update = $bdd->prepare('REPLACE INTO CFG_PREFERENCES '
        . '(CPR_THEME, CPR_ID_USR) VALUES '
        . '(:theme, :id)');
    
    $update ->execute(array(
        'id' => $_SESSION['id_user'],
        'theme' => 1
        ));
}


?>