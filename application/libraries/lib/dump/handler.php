<?php

/*
	@abstract Email PHP errors to admin instead of displaying it to the public
	@example  dump_handler(true,'mail@example.com')
	@return   mail|die()
	@link     http://www.bx.com.au/tools/ultimate-php-error-reporting-wizard
	@todo     -
	@version  3.0
*/

// We whant to use our custom function (dump_handler) to handle errors
set_error_handler('dump_handler');

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
	dump_handler(true,'internmail@gmail.com');
	echo $Trigger_an_error__var_doesnt_exist;
}

function dump_handler($number, $message, $file='', $line='', $vars=''){
	if($number==true){
		define('DUMP_HANDLER_EMAIL', $message);
		return;
	}
	$email  = '<p>ERROR No. '.$number.' occurred on line ';
	$email .= '<strong>'.$line.'</strong> in file <strong>'.$file.'</strong></p>';
	$email .= '<p>'.$message.'</p> ';
	$email .= '<pre>'.print_r($vars, true).'</pre>'; // return = true (no output)
	$headers = 'Content-type: text/html; charset=iso-8859-1' . PHP_EOL;
	#echo '<h1>'.DUMP_HANDLER_EMAIL.'</h1>'.$email; // debug only
	@error_log($email, 1, DUMP_HANDLER_EMAIL, $headers);
	// How to respond to errors on the user's side
	// Only echo an error, or exit the script. It's up to you...
	// e.g. only "die" if the error was 'more' than a NOTICE
	if ( ($number !== E_NOTICE) && ($number < 2048) ) {
		die("There was an error. Please try again later.");
	}
}
