<?php
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
elseif (isset($_POST['link_selected'])){
$folder_name= htmlspecialchars($_POST['folder_name']);
$file_name= htmlspecialchars($_POST['file_name']);
$link_selected=htmlspecialchars($_POST['link_selected']);
}
$link_selected = rtrim($link_selected,"/");

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `id`, `file_name`, `folder_name` from `widgets` where `link_id` = '$link_selected'";

$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);

if($num_rows >0){
$row = mysqli_fetch_array($result);
$folder_name_pre = $row['folder_name'];
$file_name_pre = $row['file_name'];
}
$B1=$_POST['B1'];

if(isset($B1) AND $num_rows < 1){

//include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");
if($num_rows <1 AND $folder_name != "" AND $file_name != ""){
$sql="INSERT into `widgets`(`link_id`, `folder_name`, `file_name`) values('".$link_selected."','".$folder_name."','". $file_name."')";

$result = @mysqli_query($connect, $sql);
}

else
{
echo 'You submitted the form without giving the location where it will be installed so it has not been properly configured and will not function. Use the browser back button and fill in the two required fields.';

}
exit();
}
elseif(isset($B1) AND $num_rows==1 AND $folder_name != "" AND $file_name != ""){
$sql="update `widgets` set `folder_name` = '".$folder_name."', `file_name` = '".$file_name."' where `link_id` = '".$link_selected."'";

$result = @mysqli_query($connect, $sql);
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");
echo '<h1 align="center">Your Update Of Your Web Directory Location Configurations Was Successful</h1>';
echo '<p>
<a target="_top" href="widget_index_main.php?link_selected='.$link_selected.'"> <h2><u>Return To Directory Management Index</u></h2></a>
<a target="_top" href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';



include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");
exit();
}
else
{
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/reg_form/template_explo_top_mini.php");
?>
<table bgcolor="gray"><TR><TD>
<h1>Installation Process Overview</h1>
<p style="text-align:left; font-size: 150%">The BungeeBones Web Directory can be installed on your  Wordpress website easily using the WordPress Plugin Installation process.  
<ul><LI>You have to have a link registered in BungeeBones 
<?
if($link_selected != ""){echo'(DONE - Your link ID is '.$link_selected.')';
}
?>

</LI><li>You have to install the BungeeBones plugin to your WordPress installation</li><li>You need to create A WordPress page to house the published web directory and put '[bungeebones_directory]' (without the quotes) somewhere on the page.</li><li>You click the BungeeBones link in your left menu of your WP dashboard. Click the "Registered" option there under BungeeBones (in the left menu of the WP Dashboard).</li><li>After you get it installed there are a few extra custom configurations available from the "Manage" button to the left of your link in the <b>BungeeBones User Control Panel</b> (not the WordPress menu) - configure these to customize your web directory</li></ul>
<p style="text-align:left; font-size: 150%">We have instructions with screenshots to help you locate and insert the information it needs to function. The last link in the instructions is a trouble shooting page that shows some common errors and describes the cures. And, if you have a problem, there is the contact form where you can let us know. We are glad to help with the installs.
<p><a target="_top" href="plugin_install.php?link_selected='.$link_selected.'"> <h2 align="center"><u> Go To Next Section Of Install Series</u></h2></a>

</TD></TR><tr><TD></TD><td></td></tr></table>
<FORM action="<? echo $_SERVER['PHP_SELF'];?>" method="POST" target="_self">
<p align="left"><input type="hidden" name="link_selected" value="<?echo $link_selected; ?>" />
<?
/*if($num_rows < 1){
echo' <p align="left"><b> Tell Us The Permalink Name Of Where You Installed It</b><p align="left">If your WordPress script is installed at root level then enter the word "root" (without the quotes) as the folder/directory name
			 <input  type="text" size="53"   value=""  name="folder_name" id="folder_name" >
	
 <p align="left"><b> Select A Name For The Webpage (i.e the url, the file name etc) That You Will Call The File On Your Website. IMPORTANT: Be sure that you add the .php file extension at the end of the file name and that your server supports PHP. </b></P>


<p align="left"><b> <input type="text" name="file_name"    size="25" id="file_name" value="">';
}
else
{
$msg = 'Our records indicate you have already configured for a web directory to be installed at '.$folder_name_pre."/".$file_name_pre.'. Adding new information in the form will overwrite those settings and any files installed there will no longer work properly. If you intend to move your installed directory then go ahead and change the folder and/or file names ... otherewise leave these settings to keep the directory at its current location.
<p>Enter a new folder name or ignore.
<input  type="text" size="53"   value="'.$folder_name_pre.'"  name="folder_name" id="folder_name" >
<p>Enter a new file name or ignore.
<p align="left"><b> <input type="text" name="file_name"    size="25" id="file_name" value="'.$file_name_pre.'">';
echo $msg;
}
	//include('widget_version_select.php');
echo '<INPUT type="submit" name="B1" value="Submit">';
*/
echo '
<a target="_top" href="widget_index_wp.php?link_selected='.$link_selected.'#wordpress"> <h2><u>Return To Directory Management Index</u></h2></a>
<a target="_top" href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");
}

} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
