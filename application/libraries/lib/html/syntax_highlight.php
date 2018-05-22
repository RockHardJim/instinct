<?php

/*
	@abstract A simple syntax highlighting in you own colors
	@example  html_syntax_highlight(file_get_contents(__FILE__))
	@param    string $code [PHP or HTML]
	@return   string [HTML]
	@link     http://php.net/manual/de/function.highlight-string.php
	@todo     Offer different Color-Sets
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo html_syntax_highlight(file_get_contents(__FILE__));

function html_syntax_highlight($code){
    $code = str_replace('<','&lt;',$code);
    // this matches --> "foobar" <--
    $code = preg_replace(
        '/"(.*?)"/U', 
        '&quot;<span style="color: #007F00">$1</span>&quot;', $code
    );
    // hightlight functions and other structures like --> function foobar() <--- 
    $code = preg_replace(
        '/(\s)\b(.*?)((\b|\s)\()/U', 
        '$1<span style="color: #0000ff">$2</span>$3', 
        $code
    );
    // Match comments (like /* */)
    $code = preg_replace(
        '/(\/\/)(.+)\s/', 
        '<span style="color: #660066; background-color: #FFFCB1;"><i>$0</i></span>', 
        $code
    );
	// Match comments (like //) 
    $code = preg_replace(
        '/(\/\*.*?\*\/)/s', 
        '<span style="color: #660066; background-color: #FFFCB1;"><i>$0</i></span>', 
        $code
    );
    // hightlight braces
    $code = preg_replace('/(\(|\[|\{|\}|\]|\)|\->)/', '<strong>$1</strong>', $code);
    // hightlight variables $foobar
    $code = preg_replace(
        '/(\$[a-zA-Z0-9_]+)/', '<span style="color: #0000B3">$1</span>', $code
    );
    // special words and functions
    // The \b in the pattern indicates a word boundary, so only the distinct
    // word "web" is matched, and not a word partial like "webbing" or "cobweb" 
    $code = preg_replace(
        '/\b(print|echo|new|function)\b/', 
        '<span style="color: #7F007F">$1</span>', $code
    );
    return '<pre>'.$code.'</pre>';
}
