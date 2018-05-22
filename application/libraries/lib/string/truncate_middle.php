<?php

/*
	@abstract Reduce a string by the middle
	@example  string_truncate_middle('This is a very long test sentence, bla foo bar nothing!',30)
	@param    string $string
	@param    int $max (default 50)
	@param    string $replacement (default [...])
	@return   string
	@link     http://php.net/manual/en/function.substr.php - http://php.net/manual/en/function.str-replace.php
	@todo     Do not cut words
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo string_truncate_middle('This is a very long test sentence, bla foo bar nothing!',30);

function string_truncate_middle($string, $max=50, $replacement="[&hellip;]"){
  if(strlen($string) <= $max)return $string;
  $strLen = strlen($string);
  $difLen = $strLen - $max;
  $leftText = substr($string, 0, $max/2);
  $repText = substr($string, $max/2, $difLen);
  $string = str_replace($repText, ' '.$replacement.' ', $string);
  $string = str_replace($leftText, rtrim($leftText), $string);
  return $string;
}
