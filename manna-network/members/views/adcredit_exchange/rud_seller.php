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


$moniker="<h5>Seller Main Menu</h5>";
$body_width="wide";
include($_SERVER['DOCUMENT_ROOT']."/960top.php");
include('user_cpanel_submenu.php');
$msg="";
if (isset($_POST['A1'])) {
include('../classes/ad_credit_exchange_class.php');
$adCreditExchange = new adCreditExchange;

$test_array = array(
'list of statuses',
'withdrawn',
'arbitration',
'executed',
'expired',
'accepted',
'reported',
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
echo '<br>&nbsp;<br><br>&nbsp;<br><h1>Sorry! There were no results found.</h1>';
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

$msg .= "<tr><td><h1>Seller Listing Administration Pages</h1>

<table id='member' >


";




 $msg .= '
<p><a href="slr_admin_bank.php">Bank Info</a>
<p><a href="slr_admin_all.php">All Listings</a>
<p><a href="slr_admin_offered.php">Offered</a>
<p> <a href="slr_admin_accepted.php">Accepted Offers</a>
<p><a href="slr_admin_expired.php">Expired</a>
 <p>     <a href="slr_admin_executed.php">Executed</a>
 <p>     <a href="slr_admin_withdrawn.php">Withdrawn</a>
<p><a href="slr_admin_arbitration.php">Arbitration</a>
   
';

$msg .="
 </td></tr>
<tr><td>&nbsp;
</td></tr>
<tr><td>
</td></tr></table>


";







echo $msg;
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Main Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';


include($_SERVER['DOCUMENT_ROOT']."/960bottom.php");
}//close if isset A1

} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

