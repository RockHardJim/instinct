<?php

/*
	@abstract Escape bad chars for db
	@example  mysql_escape($link,$string)
	@param    object $link
	@param    string $string
	@return   string|bool
	@link     http://php.net/mysqli
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
  echo '<b>mysql_escape($link,$query)</b> = '.@mysql_escape($link,"adilbo's").PHP_EOL.PHP_EOL;
}

function mysql_escape($link, $query){
  if (@mysqli_ping($link)) {
	// escape string if server is alive
    return mysqli_real_escape_string($link, $query);
  }else{
    return false;
  }
}
