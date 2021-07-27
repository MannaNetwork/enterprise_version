<?php

//no sign where this func is used here or in index.php
function debit_testnet ($user_id, $debit_amount){
if($user_id =="" OR $debit_amount =="")
{
echo "Procedure cancelled - missing field or input - user id = $user_id, debit_amount = $debit_amount ";
exit();
}
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".WRITER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

$get_info = new price_slot_info;


$query = "Select `amount_testcoin` from `BungeeBank_balance` where `BB_user_ID`= '$user_id'";
$result = mysqli_query($connect, $query)or die("<p align='left'>Bold query1 "); 

$balance_array = $get_info->getBuyersBungeeBankBalance($user_id);
//now returns return array($testcoin_cash, $amount_btc);
$ttc_bal = $balance_array[0];
$btc_bal = $balance_array[1];

$new_ttc_bal = $ttc_bal - $debit_amount;
$sql="UPDATE `BungeeBank_balance` set `amount_testcoin` = '$new_ttc_bal' where `BB_user_ID`= '$user_id'";
$result = mysqli_query($connect, $sql) ;
// now update day logs balance

$sql = "SELECT `id`, `balance` , `tn_balance`
FROM `price_slot_day_ledger`
WHERE `user_id` = '$user_id'
ORDER BY `id` DESC
LIMIT 1 ";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Deposite Account 45' query");
$num_rows = mysqli_num_rows($result);
if($num_rows>0){
while ($row = mysqli_fetch_array($result)) 
 {
 $ttc_balance = $row['tn_balance'];
$btc_balance = $row['balance'];
}}
else
{
$day_ledger_balance = 0;
}
$new_ttc_balance = $ttc_balance - $debit_amount;

$sql="insert into `price_slot_day_ledger` (`user_id`, `balance`,`tn_balance`, `deposit`, `deposit_id`, `trans_type`) values ('$user_id', '$btc_balance', '$new_ttc_balance', '$credit_amount', '99999', 'member_transfer')";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Deposite Account 54' query");
//exit();
}

function credit_testnet ($user_id, $credit_amount){
if($user_id =="" OR $credit_amount =="")
{
echo "Procedure cancelled - missing field or input - user id = $user_id, credit_amount = $credit_amount ";
exit();
}
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".WRITER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

$get_info = new price_slot_info;
$query = "Select `amount_testcoin` from `BungeeBank_balance` where `BB_user_ID`= '$user_id'";
$result = mysqli_query($connect, $query)or die("<p align='left'>Bold query1 "); 
$num_rows = mysqli_num_rows($result);
If($num_rows>0){
$balance_array = $get_info->getBuyersBungeeBankBalance($user_id);
//now returns return array($testcoin_cash, $amount_btc);
$ttc_bal = $balance_array[0];
$btc_bal = $balance_array[1];

$new_ttc_bal = $ttc_bal +1;
$sql="UPDATE `BungeeBank_balance` set `amount_testcoin` = '$new_ttc_bal' where `BB_user_ID`= '$user_id'";
$result = mysqli_query($connect, $sql) ;
// now update day logs balance
}
else//create an account
{
$sql="insert into `BungeeBank_balance` (`BB_user_ID`,  `amount_testcoin`)values ('$user_id', '$credit_amount')";

$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Deposite Account 36' query");
}

$sql = "SELECT `id` , `tn_balance`
FROM `price_slot_day_ledger`
WHERE `user_id` = '$user_id'
ORDER BY `id` DESC
LIMIT 1 ";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Deposite Account 45' query");
$num_rows = mysqli_num_rows($result);
if($num_rows>0){
while ($row = mysqli_fetch_array($result)) 
 {
 $day_ledger_balance = $row['tn_balance'];
}}
else
{
$day_ledger_balance = 0;
}
$new_balance = $day_ledger_balance + $credit_amount;

$sql="insert into `price_slot_day_ledger` (`user_id`, `tn_balance`, `deposit`, `deposit_id`, `trans_type`) values ('$user_id', '$new_balance', '$credit_amount', '99999', 'voucher')";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Deposite Account 54' query");
//exit();
}

?>
