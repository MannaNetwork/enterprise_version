<?php

if (isset($_GET['action']) && $_GET['action'] == "log_out") {
//$test_page_protect->log_out(); // the method to log off
session_start();
session_destroy();
}
// include the configs
require_once("../config/config.php");
// load the login class
// load php-login components
require_once("../php-login.php");
// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...
$user_id = $_SESSION['user_id'];
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y)
$moniker="<h5>Fund Your Account With TestCoin</h5>";
$body_width="wide";
include("../../960top.php");


//http://59b234cd.ngrok.com
//$engross = "59b234cd";

$test_user_id = $user_id;

//$file="http://".$engross.".ngrok.com/process_testnet.php";
// http://59b234cd.ngrok.com -> 127.0.0.1:80

//$file="http://bungeebones.ngrok.com -> 127.0.0.1:80/process_testnet.php";  
$file="http://192.64.116.232/process_testnet.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
curl_setopt($ch, CURLOPT_POSTFIELDS, array('user_id' => $test_user_id, 'isTestCoin'=> 1  ));
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
//echo($data);
  ?>
		<div style="text-align: center;">
		<a href="/members/index.php" class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;
		<a href="/members/overview.php" class="cssbutton sample a"><span>Overview</span></a>&nbsp;
		<a href="/members/reg_form" class="cssbutton sample a"><span>Add Link</span></a>&nbsp;
		<a href="/members/add_funds.php" class="cssbutton sample a"><span>Add Funds</span></a>&nbsp;
	        <a href="/feedback.php?BB_user=<?echo $user_id; ?>" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="http://www.bungeebones.com/index.php?option=com_content&view=article&id=5:bungeebones-terms-of-service&catid=25:the-project&Itemid=2" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
		</div>
<table id="member"><tr><td>
 <?echo $data;
?>

</td></tr></table>



<?
include("../../960bottom.php");


} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}
