<?php

/*
	@abstract Calculate Execution time in seconds (first start set starttime)
	@example  dump_execution();sleep(2);echo hub::dump_execution()
	@param    -
	@return   string
	@link     http://php.net/manual/en/function.microtime.php
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
  dump_execution();
  sleep(2);
  echo dump_execution();
}

function dump_execution(){
  static $microtime_start = null;
  if($microtime_start === null){
    $microtime_start = microtime(true);
    return false;
  }
  return 'Execution time: '.round(microtime(true) - $microtime_start, 3).' seconds';
}
