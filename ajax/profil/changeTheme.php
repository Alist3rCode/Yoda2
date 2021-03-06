<?php 

require_once "../ajaxDatabaseInit.php";

$select= $bdd->queryObj('SELECT * FROM CFG_PREFERENCES '
        . 'WHERE CPR_ID_USR = "'.$_REQUEST['id'].'"');

if(count($select) > 0){
    
    $update = $bdd->prepare('UPDATE CFG_PREFERENCES '
        . 'SET CPR_SIDEBAR = :sidebar, '
        . 'CPR_THEME = :theme, '
        . 'CPR_COLOR_PLANNING = :color, '
        . 'CPR_LABEL_PLANNING = :label '
        . 'WHERE CPR_ID_USR = :id ');
    
    $update ->execute(array(
        'sidebar' => $select[0]->CPR_SIDEBAR,
        'theme' => $_REQUEST['theme'],
        'color' => $select[0]->CPR_COLOR_PLANNING,
        'label' => $select[0]->CPR_LABEL_PLANNING,
        'id' => $_REQUEST['id'] ));

} else {
    $update = $bdd->prepare('INSERT INTO CFG_PREFERENCES '
        . '(CPR_THEME, CPR_ID_USR) VALUES '
        . '(:sidebar, :id)');
    
    $update ->execute(array(
        'theme' => $_REQUEST['theme'],
        'id' => $_REQUEST['id']
        
        ));

} 
echo 'ok';
?>