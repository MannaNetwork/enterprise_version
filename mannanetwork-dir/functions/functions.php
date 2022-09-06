 <?php
function getNumRowsAllInOne($category, $lft, $rgt){
 if (!defined('READER_AGENTS')) {
 include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
 }
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
        if($lft > 0 && $rgt > 0){
        $query = "SELECT COUNT(*) FROM `links` WHERE `category` = $category and `location_id` IN (SELECT `id` as `location_id` FROM `categories_regional2` WHERE `lft` > $lft && `rgt` < $rgt)";
        }
        else
        {
         $query = "SELECT COUNT(*) FROM `links` WHERE `category` = $category";
        }
$result = mysqli_query($mysqli, $query);
$row = mysqli_fetch_row($result);
return $row[0];
}
 
 
function advertiser_agent_bridge($http_host){
 if (!defined('READER_AGENTS')) {
 include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
 }
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/pdo_connect.php");

$stmt = $dbh->prepare("SELECT `id`, `agent_id`, `remote_user_id` FROM `advertiser_agent_bridge` WHERE `agent_id`=? && `remote_user_id`=?");
$stmt->bindParam(':user_active', 0);
$stmt->bindParam(':website_url', "%$http_host%");
$stmt->execute(["%$_GET[name]%"]);
//$sth->debugDumpParams();
}
 function resend_email_verification($http_host){
 if (!defined('READER_AGENTS')) {
 include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
 }
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/pdo_connect.php");

$stmt = $dbh->prepare("SELECT * FROM users WHERE user_active=? AND website_url LIKE ?");
$stmt->bindParam(':user_active', 0);
$stmt->bindParam(':website_url', "%$http_host%");
$stmt->execute(["%$_GET[name]%"]);
//$sth->debugDumpParams();


 }
/* function getRegionsForAJAX($regional_num){
REPLACED WITH getMenuForAJAX($dbID,$type){ below?
 if (!defined('READER_AGENTS')) {
 include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
 }
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
        $query = "SELECT * FROM categories_regional2 WHERE parent = '".$regional_num."' ORDER BY NAME";
	$query= mysqli_query($mysqli, $query);
	if(mysqli_num_rows($query) > 0){
		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
		$send_array[] = $row ;
		}
		return $send_array;
	}
	else
	{
	$empty = "Sorry, No Regional Entries Found.";
	return $empty; 
	}
}
*/


function getMenuForAJAX($dbID,$type){
//dbID is either the category ID or the region ID (depending on type) 
 if (!defined('READER_AGENTS')) {
  include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
 }
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
	if($type == "regions"){
		$query = "SELECT * FROM categories_regional2 WHERE parent = '".$dbID."' ORDER BY NAME";
	}
	else
	{
	$query = 'SELECT * FROM `categories` WHERE parent='.$dbID.' ORDER BY name;';
	$result= mysqli_query($mysqli, $query);
	}

	$query= mysqli_query($mysqli, $query);
	if(mysqli_num_rows($query) > 0){
		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
		$send_array[] = $row ;
		}
	$json_encode_send_array = json_encode($send_array, true);
	return $json_encode_send_array;
	}
	else
	{
		if($type == "regions"){
		$empty = json_encode("Sorry, No More Regional Filters Found.");
		}
		else
		{
		$empty = json_encode("Sorry, No More Categories Found.");
		}
	return $empty; 
	}
}


function checkIfRegistered($url){
//this looks like it might not be used because of the printf it does?
 if (!defined('READER_AGENTS')) {
  include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/auth_constants.php");
 }
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
	$query = 'SELECT name FROM `customer_links` WHERE website_url="'.$url.'"';
	$result = mysqli_query($mysqli, $query);
	$row = mysqli_fetch_row($result);
	return $row[0];

if ($result = mysqli_query($mysqli, "SELECT name FROM `customer_links` WHERE website_url=".$url)) {
   $row_cnt = mysqli_num_rows($result);
    printf("Result set has %d rows.\n", $row_cnt);
    mysqli_free_result($result);
}
}

function getLinksAllInOne($category_id, $page_num, $number_of_pages, $number_of_links, $tregional_num, $lft, $rgt){
 if (!defined('READER_AGENTS')) {
  include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
 }
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");

if($tregional_num > 0){
$query = "SELECT `name`, `description`, `url` FROM `links` WHERE `category` = $category_id and `location_id` IN (SELECT `id` as `location_id` FROM `categories_regional2` WHERE `lft` > $lft && `rgt` < $rgt) ORDER by coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date" ;
}
else
{
$query = "SELECT `name`, `description`, `url` FROM `links` WHERE `category` = $category_id ORDER by coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date" ;
}
//build the limits (if applicable)
if($number_of_pages > 1){
	if(  $page_num  == 1 ){
	$lower_limit = 0;
	$upper_limit = 19;
	}
	else
	{ //we need to do some math
	$lower_limit = 20* ($page_num - 1);
	$upper_limit = (20* $page_num) -1;
	}
//concatenate the LIMIT onto the query
$query .= " LIMIT ". $lower_limit.','. $upper_limit ;	
}

	if ($result= mysqli_query($mysqli, $query)){
		if(mysqli_num_rows($result) > 0){
		   while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			$send_array[] = $row ;
			}
		   return json_encode($send_array, true);
		}
		else
		{
		   return json_encode("Sorry, No Links Found.", true); 
		}
		mysqli_free_result($result);
	}
	else
	{
	return json_encode("Problem connecting to database.", true); 
	}
	mysqli_close($mysqli);
}
	
function getCategoryChildren($id){
//sent note to my Gmail titled Duplicate Functions about this
 if (!defined('READER_AGENTS')) {
  include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
 }
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
if($id == ""){
$id = 1;
}
//we can't filter out empty categories until we figure out how to handle when cat is empty but subcats have links
//$query = 'SELECT * FROM `categories` WHERE parent='.$id.'  AND link_count > 0 ORDER BY name;';
	$query = 'SELECT * FROM `categories` WHERE parent='.$id.' ORDER BY name;';
	$result= mysqli_query($mysqli, $query);
     if(mysqli_num_rows($result) > 0){  
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	$send_array[] = $row ;
	}
	$json_encode_send_array = json_encode($send_array, true);
	}
	else
	{
	//removed "true" from encoding trying to fix parse errors in members/addalink
	$json_encode_send_array = json_encode("NO MORE SUB CATEGORIES"); 
	}
return $json_encode_send_array;
}

function getCategoryChildrenForAJAX($id){
//sent note to my Gmail titled Duplicate Functions about this
//THIS FUNCTION SEEMS IDENTICAL TO THE ONE ABOVE - CANDIDATE FOR DELETION AFTER A CHECK TO DETERMINE IF USED IN THE CODE
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
if($id == ""){
$id = 1;
}

include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
//we can't filter out empty categories until we figure out how to handle when cat is empty but subcats have links
//	$query = 'SELECT id, name as cname,parent,lft,rgt,link_count FROM `categories` WHERE parent='.$id.'  AND link_count > 0 ORDER BY name;';
$query = 'SELECT id, name as cname,parent,lft,rgt,link_count FROM `categories` WHERE parent='.$id.' ORDER BY name';
	$result= mysqli_query($mysqli, $query);
     if(mysqli_num_rows($result) > 0){  
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	$send_array[] = $row ;
	}
$json_encode_send_array = json_encode($send_array, true);
		return $json_encode_send_array;

}
else
{
return json_encode("NO MORE SUB CATEGORIES"); 

}
}

function categoryName($id){
 if (!defined('READER_AGENTS')) {
  include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/auth_constants.php");
 }
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
$id = mysqli_real_escape_string($mysqli, $id);
$query = 'SELECT name FROM `categories` WHERE id="'.$id.'"';
$result = mysqli_query($mysqli, $query);
$row = mysqli_fetch_row($result);
return $row[0];
}

function categoryPath($catid, $regional_number){
//this function gets the categories HIGHER than the inputted regional number
 if (!defined('READER_AGENTS')) {
  include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/auth_constants.php");
 }
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
	$path = '';
	$catid=mysqli_real_escape_string($mysqli, $catid);
	$query = 'SELECT lft,rgt FROM `categories` WHERE id="'.$catid.'"';
	$result = mysqli_query($mysqli, $query);
	$row = mysqli_fetch_array($result);
	$lft = $row['lft'];
	$rgt = $row['rgt'];
	$query = 'SELECT name,id FROM `categories` WHERE lft < '.$lft.' AND rgt > '.$rgt.' ORDER BY lft ASC';
	$result = mysqli_query($mysqli, $query);
	while($row = @mysqli_fetch_array($result)){
		if($row['id'] != '1')
if($regional_number != ""){
$path .= ' | <a href="/'.$folder_name.'/'.$file_name.'/'. $affiliate_num.'/'.$row['id'].'///////'.$regional_number.'">'.$row['name'].'</a>';
}
else
{
$path .= ' | <a href="/'.$folder_name.'/'.$file_name.'/'. $affiliate_num.'/'.$row['id'].'">'.$row['name'].'</a>';
}
	}
return $path;
}

function lftRgtRegion($regional_number){
 if (!defined('READER_AGENTS')) {
  include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
 }
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");

$regional_number=mysqli_real_escape_string($mysqli, $regional_number);
	$query = 'SELECT id,lft,rgt FROM `categories_regional2` WHERE id="'.$regional_number.'"';
	$result = mysqli_query($mysqli, $query);
	$rowcount=mysqli_num_rows($result);
	while($row = mysqli_fetch_array($result)){
		if($rowcount==1){
		$id = $row['id'];
		$lft = $row['lft'];
		$rgt = $row['rgt'];
		}
	}
$send_array = array($id,$lft,$rgt);
return $send_array;
}

function getRegionTree($lft,$rgt){
 if (!defined('READER_AGENTS')) {
  include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
 }
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");

$regional_number=mysqli_real_escape_string($mysqli, $regional_number);
	$query = 'SELECT `id`,`lft`,`rgt` FROM `categories_regional2` WHERE `lft` > '.$lft.' && `rgt` < '.$rgt; 
	$result = mysqli_query($mysqli, $query);
	while($row = mysqli_fetch_array($result)){
		$id[] = $row['id'];
	}
$send_array = json_encode($id,true);
return $send_array;
}
?>

