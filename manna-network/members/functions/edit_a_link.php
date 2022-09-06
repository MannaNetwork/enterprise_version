<?php

function editCustomerLink($remote_link_id, $website_title, $website_description, $protocol,$website_url, $page_name, $category_id,    $location_id, $website_street, $map_link, $catkeys, $lockeys, $installer_id){
echo '<h1>in func editCustomerLink</h1>';
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

if(empty($location_id)){
$location_id = "NULL";//this is the only "optional integer received from the form and if empty, it results in an error in the query. This converts it to NULL and then it works
}

//first, make sure this link is still in the database-
$sql = "SELECT * FROM customer_links WHERE id=?"; // SQL with parameters
//echo $sql.$remote_link_id;
$stmt = $mysqli->prepare($sql); 
$stmt->bind_param("i", $remote_link_id);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result
$row_cnt = $result->num_rows;

if($row_cnt ==1){
echo '<h1>Found the link in customer_links</h1>';
echo '<br>$row_cnt = ', $row_cnt;
$link_info = $result->fetch_assoc(); // fetch data   
$stmt = $mysqli->prepare("UPDATE `customer_links` SET `website_title`=?,`website_description`=?,`protocol`=?,`website_url`=?,`category_id`=?,`location_id`=?,`website_street`=?,`page_name`=?,`map_link`=?,`catkeys`=?,`lockeys`=?,`installer_id` =? WHERE id=?");
$stmt->bind_param("ssssiisssssii", $website_title,$website_description,$protocol,$website_url,$category_id,$location_id,$website_street,$page_name,$map_link,$catkeys,$lockeys, $installer_id, $remote_link_id ); 
$stmt->execute();
$affected_rows = mysqli_affected_rows($mysqli);
echo '<br>$affected rows = ',  $affected_rows;
}
elseif($row_cnt >1){
return '<h2 style="color:red;"> Error - there is more than one entry for this link id</h2>';
}
else
{
return '<h2 style="color:red;"> Error - No entry for this link id</h2>';
}
}


?>
