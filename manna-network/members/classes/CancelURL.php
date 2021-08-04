<?php


class cancelalink{

function getSubLinkCount($widgetid){
if (!defined('READER_AGENTS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_AGENTS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
$query = "SELECT * FROM SELECT * FROM `remote_mn_id_bridge` WHERE installer_id='".$widgetid."'"  ;
$result = @mysqli_query($mysqli, $query) or die("Couldn't execute 'Edit 3 Account' query");
$num_rows = mysqli_num_rows($result);
return $num_rows;
}

function getCategoryName($catid){
if (!defined('READER_AGENTS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_AGENTS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
$query = "SELECT * FROM categories WHERE id='".$catid."'"  ;
echo $query;
$result = @mysqli_query($mysqli, $query) or die("Couldn't execute 'Edit 3 Account' query");
$num_rows = mysqli_num_rows($result);
if($num_rows > 0){
while ($row = mysqli_fetch_array($result)){
$catname = $row['name'];


}
return $catname;
}
}
 function getLinkByLinkId($link_id){

if (!defined('READER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");

if($link_id >0){

$query = "SELECT * FROM customer_links WHERE id='$link_id'  ORDER BY `user_registration_datetime` ASC";
$result = @mysqli_query($mysqli, $query) or die("Couldn't execute 'Edit 3 Account' query");
$num_rows = mysqli_num_rows($result);
if($num_rows > 1){
while ($row = mysqli_fetch_array($result)){
$id[] = $row['id'];
$user_id2[] = $row['user_id'];
$recruiter_lnk_num[] = $row['recruiter_lnk_num'];
$website_title[] = $row['website_title'];
$website_description[] = $row['website_description'];
$website_url[] = $row['website_url'];
$category_id[] = $row['category_id'];
$newcatsuggestion[] = $row['newcatsuggestion'];
$location_id[] = $row['location_id'];
$website_street[] = $row['website_street'];
$website_district[] = $row['website_district'];
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
$website_url = $row['website_url'];
$category_id = $row['category_id'];
$newcatsuggestion = $row['newcatsuggestion'];
$location_id = $row['location_id'];
$website_street = $row['website_street'];
$website_district = $row['website_district'];
$user_registration_datetime = $row['user_registration_datetime'];
$installer_id = $row['installer_id'];

}
$num_links_this_user = 1;
}


$send_array = array($num_links_this_user, $id, $user_id2, $recruiter_lnk_num, $website_title, $website_description, $website_url, $category_id, $newcatsuggestion, $location_id, $website_street, $website_district, $user_registration_datetime, $installer_id);

return $send_array;
}

}

function getLinkPayStatus     ($link_id, $agent_ID){
if (!defined('READER_AGENTS')) {
include(dirname( __DIR__, 3 ). "/manna-configs/db_cfg/agent_config.php");
}
 
$args3 = array(
'link_id' => $link_id, 
'agent_ID' => $agent_ID
);

$url3 = "https://exchange.manna-network.com/incoming/check_for_bids_for_cancel_link.php";

     $ch = curl_init();    // initialize curl handle
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_URL, $url3); 
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);          
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 50); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $args3); 

    $status = curl_exec($ch);
    $curl_errno = curl_errno($ch);
    $curl_error = curl_error($ch);
    if ($curl_errno > 0) {
            echo "cURL Error ($curl_errno): $curl_error\n";
    } else {

return $status;
}


}

function getWidgetStatus($agent_ID, $remote_lnk_id, $installer_id, $url){

$file="http://exchange.manna-network.com/incoming/install_check_widgets.php";
		$args = array(
		'agent_ID' => $agent_ID,
		'remote_lnk_id' => $remote_lnk_id,
		'installer_id' => $installer_id,
'url' => $url		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $file);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$args);

		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
    		    $curl_errno = curl_errno($ch);
		    $curl_error = curl_error($ch);
		    if ($curl_errno > 0) {
			    echo "cURL Error line 575 ($curl_errno): $curl_error\n";
		    } else {    
//echo '<h1> the info shou;ld be from tempuser</h1>';
		curl_close($ch);
		
}
		return $data;

}
}
