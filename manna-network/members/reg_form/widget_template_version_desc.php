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
//echo 'in isset link selected';
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
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");
?>
<p align="left">&nbsp;</p>
<p align="left">&nbsp;</p><p align="left">&nbsp;</p>
<h3 style="font-size: 150%; ">This Template Version Code Creates A Very Basic Web Page </h3>
<p>You only need to copy and paste the entire code into a blank page on your site in the location you specified in order to produce a completely working directory (complete with categories and links). You can use the working version, then, as a model to help install the barbones version which, in the long run, is probably the quicker and easier method to get a finished product branded to your website.

You can build that same branded web directory wwith this template version. It has the traditional top, side, and footer sections cleary defined with both text and table borders so you can insert your own pictures and menus. That does requre basic to moderate html experience dependiong on the complexity of your web design. You can copy and paste the correspond parts of your your own existing web pages (such as your logo, menu footer etc) into the template to make this look just like the rest of your site. </p>
<h2><a target="_blank" href="../../demo/demo.php">It's Not Pretty But You Can See This Version Here!</a></h2>

<a href="widget_barebones_version_desc.php?link_selected=<?echo $link_selected;?>&B1=Barebones"> <h2><u>AND/Or Get The BareBones Version Too!</u></h2></a>	

<a href="widget_index_main.php?link_selected=<?echo $link_selected;?>"> <h2><u>Return To Directory Management Index</u></h2></a>
<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>

<?include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");
} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
