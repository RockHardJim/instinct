<?php

/*
	@abstract Calculate how many month, weeks, days, hours and minutes are the given seconds
	@example  time_seconds_ago(5557720)
	@param    int $seconds
	@return   string [e.g. 6 days, 3 hours, 28 minutes, 40 seconds]
	@link     http://php.net/manual/en/function.floor.php
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo time_seconds_ago(55567720);

function time_seconds_ago($secs) {
  if($secs>=2592000){$months=floor($secs/2592000);$secs=$secs%2592000;$r=$months.' month';if($months<>1){$r.='s';}if($secs>0){$r.=', ';}}
  if($secs>=604800){$weeks=floor($secs/604800);$secs=$secs%604800;$r=$weeks.' week';if($weeks<>1){$r.='s';}if($secs>0){$r.=', ';}}
  if($secs>=86400){$days=floor($secs/86400);$secs=$secs%86400;$r=$days.' day';if($days<>1){$r.='s';}if($secs>0){$r.=', ';}}
  if($secs>=3600){$hours=floor($secs/3600);$secs=$secs%3600;$r.=$hours.' hour';if($hours<>1){$r.='s';}if($secs>0){$r.=', ';}}
  if($secs>=60){$minutes=floor($secs/60);$secs=$secs%60;$r.=$minutes.' minute';if($minutes<>1){$r.='s';}if($secs>0){$r.=', ';}}
  if($secs>0){$r.=$secs.' second';if($secs<>1){$r.='s';}}
  return $r;
}
