<?php

/*
	@abstract Remove Emoji from String and replace it with ASCII place-maker
	@example  string_replace_emoji('☺️ ☝ ✌ ❤ ♨ ✈')
	@param    string $string
	@param    string $gap [default=■]
	@return   string
	@link     https://en.wikipedia.org/wiki/Emoji
	@todo     Looking for Emoji to test? http://getemoji.com/
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo string_replace_emoji('☺️ ☝ ✌ ❤ ♨ ✈');

function string_replace_emoji($string,$gap='■'){
  // 󾭩 https://shkspr.mobi/blog/2015/05/how-gmail-lets-spammers-grab-your-attention-with-emoji/
  if(mb_detect_encoding(file_get_contents(__FILE__))!= 'UTF-8'){
    die("<pre>\n\n\n\t<b>ERROR</b> ".basename(__FILE__)." is not UTF-8 Encodet!");
  }
  $return = '';
  // Match Emoticons
  $regex = '/[\x{1F600}-\x{1F64F}]/u';
  $return = preg_replace($regex, $gap, $string);
  // Match Miscellaneous Symbols and Pictographs
  $regex = '/[\x{1F300}-\x{1F5FF}]/u';
  $return = preg_replace($regex, $gap, $return);
  // Match Transport And Map Symbols
  $regex = '/[\x{1F680}-\x{1F6FF}]/u';
  $return = preg_replace($regex, $gap, $return);
  // Match Miscellaneous Symbols
  $regex = '/[\x{2600}-\x{26FF}]/u';
  $return = preg_replace($regex, $gap, $return);
  // Match Dingbats
  $regex = '/[\x{2700}-\x{27BF}]/u';
  $return = preg_replace($regex, $gap, $return);
  return $return;
}
