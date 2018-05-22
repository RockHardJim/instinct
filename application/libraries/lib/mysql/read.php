<?php

/*
	@abstract Read from db
	@example  mysql_read($link, $query)
	@param    object $link
	@param    string $query
	@param    bool $die [default=false]
	@return   array|bool
	@link     http://php.net/mysqli
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
  echo '<b>mysql_read($link, "SELECT * FROM tabelle")</b> = '.PHP_EOL.PHP_EOL;
  var_dump(mysql_read($link, "SELECT * FROM tabelle"));
  echo PHP_EOL.PHP_EOL;
}

function mysql_read($link, $query, $die=false) {
  if (@mysqli_ping($link)) {
    // escape bad chars
    $query = mysqli_real_escape_string($link, $query);
    // execute query
    if ( $result = mysqli_query($link, $query) ) {
      // fetch results
      for($i = 0; $array[$i] = mysqli_fetch_assoc($result); $i++);
      // delete last empty one
      array_pop($array);
      // free all memory
      mysqli_free_result($result);
	  // return data
      return $array;
    }else{
	// error message
      $dieMessage = ': '.mysqli_error($link);
      $errorMessage = 'DB query ERROR';
      if($die==true) die($errorMessage.$dieMessage);
      return $errorMessage;
    }
  }else{
	// error
    return false;
  }
}
