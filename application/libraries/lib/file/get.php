<?php

/*
	@abstract Download remote url data or local file with fallback system
	@example  file_get('http://www.example.com') or file_get(__FILE__)
	@param    string $file_or_url
	@return   string|bool $content|false
	@link     http://php.net/manual/en/book.curl.php
	@todo     -
	@version  3.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo '<xmp>'.file_get('http://www.example.com');

function file_get($file_or_url){
	if(!isset($file_or_url))return false;

	if (function_exists('curl_exec') and $file_or_url[4] == ':'){ 
	    $header = get_headers($file_or_url);
        $response = substr($header[0], 9, 3);
        if($response == "404")return false;
        $ch = curl_init($file_or_url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT,  true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $return = (curl_exec($ch));
        curl_close($ch);
    }elseif(function_exists('file_get_contents') and preg_match('/1|yes|on|true/i', ini_get('allow_url_fopen')) ){
        $return = file_get_contents($file_or_url);
    }elseif(function_exists('fopen') && function_exists('stream_get_contents')){
        $handle = fopen ($file_or_url, 'rb');
        $return = stream_get_contents($handle);
		fclose($handle);
    }elseif(function_exists('fopen')){
		$handle = fopen ($file_or_url, 'rb');
		$return = fread($handle, filesize($file_or_url));
		fclose($handle);
	}else{
        $return = false;
    }
	return $return;
}
