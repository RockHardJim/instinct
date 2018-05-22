<?php

/*
	@abstract Print or return meta-description Tag as HTML &lt;head> Element
	@example  html_viewsource('http://www.example.com/',false)
	@param    string $url
	@param    bool $echo [default=true]
	@return   echo OR string $html
	@link     http://php.net/manual/en/function.file.php
	@todo     -
	@version  3.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
	html_viewsource('http://www.example.com/',true);
}

function html_viewsource($url,$echo=true){
	$style = 'background:#ddd;text-align:right;width:30px;display:inline-block;';
	$lines = file($url);
	$return = '<pre style="max-height:94vh;overflow:scroll;">';
	foreach ($lines as $line_number => $line) { 
		$return .= '<div style="'.$style.'"><b style="padding:3px;">'.
		$line_number.'</b></div> '.htmlspecialchars($line);
	}
	$return .= '</pre>';
	if($echo) {
		echo $return;
	}
	return $return;
}
