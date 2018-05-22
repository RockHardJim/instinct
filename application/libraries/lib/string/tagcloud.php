<?php

/*
	@abstract Generate TagCloude of a given (Keyword => Counter) Array
	@example  string_tagcloud(array('Design'=>8,'PHP'=>44,'Templates'=>30))
	@param    array $tags
	@param    string $link_target [default='http://www.google.com/search?q=']
	@param    int $minFontSize [default=12]
	@param    int $maxFontSize [default=30]
	@return   string $html
	@link     https://en.wikipedia.org/wiki/Tag_cloud
	@todo     -
	@version  3.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo string_tagcloud(array('Design'=>8,'PHP'=>44,'Templates'=>30));

function string_tagcloud($tags=array(), $target='http://www.google.com/search?q=', $minFontSize=12, $maxFontSize=30 ){
  $minimumCount = min( array_values( $tags ) );
  $maximumCount = max( array_values( $tags ) );
  $spread       = $maximumCount - $minimumCount;
  $spread == 0 && $spread = 1;
  $cloudTags    = array();
  foreach( $tags as $tag => $count ){
    $size = $minFontSize + ($count - $minimumCount) * ($maxFontSize - $minFontSize) / $spread;
    $cloudTags[] = '<a style="font-size:'.floor($size).
    'px" class="tag" href="'.$target.$tag.'" title="'.$count.'">'
    .htmlspecialchars(stripslashes($tag)).'</a> ';
  }
  return join($cloudTags);
}
