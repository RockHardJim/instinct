<?php

/*
	@abstract Redirect to a given URL
	@example  xmp(hub::helper_redirect('http://www.example.com',false))
	@param    string $url [with http(s)://]
	@param    bool $echo [default=true]
	@return   Redirect or HTML Meta-Refresh Tag
	@link     http://php.net/manual/en/function.header.php
	@todo     http://es1.php.net/manual/en/function.headers-sent.php#75835
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
  @header('Content-Type: text/html; charset=utf-8');
  echo '<xmp>';
  helper_redirect('http://www.example.com');
  echo '</xmp>';
}

function helper_redirect($url,$echo=true){
	if(headers_sent() or error_get_last() != NULL or count(headers_list()) > 0){
		$return  = '<script type="text/javascript">';
		$return .= 'window.location.href="'.$url.'";';
		$return .= '</script>';
		$return .= '<noscript>';
		$return .= '<meta http-equiv="refresh" content="0;url='.$url.'" />';
		$return .= '</noscript>';
		if($echo) {
			echo $return;
		}
		return $return;
	}else{
		header('Location:'.$url, TRUE, 302); // 302 Found
	}
}
