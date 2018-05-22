<?php

/*
	@abstract Convert BB-Code (Bulletin Board Code) to HTML
	@example  string_bbcode('[b]bold[/b] [i]italic[/i] [u]underline[/u] [s]stroke[/s]')
	@param    string $bbcode
	@return   string $html
	@link     https://en.wikipedia.org/wiki/BBCode
	@todo     Implement more Codes (e.g. Table and List)
	@version  3.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo string_bbcode('[b]bold[/b] [i]italic[/i] [u]underline[/u] [s]stroke[/s]');

function string_bbcode($string){
  $find = array(
    '#\[b\](.*?)\[/b\]#s',
    '#\[i\](.*?)\[/i\]#s',
    '#\[u\](.*?)\[/u\]#s',
    '#\[s\](.*?)\[/s\]#s',
    '#\[url\]((?:ftp|https?)://.*?)\[/url\]#s',
    '#\[img\](https?://.*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]#s',
    '#\[code\](.*?)\[/code\]#s',
    '#\[quote\](.*?)\[/quote\]#s',
    '#\[size=(.*?)\](.*?)\[/size\]#s',
    '#\[color=(.*?)\](.*?)\[/color\]#s',
  );
  $replace = array(
    '<strong>$1</strong>',
    '<em>$1</em>',
    '<u>$1</u>',
    '<del>$1</del>',
    '<a href="$1">$1</a>',
    '<img src="$1" alt="$1" />',
    '<pre>$1</pre>',
    '<blockquote><p>$1</p></blockquote>',
    '<span style="font-size:$1px;">$2</span>',
    '<span style="color:$1;">$2</span>',
  );
  return preg_replace($find,$replace,$string);;
}
