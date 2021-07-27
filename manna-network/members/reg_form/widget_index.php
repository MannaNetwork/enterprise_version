<?
//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 
$default_price = "0.00";//this is what charge is applied to any not having a price set in the database
$default_adj = "1";
if (isset($_GET['action']) && $_GET['action'] == "log_out") {
session_start();
session_destroy();
}
// include the configs
require_once($_SERVER['DOCUMENT_ROOT']."/members/config/config.php");

// load php-login components
require_once($_SERVER['DOCUMENT_ROOT']."/members/php-login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();
    
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...

$user_id = $_SESSION['user_id'];

if (isset($_GET['link_selected'])){
$link_selected=$_GET['link_selected'];

}
$link_selected =$_GET['link_selected'];

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
$sql="select `file_name`, `folder_name` from `widgets` where `link_id` = '$link_selected'";
$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows >0){
$row = mysqli_fetch_array($result);
$folder_name = $row['folder_name'];
$file_name = $row['file_name'];
}
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");
?>
<h2>Widget Installation & Registration Form</h2>
<?
$msg= '<p style="text-align:left; font-size: 145%;">Get Widget (i.e. web directory) source code</p>';
$msg .=  '<p style="text-align:left; font-size: 145%;">The web directory source code is available for various web platforms such as FaceBook, WordPress, Joomla and regular, custom coded php websites. Each platform version is fully functional when installed at the location you specified in your configuation. Each will produce a category filled directory immediately after installation to your website at the location you specified.('.$folder_name.'/'.$file_name.')</p>
';
$msg .= '<p style="text-align:left; font-size: 125%;"><a href="">For custom coded php websites</a> <br>The process of installing the web directory begins with you having a web page template from your website. BungeeBones is  designed to look and feel as one of your own web pages so it needs your template wrapped around it. Each of these next two can be used to build your web directory on your custom site but approach the process in a different way';
$msg .=   '<p style="text-align:left; "><a href="widget_barebones_version.php?link_selected='.$link_selected.'">The BareBones Version </a>comes as two blocks of code that need to be inserted into two different sections of one of your website page templates. One section of code needs to be pasted into the "head" section and the other into the "body" section of the page.</p>';
$msg .=   '<p style="text-align:left; "><a href="widget_template_version.php?link_selected='.$link_selected.'">The Template Version </a>comes as a complete page and includes our website page template. The top, sides, and footer sections are all clearly marked so that you can tell where the directory code starts and stops. Install this version and it (the directory) should work and can be used for reference along with the previous version.</p>';

$msg .=   '<p style="text-align:left; font-size: 125%;"><a href="http://bungeebones.com/bungeebones_web_directory/facebook_fan.php">The FaceBook Version </a>comes as a complete web directory for your FaceBook site. Let your friends add and organize their links into categories and help pormote their websites through BungeeBones.</p>';


$msg .=   '<p style="text-align:left; font-size: 125%;"><a target="_blank" href="http://wordpress.org/extend/plugins/bungeebones-remotely-hosted-web-directory/">The WordPress version</a> lets you install BungeeBones into your WordPress blog. An easy way to monetize your blog and writing.';

$msg .=   '<p style="text-align:left; font-size: 125%;"><a href="">The Joomla Version </a>comes as a complete web directory for your Joomla site. Let your friends add and organize their links into categories and help promote their websites through the BungeeBones network.</p>
<p>There are instructions to install the web directory into Joomla either as a component or as an external page. If you install it as a component, the directory is "inside" Joomla so when you update your Joomla links, templates etc then your directory page is updated also. But there are server settings that BungeeBones nor our users have any control over that sometimes block Joomla from being able to recognize our script. In those cases you can add the directory as an external page and still have the look and feel of your Joomla site.
<p><a target="_blank" href="http://bungeebones.com/bungee_jumpers/reg_form/widget_joomla_tutorial.php">The Component Version</a><br>
<p><a target="_blank" href="http://bungeebones.com/bungee_jumpers/reg_form/widget_joomla_tut_stnd_aln.php">The External Page Version</a><br>';

$msg .=   '<p style="text-align:left; font-size: 125%;"><a href="widget_config.php?link_selected='.$link_selected.'">Customize Your Web Directory</a> After you get the directory working properly on your website use this form to customise it to your website and make some other decisions about how you want to use it.';

$msg .= '<p style="text-align:left; font-size: 125%;"><a href="widget_edit.php?link_selected='.$link_selected.'">Re-Locate Your Widget/Web Directory To A Different Location On Your Website</a> You can move your web directy installation to a different folder or change its file name here just by entering it\'s new folder or file name.';

echo $msg;
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';


include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");

} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
