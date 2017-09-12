<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<title>jQuery DataTable</title>
</head>

<body>
	<header>
		<h1>DataTable Ajax Cell value update</h1>
	</header>
	<div class="table-wrapper">
	<?php
	
	$tableHeader = array("ID", "Exchange Rate", "CAD", "Exchanged Value");
	$countryList = array("AUD", "BGN", "BRL","CHF", "CNY", "CZK", "DKK", "GBP", "HKD", "HRK", "HUF", "IDR", "ILS", "INR", "JPY", "KRW", "MXN", "MYR", "NOK", "NZD", "PHP", "PLN", "RON", "RUB", "SEK", "SGD", "THB", "TRY", "USD", "ZAR", "EUR");
	
	$table = '<table class="display" id="random-value-table" cellspacing="0"><thead><tr>';
	foreach ($tableHeader as $head) {
		$table .= '<th>'.$head.'</th>';
	}
	$table .= '</tr></thead><tbody>';
	for ($i = 0; $i < count($countryList); $i++) {
		$table .= '<tr id="row-' . $i . '">';
		$table .= '<td>' . ($i + 1) . '</td>';
		$table .= '<td>&nbsp;</td>';
		$table .= '<td>&nbsp;</td>';
		$table .= '<td>'.$countryList[$i].'</td>';
		$table .= '</tr>';
	}
	$table .= '</tbody></table>';
	echo $table;
	?>
</div>
<script>
	$(document).ready(function() {
		$('#random-value-table').DataTable();
	});
	
	function updateExchangeRate(){
		$.ajax({
		  url: 'ajaxdata.php',
		})
		.done(function(d) {
			var exchangeRates = jQuery.parseJSON(d);
			var table = $('#random-value-table').DataTable();
			table.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
				var data = this.data();
				var temp = data[3].split(" ");
				if (temp.length > 1) {
					var countryCode = temp[temp.length - 1];
				} else {
					var countryCode = data[3];
				}
				var rate = parseFloat (exchangeRates['rates'][countryCode]);
				data[1] = rate
				data[2] = 1;
				data[3] = rate.toString() + " " + countryCode;
				this.data(data).draw();
			} );
		})
		.fail(function() {
			alert("Failed to load");
		});
	}
	setInterval(updateExchangeRate, 5000);
</script>
</body>
</html>