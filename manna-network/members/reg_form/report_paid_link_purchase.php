<?php
//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) baby_widget

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

//print_r($_POST);
	if (isset($_GET['link_selected'])){  //$link_selected is name comming from user control panel and is GET
	$baby_widget=$_GET['link_selected']; //changed it to $baby widget in the form and rest of this page except for above
	//echo '<br> in GET baby widget = ', $baby_widget;
}                                // its parent will be called parent widget and parent num is the parent widget's id in widgets
	elseif (isset($_POST['baby_widget'])){
	$folder_name = $_POST['folder_name'];
	$file_name= $_POST['file_name'];
	$baby_widget=htmlspecialchars($_POST['baby_widget']);
	}
$baby_widget = rtrim($baby_widget,"/");
$type=$_GET['type'];

//run that link id through widget table to see if already there (making this a modification rather than new)
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/connectloginmysqli.php");
$sql="select `id`, `file_name`, `folder_name` from `widgets` where `link_id` = '".$baby_widget."'";
$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);

	if($num_rows >0){
	$row = mysqli_fetch_array($result);
	$folder_name_pre = $row['folder_name'];
	$file_name_pre = $row['file_name'];
	}
$B1=$_POST['B1'];

//get the wdgts_lnk_num from users table (soon to be change to rarslink_num (short for registrars link num)
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2accusersconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `wdgts_lnk_num` from `users` where `user_id` = '$user_id'";//user id from access user
$result = @mysqli_query($connect, $sql);
	while($row = mysqli_fetch_array($result)){
	$future_widget_parents_link_num = $row['wdgts_lnk_num'];
	}
if(isset($B1)){

include($_SERVER['DOCUMENT_ROOT']."/classes/commissions_class.php");

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");


$today = date("Y-m-d  H:i:s");//0000-00-00 00:00:00

		
			include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");
		$sql="UPDATE `widgets` SET `folder_name`= '".$_POST['folder_name']."', `file_name` = '".$_POST['file_name']."' WHERE `link_id` = ".$_POST['link_id'];
	
$result = @mysqli_query($connect, $sql);




		echo '<h1>Your configuration Change Was Successful. Your installed web directory script in the location you indicate should now be functioning properly. 

<br>Folder = '.$_POST['folder_name'].'
<br>File = '.$_POST['file_name'].'
</h1>
';

		echo '<p>
		<a target="_top" href="widget_index_custom.php?link_selected='.$baby_widget.'"> <h2><u>Return To Directory Management Index</u></h2></a>
		<a target="_top" href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';

		$message = "
		Name: BungeeBones Script Notice
		Link ID Number: $baby_widget;

		Message: There has been a edit performed on the previous registration of a widget. Here is the sql

		";

		$message .= $sql;

		//END OF INCOMING MESSAGE (this message goes to your inbox)

		$subject = "Message from your BungeeBones.com - Message was sent by automatic notification by script //subject OF YOUR //INBOX MESSAGE sent to you

		-----------------------------
		From: $Name:baby_widget
		E-mail: $Email
	
		Message: $Message

		-----------------------------
		";
		//END OF outgoing MESSAGE

		$nasaadresa = "info@BungeeBones.com";  //please replace this with your address

		mail($nasaadresa,"$subject","$message","From: BungeeBones Script Notice ");



		echo "$thanks";


		include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");
		//exit();
		
		
}
else
{

//retrieve current widget configurations
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

//get the widget id (which will become this new widgets parent num) from widget table
$sql="select  * from `widgets` where `link_id` = '".$_GET['link_selected']."'";
/*
Full texts 	id 	link_id 	is_parked 	is_registered 	parent 	lft 	rgt 	
time_period 	version 	start_clone_date 	last_update 	end_clone_date 	is_recip 	
is_niche 	wp_permalink_name 	folder_name 	file_name 	brand 	display_freebies 	
plugin 	custom_title1 	custom_title2 	meta_descrip 	keywords 	name 	click_tally 	
donate 	leaving_page 	cust_add_a_link 	cust_add_a_link_mo 	cust_add_a_link_ret 	
fontsize 	titlecolor 	linktextcolor 	catcolo*/
$result = @mysqli_query($connect, $sql);
	while($row = mysqli_fetch_array($result)){
	$folder_name	= $row['folder_name'];
$file_name	= $row['file_name'];
	}	

include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");
?>
<div style="
width: 50%;
margin: 0px auto 0px auto;">
<table bgcolor="gray" width="100%"><TR><TD>
<h1 style="text-align: center;">Edit Location Configuration Settings</h1>
<p style="text-align:left; font-size: 150%">These configuration settings notify our server where your web directory is installed. Our script then builds things on your web directory page specific to that location such as link urls. It is crucial for these settings to be made correctly (same spelling etc) for the web directory script to function.   </p>

<FORM action="<? echo $_SERVER['PHP_SELF'];?>" method="POST" target="_self">
<p align="left"><input type="hidden" name="link_id" value="<?echo $baby_widget; ?>" />

<?

	echo' <p style="text-align:left; "> Using the fictitious YourSite.com domain as an example (<b>replace YourSite.com with your own actual domain</b>), then, you can place the web directory at YourSite.com/foo.php, YourSite.com/foo/bar.php, YourSite.com/foo/foo/bar.php etc.
<ul><li>If you want to install it at YourSite.com/foo.php then enter the word "root" for the directory name/location in the form below.
</li><li>If you want to install it at YourSite.com/foo/bar.php then enter "foo" in the directory name/location and "bar.php" as the file location
</li><li>If you want to install it at YourSite.com/foo/foo/bar.php then enter "foo/foo" in the directory name/location and "bar.php" as the file location


</li></ul><p align="left">
	<br><b>Directory name/location </b><input  type="text" size="25"   value="'.$folder_name.'"  name="folder_name" id="folder_name" >
	
	 <p align="left"> Tell us the file name of the webpage (i.e the url, the file name etc) where you will be installing your new web on your website. IMPORTANT: Be sure that you add the .php file extension at the end of the file name and that your server supports PHP. </b></P>


	<p align="left"><b> File name/location	</b><input type="text" name="file_name"    size="25" id="file_name" value="'.$file_name.'">';

	
	//include('widget_version_select.php');
echo '<br><br><INPUT type="submit" name="B1" value="Submit">';

echo '<h2>Add your config and click "Submit" to complete the edit.</h2><p>
</TD></TR><tr><TD></TD><td></td></tr></table></div>
';
//include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");
}
} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
