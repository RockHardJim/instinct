<?PHP

/*
	@abstract Show HTML Source in Browser (with the help of XMP TAG)
	@example  xmp('&lt;h1>test&lt;/h1>')
	@param    string $str
	@param    bool $use_xmp [default=true]
	@return   string 
	@link     http://reference.sitepoint.com/html/xmp
	@todo     Please do not confuse with https://en.wikipedia.org/wiki/XMP
	@version  3.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))
	echo xmp('<h1>test</h1>',true);

function xmp($str,$use_xmp=true){
	if(php_sapi_name() == 'cli'){
		return $str;
	}else{
		if($use_xmp==true)$return='<xmp style="display:inline-block;">'.$str.'</xmp>';
		else $return=str_replace('<','&lt;',$str);
		return $return;
	}
}
