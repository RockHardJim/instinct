<?php

/*
	@abstract Create a folder if it doesn't already exist
	@example  file_make_dir('test')
	@param    string $dirpath
	@param    int(octal) 0755 [default=0777]
	@return   bool
	@link     http://php.net/manual/en/function.chmod.php
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){echo file_make_dir('test');rmdir('test');}

function file_make_dir($dirpath, $mode=0777) {
	// Note that 0777 is already the default mode for directories
    return is_dir($dirpath) || mkdir($dirpath, $mode, true);
}
