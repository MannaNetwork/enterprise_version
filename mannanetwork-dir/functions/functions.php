 <?php
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
$query = 'SELECT id, name as cname,parent,lft,rgt,link_count FROM `categories` WHERE parent='.$dbID.' ORDER BY name';
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
$empty = json_encode("Sorry, No More Selections.");
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
echo '<b>in func uey = ', $query;
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
//$page_num = 2; 
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");

if($tregional_num > 0){
$query = "SELECT links.id, name, description, url, regional_sign_ups.link_id, continent, country, state, city FROM links JOIN regional_sign_ups ON regional_sign_ups.link_id = links.id where (links.category='".$category_id."') AND (regional_sign_ups.continent = '".$tregional_num."' OR regional_sign_ups.country = '".$tregional_num."' OR regional_sign_ups.state = '".$tregional_num."' OR regional_sign_ups.city = '".$tregional_num."')";
}
else
{
$query = "SELECT `name`, `description`, `url` FROM `links` WHERE category='".$category_id."'";
$result= mysqli_query($mysqli, $query);
 $mysqli_num_rows = mysqli_num_rows($result);
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
				$query = "SELECT links.id, name, description, url, coin_type, price_slot, price_slot_prchs_date, start_date, regional_sign_ups.link_id, continent, country, state, city FROM links JOIN regional_sign_ups ON regional_sign_ups.link_id = links.id where (links.category='".$category_id."') AND (regional_sign_ups.continent = '".$tregional_num."' OR regional_sign_ups.country = '".$tregional_num."' OR regional_sign_ups.state = '".$tregional_num."' OR regional_sign_ups.city = '".$tregional_num."') ORDER BY links.coin_type DESC, links.price_slot DESC, links.price_slot_prchs_date, links.start_date LIMIT ". $lower_limit.','. $upper_limit ;
}
else
{
$query = 'SELECT `name`, `description`, `url` FROM `links` WHERE category='.$category_id.' ORDER BY coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date LIMIT 20';
}		
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
if($tregional_num > 0){
				$query = "SELECT links.id, name, description, url, coin_type, price_slot, price_slot_prchs_date, start_date, regional_sign_ups.link_id, continent, country, state, city FROM links JOIN regional_sign_ups ON regional_sign_ups.link_id = links.id where (links.category='".$category_id."') AND (regional_sign_ups.continent = '".$tregional_num."' OR regional_sign_ups.country = '".$tregional_num."' OR regional_sign_ups.state = '".$tregional_num."' OR regional_sign_ups.city = '".$tregional_num."') ORDER BY links.coin_type DESC, links.price_slot DESC, links.price_slot_prchs_date, links.start_date LIMIT ".$lower_limit.','. $upper_limit ;
}
else
{
$query = 'SELECT `name`, `description`, `url` FROM `links` WHERE category='.$category_id.' ORDER BY coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date LIMIT '.$lower_limit.','. $upper_limit ;
}

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
if($tregional_num > 0){
				$query = "SELECT links.id, name, description, url, coin_type, price_slot, price_slot_prchs_date, start_date, regional_sign_ups.link_id, continent, country, state, city FROM links LEFT JOIN regional_sign_ups ON regional_sign_ups.link_id = links.id where (links.category='".$category_id."') AND (regional_sign_ups.continent = '".$tregional_num."' OR regional_sign_ups.country = '".$tregional_num."' OR regional_sign_ups.state = '".$tregional_num."' OR regional_sign_ups.city = '".$tregional_num."') ORDER BY links.coin_type DESC, links.price_slot DESC, links.price_slot_prchs_date, links.start_date LIMIT ".$lower_limit.','. $upper_limit ;
}
else
{
$query = 'SELECT `name`, `description`, `url` FROM `links` WHERE category='.$category_id.' ORDER BY coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date LIMIT '.$lower_limit.','. $upper_limit ;
}
				$result= mysqli_query($mysqli, $query);
				 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					$send_array[] = $row ;
					}
				$json_encode_linksList = json_encode($send_array, true);
				 return $json_encode_linksList;
				}
	}
	else
	{
	return "Sorry, No Links Found."; 
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

function combgetNumberOfPages($catid, $tregional_num){
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
	if($tregional_num > 0){
	$query = "SELECT links.id, name, description, url, regional_sign_ups.link_id, continent, country, state, city
	  FROM links
	  JOIN regional_sign_ups ON regional_sign_ups.link_id = links.id where (links.category='".$catid."') AND (regional_sign_ups.continent = '".$tregional_num."' OR regional_sign_ups.country = '".$tregional_num."' OR regional_sign_ups.state = '".$tregional_num."' OR regional_sign_ups.city = '".$tregional_num."')";
	}
	else
	{
	$query = "SELECT * FROM `links` WHERE category='".$catid."'";
	}
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
	$number_of_pages =1;
return $number_of_pages;
}
else
{
$number_of_pages =0;
return $number_of_pages;
}
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
	return $send_array;
}
else
{
$empty = json_encode("Sorry, No Regional Entries Found.");
return $empty;
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
$website_district[] = trim($row['website_district']) ;

        }
$send_array = array($url, $name, $description, $website_street, $website_district);
	return $send_array;
}
else
{
return "Sorry, No Links Found."; 

}
}

function getLinksAsJSON($category_id){

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
	return "Sorry, No Links Found."; 
	}
}

function getCombLinksAsJSON($category_id, $tregional_num){
  echo '<br> in getCombLinksAsJSON func line 509';       
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");

if($tregional_num > 0){
$query = "SELECT links.id, name, description, url, regional_sign_ups.link_id, continent, country, state, city FROM links JOIN regional_sign_ups ON regional_sign_ups.link_id = links.id where (links.category='".$category_id."') AND (regional_sign_ups.continent = '".$tregional_num."' OR regional_sign_ups.country = '".$tregional_num."' OR regional_sign_ups.state = '".$tregional_num."' OR regional_sign_ups.city = '".$tregional_num."')";
	if($result= mysqli_query($mysqli, $query)){
		 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			$send_array[] = $row['id'] ;
			}
	}
	else
	{
	return "Sorry, No Links Found."; 
	}
}
else
{
$query = 'SELECT `name`, `description`, `url` FROM `links` WHERE category='.$category_id.' ORDER BY coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date LIMIT 20' ;
	if($result= mysqli_query($mysqli, $query)){
		 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			$send_array[] = $row;            
			}
	}
	else
	{
	return "Sorry, No Links Found."; 
	}
}
	if($tregional_num > 0){
//use the results from first query (with the join to regional sign ups) to get the linksList
		foreach($send_array as $key => $value){
		 $query = 'SELECT `name`, `description`, `url` FROM `links` WHERE id='.$value.' AND category = '.$category_id.' ORDER BY coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date ' ;
			if($result= mysqli_query($mysqli, $query)){
				 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					$send_array2[] = $row ;
					}
			}
		}
	//return results from join with regional sign ups
	$json_encode_linksList = json_encode($send_array2, true);
	}
	else
	{
	//or just return results from just links (first query)
	$json_encode_linksList = json_encode($send_array, true);
	}
	return $json_encode_linksList;
}


function getRegionalLinksAsJSON($category_id, $tregional_num){
 //can be deleted after combo works        
//$category_id = 9;
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
/*
$query = "SELECT `id`, `continent`, `country`, `state`, `city`, `link_id`, `cat_id` FROM `regional_sign_ups` WHERE
    `continent` = '".$tregional_num."' OR country = '".$tregional_num."' OR state = '".$tregional_num."' OR city = '".$tregional_num."'"; */
$query = "SELECT links.id, name, description, url, regional_sign_ups.link_id, continent, country, state, city FROM links JOIN regional_sign_ups ON regional_sign_ups.link_id = links.id where (links.category='".$category_id."') AND (regional_sign_ups.continent = '".$tregional_num."' OR regional_sign_ups.country = '".$tregional_num."' OR regional_sign_ups.state = '".$tregional_num."' OR regional_sign_ups.city = '".$tregional_num."')";

//echo $query;
if($result= mysqli_query($mysqli, $query)){
	 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
//echo '<br>row = ';
//print_r($row);
		$send_array[] = $row['id'] ;
		}
//print_r($send_array);
foreach($send_array as $key => $value){
//echo '<br>key = '. $key . ' ...... value = '.$value;
 $query = 'SELECT `name`, `description`, `url` FROM `links` WHERE id='.$value.' AND category = '.$category_id.' ORDER BY coin_type DESC, price_slot DESC, price_slot_prchs_date, start_date ' ;
//echo $query;
if($result= mysqli_query($mysqli, $query)){
	 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$send_array2[] = $row ;
		}
}
}
$json_encode_linksList = json_encode($send_array2, true);
		return $json_encode_linksList;
	}
	else
	{
	return "Sorry, No Links Found."; 
	}

}

// Sample use
// Just pass your array or string and the UTF8 encode will be fixed
/*
function getCategoryChildren($id){

if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
if($id == ""){
$id = 1;
}

include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
	$query = 'SELECT * FROM `categories` WHERE parent='.$id.' AND link_count > 0 ORDER BY name;';
echo $query;

	$result= mysqli_query($mysqli, $query);
     if(mysqli_num_rows($result) > 0){  
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

	$send_array[] = $row ;
	}
	return $send_array;
}
else
{
return "<h1>Sorry, No Sub-categories Found. </h1>"; 

}
}
*/

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
	$json_encode_send_array = json_encode($send_array);
		return $send_array;
//return $json_encode_send_array;
}
else
{
//return json_encode("NO MORE SUB CATEGORIES"); 
return "NO MORE SUB CATEGORIES"; 

}
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

?>

