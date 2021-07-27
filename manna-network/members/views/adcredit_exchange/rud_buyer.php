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

include("../../960top.php");

include('user_cpanel_submenu.php');
include('exchange_buyer_submenu.php');
$msg="";

if(isset($_POST['Deposit_Report'])){


echo "<H!>TO DO List</h1>
<p class='smallerFont'>Filing this report needs to place a deep freeze on the sellers account IF they have provided their bank info and get an email - otherwise they only need to get an email.

<p class='smallerFont'>To place a deep freeze on the assets all the buyer related columns in the listings table must be filled in - 
timestampBuyerin, buyerid

<p class='smallerFont'> The status column has to be changed to \"accepted\". - what are all the possible statuses again?

A cron job needs to be built or launched to launch the transfer credits page. It would need to be a page to be run every 15 minutes. So this section here would need to write to that page that this transaction needs to be transferred. To do that need the sellers time limit from listings and add that amount to now(). The transfer would take place after that. 

<p class='smallerFont'>To make the transfer need to get the functions that work the day ledger table. Need to remove the correct amount from the seller (it should already be tagged and not counted in the sellers balance) and add it to the buyer\'s day ledger balance. I think there is one or two other tables that need to be adjusted also. 
<p class='smallerFont'>Copied the function credit_bitcoin ($user_id, $BB_bitcoin_cold_address, $payment_amount, $payment_status) over to this class from price slot class. NEED to convert it over to PDO That would secure the other one too).
<p class='smallerFont'>It changes three tables. They all should have been altered already, though, to escrow the sellers funds.

Where when, how to change the sellers funds? When they place the listing/offer.


";
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';

$test_array = array(
'list of statuses',
'withdrawn',
'arbitration',
'executed',
'expired',
'accepted',
'cntroffered',
'offered');
print_r($test_array);
}
elseif (isset($_POST['A1'])) {
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

$status = $_POST['status'];
$scope = $_POST['scope'];

if($scope == "users_listings"){
$ad_list = $adCreditExchange->viewbyseller($user_id, $status);
}
else
{
$ad_list = $adCreditExchange->viewbyseller("", $status);
}
if(count($ad_list)==0)
{
if($status=="report"){
echo '<br>&nbsp;<br><br>&nbsp;<br><h1>Buyers Successful Deposit Report Form</H1>
<p class="smallerFont">By filing this report you are affirming to the SELLER and to BungeeBones that you HAVE COMPLETED the deposit as stipulated in your agreement with the buyer. 
<br>&nbsp;<br><br>&nbsp;<br><h1 style="color:red">Caution - Issuing a false deposit report will be detected by the seller and will result in an Arbitration request being submitted and the transaction stopped. The arbitration proceedings will be publicized as well as your identity! DO NOT FILE FALSE REPORTS!</h1>
<form name="test" action="'. htmlentities($_SERVER['PHP_SELF']).'" method="post">

<input type="submit" name="Deposit Report" value="Submit Deposit Report"><br>
</form>
';


}
elseif($status=="arbitration"){

echo '<br>&nbsp;<br><br>&nbsp;<br><h1>Buyers (like yourself) do not file arbitration requests because all transfers of Advertising Credits to them will be completed (manually by the seller or automatically at the expiration of the Seller\'s time limit) unless the SELLER has filed for arbitration because of a problem with a payment not showing up in their bank account. In other words, if you have made a deposit AND REPORTED IT then it is guarenteed you will receive your credits at the end of the seller\'s time period at the latest. 
<br>&nbsp;<br>
Since there were no results found there is no seller that has filed an arbitration request against you. If there had been they would be displayed here as well as instructions and the means to respond.

<br>&nbsp;<br>Your only defense against an arbitration challenge, however, is the deposit receipt so be sure to save that until your account is funded with the credits. A business card from the teller you used could possibly be a help too. There is no time limit placed on an arbitration matter so everyone gets as much time as they need to present their case in the unlikely event an Arbitration matter befalls them.</h1>';
}
else
{
echo '<br>&nbsp;<br><br>&nbsp;<br><h1>Sorry! There were no results found.</h1>';
}
}
else
{
    /*** convert the array to object ***/
 //   $array =$adCreditExchange->objectToArray($ad_list);

    /*** show the array ***/
   foreach($ad_list as $key=>$value){
foreach($value as $key=>$value2){
echo '<br> key = ', $key;
echo ' ....... value2 = ', $value2;
}
}
}//close else count > 0

$count_list_by_user = $adCreditExchange->countbyseller($user_id);
echo '<br>$count_list_by_user = ', $count_list_by_user;
}
else
{

$msg .= "


<table id='member' >

<tr><td><h1>Buyer Support</h1>";
$status = 'offered';
$listing_id = '48';
$msg .= '
<div id="dropdown">';



 $msg .= '
<p class="smallerFont"><a href="buyerreport.php">Report A Deposit</a>    

<p class="smallerFont"><a href="buyerexecuted.php">Your Purchase History</a>
<p class="smallerFont"><a href="buyerexpired.php">Orders You Committed To Purchasing That Expired</a>
<p class="smallerFont"><a href="buyerarbitration.php">Arbitration Proceedings</a>


';

$msg .="
 </td></tr>
<tr><td>&nbsp;
</td></tr>
<tr><td>


</td></tr></table>
";







echo $msg;
echo '<a href="index_buyer.php"> <h2><u>Return To Advertising Credit Exchange Buyer Menu</u></h2></a>';
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Main Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a></div>';


include($_SERVER['DOCUMENT_ROOT']."/new_site/960bottom.php");
}//close if isset A1

} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

