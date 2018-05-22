<?php 

/*
	@abstract Convert PRE-CODE-HTML-Content to PRE-CODE-htmlentities(HTML-Content)
	@example  html_pre2htmlentities('&lt;pre>&lt;code>&lt;script>alert("TEST")&lt;/script>&lt;/code>&lt;/pre>')
	@param    string $string
	@return   string
	@link     http://php.net/manual/en/function.preg-replace-callback.php
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo html_pre2htmlentities('<pre><code><script>alert("TEST")</script></code></pre>');

function html_pre2htmlentities($string){
	return preg_replace_callback('/<pre.*?><code(.*?)>(.*?)<\/code><\/pre>/imsu', create_function('$input', 'return "<pre><code $input[1]>".htmlentities($input[2])."</code></pre>";'), $string);
}