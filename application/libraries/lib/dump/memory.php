<?php

/*
	@abstract Dumps information about memory usage
	@example  dump_memory()
	@param    -
	@return   string $html
	@link     http://php.net/manual/en/function.memory-get-peak-usage.php
	@todo     Insert Trace
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo dump_memory();

function dump_memory(){
    print('<div style="background:#fafafa;margin:5px;padding:5px;border:solid grey 1px;font-family: monospace;">');
    #$trace = dump_trace();
    print('<pre style="margin:0px;padding:0px;">');
    print('<strong>');
    #echo $trace . PHP_EOL;
    echo 'Memory Usage ';
    print('</strong>');
    echo round(memory_get_peak_usage()/1024).' KByte of '.ini_get("memory_limit").' (0 or -1 = unlimited)'.PHP_EOL;
    print('</pre>' . PHP_EOL);
    print('</div>' . PHP_EOL);
}
