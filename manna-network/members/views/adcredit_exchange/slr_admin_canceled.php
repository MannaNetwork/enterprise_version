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
$listing_id=$_GET['listing_id'];

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

if(isset($_POST['A1'])){
echo '<h1>The Listing Has Been Removed</h1>';

include('../../classes/ad_credit_exchange_class.php');
$adCreditExchange = new adCreditExchange;
$listing_id = $_POST['listing_id'];

 $adCreditExchange->delete_listing($user_id, $listing_id);
}
else
{


$msg="";

include('../../classes/ad_credit_exchange_class.php');
$adCreditExchange = new adCreditExchange;

$test_array = array(
'list of statuses',
'withdrawn',
'arbitration',
'executed',
'expired',
'accepted',
'cntroffered',
'offered');


$status = 'offered';
/*if($scope == "users_listings"){
$ad_list = $adCreditExchange->viewbyseller($user_id, $status);
}
else
{*/
$ad_list = $adCreditExchange->viewbyseller("$user_id", $status);
//}
if(count($ad_list)==0)
{
echo '<br>&nbsp;<br><br>&nbsp;<br><h1>Sorry! There were no results found.</h1>';
}
else
{
    /*** convert the array to object ***/
 //   $array =$adCreditExchange->objectToArray($ad_list);

    /*** show the array ***/
   foreach($ad_list as $key=>$value){
foreach($value as $key=>$value2){

//look up depofo for each 
//assign to $depofo[bank_acctno] and $depofo[bank_acctname]
}
$total = $value[quantity] * $value[price];
if($value[id] == $listing_id)
{
$msg .=  '
<h1>Do You Really Want To Cancel This Listing?</h1>

<table style = \"margin-left:auto; 
    margin-right:auto;\" bgcolor=\"white\" width=\"75%\">
<table border="2" cellpadding="5" >
<tr><td>Offer ID</td>	<td>'.$value[id].'</td></tr>
<tr><td>Date/Time Posted</td><td>'.$value[timestampInit].'</td>	</tr>
<tr><td>Quantity Of Advertising Credits Offered</td><td>'.$value[quantity].'</td></tr>	
<tr><td>Asking Price (per Advertising Credit)</td><td>'.$value[price].'</td></tr>
	
<tr><td>Currency Unit</td><td>'.$value[currency].'</td>	
<tr><td style="background-color:yellow;">Total Amount Due</td><td style="background-color:yellow;">'.$total.'</td></tr>
<tr><td>Bank Name</td><td>'.$value[bank_name].'</td></tr>
<tr><td>Buyer\'s Deposit Time Limit (Minutes)</td><td>'.$value[buyertimelimit].'</td></tr>
<tr><td>Your Response Transfer Time Limit (Hours)</td><td>'.$value[sellertimelimit].'</td></tr>
<tr><td>Current Status</td><td>'.$value[status].'</td></tr>
<tr><td>Comments</td><td>'.$value[textarea].'</td></tr>
<tr><td colspan = "2"><h1>If you really want to cancel the listing click here </h1>

<form method="post" action="'. htmlentities($_SERVER['PHP_SELF']).'" style="width:80">
<input type="hidden" name ="A1" value="1">
<input type="hidden" name ="listing_id" value="'.$_GET['listing_id'].'">
  <input type="image" width="60" height="50" src="../../images/cancelnow.jpg" alt="Submit">
          
</form></td></tr>	

</table><hr style="height:2em;color:#333;background-color:#333;>';
}
}//close else count > 0




$msg .= "



</td></tr></table>
";
}
}//close if isset a1
echo $msg;
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';

include($_SERVER['DOCUMENT_ROOT']."/members/templatebottomnsb.php");


} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

