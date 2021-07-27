<?
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

//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 


include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
//include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connect.php");
//new db connection
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `file_name`, `folder_name` from `widgets` where `link_id` = '$link_selected'";
$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows >0){
$row = mysqli_fetch_array($result);
$folder_name = $row['folder_name'];
$file_name = $row['file_name'];
}

?>
<h2>BungeeBones, Regional Filters, Pricing and SEO</h2>
<?
$msg .=  '<p style="text-align:left; font-size: 125%;">The design of the BungeeBones Distributed Web Directory includes special consideration for the unlimited local characteristics of businesses and their related websites. How far you want to reach for your customer is the first step in deciding where and how much to spend for advertising. While we all are witnessing the changes the web and the information age are bringing to us the BungeeBones web directory has subtle characteristics specifically designed to optimise the efficiency of local advertising.
<ul><li>Comprehensive And Free</li>
<p style="text-align:left; font-size: 125%;">
Of extreme importance in our design objectives was to make BungeeBones a "comprehensive" directory. By that we mean we wanted every website listed that an end user could possibly want. We also wanted BungeeBones to have a feel of being owned by the webmasters themselves. And we wanted the web directory to be extremely efficient at handling its resources. We made BungeeBones a free listing directory and make a commitment that there will always be a free place for your link at BungeeBones. </p>';
$msg .=   '<li>Collective Ownership</li><p style="text-align:left; font-size: 125%;">Getting webmasters to feel like BungeeBones is their own involves some education about our longterm residual income plans from the sales commissions. While there is always a place for free there is also the reality that not every link can be placed in front of the end user at the same time. The links are ordered and organized and the positions at the top are more sought after and valuable. BungeeBones has come up with a unique pricing mechanism that takes into account the many market factors that determine a position\'s value. Web advertising is big business and BungeeBones wants to open up that business up to include the small business.</p>';

$msg .=   '<li>Local, Small Business Oriented</li><p style="text-align:left; font-size: 125%;">The location that the business or webmaster wants to compete in has a huge impact on their potential cost of a link in our directory. There are major metropolitan markets such as New York city that are incredibly competitive even for simple things like barber shops or donut shops. On the other end there are businesses that are extremely local in their nature and are in small markets that have little or no competition. The BungeeBones pricing system lets webmasters configure their listing to their own maximum advantage in their own location AND category of business. </p>';

$msg .=   '<li>A SEO Tool</li><p style="text-align:left; font-size: 125%;">SEO (search engine optimisation) is helped by BungeeBones because webmasters include regional information when it is important to the business. They decide what regions to compete in whether it be on a global scale, continent wide, country wide or right down to their city. BungeeBones is a one-stop advertiser for all those levels.';



$msg .= '<li>Advertising Synergy And Efficiency</li><p style="text-align:left; font-size: 125%;">But the best part about BungeeBones is that it is designed so that you, the webmaster, get the maximum return for your advertising dollar no matter what direction you end up taking because BungeeBones is primarily a web traffic "recycler". We take the web traffic as it is leaving a web site. So the more traffic our members get (regardless of where it came from originally) the better it is for us and our members. ';
echo $msg;
echo '</ul>';



} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
