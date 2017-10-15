<?php
require_once('class/Calendar.php');

$dateClass = new Calendar();
echo 'Start project calendar<br>';

$dateClass->getDiff('2015-09-30', '2015-08-31');
/*if ($dataClass->checkYear(2001)) {
	echo 'THE HIGHT YEAR';
} else {
	echo 'THE LOW YEAR';
};

$dataClass->validateDate('2015-09-31');

$dataClass->compareDates('2015-09-31', '2015-08-31');

var_dump($dataClass->invert);*/
?>