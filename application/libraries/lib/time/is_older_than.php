<?php

/*
	@abstract Check a timestamp if it is older than human readable time formats like s, m, d or y
	@example  time_is_older_than('1d', 1458390133)
	@param    string $human_time e.g. d5 = 5 days [(s)econds, (m)inutes, (d)ays, (y)ears]
	@param    int $timestamp
	@return   bool
	@link     http://www.onlineconversion.com/unix_time.htm
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo time_is_older_than('1d', 1458390133);

function time_is_older_than($t, $check_time){
    $t = strtolower($t);
    $time_type = substr(preg_replace('/[^a-z]/', '', $t), 0, 1);
    $val = intval(preg_replace('/[^0-9]/', '', $t));
    $ts = 0;
    if ($time_type == 's'){ $ts = $val; }
    else if ($time_type == 'm'){ $ts = $val * 60; }
    else if ($time_type == 'h'){ $ts = $val * 60 * 60; }
    else if ($time_type == 'd'){ $ts = $val * 60 * 60 * 24; }
    else if ($time_type == 'y'){ $ts = $val * 60 * 60 * 24 * 365; }
    else { die('Unknown time format given!'); } // ERROR
    if ($check_time < (time()-$ts)){ return true; }
    return false;
}
