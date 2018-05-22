<?php

/*
	@abstract Calculate the distance between two Latitude and Longitude points
	@example  geo_distance(51.8819448,8.5061035,52.1178305,8.6793998,'k', 2)
	@param    float $latitude1 Latitude of start point in [deg decimal]
	@param    float $longitude1 Longitude of start point in [deg decimal]
	@param    float $latitude2 Latitude of target point in [deg decimal]
	@param    float $longitude2 Longitude of target point in [deg decimal]
	@param    string $unit miles, feet, yatds, kilometer, nautical_miles [use first character]
	@param    int $digits counter of decimal places to show [default=0]  
	@return   bool
	@link     http://www.mapcoordinates.net/en
	@link     http://www.movable-type.co.uk/scripts/latlong.html
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo geo_distance(51.8819448,8.5061035,52.1178305,8.6793998,'k',2);

function geo_distance($latitude1, $longitude1, $latitude2, $longitude2, $unit='m', $digits=0) {
  $theta      = $longitude1 - $longitude2;
  $distance1  = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2)));
  $distance2  = (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
  $distance   = $distance1 + $distance2;
  $distance   = acos($distance);
  $distance   = rad2deg($distance);
  if ($unit  == "m") { // miles
      $return = round($distance * 60 * 1.1515, $digits);
  } else if ($unit == "f") { // feet
      $return = round($distance * 60 * 1.1515 * 5280, $digits);
  } else if ($unit == "y") { // yatds
      $return = round($distance * 60 * 1.1515 * 5280 / 3, $digits);
  } else if ($unit == "k") { // kilometer
	  $return = round($distance * 60 * 1.1515 * 1.609344, $digits);
  } else if ($unit == 'n') { // nautical_miles
	  $return = round($distance * 60 * 1.1515 * 0.8684, $digits);
  } else{
	  $return = FALSE;
  }
  return $return;
}
