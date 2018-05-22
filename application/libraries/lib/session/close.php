<?php

/*
	@abstract Kill all Sessions
	@example  session_close()
	@param    -
	@return   bool
	@link     http://php.net/manual/en/book.session.php
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo session_close();

function session_close(){
	session_destroy();
	unset($_SESSION);
	return !isset($_SESSION);
}
