<?php

/*
	@abstract Force the download of a given file
	@example  file_forcedownload(__FILE__)
	@param    string $file
	@return   file|false
	@link     http://php.net/manual/en/function.header.php
	@todo     -
	@version  4.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo file_forcedownload(__FILE__);

function file_forcedownload($file){
  if ( isset($file) and file_exists($file) and !headers_sent()){
	// required for IE
	if(ini_get('zlib.output_compression')){
	  ini_set('zlib.output_compression', 'Off');
	}
    header('Pragma: public');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime($file)).' GMT');
    header('Cache-Control: private', false);
    header('Content-Type: application/force-download');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: '.filesize($file));
    header('Connection: close');
    readfile($file);
	exit;
  }else{
    return false; // File not found
  }
}
