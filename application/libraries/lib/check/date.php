<?php

/*
	@abstract Checks if a provided string has a correct Date syntax
	@example  check_date('12.03.1968')
	@param    string $string [Format: dd.mm.yyyy]
	@return   bool
	@link     http://php.net/manual/de/function.checkdate.php
	@todo     use also with Format yyyy.mm.dd
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo check_date('12.03.1968');

function check_date($date) {
    list($d, $m, $y) = array_pad(explode('.', $date, 3), 3, 0);
	return ctype_digit("$d$m$y") && @checkdate($m, $d, $y);
}
