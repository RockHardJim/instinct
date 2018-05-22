<?php

/*
	@abstract Start a secure Session
	@example  session_open()
	@param    -
	@return   -
	@link     http://php.net/manual/en/book.session.php
	@todo     Set a $session_name with some random key one time installing
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo session_open();

function session_open(){
	// or SERVER_NAME
	$session_name = md5(crc32($_SERVER['HTTP_HOST']));
	// If TRUE cookie will only be sent over secure connections
	$secure = false;
	// If TRUE PHP will attempt to send the httponly flag when setting the session cookie
	$httponly = true;
	// This specifies the lifetime of the cookie in seconds which is sent to the browser
	// The value 0 means until the browser is closed.
	$cookieLifetime = 0;
	// Gets current cookies params.
	$cookieParams = session_get_cookie_params();
	session_set_cookie_params(
		$cookieLifetime,
		$cookieParams["path"],
		$cookieParams["domain"],
		$secure,
		$httponly
	);
	// Sets the session name to the one set above
	session_name($session_name);
	// Start session
	$started = session_start();
	// Regenerated the session, delete the old one. There are problems with AJAX
	session_regenerate_id(true);
	if(!$started) {
		die('Error occurred when trying to start the session.');
	}
}
