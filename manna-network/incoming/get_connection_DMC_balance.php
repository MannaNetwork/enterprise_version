<?php
//grab the last entry from log and return hash of timestamp
if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/agent_cfg.php");
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/exchange_creds.php");

include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/mysqli_connect.php");

$sql = "SELECT * FROM balance ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
while($row = mysqli_fetch_array($result)){
$this_last_amount_DMC = $row['amount_DMC'];
}

$hash_amount_DMC = rtrim($this_last_amount_DMC, "/ \t\n\r");
$conacat = $hash_amount_DMC.$exchange_pw;
$amount_DMC_hash_key = hash('sha512', $conacat);
if($_POST['amount_DMC_hash_key'] == $amount_DMC_hash_key){
echo $amount_DMC_hash_key;
}
?>
