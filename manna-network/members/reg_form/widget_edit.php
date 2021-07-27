<?php
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

if(isset($B1) AND $num_rows==1 AND $folder_name != "" AND $file_name != ""){
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
//include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connect.php");
//new db connection
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="update `widgets` set `folder_name` = '".$folder_name."', `file_name` = '".$file_name."' where `link_id` = '".$link_selected."'";

$result = @mysqli_query($connect, $sql);
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");
echo '<h1 align="center">Your Update Of Your Web Directory Location Configurations Was Successful</h1>';
echo '<p>

<a target="_top" href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';



include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");
exit();
}
else
{
//include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/reg_form/template_explo_top_mini.php");
?>
<table bgcolor="gray"><TR><TD>
<h1>Location Configuration Settings</h1>
<p style="text-align:left; font-size: 150%">These configuration settings enable you to notify us (our server) where you are installing your web directory on your server. Our script then builds such things as its links and pages accordingly.   </p>
</TD></TR><tr><TD></TD><td></td></tr></table>
<FORM action="<? echo $_SERVER['PHP_SELF'];?>" method="POST" target="_self">
<p align="left"><input type="hidden" name="link_selected" value="<?echo $link_selected; ?>" />

<?
	if($num_rows < 1){
	echo' <p align="left"><b> Tell Us The Folder Name Of Where You Installed It (enter "root" w/o quotes if web directory is  	installed on home page).</b><p align="left">
				 <input  type="text" size="53"   value=""  name="folder_name" id="folder_name" >
	
	 <p align="left"><b> Tell us the file name of the webpage (i.e the url, the file name etc) where you saved your new web 	page template to (and where you pasted the code in) On Your Website. IMPORTANT: Be sure that you add the .php file 		extension at the end of the file name and that your server supports PHP. </b></P>


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
echo '<br><br><INPUT type="submit" name="B1" value="Submit">';

echo '<h2>Add your config and click "Submit" to complete the installation.</h2><p>
';
//include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");
}
} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
