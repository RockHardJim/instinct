<?php

/*
	@abstract Returns a select box based on an key/value array where selected is based on key
	@example  html_select(array('Key1'=>'Value1','Key2'=>'Value2','Key3'=>'Value3'),'name','Key2')
	@param    array $array array of the key-text pairs
	@param    string $name The name of the select box
	@param    string $selected The key value of the selected element
	@param    string $attributes Additional attributes to insert into the html select tag [default='size="1"']
	@return   string $html
	@link     http://www.w3schools.com/tags/tag_select.asp
	@todo     Select if print or return
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
	echo '<xmp>';
	echo html_select(array('Key1'=>'Value1','Key2'=>'Value2','Key3'=>'Value3'),'name','Key2');
	echo '</xmp>';
}

function html_select($array, $name, $selected, $attributes='size="1"') {
	reset($array); // Set array pointer to its first element
	$return = "\n<select name=\"$name\" $attributes>";
	foreach ($array as $key => $value ) {
		$return .= "\n\t<option value=\"".$key."\"".
		($key == $selected ? " selected=\"selected\"" : '').">". 
		$value."</option>";
	}
	$return .= "\n</select>\n";
	return $return;
}
