<?php

/*
	@abstract Get the current IP
	@example  current_ip()
	@param    -
	@return   string
	@link     http://php.net/manual/en/language.constants.predefined.php
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo current_ip();

function current_ip() {
  if ( !empty($_SERVER['HTTP_CLIENT_IP']) ) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  }elseif ( !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }else{
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}
