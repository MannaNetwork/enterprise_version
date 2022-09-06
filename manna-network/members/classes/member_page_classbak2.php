<?php
//org
 class member_page_info
{
function ordinal($number) {
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    if ((($number % 100) >= 11) && (($number%100) <= 13))
        return $number. 'th';
    else
        return $number. $ends[$number % 10];
}

function getPaidRegionalLinksByCatId($cat_id, $coin_type){
if (!defined('READER_AGENTS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_AGENTS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
		
		$sql = "SELECT * from `links` WHERE `category`=$cat_id and `price_slot` > 0 and `location_id` > 0 and `coin_type`='$coin_type'";
		echo $sql;
		$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 1 Account' query");
$row_cnt = $result->num_rows;

if($row_cnt > 0){
   while($row = mysqli_fetch_assoc($result)){
$paid_loc_link_id[] = $row['id'];
  $location_id[] = $row['location_id'];
  $price_slot[] = $row['price_slot'];
      }
$send_array = array($paid_loc_link_id, $location_id, $price_slot);
return $send_array;
}
else
{
return "No Results";
}
}


function getRegionsSubTree($location_id){
if (!defined('READER_AGENTS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_AGENTS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
//get lft-rgt of the submitted
$sql = "SELECT *
FROM `categories_regional2`
WHERE `id` = '$location_id' ";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 1 Account' query");
$row_cnt = $result->num_rows;
echo '<br>'.$sql.'<br>';
if($row_cnt > 0){
   while($row = mysqli_fetch_assoc($result)){
$saved_loc_id = $row['id'];
	$parent_id = $row['parent'];
	$name = $row['name'];
	$lft = $row['lft'];
	$rgt = $row['rgt'];
    }

/* NOW get all the links with a lft rgt query */
$id2=[];
 $parent2=[];
 $name2=[];
$lft2=[];
$rgt2=[];
$sql2 = "SELECT *
FROM `categories_regional2`
WHERE `lft` <= $lft AND `rgt` >= $rgt ";
echo '<br>'.$sql.'<br>';
//by adding the equal sign it will include the submitted category in the tree also
//echo '<br>$sql2 = ', $sql2 ;

$result = mysqli_query($mysqli, $sql2) or die("Couldn't execute 'Edit 2 Account' query");
 while($row = mysqli_fetch_assoc($result)){
 $id2[] = $row['id'];
 $parent2[] = $row['parent'];
 $name2[] = $row['name'];
$lft2[] = $row['lft'];
$rgt2[] = $row['rgt'];
}
}
$send_array = array($id2, $parent2, $name2, $lft2, $rgt2);
return $send_array;
}
function rgtColummnBuyPage($cat_id, $location_id, $coin_type, $price_slot){
if (!defined('READER_AGENTS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_AGENTS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
	$count = $this->getCountRegionalPriceSlots($cat_id, $location_id, $coin_type, $price_slot);
	$lftRgtOfLocID = $this->getRegionsSubTree($location_id);
	return $lftRgtOfLocID;

}

function getCountRegionalPriceSlots($cat_id, $location_id, $coin_type, $price_slot){
if (!defined('READER_AGENTS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_AGENTS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
		
 $query = 'SELECT `id` FROM `links` WHERE category = '.$cat_id.'&& location_id='.$location_id.'&& price_slot = '.$price_slot.'&& coin_type=\''.$coin_type."'" ;
		//echo '<br>member page class - line 71 - function getCountRegionalPriceSlots ', $query;
		
		$result= mysqli_query($mysqli, $query);
		$row_cnt = $result->num_rows;
		if($row_cnt >0){
		return $row_cnt;
		//echo '<br> In IF result after query';
		/* while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			$id[] = $row ;
			}
			//echo '<h1>in func - count regional = '.count($id).'</h1>';
			return count($id);
			*/
		}
		else
		{
		return 'No Results';
		}
}		
function getCountGlobalPriceSlots($cat_id, $coin_type, $price_slot){
if (!defined('READER_AGENTS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_AGENTS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
		
 $query = 'SELECT `id` FROM `links` WHERE category = '.$cat_id.'&& price_slot >= '.$price_slot.'&& coin_type=\''.$coin_type."'" ;
		$result= mysqli_query($mysqli, $query);
		$row_cnt = $result->num_rows;
		if($row_cnt >0){
		 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			$id[] = $row ;
			}
			return count($id);
		}
		else
		{
		return 'No Results';
		}
		
}
//Five new functions for getting category hierarchy - They basically are copies of equivalent ones to retrieve location hierarchy with last one retrieved from agents.categories_class.php
function getChildrenByParent($parent_id){
if (!defined('READER_AGENTS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_AGENTS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");

$sql = "SELECT *
FROM `categories`
WHERE `parent` = '$parent_id' ";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit lftrgt Account' query");
//echo '<br>$result->num_rows = ', $result->num_rows;

//if ($result->num_rows > 0) {
 while($row = mysqli_fetch_assoc($result)){
 //echo '<br>row = ';
 //print_r($row);
 $id[] = $row['id'];
$lft[] = $row['lft'];
$rgt[] = $row['rgt'];
$name[] = $row['name'];
$parent[] = $row['parent'];
$send_array = array($id,$name,$parent,$lft,$rgt);
echo '<br>in function - print_r send array = <br>';
print_r($send_array);
return $send_array;
}
//}


}

function getCategoriesRow($category_id){
if (!defined('READER_AGENTS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_AGENTS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");

$sql = "SELECT *
FROM `categories`
WHERE `id` = '$category_id' ";
//echo '<br>', $sql;
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit lftrgt Account' query");
//echo '<br>$result->num_rows = ', $result->num_rows;

if ($result->num_rows > 0) {
 while($row = mysqli_fetch_assoc($result)){
 //echo '<br>row = ';
 //print_r($row);
$lft = $row['lft'];
//echo '<br>$lft = ', $lft;
//echo '<br>$row[lft] = ', $row['lft'];


$rgt = $row['rgt'];
return $row;
}
}
}

function get_categories_array($category_id){

/*  categories
id     | int(21)     | NO   | PRI | NULL    |       |
| name   | varchar(36) | YES  |     | NULL    |       |
| parent | int(21)     | YES  | MUL | 1       |       |
| lft    | int(10)     | NO   | MUL | 0       |       |
| rgt    | int(10)     | NO   | MUL | 0       |
*/

if (!defined('READER_AGENTS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_AGENTS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");


$sql = "SELECT *
FROM `categories`
WHERE `id` = '$category_id' ";

//echo '<br>sql = ', $sql;
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 1 Account' query");
$row_cnt = mysqli_num_rows($result);

if($row_cnt > 0){
   while($row = mysqli_fetch_assoc($result)){
$saved_loc_id = $row['id'];
	$parent_id = $row['parent'];
	$name = $row['name'];
	$lft = $row['lft'];
	$rgt = $row['rgt'];
    }

/* NOW get all the links with a lft rgt query */
$id=[];
 $parent=[];
 $name=[];
$lft2=[];
$rgt2=[];
$sql2 = "SELECT *
FROM `categories`
WHERE `lft` <= $lft AND `rgt` >= $rgt ";
//echo '<br>$sql2 = ', $sql2 ;

$result = mysqli_query($mysqli, $sql2) or die("Couldn't execute 'Edit 2 Account' query");
 while($row = mysqli_fetch_assoc($result)){
 $id[] = $row['id'];
 $parent[] = $row['parent'];
 $name[] = $row['name'];
$lft2[] = $row['lft'];
$rgt2[] = $row['rgt'];
}
}
$send_array = array($id, $name);
return $send_array;
}

function getCategoriesName($category_id){
/*  categories
id     | int(21)     | NO   | PRI | NULL    |       |
| name   | varchar(36) | YES  |     | NULL    |       |
| parent | int(21)     | YES  | MUL | 1       |       |
| lft    | int(10)     | NO   | MUL | 0       |       |
| rgt    | int(10)     | NO   | MUL | 0       |
*/

if (!defined('READER_AGENTS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_AGENTS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");


$sql = "SELECT `name`
FROM `categories`
WHERE `id` = '$category_id' ";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 11b Account' query");
if ($result->num_rows > 0) {
 while($row = mysqli_fetch_assoc($result)){
$name = $row['name'];
}
return $name;
}
else
{
return false;
}
}

function getCategoriesLftRgt($category_id){
//echo '<br>in getRegionalLftRgt';
if (!defined('READER_AGENTS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_AGENTS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");

$sql = "SELECT *
FROM `categories`
WHERE `id` = '$category_id' ";
echo '<br>In getCategoriesLftRgt - 1st query  ', $sql;
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit lftrgt Account' query");
//echo '<br>$result->num_rows = ', $result->num_rows;

if ($result->num_rows > 0) {
 while($row = mysqli_fetch_assoc($result)){
 //echo '<br>row = ';
// print_r($row);
$lft = $row['lft'];
echo '<br>$lft = ', $lft;
//echo '<br>$row[lft] = ', $row['lft'];


$rgt = $row['rgt'];
echo '<br>$rgt = ', $rgt;
}
//echo '<br>row = ';
//print_r($row);
echo '<br>$lft = ', $lft;

$sql2 = "SELECT *
FROM `categories`
WHERE `lft` <= $lft AND `rgt` >= $rgt ";
echo '<br>In getCategoriesLftRgt - 2nd query  ', $sql2;
$result = mysqli_query($mysqli, $sql2) or die("Couldn't execute 'Edit lftrgt2 Account' query");
if ($result->num_rows > 0) {
 while($row = mysqli_fetch_assoc($result)){
 //echo '<br>row = ';
 //print_r($row);
$lft = $row['lft'];
$rgt = $row['rgt'];
}
}
else
{
while($row = mysqli_fetch_assoc($result)){
$lft[] = $row['lft'];
$rgt[] = $row['rgt'];
}
$send_array= array($lft, $rgt);
//echo '<br>send array = ';
//print_r($send_array);
return $send_array;
}
}
else
{
return false;
}





}




// end new category hierarchy functions
function getUsersRegistrationInfo($user_id){ //remote user id from registering site pulling from that agents users table db
//Change note 3/31/2022 The query used to select all (i.e. *) but made it select just three columns for use by plugin's Resend Email Verification. I did NOT check if this function is used elsewhere 
if (!defined('READER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_CUSTOMERS);
		
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/pdo_connect.php");

		try {
	//$link = new PDO('mysql:host='.$servername.';dbname='. $dbname, $username, $password);
$query = $dbh->prepare('Select * from `users` where `user_id` = :user_id');

/* Now we add the wanted values to our query */
$query->execute([
    'user_id' => $user_id
]);
//echo '<h3>dumpparams that selects parent IN customers TABLE Looking For user_id </H3>';
//	$query->debugDumpParams();
$result2 = $query->fetchAll();
//echo '<br><br><br>Result2 = <br>';
print_r($result2);
/*echo '<br><br><br>';
echo '<br>Looking for user_id';
echo '<br><br><br>';
echo '<br><br><br>user_id is ', $result2[0]['user_id']; */
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");

//$query = "Select `user_activation_hash`, `user_email`, `website_url`  from `users` where `user_id` = '$user_id'";
$query = "select * from users where user_id = $user_id";

//echo '<br>in member page class $query = ', $query;
$result = mysqli_query($mysqli, $query);
if ($result=mysqli_query($mysqli, $query))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
  $TotalRcount = $result->num_rows;
 // printf("<br>Result set has %d rows.\n",$rowcount);
 // echo '<br>$TotalRcount = ', $TotalRcount;
  // Free result set
  //mysqli_free_result($result);
  }
if ($TotalRcount > 0) {
$row = $result -> fetch_array(MYSQLI_ASSOC);

//print_r ($row);
 while ($row = mysqli_fetch_array($result))
 {
return json_encode($row, true);
 }
 
 }
 else
 {
 return json_encode('empty', true);
 }
 }
 
function get_num($agentid) {
 if (is_numeric($agentid)) {
   return $agentid + 0;
 }
 return 0;
} 

function getRegionsRow($regionalnum){
if (!defined('READER_AGENTS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_AGENTS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");

$sql = "SELECT *
FROM `categories_regional2`
WHERE `id` = '$regionalnum' ";
//echo '<br>', $sql;
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit lftrgt Account' query");
//echo '<br>$result->num_rows = ', $result->num_rows;

if ($result->num_rows > 0) {
 while($row = mysqli_fetch_assoc($result)){
 //echo '<br>row = ';
 //print_r($row);
$lft = $row['lft'];
//echo '<br>$lft = ', $lft;
//echo '<br>$row[lft] = ', $row['lft'];


$rgt = $row['rgt'];
return $row;
}
}
}

function get_regions_array($regionalnum){

/*  categories_regional2
id     | int(21)     | NO   | PRI | NULL    |       |
| name   | varchar(36) | YES  |     | NULL    |       |
| parent | int(21)     | YES  | MUL | 1       |       |
| lft    | int(10)     | NO   | MUL | 0       |       |
| rgt    | int(10)     | NO   | MUL | 0       |
*/

if (!defined('READER_AGENTS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_AGENTS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");


$sql = "SELECT *
FROM `categories_regional2`
WHERE `id` = '$regionalnum' ";

//echo '<br>sql = ', $sql;
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 1 Account' query");
$row_cnt = mysqli_num_rows($result);

if($row_cnt > 0){
   while($row = mysqli_fetch_assoc($result)){
$saved_loc_id = $row['id'];
	$parent_id = $row['parent'];
	$name = $row['name'];
	$lft = $row['lft'];
	$rgt = $row['rgt'];
    }

/* NOW get all the links with a lft rgt query */
$id=[];
 $parent=[];
 $name=[];
$lft2=[];
$rgt2=[];
$sql2 = "SELECT *
FROM `categories_regional2`
WHERE `lft` <= $lft AND `rgt` >= $rgt ";
//by adding the equal sign it will include the submitted category in the tree also
//echo '<br>$sql2 = ', $sql2 ;

$result = mysqli_query($mysqli, $sql2) or die("Couldn't execute 'Edit 2 Account' query");
 while($row = mysqli_fetch_assoc($result)){
 $id[] = $row['id'];
 $parent[] = $row['parent'];
 $name[] = $row['name'];
$lft2[] = $row['lft'];
$rgt2[] = $row['rgt'];
}
}
$send_array = array($id, $name);
return $send_array;
}
function check_if_site_is_reviewed($user_id, $agent_ID, $link_id){
$file="https://exchange.manna-network.com/incoming/check_if_site_is_reviewed.php";
$args = http_build_query(array(
'user_id' => $user_id,
'agent_ID' => $agent_ID,
'remote_link_id' => $link_id));
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}

function check_for_bid($link_id){
if (!defined('READER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
$query="SELECT * from price_slots_subscripts where `link_id` = '$link_id'";
$result= mysqli_query($mysqli, $query);
 $mysqli_num_rows = mysqli_num_rows($result);

return $mysqli_num_rows;

}

function get_coin_type($link_id){
if (!defined('READER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
$query="SELECT * from price_slots_subscripts where `link_id` = '$link_id'";
$result= mysqli_query($mysqli, $query);
 $mysqli_num_rows = mysqli_num_rows($result);
if($mysqli_num_rows > 0){
while($row = mysqli_fetch_assoc($result)){
 $coin_type = $row['coin_type'];
 }
return $coin_type;
}
}

function getUserPriceSlots($user_id, $agent_ID, $link_id, $cat_id, $coin_type){
// returns either "no_bids", "temp_bid", "approved_bid", or "error_detecting_bid"
$file="https://exchange.manna-network.com/incoming/check_for_bids_by_remote_link_id.php";
$args = http_build_query(array(
'user_id' => $user_id,
'agent_ID' => $agent_ID,
'remote_link_id' => $link_id,
'cat_id' => $cat_id,
'coin_type' => $coin_type));
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}

function isUserLinkReviewed($user_id, $agent_ID, $link_id, $cat_id, $coin_type){
// returns either "yes", "no"
$file="https://exchange.manna-network.com/incoming/check_if_link_is_reviewed.php";
$args = http_build_query(array(
'user_id' => $user_id,
'agent_ID' => $agent_ID,
'remote_link_id' => $link_id,
'cat_id' => $cat_id,
'coin_type' => $coin_type));
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}

function get_tentative_rank_of_bidder($cat_id, $coin_type, $links_paid_price){
// this gets the count of both BSV price slots and DMC in this cat
$file="https://exchange.manna-network.com/incoming/get_tentative_rank_of_bidder.php";
$args = http_build_query(array(
//'remote_link_id' => $remote_link_id,
//'agent_ID' => $agent_ID,
'cat_id' => $cat_id,
'coin_type' => $coin_type,
'links_paid_price' => $links_paid_price));
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}

function get_rank_of_bidder($remote_link_id, $agent_ID,$cat_id, $coin_type, $links_paid_price){
// this gets the count of both BSV price slots and DMC in this cat
$file="https://exchange.manna-network.com/incoming/get_rank_of_bidder.php";
$args = http_build_query(array(
'remote_link_id' => $remote_link_id,
'agent_ID' => $agent_ID,
'cat_id' => $cat_id,
'coin_type' => $coin_type,
'links_paid_price' => $links_paid_price));
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}

function get_rank_of_bidder_by_price($bidders_price, $remote_link_id, $agent_ID,$cat_id, $coin_type){
// this gets the count of both BSV price slots and DMC in this cat
//echo '<h1>in get population func </h1>';
//echo '<br>in func remote link id fed by param = ', $remote_link_id;
$file="https://exchange.manna-network.com/incoming/get_rank_of_bidder_by_price.php";
//echo '<br> in member page class/ get_rank_of_bidder_by_price ', $file;
$args = http_build_query(array(
'bidders_price' => $bidders_price,
'remote_link_id' => $remote_link_id,
'agent_ID' => $agent_ID,
'cat_id' => $cat_id,
'coin_type' => $coin_type));
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
//curl_setopt($ch, CURLOPT_POSTFIELDS, array('locus_array' => $locus_array,'link_record_num' => $link_record_num,'link_page_total' => $link_page_total, 'link_page_id' => $link_page_id, 'pagem_url_cat' => $pagem_url_cat,'link_page_num' => $link_page_num, 'cat_page_num' => $cat_page_num, 'url_cat' => $url_cat, 'affiliate_num' => $affiliate_num  ));
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}



/* temp deactivate  - is generating error "Warning: shell_exec() has been disabled for security reasons in /home/stbitcoi/public_html/manna_network/manna-network/members/classes/member_page_class.php on line 87" */

function get_cat_count_of_bids_approved($cat_id, $coin_type){
// this gets the count of both BSV price slots and DMC in this cat
//echo '<h1>in get population func </h1>';
$file="https://exchange.manna-network.com/incoming/get_cat_count_of_bids_approved.php";
$args = http_build_query(array(
'cat_id' => $cat_id,
'coin_type' => $coin_type));
//echo '<br>coint_type in function $args values sent = ';
//print_r($args);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
//curl_setopt($ch, CURLOPT_POSTFIELDS, array('locus_array' => $locus_array,'link_record_num' => $link_record_num,'link_page_total' => $link_page_total, 'link_page_id' => $link_page_id, 'pagem_url_cat' => $pagem_url_cat,'link_page_num' => $link_page_num, 'cat_page_num' => $cat_page_num, 'url_cat' => $url_cat, 'affiliate_num' => $affiliate_num  ));
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
return $data;
//returns a numerical count of how many approved bids there are in the cat
}

function get_price_of_an_index($index){

$counter=49;
	for($i=0;$i<=$counter;$i++){
	$base = 0.00000001;
		if($i==0){
		$price[$i]= number_format($base * 1.5, 12);
		}
		else
		{
		$price[$i]= number_format($price[$i-1] * 1.5, 12);
//echo '<br> $i = ', $i;
//echo '.... $index = ', $index;
//echo '  .... $price[$i] = ', $price[$i];
		//next, we compare the price slot value at this point to the target $index and break if we have reached it.
		if($i >= $index){
		return $price[$i];
		break;
		}
	      }
           }
	}

function updateLocalPriceslotsSubscripts($user_id, $agent_ID, $link_id, $new_price, $old_price, $cat_id, $installer_id, $coin_type){
//copyBuyAgentPriceslotsSubscripts($user_id, $agent_ID, $link_id, $price, $cat_id, $installer_id, $coin_type);
date_default_timezone_set('America/New_York');
//echo 'in func';
if (!defined('WRITER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".WRITER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
$subscribe = 0;//will will update this when the links table is updated from central
$start_date = time();
//SELECT `id`, `user_id`, `link_id`, `price_slot_amnt`, `subscribe`, `coin_type`, `cat_id`, `t_timestamp`, `start_date`, `agent_ID`, `installer_id` FROM `price_slots_subscripts`
$query = "SELECT * FROM `price_slots_subscripts` WHERE `link_id` =  '".$link_id."' AND `agent_ID` = '".$agent_ID."'";
//echo '<br>', $query;
$result = mysqli_query($mysqli, $query);
$row_cnt = mysqli_num_rows($result);

if($row_cnt > 0){
   while($row = mysqli_fetch_assoc($result)){
$previous_id = $row['id'];
	$prev_link_id = $row['link_id'];
$prev_agent_ID = $row['agent_ID'];
$prev_start_date = $row['start_date'];
    }
  if($old_price > $new_price){
$reason = 'decreased';
}
elseif($old_price < $new_price){
$reason = 'increased';
}

}

$query = "UPDATE `price_slots_subscripts` set `price_slot_amnt`= '".$new_price."', `start_date`='".$start_date."' WHERE id='".$previous_id."'";
//echo '<br>', $query;
$result = mysqli_query($mysqli, $query);
if (mysqli_affected_rows ( $mysqli )> 0){
//echo '<h1>in if affected rows</h1>';

$this->recordModifyPriceslotsSubscripts($previous_id,$user_id, $prev_link_id,$prev_agent_ID,$prev_start_date,$old_price,$new_price,$reason);;
}
}


function get_cat_status($hi_low_string){
$findme   = '|';
$pos = strpos($hi_low_string, $findme);

if ($pos === false) {
  //  echo "The string '$findme' was not found in the string '$hi_low_string'";
$this_cats_status = "no_bids";
} else {
    $pieces = explode("|", $hi_low_string);
	$lowestpriceslot = $pieces[1];
	$highestpriceslot = $pieces[0];
//echo '<br>$lowestpriceslot = ', $lowestpriceslot;
//echo '<br>$highestpriceslot = ', $highestpriceslot;
$this_cats_status = "has_bids";
}
return $this_cats_status;

}

function get_population_from_Central_by_slot($cat_id, $price_slot_amount, $coin_type){
// this gets the populations of all the bids that will be displayed in the steps array
//echo '<h1>in get population func </h1>';
//echo '<br>cat = ', $cat_id;
//echo '<br>$price_slot_amount = ', $price_slot_amount;
$file="https://exchange.manna-network.com/incoming/get_price_slot_population_by_slot.php";
$args = http_build_query(array(
'cat_id' => $cat_id,
'price_slot_amount'=>$price_slot_amount,
'coin_type'=>$coin_type));
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
//curl_setopt($ch, CURLOPT_POSTFIELDS, array('locus_array' => $locus_array,'link_record_num' => $link_record_num,'link_page_total' => $link_page_total, 'link_page_id' => $link_page_id, 'pagem_url_cat' => $pagem_url_cat,'link_page_num' => $link_page_num, 'cat_page_num' => $cat_page_num, 'url_cat' => $url_cat, 'affiliate_num' => $affiliate_num  ));
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}

function get_population_from_Central($cat_id, $hi_low_string){
// this gets the populations of all the bids that will be displayed in the steps array
//echo '<h1>in get population func </h1>';
//echo '<br>cat = ', $cat_id;
//echo '<br>hi low = ', $hi_low_string;
$file="https://exchange.manna-network.com/incoming/get_price_slot_population.php";
$args = http_build_query(array(
'cat_id' => $cat_id,
'hi_low_string'=>$hi_low_string));
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
//curl_setopt($ch, CURLOPT_POSTFIELDS, array('locus_array' => $locus_array,'link_record_num' => $link_record_num,'link_page_total' => $link_page_total, 'link_page_id' => $link_page_id, 'pagem_url_cat' => $pagem_url_cat,'link_page_num' => $link_page_num, 'cat_page_num' => $cat_page_num, 'url_cat' => $url_cat, 'affiliate_num' => $affiliate_num  ));
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}

function get_price_slots_by_minmaxindex($maxindex, $minindex, $number_of_extra_price_slots) {
//$daily_minimum_bid_target is only a ballpark value and fluctuates depending on market price and represents a decimal percentage of a current whole BSV equal to the monthly target fee wanted.
$counter=49;

$real_max = $maxindex + $number_of_extra_price_slots;

//this func establishes ALL price slots up to the 50th(N) - which is 4.250810001427
//PRICE SLOT VALUES ARE PRACTICALLY SPEAKING PERMANENT! They serve as names of the positions
// Note - 12 decimal places (two more than 10 decimals of the db)
// As the BCH price climbs it can handle higher daily bids but currently can handle prices down to .00000001 BCH (one Satoshi) even though the network can't go that low.
$return_array = array();
	for($i=0;$i<=$counter;$i++){
	$base = 0.00000001;
		if($i==0){
		$step[$i]= number_format($base * 1.5, 12);
		}
		else
		{
		$step[$i]= number_format($step[$i-1] * 1.5, 12);
                }
if($i >= $minindex &&  $i<= $real_max){
//only return price slots if they are equal to or higher the current target minimum
//echo '<br>building return array $i = ', $i;
//echo ' ... $step[$i] value (priceslot) = ', $step[$i];
$return_array[$i]=$step[$i];
	    }
	}
	return $return_array;
    }

function get_current_index_of_daily_minimum_bid_target($daily_minimum_bid_target){
$counter=49;
	for($i=0;$i<=$counter;$i++){
	$base = 0.00000001;
$return_array = array(); //re-instantiate the array each time the itearation didn't meet the conditions
		if($i==0){
		$step[$i]= number_format($base * 1.5, 12);
		}
		else
		{
		$step[$i]= number_format($step[$i-1] * 1.5, 12);
		}

$temp_slot = number_format($step[$i] , 10);
if (isset($step[$i-1])) {
$temp_slot2 = number_format($step[$i-1] , 10);
}
$daily_minimum_bid_target =  number_format($daily_minimum_bid_target , 10);

if($temp_slot >= $daily_minimum_bid_target AND $temp_slot2 <= $daily_minimum_bid_target){
$index_of_minimum = $i;
return $index_of_minimum;
break;

	}
	}
    }

function thisLinksRegionalInfo($link_id, $agent_ID){

//echo '<br>in func line 372 $link_id, $agent_ID = ', $link_id;
/*
//Moved from the buy_price_slot page as just an untested snippet into a function (to alleviate clutter)
//First, we find out if this link has any regional info added to db.
//If so, we determine its most local position to establish display blocks for each regional level so as to report number of competitors in each level

		if($thisLinksRegionalInfo[6]>0){
		$thisLinksMostLocalRegional = "district2";
		$regionalDisplayBlocksNum = "6";
		}elseif($thisLinksRegionalInfo[5]>0){
		$thisLinksMostLocalRegional = "city";
		$regionalDisplayBlocksNum = "5";
		}
		elseif($thisLinksRegionalInfo[4]>0){
		$thisLinksMostLocalRegional = "district1";
		$regionalDisplayBlocksNum = "4";
		}elseif($thisLinksRegionalInfo[3]>0){
		$thisLinksMostLocalRegional = "state";
		$regionalDisplayBlocksNum = "3";
		}elseif($thisLinksRegionalInfo[2]>0){
		$thisLinksMostLocalRegional = "country";
		$regionalDisplayBlocksNum = "2";
		}elseif($thisLinksRegionalInfo[1]>0){
		$thisLinksMostLocalRegional = "continent";
		$regionalDisplayBlocksNum = "1";
		}
//make a string to insert an empty column/spaceholder unless there is a link in that price slot
$regionalDisplaySpaceholder = '';
for($i=1;$i<=$regionalDisplayBlocksNum;$i++){
$regionalDisplaySpaceholder .= '<td>&nbsp;---</td>';
}  */
}




function getRegionalName($regionalnum){
/*  categories_regional2
id     | int(21)     | NO   | PRI | NULL    |       |
| name   | varchar(36) | YES  |     | NULL    |       |
| parent | int(21)     | YES  | MUL | 1       |       |
| lft    | int(10)     | NO   | MUL | 0       |       |
| rgt    | int(10)     | NO   | MUL | 0       |
*/

if (!defined('READER_AGENTS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_AGENTS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");


$sql = "SELECT `name`
FROM `categories_regional2`
WHERE `id` = '$regionalnum' ";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 11b Account' query");
if ($result->num_rows > 0) {
 while($row = mysqli_fetch_assoc($result)){
$name = $row['name'];
}
return $name;
}
else
{
return false;
}
}
function getUsersBalance($user_id){ //local db 2bd
/*| id          | int(11)                          | NO   | PRI | NULL              | auto_increment |
| user_id     | int(11)                          | NO   |     | NULL              |                |
| t_timestamp | timestamp                        | NO   |     | CURRENT_TIMESTAMP |                |
| amount_DMC  | decimal(20,10) unsigned zerofill | NO   |     | NULL              |                |
| amount_BCH  | decimal(20,10) unsigned zerofill | NO   |     | NULL              |                |
| txid        | varchar(65)                      | NO   |     | NULL    */

if (!defined('READER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");

//`leves` ($continent`, $country`, $state`, $district1`, $city`, $district2`
$query = "Select `id`, `amount_DMC`, `amount_BCH`   from `balance` where `user_id`='$user_id'";
//echo $query;
$result = mysqli_query($mysqli, $query);
$row = "";
$democoin_balance = "";
$bitcoin_cash_balance = "";
$id = "";
 while ($row = mysqli_fetch_array($result))
 {
$democoin_balance = $row['amount_DMC'];
$bitcoin_cash_balance = $row['amount_BCH'];
$id = $row['id'];
 }
$balance = array($id, $user_id, $democoin_balance, $bitcoin_cash_balance );
  return $balance;
 }


function getRegionalCompetitors($level, $loc_id, $cat_id, $link_id, $agent_ID){
$args = http_build_query(array(
'level' => $level,
'loc_id'=>$loc_id,
'cat_id'=>$cat_id,
'link_id'=>$link_id,
'agent_ID'=>$agent_ID));
$handle = curl_init();
$url = "https://exchange.manna-network.com/incoming/check_count_RegionalCompetitors.php";
curl_setopt($handle, CURLOPT_URL, $url);
curl_setopt($handle, CURLOPT_POSTFIELDS,$args);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
 $jsonlinkList = curl_exec($handle);
 curl_close($handle);

$data = json_decode($jsonlinkList, TRUE);
return $data;
}


function getThisLinksRegionalInfo($link_id, $agent_ID, $location_id){

$args = http_build_query(array(
'link_id' => $link_id,
'agent_ID' => $agent_ID,
'location_id' => $location_id));
$handle = curl_init();
$url = "https://exchange.manna-network.com/incoming/checkThisLinksRegionalInfo.php";
// Set the url
curl_setopt($handle, CURLOPT_URL, $url);
curl_setopt($handle, CURLOPT_POSTFIELDS, $args);
//curl_setopt($handle, CURLOPT_POSTFIELDS, array('link_id' => $link_id, 'agent_ID' => $agent_ID, 'location_id' => $location_id ));
// Set the result output to be a string.
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
 $jsonlinkList = curl_exec($handle);
 curl_close($handle);

$data = json_decode($jsonlinkList, TRUE);
return $data;
}



function getRegionalInfo($link_id, $agent_ID){
if (!defined('READER_CUSTOMERS')) {

//This function has same query as above function (is DUPLICATE)? Check for function call, change to other and delete this one
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
//`regional_sign_ups` (`id`, `continent`, `country`, `state`, `district1`, `city`, `district2`, `link_id`)
//| id | continent | country | state | district1 | city | district2 | street | link_id | cat_id |
$sql = "SELECT *
FROM `regional_sign_ups`
WHERE `link_id` = '$link_id' AND `agent_ID` = '$agent_ID'";
//echo $sql;
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

/* function updateBuyAgentPriceslotsSubscripts($user_id, $agent_ID, $link_id, $new_price, $cat_id, $installer_id, $coin_type,  $reason){

date_default_timezone_set('America/New_York');
//echo 'in func';
if (!defined('WRITER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".WRITER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
$subscribe = 0;//will will update this when the links table is updated from central
$start_date = time();
$query = "SELECT `id`, `user_id`, `link_id`, `price_slot_amnt`, `subscribe`, `coin_type`, `cat_id`, `t_timestamp`, `start_date`, `agent_ID`, `installer_id` FROM `price_slots_subscripts` WHERE `link_id` =  '".$link_id."' AND `agent_ID` = '".$agent_ID."'";
//echo '<br>', $query;
$result = mysqli_query($mysqli, $query);
$row_cnt = mysqli_num_rows($result);

if($row_cnt > 0){
   while($row = mysqli_fetch_assoc($result)){
$current_id = $row['id'];
$user_id = $row['user_id'];
	$current_link_id = $row['link_id'];
$agent_ID = $row['agent_ID'];
$prev_start_date = $row['start_date'];
$prev_amount = $row['price_slot_amnt'];
    }
  }
//this is all pretty loose. It needs something like a transaction or some better error checking
$query = "UPDATE `price_slots_subscripts` set `price_slot_amnt`= '".$price."', `start_date`='".$start_date."'  WHERE id='".$current_id."'";
//echo '<br>', $query;
$result = mysqli_query($mysqli, $query);
if (mysqli_affected_rows ( $mysqli )> 0){
//echo '<h1>in if affected rows</h1>';
if($row_cnt > 0){
$this->modifyAgentPriceslotsSubscripts($user_id, $agent_ID, $link_id, $price, $cat_id, $installer_id, $coin_type, $links_approval_status, $users_balances_string, $reason);

//first update the price slot table
$this->sendModifyToCentral($current_id,$user_id,$current_link_id, $agent_ID,$prev_start_date,$prev_amount,$new_price, $coin_type, $reason);
//then record there was a modification in the ledger type table
$this->recordModifyPriceslotsSubscripts($current_id,$user_id,$current_link_id, $agent_ID,$prev_start_date,$prev_amount,$new_price, $reason);
}


}
}  */

function recordModifyPriceslotsSubscripts($previous_id,$user_id, $prev_link_id,$prev_agent_ID,$prev_start_date,$old_price,$new_price,$reason){
//copyBuyAgentPriceslotsSubscripts($user_id, $agent_ID, $link_id, $price, $cat_id, $installer_id, $coin_type);
date_default_timezone_set('America/New_York');

if (!defined('WRITER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".WRITER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
$subscribe = 0;//will will update this when the links table is updated from central
$start_date = time();
$query = "SELECT * FROM `price_slots_subscripts` WHERE `link_id` =  '".$prev_link_id."' AND `agent_ID` = '".$prev_agent_ID."'";
//echo '<br>', $query;
$result = mysqli_query($mysqli, $query);
foreach($result as $row){
print_r($row);
}
/*
/ Prints something like: Monday 8th of August 2005 03:12:46 PM
echo date('l jS \of F Y h:i:s A');

need 0000-00-00 00:00:00
*/
$now_dateandtime = date('Y-m-d H:i:s');

$query2 = "INSERT INTO `price_slots_modifications`(`orig_ps_id`, `user_id`, `link_id`, `orig_price_slot_amnt`, `new_amount`, `subscribe`, `coin_type`, `cat_id`, `rank_by_cat`, `orig_t_timestamp`, `orig_start_date`, `agent_ID`, `installer_id`, `reason`) VALUES ('".$previous_id."','".$user_id."','".$prev_link_id."','".$old_price."','".$new_price."','0','".$row['coin_type']."','".$row['cat_id']."','0','".$row['t_timestamp']."','".$row['start_date']."','".$row['agent_ID']."','".$row['installer_id']."','".$reason."')";
//echo '<br>', $query2;
$result2 = mysqli_query($mysqli, $query2);
/* need a separate delete function because archiving occurs for upgrades and downfrades as well as cancels
$query = "DELETE FROM `price_slots_subscripts` WHERE `id` =  '".$previous_id."'";
//echo '<br>Deleting a previous bid', $query;
$result = mysqli_query($mysqli, $query);
*/
}

function delete_opposite_bids($user_id,$link_id, $agent_ID, $opposite_coin_type, $reason){
if (!defined('WRITER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".WRITER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
		//delete from local
		$query = "DELETE FROM `price_slots_subscripts` WHERE `user_id` =  '".$user_id."' && agent_ID='".$agent_ID."' && `link_id` = '".$link_id."'&& `coin_type`='".$opposite_coin_type."'";
		echo '<br>Deleting opposite bid in local', $query;
		$result = mysqli_query($mysqli, $query);
//delete from manna
//new link to mn delete page = incoming/delete_opposite_bids.php
$file="https://exchange.manna-network.com/incoming/delete_opposite_bids.php";
$args = http_build_query(array(
'user_id' => $user_id,
'agent_ID' => $agent_ID,
'link_id' => $link_id,
'opposite_coin_type' => $opposite_coin_type,
'reason' => $reason));
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
echo($data);
		
}
function modifyAgentPriceslotsSubscripts($user_id, $agent_ID, $link_id, $price, $cat_id, $installer_id, $coin_type, $links_approval_status, $users_balances_string, $reason){
date_default_timezone_set('America/New_York');

if (!defined('WRITER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".WRITER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
$subscribe = 0;//will will update this when the links table is updated from central
$start_date = time();
$query = "SELECT * FROM `price_slots_subscripts` WHERE `link_id` =  '".$link_id."' AND `agent_ID` = '".$agent_ID."'";
//echo '<br>', $query;
$result = mysqli_query($mysqli, $query);
$row_cnt = mysqli_num_rows($result);

//we need to eventually delete these that we found but first need to copy them to the archive and then copy the new bid and then delete
//SELECT `id`, `previous_id`, `pre_start_date`, `transfer_date`, `pre_amount`, `new_amount`, `reason`, `agent_ID`, `link_id` FROM `price_slots_archive`
if($row_cnt > 0){

$query = "update `price_slots_subscripts` SET `price_slot_amnt`= '$price', `start_date` = '$start_date' WHERE `link_id` =  '".$link_id."' AND `agent_ID` = '".$agent_ID."'";
//echo '<br>', $query;
$result = mysqli_query($mysqli, $query);
$purchase_id = mysqli_insert_id($mysqli);
$date = time();
$purchase_datetime = date("Y-m-d H:i:s", $date);
  return 'bid already exists';


}
else
{
return "error";

}


}

function copyBuyAgentPriceslotsSubscripts($user_id, $agent_ID, $link_id, $price, $cat_id, $installer_id, $coin_type,  $users_balance_string){

$balance_pieces = explode("|", $users_balance_string);
//these might be backwards?
$balance = $balance_pieces[0];
$tn_balance = $balance_pieces[1];
/* dropping $links_approval_status, because it generates errors after a purchase

function copyBuyAgentPriceslotsSubscripts($user_id, $agent_ID, $link_id, $price, $cat_id, $installer_id, $coin_type, $links_approval_status, $users_balances_string){
*/
//echo '<br>in func $users_balances_string = ', $users_balances_string;
//echo '<br>in func $link_id = ', $link_id;

//echo '<br> in copyBuyAgentPriceslotsSubscripts( func line 843 <br>$user_id = ',$user_id,'<br>agent ID =', $agent_ID, $link_id, $price, $cat_id, $installer_id, $coin_type;
date_default_timezone_set('America/New_York');

if (!defined('WRITER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".WRITER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
$subscribe = 0;//will will update this when the links table is updated from central
$start_date = time();
//SELECT `id`, `user_id`, `link_id`, `price_slot_amnt`, `subscribe`, `coin_type`, `cat_id`, `t_timestamp`, `start_date`, `agent_ID`, `installer_id` FROM `price_slots_subscripts`
$query = "SELECT * FROM `price_slots_subscripts` WHERE `link_id` =  '".$link_id."' AND `agent_ID` = '".$agent_ID."'";
//echo '<br>', $query;
$result = mysqli_query($mysqli, $query);
$row_cnt = mysqli_num_rows($result);

//we need to eventually delete these that we found but first need to copy them to the archive and then copy the new bid and then delete
//SELECT `id`, `previous_id`, `pre_start_date`, `transfer_date`, `pre_amount`, `new_amount`, `reason`, `agent_ID`, `link_id` FROM `price_slots_archive`
if($row_cnt > 0){
   return 'bid already exists';


}
else
{
$query = "INSERT INTO `price_slots_subscripts` (`user_id`,`link_id`,`price_slot_amnt`,`subscribe`,`coin_type`,`cat_id`, `start_date`, `agent_ID`,`installer_id`) VALUES (    '$user_id' ,  '$link_id','$price','$subscribe','$coin_type','$cat_id', '$start_date', '$agent_ID', '$installer_id') ";
echo '<br>', $query;
$result = mysqli_query($mysqli, $query);
$purchase_id = mysqli_insert_id($mysqli);
$date = time();
$purchase_datetime = date("Y-m-d H:i:s", $date);
/* under construction
status - it inserts but two variables fed here ($links_approval_status, $users_balances_string) aren't processed yet
The first ($links_approval_status) was intend to deal with the differences between a temp bid (pending approval) and an already approved one BUT we probably can handle that from admin? Maybe when we approve a new link or move the temp subscripts to live.

Alternate - I added a status column with a default of 'pending" to indicate on ALL bids that they were new and also haven't been charged yet Not until nightly cron). Could either do another duplicate entry when actually processed (then there would be the one entry flagging when the subscription started) or could run an update script from the agent.

Does the cron insert into the agents db?

	id 	user_id 	link_id 	balance 	tn_balance 	trans_time 	trans_type 	deposit 	deposit_id 	purchase 	purchase_id */
$query = "INSERT INTO `price_slots_daily_ledger` (`user_id`,`link_id`,`balance`,`tn_balance`,`trans_time`,`trans_type`, `deposit`, `deposit_id`,`purchase`,`purchase_id`,`coin_type`,`status`) VALUES (    '$user_id' ,  '$link_id','$balance','$tn_balance','$purchase_datetime','purchase', 0, 0, '$price', '$purchase_id', '$coin_type', 'pending') ";
$result = mysqli_query($mysqli, $query);
}
}

 function sendBuyToCentral ($user_id, $agent_ID, $link_id, $price, $cat_id, $installer_id, $coin_type, $reason){
//now send user registration to central
$file="https://exchange.manna-network.com/incoming/buy.php";
$args = http_build_query(array(
'user_id' => $user_id,
'agent_ID' => $agent_ID,
'cat_id' => $cat_id,
'installer_id'=>$installer_id,
'link_id' => $link_id,
'price' => $price,
'coin_type' => $coin_type,
'reason' => $reason));
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
echo($data);

}
         function sendModifyToCentral ($user_id, $agent_ID, $link_id, $new_price, $old_price,$cat_id, $installer_id, $coin_type, $reason, $this_links_bid_status_on_Central){
//now send user registration to central


//echo'</h3>';
if($reason === "cancel"){

if($this_links_bid_status_on_Central === "temp_bid"){
$file="https://exchange.manna-network.com/incoming/cancel_temp_bid.php";
}else
{
echo '<br> $this_links_bid_status_on_Central after else = temp_bid', $this_links_status_on_Central;

$file="https://exchange.manna-network.com/incoming/cancel_subs_bid.php";
}
}
else
{
//echo '<br> in reason = else cancel';

	if($this_links_bid_status_on_Central == "temp_bid"){
//echo '<br> in reason = else cancel, $this_links_bid_status_on_Central == "temp_bid"';

	$file="https://exchange.manna-network.com/incoming/modify_temp_bid.php";
	}else
	{
	$file="https://exchange.manna-network.com/incoming/modify_subs_bid.php";
	}
}
$args = http_build_query(array(
'user_id' => $user_id,
'link_id' => $link_id,
'agent_ID' => $agent_ID,
'new_price' => $new_price,
'old_price' => $old_price,
'cat_id' => $cat_id,
'installer_id' => $installer_id,
'coin_type' => $coin_type,
'reason' => $reason));
/*'this_links_status_on_Central' => $this_links_bid_status_on_Central, is not used on either of above pages */
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
echo($data);
}

function getUserBalanceFromCentral ($user_id, $agent_ID){
$file="https://exchange.manna-network.com/incoming/check_balance.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2_0);
curl_setopt($ch, CURLOPT_URL, $file);
curl_setopt($ch, CURLOPT_POSTFIELDS,'user_id='.$user_id.'&agent_ID='.$agent_ID);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}

function getUsersPriceSlotAmount($user_id, $agent_ID, $link_id, $cat_id, $coin_type){
$file="https://exchange.manna-network.com/incoming/get_bid_amount_by_remote_link_id.php";
$args = http_build_query(array(
'user_id' => $user_id,
'agent_ID' => $agent_ID,
'remote_link_id' => $link_id,
'cat_id' => $cat_id,
'coin_type' => $coin_type));
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}

function getPricePopByCat($category, $price_slot_amount, $coin_type){
$file="https://exchange.manna-network.com/incoming/get_price_pop_by_cat.php";
$args = http_build_query(array(
'price' => $price_slot_amount,
'coin_type' => $coin_type,
'cat_id' => $category));
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}

function getPricePopByCatAndRegion($category, $price_slot_amount, $coin_type, $location_id){
$file="https://exchange.manna-network.com/incoming/get_price_pop_by_cat_and_region.php";
$args = http_build_query(array(
'price' => $price_slot_amount,
'coin_type' => $coin_type,
'cat_id' => $category,
'location_id' => $location_id));
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}


function getSeniorPriceSlotsCountFromCentral($category, $price_slot_amount, $coin_type){
$file="https://exchange.manna-network.com/incoming/check_for_bids_by_cat_and_price.php";
$args = http_build_query(array(
'price' => $price_slot_amount,
'coin_type' => $coin_type,
'cat_id' => $category));
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}

function getSeniorPriceSlotsCountFromCentral2bd($category, $price_slot_amount, $coin_type){
if (!defined('READER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
$query = "SELECT * FROM price_slots_subscripts WHERE cat_id='$category' AND price_slot_amnt='$price_slot_amount' AND coin_type='$coin_type' ";
$result = @mysqli_query($mysqli, $query) or die("Couldn't execute 'Edit 3 Account' query");
$num_rows = mysqli_num_rows($result);

$query = "SELECT * FROM temp_price_slots_subscripts WHERE cat_id='$category' AND price_slot_amnt='$price_slot_amount'  AND coin_type='$coin_type'";
$result = @mysqli_query($mysqli, $query) or die("Couldn't execute 'Edit 3 Account' query");
$num_rows2 = mysqli_num_rows($result);
return $num_rows+$num_rows2;
}

function getPriceSlotPopulation($cat_id, $coin_type, $price_slot_amount){

if (!defined('READER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
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



function get_price_slots_by_index( $steps_by_index){
 $lowest_price_slot_to_display = $steps_by_index[0];
$highest_price_slot_to_display = $steps_by_index[1];// $steps_by_index[2] adds the number of extra empty price slots (for a bidder to get #1) on top of the current #1
$number_of_price_slots_to_return = $highest_price_slot_to_display - $lowest_price_slot_to_display  + $steps_by_index[2] +2;
//Dev note - had to add two to the number in the loop despite also including the stps by index. Not sure why the number is off but adding two displays two new price slots to gain #1 spot.

//the $daily_minimum_bid_target var is set automatically at the top of the buy_price_slot.php page to "estimate" the price slots to result in minimum bid being worth about $5 per month. That can be changed by editing that page.
 //but we will only want to return three price slots starting at the minimum five dollar a month target


//this func establishes ALL price slots up to the 50th(N) - which is 4.250810001427
//PRICE SLOT VALUES ARE PRACTICALLY SPEAKING PERMANENT! They serve as names of the positions in the databases
// Note - 10 decimal places (two more than 8 decimals of BCH for extra precision)
// Note that is the per-diem so the current price list works up to 6.376215002141 X $422.60 = $2500 +- ad expense per day.
// As the BCH price climbs it can handle higher daily bids but currently can handle prices down to .00000001 BCH (one Satoshi) even though the BSV network can't go that low.
$return_array = array(); //
$counter=49;
	for($i=0;$i<=$counter;$i++){
	$base = 0.00000001;
		if($i==0){
		$step[$i]= number_format($base * 1.5, 12);
$step[$i+1]= number_format($step[$i] * 1.5, 12);
$step[$i+2]= number_format($step[$i+1] * 1.5, 12);
		}
		else
		{

		$step[$i]= number_format($step[$i-1] * 1.5, 12);
$step[$i+1]= number_format($step[$i] * 1.5, 12);
$step[$i+2]= number_format($step[$i+1] * 1.5, 12);

//next, we compare the price slot value at this point to the target of $5 per month/30 and break if we have reached it.
//we return the lowest price slot meeting the $5 a month minimum plus the next two highest ones

if($i >= $lowest_price_slot_to_display+1){

array_push($return_array, $step[$i]);

$number_of_price_slots_to_return = $number_of_price_slots_to_return-1;

if($number_of_price_slots_to_return == 0){
return $return_array;
break;
}
}
		}
	}
	return $step;
}




function get_current_index_of_priceslot( $priceslot){
//again, convuleted formatting issues needing to reformat (also used on get_Hi_Low.php
$pieces = explode(".", $priceslot);
$padded_pieces = str_pad($pieces[0], 3, "0", STR_PAD_LEFT);

$priceslot=$padded_pieces.".".$pieces[1];
//echo '<br>In get_current_index_of_priceslot func and trying to get index of repadded ', $priceslot;
$counter=49;
	for($i=0;$i<=$counter;$i++){
	$base = 0.00000001;
$return_array = array(); //re-instantiate the array each time the itearation didn't meet the conditions
		if($i==0){
		$step[$i]= number_format($base * 1.5, 12);
		}
else
		{
		$step[$i]= number_format($step[$i-1] * 1.5, 12);
		}
//next, we compare the price slot value at this point to the current price slot and break if we have reached it.
//we return the index of that price slot (because we need to build the display form according to the lowest and the highest plus a couple more for new highest bidders)
$temp_slot = number_format($step[$i] , 8);
$priceslot =  number_format($priceslot , 8);
//echo '<br>$i = '. $i . ' and $temp_slot = number_format($step[$i] , 10) = '. $temp_slot. '  and $priceslot =  number_format($priceslot , 10) = '. $priceslot;
if($temp_slot == $priceslot){
$index_of_priceslot = $i;
return $index_of_priceslot;
break;
}
}
return 0;
}


    function get_price_slots_no_bids( $daily_minimum_bid_target, $number_of_extra_price_slots) {

//the $daily_minimum_bid_target var is set automatically at the top of the buy_price_slot.php page to "estimate" the price slots to result in minimum bid being worth about $5 per month. That can be changed by editing that page.
$counter=49; //but we will only want to return three price slots starting at the minimum five dollar a month target


//this func establishes ALL price slots up to the 50th(N) - which is 4.250810001427
//PRICE SLOT VALUES ARE PRACTICALLY SPEAKING PERMANENT! They serve as names of the positions in the databases
// Note - 10 decimal places (two more than 8 decimals of BCH for extra precision)
// Note that is the per-diem so the current price list works up to 6.376215002141 X $422.60 = $2500 +- ad expense per day.
// As the BCH price climbs it can handle higher daily bids but currently can handle prices down to .00000001 BCH (one Satoshi) even though the BSV network can't go that low.

	for($i=0;$i<=$counter;$i++){
	$base = 0.00000001;
$return_array = array(); //re-instantiate the array each time the itearation didn't meet the conditions
		if($i==0){
		$step[$i]= number_format($base * 1.5, 12);
$step[$i+1]= number_format($step[$i] * 1.5, 12);
$step[$i+2]= number_format($step[$i+1] * 1.5, 12);
		}
		else
		{
		$step[$i]= number_format($step[$i-1] * 1.5, 12);
                $step[$i+1]= number_format($step[$i] * 1.5, 12);
                $step[$i+2]= number_format($step[$i+1] * 1.5, 12);

//next, we compare the price slot value at this point to the target of $5 per month/30 and break if we have reached it.
//we return the lowest price slot meeting the $5 a month minimum plus the next two highest ones

if($step[$i] >= $daily_minimum_bid_target AND $daily_minimum_bid_target <= $step[$i+1] ){

$return_array[0] = $step[$i];
for($extra=1; $extra <= $number_of_extra_price_slots; $extra++){
$return_array[$extra] = $step[$i+$extra];
}
return $return_array;
break;

}
		}
	}
	return $step;
    }

function get_minimum_price_slot($daily_minimum_bid_target){
$counter=49;
$daily_minimum_bid_target =  number_format($daily_minimum_bid_target, 8);
	for($i=0;$i<=$counter;$i++){
	$base = 0.00000001;
		if($i==0){
		$step[$i]= number_format($base * 1.5, 12);
		}
		else
		{
		$step[$i]= number_format($step[$i-1] * 1.5, 12);
	$temp_format = number_format($step[$i], 8);
		if($temp_format >= $daily_minimum_bid_target){

		//only return price slots if they are equal to or higher the current target minimum
		$minimum_bid=$step[$i];
		return $minimum_bid;
		}
	      }
	$counter++;
	}
}

    function get_price_slots($maxpriceslot, $daily_minimum_bid_target, $number_of_extra_price_slots) {
//$daily_minimum_bid_target is only a ballpark value and fluctuates depending on market price and represents a decimal percentage of a current whole BSV equal to the monthly target fee wanted.
$counter=49;
//echo '<br> in func $maxpriceslot = ', $maxpriceslot;
//echo '<br> in func $daily_minimum_bid_target = ', $daily_minimum_bid_target;
//echo '<br> in func $number_of_extra_price_slots = ', $number_of_extra_price_slots;

//echo '<br> in func number_format($maxpriceslot = ', number_format($maxpriceslot, 8);
//echo '<br> in func number_format($daily_minimum_bid_target = ', number_format($daily_minimum_bid_target, 8);


$maxpriceslot =  number_format($maxpriceslot, 8);
$daily_minimum_bid_target =  number_format($daily_minimum_bid_target, 8);

//echo '<br> in func formatted $maxpriceslot = ', $maxpriceslot;
//echo '<br> in func $daily_minimum_bid_target = ', $daily_minimum_bid_target;
//this func establishes ALL price slots up to the 50th(N) - which is 4.250810001427
//PRICE SLOT VALUES ARE PRACTICALLY SPEAKING PERMANENT! They serve as names of the positions
// Note - 12 decimal places (two more than 10 decimals of the db)
// As the BSV price climbs it can handle higher daily bids but currently can handle prices down to .00000001 BCH (one Satoshi) even though the network can't go that low.
$return_array = array();
$return_counter=0;

	for($i=0;$i<=$counter;$i++){

	$base = 0.00000001;
		if($i==0){
		$step[$i]= number_format($base * 1.5, 12);
		}
		else
		{
		$step[$i]= number_format($step[$i-1] * 1.5, 12);
$temp_format = number_format($step[$i], 8);
if($temp_format >= $daily_minimum_bid_target){

//only return price slots if they are equal to or higher the current target minimum
$return_array[$return_counter]=$step[$i];

if($maxpriceslot == $temp_format){
//now that we located the "$i" value matching top max price slot create a limit using the $number_of_extra_price_slots and return when reached in a couple more passes

for($a=1;$a<=$number_of_extra_price_slots;$a++)
{
if($a == 1){
$return_array[$return_counter+ $a]= number_format($step[$i] * 1.5, 12);
}
else
{
$return_array[$return_counter+ $a]= number_format($return_array[$return_counter+ $a-1] * 1.5, 12);
}
$i = $i + $a;
	     }
		return $return_array;
                }
$return_counter++;
}
	    }
	}
	return $step;
    }



function getRegionalPopulation($link_id,$agent_ID){
if (!defined('READER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");

$sql = "SELECT *
FROM `regional_sign_ups`
WHERE `link_id` = '$link_id' AND `agent_ID`= '$agent_ID'";

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

function getRegionalLftRgt($regionalnum){
//echo '<br>in getRegionalLftRgt';
if (!defined('READER_AGENTS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_AGENTS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");

$sql = "SELECT *
FROM `categories_regional2`
WHERE `id` = '$regionalnum' ";
//echo '<br>', $sql;
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit lftrgt Account' query");
//echo '<br>$result->num_rows = ', $result->num_rows;

if ($result->num_rows > 0) {
 while($row = mysqli_fetch_assoc($result)){
 //echo '<br>row = ';
 print_r($row);
$lft = $row['lft'];
//echo '<br>$lft = ', $lft;
//echo '<br>$row[lft] = ', $row['lft'];


$rgt = $row['rgt'];
}
//echo '<br>row = ';
//print_r($row);
//echo '<br>$lft = ', $lft;

$sql2 = "SELECT *
FROM `categories_regional2`
WHERE `lft` < $lft AND `rgt` > $rgt ";
//echo '<br>', $sql2;
$result = mysqli_query($mysqli, $sql2) or die("Couldn't execute 'Edit lftrgt2 Account' query");
if ($result->num_rows > 0) {
 while($row = mysqli_fetch_assoc($result)){
 //echo '<br>row = ';
 //print_r($row);
$lft = $row['lft'];
$rgt = $row['rgt'];
}
}
else
{
while($row = mysqli_fetch_assoc($result)){
$lft[] = $row['lft'];
$rgt[] = $row['rgt'];
}
$send_array= array($lft, $rgt);
//echo '<br>send array = ';
//print_r($send_array);
return $send_array;
}
}
else
{
return false;
}





}

function getMinMaxPriceSlotFromCentral($cat_id, $coin_type){
$file="https://exchange.manna-network.com/incoming/get_Hi_Low.php";
$args = http_build_query(array(
'cat_id' => $cat_id,
'coin_type' => $coin_type));

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}

/* Probably not used anywhere, commented out before deletion. Was intended to check subscripts on local agent server but can use check_for_bids_by_remote_link_id.php to get the status if needed (build a curl to that link).
This function only called once to generate a fake "if" condition at the top of views/includes/buy_section1.php. Removed the if so probably don't need this function 3/15/2020
*/
function getLinkPayStatus($link_id, $agent_ID){

if (!defined('READER_AGENTS')) {
include(dirname( __DIR__, 3 ). "/manna_network/manna-configs/db_cfg/agent_config.php");
}

$args3 = array(
'link_id' => $link_id,
'agent_ID' => $agent_ID
);
//reminder - don't need the $mn_agent_url or $mn_agent_folder variables to be sent -they are only used in the url

//$url3 = "https://".AGENT_URL."/".AGENT_FOLDERNAME."/mannanetwork-dir/get_links_json_ajax_reg.php";
$url3 = "https://".AGENT_URL."/".AGENT_FOLDERNAME."/mannanetwork-dir/check_for_bids_by_remote_link_id.php";
//echo $url3;
     $ch = curl_init();    // initialize curl handle
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_URL, $url3);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 50);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $args3);
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
//  curl_setopt($ch, CURLOPT_PORT, $port);

    $status = curl_exec($ch);
    $curl_errno = curl_errno($ch);
    $curl_error = curl_error($ch);
    if ($curl_errno > 0) {
            echo "cURL Error ($curl_errno): $curl_error\n";
    } else {
//returns $send_array = array($url, $name, $description, $website_street, $website_district)
/*$url_array = $linksList2[0];
$name_array = $linksList2[1];
$description_array = $linksList2[2];
$website_street_array = $linksList2[3];
$website_district_array = $linksList2[4];
*/

echo $status;
}


}


function getBidByLinkID($link_id, $coin_type){

if (!defined('READER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");

$sql = "SELECT *
FROM `price_slots_subscripts`
WHERE `link_id` = '$link_id' AND `coin_type`= '$coin_type'";
//echo '<br> ', $sql;
//echo '<br>';
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 11b Account' query");
if ($result->num_rows > 0) {
 while($row = mysqli_fetch_assoc($result)){
 $price_slot_amnt = $row['price_slot_amnt'];
$rank = $row['rank_by_cat'];
}
$return_str = $price_slot_amnt."|".$rank;
return $return_str;
}
else
{
return false;
}

}



function getLinkByUserIdFree($user_id){

if (!defined('READER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");

if($user_id >0){
//SELECT `id`, `user_id`, `recruiter_lnk_num`, `website_title`, `website_description`, `website_url`, `category_id`, `location_id`, `website_street`, `page_name`, `map_link`, `bridge_id`, `user_registration_datetime`, `installer_id` FROM `customer_links` WHERE 1
$query = "SELECT * FROM customer_links WHERE user_id='$user_id'  ORDER BY `user_registration_datetime` ASC";
$result = @mysqli_query($mysqli, $query) or die("Couldn't execute 'Edit 3 Account' query");
$num_rows = mysqli_num_rows($result);
if($num_rows > 1){
while ($row = mysqli_fetch_array($result)){
$id[] = $row['id'];
$user_id2[] = $row['user_id'];
$recruiter_lnk_num[] = $row['recruiter_lnk_num'];
$website_title[] = $row['website_title'];
$website_description[] = $row['website_description'];
$protocol[] = $row['protocol'];
$website_url[] = $row['website_url'];
$category_id[] = $row['category_id'];
$location_id[] = $row['location_id'];
$website_street[] = $row['website_street'];
$page_name[] = $row['page_name'];
$map_link[] = $row['map_link'];
$bridge_id[] = $row['bridge_id'];
$user_registration_datetime[] = $row['user_registration_datetime'];
$installer_id[] = $row['installer_id'];
}
$num_links_this_user = count($id);
}
elseif($num_rows > 0){

while ($row = mysqli_fetch_array($result)){
$id = $row['id'];
$user_id2 = $row['user_id'];
$recruiter_lnk_num = $row['recruiter_lnk_num'];
$website_title = $row['website_title'];
$website_description = $row['website_description'];
$protocol = $row['protocol'];
$website_url = $row['website_url'];
$category_id = $row['category_id'];
$location_id = $row['location_id'];
$website_street = $row['website_street'];
$page_name = $row['page_name'];
$map_link = $row['map_link'];
$bridge_id = $row['bridge_id'];
$user_registration_datetime = $row['user_registration_datetime'];
$installer_id = $row['installer_id'];

}
$num_links_this_user = 1;
}


$send_array = array($num_links_this_user, $id, $user_id, $recruiter_lnk_num, $website_title, $website_description, $protocol, $website_url, $category_id, $location_id, $website_street, $page_name, $map_link, $bridge_id, $user_registration_datetime, $installer_id);

return $send_array;
}

}




}
?>
