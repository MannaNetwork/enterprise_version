<?php

/**
 * A simple, clean and secure PHP Login Script
 *
 * ADVANCED VERSION
 * (check the website / GitHub / facebook for other versions)
 *
 * A simple PHP Login Script.
 * Uses PHP SESSIONS, modern password-hashing and salting
 * and gives the basic functions a proper login system needs.
 *
 * @package php-login
 * @author Panique
 * @link https://github.com/panique/php-login/
 * @license http://opensource.org/licenses/MIT MIT License
 */

// load php-login components
ini_set('display_errors', '1');
require_once("php-login.php");

// create the registration object. when this object is created, it will do all registration stuff automatically
// so this single line handles the entire registration process.
$wdgts_lnk_num = "";
// in the wp register version the inclusion of $widgets link num in the new class call so removed $registration = new Registration($wdgts_lnk_num);
$registration = new Registration();

// showing the register view (with the registration form, and messages/errors)
if (!defined('AGENT_FOLDERNAME')) {
include(dirname(__DIR__, 2)."/manna-configs/db_cfg/agent_config.php");
}
if (!defined('READER_CUSTOMERS')) {
include(dirname(__DIR__, 2)."/manna-configs/db_cfg/auth_constants.php");

}
include(dirname(__DIR__, 2)."/manna-configs/db_cfg/".READER_CUSTOMERS);

include(dirname(__DIR__, 2)."/manna-configs/db_cfg/mysqli_connect.php");
//include('bootstrap_header.php'); 
include("js/registration.js"); 

if(array_key_exists('referer_lnk_num', $_GET) AND $_GET['referer_lnk_num']  =="change_me")
                {   
//Dev NOTE: IF the incoming GET value coming in has "change me"it means the "membership" version (the php script or wordpress plugin) hasn't configured their script on their site correctly
//Two things can be wrong
// 1) The deafult setting "change me" is still there (they need their link_num (reported to them as their affiliate number)or
// 2) They entered a wrong link_id
//We can only check for one accurately

echo '<h1 style="color:red";>We have detected that you have not finished configuring your application! This will prevent you from earning commissions! Please insert your link id number in the first line of the mannanetwork-dir/index.php file where it has the line of code <b>$lnk_num = "change_me" ;</b> and insert your link number '.$link_id_at_local.' in place of the phrase <b>"change_me"</b>';
echo '<h1 style="color:red";>The entire line should read<br>$lnk_num = '.$link_id_at_local.'; <br>when you are done</h1>';

echo '<h1 style="color:red";>RETURN TO PREVIOUS PAGE, <a href="http://'.$_GET['remote_server'].'/mannanetwork-dir/index.php">PREVIOUS PAGE</a> SELECT "ADD URL" TAB AGAIN, AND THE CORRECT CONFIGURATION SHOULD CAUSE THIS NOTICE TO NOT APPEAR</h1>';
exit();
}
else
{
$precleaned_host = $_SERVER['HTTP_HOST'];
$cleaned_host = str_replace("www.", "", $precleaned_host);
$query = "SELECT id, website_url FROM `customer_links` where `website_url` LIKE '%".$cleaned_host."%'";
$result = mysqli_query($mysqli, $query);
       if (mysqli_num_rows($result)<1){  
if(!array_key_exists("flag", $_GET) OR !isset($_GET['flag']) OR $_GET['flag'] !== "1"  ){ 
		//$url1 = $curl_security.AGENT_URL."/".AGENT_FOLDERNAME."/mannanetwork-dir/get_category_json.php";
//The following "if" condition is to guide a "first time" registration request made to this register.php page. The first time they enter, there is no "flag' variable and, so, we give the installer a link to this same page - now witth a flag variable. Then, when the user retursn (this time with a flag value) they get a different message AND the form

// but this is only run inside the function
		echo "<h1>Final step in configuring your new installation. You need to register your own (i.e. this) website as the first registration in your DATABASE. You cannot use this registration form without adding yourself as a user and your own website first. </h1>

		<p>&nbsp;<p><span  style='font-weight:bold;'>Simply Register THIS website/domain (i.e. $cleaned_host) as your account's FIRST user and FIRST website. 
		<p>&nbsp;<p><span  style='font-weight:bold;'><h3>Clicking the following link will enable you to add the administrative agent website and domain and user info:</h3>

		<p>&nbsp;<p><span  style='font-weight:bold;'><h3><a href='https://".AGENT_URL."/".AGENT_FOLDERNAME."/manna-network/members/register.php?referer_lnk_num=0&remote_server=".$_SERVER['HTTP_HOST']."&flag=1'>https://".$_SERVER['HTTP_HOST']."/".AGENT_FOLDERNAME."/manna-network/members/register.php?referer_lnk_num=0&remote_server=".$_GET['remote_server']."&flag=1</a>";
				     exit();
			}
			elseif(array_key_exists("flag", $_GET) AND isset($_GET['flag']) AND $_GET['flag'] == "1"  ){ 
			echo '<h1>You are about to make a ONE-TIME configuration of what will be your adminstrative account, thus making this domain (i.e. '. $cleaned_host. ') the member website which will get credit for all future registrations made from here. Be sure the information is accurate and there are no "typos"</h1>';
			echo '<h1>After you make this configuration, this notification will not appear indicating your registrations configuration is complete and is ready for your website visitors to register and add their link information to the manna network for free. </h1>';		    
			}
include("views/register_first.php");
}
else
{
include("views/register.php");

}
}
