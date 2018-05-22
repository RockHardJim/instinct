<?php

/*
	@abstract Checks if all of the characters in the provided string are digit
	@example  check_number('01234567890')
	@param    string $string
	@return   bool
	@link     http://php.net/manual/en/function.ctype-digit.php
	@todo     change to ctype
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo check_number('01234567890');

function check_number($string){
  if (!preg_match("#^\d+$#", $string)){ 
  	return false; 
  }else{
  	return true; 
  }
}
