<?php

/*
	@abstract Return an array of all supported Timezones
	@example  print_r(hub::time_zonelist())
	@param    -
	@return   array('Africa/Abidjan'=>'Africa/Abidjan (GMT+0)', ...
	@link     http://php.net/manual/en/timezones.php
	@todo     Need to be faster
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){echo '<pre>';print_r(time_zonelist());}

function time_zonelist(){
	$return = array();
	$timezone_identifiers_list = timezone_identifiers_list();
	foreach($timezone_identifiers_list as $timezone_identifier){
		$date_time_zone = new DateTimeZone($timezone_identifier);
		$date_time = new DateTime('now', $date_time_zone);
		$hours = floor($date_time_zone->getOffset($date_time) / 3600);
		$mins = floor(($date_time_zone->getOffset($date_time) - ($hours*3600)) / 60);
		$hours = 'GMT' . ($hours < 0 ? $hours : '+'.$hours);
		$mins = ($mins > 0 ? $mins : '0'.$mins);
		$text = str_replace("_"," ",$timezone_identifier);
		$return[$timezone_identifier] = $text.' ('.$hours.':'.$mins.')';
	}
	return $return;
}
