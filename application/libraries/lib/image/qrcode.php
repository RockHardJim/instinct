<?php

/*
	@abstract You can create a QR code on the fly for URL, TEL, TEXT and EMAIL
	@example  image_qrcode('http://adilbo.com')
	@param    string $data
	@param    string $type [URL, TEL, TXT, EMAIL default=TXT]
	@param    int $size in pixel [default=50]
	@param    string $ec allows recovery of data lost [L=7%,M=15%,Q=25%,H=30% -Default='L']
	@param    string $margin [in rows not in pixels default=1]
	@return   image PNG without header
	@link     https://developers.google.com/chart/infographics/docs/qr_codes
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF'])){
  header("Content-type: image/png");
  echo image_qrcode('Hello world');
}

function image_qrcode($data, $type="TXT", $size=50, $ec='L', $margin=1){
  $types = array("URL" => "http://", "TEL" => "TEL:", "TXT"=>"", "EMAIL" => "MAILTO:");
  if(!in_array($type,array("URL", "TEL", "TXT", "EMAIL"))){
    $type = "TXT";
  }
  if(!preg_match('/^'.$types[$type].'/', $data)){
    $data = str_replace("\\", "", $types[$type]).$data;
  }
  $url1 = 'http://chart.apis.google.com/chart';
  $url2 = 'chs='.$size.'x'.$size.'&cht=qr&chld='.$ec.'|'.$margin.'&chl='.$data;
  if(!headers_sent()){
	  $ch = curl_init();
	  $data = urlencode($data);
	  curl_setopt($ch, CURLOPT_URL, $url1);
	  curl_setopt($ch, CURLOPT_POST, true);
	  curl_setopt($ch, CURLOPT_POSTFIELDS, $url2);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  curl_setopt($ch, CURLOPT_HEADER, false);
	  curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	  $return = curl_exec($ch);
	  curl_close($ch);
  }else{
	  $return = '<img src="'.$url1.'?'.$url2.'" />';
  }
  return $return;
}
