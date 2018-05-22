<?php

/*
	@abstract Get a Session Var
	@example  session_get('name')
	@param    string $name
	@return   -
	@link     http://php.net/manual/en/book.session.php
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo session_get();

function session_get($key){
	$key = 'nokuvikeleka_'.$key; // nokuvikeleka = security in zulu
	if( isset($_SESSION[$key]) ) {
		return $_SESSION[$key];
	}
	return false;
}
