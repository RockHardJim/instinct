<?php

######################################################################################
# adilbo™ Software                                                                   #
#              _   _   _              ____        ___ _                              #
#    __ _  ___| |_| | | |___   ___™  / ___|  ___ / __| |_  _     _  __ _ _ __  ___   #
#   / _` |/ __  | | | |  __ \ / _ \  \___ \ / _ \| _|| __/| | _ | |/ _` | '__|/ __\  #
#  | (_| | (__| | | |_| |__) | (_) |  ___) | (_) | | | |_ | || || | (_| | |  |  _|   #
#   \__,_|\___,_|_|___|_,___/ \___/  |____/ \___/|_|  \__| \_____/ \__,_|_|   \___/  #
#                                                                                    #
# Copyright - 2016 http://adilbo.com - all rights reserved - Alle Rechte vorbehalten #
######################################################################################'

/*
	@abstract Generate Docu for PFC (and two List Types ENVATO- and Count-List)
	@example  PHP manual.php
	@param    ?type=item for ENVATO List
	@param    ?type=list for COUNT List
	@param    ?type=test for TEST List
	@return   Output to Browser
	@link     http://manual.phpdoc.org/HTMLframesConverter/default/
	@link     http://www.php-csl.com/
	@todo     Some CSS Formating
	@version  2.0
*/

/*
	@param int $number
	@param string $description
	@param bool $flagged
	@param array $args
	@param object $account
	@param string|bool $string_or_boolean
	@param string|null $string_or_null
	@return string
*/

  ini_set('memory_limit', '-1');
  set_time_limit(0);
  error_reporting(0);
  if ( !isset($_GET['type']) ) {
    $_GET['type'] = 'docu';
    echo '<meta charset="UTF-8"><tt>';
  }
  if ( $_GET['type'] == 'docu')
    echo '<pre class="brush: php; ruler: true;">';
  $dir = dirname(__FILE__).'/';
  $dh  = opendir($dir);
  $dir_list = array($dir);
  while ( false !== ( $filename = readdir($dh) ) ) {
    if ( $filename[0] != '.' and is_dir($dir.$filename) === TRUE ) {
      array_push( $dir_list, $dir.$filename.'/' );
      #print 'FOLDER '.$dir.$filename.'/'.'<br>'; // ALL FOUND FOLDER
    }
  }
  $comments = array();
  foreach ($dir_list as $dir) {
    #print '<br>DIR  '.$dir.'<br>';
    $headline = FALSE;
    foreach ( glob($dir."*.php") as $filename ) {
      require_once $filename;
      #print 'FILE '.$filename.'<br>';
      $docComments = array_filter( token_get_all( file_get_contents($filename) ), function($entry) {
        return $entry[0] == T_COMMENT;
      });
      $fileDocComment = array_shift($docComments);
      #print_r($fileDocComment[1]); // ALL FOUND COMMENTS
      #$regexp = "/\@.*\:\s.*[\r\n|\r|\n]/";  // @param: text
      $regexp = "/\@.*[\r\n|\r|\n]/";         // @param text
      $regexp2= "/\@example.*[\r\n|\r|\n]/";  // @example text
      $regexp3= "/\@abstract.*[\r\n|\r|\n]/"; // @abstract text
      preg_match_all($regexp, $fileDocComment[1], $matches);
      preg_match_all($regexp2, $fileDocComment[1], $matches2);
      preg_match_all($regexp3, $fileDocComment[1], $matches3);
      $function_testlist[] = $matches2[0];
      if ( count($matches[0]) > 1 ) {
        $name = basename( $filename );
        for ( $i = 0; $i < sizeof( $matches[0] ); $i++ ) {
          $index = basename( $dir ).'_'.str_replace('.php','', $name);
          $index = str_replace('lib_','', $index);
          $abstract[$index] = $matches3[0];
          #print 'INDEX '.$index.'<br>'; // ALL FOUND INDICES
          if ( !isset( $comments[$index] ) and $headline === FALSE ) {
            $comments[$index] = ''.ucfirst( basename( $dir ) )."\n".str_repeat('#',strlen(basename( $dir )))."\n\n";
            $headline = TRUE;
          }elseif( !isset( $comments[$index] ) ) {
            $comments[$index] = '';
          }
          if ( isset( $comments[$index] ) ) {
            #$comments[$index] .= preg_replace('#@(.*?)\s(.*)\n#', "<b>@$1</b> $2\n", $matches[0][$i]);
             $s = preg_replace('#@(.*?)\s(.*)\n#', "$1 $2\n", $matches[0][$i]);
             $s = explode(' ', $s);
             $s[0] = strtoupper($s[0]);
             $comments[$index] .= implode(' ', $s);
          }
        }
        #$comments[$index] = $fileDocComment[1]; // SHOW ALL COMMENTS (DEBUG ONLY)
        if ( $_GET['type'] == 'docu' and isset( $comments[$index]) ) {
          $comments[$index] = trim(str_replace('&lt;', '&amp;lt;', $comments[$index]));
          echo $comments[$index]."\n\n";
        }
      }
    }
  }
  $arr = get_defined_functions();
  natsort( $arr['user'] );
  $i = 0;
  #if ( $_GET['type'] == 'list' ) echo "<h2>Function-List</h2>";
  $style = 'background:white !important;color:#444;text-align:right !important;width:30px !important;display:inline-block;';
  foreach ( $arr['user'] as $value ) {
    $i++;
    $echo = '';
    if ( $_GET['type'] == 'list' and $i==1) {
      $echo .= '<div style="'.$style.'">&nbsp;</div><br>'."\n";
    }elseif ( $_GET['type'] == 'item' and $i==1) {
      echo '<ol>'."\n";
    }
    list( $type_new, $rest ) = explode('_', $value, 2);
    if ( isset($type_old) and $type_new != $type_old ) {
      if ( $_GET['type'] == 'item' ) echo "<br>\n";
      if ( $_GET['type'] == 'list' ) $echo .= '<hr size="1"><div style="'.$style.'">&nbsp;</div><br>'."\n";
    }
    $abstract_text = rtrim(str_replace('@abstract','', $abstract[$value][0]));
    if ( $_GET['type'] == 'item') echo '<li>'.$value.' &mdash; '.htmlentities($abstract_text)."</li>\n";
    if ( $_GET['type'] == 'list') {
      /* Colors for Syntax Highlighting mode.  Anything that's acceptable in
         <span style="color: ???????"> would work.
         text    = black
         bg      = white
         string  = #DD0000 
         comment = #FF9900 ORANGE
         keyword = #007700 
         default = #0000BB 
      */
      $echo .= '<div style="'.$style.'">'.$i.'.</div> ';
      $echo .= '<b style="color:#080">//'.$abstract_text."</b><br>\n";
      $echo .= '<div style="'.$style.'">&nbsp;</div> ';
      $echo .= '<b style="color:blue">function</b> '.$value."<b style=\"color:#6600cc\">()</b><br>\n";
      $echo .= '<div style="'.$style.'">&nbsp;</div><br>'."\n";
      #echo htmlentities($echo);
      echo $echo;
    }
    list($type_old, $rest) = explode('_', $value, 2);
  }

if (isset($_GET['type']) and $_GET['type'] == 'test'){
  unset($function_testlist[0]);
  foreach ( $function_testlist as $test ) {
    $echo = trim(str_replace('@example  ', '', $test[0]));
    $echo = trim(str_replace('&lt;', '&amp;lt;', $echo));
    echo "echo 'hub::".addslashes($echo)." = '.hub::".$echo.'."\n";'."<br>\n";
  }
  echo "\n";
}
echo "</pre>\n";
