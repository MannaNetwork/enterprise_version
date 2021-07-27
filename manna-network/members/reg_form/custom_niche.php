<?
//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 

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

 
<p align="left"><b>Operate BungeeBones As A "Niche" Directory</b></p></li>
<p align="left">The distributed web directory can be operated as a "niche" directory by only showing the sub-categories and links of one, selected main category. For example, you can operate it as a "Real Estate" Directory or a "Computer" Directory.</p>

<p>
Selecting One Of These Will Cause Your Directory To Only Display That Category</p>
<select size="1" name="is_niche">
<option value="0" <?if ($is_niche==0){ echo " selected ";}?>>Niche Option</option>
<option value="60" <?if ($is_niche==60){ echo " selected ";}?>>Accessories</option>
<option value="65" <?if ($is_niche==65){ echo " selected ";}?>>Art/Photo/Music</option>
<option value="69" <?if ($is_niche==69){ echo " selected ";}?>>Automotive</option>
<option value="102" <?if ($is_niche==102){ echo " selected ";}?>>Books/Media</option>
<option value="111" <?if ($is_niche==111){ echo " selected ";}?>>Business</option>
<option value="125" <?if ($is_niche==125){ echo " selected ";}?>>Careers</option>
<option value="126" <?if ($is_niche==126){ echo " selected ";}?>>Clothing/Apparel</option>
<option value="134" <?if ($is_niche==134){ echo " selected ";}?>>Commerce</option>
<option value="9" <?if ($is_niche==9){ echo " selected ";}?>>Computers</option>
<option value="148" <?if ($is_niche==148){ echo " selected ";}?>>Education</option>
<option value="147" <?if ($is_niche==147){ echo " selected ";}?>>Electronics</option>
<option value="2198" <?if ($is_niche==2198){ echo " selected ";}?>>Environment</option>
<option value="2702" <?if ($is_niche==2702){ echo " selected ";}?>>Finance</option>
<option value="1307" <?if ($is_niche==1307){ echo " selected ";}?>>Games</option>
 <option value="1330" <?if ($is_niche==1330){ echo " selected ";}?>>Health/Medical</option>
<option value="1375" <?if ($is_niche==1375){ echo " selected ";}?> >Home</option>
<option value="1401" <?if ($is_niche==1401){ echo " selected ";}?>>Kids &amp; Teens</option>
<option value="1415" <?if ($is_niche==1415){ echo " selected ";}?>>News</option>
<option value="2822" <?if ($is_niche==2822){ echo " selected ";}?>>Professional</option>
<option value="3" <?if ($is_niche==3){ echo " selected ";}?>>Real Estate</option>
<option value="1275" <?if ($is_niche==1275){ echo " selected ";}?>>Recreation</option>
<option value="1438" <?if ($is_niche==1438){ echo " selected ";}?>>Reference</option>
<option value="8" <?if ($is_niche==8){ echo " selected ";}?>>Religion</option>
<option value="2799" <?if ($is_niche==2799){ echo " selected ";}?>>Services</option>
<option value="2027" <?if ($is_niche==2027){ echo " selected ";}?>>Shopping</option>
<option value="2068" <?if ($is_niche==2068){ echo " selected ";}?>>Society</option>
<option value="2098" <?if ($is_niche==2098){ echo " selected ";}?>>Sports</option>
<option value="124" <?if ($is_niche==124){ echo " selected ";}?>>Travel</option>
 </select>
</td></tr></table>








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
