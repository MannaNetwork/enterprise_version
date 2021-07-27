<?
$phpself = basename(__FILE__);
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
require_once("../config/config.php");
require_once("../php-login.php");
$login = new Login();
if ($login->isUserLoggedIn() == true) {    
$user_id = $_SESSION['user_id'];

if (isset($_GET['link_id'])){
$link_selected=$_GET['link_id'];
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
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql="select `id`, `file_name`, `folder_name` from `widgets` where `link_id` = '$link_selected'";
$result = @mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($result);


$row = mysqli_fetch_array($result);
$folder_name = $row['folder_name'];
$file_name = $row['file_name'];

//include($_SERVER['DOCUMENT_ROOT']."/members/template_topy.php");

echo '<h1>BungeeBones Hosted Web Directory Code</h1>
<p  style="font-size: 150%; text-align: left;">
The following blocks of code, when pasted into one of your web page templates, will produce a fully functional and branded (to your own website) web directory with it\'s categories and links coming from the BungeeBones server in real time. The file being sent to your page is simple text and html and smaller than even many images.';

if($file_name != "" AND $folder_name !="" ){
echo'We have detected you have already configured the location where you will install the directory (i.e. at '. $url . "/" . $folder_name . "/" . $file_name ;
echo ') so, to get started, save your web page template to that location and name it accordingly. Then follow the instructions below to insert each of the two blocks into their appropriate locations on that page.';
}
else
{
echo'<font color="red">We have not detected that you have configured the location where you will install the directory on your website. To get started,<a href="widget_install.php?link_selected='.$link_selected.'"> use the "Install Location" form </a>to configure a location, then save your web page template to that location and name it accordingly. Then follow the instructions below to insert each of the two blocks into their appropriate locations on that template page.</font>';
}
echo'<p>If you need help or instructions on how to build a template page containing your own website\'s theme, images, menu, headers etc then <a href="make_template.php?link_selected='.$link_selected.'">click here for instructions on how to build a web page template</a> from your website.
';

echo '<table border="1" cellpadding="5"><tr><td style="font-size: 150%">';
echo '<h3>Block One of BungeeBones Hosted Web Directory Code</h3>';

echo '<p>Paste this code into the &lt;body&gt; of your own website\'s template page, pasting anywhere in the page\'s "body" tag section. You can put your own content before or after it as you wish';

?><br>
</td></tr><tr><TD bgcolor="#C9BE62">
&lt;?php
<br>
<br>

$file="http://Bungeebones.com/link_exchange/index.php/$affiliate_num/$url_cat/$cat_page_num/$link_page_num/$pagem_url_cat/$link_page_id/$link_page_total/$link_record_num/$regional_number";


<br>//debug note - Some browsers may insert a hard to detect space at the line breaks in the above link. Check the url after installed for empty spaces. There should be NO empty spaces in the url.<br>
if($debug_bungeebones  == 1){<br>
print_r($file);<br>
}<br>
$ch = curl_init();<br>
curl_setopt($ch, CURLOPT_URL, $file);<br>
curl_setopt($ch, CURLOPT_POSTFIELDS, array('modal' => $modal));<br>
curl_setopt($ch, CURLOPT_HEADER, 0);<br>
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);<br>
$data = curl_exec($ch);<br>
curl_close($ch);<br>
echo($data);<br>
    ////////////////////////////////////////////////////<br>
   ?&gt;
	
<?

echo '</td></tr></table>';











echo '<table border="1" cellpadding="5"><tr><td style="font-size: 150%">';

echo '<h3>Blocks Two or Three of BungeeBones Hosted Web Directory Code </h3>';
echo '<p>You now only need to install ONE of the next two blocks of code. The FIRST IS THE EASIEST and most reliable. The second has more "bells and whistles" (the second has dynamic, configurable meta tags that can be customised to your website).';
echo '<p>It is recommended you install the easiest and most reliable method first. Get it working, then, if you wish to try the fancier one make a backup of the one that you know works and give it a try.';

echo '
<h2>Simple, Basic Installation</h2>
<p>Paste this block of code IN FRONT OF and before any other code (html) on your template page. ';
?>
<table><TR><TD  bgcolor="#CAC5C5">
&lt;?php $var = explode("/", $_SERVER['PATH_INFO']);<br>
////////   CONFIGURABLE    /////////////<br>
////////   CONFIGURABLE    /////////////<br>
////////   CONFIGURABLE    /////////////<br>
//The next two settings are configurable by installer<br>

$debug_bungeebones  = 0;//Change value from 0 to 1 to enter de-bug mode. <br>
//verify that the affiliate (i.e link) number below is yours to insure your affiliate credit and payments<br>
$affiliate_num = <?echo $link_selected;?> ;<br>

////////   END CONFIGURABLE    /////////////<br>
////////   END CONFIGURABLE    /////////////<br>
////////   END CONFIGURABLE    /////////////<br>


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
if(is_dir('modal')) { 
$modal= "same_level"; 
} 
elseif(is_dir('../modal')) { 
$modal= "up_one_level"; 
} 
?&gt;
</td></tr></table>


<?



echo '<h2>Dynamic, Customizable Meta Tag Version</h2>
<h3>Alternative method from previous block of code</h3>
<p>In this version you need to replace small parts of your existing HTML code in the HEAD section. Paste the block of code below OVER your template page\'s following HTML tags:
<br>the <font color="red">HTML DOCTYPE </font>declaration *
<br> the opening <font color="red">&lt;Head&gt;</font> tag. 
<br>You also should delete the opening and closing <font color="red">&lt;Title&gt;</font> tags, the  opening and closing <font color="red">&lt;Description&gt;</font> tags and the <font color="red">&lt;Meta keyword&gt; </font>tags. 
<p>You can include any of your own CSS styling code, javascript etc after the BungeeBones code and between it and the closing head tag but bear in mind any "&lt;title&gt;" or "description" or "keyword" metatags that are after this code will over ride BungeeBones dynamic ones that are produced uniquely for each individual category and website.';
echo "<p>&nbsp;</p>
* Notice I supplied the HTML5 style doctype declaration in the code as the default. You should change that to the same doctype as what your template originally uses.";

if($_GET['link_selected']){
$link_selected = $_GET['link_selected'];
}

?>
<table><TR><TD  bgcolor="#CAC5C5">
&lt;?php $var = explode("/", $_SERVER['PATH_INFO']);<br>
////////   CONFIGURABLE    /////////////<br>
////////   CONFIGURABLE    /////////////<br>
////////   CONFIGURABLE    /////////////<br>
//The next two settings are configurable by installer<br>

$debug_bungeebones  = 0;//Change value from 0 to 1 to enter de-bug mode. <br>
//verify that the affiliate (i.e link) number below is yours to insure your affiliate credit and payments<br>
$affiliate_num = <?echo $link_selected;?> ;<br>

////////   END CONFIGURABLE    /////////////<br>
////////   END CONFIGURABLE    /////////////<br>
////////   END CONFIGURABLE    /////////////<br>


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
if(is_dir('modal')) { 
$modal= "same_level"; 
} 
elseif(is_dir('../modal')) { 
$modal= "up_one_level"; 
} 


		?&gt;<br>
<font color="red">&lt;!DOCTYPE html&gt; </font><br>
&lt;head&gt;
<br>

&lt;? 
//DO NOT place any meta tags here or they might be overridden by the dynamic ones coming next. Place your meta and CSS info after the next section of code and just before the closing head tag.<br>

<br>
<br>
<br>
$file ="http://BungeeBones.com/make_header/dyn_hdrcss.php/$url_cat/$affiliate_num/";
<br>

<br><br>
if($debug_bungeebones  == 1){
<br>
print_r($file);<br>
}<br>
$ch = curl_init();<br>
curl_setopt($ch, CURLOPT_URL, $file);<br>
curl_setopt($ch, CURLOPT_HEADER, 0);<br>
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);<br>
$data = curl_exec($ch);<br>
curl_close($ch);<br>
echo($data);<br>


//You can place any meta tags here you want but they will override the dynamic ones by BungeeBones (if they are the same named tags). You can also place your scripts and CSS here ahead of the closing head tag.<br>

?&gt;

<?


echo '<h1><font  color="red">Close This Modal To Return To Your User Control Page</font></h1></td></tr></table>';


} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}
