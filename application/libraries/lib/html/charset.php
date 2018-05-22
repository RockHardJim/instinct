<?php

/*
	@abstract Print or return meta-charset Tag as HTML &lt;head> Element
	@example  xmp(hub::html_charset('utf-8',false))
	@param    string $charset [default=utf-8]
	@param    bool $echo [default=true]
	@return   echo OR string $html
	@link     http://www.w3schools.com/html/html_head.asp
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
	echo '<xmp>';
	html_charset();
	echo '</xmp>';
}

function html_charset($charset='utf-8', $echo=true){
	$return = '<meta charset="'.$charset.'">'.PHP_EOL;
	if($echo) {
		echo $return;
	}
	return $return;
}
