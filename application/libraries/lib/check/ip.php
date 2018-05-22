<?php

/*
	@abstract Checks if a provided string has a correct eMail syntax (works with IPv4 and IPv6)
	@example  check_ip('FE80:0000:0000:0000:0202:B3FF:FE1E:8329')
	@param    string $ip
	@return   bool
	@link     http://regexlib.com/ - http://www.phpliveregex.com/
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo check_ip('FE80:0000:0000:0000:0202:B3FF:FE1E:8329'); // IPv6

function check_ip($ip){
  if (!preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/',$ip) and
    !preg_match('/^(((?=(?>.*?(::))(?!.+\3)))\3?|([\dA-F]{1,4}(\3|:(?!$)|$)|\2))(?4){5}((?4){2}|((2[0-4]|1\d|[1-9])?\d|25[0-5])(\.(?7)){3})\z/i',$ip)
     ){
    return false;
  }else{
    return true;
  }
}
