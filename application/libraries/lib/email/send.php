<?php

/*
	@abstract Basic PHP mail() Function code to send HTML emails
	@example  email_send('email@example.com','email@example.com','This is an Example-Subject','Test eMail for your - can include HTML if you like!')
	@param    string $from [email@example.com]
	@param    string $to [email@example.com]
	@param    string $subject [This is an Example-Subject]
	@param    string $body [&lt;h1>Test&lt;/h1>&lt;p>&lt;b>eMail&lt;/b> for your&lt;/p>]
	@return   bool
	@link     http://php.net/manual/en/book.mail.php
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo email_send('email@example.com','email@example.com','This is an Example-Subject','<h1>Test</h1><p><b>eMail</b> for your</p>');

function email_send($from,$to,$subject,$body){
  if (isset($from) and !ini_get('safe_mode')){
    $old_from = ini_get('sendmail_from');
    ini_set('sendmail_from', $from);
  }
  $headers  = "From: $from\r\n";
  $headers .= "Reply-To: $from\r\n";
  $headers .= "Return-Path: $from\r\n";
  $headers .= 'X-Mailer: PHP/'. phpversion()."\r\n";
  $headers .= 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
  $return = false; # Mail not send ?
  if( @mail($to,$subject,$body,$headers) ){
    $return = true; # Mail send !
  }
  if ( isset($old_from) ){
    ini_set('sendmail_from', $old_from);
  }
  return $return;
}
