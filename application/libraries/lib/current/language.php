<?php

/*
	@abstract Get the current Language
	@example  current_language(array('en','de'))
	@param    array $availableLanguages e.g. array('en','de')
	@param    string $default [default = 'en']
	@return   string
	@link     https://secure.php.net/manual/en/reserved.variables.server.php
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo current_language(array('en','de'));

function current_language($availableLanguages, $default='en'){
  if ( isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ) {
    $langs = explode( ',', $_SERVER['HTTP_ACCEPT_LANGUAGE'] );
    foreach ( $langs as $value ){
      $choice = substr( $value, 0, 2 );
      if ( in_array( $choice, $availableLanguages ) ) {
        return $choice;
      }
    }
  }
  return $default;
}
