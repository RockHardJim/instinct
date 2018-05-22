<?php

/*
	@abstract Print or return meta-viewport Tag as HTML &lt;head> Element
	@example  xmp(hub::html_viewport('width=device-width, initial-scale=1.0', false))
	@param    string $string
	@param    string $string
	@param    string $string
	@param    bool $echo [default=true]
	@return   echo OR string $html
	@link     http://www.w3schools.com/html/html_head.asp
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
	echo '<xmp>';
	html_viewport();
	echo '</xmp>';
}

function html_viewport($content='width=device-width, initial-scale=1.0', $echo=true){
	$return = '<meta name="viewport" content="'.$content.'">'.PHP_EOL;
	if($echo) {
		echo $return;
	}
	return $return;
}
