<?php

class Calendar {
	//count days between dates
	public $years;
	//coutn mounth
	public $mounth;
	//count days
	public $days;
	//total days between two days
	public $total_days;
	//bool parameter
	public $invert;
	//calendar of days of the yaers
	private $calendar;
	
	public function initCalendar() {
		$this->calendar = array(
			1 => 31,
			2 => 28,
			3 => 31,
			4 => 30,
			5 => 31,
			6 => 30,
			7 => 31,
			8 => 31,
			9 => 30,
			10 => 31,
			11 => 30,
			12 => 31
		);	
		return $this->calendar;
	}
	
	/**
	 * Fucntion check the uaer 
	 * @params $year - the yar for check
	 */
	public function checkYear($year){
		$first_year = 1960;
		$leap_year = false;
		while ($year >= $first_year) {
			if ($year == $first_year) {
				$leap_year = true;
				break;
			}
			$first_year = $first_year+4;
		}
		return $leap_year;
	}
	
	/**
	 * function 
	 * @params $leap - bool; 
	 */
	public function changeCalendar($leap) {
		if ($leap) {
			$this->calendar[2] = 29;
		} elseif($this->calendar[2]!=28) {
			$this->calendar = 28;
		}
		return $this->calendar;
	}
	
	/**
	 * function for validate date
	 * @param $date
	 */
	public function validateDate($date) {
		$pattern = '/^[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/'; 
	
		if(preg_match($pattern ,$date))
		{
			echo 'dates valid';
			return true;
		} else {
			echo 'invalid dates';
			return false;
		}
	}
	
	/**
	 * function for compare 2 dates
	 * @param $date1
	 * @param $date2
	 */
	public function compareDates($date1, $date2) {
		if($this->validateDate($date1)&&$this->validateDate($date2)){
			echo 'dates are ready for compare';
		}
		if($date1 > $date2) {
			$this->invert = true;
		}
		return $this->invert;		
	}
}