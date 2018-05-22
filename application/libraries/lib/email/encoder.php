<?php

/*
	@abstract Javascript eMail Encoder to prevent SPAM-Bots from collecting eMail-Addresses
	@example  email_encoder('mail@example.com', 'Contact Us', 'class="email_encoder"')
	@param    string $email [default="mail@example.com"]
	@param    string $linkText [default="Contact Us"]
	@param    string $attrs [default='class="email_encoder"']
	@return   string $html_code
	@link     http://aspirine.org/cgi-bin/trouvemail.pl?lang=en
	@todo     http://www.phpgang.com/how-to-hide-your-email-address-from-spam-bots_450.html
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo email_encoder('mail@example.com', 'Contact Us', 'style="font-family:monospace;"');

function email_encoder($email='mail@example.com', $linkText='Contact Us', $attrs='class="email_encoder"'){
  $email = str_replace('@', '&#64;', $email);
  $email = str_replace('.', '&#46;', $email);
  $email = str_split($email, 5);
  $linkText = str_replace('@', '&#64;', $linkText);
  $linkText = str_replace('.', '&#46;', $linkText);
  $linkText = str_split($linkText, 5);
  $part1 = '<a href="ma';
  $part2 = 'ilto&#58;';
  if($attrs != ''){
    $attrs = ' '.$attrs;
  }
  $part3 = '"'.$attrs.'>';
  $part4 = '</a>';
  $encoded = '<script type="text/javascript">';
  $encoded .= "document.write('$part1');";
  $encoded .= "document.write('$part2');";
  foreach($email as $e){
    $encoded .= "document.write('$e');";
  }
  $encoded .= "document.write('$part3');";
  foreach($linkText as $l){
    $encoded .= "document.write('$l');";
  }
  $encoded .= "document.write('$part4');";
  $encoded .= '</script>';
  return $encoded;
}
