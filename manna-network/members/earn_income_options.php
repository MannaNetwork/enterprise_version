<?php
$user_id = $_SESSION['user_id'];
	if (isset($_GET['link_selected'])){  //$link_selected is name comming from user control panel and is GET
	$link_id=$_GET['link_selected']; //changed it to $baby widget in the form and rest of this page except for above
	//echo '<br> in GET baby widget = ', $baby_widget;
}                                // its parent will be called parent widget and parent num is the parent widget's id in widgets
	elseif (isset($_POST['link_id'])){
	
	$link_id=htmlspecialchars($_POST['link_id']);
	}
$link_id = rtrim($link_id,"/");

$B1=$_POST['B1'];

if(isset($B1)){
include($_SERVER['DOCUMENT_ROOT']."/classes/commissions_class.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/config.php");
//include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connect.php");
//new db connection
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$bitcoin_wallet = $_POST['bitcoin_wallet'];
$check_address_length = strlen($bitcoin_wallet);
if($check_address_length !== 34){
echo '<h1 style = "color:red;">Error: Your address does not conform to Bitcoin standards</h1>';
}
$today = date("Y-m-d  H:i:s");//0000-00-00 00:00:00
$length ="";
$ulength = "";
$ulength=strlen($user_id);
$length = 24 - $ulength;//24 is how long I decide to make the user id hash (divisible into 3 - 8 item parts


function rand_string_from_user($length) {
    $string = '';
       for($i = 0; $i < $length; $i++) {
        $rand = mt_rand(97,132);
        if($rand <= 122) {
            $string .= chr($rand);
        } else {
            $string .= (string)($rand-122);
        }
    }
$string = str_split($string, $length);
    return($string);
}


$user_begin_hash = rand_string_from_user($length);
$check_address_length2 = strlen($user_begin_hash);


$user_whole_hash = $user_begin_hash[0] . $user_id;
$rest = substr($user_whole_hash, -($ulength) , $length); // returns user id
$rest1 = substr($user_whole_hash, 0,  -16); // returns first 8 0f 24 char hash
$rest2 = substr($user_whole_hash, 8 , 8); // returns mid 8 0f 24 char hash
$rest3 = substr($user_whole_hash, 16 , 9); // returns lastst 8 0f 24 char hash (includes user id)

$user_from_rest3 = substr($rest3, -$ulength); // returns user id

//now split $bitcoin_wallet address; into four parts

$btcrest1 = substr($bitcoin_wallet, 0,  -26); // returns first 8 0f 24 char hash
$btcrest2 = substr($bitcoin_wallet, 8 , 9); // returns mid 8 0f 24 char hash
$btcrest3 = substr($bitcoin_wallet, 17 , 8); // returns lastst 8 0f 24 char hash (includes user id)
$btcrest4 = substr($bitcoin_wallet, 25 , 9); // returns lastst 8 0f 24 char hash (includes user id)

//adding the new split hash of user's wallet together with the salt of the user id
//first btcrest1+rest1+btcrest2+rest2+btcrest3+rest3+btcrest4

$to_save_hash = $btcrest1.$rest1.$btcrest2.$rest2.$btcrest3.$rest3.$btcrest4;

$btcrest1 = substr($to_save_hash, 0,  -50); 
$rest1 = substr($to_save_hash, 8,  -42); 
$btcrest2 = substr($to_save_hash, 16 , -33); 
$rest2 = substr($to_save_hash, 25 , -25);
$btcrest3 = substr($to_save_hash, 33 , -17);
$rest3 = substr($to_save_hash, 41 , -9); // returns lastst 8 0f 24 char hash (includes user id)
$btcrest4 = substr($to_save_hash, 49 ); // returns lastst 8 0f 24 char hash (includes user id)

/*
echo '<br>btcrest1 = ',$btcrest1;
echo '<br>rest1 = ', $rest1;
echo '<br>btcrest2 = ',$btcrest2;
echo '<br>rest2 = ', $rest2;
echo '<br>btcrest3 = ',$btcrest3;
echo '<br>rest3 = ', $rest3;
echo '<br>btcrest4 = ',$btcrest4;

The user id is contained in rest3
*/

$moniker="<h5>Add A Link</h5>";
$body_width="wide";
include('../960top.php');
		$sql="UPDATE `widgets` SET `bitcoin_wallet`= '".$to_save_hash."' WHERE `link_id` = ".$link_id;
	
$result = @mysqli_query( $connect, $sql);




		echo '<h1>Your Bitcoin Wallet Address Entry Was Successful. Your commissions will be sent to this Bitcoin Wallet Address - '.$_POST['bitcoin_wallet'].'
 - when you <a href="widget_comm_withdraw.php?link_selected='.$link_submitted.'">submit a commissions withdrawal request</a>.</h1>
';

		echo '<p>
		<a target="_top" href="widget_index_custom.php?link_selected='.$baby_widget.'"> <h2><u>Return To Directory Management Index</u></h2></a>
		<a target="_top" href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';

		$message = "
		Name: BungeeBones Script Notice
		Link ID Number: $baby_widget;

		Message: There has been a edit performed on the previous registration of a widget. Here is the sql

		";

		$message .= $sql;

		//END OF INCOMING MESSAGE (this message goes to your inbox)

		$subject = "Message from your BungeeBones.com - Message was sent by automatic notification by script //subject OF YOUR //INBOX MESSAGE sent to you

		-----------------------------
		From: $Name:baby_widget
		E-mail: $Email
	
		Message: $Message

		-----------------------------
		";
		//END OF outgoing MESSAGE

		$nasaadresa = "info@BungeeBones.com";  //please replace this with your address

		mail($nasaadresa,"$subject","$message","From: BungeeBones Script Notice ");



		echo "$thanks";


include('../960bottom.php');
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

$moniker="<h5>Add A Link</h5>";
$body_width="wide";
include('../960top.php');
?>

<table id="member" style = "margin-left:auto; 
    margin-right:auto;" bgcolor="gray" width="80%"><TR><TD colspan="2">
<h1 style="text-align: center;">Website Monetization Options</h1>

<p class="smallerFont" >We have three different monetization programs to fit your needs.
</td></tr>
<tr><td colspan="2" width="100%"><h2>1) For Those That Need A Website</h2><p class="smallerFont" >Enter Multisite info here
<p class="smallerFont" >Enter free hostinhg info here</p>

</td></tr>

<tr><td colspan="2" width="100%"><h2>2) For Those That Have A Wordpress Website</h2><p class="smallerFont" >Enter plugin info here

</td></tr>

<tr><td colspan="2" width="100%"><h2>3) For Those With A Custom Coded Website</h2><p class="smallerFont" >Enter PHP Block version info here

</td></tr>


<tr><td width="100%">



<FORM action="<? echo $_SERVER['PHP_SELF'];?>" method="POST" target="_self">
<input type="hidden" name="link_id" value="<?echo $link_id; ?>" />
</td></tr>
<tr><td>
<?

	echo'<p class="smallerFont" >
	 Enter the Bitcoin Address to send your commission to Here </b><input  type="text" size="25"   value="'.$bitcoin_wallet.'"  name="bitcoin_wallet" id="bitcoin_wallet" >
	
	

</td><td><p class="smallerFont" ><b> Enter Your Bitcoin Address Here (again)	</b><input type="text" name="bitcoin_wallet2"    size="25" id="bitcoin_wallet2" value="'.$bitcoin_wallet.'">
</td></tr>
<TR><TD colspan="2">

<p class="smallerFont" >
WARNING! BungeeBones cannot undo, reverse or correct payments sent to a wrong address and assumes NO responsibility for commissions lost due to wrong information entered here. 

<p class="smallerFont" >
By clicking this checkbox you acknowledge that you have entered your proper Bitcoin address, have double-checked it\'s accuracy and that you hold BungeeBones harmless for any funds sent to a wrong address as a result of you entering wrong information

<input type ="checkbox" name="confirmed">

<p class="smallerFont" >Stop! You will be asked for the wallet address again whenever you request a withdrawal. If the wallet address you enter in the withdrawal form doesn\'t match what you entered here then no funds will be sent. You can edit these settings at any time, however. 	
	
<br><br><INPUT type="submit" name="B1" value="Submit">

</td></tr></table>

';

include('../960bottom.php');
}

