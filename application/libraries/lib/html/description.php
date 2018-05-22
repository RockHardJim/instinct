<?php

/*
	@abstract Print or return meta-description Tag as HTML Head Element
	@example  xmp(hub::html_description('adilbo &mdash; Administartor',false))
	@param    string $description
	@param    bool $echo [default=true]
	@return   echo OR string $html
	@link     http://www.w3schools.com/html/html_head.asp
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
	echo '<xmp>';
	html_description('adilbo &mdash; Administartor');
	echo '</xmp>';
}

function html_description($description='', $echo=true){
	if(empty($description)){
		$description = '&mdash;';
	}
	$return = '<meta name="description" content="'.$description.'">'.PHP_EOL;
	if($echo) {
		echo $return;
	}
	return $return;
}
