<?php

/*
	@abstract Dumps information about a variable in a scrollable box
	@example  dump_box($_SERVER,'$_SERVER')
	@param    string|int|array|bool $var_name
	@param    string $label e.g. '$var_name' [default=null]
	@return   string $html
	@link     http://php.net/manual/en/function.var-dump.php
	@todo     Insert Trace
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo dump_box($_SERVER,'$_SERVER');

function dump_box($var, $label = null){
    if (!headers_sent()) {
        header('Content-Type:text/html; charset=utf-8');
    }
    print('<div style="background:#fafafa;margin:5px;padding:5px;border:solid grey 1px;font-family: monospace;">');
    print('<pre style="margin:0px;padding:0px;">');
    #$trace = dump_trace();
    print('<strong>');
    #echo $trace . PHP_EOL;
    if ($label) {
        echo $label;
    }
    print('</strong> ');
    print('<textarea style="width:100%;height:10%" onclick="this.select()">' . PHP_EOL);
    var_dump($var) . PHP_EOL;
    print('</textarea>');
    print('</pre>');
    print('</div>');
}
