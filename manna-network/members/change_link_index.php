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
$phpself = basename(__FILE__);
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
include($_SERVER['DOCUMENT_ROOT']."/classes/link_class.php");//load order 1
include($_SERVER['DOCUMENT_ROOT']."/classes/categories_class.php");//load order 2
include($_SERVER['DOCUMENT_ROOT']."/classes/free_categories.php");//load order 3
include($_SERVER['DOCUMENT_ROOT']."/classes/price_slot_class.php");//load order 5
$var = explode("/", $_SERVER['PATH_INFO']);
$cat_id=$var[1];
$link_id=$var[2];
if(isset($_POST['submit'])) 
{ 
$link_id = $_POST['link_id']  ;
}


if(isset($_POST['C1'])){
echo 'in isset c1';
 }//close if isset c1

if(isset($_POST['B1'])){
echo 'in b1 isset';
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
<!--<a href="https://Bungeebones.com/members/change_cat.php?link_id=<?echo $link_id;?>">-->
<a href="https://Bungeebones.com/members/ajaxchained_cat/index.php?link_id=<?echo $link_id;?>">
	
		<h3 >Change Your Category</h3>
		
             </a>
</div>
<div style = "width: 300px ;
  margin-left: auto ;
  margin-right: auto ;">
	<a href="https://Bungeebones.com/members/change_link_info.php?link_id=<?echo $link_id;?>">
	<h3>Change Your Link Info</h3>
		
             </a>
</div>	
<div style = "width: 300px ;
  margin-left: auto ;
  margin-right: auto ;">
	<a href="https://Bungeebones.com/members/cancel_delete_link_info.php?link_id=<?echo $link_id;?>">
	<h3>Temporarily Suspend Or Delete Your Link Info</h3>
		
             </a>
</div>	
<div style = "width: 300px ;
  margin-left: auto ;
  margin-right: auto ;">
	<a href="https://Bungeebones.com/members/ajaxchained_dd/index.php?link_id=<?echo $link_id;?>">
	<h3>Change Your Location/Regional Info</h3>
		
             </a>
</div>
</div>

<div  class="grid_12">
<p><a href="/members/password_reset.php">Update your user account (password, etc)</a></p>
<p><a href="/articles/terms_of_service.php/">Terms Of Service</a> </p>
<p><a href="/members/index.php?action=log_out">Click here to log out.</a></p>
</div>
</div>
<?
include('../960bottom.php');
}
} else {
    // the user is not logged in...
    include("views/change_cat_not_logged_in.php");
}
?>
