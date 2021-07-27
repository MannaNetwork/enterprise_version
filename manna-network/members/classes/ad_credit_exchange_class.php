<?PHP
class adCreditExchange {

function add_depofo($number, $name){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2adexconfiga.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/pdo_connect.php");
date_default_timezone_set('America/New_York');
$time = date('Y-m-d H:i:s');	
$stmt = $db->prepare("INSERT INTO `depofo`(timestampInit,number,name) VALUES (:time,:number,:name)");
$stmt->execute(array(':time' => $time, ':number' => $number, ':name' => $name));
$insertId = $db->lastInsertId();
return $insertId;
  }

function add_counteroffer($listing_id, $byr_or_sllr, $offerers_user_id, $timestampInit, $qauntity, $price, $buyertimelimit, $sellertimelimit,  $user_ip)
{
//$ipaddress = $_SERVER['REMOTE_ADDR'];
$pipaddress = getenv('HTTP_X_FORWARDED_FOR');
			$ipaddress = getenv('REMOTE_ADDR');
//$db_conf_file = "db2adexconfiga.php";
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2adexconfiga.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/pdo_connect.php");
date_default_timezone_set('America/New_York');
$time = date('Y-m-d H:i:s');	
$stmt = $db->prepare("INSERT INTO `counteroffers`(listing_id, byr_or_sllr, offerers_user_id, timestampInit, qauntity, price, buyertimelimit, sellertimelimit,sellersIP) VALUES(:listing_id,:byr_or_sllr,:offerers_user_id,:timestampInit,:qauntity,:price,:buyertimelimit,:sellertimelimit,:ipaddress)");
$stmt->execute(array(':listing_id' => $listing_id,':byr_or_sllr' => $byr_or_sllr,':offerers_user_id' => $offerers_user_id,':timestampInit' => $timestampInit,':qauntity' => $qauntity,':price' => $price,':buyertimelimit' => $buyertimelimit,':sellertimelimit' => $sellertimelimit, ':ipaddress' => $ipaddress));
$affected_rows = $stmt->rowCount();
$insertId = $db->lastInsertId();
  }

function add_listing($quantity, $price, $market_order, $currency, $buyertimelimit, $sellertimelimit, $status,  $textarea, $bank_name, $bank_depofo, $user_id_seller,  $user_ip)
{
//$ipaddress = $_SERVER['REMOTE_ADDR'];
$pipaddress = getenv('HTTP_X_FORWARDED_FOR');
			$ipaddress = getenv('REMOTE_ADDR');
//$db_conf_file = "db2adexconfiga.php";
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2adexconfiga.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/pdo_connect.php");
date_default_timezone_set('America/New_York');
$time = date('Y-m-d H:i:s');	
$stmt = $db->prepare("INSERT INTO `listings`(timestampInit,quantity,price,market_order, currency,bank_name,bank_depofo,buyertimelimit,sellertimelimit,status,textarea,sellerid,sellersIP) VALUES(:time,:quantity,:price,:market_order,:currency,:bank_name,:bank_depofo,:buyertimelimit,:sellertimelimit,:status,:textarea,:sellerid,:ipaddress)");
$stmt->execute(array(':time' => $time, ':quantity' => $quantity, ':price' => $price, ':market_order' => $market_order, ':currency' => $currency, ':bank_name' => $bank_name, ':bank_depofo' => $bank_depofo, ':buyertimelimit' => $buyertimelimit, ':sellertimelimit' => $sellertimelimit, ':status' => $status, ':textarea' => $textarea, ':sellerid' => $user_id_seller, ':ipaddress' => $ipaddress));
$affected_rows = $stmt->rowCount();
$insertId = $db->lastInsertId();
  }

function buy_listing($user_id, $offer_id)
{
// update timestampBuyerin, buyerid, status
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2adexconfiga.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/pdo_connect.php");
date_default_timezone_set('America/New_York');
$time = date('Y-m-d H:i:s');
$stmt = $db->prepare("UPDATE listings SET timestampBuyerin=?, buyerid=?, status=?  WHERE id=$offer_id ");
$stmt->execute(array($time, $user_id, 'accepted'));
$affected_rows = $stmt->rowCount();
}

function cancel_buy_listing($buyerid, $offer_id)
{
// update timestampBuyerin, buyerid, status
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2adexconfiga.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/pdo_connect.php");
$stmt = $db->prepare("UPDATE listings SET timestampBuyerin=?, timestampBuyerReport=?, buyerid=?, status=?  WHERE id=$offer_id ");
$myNull = null;
$stmt->execute(array($myNull, $myNull, $myNull, 'offered'));
$affected_rows = $stmt->rowCount();
}


function check_balance($user_id, $status){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2adexconfiga.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/pdo_connect.php");
//first check for status "offered" and get the sum
//then check for the status "accepted"
//the offerred sum can be presented as "reversable" or "cancellable" if/when a user tries to buy credits with them locked up
//the accepted balance can't be cancelled
//the balance in members/index could be presented twice, with offered being in yellow and accepted being in green
// yellow could have an asterisk (*) saying * Balance in yellow only available if your "offered" credits removed from market

$rs = $db->prepare('SELECT SUM(quantity) FROM `listings` WHERE sellerid=:sellerid AND status=:status');
          $rs->bindParam(':sellerid', $user_id); 
          $rs->bindParam(':status', $status); 
          $rs->execute();
         $sumRows = $rs->fetchColumn(); 
return $sumRows;
}

function countbyseller($user_id){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2adexconfiga.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/pdo_connect.php");
$stmt = $db->prepare("SELECT * FROM `listings` WHERE sellerid=:sellerid");
$stmt->execute(array(':sellerid' => $user_id));
$row_count = $stmt->rowCount();
return $row_count;
}

function delete_depofo($depofo){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2adexconfiga.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/pdo_connect.php");
$stmt = $db->prepare("DELETE FROM depofo WHERE id=:id");
$stmt->bindValue(':id', $depofo, PDO::PARAM_STR);
$stmt->execute();
} 

function delete_listing($user_id, $offer_id)
{

// update timestampBuyerin, buyerid, status
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2adexconfiga.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/pdo_connect.php");
$stmt = $db->prepare("DELETE FROM listings WHERE id=:id");
$stmt->bindValue(':id', $offer_id, PDO::PARAM_STR);
$stmt->execute();
}
 
function getUsersBungeeBankBalance($user_id){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2adexconfiga.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/pdo_connect.php");

$stmt = $db->prepare("Select * from `BungeeBank_balance` where `BB_user_ID`=?");
$stmt->execute(array($user_id));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $rows;
}

function getUsersPriceSlotBalance($user_id){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfiga.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/pdo_connect.php");
try {
    $db->beginTransaction();
$stmt = $db->prepare("SELECT * 
FROM `price_slot_day_ledger`
WHERE user_id=?
ORDER BY `id` DESC
LIMIT 1 ");
$stmt->execute(array($user_id));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $rows;
 $db->commit();
} catch(PDOException $ex) {
    //Something went wrong rollback!
    $db->rollBack();
    echo $ex->getMessage();
}


}


function transfer_credits($buyer_user_id, $seller_user_id, $listing_id, $quantity)
{
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfiga.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/pdo_connect.php");
//getUsersBungeeBankBalance($user_id){
//getUsersPriceSlotBalance($user_id){
try {
    $db->beginTransaction();
 
      $stmt = $db->prepare("SELECT * 
FROM `price_slot_day_ledger`
WHERE user_id=?
ORDER BY `id` DESC
LIMIT 1");
    $stmt->execute(array($buyer_user_id));

$stmt = $db->prepare("SELECT * 
FROM `price_slot_day_ledger`
WHERE user_id=?
ORDER BY `id` DESC
LIMIT 1");
    $stmt->execute(array($buyer_user_id));


 
    $stmt = $db->prepare("YET ANOTHER QUERY??");
    $stmt->execute(array($value2, $value3));
 
    $db->commit();
} catch(PDOException $ex) {
    //Something went wrong rollback!
    $db->rollBack();
    echo $ex->getMessage();
}


}

function getUsersEmail($user_id){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2accusersconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$query = "Select `user_email` from `users` where `user_id`='$user_id'"; 
$result = mysqli_query($connect, $query)or die("<p align='left'>Bold query3 "); 
 while ($row = mysqli_fetch_array($result)) 
 {
 $user_email = $row['user_email'];
}
	return $user_email;
}

function get_depofo_numbers($user_id, $listing_id){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2adexconfiga.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/pdo_connect.php");
$stmt = $db->prepare("SELECT bank_depofo FROM `listings` WHERE sellerid=? and bank_depofo > 0");
$stmt->execute(array($user_id));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $rows;
}

function is_listing_expired($buyer_accepted_offer_at, $buyer_time_limit){


date_default_timezone_set('America/New_York');

$buyer_time_limit = "PT".intval($buyer_time_limit)."M";
$buyers_deadline = new DateTime($buyer_accepted_offer_at);
$buyers_deadline->add(new DateInterval($buyer_time_limit));
$buyers_deadline = $buyers_deadline->format("Y-m-d H:i:s");//result: 2010/08/24 08:15:00
$buyers_deadline_unix = strtotime($buyers_deadline);
$nowtime =time();

if($nowtime < $buyers_deadline_unix){
$return_array = array('no', $buyers_deadline);
return $return_array;
}
elseif($nowtime > $buyers_deadline_unix){
$return_array = array('yes', $buyers_deadline);
return $return_array;
}
}


function move_buyer($user_id, $listing_id, $reason, $agent){
//this function badly named - should be copy expired rather than move
//copies the row that expired to expired table as a record
//then other function removes buyer data from orinial listing

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2adexconfiga.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/pdo_connect.php");
$stmt = $db->prepare("SELECT * FROM `listings` WHERE id=?");
$stmt->execute(array($listing_id));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
date_default_timezone_set('America/New_York');
$expire_time_trans = date('Y-m-d H:i:s');
foreach($rows as $key=>$value){
foreach($value as $key=>$value2){
}
}//close foreach


if($reason=="expired"){
$stmt = $db->prepare("INSERT INTO `expiredlistings`(orig_id,expire_time_trans,timestampInit,timestampBuyerin,timestampTrans, transAgent,quantity,price,market_order, currency,bank_name,bank_depofo,buyertimelimit,sellertimelimit,status,textarea,sellerid,buyerid,sellersIP) VALUES(:orig_id, :expire_time_trans, :timestampInit,:timestampBuyerin,:timestampTrans,:transAgent,:quantity,:price,:market_order,:currency,:bank_name,:bank_depofo,:buyertimelimit,:sellertimelimit,:status,:textarea,:sellerid,:buyerid,:sellersIP)");
$stmt->execute(array(':orig_id' => $listing_id, ':expire_time_trans' => $expire_time_trans, ':timestampInit' => $value[timestampInit],':timestampBuyerin' => $value[timestampBuyerin],':timestampTrans' => $expire_time_trans, ':transAgent' => $agent,':quantity' => $value[quantity], ':price' => $value[price], ':market_order' => $value[market_order], ':currency' => $value[currency], ':bank_name' => $value[bank_name], ':bank_depofo' => $bank_depofo, ':buyertimelimit' => $value[buyertimelimit], ':sellertimelimit' => $value[sellertimelimit], ':status' => $value[status], ':textarea' => $value[textarea], ':sellerid' => $value[sellerid], ':buyerid' => $value[buyerid], ':sellersIP' => $value[sellersIP]));
}
elseif($reason=="sold"){

$stmt = $db->prepare("INSERT INTO `soldlistings`(orig_id,timestampInit,timestampBuyerin,timestampTrans, transAgent,quantity,price,market_order, currency,bank_name,bank_depofo,buyertimelimit,sellertimelimit,status,textarea,sellerid,buyerid,sellersIP) VALUES(:orig_id,  :timestampInit,:timestampBuyerin,:timestampTrans, :transAgent,:quantity,:price,:market_order,:currency,:bank_name,:bank_depofo,:buyertimelimit,:sellertimelimit,:status,:textarea,:sellerid,:buyerid,:sellersIP)");
$stmt->execute(array(':orig_id' => $listing_id,  ':timestampInit' => $value[timestampInit],':timestampBuyerin' => $value[timestampBuyerin],':timestampTrans' => $expire_time_trans, ':transAgent' => $agent,':quantity' => $value[quantity], ':price' => $value[price], ':market_order' => $value[market_order], ':currency' => $value[currency], ':bank_name' => $value[bank_name], ':bank_depofo' => $bank_depofo, ':buyertimelimit' => $value[buyertimelimit], ':sellertimelimit' => $value[sellertimelimit], ':status' => $value[status], ':textarea' => $value[textarea], ':sellerid' => $value[sellerid], ':buyerid' => $value[buyerid], ':sellersIP' => $value[sellersIP]));
}
}






function update_depofo($depofo, $encrypted, $encrypted2){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2adexconfiga.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/pdo_connect.php");
$stmt = $db->prepare("UPDATE depofo SET number=?, name=?  WHERE id=?");
$stmt->execute(array($encrypted, $encrypted2, $depofo));
$affected_rows = $stmt->rowCount();
} 


function update_listing($listing_id, $quantity, $price, $market_order, $currency, $buyertimelimit, $sellertimelimit, $status,  $textarea, $bank_name, $bank_depofo, $user_id_seller,  $user_ip)
{
//$ipaddress = $_SERVER['REMOTE_ADDR'];
$pipaddress = getenv('HTTP_X_FORWARDED_FOR');
$ipaddress = getenv('REMOTE_ADDR');
//$db_conf_file = "db2adexconfiga.php";
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2adexconfiga.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/pdo_connect.php");
date_default_timezone_set('America/New_York');
$time = date('Y-m-d H:i:s');	
$stmt = $db->prepare("UPDATE `listings`(timestampInit,quantity,price,market_order, currency,bank_name,bank_depofo,buyertimelimit,sellertimelimit,status,textarea,sellerid,sellersIP) VALUES(:time,:quantity,:price,:market_order,:currency,:bank_name,:bank_depofo,:buyertimelimit,:sellertimelimit,:status,:textarea,:sellerid,:ipaddress)");
$stmt->execute(array(':time' => $time, ':quantity' => $quantity, ':price' => $price, ':market_order' => $market_order, ':currency' => $currency, ':bank_name' => $bank_name, ':bank_depofo' => $bank_depofo, ':buyertimelimit' => $buyertimelimit, ':sellertimelimit' => $sellertimelimit, ':status' => $status, ':textarea' => $textarea, ':sellerid' => $user_id_seller, ':ipaddress' => $ipaddress));
$affected_rows = $stmt->rowCount();
$insertId = $db->lastInsertId();
  }


function update_listing_status($listing_id, $status){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2adexconfiga.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/pdo_connect.php");
date_default_timezone_set('America/New_York');
$time = date('Y-m-d H:i:s');	

$stmt = $db->prepare("UPDATE `listings` SET timestampBuyerReport=?, status=? WHERE id=?");
$stmt->execute(array($time,$status, $listing_id));
$affected_rows = $stmt->rowCount();
}



function update_listing_transfer($listing_id, $status, $trans_agent){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2adexconfiga.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/pdo_connect.php");



date_default_timezone_set('America/New_York');
$time = date('Y-m-d H:i:s');	

$stmt = $db->prepare("UPDATE `listings` SET timestampTrans=?, status=?, transAgent=? WHERE id=?");
$stmt->execute(array($time, $status, $trans_agent, $listing_id));
$affected_rows = $stmt->rowCount();
}


function viewbylisting($listing_id){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2adexconfiga.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/pdo_connect.php");
$stmt = $db->prepare("SELECT * FROM `listings` WHERE id=?");
$stmt->execute(array($listing_id));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $rows;
}

function viewbybuyer($user_id, $status){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2adexconfiga.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/pdo_connect.php");

if($user_id !=""){
$stmt = $db->prepare("SELECT * FROM `listings` WHERE buyerid=:buyerid AND status=:status");
$stmt->execute(array(':buyerid' => $user_id, ':status' => $status));
}
else
{
	if($status=="all"){
	$stmt = $db->prepare("SELECT * FROM `listings`");
	$stmt->execute();
	}
	else
	{
	$stmt = $db->prepare("SELECT * FROM `listings` WHERE status=:status");
	$stmt->execute(array(':status' => $status));
	}
}

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$row_count = $stmt->rowCount();

return $rows;
}


function viewbyseller($user_id, $status){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2adexconfiga.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/pdo_connect.php");
if($user_id !=""){
$stmt = $db->prepare("SELECT * FROM `listings` WHERE sellerid=:sellerid AND status=:status");
$stmt->execute(array(':sellerid' => $user_id, ':status' => $status));

}
else
{
	if($status=="all"){
	$stmt = $db->prepare("SELECT * FROM `listings`");
	$stmt->execute();
	}
	else
	{
	$stmt = $db->prepare("SELECT * FROM `listings` WHERE status=:status");
	$stmt->execute(array(':status' => $status));
	}
}

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

//$row_count = $stmt->rowCount();
//echo 'row count = ', $row_count;
return $rows;
}

function viewbystatus($status){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2adexconfiga.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/pdo_connect.php");
$stmt = $db->prepare("SELECT * FROM `listings` WHERE status=?");
$stmt->execute(array($status));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $rows;
}

function view_depofo($id){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2adexconfiga.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/pdo_connect.php");
$stmt = $db->prepare("SELECT * FROM `depofo`WHERE id=:id ");
$stmt->execute(array(':id' => $id));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $rows;
  }



}
