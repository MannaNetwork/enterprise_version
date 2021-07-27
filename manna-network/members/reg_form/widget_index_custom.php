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

$link_selected =$_GET['link_selected'];
$type =$_GET['type'];
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `BB_user_ID` from `links` where `id` = '$link_selected'";
$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows >0){
$row = mysqli_fetch_array($result);
$BB_user_ID = $row['BB_user_ID'];
}

if($BB_user_ID != $user_id){
echo 'header(you are not authprized)';
exit();
}


include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `file_name`, `folder_name`, `end_clone_date` from `widgets` where `link_id` = ".$link_selected;

$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows >0){
$row = mysqli_fetch_array($result);
$folder_name = $row['folder_name'];
$file_name = $row['file_name'];
$end_clone_date = $row['end_clone_date'];
}


//if($end_clone_date > '0000-00-00 00:00:00' and $type != 'start_up'){
//echo 'That link is no longer eligible to host a web directory';

//}


//include($_SERVER['DOCUMENT_ROOT']."/members/template_topy.php");
$moniker="<h5>Get Your Free Web Directory Code</h5>";
$body_width="wide";
include('../../960top.php');
if ($access_level > 1){
 include('../user_dev_cpanel_submenu.php');
}
else
{
 include('../user_cpanel_submenu.php');
}
?>

<script>
var page_set = [
{'caption': 'Install Location', 'url': 'widget_install.php?link_selected=<?echo $link_selected;?>'},
    {'caption': 'Customize', 'url': 'widget_config.php?link_selected=<?echo $link_selected;?>'},
    {'caption': 'Get Code - Template Version', 'url': 'widget_template_version_code.php?link_selected=<?echo $link_selected;?>'}
,
    {'caption': 'Get Code - BareBones Version', 'url': 'widget_barebones_version_code.php?link_selected=<?echo $link_selected;?>'}

];
</script>

<?

$msg="";
if($type == 'manage'){
//check if this user has a payment gateway
		include($_SERVER['DOCUMENT_ROOT']."/masterlinks/db_cfg/db2mstrlnksconfig.php");
		include($_SERVER['DOCUMENT_ROOT']."/masterlinks/db_cfg/connectloginmysqli.php");
  $sql = "SELECT * FROM `gourl` WHERE `userid` = ".$user_id;
$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 3 Account' query");
    $row_cnt = mysqli_num_rows($result);

echo '<h2 style="text-align:left;"> <a href="../reports/user_cp_commissions_reports.php?link_selected='. $link_selected.'"> Get Sales, Recruiting and Commission Reports</a></h2><p class="smallerFont" >
See the websites that have added their links and registered from your site, which of those that are paying links, which have added a web directory to their own site and history of your commission earnings.';
if($row_cnt > 0){
echo '<h1>Need to put a delete the gateway function here';
}
else
{
echo '
<h2 style="text-align:left;"><a href="../adcredit_exchange/index_gourl.php?user_id='.$user_id.'">Create Your Own Bitcoin Payment Gateway To Receive Deposits Direct From Other Members</a> </h2>
<p class="smallerFont" >
You can create your own payment gateway at GoUrl and then, when any of your registered users/advertisers deposit Bitcoin to their BungeeBones prepaid accounts, you can receive their Bitcoin in exchange for your own AdCoin/Adcredits. In other words, they pay in Bitcoin and we credit their account with the same amount of AdCoin/Ad Credits. We deduct that amount of AdCredits from your account and send you the Bitcoin. The only requirement is that you create your own payment gateway, provide us the gateway\'s configurations and, lastly, that your available balance in your own Bitcoin Account must be more than their deposit amount.';
}
echo '<h2 style="text-align:left;"><a href="../adcredit_exchange/index_seller.php?user_id='.$user_id.'">Sell Earnings To Other Members</a> </h2>
<p class="smallerFont" >
You can sell your AdCoin/Adcredits to other members using Smart Contract cash deposits to your own Bank Account


<h2 style="text-align:left;"><a href="widget_earnings.php?link_selected='.$link_selected.'">Collect Earnings</a> </h2>
<p class="smallerFont" >
Collect your web directory\'s EARNINGS And Commissions

';
}
elseif($type == 'edit'){
echo '<h1>Edit Your Web Directory Installation Configuration</h1>';

$msg .= '<a name="custom"></a> <table id="member" style = "margin-left:auto; 
    margin-right:auto;"  width="80%" >
<tr><td>
<p class="smallerFont" >';

$msg .=   '
<h1 style="color: navy;">Web Directory Installation Instructions</h1>';


$msg .=   '
<tr><td>&nbsp;
</td></tr>
<tr><td>
<img onmouseover="/images/large_button_gry_customize.gif(this)" src="/images/large_button_wht_customize.gif" alt="Smiley"> 
<!--<img src = "/images/large_button_gry_customize.gif">-->
 </td></tr>
<tr><td>&nbsp;
</td></tr>
<tr><td>
<img onmouseover="/images/large_button_gry_trouble.gif(this)" src="/images/large_button_wht_trouble.gif" alt="Smiley"> 

</td></tr></table>';
}
elseif($type == 'start_up'){

$msg= '<font color="red"><p class="smallerFont" >Your Web Directory installation has been placed in "Start Up" mode automatically. Being in Start Up mode doesn\'t affect the usage of it in any way. It only keeps us here at the BungeeBones website from promoting it yet as one of the demos of our service.</p>
<p class="smallerFont" >The administrators at BungeeBones also have received notice of your installation and will be monitoring its progress. They are available to help and you can use the contact form in the left menu at BungeeBones for communicating with them. They may also contact you if they see you are having difficulty.</p>
</font>';
}
else //type must be new
{

$msg .='
   <div>
     <div> 
       <div class="modalHeader"><h1 align="center">Earn Income With A Web Directory!</h1></div> 
            <h3 style="text-align:left">Installing our co-operative web site monetization system will enable you to earn income (either in the form of Bitcoin or advertising credits) by recycling your own web traffic. You will become a free member in a network of many other individually owned and operated websites that co-operate together to advertise each other\'s websites and earn income. Our system pools your web traffic with theirs. This is a great deal to potential advertisers that visit your site because it means they will be advertised not only on your website but on all the others as well. It\'s a better way for them to advertise than what advertising on just your site could provide by itself.</h3>
       <h3 style="text-align:left">To become part of the system install just our web directory script. It is free and is also totally and completely managed for you, too. Just install it and collect (or spend) the commissions! </h3>
<h3  style="text-align:left">It is available to you as a simple to install plugin for Wordpress or as a PHP script that can be installed in a non-Wordpress site. </h3>
<h3  style="text-align:left">And it is available for free!</h3>



';
$msg .= "
<div>
<!--<img style=' display: block;
    margin-left: auto;
    margin-right: auto; width:280px;' src='/members/images/new_release.png'/>-->
</div>
<!-- Going to index page rather than download causes a hangup and the page also wants to load it all into the temp table 
- don't know what I was thinking. Replaced it with direct download <a href='/phpblock/index.php?link_selected=".$_GET['link_selected']."' title='Get PHP Version' rel='gb_page_center[640, 480]'><div style=\"background-image: url('images960/1x1tran.gif'); background-repeat: repeat-x; background-color: white; color:white; font-size:100%;-moz-border-radius: 15px;
		border-radius: 15px;text-align: center;\"><img width='380px' src='/members/images/phpversion.png'
 /></div></a> -->

<a href='/phpblock/bungeebones_php_version.zip'><img width='380px' src='/members/images/phpversion.png'
 /></div></a>

<!-- same as above <a href='/plugins/index.php?link_selected=".$_GET['link_selected']."' title='Get Wordpress Plugin Version' rel='gb_page_center[640, 480]'><div style=\"background-image: url('images960/1x1tran.gif'); background-repeat: repeat-x; background-color: white; color:white; font-size:100%;-moz-border-radius: 15px;
		border-radius: 15px;text-align: center;\"><img width='380px'  src='/members/images/wordpressversion.png'
 /></div></a>  -->

<a href='/plugins/bungeebones_plugin_version.zip'> <img width='380px'  src='/members/images/wordpressversion.png'
 /></div></a>
";

$msg .='

<h1 style="text-align: center;">Other Website Monetization Options</h1>

<h3  style="text-align:left">We offer you and your visitors other monetization programs which could also earn you income as well (these will all be available to them from your new web directory page after you install it) .

<h4>If They Need A Website ...</h4>
<h5>We Offer A Free MultiSite Blog</h5>
<p  style="text-align:left"><ul><li>No domain name needed</li><li>No hosting fee</li><li>Easy to operate</li><li>Same full income earning opportunities as other programs</li><li>No CPanel</li><li>Can\'t add plugins</li><li>Can\'t add themes/templates</li></ul>
</p><p  style="text-align:left">

<h4>If They Have A Wordpress Website Already ...</h4>
<h5>You Offer Them A Web Directory Plugin From Your Installation</h5>

<h4>For Those With A PHP Coded Website</h2>
<h5>You Offer Them Offer A PHP Web Directory Script From Your Installation</h5>
<h3  style="text-align:left">All web directories comes with free web directory management services from BungeeBones and come complete with categories and links (i.e. maintenance free!). 

</div>     ';


}


echo $msg;
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';


//include($_SERVER['DOCUMENT_ROOT']."/members/templatebottomnsb.php");

include('../../960bottom.php');
} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

