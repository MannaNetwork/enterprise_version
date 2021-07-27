<?
/*
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
*/
$phpself = basename(__FILE__);
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
include($_SERVER['DOCUMENT_ROOT']."/classes/link_class.php");//load order 1
include($_SERVER['DOCUMENT_ROOT']."/classes/categories_class.php");//load order 2
include($_SERVER['DOCUMENT_ROOT']."/classes/free_categories.php");//load order 3
include($_SERVER['DOCUMENT_ROOT']."/classes/price_slot_class.php");//load order 5

if(isset($_POST['C1'])){
echo 'in isset c1';
 }//close if isset c1

if(isset($_POST['B1'])){

}//close if B1
else
{
$moniker="<h5>BungeeBones User Control Panel</h5>";
$body_width="wide";
include('../960top.php');

		?>
		<div id="doc2">					
		<div id="bd">
			<?
                include('user_cpanel_submenu.php');

		?>
		</div>
		<div id="custom-doc">
<h1 style="text-align: center;">The BungeeBones User Control Panel</h1>
		<div id="custom-doc">
<div style = "width: 300px ;
  margin-left: auto ;
  margin-right: auto ;">
		<h3 >Change Your Category</h3>
	<p style = "text-align:left;">Realize that changing your link's category will cause your seniority date to be reset to the current time stamp. Since <b>FREE</b> links are listed in order of their seniority, your link will be considered "new" and will be listed last in its new category (this effect does not apply to paid links however). If you are a brand new installation then this will have little if any effect in your position.
<p  style = "text-align:left;">If you wish to continue, then go to your own web directory installation and go to the category you want your link to be listed in. Then 
copy the "Crumb Trail" to the category (it is displayed as a navigation aid at the top of every directory page and, as an example, it looks something like this</p>

<p  style = "text-align:center;"> Crumb Trail:Top Level > Computers > Data Recovery </p>

<p  style = "text-align:left;">Use the <a target="_blank" href="http://bungeebones.com/feedback.php">BungeeBones Feedback form</a> and send it to BungeeBones administration. We will want to inspect and review your blog material and content before publishing the link to it in the web directory anyway and then we will make the change for you.
</div>

<div  class="grid_12">
<p><a href="./password_reset.php">Update your user account (password, etc)</a></p>
<p><a href="../articles/terms_of_service.php/">Terms Of Service</a> </p>
<p><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=log_out">Click here to log out.</a></p>
</div>
</div>
<?
include('../960bottom.php');
}
/*} else {
    // the user is not logged in...
    include("views/change_cat_not_logged_in.php");
}*/
?>
