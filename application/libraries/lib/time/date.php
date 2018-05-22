<?php

/*
	@abstract Return well formatet Date (and optional time of day) of a given timestamp
	@example  time_date(time())
	@param    int $timestamp
	@param    string $format of month ['long' or 'short' or 'digit']
	@param    string $clock return time of day [yes='clock' or no='' / default='']
	@param    string $lang set language ['de' or 'en' / default='en']
	@return   string
	@link     http://php.net/manual/en/function.date.php
	@todo     -
	@version  3.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo time_date(time(),'long','clock');

function time_date($unixtime,$format='digit',$clock='',$lang='en'){
  if($format == 'long'){
    $m=array('January','February','March','April','May','June','July','August','September','October','November','December');
    if($lang=='de')$m=array('Januar','Februar','M&auml;rz','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember');
  }
  if($format == 'short'){
    $m=array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
    if($lang=='de')$m=array('Jan','Feb','M&auml;r','Apr','Mai','Jun','Jul','Aug','Sep','Okt','Nov','Dez');
  }
  if($format == 'digit') 
    $m = array('01.','02.','03.','04.','05.','06.','07.','08.','09.','10.','11.','12.');
  list($mday,$month,$year) = explode(" ",date("d n Y",$unixtime));
  $month -= 1;
  $time_date = "$mday. $m[$month] $year";
  if($format == 'digit')$time_date = str_replace(' ','',$time_date);
  if($clock == 'clock'){
    $time = date('H:i', $unixtime);
    return $time_date." - $time";
  }else{
    return $time_date;
  }
}
