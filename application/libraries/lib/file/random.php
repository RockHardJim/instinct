<?php

/*
	@abstract Returns a random file from a given folder. It also allows extension filtering.
	@example  file_random(dirname(__FILE__), 'php')
	@param    string $path
	@param    string $regex_extensions ['jpg|png|gif' or '.*' or '[0-9]+']
	@return   string [file or folder]
	@link     http://php.net/manual/de/function.readdir.php
	@todo     Simplification e.g. $files = glob($dir . '/*.*'); BUT http://php.net/manual/de/function.glob.php#68869
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo file_random(dirname(__FILE__));

function file_random($folder='', $regex_extensions='.*'){
    $folder = trim($folder);
    $folder = ($folder == '') ? './' : $folder;
    if (!is_dir($folder)){ 
		return false; // invalid folder given
	}
    $files = array();
	if ($dir = @opendir($folder)){
        while($file = readdir($dir)){
            if (!preg_match('/^\.+$/', $file) and preg_match('/\.('.$regex_extensions.')$/', $file)){
                $files[] = $file;                
            }            
        }        
        closedir($dir);    
    }else{
		return false; // Could not open the folder
    }   
	if (count($files) == 0){
		return false; // No files where found
    }
    $rand = array_rand($files);
    return $folder . DIRECTORY_SEPARATOR . $files[$rand];
}
