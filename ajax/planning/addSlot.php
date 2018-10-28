<?php 
require_once "../ajaxDatabaseInit.php";

$select = $bdd->queryObj('SELECT count(*) as Count '
        . 'FROM PLA_SLOT_CONFIG '
        . 'WHERE (SCO_CODE = "'.$_REQUEST['code'].'" OR '
        . 'SCO_NAME = "'.$_REQUEST['name'].'")');

if ($select[0]->Count != 0){
    $array['ok'] = 'nok';
    $array['error'] = 'Un créneau avec ce code / nom existe déja';
}
else{
    
    $select2 = $bdd->queryObj('SELECT count(*) as Count '
        . 'FROM PLA_SLOT_CONFIG '
        . 'WHERE SCO_START = "'.$_REQUEST['start'].'" '
        . 'AND SCO_STOP = "'.$_REQUEST['stop'].'"');

    if ($select2[0]->Count != 0){
        $array['ok'] = 'nok';
        $array['error'] = 'Un créneau avec ces horaires existe déja';
    } else{
        
        $req = $bdd->prepare('INSERT INTO PLA_SLOT_CONFIG '
            . '(SCO_CODE, SCO_NAME, SCO_START, SCO_STOP, SCO_COLOR, SCO_VALID) '
            . 'values(:code, :name, :start, :stop, :color, :valid) ');

        $req->execute(array(
        'code' => strtoupper($_REQUEST['code']),
        'name' => ucfirst($_REQUEST['name']),
        'start' => $_REQUEST['start'],
        'stop' => $_REQUEST['stop'],
        'color' => substr($_REQUEST['color'], 1),
        'valid' => 1      
        )) or die(print_r($req->errorInfo()));
        
        $insertID = $bdd->lastInsertID();

        $array['ok'] = 'ok';
        
        $array['html'] = '<tr>'
                          .  '<th scope="row">'
                              .  '<button class="btn btn-secondary" onclick="modifSlot('.$insertID.')">'
                                   .'<i class="far fa-edit"></i>'
                               .' </button>'
                            .'</th>'
                            .'<td>'.strtoupper($_REQUEST['code']).'</td>'
                            .'<td>'.ucfirst($_REQUEST['name']).'</td>'
                            .'<td>'.$_REQUEST['start'].'</td>'
                            .'<td>'.$_REQUEST['stop'].'</td>'
                            .'<td><input  type="color" value="'.$_REQUEST['color'].'" disabled></td>'
                            .'<td>'
                                .'<button class="btn btn-danger" onclick="deleteSlot('.$insertID.')">'
                                    .'<i class="far fa-trash-alt"></i>'
                                .'</button>'
                            .'</td>'
                        .'</tr>';
        
        $array['dropdownSearch'] = '<a class="dropdown-item searchSlot" onclick="dropdown(\'btnSlot\','.ucfirst($_REQUEST['name']).','.$insertID.')">'
                                    .ucfirst($_REQUEST['name'])
                                    .'</a>' ;
        $array['dropdownCreate'] = '<a class="dropdown-item" onclick="dropdown(\'btnAddSlot\','.ucfirst($_REQUEST['name']).','.$insertID.')">'
                                    .ucfirst($_REQUEST['name'])
                                    .'</a>' ;
    }
}





header("content-type:application/json");
echo json_encode($array);



?>