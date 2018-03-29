<?php

/**
* Plugin Name: Country and City
* Plugin URI: http://github.com/mkpandit
* Description: List of countries and cities
* Version: 1.0.0
* Author: Manish Pandit
* Author URI: http://github.com/mkpandit
*/

/**
* Add a admin page using add_action 
*/
add_action('admin_menu', 'countryAndCityMenu');

function countryAndCityMenu(){
	add_menu_page(
		'List of countries and associate cities', //Page title
		'Country and City', // menu title
		'manage_options', // capabilities
		'country-city-list', //menu slug
		'countryList' //function
	);
}

/**
* Add custom CSS and JavaScript
*/
add_action('admin_enqueue_scripts', 'custom_style_script');

function custom_style_script() {
	wp_register_script('custom-js', plugins_url('static/js/common.js', __FILE__ ), array('jquery') );
	wp_enqueue_script('custom-js');
	
	wp_localize_script( 'custom-js', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	
	wp_register_style('custom-css', plugins_url('static/css/dashboard.css', __FILE__ ) );
	wp_enqueue_style('custom-css');
}

/**
* Create database tables: country list and city list while activating the plugin
*/
global $db_table_version;
$db_table_version = '1.0';

function db_table_install() {
	global $wpdb;
	global $db_table_version;
	
	$country_table_name = $wpdb->prefix . 'country_list';
	$city_table_name = $wpdb->prefix . 'city_list';
	$charset_collate = $wpdb->get_charset_collate();
	
	/**
	* Country table definition
	*/
	$sql_country_table = "CREATE TABLE $country_table_name (
		id int(11) NOT NULL,
		name_ascii varchar(200) NOT NULL,
		slug varchar(50) NOT NULL,
		geoname_id int(11) DEFAULT NULL,
		alternate_names longtext,
		name varchar(200) NOT NULL,
		code2 varchar(2) DEFAULT NULL,
		code3 varchar(3) DEFAULT NULL,
		continent varchar(2) NOT NULL,
		tld varchar(5) NOT NULL,
		phone varchar(20) DEFAULT NULL,
		PRIMARY KEY  (id) ) $charset_collate;";

	/**
	* City table definition
	*/
	$sql_city_table = "CREATE TABLE $city_table_name (
		id int(11) NOT NULL,
		name_ascii varchar(200) NOT NULL,
		slug varchar(50) NOT NULL,
		geoname_id int(11) DEFAULT NULL,
		alternate_names longtext,
		name varchar(200) NOT NULL,
		display_name varchar(200) NOT NULL,
		search_names longtext NOT NULL,
		latitude decimal(8,5) DEFAULT NULL,
		longitude decimal(8,5) DEFAULT NULL,
		region_id int(11) DEFAULT NULL,
		country_id int(11) NOT NULL,
		population bigint(20) DEFAULT NULL,
		feature_code varchar(10) DEFAULT NULL,
		timezone varchar(40) DEFAULT NULL,
		PRIMARY KEY  (id) ) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql_country_table);
		dbDelta($sql_city_table);
		add_option('db_table_version', $db_table_version);
}

register_activation_hook( __FILE__ , 'db_table_install');

/**
* Filter the city list based on selected country
*/
add_action('wp_ajax_filter_city', 'city_list');

define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'country.php');
require_once(ROOTDIR . 'city.php');