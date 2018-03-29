/**
* Custom JS for the plugin
*/
(function($) {
	$(document).ready(function() {
		console.log('jQuery enabled');
		$("#country").on("change", function() {
			//alert (this.value);
			var selectedCountry = this.value;
			var selectedCountryId = selectedCountry.split("*")[0];
			var selectedCountryName = selectedCountry.split("*")[1];
			//console.log (selectedCountryName + " - " + selectedCountryId);
			
			var data = {
				'action': 'filter_city',
				'countryName': selectedCountryName,
				'countryId': selectedCountryId
			};
			
			console.log (data);
			
			$.post(ajax_object.ajaxurl, data, function(response) {
				if (response) {
					//console.log(response);
					//alert ( "Got this response from the server" + response );
					$(".city-list-container .city-list").html(response);
					$(".city-list-container").show();
					
				} else {
					console.log("Bad response received");
				}
			});
		});
	});
})(jQuery);