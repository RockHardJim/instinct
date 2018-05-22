<?php

/*
	@abstract convert a normal HEX-color (like #FF00FF) into it's RGB values (rgb(255,0,255);)
	@example  html_hex2rgb('#FF00FF')
	@param    string $color
	@return   string rgb(255,0,255);
	@link     https://www.w3.org/wiki/CSS/Properties/color/RGB
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo html_hex2rgb('#FF00FF');

function html_hex2rgb($color){
    $color = str_replace('#', '', $color);
    if (strlen($color) != 6){ return 'rgb(0,0,0);'; }
    $r = hexdec(substr($color,0,2));
	$g = hexdec(substr($color,2,2));
	$b = hexdec(substr($color,4,2));
    return "rgb($r,$g,$b);";
}
