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

if (isset($_GET['link_selected'])){  //$link_selected is name comming from user control panel and is GET
$baby_widget=$_GET['link_selected']; //changed it to $baby widget in the form and rest of this page except for above
}                                // its parent will be called parent widget and parent num is the parent widget's id in widgets
elseif (isset($_POST['baby_widget'])){
$folder_name= htmlspecialchars($_POST['folder_name']);
$file_name= htmlspecialchars($_POST['file_name']);
$baby_widget=htmlspecialchars($_POST['link_selected']);
}
$baby_widget = rtrim($baby_widget,"/");
$type=$_GET['type'];

//run that link id through widget table to see if already there (making this a modification rather than new)
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `id`, `file_name`, `folder_name` from `widgets` where `link_id` = '$baby_widget'";
$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);

if($num_rows >0){
$row = mysqli_fetch_array($result);
$folder_name_pre = $row['folder_name'];
$file_name_pre = $row['file_name'];
}
$B1=$_POST['B1'];

//get the upline num from users table (soon to be change to rarslink_num (short for registrars link num)
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2accusersconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `upline_num` from `users` where `user_id` = '$user_id'";//user id from access user
$result = @mysqli_query($connect, $sql);
while($row = mysqli_fetch_array($result)){
$future_widget_parents_link_num = $row['upline_num'];
}
if(isset($B1) AND $num_rows > 0){
include($_SERVER['DOCUMENT_ROOT']."/classes/commissions_class.php");




if($future_widget_parents_link_num==0){$future_widget_parents_link_num=3;//correct for bungeebones.com
}
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
//get the url from links so we humans can identify the widget in the table easier
$sql="select  `url` from `links` where `id` = '$baby_widget'";
$result = @mysqli_query($connect, $sql);
while($row = mysqli_fetch_array($result)){
$url	= $row['url'];
}
//get the widget id (which will become this new widgets parent num) from widget table
$sql="select  `id` from `widgets` where `link_id` = '$future_widget_parents_link_num'";
$result = @mysqli_query($connect, $sql);
while($row = mysqli_fetch_array($result)){
$parent_num	= $row['id'];
}	
$today = date("Y-m-d  H:i:s");//0000-00-00 00:00:00

if($num_rows < 1 AND $folder_name != "" AND $file_name != ""){ //this is a new baby widget
	
	include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");
$sql="INSERT into `widgets`(`link_id`, `parent`, `folder_name`, `file_name`, `time_period`, `version`, `start_clone_date`, `end_clone_date`, `display_freebies`) values('".$baby_widget."','".$parent_num."','".$folder_name."','". $file_name."', '8','".$url."','".time()."','".$today."','display_freebies' )";
$result = @mysqli_query($connect, $sql);

//need to add update tree here. Even if they aren't approved they stll shold get credit for any links added and they won't if the tree isn't updated here.
//new
//include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/reg_form/rebuildtree.php");
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/widget_mgr/widget_tree_mgmt_class.php");

$parent=0;
$lft=1;
$rebuild = new widget_tree_mgmt;
$rebuild->rebuildTree($parent, $lft);

echo '<h1>Your configuration Step 1 Was Successful. If you have already installed the web directory script in the location you indicate it should be functioning properly at this point. You can Customize Your Installation by Returning To The Management Index Page</h1>
<p>The button to the right of your link now reads "Manage". Click there and follow the different options for customizing your installation and branding it to your website. ';

echo '<p>
<a target="_top" href="widget_index_custom.php?link_selected='.$baby_widget.'"> <h2><u>Return To Directory Management Index</u></h2></a>
<a target="_top" href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';

$message = "
Name: BungeeBones Script Notice
Link ID Number: $baby_widget;

Message: There has been a new registration of a widget. Here is the sql

";

$message .= $sql;

//END OF INCOMING MESSAGE (this message goes to your inbox)

$subject = "Message from your BungeeBones.com - Message was sent by automatic notification by script //subject OF YOUR //INBOX MESSAGE sent to you

-----------------------------
From: $Name:
E-mail: $Email
	
Message: $Message

-----------------------------
";
//END OF outgoing MESSAGE

$nasaadresa = "info@BungeeBones.com";  //please replace this with your address

mail($nasaadresa,"$subject","$message","From: BungeeBones Script Notice ");



echo "$thanks";


include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");
exit();
}

else 
{
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");
echo 'You submitted the form without giving the location where it will be installed so it has not been properly configured and will not function. Use the browser back button and fill in the two required fields.';
echo '<p>
<a target="_top" href="widget_index_custom.php?link_selected='.$baby_widget.'"> <h2><u>Return To Directory Management Index</u></h2></a>
<a target="_top" href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';



include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");
exit();
}

}
elseif(isset($B1) AND $num_rows==1 AND $folder_name != "" AND $file_name != ""){
echo '<h3>line 174 before IF </h3>', $parent_num,$baby_widget,$parent_num,$folder_name, $file_name;
	
//$sql="update `widgets` set `folder_name` = '".$folder_name."', `file_name` = '".$file_name."' where `link_id` = '".$baby_widget."'";
$sql="update `widgets` set`link_id` = '".$baby_widget."' , `parent` = '". $parent_num."', `folder_name` = '".$folder_name."', `file_name` = '".$file_name."', `time_period` = '8', `version` = '".$url."', `last_update` = '".time()."', `end_clone_date` = '".$today."', `display_freebies` = 'display_freebies' where `link_id` = '".$baby_widget."'";
echo '<h3>line 174 widget install </h3>', $sql;
$result = @mysqli_query($connect, $sql);
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/widget_mgr/widget_tree_mgmt_class.php");

$parent=0;
$lft=1;
$rebuild = new widget_tree_mgmt;
$rebuild->rebuildTree($parent, $lft);
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");
echo '<h1 align="center">Your Update Of Your Web Directory Location Configurations Was Successful</h1>';
echo '<p>
<a target="_top" href="widget_index_custom.php?link_selected='.$baby_widget.'"> <h2><u>Return To Directory Management Index</u></h2></a>
<a target="_top" href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';

$message = "
Name: BungeeBones Script Notice
Link ID Number: $baby_widget;

Message: There has been an update of a widget\'s configuration.
The sql is below:
";
$message .= $sql;

//END OF INCOMING MESSAGE (this message goes to your inbox)

$subject = "Message from your BungeeBones.com - Message was sent by automatic notification by script //subject OF YOUR //INBOX MESSAGE sent to you

-----------------------------
From: $Name:
E-mail: $Email
	
Message: $Message

-----------------------------
";
//END OF outgoing MESSAGE

$subject = 'Message from your BungeeBones.com - Message was sent by automatic notification by script' ;//subject OF YOUR 
//END OF outgoing MESSAGE

$nasaadresa = "info@BungeeBones.com";  //please replace this with your address

mail($nasaadresa,"$subject","$message","From: BungeeBones Script Notice ");

echo "$thanks";

include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");
exit();
}
else
{ 
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/reg_form/template_explo_top_mini.php");
?>
<table style = "margin-left:auto; 
    margin-right:auto;" width="75%" bgcolor="gray"><TR><TD>
<h1>Location Configuration Settings</h1>
<? if($type == 'start_up'){
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
echo '<h3>line 252 baby widget just before form = ', $baby_widget;
?>
<p style="text-align:left; font-size: 150%">These configuration settings below enable you to notify us (our server) where you are installing your web directory on your server. Our script then builds such things as its links and pages accordingly.   </p>
</TD></TR><tr><TD></TD><td></td></tr>
<tr><TD colspan="2">

<FORM action="<? echo $_SERVER['PHP_SELF'];?>" method="POST" target="_self">
<p align="left"><input type="hidden" name="baby_widget" value="<?echo $baby_widget; ?>" />
<?
if($num_rows < 1){
echo' <p align="left"><b> Tell Us The Folder Name Of Where You Installed It</b><p align="left">
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
&nbsp; &nbsp;<input type="text" name="file_name"    size="25" id="file_name" value="'.$file_name_pre.'">';
echo $msg;
}
echo '<p><INPUT type="submit" name="B1" value="Submit"></form>';

echo '<h2>Add your config and click "Submit" to proceed to step two.</h2><p>
<a target="_top" href="widget_index_custom.php?link_selected='.$baby_widget.'"> <h2><u>Return To Installation Management Index</u></h2></a>
<a target="_top" href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>

</TD></tr></table>';
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");
}
} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
