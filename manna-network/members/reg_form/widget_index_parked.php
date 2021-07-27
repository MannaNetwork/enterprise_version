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

$link_selected =$_GET['link_selected'];

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
echo 'header(you are not authprized)';
exit();
}


include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `file_name`, `folder_name`, `end_clone_date` from `widgets` where `link_id` = ".$link_selected;

$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows >0){
$row = mysqli_fetch_array($result);
$folder_name = $row['folder_name'];
$file_name = $row['file_name'];
$end_clone_date = $row['end_clone_date'];
}


if($end_clone_date > '0000-00-00 00:00:00'){
echo 'That link is no longer eligible to host a web directory';

}


include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");
?>
<h2>Widget Installation & Registration Form</h2>
<script>
var page_set = [
{'caption': 'Install Location', 'url': 'widget_install.php?link_selected=<?echo $link_selected;?>'},
    {'caption': 'Customize', 'url': 'widget_config.php?link_selected=<?echo $link_selected;?>'},
    {'caption': 'Get Code - Template Version', 'url': 'widget_template_version_code.php?link_selected=<?echo $link_selected;?>'}
,
    {'caption': 'Get Code - BareBones Version', 'url': 'widget_barebones_version_code.php?link_selected=<?echo $link_selected;?>'}

];
</script>

<?
$msg= '<p style="text-align:left; font-size: 145%;">Get & Install Widget (i.e. web directory) Source Code</p>';

$msg .= '<a name="custom"></a> <table bgcolor="gray"><tr><td><a href=""><h1 style="color: #E1D7D7;">For Custom Coded PHP Websites</h1></a><p style="text-align:left; font-size: 125%;"> <br>If you have a custom php website (i.e. is not a WordPress or Joomla script or other CMS) then read the following and click "Install Location" below. Either of the two versions of the code we supply can be used to build the web directory on your website but they approach the task in a different way. ';
$msg .=   '<p style="text-align:left; "><b>The Template Version</b> comes as a complete page. You will initially only need to copy and paste it to get a working example on your website. </p>';
$msg .=   '<p style="text-align:left; "><b>The BareBones Version</b> comes as two blocks of code that need to be inserted into one of your own website page templates. One section of code needs to be pasted into the "head" section and the other into the "body" section of the page.</p>
<p>The advantage of the Template Version is that it will work "right out of the box". Just paste the entire block of code into an EMPTY page on your site and it should work. The problem with the Template Version is that you will then have to replace the header, menus, footer etc with your own. The BareBones Version, on the other hand, is quicker because you start with your own webpage template (that already has your header, menus, footer etc) and paste the BungeeBones code into it.

If you are struggling with the install you might install both versions so you can have a working demo (the templated version) while building the barebones one from your own code. They both produce the same results. Installing both before you contact support can speed up their troubleshooting effort for you.</P>';


$msg .=   '<p style="text-align:left; "><h1 style="color: white;">Install Instructions</h1> <a style="color: white;" href="widget_install.php?link_selected='. $link_selected.'" title="Install Location" rel="gb_pageset[search_sites]">Install Location</a> | <a style="color: white;" href="widget_config.php?link_selected='. $link_selected.'"  rel="gb_pageset[search_sites]">Customize</a> | <a style="color: white;" href="widget_template_version_code.php?link_selected='. $link_selected.'"rel="gb_pageset[search_sites]">Template Version Code</a> | <a style="color: white;" href="widget_barebones_version_code.php?link_selected='. $link_selected.'"  rel="gb_pageset[search_sites]">BareBones Version Code</a>
</td></tr></table>';


echo $msg;
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';


include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");

} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
