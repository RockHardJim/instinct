<?php

/*
	@abstract Generate a Short Link of your given long Link
	@example  api_tinyurl('http://www.adilbo.com/')
	@param    string $url [with http://]
	@param    string $type tinyurl or isgd [default=tinyurl]
	@return   string [shorturl OR false]
	@link     http://longurl.org/services
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo api_tinyurl('http://www.adilbo.com/');

function api_tinyurl($url,$type='tinyurl'){
  if($type=='isgd'){
    $api = 'http://is.gd/create.php?format=simple&url=';
  }elseif($type=='tinyurl'){
	$api = 'http://tinyurl.com/api-create.php?url=';  
  }else{
    return false;
  }
  $ch = curl_init();
  curl_setopt($ch,CURLOPT_URL,$api.urlencode($url));
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,7); // timout 7 seconds
  $return = curl_exec($ch);
  curl_close($ch);
  return $return;
}
