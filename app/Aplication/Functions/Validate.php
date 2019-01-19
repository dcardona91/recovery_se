<?php
namespace ThisApp\Aplication\Functions;
/**
 * 
 */
class Validate
{	
	public static function aditional_details($required, $sended, &$state){
		
	}

	public static function query_string($required, $sended, &$state){
		$sended_keys = array_keys($sended);
		foreach ($required as $key => $asked) {
			$curr = $asked['name'];
			if (!in_array($curr , $sended_keys)){
				$state =  "Missing var: '".$curr."'";
				return false;
			}
			if ($asked['null'] === false && $sended[$curr] == ''){
				$state =  "Wrong value for var '".$curr."', var sended without any value.";
				return false;
			}
				//numeric tratment        
			if (isset($asked['is_numeric']) && $asked['is_numeric'] === true) {
				//validate that is actually a number
				if (!is_numeric($sended[$curr])){
					$state =  "Wrong var type for '".$curr."', not a number.";
					return false;
				}else{
					if (strpos($sended[$curr], ".") === false)
						$sended[$curr] = intval($sended[$curr]);
					else
						$sended[$curr] = doubleval($sended[$curr]);
				}
				//if required, validate that is the right type of number
				if (isset($asked['type']) &&  $asked['type'] != gettype($sended[$curr])){
					$state =  "Wrong type for var '".$curr."', ".gettype($sended[$curr])." passed, ".$asked['type']." expected.";
					return false;
				}
				//if required, validate that is less or equal to the max
				if (isset($asked['max']) &&  $sended[$curr] > $asked['max']){
					$state =  "Wrong value for var '".$curr."', can't be greater than ".$asked['max'].".";
					return false;
				}
				//if required, validate that is more or equal to the min
				if (isset($asked['min']) && $sended[$curr] < $asked['min']){
					$state =  "Wrong value for var '".$curr."', can't be lower than ".$asked['min'].".";
					return false;
				}
				//if required, validate that is more or equal to the min
			}else{
				//string treatment
				//if required, check for the lenght
				if (isset($asked['len']) &&  strlen($sended[$curr]) > $asked['len']){
					$state =  "Wrong value for var '".$curr."', can't have more than ".$asked['len']." characters.";
					return false;
				}
			}
		}
		return true;
		/*
		$sended_keys = array_keys($sended);
		foreach ($required as $key => $asked_key) {
		if (!in_array($asked_key, $sended_keys))
		return  Response::json(array('error' => "Missing var: '".$asked_key."'";
		}
		*/
	}
}