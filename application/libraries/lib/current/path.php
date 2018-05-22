<?php

/*
	@abstract Get the current Path
	@example  current_path()
	@param    -
	@return   string path to __FILE__ without filename
	@link     http://php.net/manual/en/language.constants.predefined.php
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo current_path();

function current_path(){
  return dirname(__FILE__);
}
