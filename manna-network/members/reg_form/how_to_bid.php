<?
//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 

if (isset($_GET['action']) && $_GET['action'] == "log_out") {
	//$test_page_protect->log_out(); // the method to log off
echo '<h1>in Logout - Session Destroy</h1>';
session_start();
session_destroy();
}
// include the configs
require_once($_SERVER['DOCUMENT_ROOT']."/members/config/config.php");

    
// load the login class

// load php-login components
require_once($_SERVER['DOCUMENT_ROOT']."/members/php-login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

 
    
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...


$user_id = $_SESSION['user_id'];


include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");

$msg .= '<a name="top"><h2>About Paid Positions</h2>';




$msg .=   '</a><table><tr><td><a href="#1">Why Purchase Prominent Positions?</a></td></tr>
<tr><td><a href="#2">Think "Price Slots" - Not Actual Location.</a></td></tr>
<tr><td><a href="#3">Pre-load your account balance with PayPal.</a></td></tr>
<tr><td><a href="#4">Make A Purchase And Move Your Ad To Higher Placement.</a></td></tr>
<tr><td><a href="#5">Changing Or Exchanging A Purchase</a></td></tr>
<tr><td><a href="#6">Canceling A Purchase</a></td></tr>
</table>';

$msg .=   '<a name="1"></a><p align="left"><h1>Why Purchase Prominent Positions?</h1>';
$msg .= '<p style="text-align:left;">When we talk about "prominent" positions it is in relation to the free positions that most users enroll under. All prominent ads are displayed first - ahead of free links and can usually be expected to get many more visitors as a result. Free links are displayed according to the order they were received wih the oldest atthe top of the list. Fees begin very inexpensively at a rate which represents one click per month and you got your value from the purchase. Such low entry fees provide an opportunity to get the top spots held by the senior links.<p style="text-align:left;">When someone (an end user) selects a category in the directory the display pages deliver 20 links per page. Pagination occurs automatically and adds new pages as needed. While being towards the top of the first page is important being on the first page is more important.'; 
$msg .= '<a href="#top">TOP</a>';

$msg .=   '<a name="2"></a><p align="left"><h1>Think "Price Slots" - Not Actual Location.</h1>';
$msg .= '<p style="text-align:left;">The image below is an example of how your BungeeBones User Control Panel will display your link information(NOTE: if only a sincle checkbox is displayed on your Control panel it means there has not been any bidding action in that categry yet)..<p align="center"><img src = "http://Bungeebones.com/images/cp_link_block.jpg">'; 
$msg .= '<a href="#top">TOP</a>';
$msg .= '<p style="text-align:left;">Notice the features (in the left column):<br>
Link ID Number<br>
Category Name<br>
Pop = the number of links in the category<br>
Queries - reports how many times that category was requested in last 30 days<br>
$$$$ = link to Google\'s keyword price calculator - finds "per click" price at Google<br>
Current Selection - (is not displayed if yours is a free link) - 3 lines reporting your current paid position<br>
A series of yellow radio buttons - see detailed description below<br>
A small report under each radio telling how many purchases made in that price slot<br>';
$msg .= '<p style="text-align:left;">The yellow radio buttons each represent one "Price Slot" and that is what is purchased. The price slot on the far left is the highest price and no one has bought in it yet. Doing so would place your link in the top position. If/when someone purchases in that top slot a new slot is created so that someone may come and bid higher.<p style="text-align:left;">You can purchase in any slot from left to right even if others have already purchased there. Purchasing the lowest one places your link at the lowest position among the paid links but ahead of all the free links.<p style="text-align:left;">Calculate where your link will be displayed by adding the number of purchases made in each price slot going from the left to right. When the total reaches 20 you are where a pagination occurs. If you purchase in that slot you will be on a lower page. To demonstrate, I changed the numbers in the image and marked it where pages would break in the following image.<p align="center"><img src = "http://Bungeebones.com/images/cp_link_block2.jpg">';

$msg .= '<a href="#top">TOP</a>';

$msg .=   '<a name="3"></a><p align="left"><h1>Pre-Load Your Account Balance With PayPal</h1>';
$msg .= '<p style="text-align:left;">In order to purchase prominent positions you need to have funds available in your BungeeBones account. One way to add funds is by adding the BungeeBones web directory to your website. All commissions you earn through the sale of paid advertising are added to your BungeeBones account. But you can also add funds with PayPal.';
$msg .= '
<!-- Begin PayPal Button -->
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">

<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="info@bungeebones.com">
<input type="hidden" name="rm" value="2" />
 <input type="hidden" name="no_shipping" value="1" />
    <input type="hidden" name="no_note" value="1" />
    <input type="hidden" name="cn" value="Comments" />
    <input type="hidden" name="cs" value="" />
   <input type="hidden" name="image_url" value="http://www.bungeebones.com/images/hdr_BB4_paypal.jpg" />
    <input type="hidden" name="return" value="http://BungeeBones.com/bungee_jumpers/thank_you.php" />
    <input type="hidden" name="cancel_return" value="http://BungeeBones.com/bungee_jumpers/cancel.php" />
    <input type="hidden" name="notify_url" value="http://BungeeBones.com/bungee_jumpers/paypal_to_BBBank.php" />
 <input type="hidden" name="custom" value="<?echo $key;?>" />
<? $now = $user_id."|".time(); ?>
    <input type="hidden" name="invoice" value="<?echo $now;?>" />
 <select name="amount">
	<option value="5.00"> $5.00</option>
	<option value="10.00"> $10.00</option>
	<option value="20.00"> $20.00</option>
	<option value="50.00"> $50.00</option>
	<option value="100.00"> $100.00</option>
</select> 
<input type="image" border="0" name="submit" src="http://BungeeBones.com/images/x-click-but5.gif" alt="Load Your BungeeBones Account With PayPal">
</form>';
$msg .= '<a href="#top">TOP</a>';

$msg .=   '<a name="4"></a><p align="left"><h1>Make A Purchase.</h1>';
$msg .= '<p style="text-align:left;">Your BungeeBones Control Panel will be displaying either a series of yellow radio buttons as described in the tutorials above or it will display a single check box in their place. All you need to do to purchase is selct either the check box or the radio button of the slot you wish to purchase. The fees reported under each radio and checkbox are monthly but your account will be charged only a prorated amount. After this initial purchase the monthly amount will be deducted automatically at the first of each month.';
$msg .= '<p style="text-align:left;">The BungeeBones user Control Panel displays paid links and free links separately. Your recently purchased link will now be displayed in the Paid Links section. Your purchase also affects the information other users see about the category. If you were the first to purchase then the checkbox is replaced with two radio buttons. It will also report the price slot you purchased in so that you can cancel (see next section).';

$msg .= '<a href="#top">TOP</a>';

$msg .=   '<a name="5"></a><p align="left"><h1>Change Or Exchange A Purchase.</h1>';
$msg .= '<p style="text-align:left;">You can upgrade or downgrade your priceslot at any time. Simply select the new price slot\'s radio button. Your account will get crediting the remainder of that months fees from your current price slot and will purchase the new one. The new one, too, will be prorated as well.';

$msg .= '<a href="#top">TOP</a>';

$msg .=   '<a name="6"></a><p align="left"><h1>Cancel A Purchase.</h1>';
$msg .= '<p style="text-align:left;">To cancel a purchase simply select the same price slot\'s radio button that you have purchased. The script recognizes that and guides you through the cancellation. Your account will get crediting the remainder of that months fees when completed.'; 



$msg .=   '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';

echo $msg;

include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");
} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
