<?php

/*
	@abstract Calculate the difference between two date values
	@example  print_r(hub::date_dif('12.03.1968', date('dd.mm.yyyy')))
	@param    string $date1
	@param    string $date2
	@return   array[days,hours,minutes,seconds]
	@link     http://php.net/manual/de/function.date-diff.php
	@todo     solution of problem of missing date_diff function with php versions below 5.3.0
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))print_r(date_dif('12.03.1968',date('dd.mm.yyyy')));

function date_dif($date1, $date2){
  $second = strtotime($date2)-strtotime($date1);
  $day = intval($second/86400);
  $second -= $day*86400;
  $hour = intval($second/3600);
  $second -= $hour*3600;
  $minute = intval($second/60);
  $second -= $minute*60;
  return array('days'=>$day,'hours'=>$hour,'minutes'=>$minute,'seconds'=>$second);
}
