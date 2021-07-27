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
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectlogingmysqli.php");
$sql="select `id`, `file_name`, `folder_name` from `widgets` where `link_id` = '$link_selected'";

$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);


$row = mysqli_fetch_array($result);
$folder_name = $row['folder_name'];
$file_name = $row['file_name'];

include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");

?>
<p align="left">&nbsp;</p>
<p align="left">&nbsp;</p><p align="left">&nbsp;</p>
<h1>Template Version</h1>
<p  style="font-size: 150%; text-align: left;">
The following single block of code below, when pasted into one of your own <b><u>empty</u></b> web pages, in the location you specified in the 'Install Location" form, will produce a fully functional web directory (complete with categories and links) but without any branding (to your own website) whatsoever. Because it should work perfectly from just copying and pasting into an empty page it makes a great way to test your site for compatability and proper configuration. When you install it, the web directory's categories and links should all function properly. 

<p  style="font-size: 150%; text-align: left;">You can use it as a model when you move on to installing the barebones version. Just rename the version's page. You must customise the directory to match your own website and it is easier to use the barebones version (available from one of the other pages) to develop a web directory branded to your site.
<p  style="font-size: 150%; text-align: left;">
<?
if($file_name != "" AND $folder_name !="" ){
echo'We have detected you have already configured the location where you will install the directory (i.e. at '. $url . "/" . $folder_name . "/" . $file_name ;
echo ') so, to get started, copy and paste the code below to that location and name it accordingly.';
}
else
{
echo'<font color="red">We have not detected that you have configured the location where you will install the directory on your website. To get started,<a href="widget_install.php?link_selected='.$link_selected.'"> use the "Install Location" form </a>to configure a location, copy and paste the code below to that location and name it accordingly.</font>';
}

?>
<h2><a target="_blank" href="../../demo/demo.php">See What It Looks Like Here!</a></h2>

<table border="1" cellpadding="5" cellspacing="0"  bordercolor="#C0C0C0" width="100%" id="AutoNumber1">
  <tr>
    <td>
<p  style="font-size: 150%; text-align: left;">
The code below will create a complete BungeeBones Web Directory web directory (complete with categories and links) for your website. Just paste the code below into a completely empty web page at the location you just entered (i.e. at <font style="color: red">

<?echo $url . "/" . $folder_name . "/" . $file_name ?></font>
.</p> <p align="left">&nbsp;</p><p align="left">&nbsp;</p><p align="left">&nbsp;</p><hr>
&lt;?php <br>
//////// CONFIGURABLE ///////////// <br>
//////// CONFIGURABLE ///////////// <br>
//////// CONFIGURABLE ///////////// <br>
//The next two settings are configurable by installer <br>

$debug_bungeebones = 0;//change value from 0(zero) to 1 to turn debugging on and, then,contact BungeeBones support. <br>
//ALWAYS verify that the affiliate (i.e link) number below is yours to insure proper operation and proper affiliate credit and payments<br>
$affiliate_num = <?echo $link_selected; ?> ;<br>
//////// END CONFIGURABLE ///////////// <br>
//////// END CONFIGURABLE ///////////// <br>
//////// END CONFIGURABLE ///////////// <br>
 $var = explode("/", $_SERVER['PATH_INFO']);<br>


$url_cat = $var[2] ;<br>
$cat_page_num = $var[3] ;<br>
$link_page_num = $var[4] ;<br>
$pagem_url_cat = $var[5] ;<br>
$link_page_id = $var[6] ;<br>
$link_page_total = $var[7] ;<br>
$link_record_num = $var[8] ;<br>
$regional_number = $var[9] ;<br>
 		

if($debug_bungeebones  == 1){<br>

print_r($var);<br>

echo '<br>$url_cat = ',$url_cat;<br>
echo '<br>$cat_page_num = ',$cat_page_num;<br>
echo '<br>$link_page_num = ',$link_page_num;<br>
echo '<br>$pagem_url_cat = ',$pagem_url_cat;<br>
echo '<br>$link_page_id = ',$link_page_id;<br>
echo '<br>$link_page_total = ',$link_page_total;<br>
echo '<br>$link_record_num = ',$link_record_num;<br>
echo '<br>$regional_number = ',$regional_number;<br>
}<br>
?&gt;<br>
&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;<br>
	&lt;html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" dir="ltr"&gt;<br>
&lt;head&gt; <br>

&lt;? 
<br>
<br>
$file ="http://BungeeBones.com/make_header/dyn_hdrcss.php/$url_cat/$affiliate_num/";
<br>
//note: some browsers insert a blank space after variable at line breaks in the above url. Remove any empty space from the final link if there is one<br><br>
if($debug_bungeebones  == 1){<br>
print_r($file);<br>
}<br>

//DO NOT place any meta tags here or they might be overridden by the dynamic ones coming next. Place your meta and CSS info after the next section of code and just before the closing head tag.<br>

$ch = curl_init();<br>
curl_setopt($ch, CURLOPT_URL, $file);<br>
curl_setopt($ch, CURLOPT_HEADER, 0);<br>
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);<br>
$data = curl_exec($ch);<br>
curl_close($ch);<br>
echo($data);<br>
?&gt;<br>

 &lt;link rel="stylesheet" type="text/css" href="http://bungeebones.com/css/yahoo/reset.css" /&gt;<br>
 &lt;link rel="stylesheet" type="text/css" href="http://bungeebones.com/css/yahoo/base.css" /&gt;<br>
&lt;link rel="stylesheet" type="text/css" href="http://bungeebones.com/css/yahoo/fonts.css" /&gt;<br>
&lt;link rel="stylesheet" type="text/css" href="http://bungeebones.com/css/yahoo/grids.css" /&gt;<br>
 <br>
&lt;/head&gt;
 <br>
&lt;body&gt;

 <br>
&lt;table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1" height="648"&gt;
 <br>
&lt;tr&gt;
 <br>
&lt;td width="100%" height="70" colspan="3"&gt;
 <br>
&lt;h2 align="center"&gt;Place A Directory Like This On Your Own Website&lt;/h2&gt;
 <br>
&lt;h2 align="center"&gt;Place Your Own Logo Here&lt;/h2&gt;

 <br>
&lt;h2 align="center"&gt;Copy This into a file on your site named "demo.php" and place it in a folder named "demo" to see it fully functional on your site without any configuration.&lt;/h2&gt;
 <br>
&lt;h2 align="center"&gt;Dynamic Meta Data - Very Search Engine Friendly&lt;/h2&gt;
 <br>
&lt;h2 align="center"&gt;Link Exchange Managed For You By BungeeBones&lt;/h2&gt;
 <br>
&lt;h2 align="center"&gt;For information on the CSS grid system used in the head you can find it at &lt;a href="http://developer.yahoo.com/yui/">http://developer.yahoo.com/yui/&lt;/a&gt;&lt;/h2&gt;
<br>
&lt;h2 align="left"&gt;Here are a few tips for after you have the directory operating&lt;UL&gt;
&lt;li&gt;Immediately make a backup of what you have accomplished so far&lt;/li&gt;
&lt;li&gt;Start deleting unnecessary code from the example and "feel your way around"&lt;/li&gt;
&lt;li&gt;Make some more back ups, then make some more backups, then etc, etc&lt;/li&gt;
&lt;li&gt;finally, start inserting your own website's template info, menus etc&lt;li&gt;
&lt;/td&gt;
 <br>
&lt;/tr&gt;
 <br>
&lt;tr&gt; <br>
&lt;td width="16%" valign="top" height="509"&gt; <br>


&lt;p align="center"&gt;Place&lt;/p&gt; <br>
&lt;p align="center"&gt;Your&lt;/p&gt; <br>
&lt;p align="center"&gt;Menu&lt;/p&gt; <br>
&lt;p align="center"&gt;Info&lt;/p&gt; <br>
&lt;p align="center"&gt;Here&lt;/p&gt; <br>

&lt;/td&gt;
&lt;td width="72%" height="509"&gt; <br>



&lt;?
<br>
<br>
$file="http://Bungeebones.com/link_exchange/index.php/$affiliate_num/$url_cat/$cat_page_num/$link_page_num/$pagem_url_cat/$link_page_id/$link_page_total/$link_record_num/$regional_number";<br>
if($debug_bungeebones  == 1){<br>
print_r($file);<br>
}<br>
$ch = curl_init();<br>
curl_setopt($ch, CURLOPT_URL, $file);<br>
curl_setopt($ch, CURLOPT_HEADER, 0);<br>
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);<br>
$data = curl_exec($ch);<br>
curl_close($ch);<br>
echo($data);<br>
    ////////////////////////////////////////////////////<br>
   ?&gt;
		</font><br>
	&lt;/td&gt; <br>	
		&lt;td&gt; <br>	right hand margin text here &lt;
		
		&lt;/td&gt; <br>	
		&lt;/tr&gt; <br>	
		&lt;tr&gt; <br>	
		&lt;td colspan="3"&gt; &lt;p align="center"&gt;	footer text here ---	footer text here --- footer text here &lt;/td&gt; <br>	
		&lt;/tr&gt; <br>	
		&lt;/table&gt; <br>	
		&lt;/body&gt; <br>	
			&lt;/html&gt; <br>	
	</td>
  </tr>
</table>
	

<a target="_top" href="widget_index_custom.php?link_selected=<?echo $link_selected;?>"> <h2><u>Return To Install Management Index</u></h2></a>
<a target="_top" href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>

<?include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");

} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}

