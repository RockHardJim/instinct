<?php

/*
	@abstract Print or return title Tag as HTML &lt;head> Element
	@example  xmp(hub::html_title('adilbo &mdash; Admin',false))
	@param    string $title
	@param    bool $echo [default=true]
	@return   echo OR string $html
	@link     http://www.w3schools.com/html/html_head.asp
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
	echo '<xmp>';
	html_title('adilbo &mdash; Admin');
	echo '</xmp>';
}

function html_title($title='', $echo=true){
	if(empty($title)){
		$title = '&mdash;';
	}
	$return = '<title>'.$title.'</title>'.PHP_EOL;
	if($echo) {
		echo $return;
	}
	return $return;
}
