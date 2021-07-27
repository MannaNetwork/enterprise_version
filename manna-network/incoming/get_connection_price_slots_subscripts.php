<?php
//grab the last entry from log and return hash of timestamp
if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/agent_cfg.php");
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/exchange_creds.php");

include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/mysqli_connect.php");

$sql = "SELECT * FROM price_slots_subscripts ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
while($row = mysqli_fetch_array($result)){
$this_last_price_slot_amnt = $row['price_slot_amnt'];
}

$price_slot_amnt_hash = rtrim($this_last_price_slot_amnt, "/ \t\n\r");
$conacat = $price_slot_amnt_hash.$exchange_pw;
$price_slot_amnt_hash_key = hash('sha512', $conacat);

if($_POST['price_slot_amnt_hash_key'] == $price_slot_amnt_hash_key){
echo $price_slot_amnt_hash_key;
}
?>
