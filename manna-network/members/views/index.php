<?php
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
get_header();
//include('bootstrap_header.php');
//include($_SERVER['DOCUMENT_ROOT']."/manna-network/members/classes/member_page_class.php");//load order 1
include(dirname(__DIR__, 3)."/manna-network/members/classes/member_page_class.php");
include(dirname(__DIR__, 3)."/manna-network/members/css/members_menu.css");

include(dirname(__DIR__, 3)."/manna-configs/db_cfg/agent_config.php");//load order 1
//echo dirname(__DIR__, 3)."/manna-network/members/css/members_menu.css";
$display_block = file_get_contents(dirname(__DIR__, 3).'/manna-network/members/css/members_menu.css');
//include(dirname(__DIR__, 3)."/manna-network/members/css/members_menu.css");
$linkInfo = new member_page_info();
 $LINKinfo = new member_page_info();
$user_id = $_SESSION['user_id'];
$affiliate_link_display = $LINKinfo->getLinkByUserIdFree($user_id);

//returns Array ( [0] => 1 [1] => 98 [2] => 77 [3] => 9999 [4] => ftest1 [5] =>  Description - Enter a 50 to 255 character description of your website or business [6] => https://ftest1.com [7] => 0 [8] => [9] => 0 [10] => [11] => [12] => [13] => 1593648000 [14] => 1 )
//returns $send_array = array($num_links_this_user, $id, $user_id, $recruiter_lnk_num, $website_title, $website_description, $website_url, $category_id, $newcatsuggestion, $location_id, $website_street, $website_district,  $user_registration_datetime, $installer_id);
//doesn't and can't tell us the link status

$num_links_this_user= $affiliate_link_display[0];
$id= $affiliate_link_display[1];
//$user_id= $affiliate_link_display[2];  might conflict with user id from session  and not used here
$recruiter_lnk_num= $affiliate_link_display[3];
$website_title= $affiliate_link_display[4];
$website_description= $affiliate_link_display[5];
$website_url= $affiliate_link_display[6];
$category_id= $affiliate_link_display[7];
$newcatsuggestion= $affiliate_link_display[8];
$location_id= $affiliate_link_display[9];
$website_street= $affiliate_link_display[10];
$website_district= $affiliate_link_display[11];
$user_registration_datetime= $affiliate_link_display[12];
$installer_id= $affiliate_link_display[13];
$display_block .= file_get_contents('views/_menu.php', true); 
//$display_block .= '<div>&nbsp;</div><div id="index_content" class="index_content" name="index_content"><hr>';

$display_block .= "<div class='panel panel-default'><a href=\"\"><h2>Member's Home</h2></a>";
if(is_array($id)){
$display_block .= '<div id=members_links style="background-color:lightgray;"><h3 style="background-color:darkgray; color:white; font-weight:bold;">Manage Your Registered Links</h3>';
	foreach($id as $key=>$value){

$thisLinksRegionalInfo = $LINKinfo->getThisLinksRegionalInfo($_GET['link_id'], $agent_ID);
$users_balances_string = $LINKinfo->getUserBalanceFromCentral ($user_id, AGENT_ID);
$is_link_paid = $LINKinfo->check_for_bid($value);
//returns  array( $bitcoin_cash_balance|$democoin_balance );
$users_balances = explode("|",$users_balances_string);

//$display_block .= '  <span class="item2"><h4>Configurations To Install Your Plugin <br> Link ID -> '. $value.' | Category ID -> '. $category_id[$key].' | Manna Network Installer ID -> '. $installer_id[$key].' | Your Agent\'s ID -> '. AGENT_ID.' | Your Agent\'s URL -> <a target="_blank" href="https://'. AGENT_URL.'">'.AGENT_URL.'</a> Agent folder name -> '.AGENT_FOLDERNAME.'</h4>';

		$display_block .= '<span><h3>URL:'.$website_url[$key].'</h3></span><span><ul class="navmenu"><li> <a href="buy_price_slot.php?url='.$website_url[$key].'&link_id='.$value.'&category_id='.$category_id[$key].'&installer_id='.$installer_id[$key].'&location_id='.$location_id[$key].'&agent_ID='.AGENT_ID.'">';
if($is_link_paid > 0){

$display_block .= 'Modify Your Bid';
}
else
{
$display_block .= 'Get Better Placement';
 }

$display_block .= '</a> </li>';
$display_block .= '<li> <a href="cancel.php?url='.$website_url[$key].'&link_id='.$value.'&category_id='.$category_id[$key].'&installer_id='.$installer_id[$key].'"> Cancel</a></li>';
$display_block .= '<li> <a href="edit_a_link.php?url='.$website_url[$key].'&link_id='.$value.'&category_id='.$category_id[$key].'&installer_id='.$installer_id[$key].'"> Edit</a></li>';
$display_block .= "</ul></h3></span><hr>";


	}
}
else
{
$is_link_paid = $LINKinfo->check_for_bid($id);
$display_block .=  '<div id=members_links style="background-color:lightgray;"><h3>Manage Your Registered Link</h3>';
	$display_block .=  '<span><h3>URL:'.$affiliate_link_display[6].'</span><span><ul class="navmenu"><li><a href="buy_price_slot.php?url='.$affiliate_link_display[6].'&link_id='.$affiliate_link_display[1].'&category_id='.$affiliate_link_display[7].'&installer_id='.$affiliate_link_display[13].'&location_id='.$location_id.'&agent_ID='.AGENT_ID.'">';
if($is_link_paid > 0){

$display_block .=  'Modify Your Bid';
}
else
{
$display_block .=  'Get Better Placement';
 }

$display_block .= '</a> </li>';

$display_block .=  '<li> <a href="cancel.php?url='.$website_url.'&link_id='.$id.'&category_id='.$category_id.'&installer_id='.$installer_id.'"> Cancel</a></li>';
$display_block .=  '<li> <a href="edit_a_link.php?url='.$website_url.'&link_id='.$id.'&category_id='.$category_id.'&installer_id='.$installer_id.'"> Edit</a></li>';
$display_block .=  "</ul></h3></span><hr></div>";


}
echo $display_block;

echo '</div>';


echo '<div>&nbsp;</div> <div class="panel-body"><hr><div id=members_links style="background-color:lightgray;"><u><h2>Other Member Administrative Pages</h2></u></div>
 <!--   <div class="panel-body"><h3><a href="site_ids.php?url='.$website_url.'&link_id='.$id.'&category_id='.$category_id.'&installer_id='.$installer_id.'">Site Configurations, IDs and Settings</a></h3></div> --> ';
echo '    <div class="panel-body"><h3><a href="add_a_link.php">Add More Websites/Ads</a></div> ';
echo '    <div class="panel-body"><h3>Learn And Get Bitcoin (coming soon - a basic course in Bitcoin)</div> ';
echo '    <div class="panel-body"><h3>Earn Bitcoin With Our Free Script</div> ';
echo '    <div class="panel-body"><h3>Redeem Your Bitcoin Earnings
<h5>Four Ways You Can Redeem Your Earnings</h5>
<ul><li>Redeem then directly from the Manna Network Cooperative Ad Network</li><li>Use Manna Network\'s Member-To-Member Exchange (a private, negotiated transaction between the members and/or advertisers to buy/sell/exchange ad credits for cash, crypto or other consideration</li>
<li>Get your own Payment Processing and we will assign incoming Bitcoin deposits to your account</li>

<li>Redeem their value by buying better placement for your own website in the web directory/ad network</li>
</ul></div> ';
echo '
    <div class="panel-body"><h3>Accept Bitcoin At Your Business (Get Payment processing)</div> </div></div>';


//include('bootstrap_footer.php');
get_footer();
?>
