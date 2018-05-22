<?php

/*
	@abstract Recursively delete a directory and all of it's contents (files and subdirectories)
	@example  file_delete(dirname(__FILE__), "*.{htm,txt}")
	@param    string $source absolute path to directory or file to delete
	@param    string $pattern 
	@param    string $test_modus [default=true, so no file or dir is delteted, only print info to browser]
	@return   bool true on success; false on failure
	@link     http://php.net/manual/en/function.rmdir.php
	@todo     -
	@version  3.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo file_delete(dirname(dirname(__FILE__)));

function file_delete($dir, $pattern='*', $real_modus=false){
  if(substr($dir,-1) == '/') { 
    $dir = substr($dir,0,-1); 
  }
  if(empty($dir) || file_exists($dir) === false){
    return false;
  }
  $ds = DIRECTORY_SEPARATOR;
  if (is_dir($dir)) { 
	chdir($dir);
	$objects = glob($pattern, GLOB_BRACE); // OPTION $objects = scandir($dir);
    foreach ($objects as $object) {
      if ($object != '.' && $object != '..' && $dir.$ds.$object != __FILE__) { 
        if (is_dir($dir.$ds.$object)){
          file_delete($dir.$ds.$object, $pattern, $real_modus);
        }else{
          if($real_modus==false){
		    echo "FILE $dir$ds$object<br>";
		  }else{
			unlink($dir.$ds.$object);
	      }
	    }
      } 
    }
    if($real_modus==false){
      echo "D.I.R $dir<br>";
    }else{
      return rmdir($dir);
    }
  }
}
