<?php

/*
	@abstract Slow down the download speed for a given file to a fixed limit
	@example  file_download_limit(__FILE__, 1.5)
	@param    string $file
	@param    int $limit [default download rate = 1.5 kb/s]
	@return   file|false
	@link     -
	@todo     Ranges phpgangsta.de/dateidownload-via-php-mit-speedlimit-und-resume
	@todo     Bandwidth Throttle phpclasses.org/package/6709-PHP-Limit-the-speed-of-files-served-for-download.html
	@version  4.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo file_download_limit(__FILE__, 0.01);

function file_download_limit($file, $download_rate=1.5){
  if(file_exists($file) and is_file($file) and !headers_sent()) {
	ini_set('memory_limit', '300M');
	$save = ini_get('max_execution_time');
	set_time_limit(0);
	ignore_user_abort(true); // Don't end if the connection breaks
	@header('Cache-control: private');
	@header('Content-Description: File Transfer');
	@header('Content-Type: application/octet-stream');
	@header('Content-Transfer-Encoding: binary');
	@header('Expires: 0');
	@header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	@header('Pragma: public');
	@header('Content-Length: '.filesize($file));
	@header('Content-Disposition: filename='.basename($file));
    flush();
    $data = fopen($file, 'r');
    while(!feof($file)) {
      print fread($data, round($download_rate * 1024));
      flush();
      sleep(1);
    }
    fclose($data);
	set_time_limit($save);
  }else{
    return false; // File does not exist!
  }
}
