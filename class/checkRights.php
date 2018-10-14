<?php
function checkRights($bdd,$idUser){
    $right=[];
    
    $select = $bdd->queryObj('SELECT * '
            . 'FROM yda_hook '
            . 'INNER JOIN yda_right on yda_right.RGT_ID = yda_hook.HOK_ID_RGT '
            . 'WHERE HOK_ID in ( '
                . 'SELECT HOK_ID '
                . 'FROM yda_hook '
                . 'WHERE ((HOK_ID_TYPE = 1 AND HOK_TYPE = "User") '
                . 'OR (HOK_ID_TYPE = (SELECT USR_ID_PRO '
                    . 'FROM yda_users '
                    . 'WHERE USR_ID =1) '
            . 'AND HOK_TYPE = "Profil")))');

    
    foreach($select as $key=>$value){
         array_push($right, $value->RGT_CODE);
    }
   
return $right;
    
}
