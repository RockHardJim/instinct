<?php

/*
	@abstract Returns what is between $start and $end in the given content $string
	@example  string_between('What is it','What','it')
	@param    string $string
	@param    string $start
	@param    string $end
	@return   string between
	@link     http://php.net/manual/en/function.strpos.php
	@todo     $r=explode($start,$string);if(isset($r[1])){$r=explode($end,$r[1]);return $r[0];}
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo string_between('What is it','What','it');

function string_between($string, $start, $end){
  $string = ' '.$string;
  $ini = strpos($string,$start);
  if ($ini == 0) return false;
  $ini += strlen($start);
  $len = strpos($string,$end,$ini) - $ini;
  return substr($string,$ini,$len);
}
