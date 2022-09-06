<?php
$root = dirname(dirname(dirname(dirname( __FILE__, 2 ))));
if (file_exists($root.'/wp-load.php')) {
// WP 2.6
require_once($root.'/wp-load.php');
} else {
// Before 2.6
require_once($root.'/wp-config.php');
}
get_header();
/*echo '<br>in btc/views/cancelSuspend.php POST = ';
print_r($_POST);
echo '<br>in btc/views/cancelSuspend.php GET = ';
print_r($_GET); */
include('styles.css');
include(dirname( __FILE__, 2 ).'/css/members_menu.css');
include('views/_menu.php');
require_once(dirname( __FILE__, 4 )."/manna-configs/db_cfg/agent_config.php");
//include(dirname( __FILE__, 5 )."/".AGENT_FOLDERNAME."/manna-network/members/classes/CancelSuspend.php");
require_once(dirname( __FILE__, 2 )."/classes/CancelSuspend.php");
get_header();
$agent_ID = AGENT_ID; 
$cancel = new cancelalink();
if (array_key_exists ( "remote_lnk_id" , $_POST ) AND isset($_POST["remote_lnk_id"])) {
$link_info = $cancel->getLinkByLinkId($_POST['remote_lnk_id']);
}
elseif(array_key_exists ( "remote_lnk_id" , $_GET ) AND isset($_GET["remote_lnk_id"])) {
$link_info = $cancel->getLinkByLinkId($_GET['remote_lnk_id']);
}
if (array_key_exists ( "bidID" , $_POST ) AND isset($_POST["bidID"])) {
$bidID = $_POST['bidID'];
}
else{
$bidID = 0;
}
if(array_key_exists ( "submit" , $_POST ) AND isset($_POST["submit"])) {
// define variables and set to empty values
$agent_IDErr = $remote_link_idErr = $installer_idErr = $widget_statusErr ="";
$agent_ID = $remote_link_id = $installer_id = $widget_status ="";
//print_r($_POST);
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if (empty($_POST["agent_ID"])) {
    $agent_IDErr = "$agent_ID is required";
  } else {
    $agent_ID = test_input($_POST["agent_ID"]);
    // check if $agent_ID is well-formed
  //  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  if (!filter_var($agent_ID, FILTER_VALIDATE_INT)) {
    echo("Variable is not an integer");

      $agent_IDErr = "Invalid agent_ID format";
    }
  }
  
  if (empty($_POST["remote_link_id"])) {
    $remote_link_idErr = "remote_link_id is required";
  } else {
    $remote_link_id = test_input($_POST["remote_link_id"]);
    if (!filter_var($remote_link_id, FILTER_VALIDATE_INT)) {
    echo("Variable is not an integer");
      $remote_link_idErr = "Invalid remote_link_id format";
    }
  }
  
  if (empty($_POST["url"])) {
    $urlErr = "url is required";
  } else {
    $url = test_input($_POST["url"]);
    if (!filter_var($url, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
    //filter_var('experts-exchange.com', FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)
    echo("URL is not a valid domain");
      $urlErr = "Invalid url format";
    }
  }
    
 if (empty($_POST["installer_id"])) {
    $installerErr = "installer_id is required";
  } else {
    $installer_id = test_input($_POST["installer_id"]);
    if (!filter_var($installer_id, FILTER_VALIDATE_INT)) {
    echo("Variable is not an integer");
      $installer_idErr = "Invalid installer_id format";
    }
  }
 
if (empty($_POST['widget_status'])) {
    $widget_statusErr = "widget_status is required";
     $widget_status = test_input($_POST["widget_status"]);
 //    echo '<br>$widget_status POST value is detected as being empty (line 91). $widget_status will not be assigned from POST (maybe because it is zero?) = ', $widget_status;
  //   echo '<br>$widget_status POST value = ', $_POST['widget_status']; 
  } else {
    $widget_status = test_input($_POST["widget_status"]);
   
   if (!filter_var($widget_status, FILTER_VALIDATE_INT)) {
    echo("Variable is not a valid string");
      $widget_statusErr = "Invalid widget_status format";
    } 
  }
   if (empty($_POST["is_link_paid"])) {
    $is_link_paidErr = "is_link_paid is required";
  } else {
    $is_link_paid = test_input($_POST["is_link_paid"]);
    if (!filter_var($is_link_paid, FILTER_VALIDATE_INT)) {
    echo("Variable is not an integer");
      $is_link_paidErr = "Invalid is_link_paid format";
    }
  }
  

$report_display = array();
foreach($link_info as $key=>$value){
if($key==5){
$report_display[0] = '<h3>URL: '.$link_info[5].'</h3>';
}
if($key==3){
$report_display[1] =  '<h3>Title: '.$link_info[3].'</h3>';
}
if($key==4){
$report_display[2] = '<h3>Description: '.$link_info[4].'</h3>';
}
}
/*echo $report_display[0];
echo $report_display[1];
echo $report_display[2];

echo '<br>Now we need to process this cancellation. We need to delete from Manna Network at all tables 1) mn_bridge 2) links 3) price_slots subscripts. What is the delete from node links process? Is there a temp table storing the links pegged for deletion? If so, we need to insert this link into it.
<br>We need to remove from the agent site 1) customer_links 
<br> We need to check agent site to see if this user has any other ads. If not, delete the user too. ? (not functional)';
echo '<h1>The CURL $file handles either cancel or suspened depending on whether it was found in widgets or not. ';
*/
if (array_key_exists ( "widget_status" , $_POST ) AND isset($_POST["widget_status"])) {
	if($_POST["widget_status"] == 0){
	$cancel_type = "cancel";
	$widget_status = 0;
	}
	elseif($_POST["widget_status"] == 1)
	{
	$cancel_type = "suspend";
	$widget_status = 1;
	}
}
//echo '<br>$widget_status before curl call = ', $widget_status;
		$file="https://exchange.manna-network.com/incoming/adCancel.php";
		$args = array(
		'agent_id' => $_POST['agent_ID'],
		'remote_lnk_id' => $_POST['remote_lnk_id'],
		'installer_id' => $_POST['installer_id'],
		'isTemp' => $_POST['isTemp'],
		'is_link_paid' => $_POST['is_link_paid'],
		'url' => $_POST['url'],
		'cancel_type' => $cancel_type,
		'widget_status' => $widget_status,
		);
	
		//if (array_key_exists ( "isTemp" , $_POST ) AND isset($_POST["isTemp"])) {$args['isTemp']=1;}
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
		
	/*	if(empty($data) || json_decode($data)=="no_bids"){
		echo '<br>data is empty or =="no_bids"';
		}
		elseif(!empty($data) || json_decode($data)!="no_bids"){
		echo '<br>data was detected as not empty and not =="no_bids"';
		}
		else
		{
		echo '<br>neither empty nor !empty affected data';
		}  */
		//echo '<br>$widget_status after curl call = ', $widget_status;
		//echo '<br>strpos($data, "The advertisement was successfully removed from the Manna Network")', strpos($data, "The advertisement was successfully removed from the Manna Network");
		if(!empty($data) || json_decode($data)!="no_bids"){
		//echo '<br> JSON_data (before decoding) = ',$data;
		$decoded_data = json_decode($data,true);
		//after the new changes at MN, $decoded_data will ALWAYS be an array. It will either have a single array with the widget status or the price_slot info with widget status at end
		
		/*echo '<br>JSON data After decoding:<br>';
		print_r($decoded_data); */
		if($_POST['is_link_paid']==1){
		//first record, then delete
		//The previous_id is the price_slot_id number at the agent site. There is also the Manna Network price_slot_id and we need both recorded)
		
		//Need to figure out the local price slot id? forentry into func call
		$record_mod_info = $cancel->recordModifyPriceslotsSubscripts($bidID,$decoded_data['id'], $decoded_data['remote_user_id'] , $decoded_data['remote_link_id'],$decoded_data['agent_ID'],$decoded_data['start_date'],$decoded_data['price_slot_amnt'] ,'000.000000',$decoded_data['coin_type'],'cancel',$installer_id,$decoded_data);
		//echo '<br>$record_mod_info = $cancel-> ', $record_mod_info;
		if($record_mod_info == "success"){
		$delete_local_price_slot = $cancel->delete_local_bid($decoded_data['remote_user_id'],$decoded_data['remote_link_id'], $decoded_data['agent_ID'],  "cancel");
		}
		
		}
		/*echo '<br>about to insert link into archive - $link_info array = ';
		print_r($link_info);
		echo '<br>IF the link is not a widget THEN delete BUT if a widget then we need to copy the link to archive';
		//before we delete, INSERT INTO `customer_links_archive`(`id`, `user_id`, `recruiter_lnk_num`, `website_title`, `website_description`, `protocol`, `website_url`, `page_name`, `category_id`, `location_id`, `website_street`, `map_link`, `bridge_id`, `user_registration_datetime`, `installer_id`, `catkeys`, `lockeys`, `reason`) VALUES 
		//we need an "if widget here to prevent it from inserting at every cancel */
		if($widget_status == 1){
		$archive_record_info = $cancel->copyCustLinkToArchive($link_info);
		}
		$cancel_record_info = $cancel->deleteByLinkId($_POST['remote_lnk_id']);
		}
		else
		{
		$cancel_record_info = $cancel->deleteByLinkId($_POST['remote_lnk_id']);
		}
		if($_POST['pay_status'] !== "no_bids"){
		echo '<h2 style="color:#013220;">Your current "Bid For Better Placement" will also be canceled at the next network update and your account will no longer be charged for it.</h2>';
		}
		echo '<a href="/manna_network/manna-network/members/index.php"><h2 style="color:blue;  text-decoration: underline;">Return To Dashboard</h2></a>';
	}
	get_footer();
	exit();
}
else //check if widget/check pay status/ present form
{
require_once(dirname( __FILE__, 2 )."/translations/en.js");
require_once(dirname( __FILE__, 2 )."/js/edit_a_link.js");
require_once(dirname( __FILE__, 2 )."/css/styles.css");
require_once(dirname( __FILE__, 2 )."/classes/CancelSuspend.php");
$cancel = new cancelalink();
$link_info = $cancel->getLinkByLinkId($_GET['link_id']);
//print_r($link_info);
//echo '<div style=\'color:red;\'>'.CANCEL_FORM_WELCOME_TITLE.'</div>';
//echo '<div style=\'color:red;\'>'.CANCEL_FORM_WELCOME_BODY.'</div>';
echo "<div><h2>".TABLE_HEADER."</h2></div>";
foreach ($link_info as $key=> $value){
	if($key==3){
	echo '<div>' .TITLE . ': '. $value;
	}
	elseif($key==4){
	echo '<br>' .DESCRIPTION . ': '. $value;
	}
	elseif($key==5){
	echo '<br>' .URL . ': '. $value.'</div>';
	}
}
$widget_status = $cancel->check_if_a_widget($agent_ID, $link_info[0]);
//echo '<h1>line 205 $widget_status before json decode = ', $widget_status ;
if(json_decode($widget_status) === "not_found"){
echo '<h2 style="color:red;">Since you don\'t have a Manna Network web directory script/plugin associated with this ad it will be completely removed from our advertiser list. If you wish, in the future you can submit the ad again just as you would any other new advertisement (i.e. use the "Ad New Sites" button in the upper nav bar)</h2>';
$widget_status = 0;
}
else
{
//means the function returned an array and needs different decoding
//this code doesn't make sense! Why bother decoding an array and then make the same var = 1?
$widget_info_array = json_decode($widget_status, true);
//echo '<h1>line 186 $widget_status[0] ($widget_id)= ', $widget_status[0] ;
//echo '<h1>Your link was found in widgets</h1>';
//Now check if any links registered at that widget 

$widget_status = 1;
echo '<br>line 265 the getSubLinkCount function shouldn\'t even work because num of args don\'t match the function. The function only looks for the installer id (which is NOT $link_info[0]).';
echo '<br>We need to use this link\'s widget id here. This link\'s widget id becomes the installer id of every link that registers at it. We don\'t have anything returning the widget id if/when it finds that the link is a widget. NO, that\'s not true! The $widget_info_array will return an array if found. <br>print_r $widget_info_array = ';
print_r($widget_info_array);

echo '<br>We can get the $countSubLinks from count($widget_info_array IF the not_found in bridge or not_found in temp messages can be parsed correctly. We might have to make them into arrays, too (they may not be arrays)';
 
if($countSubLinks >0){ 
	echo '<h2 style="color:red;">Your installed directory has advertisers registered from it. That means there is still the potential for them to earn you income in the future (even if your own web directory and advertising has been stopped). For that reason, we will only suspend this advertising listing. You can monitor it\'s earnings by logging in regularly to check it.';
	}
	else
	{
	//they have an installation but no registered links
	echo '<h2 style="color:red;">We have not detected that any advertisers have registered at your web directory. We will cancel the ad and completely remove it. But the configurations of the web directory you have assigned to it will be defective. Be sure to remove any links on your website to the web directory page (or remove it) because it will not function properly and you may not receive proper credit for any advertisers that register from it. You can transfer the web directory to another ad or you can reinstall your ad again in the future (but your ad will have lost any/all seniority it had for placement).</h2>';
	}
}

$pay_status = $cancel->getLinkPayStatus($link_info[0], $agent_ID);
//echo '<br>getLinkPayStatus returns = ', $pay_status;
if($pay_status !== "no_bids")
{
//it also returns "temp_bid" or "approved_bid" but we don't need those here
echo '<h2 style="color:#013220;">Your current "Bid For Better Placement" will also be canceled at the next network update and your account will no longer be charged for it.</h2>';
}
//echo '<h1>line 205 $widget_status before trim = ', $widget_status ;
$widget_status = trim($widget_status,'"'); 
//echo '<h1>line 205 $widget_status before form hidden = ', $widget_status ;
//echo '</h1>';
echo '<form method="post" action="'. htmlspecialchars($_SERVER["PHP_SELF"]).'">  
  <input type="hidden" name="agent_ID" value="'.$agent_ID.'">
  <input type="hidden" name="remote_lnk_id" value="'.$link_info[0].'">
  <input type="hidden" name="installer_id" value="'.$link_info[10].'">
  <input type="hidden" name="widget_status" value='.htmlspecialchars($widget_status).'>
  <input type="hidden" name="url" value='.$link_info[5].'>
  <input type="hidden" name="is_link_paid" value='.$_GET['is_link_paid'].'>
  <input type="hidden" name="bidID" value='.$_GET['bidID'].'>
   <input type="hidden" name="pay_status" value='.$pay_status.'>
  ';
//https://1stbitcoinbank.com/manna_network/manna-network/members/cancelSuspend.php?url=testcancel1.com&link_id=357&category_id=10051&installer_id=3&is_link_paid=1&isTemp=1
  if (array_key_exists ( "isTemp" , $_GET ) AND isset($_GET["isTemp"])) {
echo '<input type="hidden" name="isTemp" value=1> ';
}
else
{
echo '<input type="hidden" name="isTemp" value=0> ';
}
echo '
  <br><br>
  <input type="submit" name="submit" value="Confirm Cancellation">  
</form>

</body>
</html>';
}
get_footer();
?>
