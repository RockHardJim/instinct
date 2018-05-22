<?php

/*
	@abstract Extract Youtube Previewimage from given Youtube Video Link
	@example  image_youtube('https://www.youtube.com/watch?v=0pXYp72dwl0','a')
	@param    string $youtube_link
	@param    string $type [a or img default=a]
	@return   string HTML anker or image Tag
	@link     https://www.youtube.com/watch?v=j3qnXFN6Or8 
	@todo     Optional: Save Image Local?
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo image_youtube('https://www.youtube.com/watch?v=0pXYp72dwl0','img');

function image_youtube($youtube_link,$type='a'){
  $youtube_page = ' '.file_get_contents($youtube_link);
  $ini = strpos($youtube_page,'itemprop="thumbnailUrl" href="');
  $ini += strlen('itemprop="thumbnailUrl" href="');
  $len = strpos($youtube_page,'">',$ini) - $ini;
  $thumb = substr($youtube_page,$ini,$len);
  $return = "<img src=\"$thumb\" />";
  if($type=='a')$return = "<a href=\"$thumb\">Screenshot</a>";
  return $return;
}
