<?php

/*
	@abstract Checks if password is strong enough
	@example  check_password('pass','pass',true)
	@param    string $password
	@param    string $username
	@param    bool $check_agains_username [default=false]
	@return   string $html
	@link     http://www.trypap.com/
	@todo     -
	@version  3.0

	@hint     May not match the username (optional), min. 8 and max. 20 chars, contain upper and lower case letters, numbers and special characters
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo check_password('pass','pass',true);

function check_password($password,$username,$check_agains_username=false){
	$html = '';
	if ( $check_agains_username == true and $password == $username) {
		$html .= 'Password may not match the username!<br>';
	}
	if ( strlen($password) < 8 ) {
		$html .= 'Password too short!<br>';
	}
	if ( strlen($password) > 20 ) {
		$html .= 'Password too long!<br>';
	}
	if ( !preg_match("#[A-Z]+#", $password) ) {
		$html .= 'Password must include at least one CAPS!<br>';
	}
	if ( !preg_match("#[a-z]+#", $password) ) {
		$html .= 'Password must include at least one letter!<br>';
	}
	if ( !preg_match("#[0-9]+#", $password) ) {
		$html .= 'Password must include at least one number!<br>';
	}
	if ( !preg_match("#\W+#", $password) ) {
		$html .= 'Password must include at least one symbol!<br>';
	}
	if ( $password == '' ) {
		$html = 'No Password!';
	} else {
		if ( $html != '') {
			$html = 'Password strength failure (your choice is weak):<br>'.$html;
		} else {
			$html = 'Your Password is strong and .';
		}
	}
	return $html;
}
