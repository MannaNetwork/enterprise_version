<?php


class cancelalink{

function copyCustLinkToArchive($custLinkArray){
//since the archives are NOT intended to be used to restore an ad AND since the $linkinfo array doesn't have all the columns of the customer_links table, this copy is partial. We need to delete protocol, page_name, `map_link`, `bridge_id`,, `catkeys`, `lockeys`,

if (!defined('WRITER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".WRITER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
//$custLinkArray contains array($id, $user_id2, $recruiter_lnk_num, $website_title, $website_description, $website_url, $category_id, $location_id, $website_street, $user_registration_datetime, $installer_id) as indexed array	
$query = "INSERT INTO `customer_links_archive`(`orig_link_id`, `user_id`, `recruiter_lnk_num`, `website_title`, `website_description`, `website_url`, `category_id`, `location_id`, `website_street`, `user_registration_datetime`, `installer_id`, `reason`) VALUES ($custLinkArray[0],$custLinkArray[1],0, '$custLinkArray[3]','$custLinkArray[4]','$custLinkArray[5]', $custLinkArray[6], $custLinkArray[7], '$custLinkArray[8]', '$custLinkArray[9]', $custLinkArray[10], 'cancel')";
$result = mysqli_query($mysqli, $query);
}

function delete_local_bid($user_id,$link_id, $agent_ID,  $reason){
if (!defined('WRITER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".WRITER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
		//delete from local
		$query = "DELETE FROM `price_slots_subscripts` WHERE `link_id` =  '".$link_id."' && agent_ID='".$agent_ID."' && `link_id` = '".$link_id."'";
		//echo '<br>Deleting bid in local', $query;
		$result = mysqli_query($mysqli, $query);
		}
/*
recordModifyPriceslotsSubscripts($previous_id_local,$decoded_data['id'], $decoded_data[remote_user_id] , $decoded_data['remote_link_id'],$decoded_data['agent_ID'],$decoded_data['start_date'],$decoded_data[price_slot_amnt] ,'000.000000','cancel')
*/		
		
function recordModifyPriceslotsSubscripts($previous_id,$mn_ps_id, $user_id, $prev_link_id,$prev_agent_ID,$prev_start_date,$old_price,$new_price,$coin_type,$reason,$installer_id,$decoded_data){
//echo '<br>in func, decoded data (i.e. comes into function as an array) - print_r = ';
//print_r($decoded_data);
//see DEV_NOTES_README.txt for issues related to modifications
date_default_timezone_set('America/New_York');

if (!defined('WRITER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".WRITER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
	$query2 = "INSERT INTO `price_slots_modifications`(`orig_ps_id_local`, `orig_ps_id_mn`, `user_id`, `link_id`, `orig_price_slot_amnt`, `new_amount`, `subscribe`, `coin_type`, `cat_id`, `rank_by_cat`, `orig_t_timestamp`, `orig_start_date`, `agent_ID`, `installer_id`, `reason`) VALUES ('".$previous_id."','".$mn_ps_id."','".$user_id."','".$prev_link_id."','".$old_price."','000.00000','0','".$coin_type."','".$decoded_data['cat_id']."','0','".$decoded_data['t_timestamp']."','".$decoded_data['start_date']."','".$decoded_data['agent_ID']."','".$installer_id."','".$reason."')";
	//echo $query2;
	if ($result2 = mysqli_query($mysqli, $query2)) {
		return "success";
		}
		else
		{
		return "<br>failed modification insert";
		}
}

function deleteByLinkId($link_id){

if (!defined('READER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".WRITER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");

$query = "DELETE FROM customer_links WHERE id='$link_id'";
$result = @mysqli_query($mysqli, $query) or die("Couldn't execute 'Delete Account' query");

$num_rows = $mysqli -> affected_rows;
if($num_rows >0){
echo '<h1 style="color:red;">The advertisement was successfully removed and has been entered into the queue to be removed from the network at its next update (daily)</h1>';
};
}

function getSubLinkCount($installer_id){
//note - the function is fed the $widget_id of the link being canceled. That id is used as the $installer id of any sites that register at that widget (i.e. the $widget is the installer that gets credit for the sale). The installer/widget_id of seller) is recorded in either the bridge table or tempusers. So at MN, we check if there are ANY links registered to that widget_id and, if so, then we will suspend. Otherwise, we can cancel. We also know if user has other links (when the index page loads). If this link being canceled is the users ONLY ad/link then we can delete the user account IF their balance is zero.
$args3 = array(
'installer_id' => $installer_id
);
$url3 = "https://exchange.manna-network.com/incoming/getSubLinkCount.php";
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

	if(is_numeric($link_id) && $link_id >0){
	$query = "SELECT * FROM customer_links WHERE id='$link_id'  ORDER BY `user_registration_datetime` ASC";
	$result = @mysqli_query($mysqli, $query) or die("Couldn't execute 'Edit 3 Account' query");
	$num_rows = mysqli_num_rows($result);
	if($num_rows > 0){
		while ($row = mysqli_fetch_array($result)){
		$id = $row['id'];
		$user_id2 = $row['user_id'];
		$recruiter_lnk_num = $row['recruiter_lnk_num'];
		$website_title = $row['website_title'];
		$website_description = $row['website_description'];
		$website_url = $row['website_url'];
		$category_id = $row['category_id'];
		$location_id = $row['location_id'];
		$website_street = $row['website_street'];
		$user_registration_datetime = $row['user_registration_datetime'];
		$installer_id = $row['installer_id'];
		}
	}

	$send_array = array($id, $user_id2, $recruiter_lnk_num, $website_title, $website_description, $website_url, $category_id, $location_id, $website_street, $user_registration_datetime, $installer_id);
	return $send_array;
	}
}

function getLinkPayStatus($link_id, $agent_ID){
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
function check_if_a_widget($agent_ID, $remote_lnk_id){
$file="https://exchange.manna-network.com/incoming/checkWidgetCancelSuspend.php";
		$args = array(
		'agent_ID' => $agent_ID,
		'remote_link_id' => $remote_lnk_id);
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

function cancelSuspend($agent_ID, $remote_lnk_id, $installer_id, $url){
//echo '<br>in class - in function line 105';
$file="https://exchange.manna-network.com/incoming/cancelSuspend.php";
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

/*
replaced with function named cancelSuspend which is basically the same, uses renamed copies of same files on manna network
2bd
function getWidgetStatus($agent_ID, $remote_lnk_id, $installer_id, $url){

$file="https://exchange.manna-network.com/incoming/install_check_widgets.php";
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

} */
}
