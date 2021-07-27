<? 
if (isset($_GET['action']) && $_GET['action'] == "log_out") {
	//$test_page_protect->log_out(); // the method to log off
session_start();
session_destroy();
}
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

$moniker="<h5>Overview</h5>";
$body_width="wide";
include($_SERVER['DOCUMENT_ROOT'].'/960top.php');
if($_SESSION['is_affil']="true" ){
//policy should be = don't give any 10333 cats  a link to add web sites or web directory
include($_SERVER['DOCUMENT_ROOT'].'/members/user_cpanel_submenu_aff.php');//don't give affs a link to add web sites or web directory
}
else
{
include($_SERVER['DOCUMENT_ROOT'].'/members/user_cpanel_submenu.php');
}
?>
<div style="text-align: center;"><h1>Overview Of Managing A BungeeBones Bidding For better Placement</h1></div>

<p align="left">
<ul>
<li>Links are displayed (in the directory)  with 20 links displayed per page according to the type of payment (i.e. paid displayed first ordered by price, then "paid with DemoCoin" also ordered by price, then free links ordered by registration date with the oldest displayed first)</li>

<ul>
    <li>You manage each link separately from your user control panel</li>
    <li>There are separate management sections in your control panel for free links, MultiSite Blog links and paid links</li>
    </ul>
<li>Better (i.e. Paid) Placement ahead of all free links can be gotten by paying with Bitcoin or by using free Democoin (available after registration or use the contact form to request some from the BungeeBones administrator)</li>
<li>The Better Placement (Bitcoin or Demo Coin) is the result of a special auction type purchase you make from your control panel</li>
<ul>
    <li>Users purchase by selecting the "price slot" for their link to be placed into. A "price slot" is defined as a group of links that have all paid the same price for their better placement but are arranged by seniority within that price slot (ie. first one to purchase in the price slot is senior).</li>
  <li>ANY Bitcoin payment (no matter how small) out ranks even the largest DemoCoin payment). 

 <li>Links in highest priced price slots are displayed first, second highest displayed next, then other price slots and finally free links</li>
<li>The script will select from the highest price slot in an attempt attempt to fill the 20 link page requirement. If/when the total links selected is less than 20 it will select the next highest price slot and/or from the free link group to make up the 20 links needed per page. If there is not enough room on the page for the entire group of the price slot to fit, then the most senior of that last price slot will be selected to finish off the page and the remainder will be displayed if/when the next page is requested.</li>
<li>A new, higher priced price slot is automatically created and offered after the purchase of the currently offered highest price slot. This enables competition for the number one spot and makes the number one position always available for purchase</li>
<li>The price for the newly offered highest price slot follows a pre-determined ratio of 1.5 times the price of the previous highest price slot. </li>

    <li>Price slots can hold unlimited number of purchasers with placement in a price slot ordered by the link's start date in the slot (i.e. the date it first purchased there)</li>

</ul>
   


</li>
<li>How To Purchase Paid Placement
<ul>
<li>Purchase price is deducted from your pre-loaded BungeeBones account.</li>
    <li>Pre-load funds can be loaded into your BungeeBones account with Bitcoin or with free TestNet coins (a bitcoin demo) with as little as one day's fees.</li>
 <li>Both Bitcoins and TestNet Coins (they have no market value) can be earned (for advertising use)  or, in the case of Bitcoin, for redemption as Bitcoin (from BungeeBones) or as cash (from other users only).</li>
    <li>To purchase a price slot for a link click the yellow button(s) to the left of the link listing in your control panel</li>
<li>The daily price is calculated by taking the posted monthly price and dividing it by the number of days in the current month (so the per-diem varies slightly from month to month but the payments made each day add up to the same monthly fee).</li>
<li>The amount you decide to pay will be deducted from your pre-loaded funds daily and distributed as commissions</li>
<li>A paid placement can be canceled without charge within 1 hour and after that time the daily fee is charged.</li>



</ul>

</li>

</ul>

    </ul></p>

 


<?
include($_SERVER['DOCUMENT_ROOT'].'/960bottom.php');

} else {
    // the user is not logged in...

    include("views/not_logged_in.php");
}








?>
