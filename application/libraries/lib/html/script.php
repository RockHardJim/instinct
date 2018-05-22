<?php

/*
	@abstract Print or return script Tag as HTML Head Element
	@example  xmp(hub::html_script('document.write("Hello")',false))
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
	html_script('document.write("Hello")');
	echo '</xmp>';
}

function html_script($script, $echo=true){
	$return = '<script type="text/javascript">'.$script.'</script>'.PHP_EOL;
	if($echo) {
		echo $return;
	}
	return $return;
}
