<?php


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
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectlogim,ysqli.php");
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
$msg = '<h1>Your configuration Was Successful. -</h1>';

echo '<p>

<a target="_top" href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';



//include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");
exit();
}

else
{
//include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");
echo 'You submitted the form without giving the location where it will be installed so it has not been properly configured and will not function. Use the browser back button and fill in the two required fields.';
echo '<p>

<a target="_top" href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';



//include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");
exit();
}

}
elseif(isset($B1) AND $num_rows==1 AND $folder_name != "" AND $file_name != ""){
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
echo' <p align="left"><b> Tell Us The Folder Name Of Where You Installed It (enter "root" w/o quotes if web directory is installed on home page).</b><p align="left">
			 <input  type="text" size="53"   value=""  name="folder_name" id="folder_name" >
	
 <p align="left"><b> Tell us the file name of the webpage (i.e the url, the file name etc) where you saved your new web page template to (and where you pasted the code in) On Your Website. IMPORTANT: Be sure that you add the .php file extension at the end of the file name and that your server supports PHP. </b></P>


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
