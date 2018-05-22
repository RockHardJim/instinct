<?php

/*
	@abstract Get the current, full URL
	@example  current_url(true)
	@param    bool $full [default=false]
	@return   string [URL with Protokoll, Host, Port and URI if $full==TRUE]
	@link     https://secure.php.net/manual/en/reserved.variables.server.php
	@todo     -
	@version  3.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo current_url(true);

function current_url($full=FALSE){
  $protocol  = empty($_SERVER['HTTPS']) ? 'http' : 'https';
  $port      = $_SERVER['SERVER_PORT'];
  $disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";
  $url       = $protocol.'://'.$_SERVER['SERVER_NAME'].$disp_port;
  if($full==TRUE)$url .= $_SERVER['REQUEST_URI'];
  $return    = str_replace('&', '&amp;', $url);
  return $return;
}
