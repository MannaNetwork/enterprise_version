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
include('styles.css');
include(dirname( __FILE__, 2 ).'/css/members_menu.css');
include('views/_menu.php');
require_once(dirname( __FILE__, 4 )."/manna-configs/db_cfg/agent_config.php");
include(dirname( __FILE__, 5 )."/".AGENT_FOLDERNAME."/manna-network/members/classes/CancelSuspend.php");
get_header();
$cancelalink = new cancelalink();
$agent_ID = AGENT_ID; 
echo '<br>in cancelSuspend POST =';
print_r($_POST);
echo '<br>GET = ';
print_r($_GET);
if(isset($_POST['submit'])){
echo 'line 28';
print_r($_POST);
echo '<br>Now we need to process this cancellation. We need to delete from Manna Network at all tables 1) mn_bridge 2) links 3) price_slots subscripts. What is the delete from node links process? Is there a temp table storing the links pegged for deletion? If so, we need to insert this link into it.
<br>We need to remove from the agent site 1) customer_links 
<br> We need to check agent site to see if this user has any other ads. If not, delete the user too.';
exit();

//now send cancellation to central 
if (array_key_exists ( "isTemp" , $_POST ) AND isset($_POST["isTemp"])) {
$file="https://exchange.manna-network.com/incoming/cancelSuspendTemp.php";
}
else
{
		$file="https://exchange.manna-network.com/incoming/cancelSuspend.php";
		}
		echo '<br>$file = ', $file;
		$args = array(
		'agent_id' => $_POST['agent_ID'],
		'remote_lnk_id' => $_POST['remote_lnk_id'],
		'installer_id' => $_POST['installer_id'],
		'url' => $_POST['url']
		);
		if (array_key_exists ( "isTemp" , $_POST ) AND isset($_POST["isTemp"])) {
$args['isTemp']=1;
}
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $file);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, array('locus_array' => $locus_array,'link_record_num' => $link_record_num,'link_page_total' => $link_page_total, 'link_page_id' => $link_page_id, 'pagem_url_cat' => $pagem_url_cat,'link_page_num' => $link_page_num, 'cat_page_num' => $cat_page_num, 'url_cat' => $url_cat, 'affiliate_num' => $affiliate_num  ));
		curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
    		    $curl_errno = curl_errno($ch);
		    $curl_error = curl_error($ch);
		    if ($curl_errno > 0) {
			    echo "cURL Error line 575 ($curl_errno): $curl_error\n";
		    } else {   
		echo $data ; 
		}
	get_footer();
}
else
{
require_once(dirname( __FILE__, 2 )."/translations/en.js");
require_once(dirname( __FILE__, 2 )."/js/edit_a_link.js");
require_once(dirname( __FILE__, 2 )."/css/styles.css");
require_once(dirname( __FILE__, 2 )."/classes/CancelSuspend.php");
$cancel = new cancelalink();
$link_info = $cancel->getLinkByLinkId($_GET['link_id']);

echo '<div style=\'color:red;\'>'.CANCEL_FORM_WELCOME_TITLE.'</div>';
echo '<div style=\'color:red;\'>'.CANCEL_FORM_WELCOME_BODY.'</div>';
echo "<div><h2>".TABLE_HEADER."</h2></div>";
foreach ($link_info as $key=> $value){
	if($key==4){
	echo '<div>' .TITLE . ': '. $value;
	}
	elseif($key==5){
	echo '<br>' .DESCRIPTION . ': '. $value;
	}
	elseif($key==6){
	echo '<br>' .URL . ': '. $value.'</div>';
	}
}
$pay_status = $cancel->getLinkPayStatus($link_info[1], $agent_ID);
if($pay_status == 'no_bids'){
echo 'Your advertising pay_status =', $pay_status ;
}
echo '<br>print r link info';
print_r($link_info);
/*
[0] => 1 [1] => 350 [2] => 164 [3] => [4] => Dummy site 5 [5] => Edit test Description - Enter a 50 to 255 character description of your website or business Description - Enter a 50 to 255 character description of your website or business Description - Enter a 50 to 255 character description of your website or busi... [6] => dummysite5.com [7] => 10051 [8] => 3153 [9] => [10] => 1657238400 [11] => 3 

*/
//send $agent_ID, $remote_lnk_id, $installer_id, $url
//this function sends it all to Manna Network for processing. There is no "widgets" table on agent sites so the only way to confirm whether or not a link has ever registered an advertiser is to check on Manna Network

$widget_status = json_decode($cancel->check_if_a_widget($agent_ID, $link_info[0]));
//$agent_ID, $remote_lnk_id, $installer_id, $url
echo '<h1>line 206 $widget_status = ', $widget_status ;
echo '<br>&nbsp;<br>';
if($widget_status === "not_found"){
//echo '<h1>Your link was not found in widgets';
//echo 'You have the option to merely suspend your listing (which can be undone at a later date) or you can cancel. If you cancel you can reinstall the advertisement again in the future (but your ad will have lost any/all seniority it had for placement).<br>ADD THE CURL CALL TO cancel and delete the link at MANNA NETWOrK<br>Put a form here with option to delete or suspend. Name the form cancelSuspend';
include('_cancel_form.php');
}
else
{
echo '<h1>Your link was found in widgets';
//Now check if any links registered at that widget 
$countSubLinks = $cancel->getSubLinkCount($widgetid);
	if($countSubLinks >0){ 
	echo 'Bogus message - placeholder - if conditions commented out - Your installed directory has advertisers registered. That means if/when they decide to pay and/or if they decide to install the web directory script they have the potential to still earn you income (even if your own web directory and advertising has been stopped). For that reason, we will only suspend this listing. You can monitor it\'s earnings by logging in regularly to check.';

	}
else
{
//they have an installation but no registered links
echo 'We have not detected any advertisers that have registered at your web directory. You have the option to merely suspend your listing (which can be undone at a later date) or you can cancel. If you cancel you can reinstall the advertisement again in the future (but your ad will have lost any/all seniority it had for placement).';

}  
}

//$agent_ID, $remote_lnk_id, $installer_id, $url
//$agent_ID, $remote_lnk_id, $installer_id, $url
}
get_footer();
?>
