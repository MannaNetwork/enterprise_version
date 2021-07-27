<?php
//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) baby_widget


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
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
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
//get the url from links so we humans can identify the widget in the table easier
$sql="select  `url` from `links` where `id` = '".$baby_widget."'";
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
if($future_widget_parents_link_num==0 OR $future_widget_parents_link_num==1){$parent_num=3;//correct for bungeebones.com
	}

$today = date("Y-m-d  H:i:s");//0000-00-00 00:00:00

		if($num_rows < 1 AND $folder_name !== "" AND $file_name !== ""){ //this is a new baby widget
	
			
		$sql="INSERT into `widgets`(`link_id`, `parent`, `folder_name`, `file_name`, `time_period`, `version`, `start_clone_date`, `end_clone_date`, `display_freebies`) values('".$baby_widget."','".$parent_num."','".$folder_name."','". $file_name."', '8','".$url."','".time()."','".$today."','display_freebies' )";
		//id 	link_id 	is_parked 	is_registered 	parent 	lft 	rgt 	time_period 	version 	start_clone_date
		//last_update 	end_clone_date Descending 	is_recip 	is_niche 	wp_permalink_name 	folder_name 	file_name
		//brand 	display_freebies 	plugin 	custom_title1 	custom_title2 	meta_descrip 	keywords 	name 	click_tally
		//donate 	leaving_page 	cust_add_a_link
		//cust_add_a_link_mo 	cust_add_a_link_ret 	fontsize 	titlecolor 	linktextcolor 	catcolor
		$result = @mysqli_query($connect, $sql);
		
		include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/widget_mgr/widget_tree_mgmt_class.php");

		
$parent=0;
$lft=1;
$rebuild = new widget_tree_mgmt;
$rebuild->rebuildTree($parent, $lft);

		echo '<h1>Your configuration Step 1 Was Successful. If you have already installed the Template Version of the web directory script in the location you indicate it should be functioning properly at this point. If You can Customize Your Installation by Returning To The Management Index Page</h1>
		<p>The button to the right of your link now reads "Manage". Click there and follow the different options for customizing your installation and branding it to your website. ';

		echo '<h1>Close This Modal To Return</h1>';

		$message = "
		Name: BungeeBones Script Notice
		Link ID Number: $baby_widget;

		Message: There has been a new registration of a widget. Here is the sql

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


		
		//exit();
		}

		elseif($num_rows ==1){

		echo '<h1 style="color: RED;">You already have web directory status enabled for that link.</h1>';
		echo '<h1>Close This Modal To Return</h1>';



		
		}
		else
		{
		
		echo '<h1 style="color: RED;">You submitted the form without giving the location where it will be installed so it has not been properly configured and will not function. Use the browser back button and fill in the two required fields.</h1>';
		echo '<h1>Close This Modal To Return</h1>';



		
		//exit();
		}
}
else
{

?>
<div style="
width: 70%;
margin: 0px auto 0px auto;">
<table bgcolor="gray" width="100%"><TR><TD>
<h1 style="text-align: center;">Location Configuration Settings</h1>
<p style="text-align:left; font-size: 150%">These configuration settings notify our server where your web directory is installed. Our script then builds things on your web directory page specific to that location such as link urls. It is crucial for these settings to be made correctly (same spelling etc) for the web directory script to function.   </p>

<FORM action="<? echo $_SERVER['PHP_SELF'];?>" method="POST" target="_self">
<p align="left"><input type="hidden" name="baby_widget" value="<?echo $baby_widget; ?>" />

<?

	echo' <p align="left"><b> Tell Us The Folder Name Of Where You Will Be Or Did Install It (enter "root" w/o quotes if web directory is not to be installed in a folder (i.e. will be on the same level as the home page).</b><p align="left">
				 <input  type="text" size="23"   value=""  name="folder_name" id="folder_name" >
	<p align="left">&nbsp;</p>
<p align="left">&nbsp;</p>
<p align="left">&nbsp;</p>
	 <p align="left"><b> Tell us the file name of the webpage (i.e the url, the file name etc) where you will be installing your new web on your website. IMPORTANT: Be sure that you add the .php file extension at the end of the file name and that your server supports PHP. </b></P>


	<p align="left"><b> <input type="text" name="file_name"    size="25" id="file_name" value="">';

	
	//include('widget_version_select.php');
echo '<br><br><INPUT type="submit" name="B1" value="Submit">';

echo '<h2 style="color: navy;">Add your config and click "Submit" to complete the installation.</h2><p>
</TD></TR><tr><TD></TD><td></td></tr></table></div>
';

}
} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

