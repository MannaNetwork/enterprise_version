 <?php
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
function getRegionsForAJAX($regional_num){
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
//$query = 'SELECT id, name as cname,parent,lft,rgt,link_count FROM `categories` WHERE parent='.$dbID.' ORDER BY name';
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
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
//$id = mysqli_real_escape_string($mysqli, $id);
	$query = 'SELECT name FROM `customer_links` WHERE website_url="'.$url.'"';
	$result = mysqli_query($mysqli, $query);

	$row = mysqli_fetch_row($result);

	return $row[0];

if ($result = mysqli_query($mysqli, "SELECT name FROM `customer_links` WHERE website_url=".$url)) {

    /* determine number of rows result set */
    $row_cnt = mysqli_num_rows($result);

    printf("Result set has %d rows.\n", $row_cnt);

    /* close result set */
    mysqli_free_result($result);
}

}

function combgetLinksAsJSONbyPageNumReg($category_id, $page_num, $tregional_num){
//defective Marked for deprecation. New method for regions requires multiple functions to retrieve the location tree
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");

if($tregional_num > 0){
$query = "SELECT `name`, `description`, `url` FROM `links` WHERE `category`='".$category_id."' && `location_id`='".$tregional_num."' ORDER by coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date" ;
}
else
{
$query = 'SELECT `name`, `description`, `url` FROM `links` WHERE category='.$category_id.' ORDER BY coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date' ;
}

$result= mysqli_query($mysqli, $query);
 $mysqli_num_rows = mysqli_num_rows($result);
	if($mysqli_num_rows > 20){
	$number_of_pages =ceil($mysqli_num_rows/20);
unset($send_array);
		if(  $page_num  == 1 ){
		$lower_limit = 0;
		$upper_limit = 19;
			if($tregional_num > 0){
			$query = "SELECT `name`, `description`, `url` FROM `links` WHERE `category`='".$category_id."' && `location_id`='".$tregional_num."' ORDER by coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date LIMIT ". $lower_limit.','. $upper_limit ;
			}
			else
			{
			$query = "SELECT `name`, `description`, `url` FROM `links` WHERE category='$category_id' ORDER BY coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date LIMIT ". $lower_limit.','. $upper_limit ;
			}
			$result= mysqli_query($mysqli, $query);
			 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$send_array[] = $row ;
			}
		return json_encode($send_array, true); 
		}
		elseif($page_num > 1 AND $page_num != $number_of_pages)//do some math to fetch the limits)
		{
		$lower_limit = 20* ($page_num - 1);
		$upper_limit = (20* $page_num) -1;
			if($tregional_num > 0){
			$query = "SELECT `name`, `description`, `url` FROM `links` WHERE `category`='".$category_id."' && `location_id`='".$tregional_num."' ORDER by coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date LIMIT ". $lower_limit.','. $upper_limit ;
			}
			else
			{
			$query = 'SELECT `name`, `description`, `url` FROM `links` WHERE category='.$category_id.' ORDER BY coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date LIMIT '.$lower_limit.','. $upper_limit ;
			}

		$result= mysqli_query($mysqli, $query);
		 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			$send_array[] = $row ;
			}
		 return json_encode($send_array, true);
		}
		else
		{
		$lower_limit = 20* ($page_num - 1);
		$number_of_links_on_last_page = $mysqli_num_rows% 20;
		$upper_limit = $lower_limit + $number_of_links_on_last_page ;
			if($tregional_num > 0){
			$query = "SELECT `name`, `description`, `url` FROM `links` WHERE `category`='".$category_id."' && `location_id`='".$tregional_num."' ORDER by coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date LIMIT ".$lower_limit.','. $upper_limit ;
			}
			else
			{
			$query = 'SELECT `name`, `description`, `url` FROM `links` WHERE category='.$category_id.' ORDER BY coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date LIMIT '.$lower_limit.','. $upper_limit ;
			}
		$result= mysqli_query($mysqli, $query);
		 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			$send_array[] = $row ;
			}
		 return json_encode($send_array, true);
		}
	}elseif($mysqli_num_rows > 0){
		if($tregional_num > 0){
		$query = "SELECT `name`, `description`, `url` FROM `links` WHERE `category`='".$category_id."' && `location_id`='".$tregional_num."' ORDER by coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date" ;
		}
		else
		{
		$query = 'SELECT `name`, `description`, `url` FROM `links` WHERE category='.$category_id.' ORDER BY coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date LIMIT 20';
		}
			
	$result= mysqli_query($mysqli, $query);
	 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$send_array[] = $row ;
		}
	return json_encode($send_array, true);
	}
	else
	{
	return json_encode("Sorry, No Links Found.", true); 
	}
}



function getLinksAsJSONbyPageNumReg($category_id, $page_num, $tregional_num){
//can delete after we get comb version working
 //$page_num = 2; for testing
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");


$query = "SELECT links.id, name, description, url, regional_sign_ups.link_id, continent, country, state, city FROM links JOIN regional_sign_ups ON regional_sign_ups.link_id = links.id where (links.category='".$category_id."') AND (regional_sign_ups.continent = '".$tregional_num."' OR regional_sign_ups.country = '".$tregional_num."' OR regional_sign_ups.state = '".$tregional_num."' OR regional_sign_ups.city = '".$tregional_num."')";
echo '<br>in func getLinksAsJSONbyPageNumReg line 233 ', $query;
$result= mysqli_query($mysqli, $query);
 $mysqli_num_rows = mysqli_num_rows($result);
//echo '<h1>$mysqli_num_rows ='.$mysqli_num_rows.'</h1>';
	if($mysqli_num_rows > 20){
	//begin pagination condition
	//we need to run the paginator
	$number_of_pages =ceil($mysqli_num_rows/20);
//echo '<h1>$number_of_pages ='.$number_of_pages.'</h1>';
//echo '<h1>$page_num ='.$page_num .'</h1>';

unset($send_array);


						if(  $page_num  == 1 ){
						$lower_limit = 0;
						$upper_limit = 19;
				$query = "SELECT links.id, name, description, url, coin_type, price_slot, price_slot_prchs_date, start_date, regional_sign_ups.link_id, continent, country, state, city FROM links JOIN regional_sign_ups ON regional_sign_ups.link_id = links.id where (links.category='".$category_id."') AND (regional_sign_ups.continent = '".$tregional_num."' OR regional_sign_ups.country = '".$tregional_num."' OR regional_sign_ups.state = '".$tregional_num."' OR regional_sign_ups.city = '".$tregional_num."') ORDER BY links.coin_type DESC, links.price_slot DESC, links.price_slot_prchs_date, links.start_date LIMIT ". $lower_limit.','. $upper_limit ;
	// echo '<br>query page num 1', $query;			
$result= mysqli_query($mysqli, $query);
				 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					$send_array[] = $row ;
					}
				$json_encode_linksList = json_encode($send_array, true);  
 return $json_encode_linksList; 
						}
						elseif($page_num > 1 AND $page_num != $number_of_pages)//do some math to fetch the limits)
						{
 //echo '<br>query page num not 1 or last', $query;	
						$lower_limit = 20* ($page_num - 1);
						$upper_limit = (20* $page_num) -1;
				$query = "SELECT links.id, name, description, url, coin_type, price_slot, price_slot_prchs_date, start_date, regional_sign_ups.link_id, continent, country, state, city FROM links JOIN regional_sign_ups ON regional_sign_ups.link_id = links.id where (links.category='".$category_id."') AND (regional_sign_ups.continent = '".$tregional_num."' OR regional_sign_ups.country = '".$tregional_num."' OR regional_sign_ups.state = '".$tregional_num."' OR regional_sign_ups.city = '".$tregional_num."') ORDER BY links.coin_type DESC, links.price_slot DESC, links.price_slot_prchs_date, links.start_date LIMIT ".$lower_limit.','. $upper_limit ;

				$result= mysqli_query($mysqli, $query);
				 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					$send_array[] = $row ;
					}
				$json_encode_linksList = json_encode($send_array, true);
 return $json_encode_linksList; 
						}
						else
						{
//echo '<br> in else';
 //echo '<br>query page num last', $query;	
						$lower_limit = 20* ($page_num - 1);
						$number_of_links_on_last_page = $mysqli_num_rows% 20;
						$upper_limit = $lower_limit + $number_of_links_on_last_page ;
				$query = "SELECT links.id, name, description, url, coin_type, price_slot, price_slot_prchs_date, start_date, regional_sign_ups.link_id, continent, country, state, city FROM links LEFT JOIN regional_sign_ups ON regional_sign_ups.link_id = links.id where (links.category='".$category_id."') AND (regional_sign_ups.continent = '".$tregional_num."' OR regional_sign_ups.country = '".$tregional_num."' OR regional_sign_ups.state = '".$tregional_num."' OR regional_sign_ups.city = '".$tregional_num."') ORDER BY links.coin_type DESC, links.price_slot DESC, links.price_slot_prchs_date, links.start_date LIMIT ".$lower_limit.','. $upper_limit ;
//echo $query;
				$result= mysqli_query($mysqli, $query);
				 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					$send_array[] = $row ;
					}
				$json_encode_linksList = json_encode($send_array, true);
 return $json_encode_linksList;
				}

		
	 
	}
//we can delete everything above this because this will only load the first page (the others are handled by ajax)
	
	else
	{
	return "Sorry, No Links Found."; 
	}
}


function combgetNumberOfPages($catid){
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");

$query = "SELECT * FROM `links` WHERE `category`='".$catid."' ORDER by `price_slot` DESC";
$result= mysqli_query($mysqli, $query);
 $mysqli_num_rows = mysqli_num_rows($result);
	if($mysqli_num_rows > 20){
	//begin pagination condition
	//$number_of_pages for use by the paginator
	$number_of_pages =ceil($mysqli_num_rows/20);
}
elseif($mysqli_num_rows > 1){
	$number_of_pages =1;
}
else
{
$number_of_pages =0;
}
return $number_of_pages;
}


function getNumberOfPagesReg($catid, $tregional_num){
//can be deleted after combo works
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");

$query = "SELECT links.id, name, description, url, regional_sign_ups.link_id, continent, country, state, city
  FROM links
  JOIN regional_sign_ups ON regional_sign_ups.link_id = links.id where (links.category='".$catid."') AND (regional_sign_ups.continent = '".$tregional_num."' OR regional_sign_ups.country = '".$tregional_num."' OR regional_sign_ups.state = '".$tregional_num."' OR regional_sign_ups.city = '".$tregional_num."')";
//echo $query;
$result= mysqli_query($mysqli, $query);
 $mysqli_num_rows = mysqli_num_rows($result);
	if($mysqli_num_rows > 20){
	//begin pagination condition
	//we need to run the paginator
	$number_of_pages =ceil($mysqli_num_rows/20);
return $number_of_pages;
}
elseif($mysqli_num_rows > 1){
	//begin pagination condition
	//we need to run the paginator
	$number_of_pages =1;
return $number_of_pages;
}
else
{
$number_of_pages =0;
return $number_of_pages;
}

}


function getNumberOfPages($catid){
//can be deleted after combo works
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");

$query = "SELECT * FROM `links` WHERE category='".$catid."'";

$result= mysqli_query($mysqli, $query);
 $mysqli_num_rows = mysqli_num_rows($result);

	if($mysqli_num_rows > 20){
	//begin pagination condition
	//we need to run the paginator
	$number_of_pages =ceil($mysqli_num_rows/20);
return $number_of_pages;
}
elseif($mysqli_num_rows > 1){
	//begin pagination condition
	//we need to run the paginator
	$number_of_pages =1;
return $number_of_pages;
}
else
{
$number_of_pages =0;
return $number_of_pages;
}
}

function getRegions($regional_num){
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
	$json_encode_send_array = json_encode($send_array, true);
	//echo $json_encode_send_array;
		return $json_encode_send_array;
}
else
{
$json_encode_send_array = json_encode("Sorry, No More Regional Filters Found.", true); 
//echo $json_encode_send_array;
		return $json_encode_send_array;
//$empty = json_encode("Sorry, No Regional Entries Found.");
//return $empty;
}
}


function combgetLinksAsJSONbyPageNum($category_id, $page_num){
//can delete after we get comb version working
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");

$query = "SELECT `name`, `description`, `url` FROM `links` WHERE category='".$category_id."'";
$result= mysqli_query($mysqli, $query);
 $mysqli_num_rows = mysqli_num_rows($result);

	if($mysqli_num_rows > 20){
	//begin pagination condition
	//we need to run the paginator
	$number_of_pages =ceil($mysqli_num_rows/20);
unset($send_array);
						if($page_num == 1 ){
						$lower_limit = 0;
						$upper_limit = 19;
				 
				$result= mysqli_query($mysqli, $query);
				 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					$send_array[] = $row ;
					}
				$json_encode_linksList = json_encode($send_array, true);
						}
						elseif($page_num > 1 AND $page_num != $number_of_pages)//do some math to fetch the limits)
						{
						$lower_limit = 20* ($page_num - 1);
						$upper_limit = (20* $page_num) -1;
				$query = 'SELECT `name`, `description`, `url` FROM `links` WHERE category='.$category_id.' ORDER BY coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date LIMIT '.$lower_limit.','. $upper_limit ;
				$result= mysqli_query($mysqli, $query);
				 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					$send_array[] = $row ;
					}
				$json_encode_linksList = json_encode($send_array, true);
						}
						else
						{
						$lower_limit = 20* ($page_num - 1);
						$number_of_links_on_last_page = $mysqli_num_rows% 20;
						$upper_limit = $lower_limit + $number_of_links_on_last_page ;
				$query = 'SELECT `name`, `description`, `url` FROM `links` WHERE category='.$category_id.' ORDER BY coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date LIMIT '.$lower_limit.','. $upper_limit ;
				$result= mysqli_query($mysqli, $query);
				 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					$send_array[] = $row ;
					}
				$json_encode_linksList = json_encode($send_array, true);
				}		
	  return $json_encode_linksList;
	}
//we can delete everything above this because this will only load the first page (the others are handled by ajax)
	elseif($mysqli_num_rows < 20 AND $mysqli_num_rows > 0 ){
        //only one page worth of links - no pagination necessary
	$query = 'SELECT `name`, `description`, `url` FROM `links` WHERE category='.$category_id.' ORDER BY coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date LIMIT 20' ;

	$result= mysqli_query($mysqli, $query);
	 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$send_array[] = $row ;
		}
$json_encode_linksList = json_encode($send_array, true);
		return $json_encode_linksList;
	}
	else
	{
	return "Sorry, No Links Found."; 
	}
}

function getLinks($category_id){

//$category_id = 9;
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
    //    $query = 'SELECT * FROM `links` WHERE category='.$category_id.' ORDER BY price_slot desc; ';
$query = 'SELECT * FROM `links` WHERE category='.$category_id.' ORDER BY coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date';

//echo '<h1>';
//echo $query;
//echo '</h1>';
	$query= mysqli_query($mysqli, $query);
if(mysqli_num_rows($query) > 0){
        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $url[] = trim($row['url']) ;
$name[] = trim($row['name']) ;
$description[] = trim($row['description']) ;
$website_street[] = trim($row['website_street']) ;
        }
$send_array = array($url, $name, $description, $website_street);
	return $send_array;
}
else
{
return "Sorry, No Links Found."; 

}
}

function getLinksInRegionAsJSON($category_id){
//this is one of multiple functions to get all the links within a location tree
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
$query = 'SELECT `name`, `description`, `url`, `location_id` FROM `links` WHERE `category`='.$category_id.' && `location_id`>0 ORDER BY coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date LIMIT 20' ;
//echo $query;
if($result= mysqli_query($mysqli, $query)){
	 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$send_array[] = $row ;
		}
	$json_encode_linksList = json_encode($send_array, true);
	return $json_encode_linksList;
	}
	else
	{
	return json_encode("Sorry, No Links Found."); 
	}
}

function getLinksAsJSON($category_id){
//this func is same as the next. Mark for depr. 2BD
//$category_id = 9;
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
$query = 'SELECT `name`, `description`, `url` FROM `links` WHERE category='.$category_id.' ORDER BY coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date LIMIT 20' ;
//echo $query;
if($result= mysqli_query($mysqli, $query)){
	 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$send_array[] = $row ;
		}
$json_encode_linksList = json_encode($send_array, true);
		return $json_encode_linksList;
	}
	else
	{
	return json_encode("Sorry, No Links Found."); 
	}
}

function getCombLinksAsJSON($category_id){
 if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");

$query = 'SELECT `name`, `description`, `url` FROM `links` WHERE category='.$category_id.' ORDER BY coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date LIMIT 20' ;
	$result= mysqli_query($mysqli, $query);
		if ($result->num_rows > 0) {
			 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			$send_array[] = $row ;
			}
			return json_encode($send_array, true);
	}
	else
	{
	return json_encode("Sorry, No Links Found."); 
	}
}



function getCategoryChildren($id){
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
if($id == ""){
$id = 1;
}

include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
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
//return json_encode("NO MORE SUB CATEGORIES"); 
//removed "true" from encoding trying to fix parse errors in members/addalink
$json_encode_send_array = json_encode("NO MORE SUB CATEGORIES"); 
}
return $json_encode_send_array;
}

function getCategoryChildrenForAJAX($id){
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
	//echo	'<br>'.$query;
	$result = mysqli_query($mysqli, $query);
	$rowcount=mysqli_num_rows($result);
	while($row = mysqli_fetch_array($result)){
		if($rowcount==1){
		$id = $row['id'];
		$lft = $row['lft'];
		$rgt = $row['rgt'];
		}
	}
	
$send_array = json_encode(array($id,$lft,$rgt),true);

return $send_array;
}

function getRegionTree($lft,$rgt){
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");

$regional_number=mysqli_real_escape_string($mysqli, $regional_number);
	//$query = 'SELECT `id` FROM `categories_regional2` WHERE `lft`>'.$lft.' & `rgt`<'.$rgt;
	$query = 'SELECT `id`,`lft`,`rgt` FROM `categories_regional2` WHERE `lft` > '.$lft.' && `rgt` < '.$rgt; 
//echo	'<br>'.$query;
	$result = mysqli_query($mysqli, $query);
	while($row = mysqli_fetch_array($result)){
		$id[] = $row['id'];
	}
	
$send_array = json_encode($id,true);

return $send_array;
}

function getLinksByRegionTree($category, $regionTreeArray){
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
//echo '<br>print_r array in func <br>.....<br>';
//print_r($regionTreeArray);
/*$regionIds[] = implode(",",$regionTreeArray);
echo '<br>count($regionTreeArray) = '.count($regionTreeArray).'<br>';
$in  = str_repeat('?,', count($regionTreeArray) - 1) . '?';

$sql = "SELECT * FROM links WHERE category = ".$category." AND location_id IN ($in)";
echo $sql;
$stm = $mysqli->prepare($sql);
$stm->execute($regionTreeArray);
$data = $stm->fetchAll();
echo '<br>data array print_r = ';
print_r($data); */

$prepare = array_map(function(){ return '?'; }, $regionTreeArray);

$statement = mysqli_prepare($mysqli , "SELECT * FROM links WHERE category = ".$category." AND location_id IN ('".implode(',', $prepare)."')");
//echo '<br>statement = ', $statement;
if($statement) {
//echo '<h1>in if statement</h1>';
   $ints = array_map(function(){ return 'i'; }, $regionTreeArray);
   call_user_func_array("mysqli_stmt_bind_param", array_merge(
      array($statement, implode('', $ints)), $regionTreeArray
   ));
   $results = mysqli_stmt_execute($statement);
}
//echo '<br>printing results<br>';
//print_r($results);
}

?>

