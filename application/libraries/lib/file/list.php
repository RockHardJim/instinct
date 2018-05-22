<?php

/*
	@abstract Make a List of all Files of a given Folder (Format: html, csv or array) exclude child directories
	@example  file_list('./')
	@param    string $path
	@param    string $type [default="html" or set to csv or array]
	@param    bool $sortByDate (only for $type=array) [default=false]
	@return   string
	@link     http://php.net/manual/en/function.readdir.php
	@todo     Think about the glob function (but read hint in source-code)
	@version  3.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo file_list('./');

function file_list($dir, $type='html', $sortByDate=false){
  if(is_dir($dir)){
    if($handle = opendir($dir)){
	  $type = strtolower($type);
      if($type=='array') $data = array(); else $data = '';
	  /*
		glob('*') ignores all 'hidden' files by default. 
		This means it does not return files that start with a dot (e.g. ".file").
		If you want to match those files too, you can use "{,.}*" as the pattern with the GLOB_BRACE flag.
	  */
      while(($file = readdir($handle)) !== false){
        if($file != 'Thumbs.db' && $file[0] != '.' && !is_dir($file)){
          if($type=='html') $data  .= '<a target="_blank" href="'.$dir.$file.'">'.$file.'</a><br>';
          if($type=='array')$data[] = $file;
          if($type=='csv')  $data  .= $file.',';
        }
      }
      closedir($handle);
    }else{
		return false;
	}
    if($type=='csv')$data = rtrim($data,',');
	if($type=='array' and $sortByDate==true) {
		usort($data, create_function('$a,$b', 'return filemtime($b) - filemtime($a);'));
	}
    return $data;
  }
}
