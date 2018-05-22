<?php

/*
	@abstract Extremely simple function to get human filesize
	@example  string_sizeunit(1024*100)
	@param    int $bytes
	@param    int $decimals [default=2]
	@return   string
	@link     http://php.net/manual/en/function.pow.php
	@todo     Option Fulltext: YottaByte, ZettaByte, ExaByte, PetaByte, TeraByte, GigaByte, MegaByte, KiloByte, Bytes
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo string_sizeunit(1024*100);

function string_sizeunit($bytes, $decimals=2){
  $unit = array('Bytes','KB','MB','GB','TB','PB','EB','ZB','YB');
  return @round($bytes/pow(1024,($i=floor(log($bytes,1024)))),$decimals).' '.$unit[$i];
}
