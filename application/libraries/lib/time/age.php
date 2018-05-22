<?php

/*
	@abstract Calculate the age in years of a given birthdate
	@example  time_age('12.03.1968')
	@param    string $birthdate e.g. tt.mm.yyyy
	@return   int $years
	@link     http://php.net/manual/en/function.date.php
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo time_age('12.03.1968');

function time_age($birthdate){
  $adjust = (date("md") >= date("md", strtotime($birthdate))) ? 0 : -1;
  $years = date("Y") - date("Y", strtotime($birthdate));
  return $years + $adjust;
}
