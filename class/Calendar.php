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
	 * @param $year - the yar for check
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
	 * @param $leap - bool; 
	 */
	public function changeCalendar($leap) {
		if ($leap) {
			$this->calendar[2] = 29;
		} elseif($this->calendar[2]!=28) {
			$this->calendar[2] = 28;
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
			//echo 'dates valid';
			return true;
		} else {
			//echo 'invalid dates';
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
		} else {
			$this->invert = false;
		}
		return $this->invert;		
	}
	
	/**
	 * function for get Year from date
	 * @param $date - string, date format('YYYY-mm-dd')
	 * @param $type - string('year','mounth','day')
	 */
	public function getPartDate($date) {
		$arDate = explode('-', $date);
		return array(
			'year' => intval($arDate[0]),
			'mounth' => intval($arDate[1]),
			'day' => intval($arDate[2])
		);
	}
	
	/**
	 * function for get diff between two dates
	 * @param $date1 - string(date format)
	 * @param $date2 - string(date format)
	 */
	public function getDiff($date1,$date2) {
		if ($this->validateDate($date1)&&$this->validateDate($date2)) {
			echo 'validate success<br>';
			$arFirstDate = $this->getPartDate($date1);
			$arSecondDate = $this->getPartDate($date2);
			var_dump($arFirstDate);
			echo '<br>';
			var_dump($arSecondDate);
			$this->compareDates($date1,$date2);
			if(!$this->invert) {
				$leap = $this->checkYear($arFirstDate['year']);
				$this->initCalendar();
				$this->changeCalendar($leap);
				$days = -1;
				$mounth = 0;
				echo '<br>';
				if ($arFirstDate['year']<$arSecondDate['year']) {
					echo 'first algoritm';
				} elseif($arFirstDate['mounth']<$arSecondDate['mounth']) {
					//echo $arFirstDate['mounth'];die();
					//var_dump($this->calendar);die();
					$first_mounth = $arFirstDate['mounth'];
					while($arFirstDate['mounth']<=$arSecondDate['mounth']) {
						//$mounth++;
						while($arFirstDate['day']<=$this->calendar[$arFirstDate['mounth']]) {
							if ($arFirstDate['day']==$arSecondDate['day']&&$arFirstDate['mounth']!=$first_mounth) {
								$mounth++;
								//echo $arFirstDate['day'];
							}
							$arFirstDate['day'] = $arFirstDate['day']+1;
							$days++;
						}
						$arFirstDate['mounth'] = $arFirstDate['mounth']+1;
						$arFirstDate['day'] = 1;
					}
					echo '<br>';
					echo 'mounth between 2 dates is: '.$mounth;
					echo '<br>';
					echo 'days between 2 dates is: '.$days;
					
				} else {
					
					while($arFirstDate['day']<=$arSecondDate['day']) {
						$days++;
						$arFirstDate['day'] = $arFirstDate['day']+1;
					}
					echo '<br>';
					echo 'days between 2 dates is: '.$days;
				}
			} else {
				echo 'second date value at least not less';
			}
		} else {
			echo 'error validation date';
		}
	}
}