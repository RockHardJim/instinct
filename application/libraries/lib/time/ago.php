<?php

/*
	@abstract How long ago (minutes, hours, days, weeks or years ago) is the given timestamp
	@example  time_ago(1458390133)
	@param    int $timestamp
	@return   string
	@link     http://www.onlineconversion.com/unix_time.htm
	@todo     Multilingual?
	@version  1.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo time_ago(1458390133);

function time_ago($time_ago){
  $cur_time     = time();
  $time_elapsed = $cur_time - $time_ago;
  $seconds      = $time_elapsed ;
  $minutes      = round($time_elapsed / 60 );
  $hours        = round($time_elapsed / 3600);
  $days         = round($time_elapsed / 86400 );
  $weeks        = round($time_elapsed / 604800);
  $months       = round($time_elapsed / 2600640 );
  $years        = round($time_elapsed / 31207680 );
  if($seconds  <= 60){ # Seconds
    return "just now";
  }else if($minutes <= 60){ # Minutes
    if($minutes == 1){
      return "one minute ago";
    }else{
      return "$minutes minutes ago";
    }
  }else if($hours <= 24){ # Hours
    if($hours == 1){
      return "an hour ago";
    }else{
      return "$hours hrs ago";
    }
  }else if($days <= 7){ # Days
    if($days == 1){
      return "yesterday";
    }else{
      return "$days days ago";
    }
  }else if($weeks <= 4.3){ # Weeks
    if($weeks==1){
      return "a week ago";
    }else{
      return "$weeks weeks ago";
    }
  }else if($months <= 12){ # Months
    if($months == 1){
      return "a month ago";
    }else{
      return "$months months ago";
    }
  }else{ # Years
    if($years == 1){
      return "one year ago";
    }else{
      return "$years years ago";
    }
  }
}
