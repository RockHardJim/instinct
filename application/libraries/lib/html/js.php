<?php

/*
	@abstract Print or return script-src Tag as HTML Head Element
	@example  xmp(hub::html_js('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js','',false))
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
	html_js('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js');
	echo '</xmp>';
}

function html_js($files, $path='', $echo=true){
	if(!is_array($files)) {
		$files = array($files);
	}
	$return = '';
	foreach($files as $file) {
		$return .= '<script type="text/javascript" src="'.$path.$file.'"></script>'.PHP_EOL;
	}
	if($echo) {
		echo $return;
	}
	return $return;
}
