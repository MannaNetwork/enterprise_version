<?php 

if(!defined('WRITER_CUSTOMERS')){ 
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/agent_cfg.php");
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/exchange_creds.php");

include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/".WRITER_CUSTOMERS);
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/mysqli_connect.php");

$sql = "SELECT * FROM balance ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
while($row = mysqli_fetch_array($result)){
$this_last_amount_DMC = $row['amount_DMC'];
}

$hash_amount_DMC = rtrim($this_last_amount_DMC, "/ \t\n\r");
$conacat = $hash_amount_DMC.$exchange_pw;
$amount_DMC_hash_key = hash('sha512', $conacat);

echo '<br> $this_last_amount_DMC = ',$this_last_amount_DMC;
echo '<br> $amount_DMC_hash_key; = ', $amount_DMC_hash_key;
echo '<br> $_POST[balance_DMC_hash_key] ; = ', $_POST['balance_DMC_hash_key'] ;
if($_POST['balance_DMC_hash_key'] == $amount_DMC_hash_key){

//insert the POST data into balance table

$sql = "SELECT * FROM balance WHERE `user_id` =".$_POST['remote_user_id'];
echo '<br>', $sql;
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
while($row = mysqli_fetch_array($result)){
$current_amount_DMC = $row['amount_DMC'];
}

$NEW_amount_DMC = $_POST['promo_credit'] + $current_amount_DMC;

$sql = "UPDATE balance SET `amount_DMC` = '".$NEW_amount_DMC."' WHERE `user_id` =".$_POST['remote_user_id'];
echo '<br>', $sql;
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");

}
 
