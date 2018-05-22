<?php

/*
	@abstract Print or return style Tag as HTML Head Element
	@example  xmp(hub::html_style('a{color:red;}',false))
	@param    string $style
	@param    bool $echo [default=true]
	@return   echo OR string $html
	@link     http://www.w3schools.com/html/html_head.asp
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
	echo '<xmp>';
	html_style('a{color:red;}');
	echo '</xmp>';
}

function html_style($style, $echo=true){
	$return = '<style type="text/css">'.$style.'</style>'.PHP_EOL;
	if($echo) {
		echo $return;
	}
	return $return;
}
