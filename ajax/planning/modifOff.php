<?php 
require_once "../ajaxDatabaseInit.php";

if ($_REQUEST['mode'] == 'valid'){
    $valid = 1;
    $day = DateTime::createFromFormat('Y-m-d',$_REQUEST['date'])->format('j');
    $month = DateTime::createFromFormat('Y-m-d',$_REQUEST['date'])->format('n');
    $year = DateTime::createFromFormat('Y-m-d',$_REQUEST['date'])->format('Y');

    if($_REQUEST['repeat'] == 1){
        $year = '';
        $date = DateTime::createFromFormat('Y-m-d',$_REQUEST['date'])->format('d/m');
    }else{
        $date = DateTime::createFromFormat('Y-m-d',$_REQUEST['date'])->format('d/m/Y');
    }
    
} else if($_REQUEST['mode'] == 'delete'){
    
    $valid = 0;
    

    if($_REQUEST['repeat'] == 1){
        $day = DateTime::createFromFormat('d/m',$_REQUEST['date'])->format('j');
        $month = DateTime::createFromFormat('d/m',$_REQUEST['date'])->format('n');
        $year = "";
        $date = DateTime::createFromFormat('d/m',$_REQUEST['date'])->format('d/m');
    }else{
        $day = DateTime::createFromFormat('d/m/Y',$_REQUEST['date'])->format('j');
        $month = DateTime::createFromFormat('d/m/Y',$_REQUEST['date'])->format('n');
        $year = DateTime::createFromFormat('d/m/Y',$_REQUEST['date'])->format('Y');
        
        $date = DateTime::createFromFormat('d/m/Y',$_REQUEST['date'])->format('d/m/Y');
    }
    
}




        
$req = $bdd->prepare('UPDATE PLA_OFF '
        . 'SET OFF_NAME = :name ,'
        . 'OFF_DAY = :day, '
        . 'OFF_MONTH = :month, '
        . 'OFF_YEAR = :year, '
        . 'OFF_REPEAT = :repeat, '
        . 'OFF_VALID = :valid '
        . 'WHERE OFF_ID = :id');

$req ->execute(array(
       'name' => ucfirst($_REQUEST['name']),
       'day' => $day,
       'month' => $month,
       'year' => $year,
       'repeat' => $_REQUEST['repeat'],
       'valid' => $valid,
       'id' => $_REQUEST['id']));


if($_REQUEST['mode'] == 'valid'){

    $array['ok'] = 'ok';
    $class = $_REQUEST['repeat']==0? "outline-": "";

    $array['html'] = '<tr>'
                        .'<th scope="row">'
                            .'<button class="btn btn-secondary" onclick="modifOff('.$_REQUEST['id'].')">'
                                .'<i class="far fa-edit"></i>'
                            .'</button>'
                        .'</th>'
                        .'<td>'
                            .'<button class="btn btn-'.$class.'primary " data-repeat="'.$_REQUEST['repeat'].'" id="repeatOff_'.$_REQUEST['id'].'" disabled>'
                                .'<i class="fas fa-redo"></i>'
                            .'</button>'
                        .'</td>'
                        .'<td id="dateOff_'.$_REQUEST['id'].'">'.$date.'</td>'
                        .'<td id="nameOff_'.$_REQUEST['id'].'">'.$_REQUEST['name'].'</td>'

                        .'<td>'
                            .'<button class="btn btn-danger" onclick="modifOff(\'delete\','.$_REQUEST['id'].')">'
                                .'<i class="far fa-trash-alt"></i>'
                            .'</button>'
                        .'</td>'
                    .'</tr>';

} else if ($_REQUEST['mode'] == 'delete'){
   $array['ok'] = 'ok';
}

    
header("content-type:application/json");
echo json_encode($array);


