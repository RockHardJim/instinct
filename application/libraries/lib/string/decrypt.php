<?php

/*
	@abstract Decrypt a given string with a sepecial $key
	@example  string_decrypt('tBPfKi/6F2Wa0+PNbgD7l5ez7ME64bfnVzw3DaRPxgI=','adilbo')
	@param    string $string
	@param    string $key
	@return   string
	@link     http://php.net/manual/en/function.mcrypt-decrypt.php
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo string_decrypt('tBPfKi/6F2Wa0+PNbgD7l5ez7ME64bfnVzw3DaRPxgI=','adilbo');

function string_decrypt($string, $key){
	if(function_exists('get_loaded_extensions')){
		if( in_array('mcrypt', get_loaded_extensions()) ){
			$string = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5($key) ), "\0" );
			return $string;
		}
	}
	return '---';
}
