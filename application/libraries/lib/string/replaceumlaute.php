<?php

/*
	@abstract Replacement of german 'umlauten' öüäßÖÜÄ to 
	@example  string_replaceumlaute('über heiße, ältere Öle')
	@param    string $string
	@return   string
	@link     http://php.net/manual/en/function.str-replace.php
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo string_replaceumlaute('über heiße, ältere Öle');

function string_replaceumlaute($string){
  if(mb_detect_encoding(file_get_contents(__FILE__))!= 'UTF-8'){
    die("<pre>\n\n\n\t<b>ERROR</b> ".basename(__FILE__)." is not UTF-8 Encodet!");
  }
  $return=str_replace('ä','ae',$string);
  $return=str_replace('ü','ue',$return);
  $return=str_replace('ö','oe',$return);
  $return=str_replace('Ä','Ae',$return);
  $return=str_replace('Ü','Ue',$return);
  $return=str_replace('Ö','Oe',$return);
  $return=str_replace('ß','ss',$return);
  return $return;
}
