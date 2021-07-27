<?
// include the configs
require_once("config/config.php");

    
// load the login class

// load php-login components
require_once("php-login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

 
    
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...


$user_id = $_SESSION['user_id'];


include($_SERVER['DOCUMENT_ROOT']."/classes/price_slot_class.php");
include($_SERVER['DOCUMENT_ROOT']."/classes/link_class.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");


//link_exchange/admin/login.php?logout=1
$link_id = $_GET['link_id'];
$link_id = mysqli_real_escape_string($connect, $link_id);


$sql="select `BB_user_ID` from `links` where `id` = '$link_id'";
$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows >0){
$row = mysqli_fetch_array($result);
$BB_user_ID = $row['BB_user_ID'];
}

if($BB_user_ID != $user_id){
echo 'header(you are not authorized)';
exit();
}
$cat_id = $_GET['cat_id'];
$cat_id = mysqli_real_escape_string($connect, $cat_id);
$link_type = $_GET['link_type'];
$link_type = mysqli_real_escape_string($connect, $link_type);

if(isset($_GET['C1'])){
//this whole section seems to erroneously assume all the cancels are paid links
//it needs a condition that if GET link_type=free then don't do any price slot stuff
//The message var acts as a switch when sent to the functions calling them to make the transaction instead of reporting it. It then have all the functions on this page make a $message var instead of echos and then forward it in the header url for printing on the success page as a record
$today = date('F j, Y, g:i a');
$messaget = "<h2>BungeeBones Transaction Record</h2>
<p>Date: $today"; 
$message="";
$text_email = "BungeeBones Transaction Record";
$today = date("d");
$month = date("m");
$year = date("Y");
$get_info = new price_slot_info;
$Last_day_of_month = $get_info->lastday($month, $year);
$numdays_in_month = substr($Last_day_of_month, -2, 2); 
$numdays_remaining_in_month = $numdays_in_month-$today + 1;//note- this was done on 

$price_slot_info = new price_slot_info;

$LINKinfo = new link_info;

$price_slot_info = new price_slot_info;
$WdgtsLnkInfoArray = $price_slot_info->getWdgtsLnkNum($user_id);
//array($wdgts_ID,$wdgts_lnk_num);
$wdgts_lnk_num = $WdgtsLnkInfoArray[1];
$wdgts_ID = $WdgtsLnkInfoArray[0];
if($link_type != "free"){
$text_email .=  "
Thank you for your purchase! 
The transaction details for each of your purchased 
links is below. The payment you made was prorated to reflect 
the remaining days in the month with regular billing occurring 
on the first of the month.
";
$text_email = "
There are $numdays_remaining_in_month days remaining in the month
---------------------------------------------------------------
";
$message .=  '<h1>The transaction details for each of your purchased links is below. The refund you received was prorated to reflect the remaining days in the month.</h1>';
$bid_info = $price_slot_info->getThisUsersLastBoughtPriceSlot($cat_id, $link_id);
print_r($bid_info);
//$bid_info = array($id, $user_id, $price_slot_amnt);

$message_array = $price_slot_info->markPriceSlotsCancel($user_id, $link_id,  $cat_id, $bid_info[2], 0, 'BTC');//1st give them pro-rated credit
// markPriceSlotsCancel($user_id, $link_id, $cat_id, $purchased_slot_amount,$subscribe, $currency)
$text_email .= $message_array[1];

$price_slot_info->updatePriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $link_id, $cat_id, $bid_info[2], 0);
//updatePriceSlotsActive($user_id, $wdgts_lnk_num, $wdgts_ID, $link_id, $cat_id, $purchased_slot_amount, $subscribe)
}
$sql="Delete from `links` where `id`= $link_id";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11b Account'queryb");


include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2accusersconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$sql="select `user_email` from `users` where `user_id` = $user_id";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 112 Account' 112");
//$to	= "$row['email']";
$to = "robert.r.lefebvre@gmail.com";
$message2 = $text_email;
$subject = "BungeeBones Transaction";
$from = "info@BungeeBones.com";
$headers = "From: $from";
mail($to,$subject,$message2,$headers);
//echo "Mail Sent.";
header( "Location: http://bungeebones.com/members/success.php" ) ;
 // header( "Location: http://bungeebones.com/bungee_jumpers/success.php" ) ;
exit();
}


$B1=$_GET['B1'];
//////////////////////////////////////////
IF(isset ($B1)){

$moniker="<h5>Delete Your Link</h5>";
$body_width="wide";

include('../960top.php');

$today = date('F j, Y, g:i a');
$message = "<h2>BungeeBones Cancellation Record</h2>
<p>Date: $today"; 
$message="";
$text_email = "BungeeBones Cancellation Record
";
if($link_type=="paid"){
echo '<h1>Please review the transaction details for your link below.</h1> <p style="color: red;">Important to note; all cancellations are pro-rated to the first of the month. Refunds are based on the remaining days in the month. </p>';
echo '<p style="text-align: left;">The prorating calculations will be done for any remaining time and your account will be credited for any unused portion of the fee you already paid.';
echo '<p style="text-align: left;">Review the refund amount and submit the form if correct. See the "Purchasing Help" button at the tops of both free and page sections of your User Control Panel<p style="text-align: left;">';
$today = date("d");
$month = date("m");
$year = date("Y");
$get_info = new price_slot_info;
$Last_day_of_month = $get_info->lastday($month, $year);
$numdays_in_month = substr($Last_day_of_month, -2, 2); 
$numdays_remaining_in_month = $numdays_in_month-$today + 1;//note- this was done on 

$price_slot_info = new price_slot_info;

$LINKinfo = new link_info;


$WdgtsLnkNum = $price_slot_info->WdgtsLnkNum($user_id);
$text_email .=  "
Sorry to see you go!
The transaction details for canceled 
link is below. The refund was prorated to reflect 
the remaining days in the month with regular billing occurring 
on the first of the month and has been credited to your account.
";
$text_email = "
There are $numdays_remaining_in_month days remaining in the month
---------------------------------------------------------------
";
$message .=  '<h1>The transaction details for your canceled link is below. The refund you received was prorated to reflect the remaining days in the month.</h1>';
$bid_info = $price_slot_info->getThisUsersLastBoughtPriceSlot($cat_id, $link_id);
//$bid_info = array($id, $user_id, $price_slot_amnt);

$message_array = $price_slot_info->B1markPriceSlotsCancel($user_id, $link_id,  $cat_id, $bid_info[2], 0);//1st give them pro-rated credit
$message .= $message_array[0];
$text_email .= $message_array[1];
//$price_slot_info->B1updatePriceSlotsActive($user_id, $link_id, $cat_id, $bid_info[2], 0);//then deactivate the subscription

//$price_slot_info->markFreebies($link_id, "", 0, 0);//last mark as freebie again in links table

}
else
{
echo '<h1>You are about to permanently remove your link from the BungeeBones system. It will not be displayed on BungeeBones.com or on any of the affiliate Distributed Web directory installations.';


}
echo '<p style="text-align: left;"><FORM name="F3" action="'.$_SERVER['PHP_SELF'].'" method="GET">';
echo '<input type= "hidden" name="link_id" value="'.$link_id.'"/>';
echo '<input type= "hidden" name="cat_id" value="'.$cat_id.'"/>';
echo '<input type= "hidden" name="link_type" value="'.$link_type.'"/>';
 echo $forward_post;
echo $message;
echo'<INPUT type="submit" name="C1" value="Accept">';
echo '<br><a href="/members/index.php">Go To Control Panel</a>';


include('../960bottom.php');
}
else// begin form
{
$moniker="<h5>Delete Your Listing</h5>";
$body_width="wide";

include('../960top.php');
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

 //make sure the mdifier of the link is the owner of the link
$sql = "SELECT * FROM `links` WHERE id ='$link_id'";
//echo $sql;
 	$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 189 Account' 	query");
     do
     {
	$BB_user_ID = $row['BB_user_ID']; 
$name = $row['name']; 
$description = $row['description']; 
$url = $row['url']; 
	 }while ($row = mysqli_fetch_array($result));
	if($BB_user_ID!==$user_id)
	{
	echo 'Server error - your process was halted. Please contact the administrator for assisatance.';
	exit();
	}	
$cat_id = $_GET['cat_id'];
$BB_user_ID = mysqli_real_escape_string($connect, $BB_user_ID);
$cat_id= mysqli_real_escape_string($connect, $cat_id);
$BB_user_ID = htmlentities($BB_user_ID);
$cat_id = htmlentities($cat_id);
 ?>
  <table id="member" width="900px">
   <tr ><td>
<form style="width:90%;" action="<?= $_SERVER['PHP_SELF']?>" method="get" >
<input type="hidden" name="link_id" value="<?echo $link_id;?>">
<input type="hidden" name="cat_id" value="<?echo $cat_id ;?>">
<input type="hidden" name="link_type" value="<?echo $link_type ;?>">
  <h2 align="center">BungeeBones Link Delete Form</h2>
 
    <table id="member" width="880px" >
   <tr border="0">
        <td align="center" bgcolor="#F7EFEF">
      <h2>DELETE Your Link Information?</h2>
        <p align="left">If you submit this form your link will be permanently removed and will not be displayed on BungeeBones.com or any of the other distributed web directories.
<p align="left">It will no longer appear on your user control panel but you can add it again from there at any time as a new link.</p>	<h1 align="center">ARE YOU SURE?
<?
if($_GET['link_type']!='free'){?>
<p align="left"><font color="red">Or did you merely intend to cancel it as a paid link? To do that, select the YELLOW button labeled "Modify Or Cancel Your Paid Position" and then select the radio button for the same amount that you purchased it for (it tells you that - in red - just above the radio buttons). </font></p></h1>
<?
}
?>
</span></td>
      </tr>
	  <tr>
 
    <table id="member" width="860px">
     <tr>
      <td width="14%" align="right"><b><font size="2">Homepage URL</font></b></td>
      <td ><b><font size="2">
            <input disabled TYPE="text" name="url" value="<?echo $url;?>" size="46"></font></b></td>
	</tr>
    <tr>
      <td width="14%" align="right"><font size="2"><b>TITLE </b></font></td>
      <td><b><font size="2">
  <input disabled type="text" name="title" value="<?echo $name;?>" size="46"></font></b></td>
	</tr>
	<tr>
      <td width="14%" align="left"><font size="2"><b>DESCRIPTION </b></font></td>
      <td>
        <textarea disabled rows="4" name="description" cols="40"><?echo $description;?></textarea></font></b></td>
</td></tr><tr><td colspan="2">
<p align="center">
<input type="submit" value="DELETE- ARE YOU SURE?" name="B1"><input type="reset" value="Cancel" name="B2"></p>
	</p>
		</td>
		</tr>
		</table>
    </table>
  
</form>
				<h3 align="center"><a href="/members/index.php">Return To Your User Control Panel</a></h3>
    
</TD></TR>
</TABLE>
<?
 



include('../960bottom.php');


}//closes main else

       
} else {
    // the user is not logged in...

    include("views/not_logged_in.php");
}

?>	
