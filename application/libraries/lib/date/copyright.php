<?php

/*
	@abstract helps you keeping the current year in your copyright sentence
	@example  date_copyright(2015)
	@param    string|int $startYear
	@return   string
	@link     http://php.net/manual/en/function.date.php
	@todo     -
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo date_copyright(2015);

function date_copyright($startYear){
    $startYear = intval($startYear);
    $year = intval( date('Y') );
    if ($year > $startYear)
        return $startYear.'-'.$year;
    else
        return $startYear;
}
