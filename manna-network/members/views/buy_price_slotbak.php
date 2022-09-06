<?php
##############   CONFIGURATIONS
//Change
$monthly_target_fee_nominal_value = "$5 to $7.50";//change for different target value This is used in explanations only
//for future use - a var to set the language - will need a dropdown form eventually
$lang="en";
include('translations/en/buy_price_slots_common.php');
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
//there is some bug that allows this page to display but lacking the credentials (resulting in a bad bid). This redirects to dashboard to pick up credentials again
require_once(dirname( __FILE__, 4 )."/manna-configs/db_cfg/agent_config.php");
require_once(dirname( __FILE__, 5 )."/".AGENT_FOLDERNAME."/manna-network/members/classes/member_page_class.php");

include('styles.css');
include(dirname(__FILE__).'/css/style.css');
include(dirname( __FILE__, 2 ).'/css/members_menu.css');
get_header();
echo '<H2>Manually turned debug on in buy_price_slot.php</h2>';
$debug=2;
require_once('views/_menu.php');
/*echo '<br>in buy price slot - print_r =DEBUG ON MANUALLY LINE 19 ';
$debug=2; */

if ( isset( $_GET['get_filters_info'] ) ) {
		include('translations/en/get_filters_info.php');
		exit();
	}
	
if(isset($_POST['confirm_downgrade']) AND null !==($_POST['link_id']) ){
$link_id = $_POST['link_id'];
$new_price = $_POST['new_price'];
$old_price = $_POST['old_price'];
$cat_id = $_POST['cat_id'];
$installer_id = $_POST['installer_id'];
$coin_type = $_POST['coin_type'];
$agent_ID = $_POST['agent_ID'];
//generated errors - not used by functions
//$users_balances_string = $_POST['users_balances_string'];
$this_links_bid_status_on_Central = $_POST['this_links_bid_status_on_Central'];
$reason="downgrade";
$this_links_bid_status_on_Central = $_POST['this_links_bid_status_on_Central'];
$linkInfo = new member_page_info();
//Change on local table

$linkInfo->updateLocalPriceslotsSubscripts($user_id, $agent_ID, $link_id, $new_price, $old_price, $cat_id, $installer_id, $coin_type);
$linkInfo->sendModifyToCentral($user_id, $agent_ID, $link_id, $new_price, $old_price, $cat_id, $installer_id, $coin_type, $reason, $this_links_bid_status_on_Central);
//get_footer();
exit();

}
elseif(isset($_POST['modify_type']) AND $_POST['modify_type']== "downgrade" AND null !==($_POST['link_id']) ){
if($debug==2){
print_r($_POST);
}
echo '<div>&nbsp;</div><div id="index_content" class="index_content" name="index_content"><hr>';
//We can't let this hit the missing link_if filters below that redirect because 1) it will always have to have
$steps_display = $modified_confirm_message;
$steps_display .= "<table><tr><td>
<form name='test' action='' method='post'>
<input type='hidden' name='url' value='". $_POST['url']."'>
<input type='hidden' name='link_id' value='".$_POST['link_id']."'>
<input type='hidden' name='new_price' value='".$_POST['price']."'>
<input type='hidden' name='old_price' value='".$_POST['old_price']."'>
<input type='hidden' name='cat_id' value='".$_POST['cat_id']."'>
<input type='hidden' name='installer_id' value='".$_POST['installer_id']."'>
<input type='hidden' name='coin_type' value='".$_POST['coin_type']."'>
<input type='hidden' name='agent_ID' value='".$_POST['agent_ID']."'>
<input type='hidden' name='this_links_bid_status_on_Central' value='".$_POST['this_links_bid_status_on_Central']."'>
<input type='hidden' name='confirm_downgrade' value='true'>
";
// removed <input type='hidden' name='new_bid_type' value='".$_POST['new_bid_type']."'> from above inputs. It was generating an error message and doesn't seem to be used in the functions (next and above)
 

$steps_display .= '<br><input type="submit" name="confirm_downgrade" id="confirm_downgrade" value="Confirm downgrade" /> </td></tr></table>';

echo $steps_display;
//get_footer();
exit();
}
elseif(isset($_POST['purchase'])){
echo '<br>in line 77 POST purchae';
print_r($_POST);
$linkInfo = new member_page_info();

$link_id = $_POST['link_id'];
$price = $_POST['price'];
$cat_id = $_POST['cat_id'];
$installer_id = $_POST['installer_id'];
$coin_type = $_POST['coin_type'];
$agent_ID = $_POST['agent_ID'];
$users_balances_string =$_POST['users_balances_string'];
if(array_key_exists('users_balances_string', $_POST)){
$users_balances_string = $_POST['users_balances_string'];
}
else
{
$users_balances_string = "";
}

$num_bids = $linkInfo->check_for_bid($link_id);
if($num_bids < 1){
/* Dropping $links_approval_status from the function call because it generates (no value) error after purchasin
$linkInfo->copyBuyAgentPriceslotsSubscripts($user_id, $agent_ID, $link_id, $price, $cat_id, $installer_id, $coin_type,$links_approval_status, $users_balances_string); */
$linkInfo->copyBuyAgentPriceslotsSubscripts($user_id, $agent_ID, $link_id, $price, $cat_id, $installer_id, $coin_type, $users_balances_string);
$reason = "purchase";

//the above will also run archiveBuyAgentPriceslotsSubscripts($agent_ID, $link_id)
if(!isset($location_id)){$location_id=0;}
$isLinkApproved = $linkInfo->isUserLinkReviewed($user_id, $agent_ID, $link_id, $cat_id, $location_id);

$linkInfo->sendBuyToCentral($user_id, $agent_ID, $link_id, $price, $cat_id, $installer_id, $coin_type, $reason);

 $today1 = date('F j, Y, g:i a');
 if($isLinkApproved == "yes"){
 echo '<br>', SUCCESSFUL_BID_SUBMISSION1;
 }
 else
 {
 echo '<br>', TEMP_SUCCESSFUL_BID_SUBMISSION1;
 }
echo SUCCESSFUL_BID_SUBMISSION2." ".   $today1;
echo '</h4>'.SUCCESSFUL_BID_SUBMISSION3;
echo '<div style=" width: 50%;  margin: 0 auto;"><img src = "views/networkeffect4.jpeg"></div>';
//get_footer();
}
else
{
echo '<h2>This bid has already been submitted. Use the Modify Bid function to change it</h2>';
}
exit();

 }//close if isset purchase
elseif(isset($_POST['confirm_upgrade']) AND null !==($_POST['link_id']) ){


$linkInfo = new member_page_info();
//print_r($_POST);
$link_id = $_POST['link_id'];
$new_price = $_POST['price'];
$old_price = $_POST['old_price'];
$cat_id = $_POST['cat_id'];
$installer_id = $_POST['installer_id'];
$coin_type = $_POST['coin_type'];
$agent_ID = $_POST['agent_ID'];
//$users_balances_string = $_POST['users_balances_string'];
$this_links_bid_status_on_Central = $_POST['this_links_bid_status_on_Central'];
$reason="upgrade";
$linkInfo->sendModifyToCentral($user_id, $agent_ID, $link_id, $new_price, $old_price, $cat_id, $installer_id, $coin_type, $reason, $this_links_bid_status_on_Central);
//get_footer();
exit();
}
elseif(isset($_POST['modify_type']) AND $_POST['modify_type'] == 'current' ){
echo '<h1>In order to modify your bid you must select a price slot different from your current one</h1><h1>Use the browser\'s back button to return to the previous bidding form</h1>';
exit('line 149');
}
elseif(isset($_POST['modify_type']) AND $_POST['modify_type'] == 'upgrade' AND null !==($_POST['link_id']) ){
echo '<br>line 147 in POST upgrade';
print_r($_POST);
//We can't let this hit the missing link_if filters below that redirect because 1) it will always have to have
$steps_display = "<h2>Confirm Your Upgrade!</h1><h2> Your listing will receive a new Bid Seniority. Your new position in the display may be affected. Ads are displayed first by price slot amount and then by their seniority (i.e. date/time purchased) within that price slot.  </h2>";
$steps_display .= "<table><tr><td>
<form name='test' action='' method='post'>
<input type='hidden' name='url' value='". $_POST['url']."'>
<input type='hidden' name='link_id' value='".$_POST['link_id']."'>
<input type='hidden' name='price' value='".$_POST['price']."'>
<input type='hidden' name='old_price' value='".$_POST['old_price']."'>
<input type='hidden' name='cat_id' value='".$_POST['cat_id']."'>
<input type='hidden' name='installer_id' value='".$_POST['installer_id']."'>
<input type='hidden' name='coin_type' value='".$_POST['coin_type']."'>
<input type='hidden' name='agent_ID' value='".$_POST['agent_ID']."'>
<input type='hidden' name='modify_type' value='".$_POST['modify_type']."'>
<input type='hidden' name='this_links_bid_status_on_Central' value='".$_POST['this_links_bid_status_on_Central']."'>
<input type='hidden' name='confirm_upgrade' value='true'>
";

$steps_display .= $confirm_upgrade_message;//in translations/en/buy_price_slots_common.php
$steps_display .=  '<br><input type="submit" name="confirm_upgrade" id="confirm_upgrade" value="Confirm Upgrade" /> </td></tr></table>';

echo $steps_display;
//get_footer();
exit();
}

elseif(isset($_POST['confirm_cancel']) AND null !==($_POST['link_id']) ){
$link_id = $_POST['link_id'];
$price = $_POST['price'];
$cat_id = $_POST['cat_id'];
$installer_id = $_POST['installer_id'];
$coin_type = $_POST['coin_type'];
$agent_ID = $_POST['agent_ID'];
$users_balances_string = $_POST['users_balances_string'];
$reason="cancel";

$linkInfo = new member_page_info();
$linkInfo->sendModifyToCentral ($current_id,$user_id,$link_id, $agent_ID,$prev_start_date,$prev_amount,$new_price, $coin_type, $reason, $this_links_bid_status_on_Central);
//get_footer();
exit();
}
elseif(isset($_POST['modify_type']) AND $_POST['modify_type']== 'cancel' AND null !==($_POST['link_id']) ){

//We can't let this hit the missing link_if filters below that redirect because 1) it will always have to have
//echo '<h1> in cancel obviously the header is missing. And the final cancel action should end on another page/action</h1>';
//print_r($_POST);

$steps_display .= "<table><tr><td>
<form name='test' action='' method='post'>
<input type='hidden' name='url' value='". $_POST['url']."'>
<input type='hidden' name='link_id' value='".$_POST['link_id']."'>
<input type='hidden' name='cat_id' value='".$_POST['cat_id']."'>
<input type='hidden' name='installer_id' value='".$_POST['installer_id']."'>
<input type='hidden' name='coin_type' value='".$_POST['coin_type']."'>
<input type='hidden' name='agent_ID' value='".$_POST['agent_ID']."'>
<input type='hidden' name='confirm_cancel' value='true'>
";

$steps_display .= '<h1>Confirm Your Paid Advertising!</h1><h2> (Your listing will revert to its original Free position according to its seniority)</h2>
<br><input type="submit" name="confirm_cancel" id="confirm_cancel" value="Confirm cancelleation" /> </td></tr></table>';

//echo '<br>in buy price slot.php line 178 $steps_display = ', $steps_display;
//get_footer();
exit();
}
if(isset($_POST['B1']) OR isset($_GET['B1'])){
//get BSV price
$handle = curl_init();
$url = "https://min-api.cryptocompare.com/data/price?fsym=BSV&tsyms=USD,JPY,EUR";
curl_setopt($handle, CURLOPT_URL, $url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
 $jsonlinkList = curl_exec($handle);
 curl_close($handle);
$data = json_decode($jsonlinkList, TRUE);
$monthly_minimum_bid_target = $monthly_target_fee_in_dollar_value/$data['USD']; //amount of "dollars" we want the lowest displayed bid to approximate. Note the bids are posting the daily price to be deducted but also post a "daily" amount. Usually will be a decimal but a 1 would display a lowest bid of about $30 or $31 equivalent a month. .33 would be 1/3 of that ($10) so .165 would be approx $5 a month as the starting lowest bid
$daily_minimum_bid_target = $monthly_minimum_bid_target/30;

if($debug=="2"){
	echo '<p style="color:red;">You are seeing these coding messages because you have Debug turned on in /manna-configs/db_cfg/agent_config.php/</p><br>Post values from form = ';
	print_r($_POST);
	}

$linkInfo = new member_page_info();

$users_balances_string = $linkInfo->getUserBalanceFromCentral ($user_id, AGENT_ID);
//returns  array( $bitcoin_cash_balance|$democoin_balance );
$users_balances = explode("|",$users_balances_string);

if (array_key_exists('link_id', $_POST)) {
//this will parse the data coming to the first loading of the bid page from the selection (BTC vs demo)

$link_id = $_POST['link_id'];
//test deactivation because it generated error:  Undefined index: price in /home/orlandoreferralg/public_html/manna_network/manna-network/members/views/buy_price_slot.php on line 209
//$price = $_POST['price'];
$cat_id = $_POST['cat_id'];
$coin_type = $_POST['coin_type'];
$agent_ID = $_POST['agent_ID'];
$users_balances_string = $_POST['users_balances_string'];
$installer_id = $_POST['installer_id'];
$location_id = $_POST['location_id'];

$isLinkApproved = $linkInfo->isUserLinkReviewed($user_id, AGENT_ID, $link_id, $cat_id, $location_id);

//status of next func and call - probably junk but was beginning of retrieving count processes from manna network
//the queries in the check-for_bidsby_cat_and_price do an extra query and avoid the errors. This function could use same technique if we need it

//the above checks both the temppriceslots table (that would mean it hasn't been submitted yet and any changes they make only affect local tables and displays) and also the regular price slots table (a change only takes effect at cron time but local records get changed)
//$thisLinksRegionalInfo = $linkInfo->getThisLinksRegionalInfo($link_id, $agent_ID, $location_id);
//instead of this function we need to retrieve ALL the regional array associated with the location id.
$site_is_reviewed = $linkInfo->isUserLinkReviewed($user_id, $agent_ID, $link_id, $cat_id, $location_id);
//Pseudo code: If/when there are no bids in central's live price slots there may be some in temp priceslots BUT the only temp bid we need is this users (so we can accurately report their status and the progress of the bid's processing by admin.
//  SO ... we need to 1) Determine if there are any LIVE bids in Central
//If it returns "no bids" we still check for this user (it is only possible for them to be in temp)
//If it returns a string with a pipe in it then the high bid will be on the left and the low one on the right (note they will be the same if all the bids are the same)
 $this_links_bid_status_on_Central = $linkInfo->getUserPriceSlots($user_id, $agent_ID, $link_id, $cat_id, $coin_type);
// returns either "no_bids", "temp_bid", "approved_bid", or "error_detecting_bid"
	if($debug=="2"){
	echo '<h3>$this_links_bid_status_on_Central = '.$this_links_bid_status_on_Central. '</h3>';
	}
if($this_links_bid_status_on_Central !=="no_bids"){
	if($debug=="2"){
	echo '<h3>In "the if" </h3>';
	}
//returns JUST the price amount whether bid is in temp or subscribed
$this_links_bid = $linkInfo->getUsersPriceSlotAmount($user_id, $agent_ID, $link_id, $cat_id, $coin_type);
if($debug=="2"){
	echo '<h3>$this_links_bid = '.$this_links_bid.'</h3>';
	if(!is_numeric($this_links_bid)){
	$pieces = explode("|", $this_links_bid);
	echo '<br>$pieces = ';
	print_r($pieces);
	}
	}
	if(!is_numeric($this_links_bid)){
	$pieces = explode("|", $this_links_bid);
	include('conditions/error_recovery.php');
	echo "<h1>error code:2</h1>";
	//get_footer();
	exit();
	}
}
	if($debug=="2"){
	echo '<h3>$user_id = '.$user_id. '</h3>';
	echo '<h3>$agent_ID = '.$agent_ID. '</h3>';
	echo '<h3>$link_id = '.$link_id. '</h3>';
	echo '<h3>$cat_id = '.$cat_id. '</h3>';
	echo '<h3>$coin_type = '.$coin_type. '</h3>';
	echo '<h3>$location_id = '.$location_id. '</h3>';
	echo '<h3>$isLinkApproved = '.$isLinkApproved.'</h3>';
	}
// Continue the parse after skipping functions because the values were returned from dropdown via GET
}

elseif (array_key_exists('link_id', $_GET)) {
//this will parse the data coming to the dropdown regional filter selection ON the first loading of the bid page from the selection (BTC vs demo)
//https://1stbitcoinbank.com/manna_network/manna-network/members/buy_price_slot.php?link_id=79&price=&cat_id=60&coin_type=DMC&agent_ID=17&users_balances_string=0000000000.0000000000|0000000000.1000000000&this_links_bid_status_on_Central=temp_bid&this_links_bid=000.00127836&tregional_num=y&B1=%271%27

$link_id = $_GET['link_id'];
$price = $_GET['price'];
$cat_id = $_GET['cat_id'];
$coin_type = $_GET['coin_type'];
$agent_ID = $_GET['agent_ID'];
$users_balances_string = $_GET['users_balances_string'];
$this_links_bid_status_on_Central= $_GET['this_links_bid_status_on_Central'];
$this_links_bid= $_GET['this_links_bid'];
//where does it get this value? The "if" part of this filter doesn't retrieve the var?
$tregional_num = $_GET['tregional_num'];
}

$steps_display_common = "<tr><td colspan=4>".MINIMUM_EXPLAINED1.$monthly_target_fee_nominal_value.MINIMUM_EXPLAINED2.$monthly_target_fee_nominal_value.MINIMUM_EXPLAINED3.MINIMUM_EXPLAINED4.$monthly_target_fee_nominal_value.MINIMUM_EXPLAINED5."</td></tr></table></div>";

//$steps_display_common = "<tr><td colspan=4>".MINIMUM_EXPLAINED1.$monthly_target_fee_nominal_value.MINIMUM_EXPLAINED2.$monthly_target_fee_nominal_value.MINIMUM_EXPLAINED3.$steps[$max_key_of_steps-1].MINIMUM_EXPLAINED4.$monthly_target_fee_nominal_value.MINIMUM_EXPLAINED5."</td></tr></table></div>";
/*
Possible_scenarios.
1) cat_and_user_have_no_bids.php (no_user_temp_bids_nor_user_approved_bids)_-_status_works_ok_on_1stbtc_
2) cat_has_no_bids_and_user_has_a_pending_status_link_with_a_bid.php
3) cat_has_a_bid_and_user_has_no_bids.php (no_user_temp_bids_nor_user_approved_bids)
4) cat_has_a_bid_and_user_has_a_bid_in_pending_status.php
5) cat_has_a_bid_and_user_has_the_only_approved_bid.php
6) cat_and_user_has_approved_bid.php   */
$cat_status_approved = $linkInfo->get_cat_count_of_bids_approved($cat_id, $coin_type);
//returns the number of approved bids within this category and the coin type selected by the user
echo '<BR><form method="post" action="https://exchange.manna-network.com/incoming/check_for_bids_by_remote_link_id.php">
<input type="text" name= "user_id" value="'.$user_id.'" />
 <input type="text" name= "agent_ID" value="'.$agent_ID.'" />
 <input type="text" name= "remote_link_id" value="'.$remote_link_id.'" />
  <input type="text" name= "cat_id" value="'.$cat_id.'" />
  <input type="text" name= "coin_type" value="'.$coin_type.'" />
   <input type="submit" value="Submit">
</form> ';
$this_links_bid_status_on_Central = $linkInfo->getUserPriceSlots($user_id, $agent_ID, $link_id, $cat_id, $coin_type);
// returns either "no_bids", "temp_bid", "approved_bid", or "error_detecting_bid"
	if($debug=="2"){
	echo '<br>$cat_status_approved = ', $cat_status_approved;
	if($this_links_bid_status_on_Central !=="no_bids")
	echo '<br>$this_links_bid_status_on_Central = ', $this_links_bid_status_on_Central;
	
	/*
	we need a new function isUserLinkReviewed() to check whether this link has been reviewed or is pending. The current second page is loading as "pending" because the bid is in temp but that "pending" is supposed to refer to the link, NOT the bid! Then, after the function is made, change the filter to open a new conditions/when_link_is_not_reviewed page
	*/
	}
	
	if($this_links_bid_status_on_Central == "error_detecting_bid"){
	include('conditions/error_recovery.php');
	echo "<h1>error code:1</h1>";
	exit();
	}elseif($cat_status_approved == 0){
	//this cat status may still have this user's bid in pending status
	$hi_low_string = $linkInfo->getMinMaxPriceSlotFromCentral($cat_id, $coin_type); 
	if($hi_low_string !=="No Bids"){
	$pieces = explode("|", $hi_low_string);
		$lowestpriceslot = $pieces[1];
		$highestpriceslot = $pieces[0];
		}
		
		if($this_links_bid_status_on_Central == "temp_bid"){
		include('conditions/cat_has_no_bids_and_user_has_a_bid_in_pending_status.php');
		$max_key_of_steps = count($steps);
		$steps_display .= $steps_display_common;
		}
		else
		{
		include('conditions/cat_and_user_have_no_bids.php');
		$max_key_of_steps = count($steps);
		$steps_display .= $steps_display_common;
		}
	}
	elseif($cat_status_approved ==1)
	{
$hi_low_string = $linkInfo->getMinMaxPriceSlotFromCentral($cat_id, $coin_type); 
if($hi_low_string !=="No Bids"){
	$pieces = explode("|", $hi_low_string);
		$lowestpriceslot = $pieces[1];
		$highestpriceslot = $pieces[0];
		}
		else
		{
		echo '<br>We need to make this users temp bid the hi and low. Line 358 of BPS';
		}
	//this user status may be the one causing the cat to "have bid" so we need to 1) check if this user has an approved bid , then this user is only bid
		if($this_links_bid_status_on_Central == "approved_bid" AND $cat_status_approved ==1){
		include('conditions/cat_has_a_bid_and_user_has_the_only_approved_bid.php');
		$steps_display .= $steps_display_common;
		}elseif($this_links_bid_status_on_Central == "temp_bid"){
		include('conditions/cat_has_a_bid_and_user_has_a_bid_in_pending_status.php');
		}
		elseif($this_links_bid_status_on_Central == "approved_bid" AND $cat_status_approved > 1){
		include('conditions/cat_and_user_has_approved_bid.php');
		$steps_display .= $steps_display_common;
		}
		else
		{
		include('conditions/cat_has_a_bid_and_user_has_no_bids.php');
$steps_display .= $steps_display_common;
		}
	   }
else //$cat_status_approved >1 meaning this handles all displays with two or more bids in
{
$hi_low_string = $linkInfo->getMinMaxPriceSlotFromCentral($cat_id, $coin_type);
		$pieces = explode("|", $hi_low_string);
		$lowestpriceslot = $pieces[1];
		$highestpriceslot = $pieces[0];
// TEST CODE TO FIX OMMISSION!
//This isn't loading the translations?
//This isn't comparing the current users temp bid to see if it is higher than highest?
if($this_links_bid_status_on_Central == "temp_bid"){
		include('conditions/cat_has_a_bid_and_user_has_a_bid_in_pending_status.php');
		$max_key_of_steps = count($steps);
		$steps_display .= $steps_display_common;
		}
		elseif($this_links_bid_status_on_Central == "no_bids"){
		include('conditions/cat_has_a_bid_and_user_has_no_bids.php');
		$max_key_of_steps = count($steps);
		$steps_display .= $steps_display_common;
		}
		else
		{
		include('conditions/cat_and_user_has_approved_bid.php');
		$max_key_of_steps = count($steps);
		$steps_display .= $steps_display_common;
              }

}
echo $steps_display;
}
else
{
if(array_key_exists('link_id', $_GET) AND array_key_exists('link_id', $_POST) AND null ==($_GET['link_id']) AND null ==($_POST['link_id'])){
header("Refresh:0; url=index.php");
}

$linkInfo = new member_page_info();
//Change on local table
if (array_key_exists('location_id', $_GET)){
if($debug=="2"){
echo '<h1>$_GETlocation_id  = ', $_GET['location_id'] ;
echo '</h1>';
print_r($_GET);
echo '<br>';
print_r($_POST);
}
//we need to deactivate this temporarily - It needs to detect the level of the location so we don't give irrelevant info and links
$_GET['location_id'] = 0;
if(isset($_GET['location_id']) && $_GET['location_id'] > 0){
echo '<br>IN sset($_GET[\'location_id\']) && $_GET[\'location_id\'] > 0 == ', $_GET['location_id'];
include('includes/buy_section1_regional.php');
//echo '<br>line 386';
}
else
{ 
//echo '<h1>NOT IN sset($_GET[\'location_id\']) && $_GET[\'location_id\'] > 0</h1>';
//echo $linkInfo->thisLinksRegionalInfo($_GET['link_id'], $_GET['agent_ID']);

include('includes/buy_section1.php');
//echo '<br>line 393';
}
echo '</div>'; //this closes the index_content class
}
//echo '<br>line 408 with commented out $display_block';
if(isset($display_block)){
echo $display_block;
}
}
echo '</div>';
echo '</div></div>';
get_footer();
?>
