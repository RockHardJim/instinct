<?php

/*
	@abstract Encrypt a given string with a sepecial $key
	@example  string_encrypt('Lorem Ipum Dolore','adilbo')
	@param    string $string
	@param    string $key
	@return   string
	@link     http://php.net/manual/en/function.mcrypt-encrypt.php
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo string_encrypt('Lorem Ipum Dolore','adilbo');

function string_encrypt($string, $key){
	if(function_exists('get_loaded_extensions')){
		if( in_array('mcrypt', get_loaded_extensions()) ){
			$string = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5($key) ) );
			#return gzcompress($string);
			return $string;
		}
	}
	return '---';
}
