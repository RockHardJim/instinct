<?php

/*
	@abstract Get back all variables sent with POST and GET in an Array
	@example  print_r(hub::helper_postget())
	@param    -
	@return   array
	@link     http://php.net/manual/en/function.filter-input-array.php
	@todo     HINT: Will not work if you have set it by hand $_POST['test'] = 'adilbo';
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
  print_r(helper_postget());
}

function helper_postget(){
    $getArray = ($tmp = filter_input_array(INPUT_GET)) ? $tmp : array();
    $postArray = ($tmp = filter_input_array(INPUT_POST)) ? $tmp : array();
    $inputArray = array_merge($getArray, $postArray);
    return $inputArray;
}
