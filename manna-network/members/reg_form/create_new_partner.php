<?php 

if (isset($_GET['action']) && $_GET['action'] == "log_out") {
//$test_page_protect->log_out(); // the method to log off
session_start();
session_destroy();
}
// include the configs
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
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 
//need to get the file name and the affiliate number to add to the replace with array
//the file name is the same as $dst
$moniker="<h6>Start Your Affiliate Recruiting Program</h6>";
$body_width="wide";
include('../../960top.php');

if(isset($_POST['submit'])){

function recurse_copy($src,$dst) 
{ 
 $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file);             } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            }        }     } 
    closedir($dir); 
} 








//to manually create a NEW top level upline such as a scholl or new widget uncomment/comment these two/four settings 
//and run this page manually                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
//when finished, undo, and the users can use this page to automatically crete their own accounts
//$user_id = 7236;
//$user_name = 'bungeebones';                                                                                            
$url_to_folder_name = $_POST['url_to_folder_name'];                      
$link_selected = $_POST['link_selected'];

$is_this_a_widget_already = isWidgetExists($url_to_folder_name);
                                                              

if($is_this_a_widget_already > 0){
echo '<h1>That affiliate site already exists!</h1>';

echo '<h1><a href="../">Return To User Control Panel</a>';
}else
{
$src  = "../../affiliate/partnertemplate";
$dst = "../../affiliate/".$url_to_folder_name;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ;
recurse_copy($src,$dst);
$new_affiliates_link_id = add_affil_link($user_id, $dst, $url_to_folder_name);

change_affil_num_in_new_user($new_affiliates_link_id, $dst);
$WidgetIDofreferrer =  getWidgetID($link_selected);
add_affil_link_to_widgets($new_affiliates_link_id, $WidgetIDofreferrer, $url_to_folder_name, $bitcoin_wallet);

include($_SERVER['DOCUMENT_ROOT']."/classes/widget_mgmt_class.php");
//script stopped rebuilding tree - might be because this reloads the rebuildtree function that is already on this page above
//doesn't display error though.
//but only runs function once
$rebuild = new widget_mgmt;
$rebuild->rebuildTree('1', 1);
echo '<h1><a href="../">Return To User Control Panel</a>';
}//close else if widget exists

}//close if submit
else
{

$link_selected = $_GET['link_selected'];
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$query = "SELECT * FROM links WHERE id='$link_selected'";
$result = @mysqli_query($connect, $query) or die("Couldn't execute 'Edit 3 Account' query");
do{
$db_url = $row['url'];
$db_name = $row['name'];
}while ($row = mysqli_fetch_array($result));
$url_to_folder_name_pieces = explode("/", $db_url);
$url_to_folder_name = $url_to_folder_name_pieces[2];
$url_to_folder_name = str_ireplace("www.", "", $url_to_folder_name);
$url_to_folder_name = str_ireplace(".", "dot", $url_to_folder_name);
$url_to_folder_name = strtolower($url_to_folder_name);

echo '

<div id="doc2">					
		<div id="bd">';
if($_SESSION['is_affil']="true" ){
//policy should be = don't give any 10333 cats  a link to add web sites or web directory
include($_SERVER['DOCUMENT_ROOT'].'/members/user_cpanel_submenu_aff.php');//don't give affs a link to add web sites or web directory
}
else
{
include($_SERVER['DOCUMENT_ROOT'].'/members/user_cpanel_submenu.php');
}
	
echo '<p style="text-align:left; font-size:larger;">Bungeebones comes with a built-in affiliate/franchise/recruitment/multilevel functionality that is essentially a self-managed Smart Contract that distributes any commissions from advertising payments derived from your sales to both yourself and your "upline" as the payments are made - automatically. Users that advertise in the network "pre-load" their accounts from where their advertising fees are deducted DAILY. Then the commissions from that payment are distributed DAILY to the accounts of the sellers, starting with the "agent" site that made the ad sale all the way until the end (BungeeBones) of the "upline" of the sales site. ';
echo '<p style="text-align:left; font-size:larger;">The Smart Contract is designed in such a way that your visitors are offered entry into the program right from the web directory itself through the two links at the top of the web directory on your site. Potential members have their choice of entry levels and, of course, all of them are absolutely free!';
echo "<h3>Three Ways For Your Visitors To Join And Earn Income<br>They Can:<ul><li>Get A Multi-site Blog (Like At Wordpress.com)</li><li>Download and Install A Wordpress Plugin Into Their Own Site</li><li>Download and Install A PHP Script Version Into Their Non-Wordpress Site</li></ul></h3>";

echo '<p style="text-align:left; font-size:larger;">All of the above methods equip your visitor with their very own web directory portal into the advertising network. They are automatically entered as YOUR DOWNLINE when they register so when their visitors join and buy advertising you get over-ride commissions on their sales. Their web directory has the same links and, thus,the same smart contract offering to their visitors. No one ever pays for the script or the opportunity. We want their web traffic in the network. Each new web directory installed adds traffic and makes it easier for each of us to sell the advertising in the network.';
echo '<p style="text-align:left; font-size:larger;">All you need to do to build your downline is to get your visitors, family, friends, acquaintences etc. to use the links at the top of your web directory to join. The great thing is that, with the new addition of our Multi-site blog offering, they don\'t need a web site or even a domain name to start!';

}

//include($_SERVER['DOCUMENT_ROOT']."/members/templatebottomnsb.php");

include('../../960bottom.php');
} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}
?>
