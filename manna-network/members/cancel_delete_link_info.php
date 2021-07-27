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

$moniker="<h5>Suspend Or Delete</h5>";
$body_width="wide";
include($_SERVER['DOCUMENT_ROOT']."/960top.php");
                include('user_cpanel_submenu.php');

	$link_info = new edit;
$get_regd_link_tally = $link_info->widgetHasRecruits($link_id);
$get_link_info = $link_info->getLinkInfo ($link_id);
//gets $title ,$url ,$description
$title  = $get_link_info[0];
$url  = $get_link_info[1];
$description = $get_link_info[2];
if($get_regd_link_tally == "has_recruits"){
echo '<p>&nbsp;</p><h3 style="color: red;">Your web site has other active websites that registered there (and that could still earn you income) so we will only suspend the link listing so that we can continue to provide you accounting and redemption services.</h3>';
}
else
{
echo '<p>&nbsp;</p><h3 style="color: red;">Suspend Or Delete Your Link Listing</h3>';
}
if(isset($_POST['B1'])) 
{ 
	$link_id  = $_POST['link_id'];
	$status = $_POST['status'];
	

$suspend_delete_link_info = $link_info->suspend_deleteLinkInfo ($link_id, $status);
}
elseif(isset($_POST['submit'])) 
{ 

 $link_id  = $_POST['link_id'];
	$status = $_POST['status'];
	
	

?>    
<form name="test" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
<input type="hidden" name="link_id" value = "<?echo $link_id;?>">

<?
if($status == "suspend" || $get_regd_link_tally == "has_recruits"){
echo "<span style='color:red;'> You are about to temporarily suspend your link from being listed in any BungeeBones web directory. You can reactivateit at any time. </b></span><br>
<input type='hidden' name='status' value = 'suspend'>";
}
else
{
echo "<span style='color:red;'><h3>You are about to <b> PERMANENTLY DELETE </b> your link from our listings. If this is your ONLY link in our system then your login will be removed from our database also</h3></span>";
?>
<input type="hidden" name="status" value = "<?echo $status;?>">
<?
}


    echo "<br>If those are correct submit the form again or use the browser's \"back\" button to cancel your changes.."; 
echo '  <input type="submit" name="B1" value="Submit Form"><br>
</form>';

}
else
{
?>

<form name="test" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
<input type="hidden" name="link_id" value = "<?echo $link_id;?>">
<table><tr><td>

Title: </td><td><input type="text" name="title" value="<?echo $title;?>" readonly></td></tr>
<tr><td>URL:  </td><td><input type="text" name="url" value="<?echo $url;?>"readonly></td></tr>
<tr><td>Description:  </td><td><textarea  readonly name="description" rows="5" cols="40" id="description"><?echo $description;?></textarea></td></tr>
<tr><td> <input type="radio" name="status" value="suspend" checked> Temporarily Suspend<br>
  <?
if($get_regd_link_tally == "has_recruits"){
?>
  <input type="radio" name="status" value="delete"  readonly="readonly"> Permanently Delete</td></tr>
<?
}
else
{
?>
  <input type="radio" name="status" value="delete"> Permanently Delete</td></tr>
<?
}
?>
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
