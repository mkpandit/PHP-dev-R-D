<?php
	$apiUrl = "http://api.fixer.io/latest?base=CAD";
	$jsonData = file_get_contents($apiUrl);
	echo $jsonData;
?>