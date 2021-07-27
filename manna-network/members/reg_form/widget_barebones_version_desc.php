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
$link_selected=$_GET['link_selected'];
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `BB_user_ID` from `links` where `id` = '$link_selected'";
$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows >0){
$row = mysqli_fetch_array($result);
$BB_user_ID = $row['BB_user_ID'];
}

if($BB_user_ID != $user_id){
echo 'header(you are not authorized)';
exit();
}
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `id`, `file_name`, `folder_name` from `widgets` where `link_id` = '$link_selected'";
$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);

if($num_rows >0){
$row = mysqli_fetch_array($result);
$folder_name = $row['folder_name'];
$file_name = $row['file_name'];
}
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");

echo '<h1>Use The Next Two Blocks in Your Own Page template</h1>
<p  style="font-size: 150%; text-align: left;">
To create a BungeeBones Web Directory paste the two blocks of code below into one of your web page templates ';
if($num_rows >0){
echo'and save it to the location you just entered (i.e. at '. $url . "/" . $folder_name . "/" . $file_name ;
}
echo '<table border="1" cellpadding="5"><tr><td style="font-size: 150%">';
echo '<h3> OverView Of The Two Installation Methods</h3>';
echo '<p align="left">The final goal is to "wrap"BungeeBones inside one of your own web pages so it is completely branded to your own website\'s design, look and feel.
BOTH installation methods can be used simultaneously if you are not too familar with code. The template version will work after a simple "copy and paste" into an EMPTY page on your website. That part is easy but adding the images and links of your website into won\'t be. The template version provides a working model from which you can study and test if the barebones version becomes a challenge (it is far quicker if you have prepared your own page template properly).  To use this barebones method effectively you will need an empty webpage template from your site. This method is the quickest of our two offered installation methods IF you have a basic understanding of html fundamentals. A simple way to prepare a template is by using your web browser. They are all slightly different but they all have a feature to view a page\'s "source code". In FireFox you find it by clicking VIEW-> Page Source or right clicking and selecting "View Page Source".';


echo '<p>In the BareBones method you paste the two sections of code into one of your own website\'s template page\'s &lt;Head&gt; section and another into the page\'s body section';
echo "<p>&nbsp;</><p>&nbsp;</p>";

if($_GET['link_selected']){
$link_selected = $_GET['link_selected'];
}

?>

	
<?
echo '</td></tr></table>';
?>

<a href="widget_template_version.php?link_selected=<?echo $link_selected;?>&B1=Template"> <h2><u>AND/Or Get The Template Version Too!</u></h2></a>
<a href="widget_index.php?link_selected=<?echo $link_selected;?>"> <h2><u>Return To Directory Management Index</u></h2></a>
<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>
<?include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");
} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
