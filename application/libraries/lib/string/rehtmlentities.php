<?php

/*
	@abstract Convert &amp;amp; to &
	@example  string_rehtmlentities('Me &amp;amp; You')
	@param    string $html
	@return   string
	@link     http://php.net/manual/de/function.get-html-translation-table.php
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo string_rehtmlentities('Me &amp; You');

function string_rehtmlentities($html){
  $array = get_html_translation_table(HTML_ENTITIES);
  $array = array_flip($array);
  $return = strtr($html, $array);
  $return = utf8_encode($return);
  return $return;
}
