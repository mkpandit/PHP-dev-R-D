<?php
/**
* Defining filtered (based on country selection) city list method
* returns filtered city list as HTML
*/
function city_list(){
	global $wpdb;
	$table_name = $wpdb->prefix. 'city_list';
	$selectedCountryName = $_POST['countryName'];
	$selectedCountryId = intval ($_POST['countryId']);
	$cities = $wpdb->get_results("SELECT id, name_ascii FROM $table_name WHERE country_id = " . $selectedCountryId);
	
	if ($wpdb->num_rows > 0) {
		$cityList = "<h3>Cities available in ".$selectedCountryName."</h3>";
		$cityList = $cityList . "<p>" .$wpdb->num_rows . " item(s) found</p>";
		foreach ($cities as $city ) {
			$cityList = $cityList . "<p class='city-name'>" . $city->name_ascii . "</p>";
		}
	} else {
		$cityList = "<h3>No cities listed for ".$selectedCountryName."</h3>";
	}
	echo $cityList;
	wp_die();
}