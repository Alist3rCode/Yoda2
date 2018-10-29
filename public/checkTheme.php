<?php
$search = $bdd->queryObj('SELECT USR_THEME '
        . 'FROM YDA_USERS '
        . 'WHERE USR_ID = "'.$_SESSION['id_user'].'"');


if($search[0]->USR_THEME == 1){
    echo '<link rel="stylesheet" href="./public/css/light.css">';
}else if($search[0]->USR_THEME == 0){
    echo '<link rel="stylesheet" href="./public/css/dark.css">';
}


?>