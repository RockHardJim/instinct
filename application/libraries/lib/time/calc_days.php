<?php

/*
	@abstract Calculate the difference between two given timestamps in days
	@example  time_calc_days(1451606400,time())
	@param    int $start_timestamp
	@param    int $end_timestamp
	@return   int $days
	@link     http://www.onlineconversion.com/unix_time.htm
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo time_calc_days(1451606400,time());

function time_calc_days($starttime,$endtime){
  $return = (int)(($endtime-$starttime)/86400); // 60sec * 60sec * 24h = 86400 = 1 day
  return $return;
}
