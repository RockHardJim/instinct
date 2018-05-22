<?php

/*
	@abstract Search for the geolocation of a IP address
	@example  ip_location('95.223.36.97')
	@param    string $ip
	@return   string $country
	@link     http://freegeoip.net/
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo ip_location('95.223.36.97');

function ip_location($ip){
  $default = 'unknown';
  $url = 'http://freegeoip.net/xml/' . urlencode($ip);
  $content = @file_get_contents($url);
  $city = '';
  if ( preg_match('#<City>([^<]*)</City>#i', $content, $regs) )  {
    $city = $regs[1];
  }
  $country = '';
  if ( preg_match('#<CountryName>([^<]*)</CountryName>#i', $content, $regs) )  {
    $country = $regs[1];
  }
  if( $city!='' and $state!='' ){
    $location = $city.' ('.$country.')';
    return $location;
  }elseif( $country!='' ){
    return $country;
  }else{
    return $default;
  }
}
?>