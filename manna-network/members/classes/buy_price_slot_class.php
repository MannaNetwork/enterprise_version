<?php 
class price_slot_info
{

function getLinkByLinkId($link_id){
//this is used by voucher giver - Even though the admin has entered the user id and that is all that is needed to
//issue a voucher, we want the script to display the user and link info to confirm the issuance is going to the right place
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network.
if(!defined('AGENT_ID')){ 
include(dirname( __FILE__, 4 ). "/manna-network-agent_cfg.php");
}
if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/mysqli_connect.php");

echo '<br>$servername = ', $servername;
		echo '<br>	      $username = ', $username;
		echo '<br>	      $password = ', $password;
		echo '<br>	      $dbname = ', $dbname;
if($link_id >0){
//$query = "SELECT * FROM links WHERE MN_user_id='$user_id' ORDER BY `start_date` ASC";

$query = "SELECT * FROM customer_links WHERE id='$link_id' ";

$result = @mysqli_query($mysqli, $query) or die("Couldn't execute 'Edit 3 Account' query");
$num_rows = mysqli_num_rows($result);
if($num_rows > 0){

while ($row = mysqli_fetch_array($result)){
$id = $row['id'];
$category = $row['category_id'];
$url = $row['website_url'];
$description = $row['website_description'];
$name = $row['website_title'];
$start_date = $row['user_registration_datetime'];
}
/*
| id                         | int(11)      | NO   | PRI | NULL    | auto_increment |
| website_title              | varchar(25)  | YES  |     | NULL    |                |
| website_description        | varchar(225) | YES  |     | NULL    |                |
| website_url                | varchar(60)  | YES  |     | NULL    |                |
| category_id                | int(12)      | YES  |     | NULL    |                |
| newcatsuggestion           | varchar(60)  | YES  |     | NULL    |                |
| location_id                | int(12)      | YES  |     | NULL    |                |
| website_street             | varchar(80)  | YES  |     | NULL    |                |
| website_district           | varchar(60)  | YES  |     | NULL    |                |
| mn_user_id                 | int(14)      | YES  |     | NULL    |                |
| agents_ID                  | int(14)      | YES  |     | NULL    |                |
| agents_lnk_num             | int(14)      | YES  |     | NULL    |                |
| user_registration_datetime | varchar(44)  | YES  |     | NULL    |                |

*/

}
$send_array = array( $id, $category, $url, $description, $name, $start_date);
}
return $send_array;
}


function getLinkByUserIdFree($user_id){
//this is used by voucher giver - Even though the admin has entered the user id and that is all that is needed to
//issue a voucher, we want the script to display the user and link info to confirm the issuance is going to the right place
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network.
if(!defined('AGENT_ID')){ 
include(dirname( __FILE__, 4 ). "/manna-network-agent_cfg.php");
}
if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/mysqli_connect.php");

echo '<br>$servername = ', $servername;
		echo '<br>	      $username = ', $username;
		echo '<br>	      $password = ', $password;
		echo '<br>	      $dbname = ', $dbname;
if($user_id >0){
//$query = "SELECT * FROM links WHERE MN_user_id='$user_id' ORDER BY `start_date` ASC";

$query = "SELECT * FROM customer_links WHERE MN_user_id='$user_id'  ORDER BY `user_registration_datetime` ASC";
echo $query;
$result = @mysqli_query($mysqli, $query) or die("Couldn't execute 'Edit 3 Account' query");
$num_rows = mysqli_num_rows($result);
if($num_rows > 0){

while ($row = mysqli_fetch_array($result)){
$db_idf[] = $row['id'];
$db_categoryf[] = $row['category_id'];
$db_urlf[] = $row['website_url'];
$db_descriptionf[] = $row['website_description'];
$db_namef[] = $row['website_title'];
$db_start_datef[] = $row['user_registration_datetime'];
//$db_approvedf[] = $row['approved']; 
}
/*
| id                         | int(11)      | NO   | PRI | NULL    | auto_increment |
| website_title              | varchar(25)  | YES  |     | NULL    |                |
| website_description        | varchar(225) | YES  |     | NULL    |                |
| website_url                | varchar(60)  | YES  |     | NULL    |                |
| category_id                | int(12)      | YES  |     | NULL    |                |
| newcatsuggestion           | varchar(60)  | YES  |     | NULL    |                |
| location_id                | int(12)      | YES  |     | NULL    |                |
| website_street             | varchar(80)  | YES  |     | NULL    |                |
| website_district           | varchar(60)  | YES  |     | NULL    |                |
| mn_user_id                 | int(14)      | YES  |     | NULL    |                |
| agents_ID                  | int(14)      | YES  |     | NULL    |                |
| agents_lnk_num             | int(14)      | YES  |     | NULL    |                |
| user_registration_datetime | varchar(44)  | YES  |     | NULL    |                |

*/
$num_links_this_user = count($db_idf);
}
$send_array = array($num_links_this_user, $db_idf, $db_categoryf, $db_urlf, $db_descriptionf, $db_namef, $db_start_datef);
}
return $send_array;
}



// start new cryptobox funcs
// start new cryptobox funcs
// start new cryptobox funcs
function getNumRowsPaid($cat_id, $link_id){
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
if($cat_id != 1024){
$query = "SELECT *
FROM `price_slots_subscripts`
WHERE `cat_id` = '".$cat_id."'
AND `subscribe` = 2 ORDER by price_slot_amnt DESC, t_timestamp ASC";
$result = @mysqli_query($connect, $query) or die("Couldn't execute 'getThisLinksPaidRank' query");
$num_rows_non_free = mysqli_num_rows(mysqli_query($connect, $query));
return $num_rows_paid;
}
else
{
return 0;
}
}

function updateCryptoBoxInfo($user_id, $paymentID){ //set procdbyBB to one and enter date in procbyBB_date to flag it has been credited procdbyBB 	procbyBB_date  Full texts 	paymentID 	boxID 	boxType 	orderID 	userID 	countryID 	coinLabel 	amount 	amountUSD 	unrecognised 	addr 	txID 	txDate 	txConfirmed 	txCheckDate 	processed 	processedDate 	recordCreated 	procdbyBB 	procbyBB_date 
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
date_default_timezone_set('America/New_York');

$now = date('Y-m-d H:i:s');// the latest cancellation today that could affect yesterday when the cron runs after 1 a.m. is 1 a.ma

$sql = "UPDATE `crypto_payments` set `procdbybb` = 1, `procbyBB_date`= '$now' WHERE `userID` = '$user_id' AND `paymentID` = '$paymentID'";
//echo $sql;
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Deposite Account 362' query");
}


function getCryptoBoxInfo($user_id){
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
date_default_timezone_set('America/New_York');

$now = date('Y-m-d H:i:s');// the latest cancellation today that could affect yesterday when the cron runs after 1 a.m. is 1 a.ma

$sql = "SELECT `paymentID` , `boxID` , `boxType` , `orderID` , `userID` , `countryID` , `coinLabel` , `amount` , `unrecognised` , `addr` , `txID` , `txDate` , `txConfirmed` , `txCheckDate` , `processed` , `processedDate` , `recordCreated` FROM `crypto_payments` WHERE `userID` = '$user_id' AND `procdbyBB` != 1 ORDER BY `paymentID` DESC";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Deposite Account 362' query");
$num_rows = mysqli_num_rows($result);

If($num_rows < 1 )
{
return "no_records";
}
elseif($num_rows == 1 ){
	while ($row = mysqli_fetch_array($result)) 
	 {
	$paymentID = $row['paymentID'];
	$boxID = $row['boxID'];
	$boxType = $row['boxType'];
	$orderID = $row['orderID'];
	$userID = $row['userID'];
	$countryID = $row['countryID'];
	$coinLabel = $row['coinLabel'];
	$amount = $row['amount'];
	$unrecognised = $row['unrecognised'];
	$addr = $row['addr'];
	$txID = $row['txID'];
	$txDate = $row['txDate'];
	$txConfirmed = $row['txConfirmed'];
	$txCheckDate = $row['txCheckDate'];
	$processed = $row['processed'];
	$processedDate = $row['processedDate'];
	$recordCreated = $row['recordCreated'];
	}
$return_array = array($paymentID,$boxID,$boxType,$orderID,$userID,$countryID,$coinLabel,$amount,$unrecognised,$addr,$txID,$txDate,$txConfirmed,$txCheckDate,$processed,$processedDate,$recordCreated); 
return $return_array;
}
else //if($num_rows > 1 )
{// load it as arrays

	while ($row = mysqli_fetch_array($result)) 
	 {
	$paymentID[] = $row['paymentID'];
	$boxID[] = $row['boxID'];
	$boxType[] = $row['boxType'];
	$orderID[] = $row['orderID'];
	$userID[] = $row['userID'];
	$countryID[] = $row['countryID'];
	$coinLabel[] = $row['coinLabel'];
	$amount[] = $row['amount'];
	$unrecognised[] = $row['unrecognised'];
	$addr[] = $row['addr'];
	$txID[] = $row['txID'];
	$txDate[] = $row['txDate'];
	$txConfirmed[] = $row['txConfirmed'];
	$txCheckDate[] = $row['txCheckDate'];
	$processed[] = $row['processed'];
	$processedDate[] = $row['processedDate'];
	$recordCreated[] = $row['recordCreated'];
	}
$return_this = array($paymentID,$boxID,$boxType,$orderID,$userID,$countryID,$coinLabel,$amount,$unrecognised,$addr,$txID,$txDate,$txConfirmed,$txCheckDate,$processed,$processedDate,$recordCreated); 

return $return_this;
}
}

// end new cryptobox funcs
// end new cryptobox funcs
// end new cryptobox funcs



function checkRefundTimer($link_id){
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
$sql="SELECT * FROM `price_slots_subscripts` WHERE `link_id` = $link_id AND `subscribe` > 0";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 9b1 Account' query");
while ($row = mysqli_fetch_array($result)) 
 {
 $t_timestamp = $row['t_timestamp'];
}
date_default_timezone_set('America/New_York');
$t_timestamp_unix = strtotime($t_timestamp);
$curtime = time();
if(($curtime-$t_timestamp_unix) < 3600) {
$time_thats_passed = $curtime-$t_timestamp_unix;
$time_left= (3600 - $time_thats_passed)/60;
return round($time_left);
}
else
{
return "expired";
}
}
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



function B1markPriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $link_id, $cat_id, $purchased_slot_amount,$subscribe, $coin_type)
{ 
//B1 only selects, no data insertion here
                         
 if($user_id==""||$user_id==0||$link_id==0||$cat_id==0){
exit();
}
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
if($subscribe > 0){
//2010-10-20 14:06:31 why only a date if subscribing? 
date_default_timezone_set('America/New_York');
$today = date("Y-m-d H:i:s");
}
$get_info = new price_slot_info;
//$price_slot_info_array = $get_info->getBasePrice();
//$price_slot_log_id = $price_slot_info_array[0];//doesn't seem to be used anywhere
if($coin_type =='bitcoin'){
$ftb="balance";
}
else
{
$ftb="tn_balance";
}
//we need their balance to know if they have sufficient funds
$sql = "SELECT `id` , `$ftb`
FROM `price_slot_day_ledger`
WHERE `user_id` = '";
$sql .= $user_id;
$sql .= "' ORDER BY `id` DESC LIMIT 1 ";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11e Account' query");
 while($row = mysqli_fetch_array($result)){
$balance = $row[$ftb];
}
// this needs to have the prorate calc done first before it rejects
$prorated_amount_array = $get_info->B1calcPerDiem($purchased_slot_amount,"purchase", $currency);
$prorated_amount = $prorated_amount_array[0];
//don't need to format to compare ? changed 7/4/2013
//$prorated_amount = number_format($prorated_amount, 2, '.', '');$purchased_slot_amount
if($balance < $prorated_amount){
//make a function that looks for other purchases made since previous midnight and offer unpurchasing them?
$message =  'insufficient';//message now becomes a flag to make header return to different success page insuffient.php
return $message ;
}

$sql = "SELECT `url` from `links` where `id`='$link_id' AND `category` ='$cat_id' AND  	`BB_user_ID`='$user_id'";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11d3 Account' query");
 while($row = mysqli_fetch_array($result)){
$url = $row['url'];
}
$message .=  '<h3 style="color:red;">'.$url;
$message .= '</h3>';
$text_email .= "$url
";



//now that we entered the monthly costs, we must pro-rate the monthly charge to show them the charge their account for the remainder of the month

//these next lines don't seem to do anything?

//$perdiem_amount_array = $get_info->B1calcPerDiem($purchased_slot_amount,"purchase", $currency);//B1calcPerDiem($price_slot_amnt, "rebate" )
$text_email .= $prorated_amount_array[2];
$message .= $prorated_amount_array[1];
$rebate_amount .= $prorated_amount_array[0];
//changed 7/4/2013 to 8 dec
$rebate_amount = number_format($rebate_amount, 20, '.', '');
$new_balance = $balance - $rebate_amount;
return array($message, $text_email) ;
}//close if >



function B1markPriceSlotsCancel($user_id, $link_id, $cat_id, $purchased_slot_amount,$subscribe, $coin_type)
{  
//this whole function seems like a waste as it does a bunch of queries and neither inserts data nor returns the results?

 //6/18/2012 adding link id to daily ledger to facilitate commission disbrsal
$message_switch= $message; //the message var either carries in the begginning lines of the final message or brings in the value "B1". We rename it here and use the long version to test against, as the short one will get rewritten and returnsed
//make this all a transaction when function is complete ... make it be able to rollback if interupted
$message = ""; //get rid of B1 because shows up at front of message
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
date_default_timezone_set('America/New_York');
$today = date("Y-m-d H:i:s");
$get_info = new price_slot_info;
//$price_slot_info_array = $get_info->getBasePrice();
if($coin_type =='bitcoin'){
$ftb="balance";
}
else
{
$ftb="tn_balance";
}

$sql = "SELECT `id` , `$ftb`
FROM `price_slot_day_ledger`
WHERE `user_id` = '$user_id'
ORDER BY `id` DESC
LIMIT 1 ";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11c Account' query");
 while($row = mysqli_fetch_array($result)){
$balance = $row[$ftb];
}
$sql = "SELECT `id`, `price_slot_amnt` from `price_slots_subscripts` where `link_id`='$link_id' AND `cat_id` ='$cat_id' AND  user_id='$user_id' AND `subscribe` = '1'";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11d1 Account' query");
 while($row = mysqli_fetch_array($result)){
$price_slot_trans_ID = $row['id'];
$price_slot_amnt = $row['price_slot_amnt'];
}
/*  
if($currency == "BTC"){
$price_slot_amnt = $price_slot_amnt* . 012;
}
*/
//do a select to get price slot trans id 
//price slot trans id needs to be the log entry where purchase was active
//it will be in a cancels table, timestamped, linked to its log entry id (where subscribe gets turned to 0)
$sql = "SELECT `url` from `links` where `id`='$link_id' AND `category` ='$cat_id' AND  `BB_user_ID` ='$user_id'";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11d2 Account' query");
 while($row = mysqli_fetch_array($result)){
$url = $row['url'];
}

$message .= '<h3 style="color:red;">'.$url;
$message .= '</h3>';
$text_email = "$url
";
//the rebate param was changed from what is sent in the funcs param list to what is selected from the subscripts table. The rebate needs to be calculated on what they bought, not on what they are buying
$perdiem_amount_array = $get_info->B1calcPerDiem($price_slot_amnt, "rebate", $currency);//send numrows that tells whether link is a widget
$text_email .= $perdiem_amount_array[2];
$message .= $perdiem_amount_array[1];
$rebate_amount = $perdiem_amount_array[0];
//the next seems not used?
//rebate amount with old format is only added to new balance
// but new balance isn't returned
//$rebate_amount = number_format($rebate_amount, 2, '.', '');
//$new_balance = $balance + $rebate_amount;
return array($message, $text_email);
}

/* temporary deprecate because uses deprecated BB_bank_ID which is now just user id
function credit_transfers ($user_id_seller, $user_id_buyer, $BBbank_transfer_id, $payment_amount){
include("/home/bungeebo/public_html/db_cfg/db2bbconfig.php");
include("/home/bungeebo/public_html/db_cfg/connectloginmysqli.php");
//duplicate everything for buyer and seller 
$user_bank_seller = $this->getUsersBank($user_id_seller);//this copies pw to BB_bank_ID too if new account
$user_bank_buyer = $this->getUsersBank($user_id_buyer);//this copies pw to BB_bank_ID too if new account
$user_bank_seller = substr($user_bank_seller, 0, -28);  // returns "abcde"
$user_bank_buyer = substr($user_bank_buyer, 0, -28);  // returns "abcde"
$query_seller = "Select `amount_btc` from `BungeeBank_balance` where `BB_bank_ID` = '$user_bank_seller' and `BB_user_ID`= '$user_id_buyer'";
$query_buyer = "Select `amount_btc` from `BungeeBank_balance` where `BB_bank_ID` = '$user_bank_buyer' and `BB_user_ID`= '$user_id_buyer'";
$result_seller = mysqli_query($connect, $query_seller)or die("<p align='left'>Bold query1 "); 
$result_buyer = mysqli_query($connect, $query_buyer)or die("<p align='left'>Bold query1 "); 
$num_rows_seller = mysqli_num_rows($result_seller);
$num_rows_buyer = mysqli_num_rows($result_buyer);

If($num_rows_seller>0){
$balance_array = $this->getUsersBungeeBankBalance($user_id_seller);
$val_seller = $balance_array[5];
//returns array($id, $user_id, $frn_cash_balance, $amount_commiss_cash, $bungee_cash_balance,$amount_btc 
$new_btc_seller = $val_seller - $payment_amount;
$sql_seller="UPDATE `BungeeBank_balance` set `amount_btc` = '$new_btc_seller' where `BB_bank_ID` = '$user_bank_seller' and `BB_user_ID`= '$user_id_seller'";
}
else//create an account
{
exit('the seller should ALWAYS HAVE AN ACCOUNT ALREADY! Also, make sure the balance isn\'t negative');
}

If($num_rows_buyer>0){
$balance_array = $this->getUsersBungeeBankBalance($user_id_buyer);
$val_buyer = $balance_array[5];
//returns array($id, $user_id, $frn_cash_balance, $amount_commiss_cash, $bungee_cash_balance,$amount_btc 
$new_btc_buyer = $val_buyer + $payment_amount;
$sql_buyer="UPDATE `BungeeBank_balance` set `amount_btc` = '$new_btc_buyer' where `BB_bank_ID` = '$user_bank_buyer' and `BB_user_ID`= '$user_id_buyer'";
}
else
{
$new_btc_buyer = $payment_amount;
$sql_buyer="insert into `BungeeBank_balance` (`BB_user_ID`, `BB_bank_ID`, `amount_commiss_cash`)values ('$user_id_buyer', '$user_bank_buyer', '$payment_amount')";
}
//all the sqls are now ready. After preparing the daily ledger sql we can run all the differently lnamed sqls using different results statement and run them all as a transaction


//also make funds avalailable from their last price_slot_day_ledger balance too
//by adding an entry to it as a deposit
//user_id 	balance 	trans_time 	deposit 	deposit_id 	purchase 	purchase_id
//before adding it, need to find the users current balance by getting their last transaction
$sql_dl_seller = "SELECT `id` , `balance`
FROM `price_slot_day_ledger`
WHERE `user_id` = '$user_id_seller'
ORDER BY `id` DESC
LIMIT 1 ";

$sql_dl_buyer = "SELECT `id` , `balance`
FROM `price_slot_day_ledger`
WHERE `user_id` = '$user_id_buyer'
ORDER BY `id` DESC
LIMIT 1 ";

$result_dl_seller = mysqli_query($connect, $sql_dl_seller) or die("Couldn't execute 'Deposite Account 362' query");
while ($row = mysqli_fetch_array($result_dl_seller)) 
 {
 $day_ledger_balance_dl_seller = $row['balance'];
}

$result_dl_buyer = mysqli_query($connect, $sql_dl_buyer) or die("Couldn't execute 'Deposite Account 362' query");
while ($row = mysqli_fetch_array($result_dl_buyer)) 
 {
 $day_ledger_balance_dl_buyer = $row['balance'];
}
$new_balance_dl_seller = $day_ledger_balance_dl_seller - $payment_amount;
$new_balance_dl_buyer = $day_ledger_balance_dl_buyer + $payment_amount;

//the link id var is empty in thiss function, is not sent in the call, and needs to be the widget's link id
//the balance is always being set at 9.9999999 for some reason

$sql_dl_seller="insert into `price_slot_day_ledger` (`user_id`, `link_id`,`balance`, `deposit`, `deposit_id`, `trans_type`) values ('$user_id_seller', '$widgets_link_id','$new_balance_dl_seller', '$payment_amount', '$last_id_seller', 'commiss')";

$sql_dl_buyer="insert into `price_slot_day_ledger` (`user_id`, `link_id`,`balance`, `deposit`, `deposit_id`, `trans_type`) values ('$user_id_buyer', '$widgets_link_id','$new_balance_dl_buyer', '$payment_amount', '$last_id_seller', 'commiss')";


//now process all the sqls as a transaction - either they all go through or none go through
//start transaction
$mysqli->autocommit(FALSE);
$result = mysqli_query($connect, $sql_seller) or die("Couldn't execute '103' query");
$result = mysqli_query($connect, $sql_buyer) or die("Couldn't execute '105' query");
$result = mysqli_query($connect, $sql_dl_seller) or die("Couldn't execute '109' query");
$result = mysqli_query($connect, $sql_dl_buyer) or die("Couldn't execute '110' query");
$mysqli->commit();
}
*/

function getThisLinksPaidRank($cat_id, $link_id){
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
if($cat_id != 1024){
$query = "SELECT *
FROM `price_slots_subscripts`
WHERE `cat_id` = '".$cat_id."'
AND `subscribe` = 2 ORDER by price_slot_amnt DESC, t_timestamp ASC";

$result = @mysqli_query($connect, $query) or die("Couldn't execute 'getThisLinksPaidRank' query");
$num_rows = mysqli_num_rows(mysqli_query($connect, $query)); 
while ($row = mysqli_fetch_array($result)) 
 {
$links_list[] =  $row['link_id'];
}
if($num_rows > 0){
	foreach($links_list as $key=>$value){
		if($value == $link_id){
		$this_links_rank = $key;
		}
		}
	return  $this_links_rank + 1;
	}
}
else
{
return 0;
}
}

function getThisLinksFiatRank($cat_id, $link_id){
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
	if($cat_id != 1024){
	$query = "SELECT *
	FROM `price_slots_subscripts`
	WHERE `cat_id` = '".$cat_id."'
	AND `subscribe` = 1 ORDER by price_slot_amnt DESC, t_timestamp ASC";

	$result = @mysqli_query($connect, $query) or die("Couldn't execute 'getThisLinksPaidRank' query");
	$num_rows = mysqli_num_rows(mysqli_query($connect, $query)); 
	while ($row = mysqli_fetch_array($result)) 
	 {
	$links_list[] =  $row['link_id'];
	}
		if($num_rows > 0){
		foreach($links_list as $key=>$value){
			if($value == $link_id){
			$this_links_rank = $key;
			}
		}
		return  $this_links_rank + 1;
		}
	}
else
{
return 0;
}
}

function getThisLinksFreeRank($cat_id, $link_id){
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
$query = "SELECT *
FROM `price_slots_subscripts`
WHERE `cat_id` = '".$cat_id."'
AND `subscribe` > 0 ORDER by price_slot_amnt DESC, t_timestamp ASC";
$result = @mysqli_query($connect, $query) or die("Couldn't execute 'getAllDailySubscripts' query");
$num_rows = mysqli_num_rows(mysqli_query($connect, $query)); 
$row="";
$links_list="";
while ($row = mysqli_fetch_array($result)) 
 {
$links_list[] =  $row['link_id'];
}

$query = "SELECT *
FROM `links`
WHERE `category` = '".$cat_id."'
AND `approved` = 'true' ORDER by start_date ASC";
$result = @mysqli_query($connect, $query) or die("Couldn't execute 'getThisLinksFreeRank' query");
$row="";
$link_id_temp="";
$this_links_rank="";
$this_links_rank="";
while ($row = mysqli_fetch_array($result)){
$link_id_temp[] = $row['id'];
}
	foreach($link_id_temp as $key=>$value){
		if($value == $link_id){
		$this_links_rank = $key + 1;
		}
	}
$this_links_final_rank = $this_links_rank + count($links_list);

return  $this_links_final_rank;
}

function getBasePrice2bd(){
//this is the new function that delivers prices to bbuser control panel
//it is the very lowest of the price slots - all the rest are derived from the algoritm
//each increment is the result of the previous price (starting with base price) plus the previous price times the adj factor
//the first adj factor is .5 - can make changes to it by halving it which will create a brand new and empty price slot in between the originals
//there is a price slot generator in link_exchange/admin that worked on the old price gerator that needs to be updated to work on this
//other wise, until then, create a new entry in the db table. Change the old "is_active" column to 0. Make the new adj factor 1
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
$query = "Select * from `base_prices` where `is_active`='1'"; 
//id 	is_active 	base_price 	adj_factor 	total_slots 	t_timestamp 
$result = mysqli_query($connect, $query); 
 while ($row = mysqli_fetch_array($result)) 
 {
$id = $row['id'];
$is_active = $row['is_active'];	
$base_price = $row['base_price'];
$adj_factor = $row['adj_factor'];
$total_slots = $row['total_slots'];
$t_timestamp = $row['t_timestamp'];
 }
$row = array($id, 	$is_active, 	$base_price, 	$adj_factor, 	$total_slots, 	$t_timestamp);
  return $row;
 }

function debit_bitcoin ($user_id, $BB_bitcoin_cold_address, $from_address, $payment_amount, $txID, $notes){
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".WRITER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
$get_info = new price_slot_info;
$sql="INSERT into `BungeeBank_bitcoin` (`BB_user_id`, `BB_bitcoin_cold_address`, `from_address`, `amount`, `txid`, `notes`)values('$user_id', '$BB_bitcoin_cold_address', '$from_address', '$payment_amount', '$txID', '$notes' )";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Insert 111 deposit' query");
$last_id = mysqli_insert_id($connect);
$query = "Select `amount_btc` from `BungeeBank_balance` where  `BB_user_ID`= '$user_id'";
$result = mysqli_query($connect, $query)or die("<p align='left'>Bold query 112 "); 
$balance_array = $get_info->getUsersBungeeBankBalance($user_id);
//returns now 2 more values $id, $user_id, $frn_cash_balance, $amount_commiss_cash, $bungee_cash_balance,$amount_btc
$new_amount_btc = $balance_array[5] - $payment_amount;
$sql="UPDATE `BungeeBank_balance` set `amount_btc` = '$new_amount_btc' where  `BB_user_ID`= '$user_id'";
$result = mysqli_query($connect, $sql) ;
$sql = "SELECT `id` , `balance`, `tn_balance`
FROM `price_slot_day_ledger`
WHERE `user_id` = '$user_id'
ORDER BY `id` DESC
LIMIT 1 ";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Deposite Account 362' query");
while ($row = mysqli_fetch_array($result)) 
 {
 $day_ledger_balance = $row['balance'];
$day_ledger_tn_balance = $row['tn_balance'];
}
$new_balance = $day_ledger_balance - $payment_amount;
$sql="insert into `price_slot_day_ledger` (`user_id`, `link_id`,`balance`,`tn_balance`, `deposit`, `deposit_id`, `trans_type`) values ('$user_id', '$link_id','$new_balance', '$day_ledger_tn_balance' , '$payment_amount', '$last_id', 'bitcoin')";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Deposite Account 372' query");
}


function credit_bitcoin ($user_id, $BB_bitcoin_cold_address, $from_address, $payment_amount, $txID, $notes){
//members index which calls this func is now sendin txid credit_bitcoin ($userID[$key], $addr[$key], $amount[$key], $txID[$key]);
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".WRITER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
$get_info = new price_slot_info;
//echo 'line 514 psc $user_id, $BB_bitcoin_cold_address, $payment_amount, $txID = ';
//new column name list for bungeebank_bitcoin ////id,BB_user_ID,BB_bitcoin_cold_address,from_address,amount,confirmations,date,txid,notes

//$user_bank = $get_info->getUsersBank($user_id);//this copies pw to BB_bank_ID too if new account

$sql="INSERT into `BungeeBank_bitcoin` (`BB_user_id`, `BB_bitcoin_cold_address`, `from_address`, `amount`, `txid`, `notes`)values('$user_id', '$BB_bitcoin_cold_address', '$from_address', '$payment_amount', '$txID', '$notes' )";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Insert 111 deposit' query");
$last_id = mysqli_insert_id($connect);

$query = "Select `amount_btc` from `BungeeBank_balance` where  `BB_user_ID`= '$user_id'";
$result = mysqli_query($connect, $query)or die("<p align='left'>Bold query 112 "); 
$num_rows = mysqli_num_rows($result);
If($num_rows>0){
$balance_array = $get_info->getUsersBungeeBankBalance($user_id);
//returns now 2 more values $id, $user_id, $frn_cash_balance, $amount_commiss_cash, $bungee_cash_balance,$amount_btc
$new_amount_btc = $balance_array[5] +$payment_amount;
$sql="UPDATE `BungeeBank_balance` set `amount_btc` = '$new_amount_btc' where  `BB_user_ID`= '$user_id'";
$result = mysqli_query($connect, $sql) ;
// now update day logs balance
}
else//create an account
{
$sql="insert into `BungeeBank_balance` (`BB_user_ID`, `amount_btc`)values ('$user_id', '$payment_amount')";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Deposite Account 348' query");
}
/*
//also make funds avalailable from their last price_slot_day_ledger balance too
//by adding an entry to it as a deposit
//user_id 	balance 	trans_time 	deposit 	deposit_id 	purchase 	purchase_id
//before adding it, need to find the users current balance by getting their last transaction
//$sql="SELECT max(id) as id, balance from `price_slot_day_ledger` where `user_id` = '$user_id' Group By `user_id` ";
*/
//$sql = "SELECT max(id) as id, `balance`from `price_slot_day_ledger` WHERE `user_id` = '$user_id' Group By `user_id` ";
$sql = "SELECT `id` , `balance`, `tn_balance`
FROM `price_slot_day_ledger`
WHERE `user_id` = '$user_id'
ORDER BY `id` DESC
LIMIT 1 ";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Deposite Account 362' query");
while ($row = mysqli_fetch_array($result)) 
 {
 $day_ledger_balance = $row['balance'];
$day_ledger_tn_balance = $row['tn_balance'];
}
// to resync day ledger to bungeebank balance uncomment this new balance line and commenet out other ONE TIME then undo!
// $new_balance = $new_amount_btc;
$new_balance = $day_ledger_balance + $payment_amount;


$sql="insert into `price_slot_day_ledger` (`user_id`, `link_id`,`balance`,`tn_balance`, `deposit`, `deposit_id`, `trans_type`) values ('$user_id', '$link_id','$new_balance', '$day_ledger_tn_balance' , '$payment_amount', '$last_id', 'bitcoin')";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Deposite Account 372' query");



}

//moved to this class from paginate buy class on 7/4/2013 
//seems to be the only func still used from old auc days
//used in bungee_jumpers/index.php
function credit_daily_commiss(){
//this function needs to be called from cron page or inserted there
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

date_default_timezone_set('America/New_York');

$today_deadline = date('Y-m-');// the latest cancellation today that could affect yesterday when the cron runs after 1 a.m. is 1 a.ma
//If the user cancelled at 11;59 p.m., subscribe would be 0 giving them a free day but if the start date was earlier than 1 hour before
//then no free day
//but if the start time was 11:59, they have until 12:59 to cancel and get refund
$today_deadline .= date('d');
$today_deadline .= date( ' 01:00:00');




$yesterday = date('Y-m-');
$yesterday .= date('d')-1;//temp for testing - cjhange back to -1
$yesterdaybegin .= date( ' 00:00:00');
$yesterdayend .= date( ' 24:00:00');

$yesterdaybegin = $yesterday . $yesterdaybegin;
$yesterdayend = $yesterday . $yesterdayend;

$sql = "select * from `price_slots_subscripts` where `start_date` > '$yesterdaybegin' AND `start_date` < '$yesterdayend'  or `subscribe` = 1";

//time format = 2013-07-21 14:21:03
$result = mysqli_query($connect, $sql)or die("<p align='left'>Bold query5 "); 
$num_rows = mysqli_num_rows($result);
if($num_rows>0){
while ($row = mysqli_fetch_array($result)) 
 {
$link_id[] = $row['link_id'];
$start_date[] = $row['start_date'];
$t_timestamp[] = $row['t_timestamp'];
$subscribe[] = $row['subscribe'];
}

foreach($link_id as $key=>$value){// for each link that is either active (definitely pay commission
// or added yesterday (might have to pay a commission)
	If($subscribe[$key]== 0){
	//check if the time difference between start and cancel is greater than an hour --- if so, then do the commission to everyone
	//because they paid and didn't get a refund  $t_timestamp[$key] is the cancel time
		if($t_timestamp[$key] -$start_date[$key] > 60  ){
		//echo '<h1>Pay commission on this cancelled link</h1>';
		}//close if
		else
		{
		//echo '<h1>this cancelled link less than 1 hour difference - no commission</h1>';
		}
	}//close if
	else
	{
	//echo '<h1>Pay commission on this active link</h1>';


	}

}//close foreach
}//close if
}

function get_click_tallies_for_link_list_from_gen($cat_id){
date_default_timezone_set('America/New_York');
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

//$now= mktime(America/New_York);
$now= mktime();
 $timespan= (60*60*24*30);//30 day3
$query = "Select * from `price_slot_gen` where `cat_id`='$cat_id' ORDER by `t_timestamp` DESC LIMIT 1"; 
$result = mysqli_query($connect, $query)or die("<p align='left'>Bold query5 "); 
$row = mysqli_fetch_array($result);
	$query_30_day_tot = $row['query_30_day_tot'];
return $query_30_day_tot;
 }


function getNumofSubscriptsinCat($cat_id){
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
$query = "SELECT *
FROM `price_slots_subscripts`
WHERE `cat_id` = '".$cat_id."'
AND `subscribe` > 0";

$result = @mysqli_query($connect, $query) or die("Couldn't execute 'getAllDailySubscripts' query");
$num_rows = mysqli_num_rows(mysqli_query($connect, $query)); 
return  $num_rows;
}

function check_4prev_credit_voucher ($amount){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$get_info = new price_slot_info;
$voucher_id = $voucher_id - 1;
$sql = "select `amount` from `BungeeBank_voucher` where `amount` = $amount" ;
$result = mysqli_query($connect, $sql)or die("<p align='left'>Bold query1 "); 
$num_rows = mysqli_num_rows($result);
If($num_rows>0){
return "<h1>A voucher of the same amount has been found just previous to this! It appears you have double submitted the voucher and no account has been credited. Currently there is no way to credit the account with two back-to-back identical amounts.";
}else{

return "not_found";
}
}




function credit_voucher ($user_id, $voucher_id, $payment_amount){
//need to add $coin_type  to incoming if I want to process BTC
if($user_id =="" OR $voucher_id =="" OR $payment_amount =="")
{
echo "Procedure cancelled - missing field or input - user id = $user_id, voucher_id =$voucher_id, payment_amount = $payment_amount ";
exit();
}
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".WRITER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
//credit_voucher ($Se_By_User_ID, $voucher_id, $voucher_amount);
$get_info = new price_slot_info;
//$user_bank = $get_info->getUsersBank($user_id);
//$user_bank = "deprecatedline384psclass";
//just browsing through it looks like this should check if already exists?

$sql="INSERT into `BungeeBank_voucher` (`BB_user_id`, `voucher_gen_id`, `amount`)values('$user_id', '$voucher_id', '$payment_amount' )";
//need to add $coin_type  to incoming if I want to process BTC
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Insert 111 deposit' query");
//need to get the voucher id just submitted to prevent double form entry

$query = "Select `amount_btc` from `BungeeBank_balance` where  `BB_user_ID`= '$user_id'";
$result = mysqli_query($connect, $query)or die("<p align='left'>Bold query1 "); 
$num_rows = mysqli_num_rows($result);
If($num_rows>0){
$balance_array = $get_info->getUsersBungeeBankBalance($user_id);
//now returns two more values $balance = array($id, $user_id, $testcoin_balance, $amount_commiss_cash, $bungee_cash_balance,$amount_btc );
$cur_bal = $balance_array[2];
$new_BB_bal = $cur_bal + $payment_amount;
$sql="UPDATE `BungeeBank_balance` set `amount_testcoin` = '$new_BB_bal' where  `BB_user_ID`= '$user_id'";
$result = mysqli_query($connect, $sql) ;
// now update day logs balance
}
else//create an account
{
$sql="insert into `BungeeBank_balance` (`BB_user_ID`, `amount_testcoin`)values ('$user_id', '$payment_amount')";

$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Deposite Account 29' query");
}
$sql = "SELECT `id` , `tn_balance`
FROM `price_slot_day_ledger`
WHERE `user_id` = '$user_id'
ORDER BY `id` DESC
LIMIT 1 ";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Deposite Account 36' query");
$num_rows = mysqli_num_rows($result);
if($num_rows>0){
while ($row = mysqli_fetch_array($result)) 
 {
 $day_ledger_balance = $row['tn_balance'];
}}
$new_balance = $day_ledger_balance + $payment_amount;

$sql="insert into `price_slot_day_ledger` (`user_id`, `link_id`,`tn_balance`, `deposit`, `deposit_id`, `trans_type`) values ('$user_id', '$link_id','$new_balance', '$payment_amount', '$voucher_id', 'ttc_vch')";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Deposite Account 46' query");
exit();
}





function preparePriceSlotsCancel($user_id, $link_id, $cat_id, $purchased_slot_amount,$subscribe, $coin_type)
{  
//this whole function seems like a waste as it does a bunch of queries and neither inserts data nor returns the results?

 //6/18/2012 adding link id to daily ledger to facilitate commission disbrsal
$message_switch= $message; //the message var either carries in the begginning lines of the final message or brings in the value "B1". We rename it here and use the long version to test against, as the short one will get rewritten and returnsed
//make this all a transaction when function is complete ... make it be able to rollback if interupted
$message = ""; //get rid of B1 because shows up at front of message
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
date_default_timezone_set('America/New_York');
$today = date("Y-m-d H:i:s");
$get_info = new price_slot_info;

$sql = "SELECT `id` , `balance`
FROM `price_slot_day_ledger`
WHERE `user_id` = '$user_id'
ORDER BY `id` DESC
LIMIT 1 ";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11c Account' query");
 while($row = mysqli_fetch_array($result)){
$balance = $row['balance'];
}
$sql = "SELECT `id`, `price_slot_amnt` from `price_slots_subscripts` where `link_id`='$link_id' AND `cat_id` ='$cat_id' AND  user_id='$user_id' AND `subscribe` = '1'";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11d1 Account' query");
 while($row = mysqli_fetch_array($result)){
$price_slot_trans_ID = $row['id'];
$price_slot_amnt = $row['price_slot_amnt'];
}

//do a select to get price slot trans id 
//price slot trans id needs to be the log entry where purchase was active
//it will be in a cancels table, timestamped, linked to its log entry id (where subscribe gets turned to 0)
$sql = "SELECT `url` from `links` where `id`='$link_id' AND `category` ='$cat_id' AND  `BB_user_ID` ='$user_id'";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11d2 Account' query");
 while($row = mysqli_fetch_array($result)){
$url = $row['url'];
}

$message .= '<h3 style="color:red;">'.$url;
$message .= '</h3>';
$text_email = "$url
";
//the rebate param was changed from what is sent in the funcs param list to what is selected from the subscripts table. The rebate needs to be calculated on what they bought, not on what they are buying
$perdiem_amount_array = $get_info->B1calcPerDiem($price_slot_amnt, "rebate", $coin_type);//send numrows that tells whether link is a widget
$text_email .= $perdiem_amount_array[2];
$message .= $perdiem_amount_array[1];
$rebate_amount = $perdiem_amount_array[0];
//the next seems not used?
//rebate amount with old format is only added to new balance
// but new balance isn't returned
//$rebate_amount = number_format($rebate_amount, 2, '.', '');
//$new_balance = $balance + $rebate_amount;
return array($message, $text_email);
}


function B1calcPerDiem($monthly_fee, $type, $coin_type){
date_default_timezone_set('America/New_York');
$msg="";
$today = date("d");
$month = date("m");
$year = date("Y");
$get_info = new price_slot_info;
$Last_day_of_month = $get_info->lastday($month, $year);
$numdays_in_month = substr($Last_day_of_month, -2, 2); 
$numdays_remaining_in_month = $numdays_in_month-$today + 1;//note- this was done on the 31st It was calulating zero fee for the last day so added one day to generate a fee and avoid zero errors.
$fee_rebate = ($monthly_fee/$numdays_in_month)*$numdays_remaining_in_month;
$per_diem = $monthly_fee/$numdays_in_month;
$fee_rebate =   number_format($fee_rebate, 20, '.', '');
$per_diem = number_format($per_diem, 20, '.', '');



if($type=="purchase"){
$msg= '<h1>Final Step - Recording Your Transaction</h1>';
$txmsg= 'Final Step - Recording Your Transaction';
$msg .= "<h2>The Purchase ...</h2><p>Regarding the purchase of your paid slot position (NOT page position). You will have a ONE HOUR time period to cancel your order and receive a refund to your account. After that time you can still cancel your subscription but you will not be refunded the daily fee. (note - to cancel, click the \"modify\" button and select this same price slot (it will be displayed in green) ";
$txmsg .= "<h2>The Purchase ...</h2><p>Regarding the purchase of your paid slot position (NOT page position). You will have a ONE HOUR time period to cancel your order and a refund to your account. After that time you can still cancel your subscription but you will not be refunded the daily fee.";
$new_monthly_fee = $monthly_fee;
$numdays_remaining_in_month=round($numdays_remaining_in_month);
$msg .= '<p style="color:red;">The monthly price slot fee of   ';
$msg .=  (float)$monthly_fee;
$msg .= " ";
 $msg .= $coin_type;
$msg .= ' divided by the number of days in this month gives the "per diem" fee which is '. (float)$per_diem;
$msg .= '<p style="color:red;">(note the actual <b>daily</b> price slot fee varies slightly month to month depending upon the number of days in that particular month). 
';




}
elseif($type=="cancel"){
$msg= '<h1>Final Step - Recording Your Cancellation</h1>';
$txmsg= 'Final Step - Recording Your Cancellation ';
$msg .= "<h2>The Cancellation ...</h2><p>Regarding the cancellation of your paid link/price slot subscription. By completing this transaction you acknowledge you are aware that your link will lose its seniority in that price slot and your link returns to its original free link status and free link seniority. If this cancellation has been performed within an hour of placeing the purchase then your account will be refunded the purchase price (the per-diem price that you were charged).";
$txmsg .= "<h2>The Cancellation ...</h2><p>Regarding the cancellation of your paid link/price slot subscription By completing this transaction you acknowledge you are aware that your link will lose its seniority in that price slot and your link returns to its original free link status and free link seniority. If this cancellation has been performed within an hour of placeing the purchase then your account will be refunded the purchase price (the per-diem price that you were charged). 
";
}







//return array($fee_rebate, $msg);
return array($monthly_fee, $msg);//changed on 8/7/2013
}


function preparePriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $link_id, $cat_id, $purchased_slot_amount,$subscribe, $coin_type)
{ 
//B1 only selects, no data insertion here
                         
 if($user_id==""||$user_id==0||$link_id==0||$cat_id==0){
echo '<h3>in preparePriceSlotsActive and stopped by missing data</h3>';
exit();
}
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
if($subscribe == 1){
//2010-10-20 14:06:31 why only a date if subscribing? 
date_default_timezone_set('America/New_York');
$today = date("Y-m-d H:i:s");
}
$get_info = new price_slot_info;
//$price_slot_info_array = $get_info->getBasePrice();
//$price_slot_log_id = $price_slot_info_array[0];//doesn't seem to be used anywhere

//we need their balance to know if they have sufficient funds
$sql = "SELECT `id` , `balance`
FROM `price_slot_day_ledger`
WHERE `user_id` = '";
$sql .= $user_id;
$sql .= "' ORDER BY `id` DESC LIMIT 1 ";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11e Account' query");
 while($row = mysqli_fetch_array($result)){
$balance = $row['balance'];
}

// this needs to have the prorate calc done first before it rejects
$prorated_amount_array = $get_info->B1calcPerDiem($purchased_slot_amount,"purchase", $coin_type);
$prorated_amount = $prorated_amount_array[0];
//don't need to format to compare ? changed 7/4/2013
//$prorated_amount = number_format($prorated_amount, 2, '.', '');$purchased_slot_amount
if($balance < $prorated_amount){
//make a function that looks for other purchases made since previous midnight and offer unpurchasing them?
$message =  'insufficient';//message now becomes a flag to make header return to different success page insuffient.php
return $message ;
}

$sql = "SELECT `url` from `links` where `id`='$link_id' AND `category` ='$cat_id' AND  	`BB_user_ID`='$user_id'";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11d3 Account' query");
 while($row = mysqli_fetch_array($result)){
$url = $row['url'];
}
$message .=  '<h3 style="color:red;">'.$url;
$message .= '</h3>';
$text_email .= "$url
";



//now that we entered the monthly costs, we must pro-rate the monthly charge to charge their account for the remainder of the month

//these next lines don't seem to do anything?

$perdiem_amount_array = $get_info->calcPerDiem($purchased_slot_amount,"purchase", $coin_type);//B1calcPerDiem($price_slot_amnt, "rebate" )
//$text_email .= $perdiem_amount_array[2]; don't know what I might have done - the third arg in the array is not part of an email message and is the coin type
$message .= $perdiem_amount_array[1];
$rebate_amount .= $perdiem_amount_array[0];
//changed 7/4/2013 to 8 dec
$rebate_amount = number_format($rebate_amount, 20, '.', '');
$new_balance = $balance - $rebate_amount;
return array($message, $text_email) ;
}//close if >

function getBuyersBungeeBankBalance($user_id){
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
$sql = "SELECT amount_testcoin,amount_btc from `BungeeBank_balance` WHERE `BB_user_ID` = '$user_id'";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11a Account' query");
 while($row = mysqli_fetch_array($result)){
$testcoin_cash = $row['amount_testcoin'];
$amount_btc = $row['amount_btc'];
}
return array($testcoin_cash, $amount_btc);
}
function getBuyersLastTransact($user_id){
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");$sql = "SELECT `id` , `balance`
FROM `price_slot_day_ledger`
WHERE `user_id` = '$user_id'
ORDER BY `id` DESC
LIMIT 1 ";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11b Account' query");
 while($row = mysqli_fetch_array($result)){
$balance = $row['balance'];
$id = $row['id'];
}
if($balance !==""){
return array($id,$balance);
}
else
{
return false;
}
}

function getBuyersBalance($user_id){
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");$sql = "SELECT `id` , `balance`
FROM `price_slot_day_ledger`
WHERE `user_id` = '$user_id'
ORDER BY `id` DESC
LIMIT 1  ";

$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11b Account' query");
 while($row = mysqli_fetch_array($result)){
$balance = $row['balance'];
}
return $balance;
}


function getBuyersBalanceTips($user_id){
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");$sql = "SELECT `id` , `balance`, `tn_balance`
FROM `price_slot_tip_ledger`
WHERE `user_id` = '$user_id'
ORDER BY `id` DESC
LIMIT 1  ";

$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11b Account' query");
 while($row = mysqli_fetch_array($result)){
$balance_btc = $row['balance'];
$tn_balance = $row['tn_balance'];
}
$return_array = array($balance_btc, $tn_balance);
return $return_array;
}

function getBuyersBalanceTN($user_id){
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");$sql = "SELECT `id` , `balance`, `tn_balance`
FROM `price_slot_day_ledger`
WHERE `user_id` = '$user_id'
ORDER BY `id` DESC
LIMIT 1  ";

$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11b Account' query");
$row  = "";
$balance_btc = "";
$tn_balance = "";
 while($row = mysqli_fetch_array($result)){
$balance_btc = $row['balance'];
$tn_balance = $row['tn_balance'];
}
$return_array = array($balance_btc, $tn_balance);
return $return_array;
}


function getUsersBank2bd ($user_id){
//deprecating all calls to this func - have them reporting to users db when called along with their line number
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");$query = "Select `BB_bank_ID` from `users` where `user_id`='$user_id'"; 
$result = mysqli_query($connect, $query)or die("<p align='left'>Bold query3 "); 
 while ($row = mysqli_fetch_array($result)) 
 {
 $BB_bank_ID = $row['BB_bank_ID'];
 
}
//if bank id is 0 user is making first deposuit so make an acciount
	if($BB_bank_ID==0){
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".WRITER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
	$sql="UPDATE `users` set `BB_bank_ID` = '$pw' where `user_id` = '$user_id' ";

	$result = mysqli_query($connect, $query)or die("<p align='left'>Bold query4 "); 
	return $pw;
	}
	else
	{
	return $BB_bank_ID;
	}
}

function getUsersBungeeBankBalance($user_id){
//added two more columns to retive on 6/2/2014
//amount_frn_cash	, amount_commiss_cash, amount_btc, amount_btc
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
$query = "Select `id`, `amount_testcoin`, `amount_commiss_cash`, `amount_btc`, `amount_btc`  from `BungeeBank_balance` where `BB_user_ID`='$user_id'"; 

$result = mysqli_query($connect, $query); 
$row = "";
$testcoin_balance = "";
$amount_commiss_cash = "";
 $bungee_cash_balance = "";
$amount_btc = "";
$id = "";
 while ($row = mysqli_fetch_array($result)) 
 {

$testcoin_balance = $row['amount_testcoin'];
$amount_commiss_cash = $row['amount_commiss_cash'];
 $bungee_cash_balance = $row['amount_btc'];
$amount_btc = $row['amount_btc'];
$id = $row['id'];
 }
$balance = array($id, $user_id, $testcoin_balance, $amount_commiss_cash, $bungee_cash_balance,$amount_btc );
  return $balance;
 }





function lastday($month = '', $year = '') {
date_default_timezone_set('America/New_York');
   if (empty($month)) {
      $month = date('m');
   }
   if (empty($year)) {
      $year = date('Y');
   }
   $result = strtotime("{$year}-{$month}-01");
   $result = strtotime('-1 second', strtotime('+1 month', $result));
   return date('Y-m-d', $result);
}


function calcPerDiem($monthly_fee, $type, $coin_type){
date_default_timezone_set('America/New_York');
$today = date("d");
$month = date("m");
$year = date("Y");
$get_info = new price_slot_info;
$Last_day_of_month = $get_info->lastday($month, $year);
$numdays_in_month = substr($Last_day_of_month, -2, 2); 
$numdays_remaining_in_month = $numdays_in_month-$today + 1;//note- this was done on the 31st It was calulating zero fee for the last day so added one day to generate a fee and avoid zero errors.

$fee_rebate = ($monthly_fee/$numdays_in_month)*$numdays_remaining_in_month;
$fee_rebate = number_format($fee_rebate, 20, '.', '');
$per_diem = $monthly_fee/$numdays_in_month;
$per_diem = number_format($per_diem, 20, '.', '');

$msg= '<h2>Recording The Transaction ...</h2><p style ="color:red;"> ';
$txmsg= '
This email is to provide you a record and a reporting about the ';
if($type=="purchase"){
$msg .= " and the daily Bitcoin fee which will be deducted from your BungeeBones account.";
$txmsg .= " and the daily Bitcoin fee which will be deducted from your BungeeBones account.
";
}
else
{
$msg .= '<p style ="color:red;">cancellation your paid link subscription.';
$txmsg .= 'cancellation your paid link subscription.';

}
$numdays_remaining_in_month=round($numdays_remaining_in_month);
$msg .= '<p style ="color:red;">The monthly fee (of your price slot) of '. (float)$monthly_fee.' '.$coin_type.' divided by the number of days in THIS month gives us this month\'s "per diem" fee which is '. (float)$per_diem;

if($type=="purchase"){
$msg .= ".<br>Again, your daily fee is only ";
$msg .=  (float)$per_diem;
$msg .= " $coin_type.<p>Your account will be charged this amount daily for the remainder of this month (note that the per diem rate varies slightly depending on the number of days in that particular month) and similarly in subsequent months until canceled or until your account runs out of funds.</p>
<p>Your link's price slot seniority starts now which means any subsequent positions purchased in this price slot by others will be displayed after yours. <hr>";
$txmsg .= "
The monthly price (of your price slot) of (float)$monthly_fee.' '.$coin_type.' divided by the number of days in this month is 
the per diem which is ".(float)$per_diem." BTC. Your account will be charged this amount daily for the remainder of this month (note the per diem rate varies depending on the number of days in that particular month) and similarly in subsequent months until canceled or until your account runs out of funds.

";
}
else
{
$msg .= '<p style ="color:red;">Your subscription has been cancelled and the per-diem in the amount of ';

$msg .=  (float)$per_diem;
$msg .= " $coin_type will no longer be deducted from your account<hr>";
$txmsg .= "Your subscription has been cancelled and the per-diem in the amount of ";
$txmsg .= (float)$per_diem; 
$txmsg .=  " $coin_type will no longer be deducted
-------------------------------------------------------------------------
";
}

//return array($fee_rebate, $msg, $txmsg);

return array($per_diem, $msg, $txmsg);
}

function getWdgtsLnkNum($user_id){
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
$sql = 'SELECT `wdgts_ID`,`wdgts_lnk_num`  FROM `users` WHERE `user_id`="'.$user_id.'"';
$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'wdgts_lnk_num query");
while($row = mysqli_fetch_array($result)){
$wdgts_lnk_num	= $row['wdgts_lnk_num'];
$wdgts_ID = $row['wdgts_ID'];
}
$send_array = array($wdgts_ID,$wdgts_lnk_num);
return $send_array;
}



function getNumLinksInSlot($category, $price, $coin_type){
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
//will return all bids by auc id
if($coin_type == "free"){
$sql = "SELECT *
FROM `price_slots_subscripts`
WHERE `cat_id` = '$category'
AND `subscribe` = '1'
AND `price_slot_amnt` = '$price'";
}
else
{
$sql = "SELECT *
FROM `price_slots_subscripts`
WHERE `cat_id` = '$category'
AND `subscribe` > 0
AND `price_slot_amnt` = '$price'
AND `coin_type` = '$coin_type'
";
}
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 12 Account' query");
$num_rows = mysqli_num_rows($result);
return $num_rows;
}

function getThisUsersEqualPriceSlot($category, $link_id, $price){
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");//will return all bids by auc id
$sql = "SELECT *
FROM `price_slots_subscripts`
WHERE `cat_id` = '$category'
AND `subscribe` > 0
AND `link_id` = '$link_id'
";

$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 12b Account' query");
//do numrows - if zero and return because this is a new purchase (not a cancel or a modify)
 $row_cnt = mysqli_num_rows($result);
if($row_cnt==0){
//they selected the same value as they had so is a cancel
$send_array = array("new", $price_slot_amnt);
return $send_array;
}

while($row = mysqli_fetch_array($result)){
$start_date =$row['start_date'];
$price_slot_amnt =$row['price_slot_amnt'];
}
if($price_slot_amnt==$price){
//they selected the same value as they had so is a cancel
$send_array = array("cancel", $price_slot_amnt);
return $send_array;
}
$send_array = array("modify", $price_slot_amnt);
return $send_array;
}


function get_cat_id($link_id){//this should be called totalFREE pages?
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");$query = 'SELECT `category` FROM `links` WHERE `category`=\''.$link_id.'\'';
$result = mysqli_query($connect, $query);
while($row = mysqli_fetch_array($result)){
$cat_id =$row['cat_id'];
}
return $cat_id;
}
function updatePriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $link_id, $cat_id, $purchased_slot_amount, $subscribe, $coin_type)
{
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");date_default_timezone_set('America/New_York');
$today = date("Y-m-d H:i:s");
//this func finds matching price to flage for deactivation if found - removing subcribe and price from where clause user id and category id could be used to update reorders/changing slot orders
//but still doesn't need price
//$sql="Update `price_slots_subscript` set `subscribe` = 0, `timestamp` =  '$today' where `link_id` = '$link_id' && `price_slot_amnt` =  '$purchased_slot_amount' && `cat_id` = '$cat_id' && `subscribe` = '$subscribe'";

$sql="Update `price_slots_subscripts` set `subscribe` = 0, `wdgts_lnk_num` = '$wdgts_lnk_num', `wdgts_ID` = $wdgts_ID, `t_timestamp` =  '$today' where `link_id` = $link_id && `cat_id` = $cat_id && `price_slot_amnt` = $purchased_slot_amount ";

$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 990 Account' query");

return true;
}


        
function markPriceSlotsCancel($user_id, $link_id, $cat_id, $purchased_slot_amount,$subscribe, $coin_type)
{  

   //change 6/18/2012 may be wrong deprecated function - see B1 versions too - added link id to update day ledger in order to calcu;ate commission disbursement
//$message_switch= $message; //the message var either carries in the begginning lines of the final message or brings in the value "B1". We rename it here and use the long version to test against, as the short one will get rewritten and returnsed
//make this all a transaction when function is complete ... make it be able to rollback if interupted
$message = ""; //get rid of B1 because shows up at front of message
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

date_default_timezone_set('America/New_York');
$today = date("Y-m-d H:i:s");
$get_info = new price_slot_info;

$sql = "SELECT `id` , `balance` , `tn_balance`
FROM `price_slots_daily_ledger`
WHERE `user_id` = '$user_id'
ORDER BY `id` DESC
LIMIT 1 ";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11c Account' query");
 while($row = mysqli_fetch_array($result)){
$balance = $row['balance'];
$tn_balance = $row['tn_balance'];
}

$sql = "SELECT `id`, `price_slot_amnt`, `t_timestamp`, `subscribe` from `price_slots_subscripts` where `link_id`='$link_id' AND `cat_id` ='$cat_id' AND  user_id='$user_id' AND `subscribe` > 0";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11d1 Account' query");
 while($row = mysqli_fetch_array($result)){
$price_slot_trans_ID = $row['id'];
$price_slot_amnt = $row['price_slot_amnt'];
$t_timestamp = $row['t_timestamp'];
$subscribe = $row['subscribe'];
}

//IMPORTANT
//IMPORTANT
//IMPORTANT
//All of the below changed again when we went to per diem. Buyers are rebated per diem if cancelled with an hour

/*
the value $price_slot_amnt IS THE MONTHLY FEE BUT NOT WHAT WAS PAID
It is the price slot selected by the buyer - sort of the product name
DON'T USE $price_slot_amnt AS THE PAYMENT AMOUNT WITHOUT RUNNING THROUGH PRO RATER
*/
//IMPORTANT
//IMPORTANT
//IMPORTANT
//do a select to get price slot trans id 
//price slot trans id needs to be the log entry where purchase was active
//it will be in a cancels table, timestamped, linked to its log entry id (where subscribe gets turned to 0)
$sql = "SELECT `url` from `links` where `id`='$link_id' AND `category` ='$cat_id' AND  `BB_user_ID` ='$user_id'";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11d2 Account' query");
 while($row = mysqli_fetch_array($result)){
$url = $row['url'];
}
$message .= '<h3 style="color:red;">'.$url;
$message .= '</h3>';
$text_email = "$url
";

//the rebate param was changed to perdiem param from what is sent in the funcs param list to what is selected from the subscripts table. The perdiem needs to be calculated on what they bought, not on what they are buying
if($price_slot_amnt > 0){
$perdiem_amount_array = $get_info->calcPerDiem($price_slot_amnt, "cancel", $coin_type);
//$text_email .= $perdiem_amount_array[2];
$message .= $perdiem_amount_array[1];
$perdiem_amount = $perdiem_amount_array[0];
$perdiem_amount = number_format($perdiem_amount, 20, '.', '');
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".WRITER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
$sql="INSERT into `price_slot_cancels` (`user_id`,`link_id`,`price_slot_Gen_ID`,`price_slot_trans_ID`,`credit`, `coin_type`)values(
'$user_id','$link_id','$price_slot_log_id','$price_slot_trans_ID','$perdiem_amount','$coin_type'
)";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 9b1 Account' query");
$order_log_ID = mysqli_insert_id($connect);
date_default_timezone_set('America/New_York');
$t_timestamp_unix = strtotime($t_timestamp);
//echo '<br>in PSClass line 1156 $t_timestamp_unix = ', $t_timestamp_unix;

$curtime = time();
//echo '<br>in PSClass line 1156 $curtime = ', $curtime;

if(($curtime-$t_timestamp_unix) < 3600) {
$trans_type="refund";
if($coin_type =='bitcoin' AND $subscribe==2){
$balance = $balance + $perdiem_amount;
}
else
{
$tn_balance = $tn_balance + $perdiem_amount;
}
}// close time limit for refund expiration - $current_time - $purchase_time<1 hour
else
{
$trans_type="cancel";
}

$sql = "UPDATE `price_slots_subscripts` set `subscribe` = 0 where `link_id`='$link_id' AND `cat_id` ='$cat_id' AND  user_id='$user_id' AND `subscribe` > 0";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11d1 Account' query");

$sql="insert into `price_slot_day_ledger` (`user_id`,`link_id`,`balance`,`tn_balance`, `trans_time`,`deposit`,`deposit_id`, `trans_type`)values('$user_id', '$link_id', '$balance', '$tn_balance', '$today', '$perdiem_amount','$order_log_ID', '$trans_type')";

$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11b Account' querya");
}//close if greater than zero
//Note price slot day ledger diff balance than bank - pay each commission, and balance at end of day with separate cron
return array($message, $text_email);
}


function markPriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $link_id, $cat_id, $price_selected,$subscribe, $message, $coin_type, $action)
 
{
$message = ""; 
if($user_id==""||$user_id==0||$link_id==0||$cat_id==0||$price_selected==0){

echo 'in markPriceSlotsActive class exiting for lack of data ';
exit();
}
//make this all a transaction when function is complete ... make it be able to rollback if interupted
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");if($subscribe > 0){
//2010-10-20 14:06:31 why only a date if subscribing? 
date_default_timezone_set('America/New_York');
$today = date("Y-m-d H:i:s");
}
$get_info = new price_slot_info;

$sql = "SELECT `id` , `balance` , `tn_balance`
FROM `price_slot_day_ledger`
WHERE `user_id` = '";
$sql .= $user_id;
$sql .= "' ORDER BY `id` DESC
LIMIT 1 ";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11e Account' query");
 while($row = mysqli_fetch_array($result)){
$balance = $row['balance'];
$tn_balance = $row['tn_balance'];
}

// this needs to have the prorate calc done first before it rejects
$perdiem_amount_array = $get_info->calcPerDiem($price_selected,"purchase", $coin_type);
$perdiem_amount = $perdiem_amount_array[0];


//need to make this work for both bit and test 
if($coin_type=="bitcoin"){$test_against_this_balance = $balance;}else{$test_against_this_balance = $tn_balance;}
if($test_against_this_balance < $perdiem_amount){
$message = '<h3> Sorry, there are insufficient funds in your account to make that purchase.';
$message .= '<h3> Our records indicate you have ';
if($coin_type = "bitcoin"){
$message .= $balance; 
$message .= 'in your Bitcoin fund and you are trying to purchase a price slot priced at ';
}
else
{
$message .= $tn_balance; 
$message .= 'in your Testcoin fund and you are trying to purchase a price slot priced at ';
}
$message .= $perdiem_amount;
$message .= ' per day.<h3>Please either replenish your fund or select a lower priced price slot.</h3>';

//make a function that looks for other purchases made since previous midnight and offer unpurchasing them?
//$message =  'insufficient';//message now becomes a flag to make header return to different success page insuffient.php
echo $message ;
exit();
}




else{
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".WRITER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

//make the sql either a modify(update) or an insert
if($action=="modify"){ 
$sql="Update `price_slots_subscripts` set `subscribe` = '$subscribe', `price_slot_amnt` = '$price_selected',`wdgts_lnk_num` = '$wdgts_lnk_num', `wdgts_ID` = $wdgts_ID, `t_timestamp` =  '$today' where `link_id` = $link_id && `cat_id` = $cat_id";

//if a new
}
else
{
$sql="INSERT into `price_slots_subscripts`(`user_id`, `wdgts_lnk_num`, `wdgts_ID`, `link_id`, `price_slot_amnt`, `cat_id`, `subscribe`, `start_date`, `coin_type`)values('$user_id', '$wdgts_lnk_num', '$wdgts_ID', '$link_id', '$price_selected',  '$cat_id','$subscribe', '$today', '$coin_type')";
}

$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 9 Account' query");

$price_slot_trans_ID = mysqli_insert_id($connect);
$sql = "SELECT `url` from `links` where `id`='$link_id' AND `category` ='$cat_id' AND  	`BB_user_ID`='$user_id'";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11d3 Account' query");
 while($row = mysqli_fetch_array($result)){
$url = $row['url'];
}
$message .=  '<h3 style="color:red;">Regarding your link in the BungeeBones web directory at '.$url;
$message .= '</h3>';
$text_email .= "In regards to your purchase of a paid position for your link in our web directory for your website at $url.
";
//now that we entered the monthly costs, we must get the perdiem of the monthly charge to charge their account for the day
//but if it is an exchange we need to run it twice - for each side of transaction
$perdiem_amount_array = $get_info->calcPerDiem($price_selected,"purchase", $coin_type);
//$text_email .= $perdiem_amount_array[2];
$message .= $perdiem_amount_array[1];
$perdiem_amount .= $perdiem_amount_array[0];
//changed 11/4/2013 to 20 dec- it should have been, we are about to change the ledger amounts
$perdiem_amount = number_format($perdiem_amount, 20, '.', '');
//and if this is an exchange we need to do the adjustment to both balances at the same time
//not sure if the refund timer has been run yet though 
if($coin_type=="bitcoin"){$balance = $balance - $perdiem_amount;}else{$tn_balance = $tn_balance - $perdiem_amount;}



$sql="INSERT into `price_slot_day_ledger` 
(`user_id`, `link_id`,`balance` ,`tn_balance`,`purchase`,`pro_rated_purchase`,`purchase_id`, `trans_type`)values('$user_id', '$link_id','$balance', '$tn_balance','$price_selected', '$perdiem_amount', '$price_slot_trans_ID', 'buy')";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11b Account' queryb");
//pay each commission at end of day with separate cron
//now the balance in price_slot_day_ledger and Bungee BungeeBank tables are different. Run a cron at end of day that tallies all transactions in price_slot_day_ledger 
//The cron should be in separate folder (/link_exchange/admin/widget_mgr/index_demo.php)
//it runs manually now, but put on daily cron after debugging
return array($message, $text_email) ;
}//close if >
}

function insert_into_day_ledger2bd($user_id, $link_id,$new_balance,$price_selected, $perdiem_amount,$price_slot_trans_ID,$trans_type){
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".WRITER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

$sql="INSERT into `price_slot_day_ledger` 
(`user_id`, `link_id`,`balance` ,`purchase`,`pro_rated_purchase`,`purchase_id`, `trans_type`)values($user_id, $link_id,$new_balance,$price_selected, $perdiem_amount, $price_slot_trans_ID, $trans_type)";

//$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11b Account' queryb");

}

function markFreebies($link_id, $coin_type){
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".WRITER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

//freebie needs to be set 0 for free, 1 for test net and 2 for bitcoin

if($coin_type == 'free'){
$new_status = 0;
}
elseif($coin_type == 'testnet'|| $coin_type == 'testcoin'){ //got confused with naming convention use either/both equally
$new_status = 1;
}
else
{
$new_status = 2;
}
$sql = "UPDATE `links` set `freebie` = '".$new_status."' where `id`= '". $link_id."'";

$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 10 Account' query");
return true;
}

function howManyRadiosFree($category, $link_id){
//this function is missing check  when users current is not equal to one of offered prices (i.e. the price went up/down since they bought it). Something like that need to be added as special admin page. It will have to update every current paid link. Select all freebies and update their amounts and email their users. At end of billing cycle, if no funds or authorization renewed they lose seniority. Probably won't/shouldn't change prices of GEN often as a result of them having to re-authorize ... or, have as part of the registration get their permission to raise or lower a certain percent w/o needing reauthorization

$get_info = new price_slot_info;

$top_bought_price_array = $get_info->getTopBoughtPriceSlot($category);
//returns $bid_info = array($id, $price_slot_amnt, $user_id, $link_id, $count);
//array = $id, $price_slot_amnt, $user_id, $link_id
//[0] => [1] => 1.20 [2] => 2 [3] => 2523 [4] =>
$top_buyer_id = $top_bought_price_array[0];
$top_buyer_price_amnt = $top_bought_price_array[1];
$top_buyer_user_id = $top_bought_price_array[2];
$top_buyer_link_id = $top_bought_price_array[3];
$count_of_top_links = $get_info->getCountBoughtSlots($category);
if($top_buyer_price_amnt == $base_price)
{
$top_buyer_num_of_slots = 1;
}
else
{
//does the count of links matter? should return them just to post to table data
$top_buyer_num_of_slots = (log10($top_buyer_price_amnt)-log10($base_price))/log10(1+$adj_factor);
$top_buyer_num_of_slots = round($top_buyer_num_of_slots);
$top_buyer_num_of_slots = $top_buyer_num_of_slots +1;
}
return array($top_buyer_num_of_slots,$count_of_top_links);
}

function howManyRadiosPaid($category, $link_id, $coin_type){

$get_info = new price_slot_info;
$price_slot_info_array = $get_info->getBasePrice();
//id 	is_active 	base_price 	adj_factor 	total_slots 	t_timestamp 
$this_users_last_bought = $get_info->getThisUsersLastBoughtPriceSlot($category, $link_id);
//array = $id, $user_id, $price_slot_amnt
$this_users_id = $this_users_last_bought[0];
$this_users_user_id = $this_users_last_bought[1];
$this_users_price_amnt = $this_users_last_bought[2];
$top_bought_price_array = $get_info->getTopBoughtPriceSlot($category);
$top_buyer_id = $top_bought_price_array[0];
$top_buyer_price_amnt = $top_bought_price_array[1];
$top_buyer_user_id = $top_bought_price_array[2];
$top_buyer_link_id = $top_bought_price_array[3];
$count_of_top_links = $get_info->getCountBoughtSlots($category, $coin_type);

if($adj_factor==""|| $adj_factor==0){
echo '<h2 style="color:red;">adj_factor is empty - there must not be an entry for this category in getBasePrice table', $category;
echo ' which will throw division by zero errors</h2>';
}

$top_buyer_num_of_pages = (log10(intval($top_buyer_price_amnt))-log10($base_price))/log10(1+$adj_factor);
$top_buyer_num_of_pages = round($top_buyer_num_of_pages);
$this_users_num_of_pages = (log10(intval($this_users_price_amnt))-log10($base_price))/log10(1+$adj_factor);
$this_users_num_of_pages = round($this_users_num_of_pages);
$top_buyer_num_of_pages = $top_buyer_num_of_pages +1;
$this_users_num_of_pages = $this_users_num_of_pages +1;
return array($top_buyer_num_of_pages, $this_users_num_of_pages, $count_of_top_links, $top_buyer_link_id);
}

function getCountBoughtSlots($cat_id, $coin_type){
//doesn't seem to be used anywhere
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

if($coin_type == "free"){
$sql = "SELECT count(`user_id`) as `count` 
FROM `price_slots_subscripts`
WHERE `cat_id` = '$cat_id'
AND `subscribe` = '1'
GROUP BY `subscribe` ";
}
else
{
$sql = "SELECT count(`user_id`) as `count` 
FROM `price_slots_subscripts`
WHERE `cat_id` = '$cat_id'
AND `subscribe` = '1' AND `coin_type`= '$coin_type'
GROUP BY `subscribe` ";
}
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11c Account' query");
$row="";
$count="";
 while($row = mysqli_fetch_array($result)){
$count	= $row['count'];
}
return $count;
}


function getUsersTopBoughtSpot($cat_id, $user_id){
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");


//
$sql = "SELECT `id` , `link_id`, max( price_slot_amnt ) AS price_slot_amnt
FROM `price_slots_subscripts`
WHERE `cat_id` = '$cat_id'
AND `subscribe` ='1'
AND `user_id` = '$user_id'
GROUP BY `user_id`";
//while this does "max" and "group by" there should only be one active spot per user per cat
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11d4 Account' query");
$row="";
$id="";
$price_slot_amnt="";
$link_id="";
 while($row = mysqli_fetch_array($result)){
$id	= $row['id'];
$price_slot_amnt 	= $row['price_slot_amnt'];
$link_id	= $row['link_id'];
};
$bid_info = array($id, $price_slot_amnt, $link_id);
return $bid_info;
}

function getTopBoughtPriceSlot($cat_id){
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

//will return the top bid amount, the top bidders link id and the total count of links in the top slot. Does not take seniority into account - should I add that functionality here? This user id, link id etc may be tied for top. It would need order by START DATE (not this tables timeslot which is update-entry  time) and limit one

$sql = "SELECT `id`, `user_id` , `link_id` , `price_slot_amnt`, `t_timestamp`
FROM `price_slots_subscripts`
WHERE `cat_id` = '$cat_id'
AND `subscribe` = '1'
AND `price_slot_amnt` = (
SELECT max( `price_slot_amnt` ) AS `price_slot_amnt`
FROM `price_slots_subscripts`
WHERE `cat_id` = '$cat_id'
AND `subscribe` = '1'
GROUP BY `subscribe` ) ORDER BY `id` ASC LIMIT 1";
$row = "";
$id = "";
$user_id = "";
$price_slot_amnt = "";
$link_id = "";
if(
$result = mysqli_query($connect, $sql)){
 while($row = mysqli_fetch_array($result)){
$id	= $row['id'];
$user_id	= $row['user_id'];
$price_slot_amnt 	= $row['price_slot_amnt'];
$link_id	= $row['link_id'];
};
$bid_info = array($id, $price_slot_amnt, $user_id, $link_id);
return $bid_info;
}
else
{
return false;
}
}


function getUsersTopPaidSlot($category, $link_id){
//isn't category unnecessary if looking by link_id? Copy this and make same sans category for use in modify price slot first form
//this is a near copy of next function 
// changed select from subscribe = 1 to greater than 1 to pick up multi coin and return subscribe value to identify coin type
//Originally used in all the "get_by_placement_testcoin.php' pages to color price slot backgrounds
//added and timestamp =(select max(timestamp from `price_slots_subscripts`) to make sure it is the last and not the highest
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

$sql = "SELECT `id` , `user_id` , max( price_slot_amnt ) AS price_slot_amnt, `coin_type` FROM `price_slots_subscripts` WHERE `cat_id` = '$category' AND `subscribe` >0 AND `link_id` = '$link_id' GROUP BY `link_id`";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 12c Account' query");
$row = "";
$id = "";
$user_id = "";
$price_slot_amnt = "";
$subscribe = "";
$coin_type	 = "";
 while($row = mysqli_fetch_array($result)){
$id	= $row['id'];
$user_id	= $row['user_id'];
$price_slot_amnt = $row['price_slot_amnt'];
$subscribe = $row['subscribe'];
$coin_type = $row['coin_type'];
};
$bid_info = array($id, $user_id, $price_slot_amnt, $subscribe, $coin_type);
return $bid_info;
}






function getThisUsersLastBoughtPriceSlot($category, $link_id){
//added and timestamp =(select max(timestamp from `price_slots_subscripts`) to make sure it is the last and not the highest
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

$sql = "SELECT `id` , `user_id` , max( price_slot_amnt ) AS price_slot_amnt FROM `price_slots_subscripts` WHERE `cat_id` = '$category' AND `subscribe` = '1' AND `link_id` = '$link_id' GROUP BY `link_id`";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 12c Account' query");
$row = "";
$id = "";
$user_id = "";
$price_slot_amnt = "";

 while($row = mysqli_fetch_array($result)){
$id	= $row['id'];
$user_id	= $row['user_id'];
$price_slot_amnt = $row['price_slot_amnt'];
};
$bid_info = array($id, $user_id, $price_slot_amnt);
return $bid_info;
}




function getCatname($cat_id){
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

              	$query = "SELECT `name` FROM `categories` WHERE `id` = '$cat_id' ";
                $result = mysqli_query($connect, $query);
                if($result){
		 while($row = mysqli_fetch_array($result))
		 { $name = $row['name'];
              	}
              	return $name;
		}
		else
		{
		return false;
              }
	}
}
