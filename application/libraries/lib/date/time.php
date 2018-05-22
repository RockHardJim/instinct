<?php

/*
	@abstract Return a formatted date
	@example  date_time()
	@param    $type [e.g. RFC822 - default="yyyy.mm.dd"]
	@return   string
	@link     http://php.net/manual/en/class.datetime.php#datetime.constants.types
	@todo     -
	@version  3.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo date_time();

function date_time($type=''){
  switch(strtoupper($type)){
    case "ATOM":
      $format = "Y-m-d\TH:i:sP" ;
      break;
    case "COOKIE":
      $format = "l, d-M-Y H:i:s T" ;
      break;
    case "ISO8601":
      $format = "Y-m-d\TH:i:sO" ;
      break;
    case "RFC822":
      $format = "D, d M y H:i:s O" ;
      break;
    case "RFC850":
      $format = "l, d-M-y H:i:s T" ;
      break;
    case "RFC1036":
      $format = "D, d M y H:i:s O" ;
      break;
    case "RFC1123":
      $format = "D, d M Y H:i:s O" ;
      break;
    case "RFC2822":
      $format = "D, d M Y H:i:s O" ;
      break;
    case "RFC3339":
      $format = "Y-m-d\TH:i:sP" ;
      break;
    case "RSS":
      $format = "D, d M Y H:i:s O" ;
      break;
    case "W3C":
      $format = "Y-m-d\TH:i:sP" ;
      break;
    default:
      $format = "Y.m.d";
  }
  // Set the time zone to the default to avoid errors
  // Will default to UTC if it is not set properly in php.ini
  date_default_timezone_set(@date_default_timezone_get());
  return date($format);
}