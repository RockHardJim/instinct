<?php

/*
	@abstract Return ASCII-ART of a given IMAGE
	@example  image_asciiart('./test/asciiart.png','./test/asciiart.txt')
	@param    string $file
	@param    string $output_file [default='']
	@return   bool $invers [default=true]
	@link     http://php.net/imagecolorat
	@todo     Color Version http://www.hashbangcode.com/blog/php-script-turn-image-ascii-text
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
  echo '<pre>';
  echo image_asciiart('../../../test/asciiart.png');
  echo '</pre>';
}

function image_asciiart($file,$output_file='',$inverse=true){
  $return = false;
  if(file_exists($file)){
    $return = '';
    $img = imagecreatefromstring(file_get_contents($file));
    list($width, $height) = getimagesize($file);
    $scale = ($width + $height) / 100;
    $chars = " '.:|TX0#";
    if($inverse==true) $chars = strrev($chars);
    $chars_count = strlen($chars);
    for($y = 0; $y <= $height - $scale - 1; $y += $scale) {
      for($x = 0; $x <= $width - ($scale / 2) - 1; $x += ($scale / 2)) {
        $rgb = imagecolorat($img, $x, $y);
        $r = (($rgb >> 16) & 0xFF);
        $g = (($rgb >> 8) & 0xFF);
        $b = ($rgb & 0xFF);
        $sat = ($r + $g + $b) / (255 * 3);
        $return .= $chars[ (int)( $sat * ($chars_count - 1) ) ];
      }
      $return .= PHP_EOL;
    }
  }
  if($output_file!='' and $fp = fopen($output_file, 'w')){
    fwrite($fp, $return);
    fclose($fp);
	$return = true;
  }elseif($output_file!=''){
    $return = false;
  }
  return $return;
}
