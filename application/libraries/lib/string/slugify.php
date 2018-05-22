<?php

/*
	@abstract Make an URL slug from a given e.g. title String
	@example  string_slugify('Telefonía')
	@param    string $title_string
	@param    bool $lower transform to lowercase [default=true]
	@return   string
	@link     http://php.net/manual/en/function.iconv.php - http://php.net/manual/en/function.utf8-encode.php
	@todo     Check if this file is utf-8 encodet.
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo string_slugify('Telefonía');

function string_slugify($string, $lower=true){
  if(mb_detect_encoding(file_get_contents(__FILE__))!= 'UTF-8'){
    die("<pre>\n\n\n\t<b>ERROR</b> ".basename(__FILE__)." is not UTF-8 Encodet!");
  }
  $search  = array("Ä",  "Ö",  "Ü",  "ä",  "ö",  "ü",  "ß", "´", "'");
  $replace = array("Ae", "Oe", "Ue", "ae", "oe", "ue", "ss","_", "_");
  $string = str_replace($search, $replace, $string);
  if (function_exists('iconv')){
    $string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
  }elseif (function_exists('utf8_encode')){
    $string = utf8_encode($string);
  }
  $string = preg_replace('/[^a-z0-9-_ ]/i', '', $string);
  $string = str_replace(' ', '-', $string);
  $string = trim($string, '-');
  if($lower==true){
    $string = strtolower($string);
  }
  if (empty($string)) {
    return 'pretty-slug-not-available-in-case-of-only-unallowed-characters-'.time();
  }
  return $string;
}
