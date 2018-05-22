<?php

/*
	@abstract This function makes a color darker. Enter the difference between the colors (default = 20)
	@example  html_color_darken('#33cc33', 50)
	@param    string $color [with # or without #]
	@param    num $dif [0-255]
	@return   string [with #]
	@link     -
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo html_color_darken('#33cc33', 50);

function html_color_darken($color, $dif=20){
    $color = str_replace('#', '', $color);
    if (strlen($color) != 6){ return '#000000'; }
    $rgb = '';
    for ($x=0;$x<3;$x++){
        $c = hexdec(substr($color,(2*$x),2)) - $dif;
        $c = ($c < 0) ? 0 : dechex($c);
        $rgb .= (strlen($c) < 2) ? '0'.$c : $c;
    }
    return '#'.$rgb;
}
