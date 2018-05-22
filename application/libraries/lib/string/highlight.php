<?php

/*
	@abstract Textmarker one or more given Words in a given Text - Give back HTML Content
	@example  string_highlight('This is an example!','example')
	@param    string $content
	@param    string $words [one or more keywords with spaces]
	@param    string $colorset [light or dark - default=light]
	@return   string $html
	@link     http://php.net/manual/en/function.preg-replace.php
	@todo     More Colorsets?
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo string_highlight('This is an example!','This example');

function string_highlight($text, $words,$colorset='light'){
  $split_words = explode(' ', $words);
  $tx_color = "#fff";$bg_color = "#4285F4";
  if($colorset=='light'){$tx_color = "#444";$bg_color = "#FFFCB1";}
  foreach($split_words as $word){
    $text = preg_replace("#($word)#Ui", 
      "<strong style=\"padding:2px 3px;color:".$tx_color.";background-color:".$bg_color."\">$1</strong>", 
      $text);
  }
  return $text;
}
