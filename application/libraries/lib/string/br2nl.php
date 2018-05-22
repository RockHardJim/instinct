<?php

/*
	@abstract Convert &lt;br> tags to newline (\r\n)
	@example  string_br2nl('Just&lt;br>a&lt;br />Test')
	@param    string The string to convert
	@return   string The converted string
	@link     http://php.net/manual/de/function.nl2br.php
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo '<xmp>'.string_br2nl("Just<br>a<br />Test");

function string_br2nl($string){
  return preg_replace("=<br(>|([\s/][^>]*)>)\r?\n?=i", "\r\n", $string);
}
