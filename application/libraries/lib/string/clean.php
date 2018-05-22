<?php

/*
	@abstract Clean string of HTML Tags and XSS
	@example  string_clean('&lt;scr&lt;script>....&lt;/script>ipt>alert(\"XSS\");&lt;/script>')
	@param    string|array $html
	@return   string $text
	@link     http://php.net/manual/en/function.strip-tags.php
	@todo     -
	@version  3.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo string_clean('<scr<script>....</script>ipt>alert(\"XSS\");</script>');

function string_clean($string){
  if (is_array($string)){
    foreach ($string as $key => $val){
      $return[$key] = string_clean($val);
    }
  }else{
    $return = (string) $string;
    if (get_magic_quotes_gpc()){
      $return = stripslashes($return);
    }
    $return = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $return);
    $return = preg_replace('#<style(.*?)>(.*?)</style>#is', '', $return);
    $return = preg_replace('#<noscript>(.*?)</noscript>#is', '', $return);
    $return = strip_tags($return);
    $return = htmlentities($return, ENT_QUOTES, 'UTF-8');
  }
  return $return;
}
