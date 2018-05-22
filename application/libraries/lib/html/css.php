<?php

/*
	@abstract Print or return stylesheet-link Tag as HTML Head Element
	@example  xmp(hub::html_css('https://cdnjs.cloudflare.com/ajax/libs/toast-css/1.1.0/grid.min.css','',false))
	@param    array|string $files
	@param    string $path
	@param    bool $echo [default=true]
	@return   echo OR string $html
	@link     http://www.w3schools.com/html/html_head.asp
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
	echo '<xmp>';
	html_css('https://cdnjs.cloudflare.com/ajax/libs/toast-css/1.1.0/grid.min.css');
	echo '</xmp>';
}

function html_css($files, $path='', $echo=true){
	if(!is_array($files)) {
		$files = array($files);
	}
	$return = '';
	foreach($files as $file) {
		$return .= '<link rel="stylesheet" type="text/css" href="'.$path.$file.'">'.PHP_EOL;
	}
	if($echo) {
		echo $return;
	}
	return $return;
}
