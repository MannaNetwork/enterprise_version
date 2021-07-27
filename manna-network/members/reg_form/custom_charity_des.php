<?
//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 

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

if (isset($_GET['link_selected'])){
$link_selected=$_GET['link_selected'];
}
$_SESSION['link_selected'] = $_GET['link_selected'];


include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/reg_form/template_explo_top_mini.php");
?>

<table width="500"><TR><TD>
<h2>Widget Customization Form</h2>

<?

if(isset($_POST['Submit']))
{
if (!preg_match("/^Submit$/", $_POST['Submit'])) die("Bad submit, please re-enter.");
$custom_title1= htmlspecialchars($_POST['custom_title1']);
$custom_title2= htmlspecialchars($_POST['custom_title2']);

$display_freebies= $_POST['display_freebies'];

$time_period= $_POST['time_period'];
$donate= htmlspecialchars($_POST['donate']);
$leaving_page= htmlspecialchars($_POST['leaving_page']);
$is_niche= $_POST['is_niche'];


include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
//include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connect.php");
//new db connection
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `id`, `file_name`, `folder_name` from `widgets` where `link_id` = '$link_selected'";
$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);

if($num_rows >0){

$sql="update `widgets` set `custom_title1` = '$custom_title1',
`custom_title2`= '$custom_title2',
`display_freebies`= '$display_freebies',
`time_period`= '$time_period',
`donate`= '$donate',
`leaving_page`= '$leaving_page',
`is_niche`= '$is_niche'
WHERE `link_id` = '$link_selected';
";
$result = @mysqli_query($connect, $sql);
echo '<h1>Your configuration settings have been updated.</h1>
<a target="_top" href="widget_index_main.php?link_selected='.$link_selected.'"> <h2><u>Return To Directory Management Index</u></h2></a>
<a target="_top" href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';
exit();
}
}
else
{
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
//include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connect.php");
//new db connection
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `id`, `custom_title1`,`custom_title2`,`display_freebies`,`time_period`,`donate`,`leaving_page`,`is_niche`,`file_name`, `folder_name` from `widgets` where `link_id` = '$link_selected'";
echo 'link selected = ', $link_selected;
$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows>0){
$row = mysqli_fetch_array($result);
$id = $row['id'];
$custom_title1 = $row['custom_title1'];
$custom_title2 = $row['custom_title2'];
$display_freebies = $row['display_freebies'];
$time_period = $row['time_period'];
$donate = $row['donate'];
$leaving_page = $row['leaving_page'];
$is_niche = $row['is_niche'];
$folder_name = $row['folder_name'];
$file_name = $row['file_name'];
}
?>

<form name='test' method='POST' action='' accept-charset='UTF-8'>
<table cellspacing='0' cellpadding='10' border='0' bordercolor='#000000'>
   <tr>
      <td>
         <table cellspacing='2' cellpadding='2' border='0'>

<p align="left"><b>Donate Your Web Traffic To Your Favorite Charity!</b></p>
<p align="left">I amazingly discovered one day that if one Googles "Donate web traffic to charity" it all but comes up empty. Yet, that is exactly what BungeeBones can enable a webmaster to do. Unless you are doing Pay Per Click or banner ads then the traffic that comes to your site leaves without generating anything for anybody. Add the directory to your website and we will forward your earnings to the charity of your choice. And remember, those earnings are for the life of the paying customer and includes any other web directory recruits that come from your website.
<p align="left">If you wish to donate what basically amounts to "found money" (i.e. the proceeds of your directory) to a charity of your choice then enter your instructions for donating to them here. Provide all the info we will need in order to complete the payment. 
<p><textarea name="donate" cols="60" rows="3"><? echo $donate;?></textarea><br>





            <tr>
               <td colspan='2' align='center'>
                  <input type='submit' name='Submit' value='Submit'>
               </td>
            </tr>
         </table>
      </td>
   </tr>
</table>
</form>
<p>
<a target="_top" href="widget_index_main.php?link_selected='.$link_selected.'"> <h2><u>Return To Directory Management Index</u></h2></a>
<a target="_top" href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>
</TD></TR><tr><TD></TD><td></td></tr></table>
<?PHP
}//true == 


include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");

} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
