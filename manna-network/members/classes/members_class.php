<?php 
 class members_info 
{

function displayBlockFree($user_id){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network.
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php'); 
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

$sql = "SELECT * FROM links WHERE MN_user_id='$user_id'&& freebie='0'  ORDER BY `start_date` ASC";
$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 2 Account' query");
$row=""; 
$num_rows_free = "";
$db_idf = "";
$db_categoryf = "";
$db_urlf = "";
$db_descriptionf = "";
$db_namef =  "";
$db_start_datef =  "";
$db_approvedf =  ""; 
while ($row = mysqli_fetch_array($result)){
$db_idf[] = $row['id'];
$db_categoryf[] = $row['category'];
$db_urlf[] = $row['url'];
$db_descriptionf[] = $row['description'];
$db_start_datef[] = $row['start_date'];
$db_approvedf[] = $row['approved'];
$db_namef[] = $row['name'];
}
$num_rows_free = mysqli_num_rows(mysqli_query($connect, $sql));

$displayBlockFree = array($num_rows_free, $db_idf,$db_categoryf, $db_urlf, $db_descriptionf, $db_namef,  $db_start_datef, $db_approvedf); 
return $displayBlockFree;
}


function displayBlockPaid($user_id){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

$sql = "SELECT * FROM links WHERE MN_user_id='$user_id'&& freebie = '2' ORDER BY `start_date` ASC";
$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 1 Account' query");
$row="";
$num_rows_paid = "";
$db_idp = "";
$db_categoryp = "";
$db_urlp = "";
$db_descriptionp = "";
$db_namep =  "";
$db_start_datep =  "";
$db_approvedp =  ""; 
$db_start_clone_datep  =  ""; 
$db_freebiep =  ""; 
while ($row = mysqli_fetch_array($result)){
$db_idp[] = $row['id'];
$db_categoryp[] = $row['category'];
$db_freebiep[] = $row['freebie'];
$db_urlp[] = $row['url'];
$db_descriptionp[] = $row['description'];
$db_approvedp[] = $row['approved'];
$db_namep[] = $row['name'];
$db_start_datep[] = $row['start_date'];
}
$num_rows_paid = mysqli_num_rows(mysqli_query($connect, $sql));
$displayBlockPaid = array($num_rows_paid, $db_idp,$db_categoryp, $db_freebiep, $db_urlp, $db_descriptionp,  $db_start_clone_datep, $db_approvedp, $db_namep,$db_start_datep); 
return $displayBlockPaid;
}

function displayBlockTestNet($user_id){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

$sql = "SELECT * FROM links WHERE MN_user_id='$user_id'&& freebie = '1'  ORDER BY `start_date` ASC";

$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 1 Account' query");
$row=""; 
$num_rows_testnet = "";
$db_idtn = "";
$db_categorytn = "";
$db_urltn = "";
$db_descriptiontn = "";
$db_nametn =  "";
$db_start_datetn =  "";
$db_approvedtn =  ""; 
$db_start_clone_datetn  =  ""; 
$db_freebietn =  ""; 
do{
$db_idtn[] = $row['id'];
$db_categorytn[] = $row['category'];
$db_freebietn[] = $row['freebie'];
$db_urltn[] = $row['url'];
$db_descriptiontn[] = $row['description'];

$db_approvedtn[] = $row['approved'];
$db_nametn[] = $row['name'];
$db_start_datetn[] = $row['start_date'];
}
while ($row = mysqli_fetch_array($result));
$num_rows_testnet = mysqli_num_rows(mysqli_query($connect, $sql));
$displayBlockTestNet = array($num_rows_testnet, $db_idtn,$db_categorytn, $db_freebietn, $db_urltn, $db_descriptiontn,  $db_start_clone_datetn, $db_approvedtn, $db_nametn,$db_start_datetn); 
return $displayBlockTestNet;
}

function getCoinMarketCap($lowest_monthly_bid_in_dollars){

$coinmarketcap_string = file_get_contents('https://api.coinmarketcap.com/v1/ticker/?start=3&limit=1');
$pieces = explode(",", $coinmarketcap_string);
	if (strpos($pieces[0], '"id": "bitcoin-cash"') !== false AND strpos($pieces[2], '"symbol": "BCH"')) {
	$pieces2 = explode(":", $pieces[4]);
	$bitcoin_cash_price = str_replace('"', "", $pieces2[1]);
	$target_bch_of_first_price_slot = $lowest_monthly_bid_in_dollars/$bitcoin_cash_price;
	//$adj_factor = .5;
$adj_factor = 1.61803398875;
//the Golden Ration is 1.61803398875 and is now used to create the price slots so probably the adj factor can be the same as the Golden Ratio
	$amount_bch_as_gift = 100/$bitcoin_cash_price;
	/* this log finds the number of prie slots under the top bidder
	$top_buyer_price_amnt = 57.665039062;
	$base_price = 1;
	$top_buyer_num_of_slots = (log10($top_buyer_price_amnt)-log10($base_price))/log10(1+$adj_factor);
	echo '<br>$top_buyer_num_of_slots = ', $top_buyer_num_of_slots;
	$top_buyer_num_of_slots = round($top_buyer_num_of_slots);
	echo '<br>$top_buyer_num_of_slots = ', $top_buyer_num_of_slots;
	$top_buyer_num_of_slots = $top_buyer_num_of_slots +1;
	echo '<br>$top_buyer_num_of_slots = ', $top_buyer_num_of_slots;
	*/
	$previous = .00000001;
		for($i=0;$i<=55;$i++){
		//$new_price_slot = $previous + ($previous *.5) ;
// changing this to the golden ratio 1.61803398875
$new_price_slot = $previous + ($previous * 1.61803398875) ;
			if($new_price_slot < $target_bch_of_first_price_slot){
			$previous=$new_price_slot;
			}
			else
			{
			return array($new_price_slot, $amount_bch_as_gift);
			}
		}
	}
	else
	{
	return '<h1>Did not get proper data </h1>';
	}
}

function getNumRowsDemoPaid($cat_id){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

$stmt = $mysqli->prepare("SELECT * FROM price_slots_subscripts WHERE cat_id = ?  and subscribe = 1");
$stmt->bind_param('i', $cat_id);
$result = $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failure.
$stmt->store_result(); //store_result() "binds" the last given answer to the statement-object for... reasons. Now we can use it!

return $stmt->num_rows ;
}

function getNumRowsBCHPaid($cat_id){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

$stmt = $mysqli->prepare("SELECT * FROM price_slots_subscripts WHERE cat_id = ?  and subscribe = 2");
$stmt->bind_param('i', $cat_id);
$result = $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failure.
$stmt->store_result(); //store_result() "binds" the last given answer to the statement-object for... reasons. Now we can use it!

return $stmt->num_rows ;
}

function getNumRowsFree($cat_id){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

$stmt = $mysqli->prepare("SELECT * FROM categories WHERE id = ?");
	$stmt->bind_param("i", $cat_id);
	$stmt->execute();
	$result = $stmt->get_result();
	return $result->num_rows;
}

function getHighestBCHPriceSlotPaid($cat_id){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

$stmt = $mysqli->prepare("SELECT * FROM price_slots_subscripts WHERE `cat_id` = ? AND `subscribe` = 2 ORDER by price_slot_amnt DESC LIMIT 1");

						$stmt->bind_param("i", $cat_id);
						$stmt->execute();
						$result = $stmt->get_result();
if($result->num_rows === 0) $highest_price_slot_amnt = 0;
							while($row = $result->fetch_assoc()) {
							$highest_price_slot_amnt	= $row['price_slot_amnt'];
						}
return $highest_price_slot_amnt;
}

function getLowestBCHPriceSlotPaid($cat_id){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

$stmt = $mysqli->prepare("SELECT * FROM price_slots_subscripts WHERE `cat_id` = ? AND `subscribe` = 2 ORDER by price_slot_amnt ASC LIMIT 1");

						$stmt->bind_param("i", $cat_id);
						$stmt->execute();
						$result = $stmt->get_result();
if($result->num_rows === 0)  $lowest_price_slot_amnt = 0;
							while($row = $result->fetch_assoc()) {
							$lowest_price_slot_amnt	= $row['price_slot_amnt'];
						}
return $lowest_price_slot_amnt;
}

function getHighestDemoPriceSlotPaid($cat_id){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

$stmt = $mysqli->prepare("SELECT * FROM price_slots_subscripts WHERE `cat_id` = ? AND `subscribe` = 1 ORDER by price_slot_amnt DESC LIMIT 1");

						$stmt->bind_param("i", $cat_id);
						$stmt->execute();
						$result = $stmt->get_result();
if($result->num_rows === 0)  $highest_price_slot_amnt = 0;
							while($row = $result->fetch_assoc()) {
							$highest_price_slot_amnt	= $row['price_slot_amnt'];
						}
return $highest_price_slot_amnt;
}

function getLowestDemoPriceSlotPaid($cat_id){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

$stmt = $mysqli->prepare("SELECT * FROM price_slots_subscripts WHERE `cat_id` = ? AND `subscribe` = 1 ORDER by price_slot_amnt ASC LIMIT 1");

						$stmt->bind_param("i", $cat_id);
						$stmt->execute();
						$result = $stmt->get_result();
if($result->num_rows === 0)  $lowest_price_slot_amnt = 0;
							while($row = $result->fetch_assoc()) {
							$lowest_price_slot_amnt	= $row['price_slot_amnt'];
						}
return $lowest_price_slot_amnt;
}






}
