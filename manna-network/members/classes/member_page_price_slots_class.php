
<?php

echo '<br> in member_price_slot_info (extends)';
class member_price_slot_info extends member_info {
    var $step;

function getThisLinksRegionalInfo($link_id, $agent_ID){
if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/mysqli_connect.php");
//`regional_sign_ups` (`id`, `continent`, `country`, `state`, `district1`, `city`, `district2`, `link_id`)
//| id | continent | country | state | district1 | city | district2 | street | link_id | cat_id |
$sql = "SELECT *
FROM `regional_sign_ups`
WHERE `link_id` = '$link_id' AND `agent_ID`= '$agent_ID' ";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 11b Account' query");
if ($result->num_rows > 0) {
 while($row = mysqli_fetch_assoc($result)){
$id = $row['id'];
$continent = $row['continent']; 
 $country  = $row['country'];  
$state = $row['state']; 
 $district1 = $row['district1'];  
$city = $row['city']; 
 $district2 = $row['district2']; 
$agent_ID = $row['agent_ID'];
}
$send_array = array($id,$continent,$country,$state,$district1,$city,$district2,$agent_ID );
return $send_array;
}
else
{
return false;
}
}



function getRegionalInfo($link_id, $agent_ID){
if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/mysqli_connect.php");
//`regional_sign_ups` (`id`, `continent`, `country`, `state`, `district1`, `city`, `district2`, `link_id`)
//| id | continent | country | state | district1 | city | district2 | street | link_id | cat_id |
$sql = "SELECT *
FROM `regional_sign_ups`
WHERE `link_id` = '$link_id' AND `agent_ID` = '$agent_ID'";

$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 11b Account' query");
if ($result->num_rows > 0) {
 while($row = mysqli_fetch_assoc($result)){
$id = $row['id'];
$continent = $row['continent']; 
 $country  = $row['country'];  
$state = $row['state']; 
 $district1 = $row['district1'];  
$city = $row['city']; 
 $district2 = $row['district2']; 
$agent_ID = $row['agent_ID'];
}
$send_array = array($id,$continent,$country,$state,$district1,$city,$district2,$agent_ID );
return $send_array;
}
else
{
return false;
}
}


function getRegionalPopulation($link_id, $agent_ID){
if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/mysqli_connect.php");
//`regional_sign_ups` (`id`, `continent`, `country`, `state`, `district1`, `city`, `district2`, `link_id`)
$sql = "SELECT *
FROM `regional_sign_ups`
WHERE `link_id` = '$link_id' ";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 11b Account' query");
if ($result->num_rows > 0) {
 while($row = mysqli_fetch_row($result)){
$id = $row['id'];
return $id;
}
}
else
{
return false;
}
}
  
 function sendBuyToCentral2bd ($user_id, $agents_ID, $link_id, $price, $cat_id, $coin_type){
 //marked for deletion
//now send user registration to central 
$file="http://manna-network.cash/incoming/buy.php";
$args = array(
'user_id' => $user_id,
'agents_ID' => $agents_ID,
'cat_id' => $cat_id,
'link_id' => $link_id,
'price' => $price,
'coin_type' => $coin_type);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
//curl_setopt($ch, CURLOPT_POSTFIELDS, array('locus_array' => $locus_array,'link_record_num' => $link_record_num,'link_page_total' => $link_page_total, 'link_page_id' => $link_page_id, 'pagem_url_cat' => $pagem_url_cat,'link_page_num' => $link_page_num, 'cat_page_num' => $cat_page_num, 'url_cat' => $url_cat, 'affiliate_num' => $affiliate_num  ));
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
echo($data);

}

function getPriceSlotPopulation($cat_id, $coin_type, $price_slot_amount){
if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/mysqli_connect.php");
$sql = "SELECT *
FROM `price_slots_subscripts`
WHERE `cat_id` = '$cat_id'
AND `coin_type` = '$coin_type'
AND `price_slot_amnt` = $price_slot_amount";
  if ($result = mysqli_query($mysqli,$sql)) {
    /* determine number of rows result set */
    $row_cnt = mysqli_num_rows($result);
	if($row_cnt == 1){
	unset($link_id);
	 while($row = mysqli_fetch_assoc($result)){
	$link_id = $row['link_id'];
$agent_ID = $row['agent_ID'];
	}
$send_array = array($link_id, $agent_ID);
	return $send_array;
	}elseif($row_cnt > 1){
	$link_id = array();
	 while($row = mysqli_fetch_assoc($result)){
	$link_id[] = $row['link_id'];
$agent_ID[] = $row['agent_ID'];
	}
    $send_array = array($link_id, $agent_ID);
	return $send_array;
  }
 else
  {
   return false;
  }
 }
}

    function get_price_slots() {
//this func establishes ALL price slots up to the 50th(N) - which is 4.250810001427
//PRICE SLOT VALUES ARE PRACTICALLY SPEAKING PERMANENT! They serve as names of the positions
// Note - 10 decimal places (two more than 8 decimals of BCH for extra precision)
// Note that is the per-diem so the current price list works up to 6.376215002141 X $422.60 = $2500 +- ad expense per day. 
// As the BCH price climbs it can handle higher daily bids but currently can handle prices down to .00000001 BCH (one Satoshi) even though the network can't go that low. 

//the current test data starts with a low bid of 0.000074819226 BCH ($0.031573713/day [approx $1 mo.] at $422 BCH price) to a high bid of 0.0012783566 $0.5394/day [approx $16 mo.]
	for($i=0;$i<=49;$i++){
	$base = 0.00000001;
		if($i==0){
		$step[$i]= number_format($base * 1.5, 12);
		}
		else
		{
		$step[$i]= number_format($step[$i-1] * 1.5, 12);
		}
	}
	return $step;
    }
}
?>

