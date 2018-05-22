<?php

/*
	@abstract Dumps information about a variable
	@example  dump_var($_SERVER,'$_SERVER')
	@param    string|int|array|bool $var_name
	@param    string $label e.g. '$var_name' [default=null]
	@return   string $html
	@link     http://php.net/manual/en/function.var-dump.php
	@todo     Insert Trace
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo dump_var($_SERVER,'$_SERVER');

function dump_var($var, $label = null){
    if (!headers_sent()) {
        header('Content-Type:text/html; charset=utf-8');
    }
    print('<div style="background:#f8f8f8;margin:5px;padding:5px;border:solid grey 1px;font-family: monospace;">');
    #$trace = dump_trace();
    print('<pre style="margin:0px;padding:0px;">');
    print('<strong>');
    #echo $trace . PHP_EOL;
    if ($label) {
        echo $label;
    }
    print('</strong> ');
    var_dump($var);
    print('</pre>');
    print('</div>');
}
