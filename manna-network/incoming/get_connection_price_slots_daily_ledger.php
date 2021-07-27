<?php
//grab the last entry from log and return hash of timestamp
if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/agent_cfg.php");
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/exchange_creds.php");

include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/mysqli_connect.php");

$sql = "SELECT * FROM price_slots_daily_ledger ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
while($row = mysqli_fetch_array($result)){
$this_last_url = $row['url'];
}

$link_hash_url = rtrim($this_last_url, "/ \t\n\r");
$conacat = $link_hash_url.$exchange_pw;
$link_hash_key = hash('sha512', $conacat);
if($_POST['link_hash_key'] == $link_hash_key){
echo $link_hash_key;
}
?>
