<?php

/*
	@abstract Set a Session Var
	@example  session_set('name', 'value')
	@param    string $name
	@param    string $value
	@return   -
	@link     http://php.net/manual/en/book.session.php
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo session_set();

function session_set($key, $value){
	$key = 'nokuvikeleka_'.$key; // nokuvikeleka = security in zulu
	$_SESSION[$key] = $value;
}
