<?php 
require_once "../ajaxDatabaseInit.php";

$arrayDays =[];

$arrayWeekdays = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
$arrayWeekdaysFr = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];


$start = DateTime::createFromFormat('Y-m-d',$_REQUEST['start']);

if (isset($_REQUEST['endAssocSlot']) && $_REQUEST['endAssocSlot'] != ""){
    $end = DateTime::createFromFormat('Y-m-d',$_REQUEST['endAssocSlot']);
    $flagEnd = 1;
} else{
    $end = 0;
    $flagEnd = 0;
}

$arrayDayToCreate = [];
$array = [];
$array['flag'] = [];
$array['error'] = [];


if($_REQUEST['mode']== 'hebdo'){
    
    if ($flagEnd == 1){
        if($end->format('Y') == $start->format('Y')){
            $repeat =  $end->format('W') - $start->format('W') +1;
        }else{
            $diffYear = $start->diff($end)->format('%y') + 1;
//            echo $diffYear. ' différence d annee<br>';
            $repeat =  $end->format('W') - $start->format('W') + intval($diffYear * 52);
//            echo 'repeat = '.$repeat .'<br>'; 
        }
        
    } else {
        $repeat = $_REQUEST['repeatAssocSlot'];
    }
//    var_dump($_REQUEST['workingDaysArray']);
    
    foreach($_REQUEST['workingDaysArray'] as $key=>$value){
//        echo 'value = '.$value. '<br>';
        $day = $arrayWeekdays[array_search($value, $arrayWeekdaysFr)];
//       echo '<br>the day is '.$day . "<br>";
//       echo 'start is '.$start->format('d-m-Y')."<br>";
        if(strtolower($start->format('l')) == $day){
            $date = clone $start;   
            array_push($arrayDayToCreate,$date->format('Y-m-d'));
//            echo "start = ".$day." & je push la date<br>";
        }else {
            $date = clone $start;
            if($flagEnd == 1){
                
//                echo "date avec fin en date = ".$date->format('d-m-Y').'<br>';
                $date->modify('next '.$day);
//                echo "date avec fin en date modif = ".$date->format('d-m-Y').'<br>';
                $interval = $date->diff($end);
                $interval->format('%R');
                
//                echo "intervale entre ".$date->format('d-m-Y')." et la date de fin : ".$end->format('d-m-Y')."<br>";
                if($interval->format('%R') == '+'){
                    array_push($arrayDayToCreate,$date->format('Y-m-d'));
                }else{
                     array_push($array['flag'],'W');
                     array_push($array['error'],"Aucun créneau créé le ". $value . " ".$date->format('d/m/Y'));
                }
                
            }else {
//                echo "date avec repetition = ".$date->format('d-m-Y').'<br>';
                $date->modify('next '.$day);   
//                echo "date avec repetition modif = ".$date->format('d-m-Y').'<br>';
                array_push($arrayDayToCreate,$date->format('Y-m-d'));
            }
            
        }
        for ($i = 0; $i<$repeat-1; $i++){
            
            $date->modify('next '.$day);     
            if($flagEnd == 1){
                $interval = $date->diff($end);
                $interval->format('%R');

//                echo "intervale (en mode boucle) entre ".$date->format('d-m-Y')." et la date de fin : ".$end->format('d-m-Y')."<br>";
                if($interval->format('%R') == '+'){
                    array_push($arrayDayToCreate,$date->format('Y-m-d'));
                }
            }else{
                array_push($arrayDayToCreate,$date->format('Y-m-d'));
            }
        } 
//         var_dump($arrayDayToCreate);

    }
    sort($arrayDayToCreate);
//    var_dump($arrayDayToCreate);

    
}else if($_REQUEST['mode']== 'month'){
    $date = clone $start;
    
    if ($flagEnd == 1){
        $repeatMonth = $date->diff($end)->format('%m');
        $repeatYear = $date->diff($end)->format('%y');
        $repeat = intval($repeatMonth) + 12 * ($repeatYear) + 1;
    } else {
        $repeat = $_REQUEST['repeatAssocSlot'];
    }
    
//    echo "repeat = ".$repeat;
//    echo "start date = ".$date->format('Y-m-d')."<br>";
    
    if($date->format('d') == $_REQUEST['dayMonthCreate']){
//        echo "start = ".$date->format('Y-m-d')." & je push la date<br>";
        array_push($arrayDayToCreate,$date->format('Y-m-d'));   
        
    } else{
//        echo 'je passe en mode boucle<br>';
        
        if ($date->format('d') < $_REQUEST['dayMonthCreate']) {
            $dayNextMonth = date_create_from_format('Y-m-d',$date->format('Y-m').'-'.$_REQUEST['dayMonthCreate']); 
//            $dayNextMonth->modify('+'.($_REQUEST['dayMonthCreate']-1). ' days');
            
        } else {
            $dayNextMonth = date_create_from_format('Y-m-d',$date->format('Y').'-'.($date->format('m')+1).'-'.$_REQUEST['dayMonthCreate']); 
//            $dayNextMonth->modify('+'.($_REQUEST['dayMonthCreate']-1). ' days');
            
        }
        
        echo "date avant = ".$date->format('Y-m-d')."<br>";
        $date = $dayNextMonth;
        echo "date après = ".$date->format('Y-m-d')."<br>";
        
        if($flagEnd == 1){
            $interval = $date->diff($end);
            $interval->format('%R');
//          echo "intervale entre ".$date->format('d-m-Y')." et la date de fin : ".$end->format('d-m-Y')."<br>";
//            
            if($interval->format('%R') == '+'){
                array_push($arrayDayToCreate,$date->format('Y-m-d'));
            }else{
                array_push($array['flag'],'W');
                array_push($array['error'],"Aucun créneau créé le ".$date->format('d/m/Y'));
            }

        }else{
            array_push($arrayDayToCreate,$date->format('Y-m-d'));
        }
    }
    
    for ($i = 0; $i<$repeat-1; $i++){
//        echo "date avant debut boucle = ".$date->format('Y-m-d')."<br>";
//        echo "check date : ".$_REQUEST['dayMonthCreate'].'-'.($date->format('m')+($i+1)).'-'.$date->format('Y')."<br>";
        
        if (checkdate(($date->format('m')+1),$_REQUEST['dayMonthCreate'],$date->format('Y'))){
            $date = date_create_from_format('Y-m-d',$date->format('Y').'-'.($date->format('m')+1).'-'.$_REQUEST['dayMonthCreate']); 
//            echo "check date ok, nouvelle date : ".$date->format('Y-m-d').'<br>';
        }else{
            if($flagEnd == 1){ 
                $date = date_create_from_format('Y-m-d',$date->format('Y').'-'.($date->format('m')+1).'-01'); 
//                echo "check date non, nouvelle date : ".$date->format('Y-m-d').'<br>';
//                echo "check date non, flagEnd 1<br>";
                continue;
               
            }else{
                $date = date_create_from_format('Y-m-d',$date->format('Y').'-'.($date->format('m')+2).'-'.$_REQUEST['dayMonthCreate']); 
//                echo "check date non, nouvelle date : ".$date->format('Y-m-d').'<br>';
            }
        }
//        $date->modify('+'.($_REQUEST['repeatMonthCreate']).' month');
//        echo "date apres debut boucle = ".$date->format('Y-m-d')."<br>";

        if($flagEnd == 1){
            $interval = $date->diff($end);
            $interval->format('%R');

//            echo "intervale (en mode boucle) entre ".$date->format('d-m-Y')." et la date de fin : ".$end->format('d-m-Y')."<br>";
            if($interval->format('%R') == '+'){
//                echo "je push la date ".$date->format('Y-m-d').'<br>';
                array_push($arrayDayToCreate,$date->format('Y-m-d'));
            }
        }else{
//            echo "je push la date ".$date->format('Y-m-d').'<br>';
            array_push($arrayDayToCreate,$date->format('Y-m-d'));
        }
    }  
    
    sort($arrayDayToCreate);
//    var_dump($arrayDayToCreate, $array);

}if ($_REQUEST['mode'] == 'one'){
    
   array_push($arrayDayToCreate,$start->format('Y-m-d')); 
}

foreach($arrayDayToCreate as $key=>$value){
    
    $select = $bdd->queryObj('SELECT * '
            . 'FROM PLA_SLOT '
            . 'INNER JOIN YDA_USERS ON USR_ID = SLO_ID_USR '
            . 'WHERE SLO_ID_USR = "'.$_REQUEST['idTech'].'" '
            . 'AND SLO_DATE = "'.$value.'" '
            . 'AND SLO_VALID = 1');
    
    if(count($select) > 0){
        
        array_push($array['flag'],'D');
        array_push($array['error'],"Aucun créneau créé le ".$value." pour ".ucfirst($select[0]->USR_FIRST_NAME).' '.strtoupper($select[0]->USR_NAME)." car un créneau est déja posé pour ce technicien.");
        unset($arrayDayToCreate[$key]);
        
    }
}



    
//header("content-type:application/json");
//echo json_encode($arrayDayToCreate);
