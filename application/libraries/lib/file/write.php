<?php

/*
	@abstract Save file on a secure kind (exclusive lock)
	@example  file_write('./test/test.txt', 'Example Data')
	@param    string $file
	@param    string $data
	@return   bool
	@link     http://php.net/manual/en/function.flock.php
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
	echo file_write('../../../test/test.txt', 'Example Data');
}

function file_write($file, $data){
  if ($fp = fopen($file, 'c')){ // http://php.net/manual/de/function.fopen.php
    $start = microtime(TRUE);
    do{
      $canWrite = flock($fp, LOCK_EX); // to acquire an exclusive lock (writer)
      // if lock not obtained sleep for 0 - 100 milliseconds, to avoid collision and CPU load
      if(!$canWrite) usleep(round(rand(0, 100)*1000));
    } while ((!$canWrite)and((microtime(TRUE)-$start) < 5));
    // file was locked so now we can store information
    if ($canWrite){
      fwrite($fp, $data);
      flock($fp, LOCK_UN); // to release a lock (shared or exclusive)
    }
    fclose($fp);
	return true;
  }
}
