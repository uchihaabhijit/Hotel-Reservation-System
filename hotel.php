<?php 

class HotelReservation {


	var $weekends = ["sat", "sun"];

	var $hotel = [

		'GreenValley' => [

				'rating' => 3,
				'weekdays' => [
					'regular' => 1100,
					'rewards' => 800,
				],
				'weekends' => [
					'regular' => 900,
					'rewards' => 800,
				],
		],

		'RedRiver' => [

				'rating' => 4,
				'weekdays' => [
					'regular' => 1600,
					'rewards' => 1100,
				],
				'weekends' => [
					'regular' => 600,
					'rewards' => 500,
				],
		],

		'BlueHills' => [

				'rating' => 5,
				'weekdays' => [
					'regular' => 2200,
					'rewards' => 1000,
				],
				'weekends' => [
					'regular' => 1500,
					'rewards' => 400,
				],
		],

	];


	public function cheapestHotel($inputs) {

		$inputs = trim($inputs);

		$cust_type = strtolower(explode(":", $inputs)[0]);
		$range_of_dates = explode(":", $inputs)[1];
		
		$dates = explode("," ,$range_of_dates);

		$sumHArray = array();
		foreach ($this->hotel as $hKey => $HValue) {
			$sumHotel = 0;
			foreach( $dates as $d ) {
				$checkFlag = false;
				foreach( $this->weekends as $w ) {
					if(stripos($d, $w) !== false) {
						$checkFlag = $w;
					}
				}
				if ($checkFlag !=false) {
					$sumHotel += $HValue['weekends'][$cust_type];
				}else{
					$sumHotel += $HValue['weekdays'][$cust_type];
				}
			}
			$sumHArray[$hKey] = $sumHotel;
		}

		$minAmount = min($sumHArray);
		

		/*

		Method 1 to compare similar values if prices match
		$array_comp = [];
		foreach ($sumHArray as $sumHKey => $sumHKval) {
			
			if($sumHKval == $minAmount) {
				$array_comp[$sumHKey] = $this->hotel[$sumHKey]['rating'];
			}

		}

		var_dump(max($array_comp));
		var_dump(array_search(max($array_comp), $array_comp));
		*/


		//Method 2 to compare similar values if prices match
		$array_comp = array_keys($sumHArray, $minAmount);

		$result = array();
		foreach ($array_comp as $key => $value) {
			
			$result[$value] = $this->hotel[$value]['rating'];

		}

		return array_search(max($result), $result);

		
	}


}


$obj = new HotelReservation();

$result = $obj->cheapestHotel("Rewards: 26Mar2009(thur), 27Mar2009(fri),
28Mar2009(sat)");

echo "The cheapest hotel you could find is " . $result;

