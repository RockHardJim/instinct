<?php

/*
	@abstract Get affected results count from db
	@example  mysql_affected($link)
	@param    object $link
	@return   int|string|bool
	@link     http://php.net/mysqli
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
  echo '<b>mysql_affected($link)</b> = '.@mysql_affected($link).PHP_EOL.PHP_EOL;
}

function mysql_affected($link, $die=false) {
  if (@mysqli_ping($link)) {
	// count affected rows if server is alive
    $count = mysqli_affected_rows($link);
    if ($count > 0) {
	  // return affected rows count
      return $count;
    }else{
	  // error message
      $dieMessage = ': '.mysqli_error($link);
      $errorMessage = 'DB affected ERROR';
      if($die==true) die($errorMessage.$dieMessage);
      return $errorMessage;
	}
  }else{
	// error
	return false;
  }
}
