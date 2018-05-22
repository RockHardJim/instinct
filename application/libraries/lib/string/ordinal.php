<?php

/*
	@abstract Add ordinal numbers (representing position or rank in a sequential order)
	@example  string_ordinal(4)
	@param    int $int
	@return   string $string
	@link     http://php.net/manual/en/function.abs.php
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo string_ordinal(4);

function string_ordinal($int){
  $test = abs($int) % 10;
  $string = ((abs($int) %100 < 21 && abs($int) %100 > 4) ? 'th'
    : (($test < 4) ? ($test < 3) ? ($test < 2) ? ($test < 1)
    ? 'th' : 'st' : 'nd' : 'rd' : 'th'));
  return $int.$string;
}
