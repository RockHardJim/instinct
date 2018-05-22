<?php

/*
	@abstract Download URL to local File usinf cURL
	@example  image_url2file('http://hinode.nao.ac.jp/latest/xrt_ffi_latest.gif', './test/sun.gif')
	@param    string $url
	@param    string $file
	@return   bool
	@link     http://hinode.nao.ac.jp/latest/xrt_ffi_latest.gif
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo image_url2file('http://hinode.nao.ac.jp/latest/xrt_ffi_latest.gif', '../../../test/sun.gif');

function image_url2file($url, $file){
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
  $rawdata=curl_exec($ch);
  curl_close ($ch);
  if($fp = fopen("$file",'w')){
    fwrite($fp, $rawdata);
    fclose($fp);
    return true;
  }
  return false;
}
