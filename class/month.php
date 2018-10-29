<?php 


class Month{
    
    public $days=['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    
	private $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
	public $month;
	public $year;


	public  function __construct($month = null, $year = null){
	    
	    if($month === null){
	        $month = intval(date('m'));
	    }
	    
	    if($year=== null){
	        $year= intval(date('Y'));
	    }
	    
		if ($month < 1 || $month > 12){
			throw new \Exception ('Le mois '. $month .' n\'est pas valable');
		}
		$this->month = $month;
		$this->year = $year;

	}
	

	
	public function getStartingDay(){
	    return new DateTime("{$this->year}-{$this->month}-01");
	}

	public function toString(){
		return $this->months[$this->month - 1]. ' ' . $this->year;

	}
	
	public function getWeeks(){
	    $start = $this->getStartingDay();
     	    $end = new DateTime("{$this->year}-{$this->month}-01");
	    $end->modify('+1 month - 1day');
	    $weeks =  intval($end->format('W')) -  intval($start->format('W')) +1;
           
	    if ($weeks < 0){
	        $weeks = intval($end->format('W'));
                if ($weeks == 1){
                    $weeks = 52  -  intval($start->format('W')) +1;;
                }
	    } 
	    return $weeks;
	}
	
	public function withinMonth($date){
	    return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');
	    
	}
	
	public function nextMonth(){
	    $month = $this->month+1;
	    $year = $this->year;
	    if ($month > 12){
	        $month = 1;
	        $year += 1; 
	    }
	    return new Month($month, $year);
	}
	
	public function previousMonth(){
	    $month = $this->month-1;
	    $year = $this->year;
	    if ($month < 1){
	        $month = 12;
	        $year -= 1; 
	    }
	    return new Month($month, $year);
	}
}