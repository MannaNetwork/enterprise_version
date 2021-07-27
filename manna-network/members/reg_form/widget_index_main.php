<?
//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 

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

$link_selected =$_GET['link_selected'];
$type =$_GET['type'];
	    

include($_SERVER['DOCUMENT_ROOT']."/db_dfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `BB_user_ID` from `links` where `id` = '$link_selected'";
$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows >0){
$row = mysqli_fetch_array($result);
$BB_user_ID = $row['BB_user_ID'];
}

if($BB_user_ID != $user_id){
echo 'header(you are not authorized)';
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


if($end_clone_date > '0000-00-00 00:00:00' AND $type != 'start_up'){
echo 'That link is no longer eligible to host a web directory';

}


include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");
?>
<h2>Widget Management</h2>
<?
if($type == 'start_up'){
	echo '<font color="red"><h2>For your protection from the potential of having malformed pages going live on our web site your new Web Directory installation will be temporarily operating in "Start Up" mode. Being in Start Up mode keeps your installation private and away from public view on the BungeeBones website but does not affect any features or operation of the script on your site.</h2>
<h2>The administrators at BungeeBones receive notice of your installation and will be monitoring the progress of the install. They are available to help with the install and you can use the contact form in the left menu at BungeeBones. They may also contact you if they see you are having difficulty.</h2>
<h2>The forms below are basically the same as the ones you used to install the web directory script and are mainly provided as a means to modify your configurations if necessary.</h2>
</font>';
}
elseif($type == 'new'){
	echo '<font color="red"><h2>For your protection from the potential of having malformed pages going live on our web site your new Web Directory installation will be temporarily operating in "Start Up" mode. Being in Start Up mode keeps your installation private and away from public view on the BungeeBones website but does not affect any features or operation of the script on your site.</h2>
<h2>The administrators at BungeeBones receive notice of your installation and will be monitoring the progress of the install. They are available to help with the install and you can use the contact form in the left menu at BungeeBones. They may also contact you if they see you are having difficulty.</h2>
</font>';

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
$msg= '<p style="text-align:left; font-size: 145%;">Get Widget (i.e. web directory) source code</p>';
$msg .=  '<p style="text-align:left; font-size: 145%;">The web directory source code is available for various web platforms such as WordPress, Joomla, Parked Domain Names and regular, custom coded php websites. Each platform version is fully functional when installed at the location you specified in your configuration. Each will produce a category and link filled directory immediately after installation to your website at the location you specified. Those categories and links will be updated in real time from the BungeeBones server. Web directory management to review and update link and category information is included free of charge.</p>
';
$msg .= '<a name="custom"></a> <table bgcolor="gray"><tr><td><h1 style="color: #E1D7D7;"><a href="widget_index_custom.php?link_selected='.$link_selected.'&type='.$type.'"><u>Installation Instructions For Custom Coded PHP Websites</U></h1></a><p style="text-align:left; font-size: 125%;"> <br>This version of BungeeBones is designed for custom coded websites and enables the installation of the web directory on its own webpage within the website. Your site visitors will be able to click a "Links" or "Web Directory" button and be taken to the web directory of categories and links that will be fully branded to your own site and appears totally as your web page and web directory.</td></tr> </table><p align="center"><br> ';

$msg .= '<a name="parked"></a> <table bgcolor="gray"><tr><td><h1 style="color: #E1D7D7;"><a href="../parked_domains/index.php?link_selected='.$link_selected.'&type='.$type.'"><u>Installation Instructions For Parked Domains And Websites</U></h1></a><p style="text-align:left; font-size: 125%;"> <br>This version of BungeeBones is designed for a parked domain to display a web directory page.

<p style="text-align:left;">You can park a domain name for free at BungeeBones and might even earn income to boot. Parked domains are eligible to earn income by sales of paid links and by recruiting of websites that install the directory.

There is no coding or anything to install. We will build a webpage holding a web directory personalized to you so that anytime someone registers and adds their link they become your customer that you can earn commissions from. </td></tr> </table><p align="center"> ';

/*$msg .=   '<a name="facebook"></a> <p>&nbsp;</p><table bgcolor="gray"><tr><td><h1 style="color: #E1D7D7;"><a href="widget_index_fb.php?link_selected='.$link_selected.'"><u>The FaceBook Version</u></h1></a><p style="text-align:left; ">Get a complete web directory for your FaceBook site. Let your friends add and organize their links into categories and help promote their websites. Visit the BungeeBones app at <a href="http://apps.facebook.com/bungeebones">The FaceBook Site</a> and click the "Get My Own Directory" link in the top menu. <br>

<!--<a style="color: white;" href="facebook/widget_overview.php?link_selected='. $link_selected.'" title="Overview" >Overview</a> | <a style="color: white;" href="facebook/plugin_install.php?link_selected='. $link_selected.'" title="Install Location" >Install App</a> 

</p></td></tr><tr><td><iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fbungeebones.com%2Fbungee_jumpers%2Freg_form%2Fwidget_index_main.php&amp;layout=standard&amp;show_faces=false&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:35px;" allowTransparency="true"></iframe></td></tr></table>';*/


$msg .=   '<a name="wordpress"></a> <p>&nbsp;</p><table bgcolor="gray"><tr><td><h1 style="color: #E1D7D7;"><a href="widget_index_wp.php?link_selected='.$link_selected.'&type='.$type.'"><u>The WordPress Version</u></a></h1><p align="left">The Wordpress plugin lets you install BungeeBones into your WordPress blog. It can be another great way to monetize your blog and writing. <p align="center"></td></tr></table>

';

$msg .=   '<a name="joomla"></a> <p>&nbsp;</p><table bgcolor="gray"><tr><td><h1 style="color: #E1D7D7;"><a href="widget_index_joom.php?link_selected='.$link_selected.'&type='.$type.'">The Joomla Version</a></h1> Get a complete web directory for your Joomla site. Let your friends add and organize their links into categories and help promote their websites through the BungeeBones network.</p>
<p>There are instructions to install the web directory into Joomla either as a component or as an external page (similar to installing in a custom php site). 
</td></tr></table><br>';
//the next commented out links were replaced in each individual version
//$msg .=   '<p style="text-align:left; font-size: 125%;"><a href="widget_config.php?link_selected='.$link_selected.'">Customize Your Web Directory</a> After you get the directory working properly on your website use this form to customise it to your website and make some other decisions about how you want to use it.';

//$msg .= '<p style="text-align:left; font-size: 125%;"><a href="widget_edit.php?link_selected='.$link_selected.'">Re-Locate Your Widget/Web Directory To A Different Location On Your Website</a> You can move your web directy installation to a different folder or change its file name here just by entering it\'s new folder or file name.';

echo $msg;
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';


include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");

} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
