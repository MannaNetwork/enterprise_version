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
//The message var acts as a switch when sent to the functions calling them to make the transaction instead of reporting it. It then have all the functions on this page make a $message var instead of echos and then forward it in the header url for printing on the success page as a record
$today = date('F j, Y, g:i a');
$message = "<h2>BungeeBones Cancellation Record</h2>
<p>Date: $today"; 
$message="";
$text_email = "BungeeBones Cancellation Record
";
if($link_type=="paid"){
$today = date("d");
$month = date("m");
$year = date("Y");
$get_info = new price_slot_info;
$Last_day_of_month = $get_info->lastday($month, $year);
$numdays_in_month = substr($Last_day_of_month, -2, 2); 
$numdays_remaining_in_month = $numdays_in_month-$today + 1;//note- this was done on 

$price_slot_info = new price_slot_info;

$LINKinfo = new link_info;


$upline_num = $price_slot_info->getUplineNum($user_id);
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
$message_array = $price_slot_info->markPriceSlotsCancel($user_id, $link_id,  $cat_id, $bid_info[2], 0);//1st give them pro-rated credit
$text_email .= $message_array[1];
$price_slot_info->updatePriceSlotsActive($user_id, $link_id, $cat_id, $bid_info[2], 0);//then deactivate the subscription
$price_slot_info->markFreebies($link_id, "", 0, 0);//last mark as freebie again in links table

}
else//link type is free
{
$text_email .=  '<p align="left"Sorry to see you are de-activating your link! While it will no longer be displayed in the BungeeBones system the widget you had installed on it can still remain active and still earn you commissions. If the widget was de-activated also then you have active, rwegistered users that registered under this link and widget so you will need these deactivated links in your control panel to access any potential earnings records from their purchases (yes you keep earning on their purchases even without a widget displayed)</p>
';
}
$sql="UPDATE `links` set `approved` = 'deactivated_by_user', `freebie` = 0 where `id`= $link_id";
$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11b Account'queryb");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2accusersconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `user_email` from `users` where `user_id` = $user_id";

$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11b Account' queryb");
//$to	= "$row['email']";
$to = "robert.r.lefebvre@gmail.com";
$subject = "BungeeBones Transaction";
$from = "info@BungeeBones.com";
$headers = "From: $from";
mail($to,$subject,$text_email,$headers);
//echo "Mail Sent.";
header( "Location: http://bungeebones.com/members/success.php" ) ;
 
}


$B1=$_GET['B1'];
//////////////////////////////////////////
IF(isset ($B1)){
$price_slot_info = new price_slot_info;

$moniker="<h5>Deactivate Your Link</h5>";
$body_width="wide";

include('../960top.php');

echo '<p style="text-align: left;"><FORM style="width: 90%" action="'.$_SERVER['PHP_SELF'].'" method="GET">';
echo '<input type= "hidden" name="link_id" value="'.$link_id.'"/>';
echo '<input type= "hidden" name="cat_id" value="'.$cat_id.'"/>';
echo '<input type= "hidden" name="link_type" value="'.$link_type.'"/>';
//need to query the database  to get the list price of the slot
if($link_type=="paid"){
echo '<h1>Please review the transaction details for your link below.</h1> <p style="color: red;">Important to note; all deactivations are pro-rated to the first of the month and refunds are based on the remaining days in the month. </p>';

echo '<p style="text-align: left;">The prorating calculations will be done for any remaining time and your account will be credited for any unused portion of the fee you already paid.';

echo '<p style="text-align: left;">Review the charges and submit the form if correct. See the "Purchasing Help" button at the tops of both free and page sections of your User Control Panel<p style="text-align: left;">';
echo $message;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$sql = "SELECT `id`, `price_slot_amnt` from `price_slots_subscripts` where `link_id`='$link_id' AND `cat_id` ='$cat_id' AND  user_id='$user_id' AND `subscribe` = '1'";

$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 11d1 Account' query");
 while($row = mysqli_fetch_array($result)){
$price_slot_trans_ID = $row['id'];
$price_slot_amnt = $row['price_slot_amnt'];
}

$approval_req_msg = $price_slot_info->B1markPriceSlotsCancel($user_id, $link_id,  $cat_id, $price_slot_amnt, 0);//1st give them pro-rated credit
$message .= $approval_req_msg[0];
$text_email .= $approval_req_msg[1];
echo $message;
}
else
{
echo'<h1 align= "left">Sorry to see you are de-activating your link! Submitting this form will deactivate your listing in BungeeBones and all distributed web directory locations. It will still appear (with a red button) which you can use to resubmit the link for reactivation again if you so choose.';
//put some queires in here to see if it has a widget installed or has regd users
echo'<p align="left" While it will no longer be displayed in the BungeeBones system the widget you had installed on it can still remain active and still earn you commissions. If the widget was de-activated also then you have active, registered users that registered under this link and widget so you will need these deactivated links in your control panel to access any potential earnings records from their purchases (yes you keep earning on their purchases even without a widget displayed)</p>
';

}
echo'<INPUT type="submit" name="C1" value="Accept">';
echo '<br><a href="/members/index.php">RETURN To Control Panel</a>';



include('../960bottom.php');

}
else// begin form
{

$moniker="<h5>Deactivate Your Link</h5>";
$body_width="wide";

include('../960top.php');

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
 //make sure the mdifier of the link is the owner of the link
$sql = "SELECT * FROM `links` WHERE id ='$link_id'";
 	$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 3 Account' 	query");
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

$sql = "SELECT * FROM `widgets` WHERE link_id ='$link_id'";
 	$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 4 line 205 reg_form_deactivate.php' 	query");
     do
     {
	$start_clone_date = $row['start_clone_date']; 
$end_clone_date = $row['end_clone_date']; 
	 }while ($row = mysqli_fetch_array($result));
	$row_cnt = mysqli_num_rows($result);

    if($row_cnt > 0){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2accusersconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
 //make sure the mdifier of the link is the owner of the link
$sql = "SELECT *FROM `users`WHERE `wdgts_lnk_num` ='$link_id'";
 	$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 5 line 220' 	query");
     do
     {
	$link = $row['wdgt_link_num']; 
	 }while ($row = mysqli_fetch_array($result));
$row_cnt2 = mysqli_num_rows($result);



  
    }
 ?>
<table style="margin:auto;border:solid; background-color: red; width:100%" >
   <tr ><td>
	
<form style="width: 90%" action="<?= $_SERVER['PHP_SELF']?>" method="GET" >
<input type="hidden" name="link_id" value="<?echo $link_id;?>">
<input type="hidden" name="cat_id" value="<?echo $cat_id ;?>">
<input type="hidden" name="link_type" value="<?echo $link_type ;?>">
<table style="margin:auto;border:solid; width:800px">
                <tr><td colspan="2" style="padding: 15px;background-color:#F7EFEF;>
  <h2 align="center">BungeeBones Link De-Activation Form</h2>
 
  
      <h2>DE-Activate Your Link Information?</h2>
   <?  if($row_cnt2 > 0){
   ?>
     <p style ="font-weight: bold; text-align:left;">You have had <? echo $row_cnt2; ?> users register from your web directory. You will continue to be eligible to receive commissions on any sales they make even though your own website is de-activated. Be sure to continue to receive email from BungeeBones.com to stay informed of their performance!
<p style ="font-weight: bold; text-align:left;">The "Web Directory Admin" button will remain active for the listing so you can view reports, request commission payments, etc.</p>

<?
}
?>
        <p style ="color:red; font-weight: bold; text-align:left;">If you submit this form your link will be de-activated and will not be displayed on BungeeBones.com or any of the other distributed web directories.
<p align="left">NOTE: It will still continue to appear on your user control panel, however, and you can re-activate it from there at any time.</p>	<h1 align="center">ARE YOU SURE?</h1><h3 align="center"><a href="/members/index.php">Return To Your User Control Panel</a></h3>
</td>
      </tr>
	 
     <tr>
      <td width="14%" align="right"><b><font size="2">Homepage URL</font></b></td>
      <td ><b><font size="2">
            <input disabled TYPE="text" name="url" value="<?echo $url;?>" size="30"></font></b></td>
	</tr>
    <tr>
      <td width="14%" align="right"><font size="2"><b>TITLE </b></font></td>
      <td><b><font size="2">
  <input disabled type="text" name="title" value="<?echo $name;?>" size="30"></font></b></td>
	</tr>
	<tr>
      <td width="14%" align="left"><font size="2"><b>DESCRIPTION </b></font></td>
      <td>
        <textarea disabled rows="4" name="description" cols="30"><?echo $description;?></textarea></font></b></td>
             </tr>

<tr><td colspan="2">
<p align="center">
<input type="submit" value="DE-ACTIVATE?" name="B1"><input type="reset" value="Cancel" name="B2"></p>
</td>
		</tr>
      </table>
	
</form>
	
	</td>
		</tr>
     </table>

<h3 align="center"><a href="/members/index.php">Return To Your User Control Panel</a></h3>

<?

include('../960bottom.php');

}//closes main else


       
} else {
    // the user is not logged in...

    include("views/not_logged_in.php");
}

?>	
