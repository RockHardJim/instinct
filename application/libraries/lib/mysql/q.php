<?PHP

/*
	@abstract Query to db
	@example  mysql_q($link, $sql)
	@param    object $link
	@param    string $sql
	@return   bool|int|string
	@link     http://php.net/mysqli
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
  // insert query
  $sql = "INSERT INTO tabelle (name,description) VALUES ('what', 'some text here!')";
  $id = @mysql_q($link, $sql);
  echo '<b>mysql_q($link, "'.$sql.'")</b> = '.$id.'<br>'.PHP_EOL;
  // update query
  $sql = "UPDATE tabelle SET name='New text!' WHERE id='".$id."'";
  echo '<b>mysql_q($link, "'.$sql.'")</b> = '.@mysql_q($link, $sql).'<br>'.PHP_EOL;
  // delete query
  $sql = "DELETE FROM tabelle WHERE id='".$id."'";
  echo '<b>mysql_q($link, "'.$sql.'")</b> = '.@mysql_q($link, $sql).'<br>'.PHP_EOL;
}

function mysql_q($link, $query, $die=true) {
  if (@mysqli_ping($link)) {
	// execute query
    if ( $result = mysqli_query($link, $query) ) {
	  // return ID on (I)NSERT
      if(strtolower($query[0])=='i')return mysqli_insert_id($link);
	  // ELSE return true
      return true;
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
