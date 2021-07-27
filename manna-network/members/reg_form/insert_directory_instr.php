<?
if (isset($_GET['action']) && $_GET['action'] == "log_out") {
	//$test_page_protect->log_out(); // the method to log off
echo '<h1>in Logout - Session Destroy</h1>';
session_start();
session_destroy();
}
// include the configs
require_once($_SERVER['DOCUMENT_ROOT']."/members/config/config.php");

    
// load the login class

// load php-login components
require_once($_SERVER['DOCUMENT_ROOT']."/members/php-login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

 
    
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...


$user_id = $_SESSION['user_id'];

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
//include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connect.php");
//new db connection
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

$B1 = $_GET['B1'];

if(isset($B1)){
/////////////////////////////////////////////////

$link_selected = $_GET['link_selected'];
$code_type = $_GET['code_type'];
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");

?>

<script>

/*
Check required form elements script-
By JavaScript Kit (http://javascriptkit.com)
Over 200+ free scripts here!
*/

function checkrequired(which){
var pass=true
if (document.images){
for (i=0;i<which.length;i++){
var tempobj=which.elements[i]
if (tempobj.name.substring(0,8)=="required"){
if (((tempobj.type=="text"||tempobj.type=="textarea")&&tempobj.value==''||tempobj.value=="http://")||(tempobj.type.toString().charAt(0)=="s"&&tempobj.selectedIndex==-1)){
pass=false
break
}
}
}
}
if (!pass){
alert("One or more of the required elements are not completed. Please complete them, then submit again!")
return false
}
else
return true
}
</script>


<div id="doc2">					
	<div style="text-align: center; id=hd">
	<div style="text-align: center">
	
	
<div style="text-align: center;">
   				<a href="http://bungeebones.com/bungee_jumpers/" class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/reg_form" class="cssbutton sample a"><span>Add Link</span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/reports" class="cssbutton sample a"><span>  Reports </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/update_user.php" class="cssbutton sample a"><span> Your Profile </span></a>&nbsp;<a href="http://bungeebones.com/feedback.php" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="http://bungeebones.com/articles/terms_of_service.php/" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
					</div><div id="bd">

<form name="form1" method="GET" action="http://bungeebones.com/bungee_jumpers/reg_form/insert_directory_instr.php"  onSubmit="return checkrequired(this)">
							 
				

		

<div id="display"></div>
<?
//////////////////////////////////////////////////
//$register_info = new mobile; deactivated 07/08/10


if($_GET['folder_name']){
$folder_name =$_GET['folder_name'];
echo '<div style="font-size: 150%;">folder_name = ', $folder_name;

	if($_GET['file_name']){
	$file_name=$_GET['file_name'];
	echo '<br>file_name = ', $file_name;
	}
	else
	{
	echo 'ERRROR: You entered a folder name to hold your distributed web directory but you did not name the file. Please return and add a name such as "index.php" being sure to use a php extension';
	}
	if($_GET['custom_title1']){
	$custom_title1 = $_GET['custom_title1'];
	echo '<br>custom_title1 = ', $custom_title1;
	}
	else
	{
	echo 'ERRROR: You entered a folder name to hold your distributed web directory and/or a file name but you did not enter a first half of your custom title. Though the script will work without one you might be losing some valuable SEO features by omitting it.';
	
	}
	if($_GET['custom_title2']){
	$custom_title2 = $_GET['custom_title2'];
	echo '<br>custom_title2 = ', $custom_title2;
	}
	else
	{
	echo 'ERRROR: You entered a folder name indicating an interest to host a distributed web directory but you did not enter a second half of your custom title. Though the script will work without one you might be losing some valuable SEO features by omitting it.';
	
	}
/*
if($_GET['brand']){
$brand = $_GET['brand'];
	
echo '<br>You selected the  ';
		if($brand=="adv"){
		echo "AdvertiSite brand";
		}
		else
		{
		
		echo "BungeeBones brand";
		}

	}
	else
	{
	echo 'ERRROR: You entered information indicating an interest to host a distributed web directory but you did not select which brand you wanted (i.e. BungeeBones or AdvertiPage). The default brand is BungeeBones. If you click "continue" you will receive code from the BungeeBones brand. If that is not what you want then click the back button and select the AdvertiPage brand..';
	
	}*/


$findme   = '?page_id=';
$pos = strpos($file_name, $findme);

// Note our use of ===.  Simply == would not work as expected
// because the position of 'a' was the 0th (first) character.
if ($pos !== false) {
    echo "<p>&nbsp;</p><p>The file name '$findme' is of the same format as that used in a WordPress installation. <br>If this is, indeed a WordPress installation do you want BungeeBones to create and write the pluggin's  bunbones_config.php file for you?<p>If yes check here <input type='checkbox' name='is_WP' value='1'> ";
} 

echo '</div>';
}else
{
echo'<p>&nbsp;</p><p>&nbsp;</p><div style="font-size: 150%;"><h2>You didn\'t enter required information)';
exit();
}
							


$display_freebies = $_GET['display_freebies'];

$time_period = $_GET['time_period'];
echo '<p>&nbsp;</p><div><form action="<?= $_SERVER[';
echo "'PHP_SELF']?>";
echo ' id="searchform" method="post">';
										     
										



	
		echo ' 	<input type="hidden" name="link_selected" value="'.  $link_selected .'">
		<input type="hidden" name="code_type" value="'.  $code_type .'">	
<input type="hidden" name="brand" value="'. $_GET['brand'].'">';
if($_GET['folder_name']){
echo '
<input type="hidden" name="folder_name" value="'. $_GET['folder_name'] .'">
<input type="hidden" name="file_name" value="'. $_GET['file_name'] .'">
<input type="hidden" name="custom_title1" value="'. $_GET['custom_title1'] .'">
<input type="hidden" name="custom_title2" value="'. $_GET['custom_title2'] .'">
<input type="hidden" name="display_freebies" value="'. $_GET['display_freebies'].'">
<input type="hidden" name="meta_descrip" value="'. $_GET['meta_descrip'].'">
<input type="hidden" name="keywords" value="'. $_GET['keywords'].'">';

	if($_GET['display_freebies']=1){
	echo'
	<input type="hidden" name="time_period" value="'. $_GET['time_period'].'">';
	}
}


$sql = "SELECT `url`, `category` FROM `links` WHERE `url`='$url'";

$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 3 Account' query");
	do
	{
	$test_url = $row['url'];
$existing_categories[] = $row['category'];
	}while ($row = mysqli_fetch_array($result));
	$test_url_lower = strtolower($test_url);
	$url_lower = strtolower($url);
	

		
echo'
<INPUT TYPE="button" VALUE="Go Back" onClick="history.back()">
			<input type="submit" value="Continue and Finish" name="CC1">
			</FORM></div>
';


?>
</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
	<div id="ft">
	<div style="text-align: center"><a href="http://BungeeBones.com">HOME</a>  <a href="http://BungeeBones.com/articles">ARTICLES</a>  <a href="http://BungeeBones.com">FAQ </a>	 <a href="http://BungeeBones.com/feedback.php"> CONTACT US </a>  <a href="http://BungeeBones.com/bungee_jumpers/reg_form">REGISTER</a>  <a href="http://BungeeBones.com/bungee_jumpers/login.php">LOGIN</a></div>
                                                                                                                                                                                                                                                                                                                

<div style="text-align: center"><a href="http://BungeeBones.com/bungee_bones">OUR LINK EXCHANGE/DIRECTORY</a> <a href="http://BungeeBones.com/subscription_sites">EXAMPLE SITES</a> </div><a target="_blank" href="http://twitter.com/Bungeebones">BB TWITTER </a>


  
</div>

</div>
</div>

<?
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");

exit();
}//close ifisset$B1

$C1 = $_GET['C1'];
$CC1 = $_GET['CC1'];
if(isset($CC1)){
/////////////////////////////////////////////////

$link_selected = $_GET['link_selected'];
$code_type = $_GET['code_type'];
$is_WP = $_GET['is_WP'];

include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");

?>

<script>

/*
Check required form elements script-
By JavaScript Kit (http://javascriptkit.com)
Over 200+ free scripts here!
*/

function checkrequired(which){
var pass=true
if (document.images){
for (i=0;i<which.length;i++){
var tempobj=which.elements[i]
if (tempobj.name.substring(0,8)=="required"){
if (((tempobj.type=="text"||tempobj.type=="textarea")&&tempobj.value==''||tempobj.value=="http://")||(tempobj.type.toString().charAt(0)=="s"&&tempobj.selectedIndex==-1)){
pass=false
break
}
}
}
}
if (!pass){
alert("One or more of the required elements are not completed. Please complete them, then submit again!")
return false
}
else
return true
}
</script>


<div id="doc2">					
	<div style="text-align: center; id=hd">
	<div style="text-align: center">
	
	
<div style="text-align: center;">
   				<a href="http://bungeebones.com/bungee_jumpers/" class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/reg_form" class="cssbutton sample a"><span>Add Link</span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/reports" class="cssbutton sample a"><span>  Reports </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/update_user.php" class="cssbutton sample a"><span> Your Profile </span></a>&nbsp;<a href="http://bungeebones.com/feedback.php" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="http://bungeebones.com/articles/terms_of_service.php/" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
					</div><div id="bd">

<form name="form1" method="GET" action="http://bungeebones.com/bungee_jumpers/reg_form/insert_directory_instr.php"  onSubmit="return checkrequired(this)">
							 
				

		

<div id="display"></div>
<?

	
		echo ' 	<input type="hidden" name="link_selected" value="'.  $link_selected .'">
		
<input type="hidden" name="brand" value="'. $_GET['brand'].'">';
if($_GET['folder_name']){
echo '
<input type="hidden" name="folder_name" value="'. $_GET['folder_name'] .'">
<input type="hidden" name="file_name" value="'. $_GET['file_name'] .'">
<input type="hidden" name="custom_title1" value="'. $_GET['custom_title1'] .'">
<input type="hidden" name="custom_title2" value="'. $_GET['custom_title2'] .'">
<input type="hidden" name="display_freebies" value="'. $_GET['display_freebies'].'">
<input type="hidden" name="meta_descrip" value="'. $_GET['meta_descrip'].'">
<input type="hidden" name="keywords" value="'. $_GET['keywords'].'">';

	if($_GET['display_freebies']=1){
	echo'
	<input type="hidden" name="time_period" value="'. $_GET['time_period'].'">';
	}
}


if(!isset($is_WP)){
		echo'<table><tr><td style="text-align: left;" colspan="2"><h2> BungeeBones can supply you two methods to receive your code by. You can always access either set of code again by clicking the "Manage" button in the User Contol Panel in the right side of the table storing the link\'s information but for now we ask you to choose one.</h2>.</td></tr>
<tr><td>Option 1 - As A Template</td><td>Option 2 As BareBones</td></tr>
<tr><td style="text-align: left;">The template produces for you an entire web page in addition to the BungeeBones web directory and its categories.  It will not at al be pretty. It is designed so that you can easily see where BungeeBones is installed and where you can enter the parts of your website such as your header pictures and logos, your meus and sidebars and your footer. Your template will be fully functional however, and that can be a plus depending on your web skills. To download the template click the "Template" button below.</td><td style="text-align: left;">We also provide the code in what we call "Bare Bones" and it comes in two parts or snippets of code. One code goes in to your "head" area but does not replace your closing head tag, leaving room for your style info and some meta tags. If all that makes sense to you then it is far fatser and easier than Option 1. You just get one of your own pages ready as a template and insert BungeeBones into it. To get the BareBones version just click the BareBones button below</td</tr>
<tr><td>

			<input type="submit" value="Template" name="C1">
			</FORM></div>
</td><td>

			<input type="submit" value="BareBones" name="C1">
			</FORM></div>
</td></tr></table>.';
}
else//is a Wordpress pluggin and needs no code
{
echo'
<h1>The config file writing for WordPress is not quite finished. I do apologize, and want to get it finished ASAP. For now, though, if you continue, your setup will be complete on the BungeeBones end and you can follow the instructions in the readme or the BungeeBones blog at http://bungeebones.com/blog/?page_id=476";
<input type="submit" value="Write WordPress Config" name="C1">
			</FORM></div>';


}


?>
</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
	<div id="ft">
	<div style="text-align: center"><a href="http://BungeeBones.com">HOME</a>  <a href="http://BungeeBones.com/articles">ARTICLES</a>  <a href="http://BungeeBones.com">FAQ </a>	 <a href="http://BungeeBones.com/feedback.php"> CONTACT US </a>  <a href="http://BungeeBones.com/bungee_jumpers/reg_form">REGISTER</a>  <a href="http://BungeeBones.com/bungee_jumpers/login.php">LOGIN</a></div>
                                                                                                                                                                                                                                                                                                                

<div style="text-align: center"><a href="http://BungeeBones.com/bungee_bones">OUR LINK EXCHANGE/DIRECTORY</a> <a href="http://BungeeBones.com/subscription_sites">EXAMPLE SITES</a> </div><a target="_blank" href="http://twitter.com/Bungeebones">BB TWITTER </a>


  
</div>

</div>
</div>

<?
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");

exit();
}//close ifisset$B1

If(isset($C1)){

include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");

	$street=$_GET['street'];
	$zip=$_GET['zip'];
	$phone=$_GET['phone'];
	$brand=$_GET['brand'];
	$cat_id=$_GET['cat_id'];
	$url=$_GET['url'];
	$title=$_GET['title'];
	$link_description=$_GET['link_description'];
	$multiple=$_GET['multiple'];
$start_date = time();//entered in insert query - tells when link was added
	
if(isset($_GET['folder_name'])){
$folder_name= $_GET['folder_name'];
$file_name= $_GET['file_name'];
$custom_title1= $_GET['custom_title1'];
$custom_title2= $_GET['custom_title2'];
$display_freebies= $_GET['display_freebies'];
$time_period= $_GET['time_period'];

$meta_descrip = $_GET['meta_descrip'];
$keywords = $_GET['keywords'];
}
								
$link_selected = $_GET['link_selected'];
$code_type = $_GET['C1'];

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
//include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connect.php");
//new db connection
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
if($link_selected != ""){
//$query = "UPDATE `links` set `folder_name` = '$folder_name', `file_name`='$file_name' , `custom_title1` = '$custom_title1' , `custom_title2` = '$custom_title2' , `display_freebies` = '$display_freebies' , `brand` = '$brand' , `start_clone_date` = $start_date , `time_period` = $time_period, `meta_descrip` = '$meta_descrip', `keywords` = '$keywords' where id = $link_selected";
//check if this link has a widget registered at this location already
$query = "SELECT `folder_name`, `file_name`, `id` from `widgets` where `link_id` = '".$link_selected."' && `folder_name`= '". $folder_name. "' && `file_name`='". $file_name."'";

$result = @mysqli_query($connect, $query) or die("Couldn't execute 'Edit 405 Account' query");
$num_rows = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result)){
    $id=$row['id'];
     }
if($num_rows >0){
$query = "UPDATE `widgets` set `folder_name` = '$folder_name', `file_name`='$file_name' , `custom_title1` = '$custom_title1' , `custom_title2` = '$custom_title2' , `display_freebies` = '$display_freebies' , `brand` = '$brand' ,  `time_period` = $time_period, `meta_descrip` = '$meta_descrip', `keywords` = '$keywords' where  `id`=$id";
$result = @mysqli_query($connect, $query) or die("Couldn't execute 'Edit 408 Account' query");
$trans_type="update";
}
else
{
$query = "INSERT into `widgets` (`folder_name`, `file_name`, `custom_title1`, `custom_title2`, `display_freebies`, `brand`, `start_clone_date`, `time_period`, `meta_descrip`, `keywords`, `link_id`) values ('".$folder_name."','". $file_name."','".$custom_title1."','".$custom_title2."','".$display_freebies."','". $brand."','".  $start_date."','".  $time_period."','".  $meta_descrip."','". $keywords."','". $link_selected."')";
$result = @mysqli_query($connect, $query) or die("Couldn't execute 'Edit 414 Account' query");
$trans_type="insert";
}
$query2 = "INSERT into `widgets_change_log` (`trans_type`, `folder_name`, `file_name`, `custom_title1`, `custom_title2`, `display_freebies`, `brand`, `trans_date`, `time_period`, `meta_descrip`, `keywords`, `link_id`) values ('".$trans_type."','".$folder_name."','". $file_name."','".$custom_title1."','".$custom_title2."','".$display_freebies."','". $brand."','".  $start_date."','".  $time_period."','".  $meta_descrip."','". $keywords."','". $link_selected."')";
$result = @mysqli_query($connect, $query2) or die("Couldn't execute 'Edit 414 Account' query");

include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/widget_mgr/widget_tree_mgmt_class.php");
  $widg_tree_mng = new widget_tree_mgmt;
$widg_tree_mng->rebuildTree('1',1);

}


//$result = @mysqli_query($connect, $query) or die("Couldn't execute 'Edit 3 Account' query");

echo'	
<div style="text-align: center;">
   				<a href="http://bungeebones.com/bungee_jumpers/" class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/reg_form" class="cssbutton sample a"><span>Add Link</span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/reports" class="cssbutton sample a"><span>  Reports </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/update_user.php" class="cssbutton sample a"><span> Your Profile </span></a>&nbsp;<a href="http://bungeebones.com/feedback.php" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="http://bungeebones.com/articles/terms_of_service.php/" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
					</div>';

								
									echo '<div style="font-size: 175%; color:#000080; text-align: left; line-height: 200%"><p>Thank You! Your';

if($code_type !=="Write WordPress Config"){
 echo ' code';
}
else
{
 echo ' configuration';
}
echo ' was created successfully ';

if($code_type !=="Write WordPress Config"){
echo 'and is now awaiting your installation.</p><h1>Your code is below</h1>';
}
else
{
echo 'and is now awaiting the configuration of your own wp-content/plugins/bungeebones-remotely-hosted-web-directory/bunbones_config.php file. </p><h1>For further information please consult the installation pages at <a href="http://BungeeBones.com/blog">BungeeBones Blog</a></h1>';

}

echo'And remember! Just for installing the web directory you can get a 50% discount for any paid advertising you wish to place in BungeeBones plus the multi-level, residual income you will earn from both your own and your downline\'s paid link sales.';
if($code_type !=="Write WordPress Config"){
 echo 'Now simply copy and paste the following into a blank page in the location and named according to your configuration settings you just made..';
}
echo' <p>Thanks for using and contributing to BungeeBones web traffic volume to our other members.';



echo '<p>Sincerely,
<p>Robert Lefebure
<p>Owner/developer of BungeeBones<p>&nbsp;</p>';


echo'</div>';

//////////////////////////////////Begin the widget code form display////////////////////////////////////////////
if(!$folder_name==""){
if($code_type=="Template"){
?>
<p align="left">&nbsp;</p>
<p align="left">&nbsp;</p><p align="left">&nbsp;</p>
<h3 style="font-size: 150%; ">This Code Creates A Complete Page Template</h3>
<p>Copy and past the correspond parts of your your own existing web page (such as your logo, menu footer etc)into the template to make this look just like the rest of your site.</p>
<table border="1" cellpadding="5" cellspacing="0"  bordercolor="#C0C0C0" width="100%" id="AutoNumber1">
  <tr>
    <td>
		
		
		
<p  style="font-size: 150%; text-align: left;">
To create a BungeeBones Web Directory paste the code below into a completely empty web page at the location you just entered (i.e. at <?echo $url . "/" . $folder_name . "/" . $file_name ?>

. If your editor placed any code at all on the "empty" page you started then overwrite it all with this code.</p> <p align="left">&nbsp;</p><p align="left">&nbsp;</p><p align="left">&nbsp;</p><hr>
</td></tr><tr><td bgcolor="cccccc">		&lt;?php
		
    $var = explode(&quot;/&quot;, $_SERVER['PATH_INFO']);<br>
    //verify that the affiliate number below is yours to insure your affiliate 
    credit and payments<br>
    $affiliate_num = <?echo $link_selected?> ;<br>
    $affiliate_num_test = $var[1] ;//repnaming header_ID<br>
    $url_cat = $var[2] ;//repnaming header_ID<br>
    $cat_record_num = $var[3] ;//part 3 of cat series<br>
    $cat_page_total = $var[4] ;//part 2 of cat series<br>
    $cat_page_id = $var[5] ;//part 2 of cat series<br>
    $link_page_id = $var[6] ;//part 2 of link series<br>
    $link_page_total = $var[7] ;//part 3 of link series<br>
    $link_record_num = $var[8] ;//part 3 of link series<br>
    <br>
    <br>
 		?&gt;<br>
&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;<br>
	&lt;html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" dir="ltr"&gt;<br>
&lt;head&gt; <br>

&lt;? 
<br>
<br>
$file ="http://BungeeBones.com/make_header/dyn_hdr2.php/$url_cat/$affiliate_num";<br>

$ch = curl_init();<br>
curl_setopt($ch, CURLOPT_URL, $file);<br>
curl_setopt($ch, CURLOPT_HEADER, 0);<br>
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);<br>
$data = curl_exec($ch);<br>
curl_close($ch);<br>
echo($data);<br>
?&gt;<br>

 &lt;link rel="stylesheet" type="text/css" href="http://bungeebones.com/css/yahoo/reset.css" /&gt;<br>
 &lt;link rel="stylesheet" type="text/css" href="http://bungeebones.com/css/yahoo/base.css" /&gt;<br>
&lt;link rel="stylesheet" type="text/css" href="http://bungeebones.com/css/yahoo/fonts.css" /&gt;<br>
&lt;link rel="stylesheet" type="text/css" href="http://bungeebones.com/css/yahoo/grids.css" /&gt;<br>
///////////////////  add any of your own head info, body tag info,table, html, menu of your site here/////////<br>
///////////////////  add link to your own css file to over ride font style settings to match your site/////////
///////////////// start //// 
 <br>
&lt;/head&gt;
 <br>
&lt;body&gt;

 <br>
&lt;table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1" height="648"&gt;
 <br>
&lt;tr&gt;
 <br>
&lt;td width="100%" height="70" colspan="3"&gt;
 <br>
&lt;h2 align="center"&gt;Place A Directory Like This On Your Own Website&lt;/h2&gt;
 <br>
&lt;h2 align="center"&gt;Place Your Own Logo Here&lt;/h2&gt;
 <br>
&lt;h2 align="center"&gt;Dynamic Meta Data - Very Search Engine Friendly&lt;/h2&gt;
 <br>
&lt;h2 align="center"&gt;Link Exchange Managed For You By BungeeBones&lt;/h2&gt;
 <br>
&lt;h2 align="center"&gt;For information on the CSS grid system used in the head you can find it at &lt;a href="http://developer.yahoo.com/yui/">http://developer.yahoo.com/yui/&lt;/a&gt;&lt;/h2&gt;
<br>
&lt;h2 align="left"&gt;Here are a few tips for after you have the directory operating&lt;UL&gt;
&lt;li&gt;Immediately make a backup of what you have accomplished so far&lt;/li&gt;
&lt;li&gt;Start deleting unnecessary code from the example and "feel your way around"&lt;/li&gt;
&lt;li&gt;Make some more back ups, then make some more backups, then etc, etc&lt;/li&gt;
&lt;li&gt;finally, start inserting your own website's template info, menus etc&lt;li&gt;
&lt;/td&gt;
 <br>
&lt;/tr&gt;
 <br>
&lt;tr&gt; <br>
&lt;td width="16%" valign="top" height="509"&gt; <br>
&lt;p align="center"&gt;Place&lt;/p&gt; <br>
&lt;p align="center"&gt;Your&lt;/p&gt; <br>
&lt;p align="center"&gt;Menu&lt;/p&gt; <br>
&lt;p align="center"&gt;Info&lt;/p&gt; <br>
&lt;p align="center"&gt;Here&lt;/p&gt; <br>


&lt;td width="72%" height="509"&gt; <br>
&lt;p align="center"&gt; <br>
      
			<br>
&lt;?<br>
    //////////////////////////////////////////////<br>
		
		?&gt;

&lt;p align="left"&gt;&lt;font size="4" color="red"&gt;Verify Your Install
&lt;p align="left"&gt;Test 1: Verify your ID Number Is Accurate: Scroll over the links (i.e. the category names) in the directory below. Depending on your browser version you may simply be able to mouseover the category names to see the url or you may have to click one. Verify that they are working. If the main page loads, but the links are broken then please contact us.
&lt;p align="left"&gt;Test 2: And as a similar test to the above, click the ADD A Link banner at the bottom of the category display. A smaller window opens and explains they are about to leave your site. Similar to above mouseover or click the banner of the bottom of that page and check the url. Is there a number after the url to BungeeBones.com? If so, the install was a success.  If not, please review the instructions, troubleshooting page or contact us.
&lt;p align="left"&gt;Test 3: If the browser didn't blast you with error messages then the dynamic headers are probably fine but checking them now may help you with your customising work. Open up the different categories and subcategories and notice the Title bar in the browser. If you aren't sure what I mean, then look at the souce code of the different pages in their &lt;head&gt; section at their meta tag info. Look to see that the title, description, and metatags are displaying properly. The title should be displaying your custom title1 and custom title2 that you set in the configuration. The current category should be sandwhiched in between them and should also be a part of the keywords tag. The category should also appear at the front of the page description. 
<br>
<br>
//&lt;?
<br>
<br>
$file="http://Bungeebones.com/link_exchange/index.php/$affiliate_num/$url_cat/$cat_record_num/$cat_page_total/$cat_page_id/$link_page_id/$link_page_total/$link_record_num";<br>
$ch = curl_init();<br>
curl_setopt($ch, CURLOPT_URL, $file);<br>
curl_setopt($ch, CURLOPT_HEADER, 0);<br>
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);<br>
$data = curl_exec($ch);<br>
curl_close($ch);<br>
echo($data);<br>
    ////////////////////////////////////////////////////<br>
   ?&gt;
		</font><br>
	&lt;/td&gt; <br>	
		&lt;td&gt; <br>	right hand margin text here &lt;
		<br>	right hand margin text here 
		<br>	right hand margin text here 
		<br>	right hand margin text here 
		<br>	right hand margin text here 
		<br>	right hand margin text here 
		&lt;/td&gt; <br>	
		&lt;/tr&gt; <br>	
		&lt;tr&gt; <br>	
		&lt;td colspan="3"&gt; &lt;p align="center"&gt;	footer text here ---	footer text here --- footer text here &lt;/td&gt; <br>	
		&lt;/tr&gt; <br>	
		&lt;/table&gt; <br>	
		&lt;/body&gt; <br>	
			&lt;/html&gt; <br>	
	</td>
  </tr>
</table>	


<?

}//end code type template
elseif($code_type=="BareBones"){

////////////////////////////////////////////////////end the widegt code form display////////////////////////////

echo '<h1>Use The Next Two Blocks in Your Own Page template</h1>';
echo '<table border="1" cellpadding="5"><tr><td style="font-size: 150%">';
echo '<h3> Part One of BareBones Code </h3>';
echo '<p>Paste this code into one of your own website\'s template page\'s &lt;Head&gt; section, pasting over everything above the closing head tag (i.e. leave the original closing &lt;/head&gt; tag)';
echo "<p>&nbsp;</><p>&nbsp;</p>";

?>
</td></tr><tr><td bgcolor="#95B9C7">
		&lt;?php<br>
		
    $var = explode(&quot;/&quot;, $_SERVER['PATH_INFO']);<br>
    //verify that the affiliate number below is yours to insure your affiliate 
    credit and payments<br>
    $affiliate_num = <?echo $link_selected?> ;<br>
    $affiliate_num_test = $var[1] ;//repnaming header_ID<br>
    $url_cat = $var[2] ;//repnaming header_ID<br>
    $cat_record_num = $var[3] ;//part 3 of cat series<br>
    $cat_page_total = $var[4] ;//part 2 of cat series<br>
    $cat_page_id = $var[5] ;//part 2 of cat series<br>
    $link_page_id = $var[6] ;//part 2 of link series<br>
    $link_page_total = $var[7] ;//part 3 of link series<br>
    $link_record_num = $var[8] ;//part 3 of link series<br>
$regional_number = $var[9] ;//part 3 of link series<br>
    <br>
    <br>
		?&gt;<br>
&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;<br>
	&lt;html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" dir="ltr"&gt;<br>
&lt;head&gt;<br>

&lt;? <br>
<br>
<br>
$file ="http://BungeeBones.com/make_header/dyn_hdr2.php/$url_cat/$affiliate_num";<br>

$ch = curl_init();<br>
curl_setopt($ch, CURLOPT_URL, $file);<br>
curl_setopt($ch, CURLOPT_HEADER, 0);<br>
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);<br>
$data = curl_exec($ch);<br>
curl_close($ch);<br>
echo($data);<br>
?&gt;
<?
echo '</td></tr></table>';
echo '<table border="1" cellpadding="5"><tr><td style="font-size: 150%">';
echo '<h3>Part Two of BareBones Code</h3>';
echo '<p>Paste this code into the &lt;body&gt; of your own website\'s template page, pasting anywhere in the page you like.';
echo "<p>&nbsp;</><p>&nbsp;</p>";

?><br>
</td></tr><tr><TD bgcolor="#C9BE62">
&lt;?
<br>
<br>
$file="http://Bungeebones.com/link_exchange/index.php/$affiliate_num/$url_cat/$cat_record_num/$cat_page_total/$cat_page_id/$link_page_id/$link_page_total/$link_record_num";<br>
$ch = curl_init();<br>
curl_setopt($ch, CURLOPT_URL, $file);<br>
curl_setopt($ch, CURLOPT_HEADER, 0);<br>
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);<br>
$data = curl_exec($ch);<br>
curl_close($ch);<br>
echo($data);<br>
    ////////////////////////////////////////////////////<br>
   ?&gt;
	
<?
echo '</td></tr></table>';
?>
<h2 align="left">That Should Do It!!</h2>
<p align="left"> Check your work by opening <b>www.your-site.com/<?echo $folder_name;?>/<?echo $file_name;?> </b>with your browser. You should have a webpage there with a working and populated web directory. 
If you have any problems just drop us a message using the contact form in the menu.
<p>&nbsp;</p>


<h3 align="left">Custom CSS</h3>
<p align="left">		 

You can add any of your own metatags and/or css style settings to the above code as long as you place them immediate before the closing &lt;/head&gt; tag. <br>Yours will over-ride the default settings and will customize the directory on your site. 
   
   But if you add title or description metatags tags, however, it 
    will nullify and override the BungeeBones dynamic ones. This would make every displayed page have the same meta tag information. It is not recommended to add your own title or description tags.
	</p>

<?
}

										
										echo '<br><p>&nbsp;</p><a href="/bungee_jumpers/reg_form/index.php">Submit Another Link</a><br><br>';
										echo '<br><a href="/bungee_jumpers/index.php">Go To Control Panel</a>';
										unset($B1);
										unset($C1);
										include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");

										exit(1);
										
										
										}//closes if C1
										else// begin form
										{



////////////////////////////////////////////////////

include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");

?><script>

/*
Check required form elements script-
By JavaScript Kit (http://javascriptkit.com)
Over 200+ free scripts here!
*/

function checkrequired(which){
var pass=true
if (document.images){
for (i=0;i<which.length;i++){
var tempobj=which.elements[i]
if (tempobj.name.substring(0,8)=="required"){
if (((tempobj.type=="text"||tempobj.type=="textarea")&&tempobj.value==''||tempobj.value=="http://")||(tempobj.type.toString().charAt(0)=="s"&&tempobj.selectedIndex==-1)){
pass=false
break
}
}
}
}
if (!pass){
alert("One or more of the required elements are not completed. Please complete them, then submit again!")
return false
}
else
return true
}
</script>

<div id="doc2">					
	<div style="text-align: center; id=hd">
	<div style="text-align: center">
	
<div style="text-align: center;">
   				<a href="http://bungeebones.com/bungee_jumpers/" class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/reg_form" class="cssbutton sample a"><span>Add Link</span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/reports" class="cssbutton sample a"><span>  Reports </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/update_user.php" class="cssbutton sample a"><span> Your Profile </span></a>&nbsp;<a href="http://bungeebones.com/feedback.php" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="http://bungeebones.com/articles/terms_of_service.php/" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
					</div>
<div id="bd">

<form name="form1" method="GET" action="http://bungeebones.com/bungee_jumpers/reg_form/insert_directory_instr.php"  onSubmit="return checkrequired(this)">
							 
				

		

<div id="display"></div>





<!--</head><body>-->
<form name="form1" method="GET" action="http://bungeebones.com/bungee_jumpers/reg_form/index.php"  onSubmit="return checkrequired(this)">
							 
				

		





<?
//include('accordion.html');

  


$link_selected = $_GET['link_selected'];

?>	



<h1 style="color: red">Create Code For Your AdvertiPage (Optional) </h1>
	<div id="display2"></div>
<iframe id="buffer2" name="buffer2" src="http://bungeebones.com/bungee_jumpers/reg_form/accordion_widget.html" width="700" border="0"height="275"
></iframe>
	
	
	
  
   <p align="left"><b>1) Create And Name A Folder or Directory On Your Website-</b><font color="#ff0000">(see instructions above)</font>
	
   <script type="text/javascript">
	 
function clearText(thefield){
if (thefield.defaultValue==thefield.value)
thefield.value = ""
}
	 </script><p align="left"><b>
	

<input type="hidden" name="link_selected" value="<?echo $link_selected; ?>" />

			1) <input  type="text" size="53" onfocus="clearText(this);clearStyle(this);"  value=""  name="folder_name" id="folder_name" >
	
 <p align="left"><b>2) Select A Name For Your Webpage On Your Website </b><font color="#ff0000">(see instructions above)</font>


<p align="left"><b>2) <input type="text" name="file_name" onfocus="clearText(this);clearStyle(this);"   size="15" id="file_name" value="">
	
 See the <a target="_blank" href="/articles/php_tutorial.php">PHP tutorial</a> if you need help determining if you have php on your website or not.

 <p align="left"><b>3) Create The First Half of The Title Of Your Page </b><font color="#ff0000">(see instructions above)</font>
			
     <p align="left">3) <input id="custom_title1" size="40" type="text" name="custom_title1" value="">
       <br><span style="font-size:70%;">eg. Your domain name, the type of website (Portal, News, Shopping), a greeting (Enjoy, Visit, Surf)</span>
        <p align="left">  <p align="left"><b>4) Create The Second Half of The Title Of Your Page </b><font color="#ff0000">(see instructions above)</font>
        <p align="left">4) <input id="custom_title2" size="40" type="text" name="custom_title2"   value="">
         <br> <span style="font-size:70%;">eg. Links, Info, Websites etc</span>
      
		    
   
      <p align="left"><b>5) Do You Want To Display &quot;Free&quot; Sites?</b><font color="#ff0000">(see instructions above)</font>
      <p align="left">Yes <input type="radio" value="display_freebies" checked name="display_freebies">&nbsp; 
      No <input type="radio" name="display_freebies" value="no_display_free"></p>
      <p align="left"><b>6) If yes, for how long do you wish to display them on your 
      site for?</b><font color="#ff0000">(see instructions above)</font>
      <p align="left"> 6) <select size="1" name="time_period">
      <option value="0">DO Not Display</option>
      <option value="1">1_month</option>
      <option value="2">2_month</option>
      <option value="3">3_month</option>
      <option value="4">4_month</option>
      <option value="5">5_month</option>
      <option value="6">6_month</option>
      <option value="7">1_year</option>
      <option selected value="8">Indefinitely</option>
      </select>
	<!--<h2>Display A "Niche" Directory Or A General Directory?</h2>
	<?
	//include('social_network/social_network_4_insert_directory.php');?>
	-->
<br /><br />
<br>
<p align="left"> <h2>Donate Your Web traffic To Your favorite Charity!</h2> <span style="font-size:125%;">If you wish to donate the proceeds of your directory to a charity of your choice then enter your instructions for donating to them here. Provide all info we will need in order to complete the payment. </span>
<textarea name="donate" cols="40" rows="5">Enter your instructions here</textarea><br>


         <br>

	<!--<h2>Display A "Niche" Directory Or A General Directory?</h2>
	<?
	//include('social_network/social_network_4_insert_directory.php');?>
	-->

<br /><br />

<br /><br />
<table width="100%" border="1"><tr><td>
<H!>NEW FEATURE!</h1>
<p align="left">The distributed web directory can be operated as a "niche" directory and only show the sub-categories and links of one, selected main category. For example, you can operate it as a "Real Estate" Directory or a "Computer" Directory.</p>
<p>&nbsp;</p><p>If you want to help build the sub-category structure of the niche you can send along a comma separated text file of your suggested sub-categories to Robert@BungeeBones.com
<p>&nbsp;</p>
<p>&nbsp;</p>
<H1>Selecting One Of These Will Cause Your Directory To Only Display That Category</h1>
<select size="1" name="is_niche">
<option value="0">Niche Option</option>
<option value="60">Accessories</option>
<option value="65">Art/Photo/Music</option>
<option value="69">Automotive</option>
<option value="102">Books/Media</option>
<option value="111">Business</option>
<option value="125">Careers</option>
<option value="126">Clothing/Apparel</option>
<option value="134">Commerce</option>
<option value="9">Computers</option>
<option value="148">Education</option>
<option value="147">Electronics</option>
<option value="2198">Environment</option>
<option value="2702">Finance</option>
<option value="1307">Games</option>
 <option value="1330">Health/Medical</option>
<option value="1375">Home</option>
<option value="1401">Kids &amp; Teens</option>
<option value="1415">News</option>
<option value="2822">Professional</option>
<option value="3">Real Estate</option>
<option value="1275">Recreation</option>
<option value="1438">Reference</option>
<option value="8">Religion</option>
<option value="2799">Services</option>
<option value="2027">Shopping</option>
<option value="2068">Society</option>
<option value="2098">Sports</option>
<option value="124">Travel</option>
 </select>
</td></tr></table>
<p>&nbsp;</p>
<table width="100%" border="1">

<tr><td>
  <p>&nbsp;</p><p align="left"><b>8)Are You Installing Web Directory In A CMS?</b><font color="#ff0000">(currently available for JOOMLA! and WordPress)</font>
      <p align="left">      <a target="_blank" href="../../../articles/joomla!_web_directory_component.php">Joomla! Web Directory Component </a><input type="radio" name="plugin" value="joomla" >&nbsp; 
      <p align="left"><a target="_blank" href="../../../articles/wordpress_web_directory_plugin.php">WordPress Web Directory Plugin</a><input type="radio" name="plugin" value="wordpress"></p>
      
</td></tr>

</table>



								 <input type="submit" value="Submit Link Info" name="B1">&nbsp;&nbsp;<input type="reset" value="Cancel" name="B2"></p>

    
							   <h3><a href="/bungee_jumpers/index.php">Return To Your User Control Panel</a></h3>
</form>				   
					<?

?>
</div>
	<div id="ft">
	<div style="text-align: center"><a href="http://BungeeBones.com">HOME</a>  <a href="http://BungeeBones.com/articles">ARTICLES</a>  <a href="http://BungeeBones.com">FAQ </a>	 <a href="http://BungeeBones.com/feedback.php"> CONTACT US </a>  <a href="http://BungeeBones.com/bungee_jumpers/reg_form">REGISTER</a>  <a href="http://BungeeBones.com/bungee_jumpers/login.php">LOGIN</a></div>
                                                                                                                                                                                                                                                                                                                

<div style="text-align: center"><a href="http://BungeeBones.com/bungee_bones">OUR LINK EXCHANGE/DIRECTORY</a> <a href="http://BungeeBones.com/subscription_sites">EXAMPLE SITES</a> </div><a target="_blank" href="http://twitter.com/Bungeebones">BB TWITTER </a>
<div style="text-align: center">
    <a href="http://validator.w3.org/check?uri=referer"><img
        src="http://www.w3.org/Icons/valid-xhtml10-blue"
        alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a>
  </div>
  
</div>

</div>
</div>

<?
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");
}//close else is barebones
}//close ifisset B1
} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
