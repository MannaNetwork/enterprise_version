<?php
//grab the last entry from log and return hash of timestamp
//echo '<br><dirname( __FILE__, 3 ) = ', dirname( __FILE__, 3 );
//echo 'filename = /manna-configs/db_cfg/agent_cfg.php'; 
if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/agent_cfg.php");
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/exchange_creds.php");

include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");

//echo 'servername = ', $servername, $username, $password, $dbname;
$pw_hash_key = hash('sha512', $exchange_pw);
if($_POST['pw_hash_key'] == $pw_hash_key){
$sql = "SELECT * FROM links ORDER BY `id`";
//echo 'in orlando ', $sql;
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
while($row = mysqli_fetch_array($result)){
$id[] = $row['id'];
$bridge_id[] = $row['customer_id'];
$url[] = $row['url'];
$name[] = $row['name'];
$description[] = $row['description'];
$start_date[] = $row['start_date'];
$nofollow[] = $row['nofollow'];
$location_id[] = $row['location_id'];
$category[] = $row['category'];
$website_street[] = $row['website_street'];
$website_district[] = $row['website_district'];
$price_slot[] = $row['price_slot'];
}


echo implode(",", $id);
echo "|";
echo implode(",", $url);
}
