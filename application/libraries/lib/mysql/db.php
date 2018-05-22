<?php

/*
	@abstract Select db
	@example  mysql_db($link, $db)
	@param    object $link
	@param    string $db
	@return   bool
	@link     http://php.net/mysqli
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
  echo '<b>mysql_db($link, $db)</b> = '.@mysql_db($link, 'test').PHP_EOL.PHP_EOL;
}

function mysql_db($link, $db) {
  if (@mysqli_ping($link)) {
	// change db if server is alive
    return mysqli_select_db($link, $db);
  }else{
    return false;
  }

}
