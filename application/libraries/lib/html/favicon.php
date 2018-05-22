<?php

/*
	@abstract Print or return link-favicon Tag as HTML Head Element
	@example  xmp(hub::html_favicon('favicon.png', '', true, false))
	@param    string $file [default=favicon.png]
	@param    string $path [default='']
	@param    bool $typeIcon [default=true]
	@param    bool $echo [default=true]
	@return   echo OR string $html
	@link     http://www.w3schools.com/html/html_head.asp
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
	echo '<xmp>';
	html_favicon();
	echo '</xmp>';
}

function html_favicon($file='favicon.png', $path='', $typeIcon=true, $echo=true){
	$type = 'image/png';
	if($typeIcon) {
		$type = 'image/x-icon';
	}
	$return = '<link rel="shortcut icon" href="'.$path.$file.'" type="'.$type.'">'.PHP_EOL;
	if($echo) {
		echo $return;
	}
	return $return;
}
