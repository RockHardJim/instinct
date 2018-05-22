<?php

/*
	@abstract Connect to db
	@example  mysql_open('example.com', 'user', 'password', 'database', 3306)
	@param    string $hostname
	@param    string $username
	@param    string $password
	@param    string $database
	@param    int $port
	@param    bool $die [default=false]
	@return   object|bool
	@link     http://php.net/mysqli
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
  $link = @mysql_open('localhost', 'root', '', 'test', 3306);
  echo "<b>mysql_open('example.com', 'user', 'password', 'database', 3306)</b> = <pre>";
  echo var_dump($link).'</pre>'.PHP_EOL.PHP_EOL;
}

function mysql_open($host,$user,$pass,$db,$port=3306,$die=false) {
  // connect
  $return = mysqli_connect($host,$user,$pass,$db,$port);
  // check
  if (mysqli_connect_error()) {
	// error message
    $dieMessage = ': '.mysqli_connect_error();
    $errorMessage = 'DB connect ERROR';
    if($die==true) die($errorMessage.$dieMessage);
    return $errorMessage;
  }else{
	// set charset to utf8
	mysqli_set_charset($return, 'utf8');
	// return object
    return $return;
  }
}
