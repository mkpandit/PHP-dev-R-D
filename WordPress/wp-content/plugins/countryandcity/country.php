<?php
/**
* Defining country list method
* retuns country list as select drop-down
*/
function countryList() { 
	global $wpdb;
	$table_name = $wpdb->prefix. 'country_list';
	$countries = $wpdb->get_results("SELECT id, name, code2 FROM $table_name");
	
	foreach($countries as $country) {
		$countryList = $countryList . "<option value='".$country->id. "*". $country->name . " (" . $country->code2 . ")". "'>" . $country->name . " (" . $country->code2 . ") " . "</option>";
	}
?>
<div class="wrap country-list-container">
	<div class="country-list">
		<label for="country"> Select a country </lable>
		<select name="countryID" id="country">
			<option value=""> -- </option>
			<?php echo $countryList; ?>
		</select>
	</div>
</div>

<div class="wrap city-list-container">
	<div class="city-list">
		
	</div>
</div>
<?php
}