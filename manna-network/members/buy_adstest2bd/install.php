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
echo '<h1>Download and Install Supporting Files</h1>
<p>Now, after entering the location on your server where you are about to install BungeeBones in step 1 now create the folder where you said. Then <a href="http://bungeebones.com/ftp/bungeebones_modal_pkg.zip">download  </a> some supporting files. Now upload them into the folder you created and unzip them there. You will now have two .php files and a folder named "modal". 

<p>Now upload your template file to the same folder and name it according to the file name you configured in step one and be sure to use the .php extension.

<h2>Paste the following two blocks of code into their proper locations in your template page according to the following instructions:</h2>



';
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

$file="http://Bungeebones.com/link_exchange/index.php";
<br>
//debug note - Some browsers may insert a hard to detect space at the line breaks in the above link. Check the url after installed for empty spaces. There should be NO empty spaces in the url.<br>
if($debug_bungeebones == 1){<br>
print_r($file);<br>
}<br>
$ch = curl_init();<br>
curl_setopt($ch, CURLOPT_URL, $file);<br>
//curl_setopt($ch, CURLOPT_POSTFIELDS, array('modal' => $modal));<br>
curl_setopt($ch, CURLOPT_POSTFIELDS, array('modal' => $modal,'regional_number' => $regional_number, 'continent' => $continent,
'country' => $country, 'state' => $state, 'city' => $city,'link_record_num' => $link_record_num,
'link_page_total' => $link_page_total, 'link_page_id' => $link_page_id, 'pagem_url_cat' => $pagem_url_cat,
'link_page_num' => $link_page_num, 'cat_page_num' => $cat_page_num, 'url_cat' => $url_cat, 'affiliate_num' => $affiliate_num  ));<br>
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

echo '<h3>Block Two of the BungeeBones Hosted Web Directory Code </h3>';
echo '<p>You now only need to install the second block of code. It has some "bells and whistles" (it has dynamic, configurable meta tags that can be customised to your website).';


echo '
<h2>Simple, Basic Installation</h2>
<p>Paste this block of code AHEAD OF, IN FRONT OF and BEFORE any other code on your template page. ';
?>
<table><TR><TD  bgcolor="#CAC5C5">
&lt;?php $var = explode("/", $_SERVER['PATH_INFO']);<br>
//////// CONFIGURABLE /////////////<br>
//////// CONFIGURABLE /////////////<br>
//////// CONFIGURABLE /////////////<br>
//The next two settings are configurable by installer<br>
$debug_bungeebones = 0;//Change value from 0 to 1 to enter de-bug mode.<br>
//verify that the affiliate (i.e link) number below is yours to insure your affiliate credit and payments<br>
$affiliate_num = <?echo $link_selected;?> ;<br>
//////// END BungeeBones CONFIGURABLE - see end of snippet for more HTML changes/////////////<br>
//////// END BungeeBones CONFIGURABLE - see end of snippet for more HTML changes /////////////<br>
//////// END BungeeBones CONFIGURABLE - see end of snippet for more HTML changes /////////////<br>

$url_cat = $var[2] ;<br>

if(ISSET($_POST[url_cat])){<br>
$url_cat = $_POST[url_cat];}<br>
if(ISSET($_POST[cat_page_num])){<br>
$cat_page_num = $_POST[cat_page_num];}elseif($var[3] != ""){ $cat_page_num = $var[3];}<br>
if(ISSET($_POST[link_page_num])){<br>
$link_page_num = $_POST[link_page_num];}elseif($var[4] != ""){$link_page_num = $var[4];}<br>
if(ISSET($_POST[pagem_url_cat])){<br>
$pagem_url_cat = $_POST[pagem_url_cat];}elseif($var[5] != ""){ $pagem_url_cat = $var[5];}<br>
if(ISSET($_POST[link_page_id])){<br>
$link_page_id = $_POST[link_page_id];}elseif($var[6] != ""){ $link_page_id = $var[6];}<br>
if(ISSET($_POST[link_page_total])){<br>
$link_page_total = $_POST[link_page_total];}elseif($var[7] != ""){ $link_page_total = $var[7];}<br>
if(ISSET($_POST[link_record_num])){<br>
$link_record_num = $_POST[link_record_num];}elseif($var[8] != ""){ $link_record_num = $var[8];}<br>
//get the most local regional number by replacing furthest value<br>
if(ISSET($_POST[continent]) AND is_numeric($_POST[continent])){<br>
$regional_number = $_POST[continent] ;<br>
} elseif($var[9] != ""){ $regional_number = $var[9];}<br>
if(ISSET($_POST[country]) AND is_numeric($_POST[country])){<br>
$regional_number = $_POST[country] ;<br>
} elseif($var[9] != ""){ $regional_number = $var[9];}<br>
if(ISSET($_POST[state]) AND is_numeric($_POST[state])){<br>
$regional_number = $_POST[state] ;<br>
}elseif($var[9] != ""){ $regional_number = $var[9];}<br>
 if(ISSET($_POST[city]) AND is_numeric($_POST[city])){<br>
$regional_number = $_POST[city] ;<br>
}elseif($var[9] != ""){ $regional_number = $var[9];}<br>
if($debug_bungeebones == 1){<br>
print_r($var);<br>
echo '<br>
$url_cat = ',$url_cat;<br>
echo '<br>
$cat_page_num = ',$cat_page_num;<br>
echo '<br>
$link_page_num = ',$link_page_num;<br>
echo '<br>
$pagem_url_cat = ',$pagem_url_cat;<br>
echo '<br>
$link_page_id = ',$link_page_id;<br>
echo '<br>
$link_page_total = ',$link_page_total;<br>
echo '<br>
$link_record_num = ',$link_record_num;<br>
echo '<br>
$regional_number = ',$regional_number;<br>
}<br>
if(is_dir('modal')) { $modal= true; } <br>
?&gt;

<br>
&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;<br>
&lt;html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" dir="ltr"&gt;<br>
&lt;head&gt;

<br>

&lt;?PHP<br> <br> <font color="red">
//DO NOT place any meta tags here or they might be overridden by the dynamic ones coming next. Place your meta and CSS info after the next section of code and just before the closing head tag.<br>
</font>
<br>
<br>
<br>
$file ="http://BungeeBones.com/make_header/dyn_hdrcss.php";<br>
<br>
<br>
if($debug_bungeebones == 1){<br>
print_r($file);<br>
}<br>
$ch = curl_init();<br>
curl_setopt($ch, CURLOPT_URL, $file);<br>
curl_setopt($ch, CURLOPT_POSTFIELDS, array('url_cat' => $url_cat,'affiliate_num' => $affiliate_num)); <br>
curl_setopt($ch, CURLOPT_HEADER, 0);<br>
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);<br>
$data = curl_exec($ch);<br>
curl_close($ch);<br>
echo($data);<br>
<font color="red">//You may now follow our code with any meta tags you want but if they are any of the following: &lt;title&gt;, &lt;description&gt;, or &lt;Keywords&gt; tags then they will override the dynamic ones you set from the BungeeBones User Contol Panel . <br>
<br>
</font>
?&gt; 


<font color="red">
&lt;!-- Possible effect of duplicate "&lt;!DOCTYPE html" declaration <br>
There are three HTML tags are in the middle of the code above. <br>
Since you will be copying and pasting our code ahead of your existing HTML
code there is duplication. In our testing so far it hasn't hurt performance or functioning of the script but it may.<br><br>

You may want to try to COMMENT out the equivalent code that we already inserted above.--&gt;<br>
&lt;!--
HINT: Most often the DOCTYPE declaration will be the first line of your code. <br><br>
Comment it out as demonstrated below using the angle bracket, exclamation point, hyphen, hyphen (<!--) to start the comment and then use the hyphen, hyphen, opposite angle bracket (-->) to close it <br><br>
Example:
<br><br>
&lt;!--<br>&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;<br>
&lt;html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" dir="ltr"&gt;<br>
&lt;head&gt;<br>--&gt;
</font>
<br>

<br>
</td></tr></table>


<?

/*

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
//////// CONFIGURABLE /////////////<br>
//////// CONFIGURABLE /////////////<br>
//////// CONFIGURABLE /////////////<br>
//The next two settings are configurable by installer<br>
$debug_bungeebones = 0;//Change value from 0 to 1 to enter de-bug mode.<br>
//verify that the affiliate (i.e link) number below is yours to insure your affiliate credit and payments<br>
$affiliate_num = <?echo $link_selected;?> ;<br>
//////// END CONFIGURABLE /////////////<br>
//////// END CONFIGURABLE /////////////<br>
//////// END CONFIGURABLE /////////////<br>

$url_cat = $var[2] ;<br>

if(ISSET($_POST)){<br>
// grab the most local regional value that is set by replacing the previously found one<br>
if(ISSET($_POST[url_cat])){<br>
 $url_cat = $_POST[url_cat];}<br>
if(ISSET($_POST[cat_page_num])){<br>
$cat_page_num = $_POST[cat_page_num];}<br>
if(ISSET($_POST[link_page_num])){<br>
$link_page_num = $_POST[link_page_num];}<br>
if(ISSET($_POST[pagem_url_cat])){<br>
$pagem_url_cat = $_POST[pagem_url_cat];}<br>
if(ISSET($_POST[link_page_id])){<br>
$link_page_id = $_POST[link_page_id];}<br>
if(ISSET($_POST[link_page_total])){<br>
$link_page_total = $_POST[link_page_total];}<br>
if(ISSET($_POST[link_record_num])){<br>
$link_record_num = $_POST[link_record_num];}<br>
//get the most local regional number by replacing furthest value<br>
if(ISSET($_POST[continent]) AND is_numeric($_POST[continent])){<br>
$regional_number = $_POST[continent] ;<br>
}
if(ISSET($_POST[country])  AND is_numeric($_POST[country])){<br>
$regional_number = $_POST[country] ;<br>
}
if(ISSET($_POST[state])  AND is_numeric($_POST[state])){<br>
$regional_number = $_POST[state] ;<br>
}
if(ISSET($_POST[city])  AND is_numeric($_POST[city])){<br>
$regional_number = $_POST[city] ;<br>
}<br>


}<br>
if($debug_bungeebones == 1){<br>
print_r($var);<br>
echo '<br>
$url_cat = ',$url_cat;<br>
echo '<br>
$cat_page_num = ',$cat_page_num;<br>
echo '<br>
$link_page_num = ',$link_page_num;<br>
echo '<br>
$pagem_url_cat = ',$pagem_url_cat;<br>
echo '<br>
$link_page_id = ',$link_page_id;<br>
echo '<br>
$link_page_total = ',$link_page_total;<br>
echo '<br>
$link_record_num = ',$link_record_num;<br>
echo '<br>
$regional_number = ',$regional_number;<br>
}<br>
if(is_dir('modal')) { $modal= true; } <br>
?&gt;<br>
<font color="red">&lt;!DOCTYPE html&gt; </font><br>
&lt;head&gt;
<br>

&lt;? 
//DO NOT place any meta tags here or they might be overridden by the dynamic ones coming next. Place your meta and CSS info after the next section of code and just before the closing head tag.<br>

<br>
<br>
<br>
$file ="http://BungeeBones.com/make_header/dyn_hdrcss.php";<br>
<br>
<br>
if($debug_bungeebones == 1){<br>
print_r($file);<br>
}<br>
$ch = curl_init();<br>
curl_setopt($ch, CURLOPT_URL, $file);<br>
curl_setopt($ch, CURLOPT_POSTFIELDS, array('url_cat' => $url_cat,'affiliate_num' => $affiliate_num)); <br>
curl_setopt($ch, CURLOPT_HEADER, 0);<br>
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);<br>
$data = curl_exec($ch);<br>
curl_close($ch);<br>
echo($data);<br>
//You can place any meta tags here you want but they will override the dynamic ones by BungeeBones (if they are the same named tags). You can also place your scripts and CSS here ahead of the closing head tag.<br>
<br>

?&gt; 

<?

*/

echo '<h2>Tidy Up!</h2>
<p>As previously mentioned (in the block of code you inserted into the &lt;head&gt; section of your template) there are a few duplicate tags you should remove. <p>They are
<ul><li>The Doctype Declaration </li>
<li>The xmlns attribute</li>
<li>The "head" tag</li>
<li>The "Title" tag</li>
<li>The "Description" tag</li>
<li>The "Keyword" tag</li>
</ul>
<p>Failing to remove the "Title", "Description", or "Keyword" tags will be of minor effect. The still remaining tags will simply over ride the dynamic ones that the BungeeBones server sends at page load.
<p>Failing to remove the Doctype Declaration, the xmlns attribute and the "head" tag could possibly have bad results.
<p>See the actual code inside your template for more detailed instructions.
';
echo '<h2><font  color="red">Close This Modal To Return To Your User Control Page</font></h2></td></tr></table>';


} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}
