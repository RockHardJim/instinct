<?php

/*
	@abstract Check if eMail is valid also check MX-Record
	@example  email_valid('internmail@gmail.com', true)
	@param    string $email
	@param    bool $test_mx [default=false]
	@return   bool
	@link     -
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo email_valid('internmail@gmail.com', true);

function email_valid($email, $test_mx = false){
  if(preg_match("#^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$#", $email)){
    if($test_mx){
      list($username, $domain) = explode('@', $email, 2);
      return getmxrr($domain, $mxrecords);
    }else{
      return true;
    }
  }else{
    return false;
  }
}
