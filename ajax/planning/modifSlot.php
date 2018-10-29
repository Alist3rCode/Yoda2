<?php 
require_once "../ajaxDatabaseInit.php";

if ($_REQUEST['mode'] == 'valid'){
    $valid = 1;
    
} else if($_REQUEST['mode'] == 'delete'){
    $valid = 0;
    
}

$req = $bdd->prepare('UPDATE PLA_SLOT_CONFIG '
        . 'SET SCO_CODE = :code, '
        . 'SCO_NAME = :name, '
        . 'SCO_START = :start, '
        . 'SCO_STOP = :stop, '
        . 'SCO_COLOR = :color, '
        . 'SCO_VALID = :valid '
        . 'WHERE SCO_ID = :id');



$req ->execute(array(
       'code' => strtoupper($_REQUEST['code']),
       'name' => ucfirst($_REQUEST['name']),
       'start' => $_REQUEST['start'],
       'stop' => $_REQUEST['stop'],
       'color' => substr($_REQUEST['color'], 1),
       'valid' => $valid,
       'id' => $_REQUEST['id']));


if($_REQUEST['mode'] == 'valid'){
    
    $search = $bdd->queryObj('SELECT * '
        . 'FROM PLA_SLOT_CONFIG '
        . 'WHERE SCO_ID = "'.$_REQUEST['id'].'"');

    $array['html'] =   '<th scope="row ">'
                          .  '<button class="btn test btn-secondary" onclick="switchSlot('.$_REQUEST['id'].')">'
                               .'<i class="far fa-edit"></i>'
                           .' </button>'
                        .'</th>'
                        .'<td id="slotCode_'.$_REQUEST['id'].'">'.strtoupper($_REQUEST['code']).'</td>'
                        .'<td id="slotName_'.$_REQUEST['id'].'">'.ucfirst($_REQUEST['name']).'</td>'
                        .'<td id="slotStart_'.$_REQUEST['id'].'">'.$_REQUEST['start'].'</td>'
                        .'<td id="slotStop_'.$_REQUEST['id'].'">'.$_REQUEST['stop'].'</td>'
                        .'<td><input  id="slotColor_'.$_REQUEST['id'].'" type="color" value="'.$_REQUEST['color'].'" disabled></td>'
                        .'<td>'
                            .'<button class="btn btn-danger" onclick="modifSlot(\'delete\''.$_REQUEST['id'].')">'
                                .'<i class="far fa-trash-alt"></i>'
                            .'</button>'
                        .'</td>';

        $array['dropdownSearch'] = '<a id="dropdownSlotSearch_'.$_REQUEST['id'].'" class="dropdown-item searchSlot" onclick="dropdown(\'btnSlot\','.ucfirst($_REQUEST['name']).','.$_REQUEST['id'].')">'
                                    .ucfirst($_REQUEST['name'])
                                    .'</a>' ;
        $array['dropdownCreate'] = '<a id="dropdownSlotCreate_'.$_REQUEST['id'].'" class="dropdown-item" onclick="dropdown(\'btnAddSlot\','.ucfirst($_REQUEST['name']).','.$_REQUEST['id'].')">'
                                    .ucfirst($_REQUEST['name'])
                                    .'</a>' ;
        
        
} else if ($_REQUEST['mode'] == 'delete'){
        $array['ok'] = 'ok';
}


header("content-type:application/json");
echo json_encode($array);
