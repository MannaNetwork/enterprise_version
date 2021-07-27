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
<p style="text-align:left; font-size: 150%">The finished product (after installation (i.e. the BungeeBones Web Directory)) provides the categories and links to the web directory on your website live and in real-time for each request that your site visitor makes and delivers the links that have been registered and inspected  and are stored at the BungeeBones.com server. </p>
<p style="text-align:left; font-size: 150%">There are a few things we need to do to accomplish the communication and the exchange of information. Basically your website page needs to tell us who it is and what it wants. We deliver a webpage written specifically for that website according to the configurations you are about to make.
<!--
<h2>Since you are installing it in a WordPress site you would perform these steps</h2>
<ul><LI>Have a link registered in BungeeBones </LI><li>Add the BungeeBones plugin to your WordPress  from the Wordpress repository</li><li>Create A WordPress page to house the published web directory</li><li>Configure at the Wordpress end so it uniquely identifies itself to BungeeBones</li><li>Configure at the BungeeBones end to tell us where your web directory is installed</li><li>Lastly there are optional items - configure these to customise your web directory</li></ul>
-->
<h2>Since you are installing it in a custom php site you would perform these steps</h2>
<ul><LI>Have a link registered in BungeeBones </LI><li>Create a template page to house the published web directory with your own menu, head and footer sections. </li><li>Add the Bungeebones Web Directory code somewhere in the "&lt;body&gt;" section</li><li>Configure your page so it uniquely identifies itself to BungeeBones</li><li>Set configuration at the BungeeBones end to tell us where your web directory is installed</li><li>Lastly, possibly do some optional items - configure a few more to customise your web directory.</li></ul>





<p style="text-align:left; font-size: 150%">









We have organized the instructions so that they discuss each of those areas independently. They have screenshots to help you locate and insert the information it needs to function. The last link in the instructions is a trouble shooting page that shows some common errors and describes the cures. And, if you have a problem there is the contact form where you can let us know. we are glad to help with the installs.


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
echo '<p><a target="_top" href="plugin_install.php?link_selected='.$link_selected.'"> <h2><u>Next Section Of Install Series</u></h2></a>
<a target="_top" href="widget_index_main.php?link_selected='.$link_selected.'#wordpress"> <h2><u>Return To Directory Management Index</u></h2></a>
<a target="_top" href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");
}
} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
