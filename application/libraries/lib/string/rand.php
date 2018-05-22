<?php

/*
	@abstract Generate a alphanum id in the given length
	@example  string_rand(128)
	@param    int $length (no max. length) [default=8]
	@return   string $alphanum
	@link     http://php.net/manual/en/function.rand.php
	@todo     Optional Return Array without Duplicates?
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo string_rand(128);

function string_rand($length=8){
  $char = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  srand((double)microtime()*1000000); # 1 Mio.
  $return = '';
  for($i=0; $i< $length; $i++) {
      $return .= $char[rand()%strlen($char)];
  }
  return $return;
}
