<?php

/*
	@abstract Return the local time/date according to locale settings
	@example  current_date()
	@param    string $format [dafault=Y-m-d H:i]
	@return   string
	@link     
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo current_date();

function current_date($format='Y-m-d H:i') {
	$date = new DateTime();
	return $date->format($format);
}
