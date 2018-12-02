<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$bdd = new Database('yoda');
$idx = 0;


$events = new Events();
		
if(!isset($_GET['month']) || $_GET['month'] == ''){
    $monthGet = null;
}else{
    $monthGet = $_GET['month'];
}

if(!isset($_GET['year']) || $_GET['year'] == ''){
    $yearGet = date('Y');
}else{
    $yearGet = $_GET['year'];
}

try{
    $month = new Month($monthGet, $yearGet);
}catch (Exception $e){
    $month = new Month();
}



$select2 = $bdd->queryObj('SELECT * '
        . 'FROM PLA_CONFIG');

foreach($select2 as $key=>$value){
    
   $arrayPlanning['start'] = date_create_from_format('H:i:s', $value->PCO_START_PLANNING);
   $arrayPlanning['stop'] = date_create_from_format('H:i:s', $value->PCO_STOP_PLANNING);
   $workingDays = explode(', ' , $value->PCO_WEEKDAY);

}

$select3 = $bdd->queryObj('SELECT * '
        . 'FROM PLA_SLOT_CONFIG '
        . 'WHERE SCO_VALID = 1');

foreach($select3 as $key=>$value){

   $arrayConfig[$idx]['id'] = $value->SCO_ID;
   $arrayConfig[$idx]['name'] = ucfirst($value->SCO_NAME);
   $arrayConfig[$idx]['code'] = strtoupper($value->SCO_CODE);
   $arrayConfig[$idx]['start'] = date_create_from_format('H:i:s', $value->SCO_START);
   $arrayConfig[$idx]['stop'] = date_create_from_format('H:i:s', $value->SCO_STOP);
   $arrayConfig[$idx]['color'] = '#'.$value->SCO_COLOR;

   $idx +=1;
}

$select4 = $bdd->queryObj('SELECT count(*) as Count '
        . 'FROM YDA_USERS '
        . 'WHERE USR_TECH = 1 '
        . 'AND USR_DELETE IS NULL');

foreach($select4 as $key=>$value){

   $nbTech = $value->Count;
}

$select5 = $bdd->queryObj('SELECT * '
        . 'FROM YDA_USERS '
        . 'WHERE USR_TECH = 1 '
//        . 'AND USR_DELETE IS NULL '
        . 'ORDER BY USR_FIRST_NAME, USR_NAME');
$idxTech = 0;

foreach($select5 as $key=>$value){
    
   $arrayTech[$idxTech]['name'] = ucfirst($value->USR_NAME);
   $arrayTech[$idxTech]['firstName'] = ucfirst($value->USR_FIRST_NAME);
   $arrayTech[$idxTech]['surname'] = strtoupper($value->USR_SURNAME);
   $arrayTech[$idxTech]['id'] = $value->USR_ID;
   $arrayTech[$idxTech]['color'] = $value->USR_COLOR;

   $idxTech ++;
}

$select6 = $bdd->queryObj('SELECT * '
        . 'FROM PLA_OFF '
        . 'WHERE OFF_VALID = 1 '
        . 'ORDER BY OFF_DAY,OFF_MONTH');
$idxOff = 0;

foreach($select6 as $key=>$value){
   $arrayOff[$idxOff]['id'] = $value->OFF_ID;
   $arrayOff[$idxOff]['name'] = ucfirst($value->OFF_NAME);
      
   $arrayOff[$idxOff]['repeat'] = $value->OFF_REPEAT;
   
   if($arrayOff[$idxOff]['repeat'] == '1'){
       $arrayOff[$idxOff]['date'] = DateTime::createFromFormat('j-n',$value->OFF_DAY.'-'.$value->OFF_MONTH)->format('d/m');
       $arrayOff[$idxOff]['datePlanning'] = $yearGet.'-'.DateTime::createFromFormat('j-n',$value->OFF_DAY.'-'.$value->OFF_MONTH)->format('m-d');
   }else if ($arrayOff[$idxOff]['repeat'] == '0'){
       $arrayOff[$idxOff]['date'] = DateTime::createFromFormat('j-n-Y',$value->OFF_DAY.'-'.$value->OFF_MONTH.'-'.$value->OFF_YEAR)->format('d/m/Y');
       $arrayOff[$idxOff]['datePlanning'] = DateTime::createFromFormat('j-n-Y',$value->OFF_DAY.'-'.$value->OFF_MONTH.'-'.$value->OFF_YEAR)->format('Y-m-d');
   }

   $idxOff ++;
}




$weeks = $month->getWeeks();
$start = $month->getStartingDay();
$start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
$startClone = clone $start;
$end = $startClone->modify("+". (6 + 7 * ($weeks -1)). " days");
$events = $events->getEventsBetweenByDay($start,$end);

$labelCode = 'active';
$labelNom = '';
$colorTech = '';
$colorSlot = 'active';

$search = $bdd->queryObj('SELECT CPR_COLOR_PLANNING, CPR_LABEL_PLANNING '
        . 'FROM CFG_PREFERENCES '
        . 'WHERE CPR_ID_USR = "'.$_SESSION['id_user'].'"');

if (count($search)>0){
    if($search[0]->CPR_COLOR_PLANNING == 1){
        $colorTech = 'active';
        $colorSlot = '';
    }else if($search[0]->CPR_COLOR_PLANNING == 0){
        $colorTech = '';
        $colorSlot = 'active';
    }
    if($search[0]->CPR_LABEL_PLANNING == 1){
        $labelCode = '';
        $labelNom = 'active';
    }else if($search[0]->CPR_LABEL_PLANNING == 0){
        $labelCode = 'active';
        $labelNom = '';
    }

}else{
    $update = $bdd->prepare('REPLACE INTO CFG_PREFERENCES '
        . '(CPR_COLOR_PLANNING, CPR_LABEL_PLANNING, CPR_ID_USR) VALUES '
        . '(:color, :label, :id)');
    
    $update ->execute(array(
        'id' => $_SESSION['id_user'],
        'color' => 0,
        'label' => 0
        ));
}

