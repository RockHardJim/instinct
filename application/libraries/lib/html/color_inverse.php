<?php

/*
	@abstract This function inverses a color to it's opposite (White to black, blue to yellow, etc.)
	@example  html_color_inverse('#33cc33')
	@param    string $color [with # or without #]
	@return   string [with #]
	@link     -
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo html_color_inverse('#33cc33');

function html_color_inverse($color){
    $color = str_replace('#', '', $color);
    if (strlen($color) != 6){ return '#000000'; }
    $rgb = '';
    for ($x=0;$x<3;$x++){
        $c = 255 - hexdec(substr($color,(2*$x),2));
        $c = ($c < 0) ? 0 : dechex($c);
        $rgb .= (strlen($c) < 2) ? '0'.$c : $c;
    }
    return '#'.$rgb;
}
