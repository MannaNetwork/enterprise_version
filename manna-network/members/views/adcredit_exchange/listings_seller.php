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


include($_SERVER['DOCUMENT_ROOT']."/members/template_topy.php");
include('user_cpanel_submenu.php');
$msg="";
if (isset($_POST['A1'])) {
include('../../classes/ad_credit_exchange_class.php');
$adCreditExchange = new adCreditExchange;

$test_array = array(
'list of statuses',
'withdrawn',
'arbitration',
'executed',
'expired',
'reported',
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

$msg .= "<h3>The following BungeeBones users are offering their Advertising Credits for sale</h3>

<h3>BungeeBones provides the following:

<ul><Li>Guarantees that the sellers have the Advertising Credits and freezes them while for sale</li><li>Provides this market bulletin as a way to liquidate Advertising Credits for cash rather than spending them on advertising </li><li> Provides a secure, step by step procedure for transferring credits from seller to buyer</li><li> Functions like an escrow service between buyer and seller</li><li> Can function as an arbitrator </li></ul>


<table style = \"margin-left:auto; 
    margin-right:auto;\" bgcolor=\"white\" width=\"75%\">
<form name=\"test\" action=\"". htmlentities($_SERVER['PHP_SELF'])."\" method=\"post\">

<tr><td><h1>Advertising Credits For Sale By Owners</h1>";
$status = 'offered';
$listing_id = '48';
$msg .= '<form method="post">
<div id="dropdown">';



 $msg .= '<h2>Select The Category Of Listings</h2><select name="status">
<option value="offered" selected>offered</option>
  <option value="withdrawn">withdrawn</option>}
   <option value="arbitration">arbitration</option>
   <option value="executed">executed</option>
   <option value="expired">expired</option>
  <option value="accepted">accepted</option>
   <option value="cntroffered">cntroffered</option>
   
 </select>

<br>&nbsp;<br>
<h2>Select The Scope Of The Display</h2>
<select name="scope">
<option value="users_listings" selected>View Just Your Listings Only</option>
  <option value="all_listings">View All Listings In That Category</option>}
   
   
 </select>';

$msg .="
 </td></tr>
<tr><td>&nbsp;
</td></tr>
<tr><td>

<input type=\"submit\" name=\"A1\" value=\"Submit Form\"><br>

</form>
</td></tr></table>
";







echo $msg;
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';


include($_SERVER['DOCUMENT_ROOT']."/members/templatebottomnsb.php");
}//close if isset A1

} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

