<?php

/*
	@abstract Returns the last argument (filename or directory name) of an given path
	@example  file_last_arg(__FILE__)
	@param    string $path
	@return   string [file or folder]
	@link     -
	@todo     This replaces basename($path) and dirname($path) :P
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo file_last_arg(__FILE__);

function file_last_arg($path){
    $path = str_replace('\\', '/', $path); 
    $path = preg_replace('/\/+$/', '', $path);
    $path = explode('/', $path);
    $l = count($path)-1;
    return isset($path[$l]) ? $path[$l] : '';
}
