<?php

/*
	@abstract Checks if a provided string has a correct Domain syntax
	@example  check_domain('http://www.adilbo.com/')
	@param    string $domain
	@return   bool
	@link     http://regexlib.com/ - http://www.phpliveregex.com/
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo check_domain('http://www.adilbo.com/');

function check_domain($domain){
  if (!preg_match("#(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?#", $domain)) {
  	return false;
  }else{
  	return true;
  }
}
