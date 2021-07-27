<?php
//grab the last entry from log and return hash of timestamp
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/agent_cfg.php");
if(!defined('WRITER_CUSTOMERS')){ 
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/".WRITER_CUSTOMERS);
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/mysqli_connect.php");

/* gets the following post vars via curl
   "id" => $id, 
		"promo_title" => $promo_title, 
		"promo_description" => $promo_description, 
		"promo_title" => $promo_title, 
		"coin_type" => $coin_type, 
		"promo_amount" => $promo_amount, 
		"promo_title_hash_key" =>$promo_title_hash_key
*/

//get the last inserted local link

$sql = "SELECT * FROM promo_codes ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
while($row = mysqli_fetch_array($result)){
$this_last_title = $row['promo_title'];
}

$link_hash_title = rtrim($this_last_title, "/ \t\n\r");
$conacat = $link_hash_title.$exchange_pw;
$promo_title_hash_key = hash('sha512', $conacat);

if($_POST['promo_title_hash_key'] == $promo_title_hash_key){
	$promo_title = $_POST['promo_title']; 
$promo_description = $_POST['promo_description']; 
$promo_title = $_POST['promo_title']; 
$coin_type = $_POST['coin_type']; 
$promo_amount = $_POST['promo_amount'];
	
	$query = "INSERT INTO `promo_codes` (`promo_title`, `promo_description`, `coin_type`, `promo_amount`) VALUES ('".$_POST['promo_title']."', '".$_POST['promo_description']."', '".$_POST['coin_type']."', '".$_POST['promo_amount']."'  )  "; 
	$result = mysqli_query($mysqli, $query);
	
$sql = "SELECT  * FROM promo_codes ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
while($row = mysqli_fetch_array($result)){
$new_last_title = $row['promo_title'];
}
echo  $new_last_title;
}

