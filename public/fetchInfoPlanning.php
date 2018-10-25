<?php

$bdd = new Database('yoda');
$idx = 0;
    
$select2 = $bdd->queryObj('SELECT * '
        . 'FROM PLA_CONFIG');

foreach($select2 as $key=>$value){
    
   $arrayPlanning['start'] = date_create_from_format('H:i:s', $value->PCO_START_PLANNING);
   $arrayPlanning['stop'] = date_create_from_format('H:i:s', $value->PCO_STOP_PLANNING);
   $workingDays = explode(',' , $value->PCO_WEEKDAY);

}

$select3 = $bdd->queryObj('SELECT * '
        . 'FROM PLA_SLOT_CONFIG '
        . 'WHERE SCO_VALID = 1');

foreach($select3 as $key=>$value){

   $arrayConfig['name'][$idx] = $value->SCO_NAME;
   $arrayConfig['code'][$idx] = $value->SCO_CODE;
   $arrayConfig['start'][$idx] = date_create_from_format('H:i:s', $value->SCO_START);
   $arrayConfig['stop'][$idx] = date_create_from_format('H:i:s', $value->SCO_STOP);
   $arrayConfig['color'][$idx] = $value->SCO_COLOR;

   $idx +=1;
}

$select4 = $bdd->queryObj('SELECT count(*) as Count '
        . 'FROM YDA_USERS '
        . 'WHERE USR_TECH = 1 '
        . 'AND USR_DELETE IS NULL');

foreach($select4 as $key=>$value){

   $nbTech = $value->Count;
}