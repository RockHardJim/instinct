<?php

/*
	@abstract Return the most used color of a given image as RGB Value
	@example  image_dominantcolor('./test/sun.gif')
	@param    string $image
	@return   string [rgb(int,int,int)]
	@link     http://php.net/manual/de/function.imagecolorat.php
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo image_dominantcolor('../../../test/sun.gif');

function image_dominantcolor($image){
  if(!file_exists($image)) return false; # File not found
  $image_type = strtolower(substr(strrchr($image,'.'),1));
  if ( $image_type == 'jpeg' ) $image_type = 'jpg';
  switch ( $image_type ) {
    case 'gif': $i = @imagecreatefromgif($image); break;
    case 'jpg': $i = @imagecreatefromjpeg($image); break;
    case 'png': $i = @imagecreatefrompng($image); break;
  }
  $rTotal = 0;
  $gTotal = 0;
  $bTotal = 0;
  $total  = 0;
  for ($x=0;$x<imagesx($i);$x++) {
    for ($y=0;$y<imagesy($i);$y++) {
      $rgb = imagecolorat($i,$x,$y);
      $r   = ($rgb >> 16) & 0xFF;
      $g   = ($rgb >>  0) & 0xFF;
      $b   = $rgb & 0xFF;
      $rTotal += $r;
      $gTotal += $g;
      $bTotal += $b;
      $total++;
    }
  }
  $rAverage = round($rTotal/$total);
  $gAverage = round($gTotal/$total);
  $bAverage = round($bTotal/$total);
  return "rgb($rAverage, $gAverage, $bAverage)";
}
