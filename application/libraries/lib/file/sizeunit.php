<?php

/*
	@abstract Function for getting local file size with unit of measurement and x decimal
	@example  file_sizeunit(__FILE__)
	@param    string $file
	@param    int $digits [default=2]
	@return   string [size with unit of measurement]
	@link     http://php.net/manual/de/function.filesize.php
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo file_sizeunit(__FILE__);

function file_sizeunit($file, $digits=2) {
  if (!is_file($file))return false;
  $filePath = $file;
  if (!realpath($filePath)) {
    $filePath = $_SERVER['DOCUMENT_ROOT'].$filePath;
  }
  $fileSize = filesize($filePath);
  // units of measurement ---------------------------------------------
  //              Yotta, Zetta, Exa, Peta, Tera, Giga, Mega, Kilo, Byte
  $sizes = array('YB',  'ZB',  'EB','PB', 'TB', 'GB', 'MB', 'KB', 'Byte');
  $total = count($sizes);
  while ($total-- && $fileSize > 1024) {
    $fileSize /= 1024;
  }
  return round($fileSize, $digits).' '.$sizes[$total];
}
