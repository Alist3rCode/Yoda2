<?php 
require_once "../ajaxDatabaseInit.php";

$day = DateTime::createFromFormat('Y-m-d',$_REQUEST['date'])->format('j');
$month = DateTime::createFromFormat('Y-m-d',$_REQUEST['date'])->format('n');
$year = DateTime::createFromFormat('Y-m-d',$_REQUEST['date'])->format('Y');

if($_REQUEST['repeat'] == 1){
    $year = '';
}

$select = $bdd->queryObj('SELECT count(*) as Count '
        . 'FROM PLA_OFf '
        . 'WHERE OFF_NAME = "'.$_REQUEST['name'].'"');

if ($select[0]->Count != 0){
    $array['ok'] = 'nok';
    $array['error'] = 'Un jour fermé avec ce nom existe déja';
}
else{
    
    $select2 = $bdd->queryObj('SELECT count(*) as Count '
        . 'FROM PLA_OFF '
        . 'WHERE OFF_DAY = "'.$day.'" '
        . 'AND OFF_MONTH = "'.$month.'"');

    if ($select2[0]->Count != 0){
        $array['ok'] = 'nok';
        $array['error'] = 'Un jour fermé à cette date existe déja';
    } else{
        
        $req = $bdd->prepare('INSERT INTO PLA_OFF '
            . '(OFF_NAME, OFF_DAY, OFF_MONTH, OFF_YEAR, OFF_REPEAT, OFF_VALID) '
            . 'values(:name, :day, :month, :year, :repeat, :valid) ');

        $req->execute(array(
        'name' => ucfirst($_REQUEST['name']),
        'day' => $day,
        'month' => $month,
        'year' => $year,
        'repeat' => $_REQUEST['repeat'],
        'valid' => 1      
        )) or die(print_r($req->errorInfo()));
        
        $insertID = $bdd->lastInsertID();

        $array['ok'] = 'ok';
        $class = $_REQUEST['repeat']==0? "outline-": "";
        
        $array['html'] = '<tr>'
                            .'<th scope="row">'
                                .'<button class="btn btn-secondary" onclick="modifOff('.$insertID.')">'
                                    .'<i class="far fa-edit"></i>'
                                .'</button>'
                            .'</th>'
                            .'<td>'
                                .'<button class="btn btn-'.$class.'primary " disabled>'
                                    .'<i class="fas fa-redo"></i>'
                                .'</button>'
                            .'</td>'
                            .'<td>'.$_REQUEST['date'].'</td>'
                            .'<td>'.$_REQUEST['name'].'</td>'

                            .'<td>'
                                .'<button class="btn btn-danger" onclick="deleteOff('.$insertID.')">'
                                    .'<i class="far fa-trash-alt"></i>'
                                .'</button>'
                            .'</td>'
                        .'</tr>';
    }
}





header("content-type:application/json");
echo json_encode($array);



?>