<?php
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	function n_digit_random($digits) {
		return rand(pow(10, $digits - 1) - 1, pow(10, $digits) - 1);
	}
	
	$varArray = array();
	for ($i = 0; $i < 10; $i++) {
		$randomToken = generateRandomString();
		$canadianPrice = n_digit_random(3);
		$usPrice = $canadianPrice * 1.25;
		$varArray[] = array('id' => ($i+1), 'randomToken' => $randomToken, 'canadianPrice' => $canadianPrice, 'usPrice' => $usPrice);
	}
	echo json_encode($varArray);
	echo "<br />";
	function roundNumber($bytes, $precision = 2) {
		$gigabyte = 1024;
		$terabyte = $gigabyte * 1024;
		if (($bytes >= 0) && ($bytes < $gigabyte)) {
			return $bytes . ' GB';
		} elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
			return round($bytes / $gigabyte, $precision) . ' TB';
		} else {
			return $bytes . ' B';
		}
	}
	echo roundNumber(11255);
?>