<?php

/*
	@abstract Get Alexa Traffic Rank (How is this site ranked relative to other sites)
	@example  api_alexarank('example.com')
	@param    string $url
	@return   string
	@link     Alexa Rank - https://en.wikipedia.org/wiki/Alexa_Internet
	@todo     http://aws.amazon.com/awis
	@version  3.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo api_alexarank('example.com');

function api_alexarank($url){
	#$api = 'http://alexa.com/siteinfo/'; // FALLBACK
	$api = 'http://data.alexa.com/data?cli=10&dat=snbamz&url=';
	$handle = fopen($api.$url, 'r');
	$content = stream_get_contents($handle);
    fclose($handle);
    $content = preg_replace("~(\n|\t|\s\s+)~",'', $content);
	#if(preg_match('~metrics-data align-vmiddle">(.+?)</strong>~im',$content,$matches)){ // FALLBACK
	if(preg_match('~<REACH RANK="(.+?)"/><RANK DELTA="(.+?)"/>~im',$content,$matches)){
		#return $matches[1]; // FALLBACK
		return $matches[1].' '.$matches[2];
	}else{
		return FALSE;
	}
}
