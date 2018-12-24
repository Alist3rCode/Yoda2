<?php

class Events{
    
    public function getEventsBetween($start, $end){
        
        $bdd = new Database('yoda');
        
        $sql = "SELECT SLO_ID, USR_FIRST_NAME, USR_NAME, USR_SURNAME, SLO_DATE, SCO_CODE, SCO_NAME FROM PLA_SLOT 
        INNER JOIN YDA_USERS ON SLO_ID_USR = USR_ID 
        INNER JOIN PLA_SLOT_CONFIG ON SLO_ID_SCO = SCO_ID
        WHERE SLO_DATE BETWEEN '{$start->format('Y-m-d')}' AND '{$end->format('Y-m-d')}'
        AND SLO_VALID = 1";
        
        $statement = $bdd->queryObj($sql);
        return $statement;
    }
    
    public function getEventsBetweenByDay($start, $end){
        $events = $this->getEventsBetween($start,$end);
        $days = [];
        foreach($events as $key=>$event){
            $date = $event->SLO_DATE;
            if (!isset($days[$date])){
                $days[$date] = [$event];
                
            }else{
                $days[$date][] = $event;
            }
        }
        
        return $days;
    }
}