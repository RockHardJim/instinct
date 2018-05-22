<?php

/*
	@abstract Block one or Block Multiple IP Addresses (from array or file)
	@example  ip_block($_SERVER['REMOTE_ADDR'],false)
	@param    string|array $ip [IP, IPs or File with IPs (one per Line)]
	@param    bool $exit [default=true means redirect to google ELSE ]
	@return   Redirekt or Error-Message
	@link     http://php.net/manual/en/function.header.php
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo ip_block($_SERVER['REMOTE_ADDR'],false);

function ip_block($ip,$exit=true){ # IP = IP, ARRAY OR FILE-NAME
  if ( !file_exists($ip) and !is_array($ip)) {
    $deny_ips[] = $ip;
  }elseif(!file_exists($ip)){
    $deny_ips[] = $ip;
  }else{
    $deny_ips = file($ip);
  }
  $ip = isset($_SERVER['REMOTE_ADDR']) ? trim($_SERVER['REMOTE_ADDR']) : '';
  if ( array_search($ip, $deny_ips) !== FALSE ) {
    if ( $exit == true ) {
      header('HTTP/1.1 301 Moved Permanently');
      header('Location: http://www.google.com');
      header('Connection: close');
      exit(1);
    }else{
      return 'Your IP address ('.$ip.') was blocked!';
    }
  }
}
