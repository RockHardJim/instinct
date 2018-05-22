<?php

/*
	@abstract Destroy a file on filesystem so it can't be recovered
	@example  file_destroy('HundeKatzenMausHausRaus.txt')
	@param    string $file
	@param    bool $wipe [default=false / 4 times overwriting, before deleting (for paranoid)]
	@return   bool
	@link     http://php.net/manual/en/function.unlink.php
	@todo     -
	@version  3.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
	$handle = fopen('HundeKatzenMausHausRaus.txt','w');
	fwrite($handle, 'HundeKatzenMausHausRaus');
	fclose($handle);
	echo file_destroy('HundeKatzenMausHausRaus.txt', true);
}

function file_destroy($file,$wipe=false){
  if($wipe==true){                           // PARANOID-MODE
    $size = filesize($file);
    $mask = str_repeat(chr(0), $size);
    file_put_contents($file, $mask);
    $mask = str_repeat(chr(255), $size);
    file_put_contents($file, $mask);
    $mask = str_repeat(chr(170), $size);
    file_put_contents($file, $mask);
    $mask = str_repeat(chr(85), $size);
    file_put_contents($file, $mask);
  }
  @unlink($file);                            // TRY
  clearstatcache();                          // RESET
  if (file_exists($file)){                   // CHECK
    $filesys = str_replace("/","\\",$file);  // TRANSLATE DIRECTORY_SEPARATOR
	@unlink($filesys);                       // TRY
    @system("del $filesys");                 // TRY
    @exec("del $filesys");                   // TRY
    @shell_exec("cmd /c del /F $filesys");   // TRY
    clearstatcache();                        // RESET
    if (file_exists($file)){                 // CHECK
      @chmod ($file, 0775);                  // GIVE RIGHTS
	  @unlink($file);                        // TRY
      @system("del $filesys");               // TRY
      @exec("del $filesys");                 // TRY
      @shell_exec("cmd /c del /F $filesys"); // TRY
    }
  }
  clearstatcache();                          // RESET
  if (!file_exists($file)){                  // CHECK
    return true;
  }else{
    return false;
  }
}

if (!function_exists('file_put_contents')) { /* HELPER */
    function file_put_contents($filename, $data) {
        $f = @fopen($filename, 'w');
        if (!$f) {
            return false;
        } else {
            $bytes = fwrite($f, $data);
            fclose($f);
            return $bytes;
        }
    }
}
