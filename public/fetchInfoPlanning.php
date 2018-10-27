<?php

$bdd = new Database('yoda');
$idx = 0;
    
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
        . 'AND USR_DELETE IS NULL '
        . 'ORDER BY USR_FIRST_NAME, USR_NAME');
$idxTech = 0;

foreach($select5 as $key=>$value){
    
   $arrayTech[$idxTech]['name'] = ucfirst($value->USR_NAME);
   $arrayTech[$idxTech]['firstName'] = ucfirst($value->USR_FIRST_NAME);
   $arrayTech[$idxTech]['surname'] = strtoupper($value->USR_SURNAME);
   $arrayTech[$idxTech]['id'] = $value->USR_ID;

   $idxTech ++;
}

$select6 = $bdd->queryObj('SELECT * '
        . 'FROM PLA_OFF '
        . 'ORDER BY OFF_DAY,OFF_MONTH');
$idxOff = 0;

foreach($select6 as $key=>$value){
   $arrayOff[$idxOff]['id'] = $value->OFF_ID;
   $arrayOff[$idxOff]['name'] = ucfirst($value->OFF_NAME);
   $arrayOff[$idxOff]['day'] = $value->OFF_DAY;
   $arrayOff[$idxOff]['month'] = '/'.$value->OFF_MONTH;
   if($value->OFF_YEAR != ''){
       $arrayOff[$idxOff]['year'] = '/'.$value->OFF_YEAR;
   }else{
       $arrayOff[$idxOff]['year'] = "";
   }
   
   $arrayOff[$idxOff]['repeat'] = $value->OFF_REPEAT;

   $idxOff ++;
}



