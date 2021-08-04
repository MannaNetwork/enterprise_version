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
  include(dirname( __FILE__, 5 )."/".AGENT_FOLDERNAME."/manna-network/members/classes/CancelURL.php");
$cancelalink = new cancelalink();
   
  $agent_ID = AGENT_ID; 


//include(dirname(__DIR__, 2)."/css/styles.css");
//Dev Notes: This copy of the registration form follows a complicated process to 1) display what is basically a copy of the Manna network registration form here but, when it is submitted the curl process sends all the post data to Manna network.
//All the visuals of the page are from the code below. The curl only returns the success message at the end (i.e. check your email)

if(isset($_POST['confirm'])){
//Array ( [website_title] => sadfsadfasf [website_description] =>  sasdfsdafsdg [website_url] => https://dsfdsfdsf,com [category_id] => 111 [category_named] => Business [confirm] => CONFIRM ) 
$website_title = $_POST['website_title']; 
$website_description = $_POST['website_description']; 
$website_url = $_POST['website_url'];  
$category_id = $_POST['category_id']; 
$category_named = $_POST['category_named']; 
$link_status = $_POST['link_status']; 


//$users_balances_string = $_POST['users_balances_string'];



// now that it is confirmed it has to submit it to the classes/Add_Url.php (which is a copy of Registration.php class)
$installer_id = get_option('installer_id');

//why am I using curl to the local folder?
// all we need to do is install in two tables - one here and one in MN


$new_links_id = $editalink->editLink($captcha, $recruiter_lnk_num, $website_title, $website_description, $website_url, $category_id, $newcatsuggestion, $location_id, $website_street, $website_district, $installer_id, $user_id, $link_status);

//now send user registration to central 
		$file="http://exchange.manna-network.com/incoming/edit_a_link.php";
		$args = array(
		'agent_id' => AGENT_ID,
		'remote_user_id' => $user_id,
		'remote_link_id' => $new_links_id,
		'recruiter_lnk_num' => $recruiter_lnk_num,
		'user_registration_datetime' => $user_registration_datetime,
		'website_title' => $website_title,
		'website_description' => $website_description,
		'website_url' => $website_url,
		'category_id' => $category_id,
		'newcatsuggestion' => $newcatsuggestion,
		'location_id' => $location_id,
		'website_street' => $website_street,
		'website_district' => $website_district,
		'installer_id' => $installer_id,
		'promo_credit' => $promo_amount,
'link_status' => $link_status
		);
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
//now that the user info was duplicated on M.N., all the info was duplicated from tempuser table to remote_mn_id_bridge. We can safely delete the info from tempuser

//the reason why this delete is happening is because this user's info is added to a temp table on MN until they confirm their email. Then it is copied over to links and the bridge table and will be broadcast so it can now be deleted from temp table on MN



/* we don't need to run this delete here. They are deleted when they are approved by MN. But there may be future need for this if we give enterprises the ability to approve their own links
		$file="http://exchange.manna-network.com/incoming/delete_tmps.php";
		$args = array(
		'agent_id' => AGENT_ID,
		'remote_user_id' => $user_id,
		'remote_link_id' => $link_id,
		'recruitegetLinkPayStatus($link_id, $agent_ID)r_lnk_num' => $recruiter_lnk_num,
		'user_registration_datetime' => $user_registration_datetime,
		'website_title' => $website_title,
		'website_description' => $website_description,
		'website_url' => $website_url,
		'category_id' => $category_id,
		'newcatsuggestion' => $newcatsuggestion,
		'location_id' => $location_id,
		'website_street' => $website_street,
		'website_district' => $website_district,
		'installer_id' => $installer_id,
		'promo_credit' => $promo_amount
		);
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
//echo '<h1> the info shou;ld be from tempuser</h1>';
		curl_close($ch);
		
}
		echo($data);
*/
}



get_footer();

}
elseif(isset($_POST['register'])){

$dont_show_array= array('captcha', 'register');
echo '<div class="reg_form_page"><h1 align="center">Confirm Your Registration Details For Accuracy</h1>
 <div class="reg_form_content">
<form class = "frms" method="POST" action="" name="registerform">';

	foreach($_POST as $key=>$value){
if(!in_array($key, $dont_show_array, TRUE) && !empty($value)){

	echo '<input type="hidden" name="'.$key.'" value="'.$value.'"><br>key = ', $key;
	echo '       = ', $value;
          }
	}

echo '<p><input type="submit" name="confirm" value="CONFIRM" />
   </form></div></div>';
}
else
{

require_once(dirname( __FILE__, 2 )."/translations/en.js");
require_once(dirname( __FILE__, 2 )."/js/edit_a_link.js");
require_once(dirname( __FILE__, 2 )."/css/styles.css");
require_once(dirname( __FILE__, 2 )."/classes/CancelURL.php");
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
print_r($link_info);
//send $agent_ID, $remote_lnk_id, $installer_id, $url
$widget_status = $cancel->getWidgetStatus($agent_ID, $link_info[1], $link_info[13], $link_info[6]);
echo '<h1>line 206 $widget_status = ', $widget_status ;
echo '<br>&nbsp;<br>';
if($widget_status === "Link_NOT_found"){
echo '<h1>Your link was not found in widgets';
echo 'ADD THE CURL CALL TO THE INSERT INTO MANNA NETWOrK';
}
else
{
echo '<h1>Your link was found in widgets';
//Now check if any links registered at that widget 
$countSubLinks = $cancel->getSubLinkCount($widgetid);
	if($countSubLinks >0){
	echo 'Your installed directory has advertisers registered. That means if/when they decide to pay and/or if they decide to install the web directory script they have the potential to still earn you income (even if your own web directory and advertising has been stopped). For that reason, we will only suspend this listing. You can monitor it\'s earnings by logging in regularly to check.';

	}
else
{
//they have an installation but no registered links
echo 'We have not detected any advertisers that have registered at your web directory. You have the option to merely suspend your listing (which can be undone at a later date) or you can cancel (if you cancel you can reinstall the directory again in the future but your ad will lose any/all seniority it has for placement).';
}
}

//$agent_ID, $remote_lnk_id, $installer_id, $url
//$agent_ID, $remote_lnk_id, $installer_id, $url
}
get_footer();
?>
