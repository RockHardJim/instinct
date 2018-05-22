<?php

/*
	@abstract Converts a image file to an Data URI
	@example  file_bin2datauri('http://www.famfamfam.com/lab/icons/mini/icons/icon_alert.gif')
	@param    string $input_file
	@return   string $data_URI
	@link     http://duri.me/faq.php
	@todo     -
	@version  3.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo '<xmp>'.file_bin2datauri('http://www.famfamfam.com/lab/icons/mini/icons/icon_alert.gif').'</xmp>';

function file_bin2datauri($file){
    $i = file_get_contents($file);
	$base64=base64_encode($i);
	$mimeTypes = array( // Image formats
		'jpg'  => 'image/jpeg',
		'jpeg' => 'image/jpeg',
		'jpe'  => 'image/jpeg',
		'gif'  => 'image/gif',
		'png'  => 'image/png',
		'bmp'  => 'image/bmp',
		'tif'  => 'image/tiff',
		'tiff' => 'image/tiff',
		'ico'  => 'image/x-icon',
	);
	$fileExtension = substr(strrchr($file, '.'), 1);
	$mime = isset($mimeTypes[$fileExtension]) ? $mimeTypes[$fileExtension] : "application/octet-stream";
	#$output = chunk_split("data:".@mime_content_type($file).";base64,$base64"); // deprecated
	$output = chunk_split("data:$mime;base64,$base64");
	return $output;
}
