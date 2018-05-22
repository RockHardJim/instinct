<?php

/*
	@abstract Generate thumb from given image
	@example  image_thumb('./test/sun.gif',100,'./test/')
	@param    string $image Path an Image Filname
	@param    int $newwidth size of the thumb
	@param    string $target path to thump
	@return   string|bool Path to thump (name prefix 'tn_') or false on error
	@link     http://php.net/manual/en/function.imagecopyresampled.php
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo image_thumb('../../../test/sun.gif',100,'../../../test/');

function image_thumb($image, $newwidth, $target){
  if(!file_exists($image)) return false; // File not found
  $data     = getimagesize ($image);
  $width     = $data[0];
  $height    = $data[1];
  $typ       = $data[2];
  $newheight = intval($height*$newwidth/$width);
  $thumb     = $target.'tn_'.basename($image);
  switch ($typ){
    case '1':
      $old = ImageCreateFromGIF($image);
      $new = imagecreatetruecolor($newwidth,$newheight);
      imagecopyresampled($new,$old,0,0,0,0,$newwidth,$newheight,$width,$height);
      ImageGIF($new,$thumb);
      break;
    case '2':
      $old = ImageCreateFromJPEG($image);
      $new = imagecreatetruecolor($newwidth,$newheight);
      imagecopyresampled($new,$old,0,0,0,0,$newwidth,$newheight,$width,$height);
      ImageJPEG($new,$thumb);
      break;
    case '3':
      $old = ImageCreateFromPNG($image);
      $new = imagecreatetruecolor($newwidth,$newheight);
      imagecopyresampled($new,$old,0,0,0,0,$newwidth,$newheight,$width,$height);
      ImagePNG($new,$thumb);
      break;
    default:
    echo false; // Filetype not allowed!
  }
  return $thumb;
}
