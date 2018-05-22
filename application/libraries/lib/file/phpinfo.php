<?php

/*
	@abstract Returns the phpinfo() data and optional saves page to an file and add (.htm) to filename
	@example  file_phpinfo('./test/phpinfo')
	@param    string $file filname without extension [not required] .htm is added
	@return   string phpinfo() to file or browser
	@link     http://php.net/manual/en/function.phpinfo.php
	@todo     -
	@version  3.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo file_phpinfo();

function file_phpinfo($file='',$return=false){
	ob_start();
    phpinfo(INFO_GENERAL);
	phpinfo(INFO_CONFIGURATION);
	phpinfo(INFO_MODULES);
	phpinfo(INFO_ENVIRONMENT);
	phpinfo(INFO_VARIABLES);
    $info = ob_get_contents();
    ob_end_clean();
	if($file!=''){
      $fp = fopen($file.'.htm', 'w+');
      fwrite($fp, $info);
      fclose($fp);
	}else{
	  return $info;
	}
}
