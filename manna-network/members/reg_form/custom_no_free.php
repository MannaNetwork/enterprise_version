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
$result = @mysqli_query($connect, $sql, );
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
  <p align="left"><b>Do You Want To Display &quot;Free&quot; Links?</b></p></li>
<p align="left">BungeeBones makes the commitment to offer free advertising on its own domain but we don't presume everyone feels the same way so we don't promise YOUR website as providing free advertising. We offer each directory installation site the option to choose whether or not to display free links and, if so, for how long they will do so.
<p align="left">BungeeBones strongly recommends, however, that our "partner" directories also provide free links. We anticipate that as more directories are added and the traffic increases there will be plenty of incentive for them to become a paying link.
      <p align="left">Yes <input type="radio" value="display_freebies" <?if ($display_freebies=="display_freebies"||$display_freebies==""){ echo "checked";}?> name="display_freebies">&nbsp; 
      No <input type="radio" name="display_freebies" value="no_display_free" <?if ($display_freebies=="no_display_freebies"){ echo "checked";}?>></p> 
  <?    if ($display_freebies=="display_freebies"||$display_freebies==""){ echo'<p align="left"><b>6) If yes, for how long do you wish to display them on your 
      site for?</b>
      <p align="left"><select size="1" name="time_period">
      <option value="0"<?if ($time_period==0){ echo " selected ";}?> >DO Not Display</option>
      <option value="1"<?if ($time_period==1){ echo " selected ";}?>>1_month</option>
      <option value="2"<?if ($time_period==2){ echo " selected ";}?>>2_month</option>
      <option value="3"<?if ($time_period==3){ echo " selected ";}?>>3_month</option>
      <option value="4"<?if ($time_period==4){ echo " selected ";}?>>4_month</option>
      <option value="5"<?if ($time_period==5){ echo " selected ";}?>>5_month</option>
      <option value="6"<?if ($time_period==6){ echo " selected ";}?>>6_month</option>
      <option value="7"<?if ($time_period==7){ echo " selected ";}?>>1_year</option>
      <option value=8<?if ($time_period==8){ echo " selected ";}?>>Indefinitely</option>
      </select>';






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
