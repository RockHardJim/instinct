<?php

/*
	@abstract Checks if a PHP Session is older than x Minutes an Expire it if so
	@example  check_session(0.01)
	@param    int $maxlifetime [in Minutes - default=30]
	@return   bool
	@link     http://php.net/manual/en/intro.session.php
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){session_start(); echo check_session(0.01);}

function check_session($maxlifetime=30){
  // NOTE that $maxlifetime should be at least equal to the life time of this custom expiration handler
  $return = true;
  if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > ($maxlifetime*60))) {
    // last request was more than e.g. 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
	$return = false;
  }
  $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
  // also use an additional time stamp to regenerate the session ID periodically to avoid attacks on sessions
  if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
  } else if (time() - $_SESSION['CREATED'] > ($maxlifetime*60)) {
    // session started more than e.g. 30 minutes ago
    session_regenerate_id(true); // change session ID for the current session an invalidate old session ID
    $_SESSION['CREATED'] = time();  // update creation time
  }
  return $return;
}