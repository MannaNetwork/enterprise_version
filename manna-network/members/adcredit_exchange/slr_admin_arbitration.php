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


$moniker="<h5>Arbitration</h5>";
$body_width="wide";
include($_SERVER['DOCUMENT_ROOT']."/960top.php");
include('user_cpanel_submenu.php');
include('exchange_buyer_submenu.php');
include('exchange_seller_submenu.php');
$msg="<h1>Arbitration</h1>";
$msg .= "<table id = 'member'><tr><td>";
$msg .= "<p class='smallerFont' >If you did not receive advertising credits from a seller that is a BungeeBones member as you were supposed to and have failed to resolve the issue with the seller you can bring the matter before an arbitrator. Bungeebones does not arbitrate matters itself but, rather, refers all arbitration matters to others. The agrieved party must initiate the arbitration process and the other party must accept the arbitrator within a reasonable time. If the two parties cannot agree on an arbitrator then the BungeeBones administration can mediate by casting a tie breaker vote for an arbitrator.
";
$msg .= "<p class='smallerFont' >Since this is a Bitcoin based and related issue we recommend an arbitrator familiar with Bitcoin and willing to accept it for any related fees. Without any endorsement as to suitable or qualifications of the arbitrators BungeeBones provides <a target='_blank' href='https://www.bitrated.com/u'>this link to Bitrated</a> which provides a sizable list of arbitrators from which to choose.
</p>";
 $msg .= "<p class='smallerFont' >The agrieved party needs to contact an arbitrator to get the process started. Have them contact BungeeBones.com through the web site's contact form and we will provude them all relevant details of the transaction involved (including the other party's contact information).
";

 $msg .= "<p class='smallerFont' >Upon a decision by a properly selected arbitrator Bungeebones Administration will transfer the disputed advertising credits as directed by the arbitrator";





 $msg .=  '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Menu</u></h2></a>';
 $msg .= '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';
 $msg .= "</td></tr></table>";

echo $msg;

include($_SERVER['DOCUMENT_ROOT']."/960bottom.php");


} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

