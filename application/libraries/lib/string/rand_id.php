<?php

/*
	@abstract Give a random id (num or alphanum) in the defined length
	@example  string_rand_id(100,true)
	@param    int $length (max. 33) [default=8]
	@param    bool $alphanum [default=false]
	@return   string $rand_id
	@link     http://php.net/manual/en/function.uniqid.php
	@todo     Generate IDs longer than 33 Chars (e.g. with openssl_random_pseudo_bytes) 
	@version  3.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo string_rand_id();

function string_rand_id($length=8,$alphanum=false){
  if($length>33)$length=33;
  list($usec, $sec) = explode(' ', microtime());
  mt_srand((float) $sec + ((float) $usec * 100000));
  $rand_string = uniqid(mt_rand(), true);
  if($alphanum==true)$rand_string = md5(uniqid(mt_rand(), true)); // ONLY FOR ALPHANUM IDs
  $return = substr($rand_string,0,$length);
  return $return;
}
