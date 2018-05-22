<?php

/*
	@abstract Generate a readable word in the given length
	@example  string_rand_readable(12)
	@param    int $length [default=8]
	@return   string $word
	@link     http://php.net/manual/en/function.rand.php
	@todo     Optional Return Array without Duplicates?
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo string_rand_readable(12);

function string_rand_readable($length=8){ // NO q?
  $conso  = array("b","c","d","f","g","h","j","k","l","m","n","p","r","s","t","v","w","x","y","z");
  $vocal  = array("a","e","i","o","u");
  $output = '';
  srand((double)microtime()*1000000); // 1 Mio.
  $max = $length/2;
  for($i=1; $i<=$max; $i++){
    $output .= $conso[rand(0,19)];
    $output .= $vocal[rand(0,4)];
  }
  return $output;
}
