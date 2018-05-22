<?php

/*
	@abstract Include file with custom error message if error_reporting(0)
	@example  error_reporting(0);hub::file_inc('adilbo.inc.php')
	@param    string $file
	@return   -
	@link     http://php.net/manual/en/features.remote-files.php
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){error_reporting(0);echo file_inc('adilbo.inc.php');}

function file_inc($file){
  // The ..._once() statement is identical to normal function 
  // except PHP will check if the file has already been included, and if so, not include/require it again
  if ( error_reporting() == 0 ){
    // on error, the include() function generates a warning, but the script will continue execution
    ( @include_once($file) ) OR print("<tt><p><b>ERROR</b> $file file not found!</p>");
  }else{
    // the require() generates a fatal error, and the script will stop
    require_once($file);
  }
}
