<?php

/*
	@abstract Print simpe and short human readable backtrace debug info
	@example  dump_trace()
	@param    -
	@return   echo to browser
	@link     http://php.net/manual/en/function.debug-backtrace.php
	@todo     http://stackoverflow.com/questions/1423157/print-php-call-stack
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo dump_trace();

function dump_trace(){
    $bt = debug_backtrace();
	$backtrace = array_reverse($bt);
	#print_r($bt); // DEBUG ONLY
    $i = 1;
    print('<div style="background:#fafafa;margin:5px;padding:5px;border:solid grey 1px;font-family: monospace;">'.PHP_EOL);
    foreach($backtrace as $trace) {
		$file = basename($trace['file']);
		if(isset($trace['class'])) {
			$class = $trace['class'] . '->'; 
		}else{
			$class = '';
		}
		$function = $trace['function'].'()';
		$line = $trace['line'];
		echo sprintf("TRACE # %s %s <b>%s%s</b> line %s<br>", $i, $file, $class, $function, $line);
		$i++;
	}
	print('</div>' . PHP_EOL);
}
