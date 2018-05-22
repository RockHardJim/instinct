<?php

/*
	@abstract Function for getting remote file size
	@example  file_remotesize('http://www.example.com')
	@param    string $url
	@param    string $user [optional]
	@param    string $pass [optional]
	@return   string [size in bytes]
	@link     http://php.net/manual/de/function.filesize.php
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo file_remotesize('http://www.example.com');

function file_remotesize($url, $user='', $pass=''){
  ob_start();
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HEADER, 1);
  curl_setopt($ch, CURLOPT_NOBODY, 1);
  if(!empty($user) and !empty($pass)){
    $headers = array('Authorization: Basic '.base64_encode("$user:$pass"));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  }
  $ok = curl_exec($ch);
  curl_close($ch);
  $head = ob_get_contents();
  ob_end_clean();
  $regex = '/Content-Length:\s([0-9].+?)\s/';
  $count = preg_match($regex, $head, $matches);
  return isset($matches[1]) ? $matches[1] : 'unknown';
}
