<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>Execute a Python Script from PHP - Read and parse a JSON file</title>
</head>

<body>
	<header>
		<h1>Execute a Python Script from PHP - Read and parse a JSON file</h1>
	</header>
	<?php
		$command = shell_exec('python parseJSON.py');
		$response = json_decode($command, true);
		if(count($response) > 1) {
			$count = 1;
			foreach($response as $res) {
				echo "# " .$count . "<br />";
				if(is_array($res)){
					foreach($res as $k => $v) {
						echo $k . ": " . $v . "<br />";
					}
				} else {
					echo $res;
				}
				$count++;
			}
		} else {
			echo $response;
		}
	?>
</body>
</html>