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
$moniker="<h5>Fund Your Account</h5>";
$body_width="wide";
include("../../960top.php");

/*
 * Teszt for FormDataValidator class
 */
//laptop testnet server
$engross = "146aa8fc";
//$engross = "6bc33266";
//$test_user_id = 19;
$test_user_id = $user_id;
//$file="https://".$engross.".ngrok.com/save_rpc_calls.php";
$file="http://198.204.236.162/process_testnet.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
curl_setopt($ch, CURLOPT_POSTFIELDS, array('user_id' => $test_user_id, 'isTestCoin'=> 0    ));
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
//echo($data);
  ?>
		<div style="text-align: center;">
		<a class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;
		<a href="overview.php" class="cssbutton sample a"><span>Overview</span></a>&nbsp;
		<a href="reg_form" class="cssbutton sample a"><span>Add Link</span></a>&nbsp;
		<a href="bitcoin.php" class="cssbutton sample a"><span>Add Funds</span></a>&nbsp;
	        <a href="http://bungeebones.com/feedback.php?BB_user=<?echo $user_id; ?>" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="http://www.bungeebones.com/index.php?option=com_content&view=article&id=5:bungeebones-terms-of-service&catid=25:the-project&Itemid=2" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
		</div>
<table id="member"><tr><td>
<h5>Pre-Load/Fund Your Account With Testcoin To Demonstrate Buying Advertising</h5>
<p class='smallerFont' style="color:red;" >IMPORTANT: The system is currently running in test mode and is not ready to receive real Bitcoin! You can participate in the testing by going back to use the TestNet demo and going to a testnet faucet to deposit testcoin to the address. There are a number of testcoin faucets available (just do a search) but I have been using <a target="_blank" href="http://faucet.xeno-genesis.com/">Mojocoin Testnet Faucet3</a>. Just copy the bitcoin/testcoin wallet address below, go to <a target="_blank" href="http://faucet.xeno-genesis.com/">Mojocoin Testnet Faucet3</a> and paste it there (they place a limit on the amount but after the timer expires you can repeat the process if you wish).</p> 
<p class='smallerFont' style="color:red;" >After pre-loading your account with testcoin you can proceed to use them to purchase better placement. Buying a position with testcoin will move your link ahead of all free coins but they will be listed behind any paying with real Bitcoin (coming soon after testing). So those that participate in the testing will be rewarded with better positions than those that don't participate.</p>  
 <?echo $data;?>

</td></tr></table>

#To repeat the above offer using real Bitcoin I just need to create a duplicate Bitcoin qt, use the existing coding and use a different 
# ngrok address to link to it. Each ngrok would then offer either the testnet coin or the real bitcoin. 
# Someone paying a Satoshi of real bitcoin would pass all the test coin.
# In the User CP, duplicate the existing software to run test mode or real mode. They wouldn't be able to see real bids unless they switch 
# mode but they would see the highest bid was a Satoshi and they would have the experience to bid YES!!!!!!!


<?
include("../../960bottom.php");


} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}
