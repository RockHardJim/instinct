<?php

/*
	@abstract Calculate x percent of a given value
	@example  helper_percentage(19, 100, 0)
	@param    int $percentage
	@param    int $given_value
	@param    int $digits [default=2]
	@return   float
	@link     http://php.net/manual/en/function.number-format.php
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo helper_percentage(19, 100, 0);

function helper_percentage($percentage, $given_value,$digits=2) {
  $value = ($percentage / 100) * $given_value;
  return  number_format( $value, $digits );
}
