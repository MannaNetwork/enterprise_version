<?
$phpself = basename(__FILE__);
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],$phpself)) . $phpself;
require_once("config/config.php");
require_once("php-login.php");
$login = new Login();

if ($login->isUserLoggedIn() == true) {    
$user_id = $_SESSION['user_id'];


include($_SERVER['DOCUMENT_ROOT']."/classes/price_slot_class.php");//load order 3
$priceslotinfo = new price_slot_info();

$real_ad_coin = $priceslotinfo->getBuyersBalance($user_id);

$real_ad_coin = round($real_ad_coin, 8, PHP_ROUND_HALF_UP);
?>

<div id="smallerFont">
<p class="smallerFont" >

<?
$msg="";
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if (isset($_POST["C1"])) {

header('Location: success.php'); 


$priceslotinfo->credit_bitcoin($_POST['buyer_user_id'],"" ,"" , $_POST['transfer_amount'],"" , "mem_trans");

$priceslotinfo->debit_bitcoin($user_id,"" ,"" , $_POST['transfer_amount'],"" , "mem_trans");

exit();

}
elseif (isset($_POST["B1"])) {
 if (empty($_POST["transfer_amount"])) {
    $transfer_amountErr = "<font color='red'> <br>number of transfer amount is required";
$ERR = 'true';
  } else {
    $transfer_amount = test_input($_POST["transfer_amount"]);
  }


if (empty($_POST["buyer_user_id"]) ) {

    $buyer_user_id = "<font color='red'> <br>A buyer user id is required";
$ERR = 'true';
  } else {
    $buyer_user_id = test_input($_POST["buyer_user_id"]);
  }

if(!isset($ERR)){

//need to add a confirmation form here.
//name it B1
//up above all the error controls put an if isset B! and move the actual submit and report in this section there
$moniker="<h5>Demo Credit Transfer</h5>";
$body_width="wide";
include('../960top.php');
include('user_cpanel_submenu.php');
include('exchange_buyer_submenu.php');
echo '<h2> The transfer amount is ', $transfer_amount;
echo '</h2>';
echo '<h2> The buyer\'s user id is ', $buyer_user_id; 
echo '</h2>';
$msg="
<table id=\"member\" ><tr><td>
<form name=\"test\" action=\"". htmlentities($_SERVER['PHP_SELF'])."\" method=\"post\">

<input type='hidden' name='buyer_user_id' value='".$buyer_user_id."'>
<input type='hidden' name='transfer_amount' value='".$transfer_amount."'>
<h2>If the information is correct submit or use the browser's 'Back' button.</h2>

<tr><td align=\"center\"><input type=\"submit\" name=\"C1\" value=\"Submit Form\"><br></td></tr>
</form>
</table>";
echo $msg;
include("../960bottom.php");
exit();

}
}
$moniker="<h5>Demo Credit Transfer</h5>";
$body_width="wide";
include('../960top.php');
include('user_cpanel_submenu.php');
include('exchange_buyer_submenu.php');
$msg .= "<table id=\"member\" ><tr><td>
<h2>The Process</h2>
<h3>Simply enter the amount of Bitcoin backed ad credits you wish to transfer and the user ID of the user you wish to transfer them to</h3>
<h3>You have ";
$msg .=  $real_ad_coin;
$msg .= "<b><u> Bitcoin backed Ad COIN/Advertising Credits</u></b> available to transfer. (Note either you or the user may request more free demo coin from the admin via the contact form)</h3>
<form name=\"test\" action=\"". htmlentities($_SERVER['PHP_SELF'])."\" method=\"post\">
<tr><td><h3>Enter the USER ID of the BungeeBones User you wish to transfer the ad coins to - </h3>
<input type='text' name='buyer_user_id'  size='5'> </td></tr>
<tr><td><h3>Enter the amount of Ad coin/advertising credits(redeemable for Bitcoin) you want to transfer</h3>
<input type='text' name='transfer_amount' size='5'></td></tr>
<tr><td align=\"center\"><input type=\"submit\" name=\"B1\" value=\"Submit Form\"><br></td></tr>";
$msg .="
</form>
</table>
";

echo $msg;
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Main Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a></div>';


include("../960bottom.php");


} else {
    // the user is not logged in...
    include("views/not_logged_in.php");
}

