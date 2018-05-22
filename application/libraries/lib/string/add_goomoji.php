<?php

/*
	@abstract Generate 15 Google Mail animatet Emoji (goomoji)
	@example  string_add_goomoji(':g: :smily: :rocket: :heart: :bulb: :bomb: :stars: :star:')
	@param    string $string
	@return   string (e.g. 󾺠󾌸󾔮󾟭󾬊󾬋󾬑󾭖󾭘󾭠󾭡󾭨󾭠 - send this to gmail in subject and body)
	@link     http://shkspr.mobi/blog/2015/05/how-gmail-lets-spammers-grab-your-attention-with-emoji/
	@todo     Learn More: http://www.emoji-cheat-sheet.com/
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))
	echo string_add_goomoji(':g: :smily: :rocket: :heart: :bulb: :bomb: :stars: :star:');

function string_add_goomoji($string){
  if(mb_detect_encoding(file_get_contents(__FILE__))!= 'UTF-8'){
    die("<pre>\n\n\n\t<b>ERROR</b> ".basename(__FILE__)." is not UTF-8 Encodet!");
  }
  $return = '';
  $return = str_replace(':g:',           '󾺠', $string); // no ani. but fun ;)
  $return = str_replace(':smily:',       '󾌸', $return);
  $return = str_replace(':smily2:',      '󾍉', $return);
  $return = str_replace(':smily3:',      '󾍠', $return);
  $return = str_replace(':smilys:',      '󾍝', $return);
  $return = str_replace(':mail:',        '󾔮', $return);
  $return = str_replace(':rocket:',      '󾟭', $return);
  $return = str_replace(':question:',    '󾬊', $return);
  $return = str_replace(':exclamation:', '󾬋', $return);
  $return = str_replace(':heart:',       '󾬑', $return);
  $return = str_replace(':bulb:',        '󾭖', $return);
  $return = str_replace(':bomb:',        '󾭘', $return);
  $return = str_replace(':stars:',       '󾭠', $return);
  $return = str_replace(':stars2:',      '󾭡', $return);
  $return = str_replace(':star:',        '󾭨', $return);
  $return = str_replace(':star2:',       '󾭩', $return);
  $return = str_replace(':crab:',        '󾇣', $return);
  return $return;
}
