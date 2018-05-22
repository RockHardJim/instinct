<?php

/*
	@abstract Make HTML Link fro a given URL (http,https,ftp,mailto or news) only www. URL will not work
	@example  string_makelink('http://www.exmple.com')
	@param    string $URL
	@return   string HTML-Link
	@link     http://php.net/manual/en/function.preg-replace.php
	@todo     Add Option for style or class
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo string_makelink('http://www.example.com');

function string_makelink($string,$attribute='style="text-decoration:underline;"'){
  $pattern = '#(^|[^\"=]{1})(http://|https://|ftp://|mailto:|news:)([^\s<>]+)([\s\n<>]|$)#sm';
  return preg_replace($pattern,"\\1<a ".$attribute." href=\"\\2\\3\">\\2\\3</a>\\4",$string);
}
