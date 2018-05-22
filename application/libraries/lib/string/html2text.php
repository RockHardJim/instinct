<?php

/*
	@abstract Convert an HTML string into plain text
	@example  string_html2text(file_get_contents('http://www.example.com/'))
	@param    string $string The HTML text to convert
	@return   string
	@link     http://php.net/manual/en/function.ctype-digit.php
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo string_html2text(file_get_contents('http://www.example.com/'));

function string_html2text($html){
	return preg_replace('/\s+/', ' ',
		html_entity_decode(
		trim(strip_tags(preg_replace('/<(head|title|style|script)[^>]*>.*?<\/\\1>/si', '', $html))),
		ENT_QUOTES,
		ini_get("default_charset")
		)
	);
}
