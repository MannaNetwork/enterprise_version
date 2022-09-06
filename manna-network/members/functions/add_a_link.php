<?php

function insertCustomerLink($user_id, $user_registration_datetime, $website_title, $website_description, $protocol,$website_url, $page_name, $category_id,    $location_id, $website_street, $map_link, $installer_id, $catkeys, $lockeys){
if (!defined('WRITER_AGENTS')) {
include(dirname( __FILE__, 4 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 4 ). "/manna-configs/db_cfg/".WRITER_CUSTOMERS);
include(dirname( __FILE__, 4 ). "/manna-configs/db_cfg/mysqli_connect.php");

$website_title = strip_tags($website_title);
$website_title = htmlspecialchars($website_title, ENT_QUOTES);	
	$website_title = (strlen($website_title) > 40) ? substr($website_title, 0, 40) . '...' : $website_title;
$website_description = strip_tags($website_description);
$website_description = htmlspecialchars($website_description, ENT_QUOTES);
$website_description = (strlen($website_description) > 254) ? substr($website_description, 0, 251) . '...' : $website_description;
$protocol = strip_tags($protocol);
$protocol = htmlspecialchars($protocol, ENT_QUOTES);	
	$protocol = (strlen($protocol) > 8) ? substr($protocol, 0, 8) . '...' : $protocol;
	$website_url = strip_tags($website_url);
$website_url = htmlspecialchars($website_url, ENT_QUOTES);	
	$website_url = (strlen($website_url) > 254) ? substr($website_url, 0, 254) . '...' : $website_url;
	$page_name = strip_tags($page_name);
$page_name = htmlspecialchars($page_name, ENT_QUOTES);	
	$page_name = (strlen($page_name) > 60) ? substr($page_name, 0, 60) . '...' : $page_name;
		$website_street = strip_tags($website_street);
$website_street = htmlspecialchars($website_street, ENT_QUOTES);	
	$website_street = (strlen($website_street) > 80) ? substr($website_street, 0, 80) . '...' : $website_street;
	$map_link = strip_tags($map_link);
$map_link = htmlspecialchars($map_link, ENT_QUOTES);	
	$map_link = (strlen($map_link) > 250) ? substr($map_link, 0, 250) . '...' : $map_link;
	$catkeys = strip_tags($catkeys);
$catkeys = htmlspecialchars($catkeys, ENT_QUOTES);	
	$catkeys = (strlen($catkeys) > 255) ? substr($catkeys, 0, 255) . '...' : $catkeys;
		$lockeys = strip_tags($lockeys);
		$lockeys = htmlspecialchars($lockeys, ENT_QUOTES);	
	$lockeys = (strlen($lockeys) > 255) ? substr($lockeys, 0, 255) . '...' : $lockeys;

$user_registration_datetime =  mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
if(empty($location_id)){
$location_id = "NULL";//this is the only "optional integer received from the form and if empty, it results in an error in the query. This converts it to NULL and then it works
}


$stmt = $mysqli->prepare("INSERT INTO customer_links (user_id, user_registration_datetime, website_title, website_description, protocol, website_url, page_name, category_id, location_id, website_street, map_link, installer_id, catkeys, lockeys) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iisssssiississ", $user_id, $user_registration_datetime, $website_title, $website_description, $protocol,$website_url, $page_name, $category_id, $location_id, $website_street, $map_link, $installer_id, $catkeys, $lockeys); 
$stmt->execute();
return $stmt->insert_id;
/*
uncomment to use this for testing (when prepared statement isn't working) and comment out the prepared statement code
if(empty($location_id)){
$location_id = "NULL";//this is the only "optional integer received from the form and if empty, it results in an error in the query. This converts it to an empty string and then it works
echo '<br>in location id is empty, $location_id now = ', $location_id;
}
$query = "INSERT INTO customer_links (user_id, user_registration_datetime, website_title, website_description, protocol, website_url, page_name, category_id, location_id, website_street, map_link, installer_id, catkeys, lockeys) VALUES($user_id, $user_registration_datetime, '$website_title', '$website_description', '$protocol', '$website_url', '$page_name', $category_id, $location_id, '$website_street', '$map_link', $installer_id, '$catkeys',  '$lockeys' )";
 echo '<br> regular sql = ', $query;
$res = mysqli_query($mysqli, $query);
return mysqli_insert_id($mysqli); */
}


?>
