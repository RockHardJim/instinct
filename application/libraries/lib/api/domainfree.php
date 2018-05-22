<?php

/*
	@abstract Check if Domain is available or taken
	@example  api_domainfree('http://www.api-host.com')
	@param    string $domain [with or without http://]
	@return   string [taken OR free]
	@link     http://de.wikipedia.org/wiki/Whois
	@todo     Enter more WHOIS TL Domains
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo api_domainfree('http://www.api-host.com');

function api_domainfree($domain){
  $domain = strtolower(trim($domain));
  $domain = preg_replace('/^http:\/\//i', '', $domain);
  $domain = preg_replace('/^www\./i', '', $domain);
  $domain = explode('/', $domain);
  $domain = trim($domain[0]);
  $_domain = explode('.', $domain);
  $lst = count($_domain)-1;
  $ext = $_domain[$lst];
  $servers = array(
    "com"  => "whois.internic.net",
    "info" => "whois.nic.info",
    "name" => "whois.nic.name",
    "net"  => "whois.internic.net",
    "gov"  => "whois.nic.gov",
    "edu"  => "whois.internic.net",
    "at"   => "whois.ripe.net",
    "ch"   => "whois.nic.ch",
    "de"   => "whois.nic.de",
    "fr"   => "whois.nic.fr",
	"it"   => "whois.nic.it",
    "to"   => "whois.tonic.to",
    "ru"   => "whois.ripn.net",
    "org"  => "whois.pir.org",
    "nl"   => "whois.domain-registry.nl"
  );
  if (!isset($servers[$ext])){
    return false; # Error: No matching nic server found!
  }
  $nic_server = $servers[$ext];
  $output = '';
  if ($conn = @fsockopen ($nic_server, 43)) {
    fputs($conn, $domain."\r\n");
    while(!feof($conn)) {
      $output .= fgets($conn, 128);
    }
    fclose($conn);
  }else{
    return false; # Error: Could not connect to NIC Server!
  }
  #echo $output; // FOR DEBUG ONLY
  $search = array(
	"No match for",
	"Status: free",
	"is free",
	"NOT FOUND",
	"no entries",
	"not have an entry",
	"AVAILABLE",
  );
  $matchFound = preg_match_all("/(" . implode($search,"|") . ")/i",$output,$matches);
  if($matchFound){
    return 'free';
  }else{
    return 'taken';
  }
}
