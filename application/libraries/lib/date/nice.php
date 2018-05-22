<?php

/*
	@abstract Build date to prettified date ago or date from now
	@example  date_nice('12.03.1968')
	@param    string $date
	@return   string
	@link     http://php.net/manual/en/function.strtotime.php#example-2562
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo date_nice('12.03.1968');

function date_nice($date){
  if(empty($date)) return false; # ERROR: No date provided!
  $periods         = array('second','minute','hour','day','week','month','year','decade');
  $lengths         = array(         '60',    '60',  '24',  '7',  '4.35', '12',  '10');
  $now             = time();
  $unix_date       = strtotime($date);
  if(empty($unix_date)) return false; # ERROR: Bad Date!
  if($now > $unix_date) {
    $difference    = $now - $unix_date;
    $tense         = 'ago'; # Date in the Past
  }else{
    $difference    = $unix_date - $now;
    $tense         = 'from now'; # Date in the Future
  }
  for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
    $difference /= $lengths[$j];
  }
  $difference = round($difference);
  if($difference != 1) {
    $periods[$j].= 's'; // Majority
  }
  return "$difference $periods[$j] {$tense}";
}
