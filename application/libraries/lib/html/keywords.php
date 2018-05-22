<?php

/*
	@abstract Print or return meta-keywords Tag as HTML Head Element
	@example  xmp(hub::html_keywords(array('admin','adilbo'),false))
	@param    array|string $keywords
	@param    bool $echo [default=true]
	@return   echo OR string $html
	@link     http://www.w3schools.com/html/html_head.asp
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
	echo '<xmp>';
	html_keywords(array('admin','adilbo'));
	echo '</xmp>';
}

function html_keywords($keywords, $echo=true){
	if(is_array($keywords)) {
		$keywords = trim(implode(',', $keywords),',');
	}
	$return = '<meta name="keywords" content="'.$keywords.'">'.PHP_EOL;
	if($echo) {
		echo $return;
	}
	return $return;
}
