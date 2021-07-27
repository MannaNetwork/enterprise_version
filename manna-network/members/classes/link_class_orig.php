<?php 
 //searched for old user db use - none found
   // / First we define the class

class link_info 
{

var $link_id;
var $BB_user_IDe;
var $cat_id;
var $displayBlockPaid;
var $displayBlockFree;
var $send_array;
var $db_idf;
var $db_categoryf;
var $db_freebief;
var $db_urlf;
var $db_descriptionf;
var $db_start_clone_datef;
var $db_approvedf;
var $db_namef;
var $new_cat_id;
var $orig_cat_id;

function changeCat($new_cat_id,  $link_id){
//this is the new way for users to change their category
// need to reset their seniority when they change however
date_default_timezone_set("America/New_York");
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".WRITER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
$query = "UPDATE links SET `category` = $new_cat_id, `start_date` = ".time().", `is_a_modified`=1  WHERE `id` ='$link_id'";
$result = @mysqli_query($connect, $query) or die("Couldn't execute 'Edit 3 Account' query");

}

function getLinkInfoFromWPUsersTable($BB_user_ID){
//this function used in members index IF no links for this user were detected
// it enables the script to differentiate wp users registrants from regular registrants
$sql = "SELECT * from `wp_user_data` WHERE `BB_user_ID` = $BB_user_ID";
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Get temp Account' query");
$num_rows = mysqli_num_rows(mysqli_query($connect, $sql)); //add this to array if count needed $num_rows_free,
return $num_rows;
}

function getLinkInfoFromTemp($http_host){
$sql = "SELECT * from `temp_download_b4_wdgt_insert` WHERE `url` like '%$http_host%'";
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Get temp Account' query");
$num_rows = mysqli_num_rows(mysqli_query($connect, $sql)); //add this to array if count needed $num_rows_free,
if($num_rows > 0){
while ($row = mysqli_fetch_array($result)){
$id = $row['id'];
$download_type = $row['download_type'];
$progress = $row['progress'];
$referer_id = $row['referer_id'];
$referer_lnk_num = $row['referer_lnk_num'];
$referer_wdgt_id = $row['referer_wdgt_id'];
$referer_affiliate_num = $row['referer_affiliate_num'];
$wp_user_login_registrant = $row['wp_user_login_registrant'];
$wp_user_email_registrant = $row['wp_user_email_registrant'];
$BB_user_ID = $row['BB_user_ID'];
$url = $row['url'];
$title = $row['title'];
$description = $row['description'];
}
$send_array = array($id, $download_type, $progress, $referer_id, $referer_lnk_num, $referer_wdgt_id, $referer_affiliate_num, $wp_user_login_registrant, $wp_user_email_registrant, $BB_user_ID, $url, $title, $description);
}
else
{
	$send_array="false";
}
return $send_array;
}



function getLinkURLbyId($link_id){

// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
$query = "SELECT * FROM links WHERE ID='$link_id'";

$result = @mysqli_query($connect, $query) or die("Couldn't execute 'Edit 3 Account' query");
$row=""; 
do{
$db_url = $row['url'];
}while ($row = mysqli_fetch_array($result));
return $db_url;
}

function getByLikeURL($link_url){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
//this is used by voucher giver - 

$clean_link_url = str_replace("www.", "", $link_url);
$query = "SELECT * FROM links WHERE url like '%$clean_link_url%'";
$result = @mysqli_query($connect, $query) or die("Couldn't get 'links Account' query");
$row=""; 
do{
$user_id = $row['BB_user_ID'];
$link_id= $row['id'];
$approved= $row['approved'];
}while ($row = mysqli_fetch_array($result));
$num_rows = mysqli_num_rows(mysqli_query($connect, $query)); //add this to array if count needed $num_rows_free,
if($num_rows > 0){
$send_array = array($link_id,  $user_id, $approved);
}
else
{
	$send_array="false";
}
return $send_array;
}

//adjust the position of the decimal for deci, centi,Bitcoin deci-Bitcoin centi-Bitcoin milli-Bitcoin 	micro-Bitcoin satoshi-Bitcoin etc
function isAWidget($link_id){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

	$query = 'SELECT * FROM `widgets` WHERE `link_id` = \''. $link_id . "'" ;
//echo 'in is a widget func ', $query;
$result = mysqli_query($connect, $query);
$num_rows=mysqli_num_rows($result);
//echo 'num rows = ', $num_rows;
if($num_rows>0){
//echo '    in isawidgetfunc and numrows greater than 0';
return true;
}
else{
//echo '    in isawidgetfunc and numrows less than 0';
return false;
}
}


function getAffiliateLinks($user_id){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
$query = "SELECT links.id, links.url, links.category, links.description, links.name, links.start_date, links.approved
FROM links
LEFT JOIN widgets ON links.id = widgets.link_id
WHERE widgets.plugin = 'WPMS' AND links.BB_user_ID = $user_id ";

$result = @mysqli_query($connect, $query) or die ("Error in query: $query " . mysql_error());
$row="";
$num_rows = "";
$id = "";
$category = "";
$url = "";
$description = "";
$name =  "";
$start_datef =  "";
$approved =  "";
while ($row = mysqli_fetch_array($result)){
$id[] = $row['id'];
$url[] = $row['url'];
$category[] = $row['category'];
$description[] = $row['description'];
$name[] = $row['name'];
$start_datef[] = $row['start_date'];
$approved[] = $row['approved']; 
}
$num_rows = mysqli_num_rows(mysqli_query($connect, $query));
$send_array = array($num_rows, $id, $url,$category, $description, $name, $start_datef, $approved);
//print_r($send_array);
return $send_array;
}


function getDisplayConfigPrice($user_id, $link_id, $coin_type){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
$query = "SELECT *
FROM `user_control_panel_config`
WHERE `user_ID` = '".$user_id."'";
//echo 'line 58 link class ', $query;
$result = @mysqli_query($connect, $query) or die ("Error in query: $query " . mysql_error());
$row = mysqli_fetch_array($result);
$num_results = mysqli_num_rows($result);
if ($num_results > 0){
$price_slot_range =  $row['price_slot_range'];

return $price_slot_range;
}else{
return $num_results;
}
}

function getDisplayConfigPrefix($user_id, $link_id, $coin_type){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
$query = "SELECT *
FROM `user_control_panel_config`
WHERE `user_ID` = '".$user_id."'";
//echo 'line 78 link class ', $query;
$result = @mysqli_query($connect, $query) or die ("Error in query: $query " . mysql_error());
$row = mysqli_fetch_array($result);
$num_results = mysqli_num_rows($result);
if ($num_results > 0){
$prefix =  $row['prefix'];
return $prefix;
}else{
return $num_results;
}
}


function getUserParentForWPByUserId($user_id){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
//to limit widget installs to activated users use this one but what if parent has cancelled out? 
//$query = "SELECT * FROM `users` WHERE wdgts_lnk_num='$parents_link_id' AND `user_active` = '1'";
$query = "SELECT * FROM `users` WHERE user_id='$user_id'";

$result = @mysqli_query($connect, $query ) or die("Couldn't execute 'Edit 3 Account' query");
while ($row = mysqli_fetch_array($result)){
$wdgts_lnk_num = $row['wdgts_lnk_num']; 
$wdgts_ID  = $row['wdgts_ID']; 
$wp_ID  = $row['wp_ID'];
}
$return_array=array($wdgts_lnk_num, $wdgts_ID, $wp_ID); 
return $return_array;
}

function getUserIDByLinkId($link_id){
//this is used by voucher giver - Even though the admin has entered the user id and that is all that is needed to
//issue a voucher, we want the script to display the user and link info to confirm the issuance is going to the right place
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
$query = "SELECT * FROM `users` WHERE wdgts_lnk_num='$link_id' AND `user_active` = '1'";
$result = @mysqli_query($connect, $query ) or die("Couldn't execute 'Edit 3 Account' query");
while ($row = mysqli_fetch_array($result)){
$user_id[] = $row['user_id'];

}

return $user_id;
}



function get_user_info($email){
//this is used by voucher giver -
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

		$query = "SELECT user_name, user_email, user_id FROM users WHERE user_email = '".$email."'";
		$result = @mysqli_query($connect, $query ) or die("Couldn't execute 'get email Account' query");
$row=""; 
do{
		$links_user_id = $row['user_id'];
		$user_full_name  = $row['user_name'];
		
			$block .= "<tr><td width = '100%'><table width='100%' border = '1'><TR><TD width='30'>$db_idf[$key2]</td><TD width='30'>$newstart</td><td width='50'>$db_namef[$key2]</td></tr>
	<tr><td>$counter</td><td colspan = '2'><a target=";

$block .= '"_blank" href="';
$block .= $db_urlf[$key2];
$block .= '">';
$block .= $db_namef[$key2];
$block .= "</a></td></tr>	<tr><td colspan = '3' >$db_descriptionf[$key2]</td></tr></table></td></tr>";

	}while ($row = mysqli_fetch_array($result));
$send_array = array($links_user_id,  $user_full_name, $user_info);

return $send_array;
}


function getUserByLinkURL($link_url){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
//this is used by voucher giver - 

$query = "SELECT * FROM links WHERE url='$link_url'";
$result = @mysqli_query($connect, $query) or die("Couldn't get 'links Account' query");
$row=""; 
do{
$links_user_id = $row['BB_user_ID'];
$db_idf = $row['id'];
$db_categoryf = $row['category'];
$db_urlf = $row['url'];
$db_descriptionf = $row['description'];
$db_namef = $row['name'];
$db_start_datef = $row['start_date'];
$db_approvedf = $row['approved']; 
}while ($row = mysqli_fetch_array($result));
//$num_rows_free = mysqli_num_rows(mysqli_query($connect, $query)); add this to array if count needed $num_rows_free,
$send_array = array($links_user_id,  $db_idf, $db_categoryf, $db_urlf, $db_descriptionf, $db_namef, $db_start_datef, $db_approvedf);

return $send_array;
}



function getUserByLinkId($link_id){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
//this is used by voucher giver - 
//echo '<br> link class line 160 ', $link_id;
if($link_id >0){
$query = "SELECT * FROM links WHERE ID='$link_id'";
$result = @mysqli_query($connect, $query) or die("Couldn't execute 'Edit 3 Account' query");
$row=""; 
$links_user_id="";
$db_id="";
$db_category="";
$db_url="";
$db_description="";
$db_name="";
$db_start_date="";
$db_approved="";
while ($row = mysqli_fetch_array($result)){
$links_user_id = $row['BB_user_ID'];
$db_id = $row['id'];
$db_category = $row['category'];
$db_url = $row['url'];
$db_description = $row['description'];
$db_name = $row['name'];
$db_start_date = $row['start_date'];
$db_approved = $row['approved']; 
}
//$num_rows_free = mysqli_num_rows(mysqli_query($connect, $query)); add this to array if count needed $num_rows_free,
$send_array = array($links_user_id,  $db_id, $db_category, $db_url, $db_description, $db_name, $db_start_date, $db_approved);
}
return $send_array;
}

function getLinkByUserIdFree($user_id){
//this is used by voucher giver - Even though the admin has entered the user id and that is all that is needed to
//issue a voucher, we want the script to display the user and link info to confirm the issuance is going to the right place
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

if($user_id >0){
$query = "SELECT * FROM links WHERE BB_user_ID='$user_id' AND `freebie` = 0 && `is_affiliate`='0' ORDER BY `start_date` ASC";
$result = @mysqli_query($connect, $query) or die("Couldn't execute 'Edit 3 Account' query");
$num_rows = mysqli_num_rows($result);
if($num_rows > 0){

while ($row = mysqli_fetch_array($result)){
$db_idf[] = $row['id'];
$db_categoryf[] = $row['category'];
$db_urlf[] = $row['url'];
$db_descriptionf[] = $row['description'];
$db_namef[] = $row['name'];
$db_start_datef[] = $row['start_date'];
$db_approvedf[] = $row['approved']; 
}

$num_links_this_user = count($db_idf);
}
$send_array = array($num_links_this_user, $db_idf, $db_categoryf, $db_urlf, $db_descriptionf, $db_namef, $db_start_datef, $db_approvedf);
}
return $send_array;
}

function getLinkByUserIdPaid($user_id){
//this is used by voucher giver - Even though the admin has entered the user id and that is all that is needed to
//issue a voucher, we want the script to display the user and link info to confirm the issuance is going to the right place
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
if($user_id >0){
$query = "SELECT * FROM links WHERE BB_user_ID='$user_id'  AND `freebie` = 1 && `is_affiliate`='0' ORDER BY `start_date` ASC";

$result = @mysqli_query($connect, $query) or die("Couldn't execute 'Edit 3 Account' query");
$num_rows = mysqli_num_rows($result);
if($num_rows > 0){
while ($row = mysqli_fetch_array($result)){
$db_idp[] = $row['id'];
$db_categoryp[] = $row['category'];
$db_urlp[] = $row['url'];
$db_descriptionp[] = $row['description'];
$db_namep[] = $row['name'];
$db_start_datep[] = $row['start_date'];
$db_approvedp[] = $row['approved']; 
}
$num_links_this_user = count($db_idp);
}
$send_array = array($num_links_this_user, $db_idp, $db_categoryp, $db_urlp, $db_descriptionp, $db_namep, $db_start_datep, $db_approvedp);
}
return $send_array;
}





function getLinkByUserId($user_id){
//this is used by voucher giver- Even though the admin has entered the user id and that is all that is needed to
//issue a voucher, we want the script to display the user and link info to confirm the issuance is going to the right place
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
$query = "SELECT * FROM links WHERE BB_user_ID='$user_id' ORDER BY `start_date` ASC";
echo '<br>in func, line 350', $query;
$result = @mysqli_query($connect, $query) or die("Couldn't execute 'Edit 3 Account' query");
if($result){
$row=""; 
do{
$db_idf[] = $row['id'];
$db_categoryf[] = $row['category'];
$db_urlf[] = $row['url'];
$db_descriptionf[] = $row['description'];
$db_namef[] = $row['name'];
$db_start_datef[] = $row['start_date'];
$db_approvedf[] = $row['approved']; 
}while ($row = mysqli_fetch_array($result));

$num_links_this_user = mysqli_num_rows(mysqli_query($connect, $query));
$send_array = array($num_links_this_user, $db_idf, $db_categoryf, $db_urlf, $db_descriptionf, $db_namef, $db_start_datef, $db_approvedf);

return $send_array;
}
else
{
return false;
}
}


function getFolderName($link_id){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
	$query = 'SELECT * FROM `widgets` WHERE `link_id` = \''. $link_id . "'" ;
$result = mysqli_query($connect, $query);
$num_rows=mysqli_num_rows($result);
if($num_rows>0){
while($row = @mysqli_fetch_array($result)){

$folder_name = $row['folder_name'];
$file_name = $row['file_name'];
$start_clone_date = $row['start_clone_date'];
$end_clone_date = $row['end_clone_date'];
}
$folder_pair = array($folder_name, $file_name, $start_clone_date, $end_clone_date);
return $folder_pair;
}
else{
return false;
}
}

function getAffiliateLinksFree_2BD($user_id){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

$query = "SELECT * FROM links WHERE BB_user_ID='$user_id'&& freebie>'0' && `is_affiliate`='1' ORDER BY `start_date` ASC";
$result = @mysqli_query($connect, $query) or die("Couldn't execute 'Edit 3 Account' query");
$row=""; 
do{
$db_idf[] = $row['id'];
$db_categoryf[] = $row['category'];
$db_urlf[] = $row['url'];
$db_descriptionf[] = $row['description'];
$db_namef[] = $row['name'];
$db_start_datef[] = $row['start_date'];
$db_approvedf[] = $row['approved']; 
}while ($row = mysqli_fetch_array($result));
$num_rows_free = mysqli_num_rows(mysqli_query($connect, $query));
$send_array = array($num_rows_free, $db_idf, $db_categoryf, $db_urlf, $db_descriptionf, $db_namef, $db_start_datef, $db_approvedf);
return $send_array;
}


function getAffiliateLinksPaid_2bd($user_id){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
$query = "SELECT * FROM links WHERE BB_user_ID='$user_id'&& freebie='1' && `is_affiliate`='1' ORDER BY `start_date` ASC";
$result = @mysqli_query($connect, $query) or die("Couldn't execute 'Edit 3 Account' query");
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
$db_namef[] = $row['name'];
$db_start_datef[] = $row['start_date'];
$db_approvedf[] = $row['approved']; 
}
$num_rows_free = mysqli_num_rows(mysqli_query($connect, $query));
$send_array = array($num_rows_free, $db_idf, $db_categoryf, $db_urlf, $db_descriptionf, $db_namef, $db_start_datef, $db_approvedf);
return $send_array;
}

function getFreeLinks($user_id){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");

$query = "SELECT * FROM links WHERE BB_user_ID='$user_id'&& freebie='0' ORDER BY `start_date` ASC";
echo 'in link class line 351', $query;
$result = @mysqli_query($connect, $query) or die("Couldn't execute 'Edit 3 Account' query");
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
$db_namef[] = $row['name'];
$db_start_datef[] = $row['start_date'];
$db_approvedf[] = $row['approved']; 
}
$num_rows_free = mysqli_num_rows(mysqli_query($connect, $query));
$send_array = array($num_rows_free, $db_idf, $db_categoryf, $db_urlf, $db_descriptionf, $db_namef, $db_start_datef, $db_approvedf);
return $send_array;
}
function displayBlockPaid($user_id){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
$sql = "SELECT * FROM links WHERE BB_user_ID='$user_id'&& freebie = '2' ORDER BY `start_date` ASC";
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


function displayBlockFree($user_id){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
$sql = "SELECT * FROM links WHERE BB_user_ID='$user_id'&& freebie='0'  ORDER BY `start_date` ASC";
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

function displayBlockTestNet($user_id){
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_DOWNLINES, WRITER_DOWNLINES (for the public=facing downlines db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
require_once($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/mysqli_connect.php");
$sql = "SELECT * FROM links WHERE BB_user_ID='$user_id'&& freebie = '1'  ORDER BY `start_date` ASC";

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
}
