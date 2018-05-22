<?php

/*
	@abstract Checks if all of the characters in the provided string is alphabetic (also ÖÜÄöüäß)
	@example  check_string('AöüäßÖÜÄßbcdefghijklmnopqrstuvwXYZ')
	@param    string $string
	@return   bool
	@link     http://php.net/manual/en/function.ctype-alpha.php
	@todo     change to ctype
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo check_string('AöüäßÖÜÄßbcdefghijklmnopqrstuvwXYZ');

function check_string($string) {
  if (!preg_match("#^[a-zÖÜÄöüäß?]+$#i", $string)) {
  	return false;
  }else{
  	return true;
  }
}
