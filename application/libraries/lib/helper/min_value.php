<?php

/*
	@abstract Get min value greater than zero (not null, not 0, ignore zero and strings) in an Array
	@example  helper_min_value(array(12.5,200,0,'test',null,123))
	@param    array $values
	@return   string
	@link     http://php.net/manual/en/function.floatval.php
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
  echo helper_min_value(array(12.5,200,0,'test',null,123));
}

function helper_min_value($values) {
    return min(array_diff(array_map('floatval', $values), array(0)));
}
