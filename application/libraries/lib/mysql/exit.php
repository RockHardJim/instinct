<?php

/*
	@abstract Close connection to db
	@example  mysql_exit($link)
	@param    object $link
	@return   bool
	@link     http://php.net/mysqli
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
  echo '<b>mysql_exit($link)</b> = '.@mysql_exit($link).PHP_EOL.PHP_EOL;
}

function mysql_exit($link) {
  if (@mysqli_ping($link)) { 
    // close connection if server is alive
    return mysqli_close($link);
  }else{
    return false;
  }
}
