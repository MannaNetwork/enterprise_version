<?php
include($_SERVER['DOCUMENT_ROOT']."/classes/deposit_bitcoin_from_gourl_class.php");

$deposit_bitcoin = new deposit_bitcoin_from_gourl;
$user_id = 2;
$deposit_amount = 7.555;
$txn = 1234556;
$this_users_btc_balance = $deposit_bitcoin->getUsersBungeeBankBalance($user_id);

echo '<br>$this_users_btc_balance = ';
print_r( $this_users_btc_balance );

$deposit_bitcoin->credit_deposit ($user_id, $deposit_amount, $txn);
$this_users_btc_balance = $deposit_bitcoin->getUsersBungeeBankBalance($user_id);
echo '<br>$this_users_NEW btc_balance = ';
print_r( $this_users_btc_balance );

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql = "SELECT `id` , `balance` , `tn_balance`
FROM `price_slot_day_ledger`
WHERE `user_id` = $user_id
ORDER BY `id` DESC
LIMIT 1 ";
echo $sql;
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Deposite Account 362' query");
while ($row = mysqli_fetch_array($result)) 
 {

 $day_ledger_balance_btc = $row['balance'];
 $day_ledger_balance_tn = $row['tn_balance'];
}

echo '$new_balance_btc = ', $day_ledger_balance_btc;


