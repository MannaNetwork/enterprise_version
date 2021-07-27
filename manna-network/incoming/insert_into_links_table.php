<?php
//grab the last entry from log and return hash of timestamp
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/agent_cfg.php");
if(!defined('WRITER_AGENTS')){ 
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".WRITER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
$searchString = ',';

 if( strpos($_POST['id'], $searchString) !== false ) {
     $results_are_arrays = 1;


 }
else
{
$results_are_arrays = 0;
}

//get the last inserted local link
$sql = "SELECT * FROM links ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
 while($row = mysqli_fetch_assoc($result)){
$last_local_url = $row['url'];
}

if($results_are_arrays == 1) 
{
$id = explode(",",$_POST['id']);
$customer_id = explode(",",$_POST['customer_id']); 
$category = explode(",",$_POST['category']); 
$url = explode(",",$_POST['url']); 
$name = explode(",",$_POST['name']); 
$description = explode(",",$_POST['description']);
$location_id = explode(",",$_POST['location_id']); 
$website_street = explode(",",$_POST['website_street']); 
$start_date = explode(",",$_POST['start_date']); 
$nofollow = explode(",",$_POST['nofollow']); 
$price_slot = explode(",",$_POST['price_slot']);


foreach($id as $key=>$value){
$query = "INSERT INTO `links` (`customer_id`,`url`,`name`,`description`,`start_date`,`nofollow`,`location_id`,`category`,`website_street`) VALUES (    '$customer_id[$key]' ,  '$url[$key]', '$name[$key]', '$description[$key]' , '$start_date[$key]' , '$nofollow[$key]','$location_id[$key]',  '$category[$key]', '$website_street[$key]')  "; 
$result = mysqli_query($mysqli, $query);
$last_insert_url =  $value;
echo  $last_insert_url ;




$query2 = "UPDATE categories SET link_count = link_count + 1 WHERE id = '$category[$key]'";
$result = mysqli_query($mysqli, $query2);

}

} 
else
{
$id = $_POST['id'];
$customer_id = $_POST['customer_id']; 
$category = $_POST['category']; 
$url = $_POST['url']; 
$name = $_POST['name']; 
$description = $_POST['description'];
$location_id = $_POST['location_id']; 
$website_street = $_POST['website_street']; 
$start_date = $_POST['start_date']; 
$nofollow = $_POST['nofollow']; 
$price_slot = $_POST['price_slot']; 
if($customer_id !=""){
	$query = "INSERT INTO `links` (`customer_id`,`url`,`name`,`description`,`start_date`,`nofollow`,`location_id`,`category`,`website_street`,`website_district`) VALUES ( '$customer_id' ,'$url' , '$name' , '$description',  '$start_date' ,  '$nofollow', '$location_id' , '$category', '$website_street', '$website_district'  )  "; 

$result = mysqli_query($mysqli, $query);
$last_insert_url =  $url;
if(mysqli_affected_rows($mysqli) >= 0){
echo$last_insert_url;
}

$query2 = "UPDATE categories SET link_count = link_count + 1 WHERE id = '$category'";
$result = mysqli_query($mysqli, $query2);

}
}


