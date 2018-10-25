<?php
    header('content-type: text/css');//Déclare la page en tant que feuille de style
require '../../class/Autoloader.php';
Autoloader::register();

$bdd = new Database('yoda');

$arraySlot = []; 
$arrayPlanning = [];
$arrayTech = [];

$idx = 0;
$y = 0;
    $selectUser = $bdd->queryObj('SELECT USR_SURNAME '
            . 'FROM YDA_USERS '
            . 'WHERE USR_TECH = 1 '
//            . 'AND USR_DELETE IS NULL '
            . 'ORDER BY USR_ID ASC');
        
   foreach($selectUser as $key=>$value){
        $arrayTech['trigramme'][$y] = $value->USR_SURNAME;
        $y += 1;
    }
    
    $nbTech = intval($y);

    
    
    $select = $bdd->queryObj('SELECT * '
            . 'FROM PLA_SLOT_CONFIG '
            . 'WHERE SCO_VALID = 1');

    foreach($select as $key=>$value){
    
       $arraySlot['name'][$idx] = $value->SCO_NAME;
       $arraySlot['code'][$idx] = $value->SCO_CODE;
       $arraySlot['start'][$idx] = date_create_from_format('H:i:s', $value->SCO_START);
       $arraySlot['stop'][$idx] = date_create_from_format('H:i:s', $value->SCO_STOP);
       $arraySlot['color'][$idx] = $value->SCO_COLOR;
       
       $idx +=1;
    }
    
    $select2 = $bdd->queryObj('SELECT * '
            . 'FROM PLA_CONFIG');

    foreach($select2 as $key=>$value){

        $arrayPlanning['start'] = date_create_from_format('H:i:s', $value->PCO_START_PLANNING);
        $arrayPlanning['stop'] = date_create_from_format('H:i:s', $value->PCO_STOP_PLANNING);
        $workingDays = explode(',' , $value->PCO_WEEKDAY);

        $diff = $arrayPlanning['stop']->diff($arrayPlanning['start']);
        $workingTime = $diff->h;
        $workingTime = intval($workingTime) * 2;
        if ($diff->i == 30){
            $workingTime += 1;
        }
    }
    
    
    
?>
 
.grid{
    display: grid;
    grid-template-columns: repeat(<?=$workingTime?>, 1fr);
    grid-template-rows : repeat(<?=intval($nbTech)?>, 3fr) 1fr;
    border : 1px solid #999;
    background :white;
    font-size:0.9em;
  
}

.hour{
    grid-row-start:<?=intval($nbTech + 1 )?>;
    grid-column: 1/ <?=$workingTime + 1 ?>;
    opacity:0.9;
    display:grid;
    grid-template-columns : repeat(3, 1fr);
    font-size:0.3em;
    
}
.tech{
    padding-left: 15px;
}
<?php 
for($i = 0; $i< $idx; $i++):
    
    $start = $arrayPlanning['start']->diff($arraySlot['start'][$i]);
    $startDay = $start->h;
    $startDay = intval($startDay) * 2;
    if ($start->i == 30){
        $startDay += 1;
    }


    $long = $arraySlot['stop'][$i]->diff($arraySlot['start'][$i]);
    $longDay = $long->h;
    $longDay = intval($longDay) * 2;
    if ($long->i == 30){
        $longDay += 1;
    }

?>

.<?=$arraySlot['code'][$i]?>{
    background-color:#<?=$arraySlot['color'][$i]?>;
    grid-column: <?=$startDay . ' / span ' . $longDay?>;
    
}

<?php endfor;

for($i=0; $i< $y; $i++):?>

.<?=$arrayTech['trigramme'][$i]?>{
    grid-row : <?=$i+1?>;
}

<?php endfor;?>


.start{
    grid-column-start: 1;
    grid-row-start : 1;
    /*font-size: 0.2em;*/
    text-align : left;
    
}

.middle{
    grid-column-start: 2;
    grid-row-start : 1;
    /*font-size: 0.2em; */
    text-align:center;
    
}
.end{
    grid-column-start: 3;
    grid-row-start : 1;
    /*font-size: 0.2em; */
    text-align: right;
    
}