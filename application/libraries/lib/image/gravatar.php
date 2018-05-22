<?php

/*
	@abstract Return Image tag from Gravatar.com matching the given eMail Address
	@example  image_gravatar('internmail@gmail.com',true)
	@param    string $email
	@param    bool $ssl [default=false]
	@param    int $size [default=80 for 80x80 image]
	@param    string $default [404=return error,mm=grey mystery man,identicon=geometric pattern,monsterid=monster,wavatar=face avatar,retro=arcade pixel,blank=transparent PNG]
	@param    string $rating [g=save,pg=rude,r=harsh,x=hardcore&extreme]
	@return   string [html image tag]
	@link     https://en.gravatar.com/site/implement/images/
	@todo     -
	@version  3.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo image_gravatar('internmail@gmail.com',true);

function image_gravatar($email, $ssl=false, $size=80, $default='mm', $rating='g'){
  if($ssl==true){$request='https://secure';}else{$request='http://www';}
  return '<img src="'.$request.'.gravatar.com/avatar.php?gravatar_id='.md5($email).
  '&default='.$default.'&size='.$size.'&rating='.$rating.'" width="'.$size.'px" height="'.$size.'px" />';
}
