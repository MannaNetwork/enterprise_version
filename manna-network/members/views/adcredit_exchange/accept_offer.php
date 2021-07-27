<?

//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 


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



if(isset($_GET['link_selected'])){
$link_selected =$_GET['link_selected'];
}
elseif(isset($_POST['link_selected'])){
$link_selected =$_POST['link_selected'];
}
$type =$_GET['type'];
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `BB_user_ID` from `links` where `id` = '$link_selected'";
$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows >0){
$row = mysqli_fetch_array($result);
$BB_user_ID = $row['BB_user_ID'];
}

if($BB_user_ID != $user_id){
echo 'header(you are not authorized)';

echo '<br>$BB_user_ID = ', $BB_user_ID;

echo '<br>user id = ', $user_id;
exit();
}


include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `file_name`, `folder_name`, `end_clone_date` from `widgets` where `link_id` = ".$link_selected;

$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows >0){
$row = mysqli_fetch_array($result);
$folder_name = $row['folder_name'];
$file_name = $row['file_name'];
$end_clone_date = $row['end_clone_date'];
}


//if($end_clone_date > '0000-00-00 00:00:00' and $type != 'start_up'){
//echo 'That link is no longer eligible to host a web directory';

//}


include($_SERVER['DOCUMENT_ROOT']."/members/template_topy.php");
?>
<div style="text-align: center;">
		<a href="http://bungeebones.com/members/index.php?BB_user_id=<? echo $user_id; ?>" class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;
		<a href="http://bungeebones.com/members/overview.php?BB_user_id=<? echo $user_id; ?>" class="cssbutton sample a"><span>Overview</span></a>&nbsp;
		<a href="http://bungeebones.com/members/reg_form" class="cssbutton sample a"><span>Add Link</span></a>&nbsp;
		<a href="http://bungeebones.com/members/bitcoin.php?BB_user_id=<? echo $user_id; ?>" class="cssbutton sample a"><span>Add Funds</span></a>&nbsp;
	     <a href="http://bungeebones.com/members/update_user.php" class="cssbutton sample a"><span> Your Profile </span></a>&nbsp;<a href="http://bungeebones.com/feedback.php" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="http://www.bungeebones.com/index.php?option=com_content&view=article&id=5:bungeebones-terms-of-service&catid=25:the-project&Itemid=2" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="http://bungeebones.com/members/index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
		</div>
<div>&nbsp;</div>



<?
$msg="";
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 if (empty($_POST["num_credits_4sale"])) {
    $num_credits_4saleErr = "<font color='red'> <br>number of credits 4sale is required";
$ERR = 'true';
  } else {
    $num_credits_4sale = test_input($_POST["num_credits_4sale"]);
  }


if (empty($_POST["price_credits_4sale"])  and empty($_POST["market_order"])) {

    $price_credits_4saleErr = "<font color='red'> <br>Either Set A Price Or select Market Order";
$ERR = 'true';
  } else {
    $price_credits_4sale = test_input($_POST["price_credits_4sale"]);
  }

 if ($_POST["time_period_buyer"] == "Choose") {
    $time_period_buyerErr = "<font color='red'> <br>Setting a time limit for buyer deposit & response is required";
$ERR = 'true';
  } else {
    $time_period_buyer = test_input($_POST["time_period_buyer"]);
  }

if ($_POST["time_period_seller"] == "Choose") {
    $time_period_sellerErr = "<font color='red'> <br>Setting a time limit for your transfer of credits after the buyer's response is required";
$ERR = 'true';
  } else {
    $time_period_seller = test_input($_POST["time_period_seller"]);
  }


}

$msg .= "<p>pseudo code If the buyer has accepted the listing as is the the message is <p>The following BungeeBones user has accepted the following offer for your listed Advertising Credits. By you checking 'Accept' you authorize BungeeBones to \"Deep\" freeze the asset while the Buyer deposits echo $currency_symbol $price_credits_4sale $currencyName into your bank account, meaning that for $time_period_buyer you cannot cancel this offer, nor move, sell or use the assets. You must now provide your bank account number, which we will store and will forward to the buyer so that they can deposit the correct amount to that account. They will report back to BungeeBones and we will notify you via the email address you have listed in your BungeeBones.com user profile. You will have $time_period_seller after the time that the buyer reported back to either complete the transfer or report the buyer's report as false or the amounts listed above will be automatically and irreversably transferred to the buyer. If you transfer them yourself before the expiration then you will receive a positive transaction event and reputation points added to your seller rank. 

<p>if you report the transaction as a false buyer report you are, essentially submitting the transaction for BungeeBones arbitration. We will email the buyer and they will have 24 hours to send us copies of their deposit and also the name of the teller and branch contact information of where they made the deposit. The assets will continue to be deep frozen until the matter is resolved. Please review the BungeeBones Arbitration policy.



</td></tr></table>
<table style = \"margin-left:auto; 
    margin-right:auto;\" bgcolor=\"white\" width=\"75%\">
<form name=\"test\" action=\"". htmlentities($_SERVER['PHP_SELF'])."\" method=\"post\">
<input type=\"hidden\" name=\"link_selected\" value=\"".$link_selected."\">

<tr><td><h1>Advertising Credits For Sale By Owners</h1>";



$msg .="
<p>Pseudo code : Select all from listings where `status`= 'offered' || `status`= 'counteroffered'
<p> For each list the quantity, price and time limits as well as the seller's Ban Name. Also check check if offered or counteroffered and put something in the listing to indicate which.



</td></tr>
<tr><td>&nbsp;
</td></tr>
<tr><td>
";
$msg .="
 </td></tr>
<tr><td>&nbsp;
</td></tr>
<tr><td>



</form>
</td></tr></table>
";







echo $msg;
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';


include($_SERVER['DOCUMENT_ROOT']."/members/templatebottomnsb.php");


} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

