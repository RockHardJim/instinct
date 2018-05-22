<?php

/*
	@abstract Checks if a provided string has a correct eMail syntax
	@example  check_email('internmail@gmail.com')
	@param    string $string
	@return   bool
	@link     http://regexlib.com/ - http://www.phpliveregex.com/
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo check_email('internmail@gmail.com');

function check_email($email){
  $nonascii      = "\x80-\xff"; # Non-ASCII-Chars are not allowed
  $nqtext        = "[^\\\\$nonascii\015\012\"]";
  $qchar         = "\\\\[^$nonascii]";
  $protocol      = '(?:mailto:)';
  $normuser      = '[a-zA-Z0-9][a-zA-Z0-9_.-]*';
  $quotedstring  = "\"(?:$nqtext|$qchar)+\"";
  $user_part     = "(?:$normuser|$quotedstring)";
  $dom_mainpart  = '[a-zA-Z0-9][a-zA-Z0-9._-]*\\.';
  $dom_subpart   = '(?:[a-zA-Z0-9][a-zA-Z0-9._-]*\\.)*';
  $dom_tldpart   = '[a-zA-Z]{2,5}';
  $domain_part   = "$dom_subpart$dom_mainpart$dom_tldpart";
  $regex         = "$protocol?$user_part\@$domain_part";
  return preg_match("#^$regex$#", $email);
}
