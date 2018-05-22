<?php

/*
	@abstract Checks if a provided string has a correct URL syntax
	@example  check_url('http://www.adilbo.com/php-scripts/')
	@param    string $string
	@return   bool
	@link     http://regexlib.com/ - http://www.phpliveregex.com/
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo check_url('http://www.adilbo.com/php-scripts/');

function check_url($url){
	$return = false;
	if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
		$return = true;
	}
	return $return;
}
