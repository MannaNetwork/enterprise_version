<?php
//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) baby_widget

if (isset($_GET['action']) && $_GET['action'] == "log_out") {
session_start();
session_destroy();
}
// include the configs
require_once($_SERVER['DOCUMENT_ROOT']."/members/config/config.php");

// load php-login components
require_once($_SERVER['DOCUMENT_ROOT']."/members/php-login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();
    
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...

$user_id = $_SESSION['user_id'];

//print_r($_POST);
	if (isset($_GET['link_selected'])){  //$link_selected is name comming from user control panel and is GET
	$baby_widget=$_GET['link_selected']; //changed it to $baby widget in the form and rest of this page except for above
	//echo '<br> in GET baby widget = ', $baby_widget;
}                                // its parent will be called parent widget and parent num is the parent widget's id in widgets
	elseif (isset($_POST['baby_widget'])){
	$folder_name = $_POST['folder_name'];
	$file_name= $_POST['file_name'];
	$baby_widget=htmlspecialchars($_POST['baby_widget']);
	}
$baby_widget = rtrim($baby_widget,"/");

$B1=$_POST['B1'];


if(isset($B1)){
// we need to verify that the wallet address they entered here matches what is in the db.
$withdrawal_amount=$_POST['withdrawal_amount'];
$bitcoin_wallet =$_POST['bitcoin_wallet'];
$confirmed=$_POST['confirmed'];

include($_SERVER['DOCUMENT_ROOT']."/classes/commissions_class.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$today = date("Y-m-d  H:i:s");//0000-00-00 00:00:00
$moniker="<h2>Withdraw Commission</h2>";
$body_width="wide";
include('../../960top.php');
		$sql="select * from `widgets`  WHERE `link_id` = ".$_POST['link_id'];

$result = @mysqli_query($connect, $sql);
while($row = mysqli_fetch_array($result)){
$widget_id = $row['id'];
$link_id = $row['link_id'];
$saved_hash = $row['bitcoin_wallet'];
}

$btcrest1 = substr($saved_hash, 0,  -50); 
$rest1 = substr($saved_hash, 8,  -42); 
$btcrest2 = substr($saved_hash, 16 , -33); 
$rest2 = substr($saved_hash, 25 , -25);
$btcrest3 = substr($saved_hash, 33 , -17);
$rest3 = substr($saved_hash, 41 , -9); // returns lastst 8 0f 24 char hash (includes user id)
$btcrest4 = substr($saved_hash, 49 ); // returns lastst 8 0f 24 char hash (includes user id)

echo '<br>btcrest1 = ',$btcrest1;
echo '<br>rest1 = ', $rest1;
echo '<br>btcrest2 = ',$btcrest2;
echo '<br>rest2 = ', $rest2;
echo '<br>btcrest3 = ',$btcrest3;
echo '<br>rest3 = ', $rest3;
echo '<br>btcrest4 = ',$btcrest4;
$check_userid_length = strlen($user_id);
$get_user_id_from_hash = substr($rest3, -$check_userid_length);    // returns "ef"
$bitcoin_walletdb = $btcrest1.$btcrest2.$btcrest3.$btcrest4;
if($get_user_id_from_hash == $user_id & $bitcoin_wallet == $bitcoin_walletdb){
$date_received = date("Y-m-d H:i:s");
$sql="Insert into `commission_pmt_requests`(`widget_id` ,`user_id` ,`amount_requested` ,`date_received`,`date_sent`,`link_id`,`bitcoin_address`) values ('$widget_id' ,'$user_id' ,'$withdrawal_amount' ,'$date_received','$date_sent','$link_id','$bitcoin_wallet')";
	
$result = @mysqli_query($connect, $sql);	
echo '<h1>Your Bitcoin Wallet Address Entry Was Successful. Your commissions will be sent to this Bitcoin Wallet Address - '.$bitcoin_wallet.' - within 24-48 hrs (excluding weekends).</h1>';
}
else
{
echo 'there has been a technical problem with your request. Please use the site\'s contact form to notify the site admin. Sorry for the inconvenience.';

}
		echo '<p><a target="_top" href="widget_index_custom.php?link_selected='.$baby_widget.'"> <h2><u>Return To Directory Management Index</u></h2></a>
		<a target="_top" href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';

		$message = "
		Name: BungeeBones Script Notice
		Link ID Number: $baby_widget;

		Message: There has been a Bitcoin withdrawal request made. Here is the sql

		";

		$message .= $sql;

		//END OF INCOMING MESSAGE (this message goes to your inbox)

		$subject = "Bitcoin withdrawal request from your BungeeBones.com - Message was sent by automatic notification
		-----------------------------
		From: $Name: $baby_widget
		E-mail: robert.r.lefebure@hushmail.com
	
		Message: $Message

		-----------------------------
		";
		//END OF outgoing MESSAGE

		//$nasaadresa = "info@BungeeBones.com";  //please replace this with your address
$email = "robert.r.lefebure@hushmail.com";
		mail($email,"$subject","$message","From: BungeeBones Script Notice ");



		echo "$thanks";

include('../../960bottom.php');
		//exit();
		
		
}
else
{

//retrieve current widget configurations
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

//get the widget id (which will become this new widgets parent num) from widget table
$sql="select  * from `widgets` where `link_id` = '".$_GET['link_selected']."'";
/*
Full texts 	id 	link_id 	is_parked 	is_registered 	parent 	lft 	rgt 	
time_period 	version 	start_clone_date 	last_update 	end_clone_date 	is_recip 	
is_niche 	wp_permalink_name 	folder_name 	file_name 	brand 	display_freebies 	
plugin 	custom_title1 	custom_title2 	meta_descrip 	keywords 	name 	click_tally 	
donate 	leaving_page 	cust_add_a_link 	cust_add_a_link_mo 	cust_add_a_link_ret 	
fontsize 	titlecolor 	linktextcolor 	catcolo*/
$result = @mysqli_query($connect, $sql);
	while($row = mysqli_fetch_array($result)){
	$bitcoin_wallet	= $row['bitcoin_wallet'];
	}	
$moniker="<h2>Withdraw Commission</h2>";
$body_width="wide";
include('../../960top.php');
?>

<table id="member" style = "margin-left:auto; 
    margin-right:auto;" bgcolor="gray" width="80%"><TR><TD colspan="2">
<h1 style="text-align: center;">BungeeBones Commission Withdrawal Form <br>(please allow 24-48 hours for processing)</h1>

<FORM action="<? echo $_SERVER['PHP_SELF'];?>" method="POST" target="_self">
<p class="smallerFont" ><input type="hidden" name="link_id" value="<?echo $baby_widget; ?>" />

<?

	echo' </td></tr><tr><td colspan="2"><p class="smallerFont" >
	<br><b> Enter Your Bitcoin Address Here </b><input  type="text" size="25"   value=""  name="bitcoin_wallet" id="bitcoin_wallet" ></td></tr><tr><td colspan="2">
	
	<p class="smallerFont" ><br><b> Enter The amount of  Bitcoin you wish to withdraw. Note: you cannot withdraw amounts that have been allocated to selling advertising credits (AKA AdCoin). If you wish to withdraw those sums it is neccessary to first go to your User Control Panel and cancel those ads. By doing so the amounts you are offering for sale will be unfrozen and returned to your account balance.</b>
	<p class="smallerFont" ><b>Enter amount (in Bitcoin) you wish to withdraw. 
	<input type="text" name="withdrawal_amount"    size="25" id="withdrawal_amount" value="">

	<p class="smallerFont" ><b> Enter Your Bitcoin Wallet Address Here (again)	</b><input type="text" name="bitcoin_wallet2"    size="25" id="bitcoin_wallet2" value="">
<p align="center"><table width="60%" border="2" bordercolor="red"><tr><td><h3 style="color:red;">WARNING! BungeeBones cannot undo, reverse or correct payments sent to a wrong address and assumes NO responsibility for commissions lost due to wrong information entered here. </h3>
<p class="smallerFont" ><h3 style="color:purple;">By clicking this checkbox you acknowledge that you have entered your proper Bitcoin address, have double-checked it\'s accuracy and that you hold BungeeBones harmless for any funds sent to a wrong address as a result of you entering wrong information</h3>
<input type ="checkbox" name="confirmed"></td></tr></table>

<H2>Stop! The wallet address you entered will be checked against the address we have in our database for security purposes. If the wallet address you enter in the withdrawal form doesn\'t match our records then no funds will be sent and your account will be frozen pending administrator review. You can check and/or edit these settings at any time, however, from the user control panel, so - if in doubt and you wish to avoid delay in receiving your Bitcoins then check your settings for accuracy. 	
	
<br><br><INPUT type="submit" name="B1" value="Submit">


</TD></TR><tr><TD></TD><td></td></tr></table>

';

include('../../960bottom.php');
}
} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
