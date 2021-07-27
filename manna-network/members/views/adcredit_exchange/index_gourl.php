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




$moniker="<h5>AdCoin/Advertising Credit Redemption Via GoURL Payment Gateways</h5>";
$body_width="wide";
include('../../960top.php');
include('user_cpanel_submenu.php');
$msg="";



$msg .= "<table id=\"member\" ><tr><td>
<p class=\"smallerFont\" >The links and processes listed below enable BungeeBones users that have earned Advertising Credits in their account to redeem them for Bitcoin directly from other BungeeBones users. The process is designed to use the GoUrl payment gateway and requires BungeeBones' sellers to get an account at GoURL and then submit only a few configurations to Bungeebones admin via a form. The feature is totally invisible to buyers.

<h2>The Benefits To Ad Credit Sellers</h2>
<ol>
<li> Provides sellers an alternate way to liquidate their Advertising Credits* </li>
<li> Saves them from having to request redemption from BungeeBones*</li>
<li> No minimum redemption amount</li>
<li> Faster </li>
</ol>
<p style='text-align:left;' class=\"smallerFont\" >
* This method is an alternative to the BungeeBones' offer to redeem advertising credits/AdCoin for Bitcoin at a rate of one-for-one. If you want to redeem your advertising credits from Bungeebones, simply use the contact form to submit a withdrawal request. Include your website URL, your affiliate (or link) number (if you know it) and enter the same email address in the form as the one you registered with. And, of course, include in the message the amount of Bitcoin you wish to redeem. Note there is currently a $25 minimum value of Bitcoin that we will send using this method.
";
$msg .= '
<h3 class="western">How To Earn Bitcoin - A Quick Review</h3>

<p style="text-align:left"; class="smallerFont"><img style="float:left;" src="onebtc4oneadcoin.png">Whenever a user
makes a Bitcoin deposit to their pre-paid advertising account they
will receive an equal number of advertising credits. As they buy advertising with those credits, the charges will be deducted daily from their own balance and disbursed to their “upline” daily (again as advertising credits) as commission payments. Each level in the “upline” can use the commissions immediately to pay their own advertising fees for their own website(s) or they can also let them accumulate for redemption as actual Bitcoin. If they let the balance rise above the minimum redemption amount ($currently $25 worth of Bitcoin) they can redeem them directly from BungeeBones by submitting a redemption request. Alternatively, those with their own payment gateway can receive Bitcoin directly when one of their registered users makes a deposit.</p>
';


$msg .= '<h3 class="western">How To Redeem Bitcoin With A 3RD Party Payment Gateway</h3>
<p style="text-align:left"; class="smallerFont"><img style="float:right;" src="redeemone4one.png">Get your own Bitcoin payment gateway from the 3rd party GoURL.io and redeem your ad credits directly when one of your registered users makes a Bitcoin deposit. The only requirement is that the Bitcoin payment made by the user is for an amount less than what your account has available.</p>';

$msg .= '<h3 class="western">The Bitcoin Is Paid To The "Lowest" Level First</h3>
<p style="text-align:left"; class="smallerFont"><img style="float:left;" src="redeemtohigher.png">If a user\'s upline doesn\'t have enough earnings to cover the amount of the Bitcoin deposited then our script will check if the next higher level does (and then the next and the next etc.) looking for an account with sufficient amount of AdCoin (or advertising credits) to cover the deposit amount. If no one in the upline tree of the depositor has sufficient AdCredits that can be transferred then BungeeBones itself will receive the deposit into "cold storage", will create the ad credits and add them to the depositors account where they will be ready for spending and to be credited to the upline(s) as they are spent.</p>';

$msg .=  '<a href="get_gourl.php"> <h2><u>Get Your GoURL-BungeeBones Payment Gateway</u></h2></a>';




echo $msg;
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';


include("../../960bottom.php");


} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

