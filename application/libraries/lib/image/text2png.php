<?php

/*
	@abstract Convert given text to an PNG image
	@example  image_text2png('adilbo',false)
	@param    string $text (max. 255 characters)
	@param    bool $bright [default=true]
	@return   IMAGE or false
	@link     http://php.net/manual/en/function.header.php
	@todo     -
	@version  3.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))
  image_text2png('Max Mustermann - Musterweg 26 - 12345 Musterstadt - 0172-5557720',false);

function image_text2png($text,$bright=true){
	if(!headers_sent() and strlen($text) <= 255){
		header("Content-type: image/png");
		$width = ceil(strlen($text) * 6.1111111);
		$im = @ImageCreate($width, 15);
		if($bright==false)$color = imagecolorallocate($im, 0, 0, 0);
		$color = imagecolorallocate($im, 255, 255, 255);
		if($bright==true)$color = imagecolorallocate($im, 0, 0, 0);
		$px = $py = 0;
		$fontSize = 2;
		imagestring($im, $fontSize, 2, $py, $text, $color);
		imagepng($im);
		imagedestroy($im);
	}else{
		return false;
	}
}