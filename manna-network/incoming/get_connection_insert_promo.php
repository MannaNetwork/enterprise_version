<?php
//grab the last entry from log and return hash of timestamp
if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/agent_cfg.php");
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/exchange_creds.php");

include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/mysqli_connect.php");

$sql = "SELECT * FROM promo_codes ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
while($row = mysqli_fetch_array($result)){
$this_last_title = $row['promo_title'];
}
$promo_last_title = rtrim($this_last_title, "/ \t\n\r");
$conacat = $promo_last_title.$exchange_pw;
$promo_title_hash_key = hash('sha512', $conacat);

if($_POST['promo_title_hash_key'] == $promo_title_hash_key){
echo  $promo_title_hash_key;
}
