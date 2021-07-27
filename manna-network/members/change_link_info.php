<?
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
require_once('libraries/password_compatibility_library.php');
}
require_once('config/config.php');
require_once('lang/en.php');
require_once('libraries/PHPMailer.php');
require_once('classes/Login.php');
$login = new Login();
if ($login->isUserLoggedIn() == true) {    
$user_id = $_SESSION['user_id'];

if(isset($_POST['submit'])) 
{ 
$link_id = $_POST['link_id']  ;
}
else
{
$link_id = $_GET['link_id']  ;
}
$phpself = basename(__FILE__);
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;


include($_SERVER['DOCUMENT_ROOT']."/members/reg_form/classes/edit_link_class.php");  

$moniker="<h5>Edit</h5>";
$body_width="wide";
include($_SERVER['DOCUMENT_ROOT']."/960top.php");
                include('user_cpanel_submenu.php');

	$link_info = new edit;

$get_link_info = $link_info->getLinkInfo ($link_id);
//gets $title ,$url ,$description
$title  = $get_link_info[0];
$url  = $get_link_info[1];
$description = $get_link_info[2];

echo '<p>&nbsp;</p><h3 style="color: red;">Edit Your Link Info</h3>';
if(isset($_POST['B1'])) 
{ 
	$link_id  = $_POST['link_id'];
	
	 if(!isset($_POST['title'])){
	$title  = $get_link_info[0];
	}
	else
	{
	$title  = $_POST['title'];
	}
	 if(!isset($_POST['url'])){
	 $url = $get_link_info[1];}
	else
	{
	$url = $_POST['url'];
	}

	 if($_POST['description']==""){
	$description  = $get_link_info[2];
	}
	else
	{
	$description = $_POST['description'];
	}

$update_link_info = $link_info->updateLinkInfo ($link_id, $title,$url,$description);
}
elseif(isset($_POST['submit'])) 
{ 
	 if(!isset($_POST['title']) OR $_POST['title']==""){
	$title  = $get_link_info[0];
	$title_change = 0;
	}
	else
	{
	$title  = $_POST['title'];
	$title_change = 1;
	}
	 if(!isset($_POST['url']) OR $_POST['url'] == ""){
	 $url = $get_link_info[1];
	$url_change = 0;
	}
	else
	{
	$url = $_POST['url'];
	$url_change = 1;
	}
	 if(!isset($_POST['description']) OR $_POST['description'] == ""){
	$description  = $get_link_info[2];
	$description_change = 0;
	}
	else
	{
	$description = $_POST['description'];
	$description_change = 1;
	}

?>    
<form name="test" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
<input type="hidden" name="link_id" value = "<?echo $link_id;?>">
<input type="hidden" name="title" value = "<?echo $title;?>">
<input type="hidden" name="url" value = "<?echo $url;?>">
<input type="hidden" name="description" value = "<?echo $description;?>">
<?
if($title_change == 1){
echo "<span style='color:red;'> You have changed the title to this : <b> $title </b></span><br>";
}
else
{
echo "You are keeping the title the same: <b> $title </b><br>";
}
if($url_change == 1){
echo "<span style='color:red;'> You have changed the url to this : <b> $url </b>. <h3>Caution: Changing the URL will cause your website to be removed from active advertisement and to be placed back in the \"Pending Approval\" queue awaiting review before going live.</h3></span><br>";
}
else
{
echo "You are keeping the url the same: <b> $url </b><br>";
}
if($description_change == 1){
echo "<span style='color:red;'> You have changed the description to this : <b> $description </b></span><br>";
}
else
{
echo "You are keeping the description the same: <b> $description </b><br>";
}

    echo "<br>If those are correct submit the form again to enter the new values else use the browser's \"back\" button to make your changes.."; 
echo '  <input type="submit" name="B1" value="Submit Form"><br>
</form>';

}
else
{
?>

<form name="test" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
<input type="hidden" name="link_id" value = "<?echo $link_id;?>">
<table><tr><td>
Title: </td><td><input type="text" name="title" placeholder = "<?echo $title;?>"></td></tr>
<tr><td>URL:  </td><td><input type="text" name="url" placeholder = "<?echo $url;?>"></td></tr>
<tr><td>Description:  </td><td><textarea name="description" rows="5" cols="40" id="description" placeholder="<?echo $description;?>"></textarea></td></tr>
</table>
  
 <input type="submit" name="submit" value="Submit Form"><br>
</form>
<? 
}
include($_SERVER['DOCUMENT_ROOT']."/960bottom.php");
} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}
 ?>
