<?php

/*
	@abstract Reduce a string by the end, keeps whole words together
	@example  string_truncate('This is a very long test sentence, bla foo bar nothing!',20)
	@param    string $string
	@param    int $limit 
	@param    string $break [',' or '.' or ' ' - default=' ']
	@param    string $pad ['' or '...' or '&hellip;' - default='&hellip;']
	@return   string 
	@link     http://php.net/manual/en/function.substr.php - http://php.net/manual/en/function.str-replace.php
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo string_truncate('This is a very long test sentence, bla foo bar nothing!',20);

function string_truncate($string, $limit, $break=' ', $pad="&hellip;"){
  if(strlen($string) <= $limit)return $string;
  if(false !== ($breakpoint = strpos($string, $break, $limit))) {
    if($breakpoint < strlen($string) - 1) {
      $string = substr($string, 0, $breakpoint) . $pad;
    }
  }
  return $string;
}
