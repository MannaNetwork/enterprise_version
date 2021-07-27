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
//require_once( "./cryptoapi/cryptobox.class.php" );
$moniker="<h5>Fund Your Account</h5>";
$body_width="wide";


include("../../960top.php");

$test_user_id = $user_id;
  ?>
		<div style="text-align: center;">
		<a class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;
		<a href="overview.php" class="cssbutton sample a"><span>Overview</span></a>&nbsp;
		<a href="reg_form" class="cssbutton sample a"><span>Add Link</span></a>&nbsp;
		<a href="bitcoin.php" class="cssbutton sample a"><span>Add Funds</span></a>&nbsp;
	        <a href="http://bungeebones.com/feedback.php?BB_user=<?echo $user_id; ?>" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="http://www.bungeebones.com/index.php?option=com_content&view=article&id=5:bungeebones-terms-of-service&catid=25:the-project&Itemid=2" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
		</div>
<table id="member"><tr><td>
<h5>Buy Better Position Using Demo Credits</h5>
<p class='smallerFont' style="color:red;" >Your account should have come pre-loaded with "demo-coin" that you can use to get better placement ahead of all free and lower paying demo-coin users. Buying a position with demo-coin will move your link ahead of all free coins but they will be listed behind any paying with real Bitcoin. So those that participate in the demo will be rewarded with actual better placement than those that don't participate.</p>  


<IFRAME SRC="http://bungeebones.com/members/cryptoapi/Examples/example_basic.php?user_id=<?echo $user_id;?>" TITLE="The Famous Recipe">
<!-- Alternate content for non-supporting browsers -->
<H2>The Famous Recipe</H2>
<H3>Ingredients</H3>
...
</IFRAME>

<p><a href="https://app.coinsimple.com/dash/app/540/button/87/gen/d6bfe71a9be9a25b3454540">Pay with Bitcoin</a></p>
 </td></tr></table>


<?
include("../../960bottom.php");


} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}
