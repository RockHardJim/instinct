<?php

/*
	@abstract Upload a single file to a FTP server
	@example  file_ftp('localhost','root','pass','./test/sun.gif','sun.gif')
	@param    string $host [Domain name or IP Address]
	@param    string $usr [Username]
	@param    string $pwd [Password]
	@param    string $local_file [../folder/file.txt]
	@param    string $ftp_file_path [file.txt]
	@return   bool
	@link     http://php.net/manual/de/function.ftp-put.php
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo file_ftp('localhost','root','pass','../../test/sun.gif','sun.gif');

function file_ftp($host, $usr, $pwd, $local_file, $ftp_file_path){
	if ($conn_id = ftp_connect($host, 21) and ftp_login($conn_id, $usr, $pwd) ) {
		ftp_pasv ($conn_id, true); // (some servers need this)
		$upload = ftp_put($conn_id, $ftp_file_path, $local_file, FTP_BINARY); // or FTP_ASCII
		$return = (!$upload) ? false : true;
		if (!function_exists('ftp_chmod')) {
		   function ftp_chmod($ftp_stream, $mode, $filename){
				return ftp_site($ftp_stream, sprintf('CHMOD %o %s', $mode, $filename));
		   }
		}
		if (ftp_chmod($conn_id, 0666, $ftp_file_path) !== false) {
			$return = true;
		} else {
			$return = false;
		}
		ftp_close($conn_id);
	}else{
		$return = false; // Host Error OR Login Error		
	}
	return $return;
}
