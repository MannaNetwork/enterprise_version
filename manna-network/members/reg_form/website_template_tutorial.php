<?
//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 

include($_SERVER['DOCUMENT_ROOT']."/classes/access_user/access_user_class.php"); 
// call this page to test referer function
// test this page like "testpage.php?var=test" if you are using a querystring
$test_page_protect = new Access_user;
$test_page_protect->login_page = "login.php"; // change this only if your login is on another page
$test_page_protect->access_page($_SERVER['PHP_SELF'], $_SERVER['QUERY_STRING']); // set this  method, including the server vars to protect your page and get redirected to here after login
$hello_name = ($test_page_protect->user_full_name != "") ? $test_page_protect->user_full_name : $test_page_protect->user;
$test_page_protect->get_user_info();
$user_id=$test_page_protect->id;

if (isset($_GET['action']) && $_GET['action'] == "log_out") {
	$test_page_protect->log_out(); // the method to log off
}

$link_selected =$_GET['link_selected'];
$type =$_GET['type'];
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/connect.php");
$sql="select `BB_user_ID` from `links` where `id` = '$link_selected'";
$result = @mysql_query($sql, $connect);
$num_rows = mysql_num_rows($result);
if($num_rows >0){
$row = mysql_fetch_array($result);
$BB_user_ID = $row['BB_user_ID'];
}

if($BB_user_ID != $user_id){
echo 'header(you are not authprized)';
exit();
}


include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/connect.php");
$sql="select `file_name`, `folder_name`, `end_clone_date` from `widgets` where `link_id` = ".$link_selected;

$result = @mysql_query($sql, $connect);
$num_rows = mysql_num_rows($result);
if($num_rows >0){
$row = mysql_fetch_array($result);
$folder_name = $row['folder_name'];
$file_name = $row['file_name'];
$end_clone_date = $row['end_clone_date'];
}


//if($end_clone_date > '0000-00-00 00:00:00' and $type != 'start_up'){
//echo 'That link is no longer eligible to host a web directory';

//}


include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");
?>
<h1>Web Directory Installation </h1>
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

echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';


include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");
