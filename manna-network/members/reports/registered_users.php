<?
 include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/access_user_class.php"); 
  $page_protect = new Access_user;
  $page_protect->access_page(); // only set this this method to protect your page
$page_protect->get_user_info();
$user_id=$page_protect->id;
$access_level=$page_protect->user_access_level;

$hello_name = ($page_protect->user_full_name != "") ? $page_protect->user_full_name : $page_protect->user;
$listing_type = ($page_protect->user_info != "") ? $page_protect->user_info : $page_protect->user;
$test_access_level = new Access_user;
$test_access_level->access_page($_SERVER['PHP_SELF'], "", 10); // change this value to test differnet access levels (default: 1 = low and 10 high)
$id=$page_protect->id;
$user_id=$page_protect->id;

if (isset($_GET['action']) && $_GET['action'] == "log_out"){
$test_access_level->log_out(); // the method to log off
}
if (isset($_GET['action']) && $_GET['action'] == "log_out"){
$page_protect->log_out(); // the method to log off
}

include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/reg_form/config.php"); //old yald, don't use db connects but use settings
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/classes/reports_class.php");  
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/connect.php");
include($_SERVER['DOCUMENT_ROOT']."/classes/security_class.php");  
//note the above security class was created new, first time for this reports page. If it works well then it
//should be added to all forms submitted by users. the three functions should be run on all data being submitted to database
//htmlspecialchars should be run on all data coming from data base displayed to users
//see  http://www.acunetix.com/websitesecurity/php-security-1.htm
//the sqlprotection uses some type of magicqutoes sdetection (looks like) verify during datasubmission with this form whether it correctly escapes quotes and single quotes
 $check_security = new security;
$link_selected =   $check_security ->sql_inj_protection($link_selected);
$code_type = $check_security ->sql_inj_protection($code_type);
//for now run _INPUT on each var individually to strip tags from get and post vars but eventually, make an array of all 
//get  and/or post vars (separate lists if mixed post and get vars present) and send them all en masse to the func

$link_selected = $check_security ->_INPUT($link_selected);
$code_type = $check_security ->_INPUT($code_type);
$link_selected = $check_security ->_ESCAPESHELL($link_selected);
$code_type = $check_security ->_ESCAPESHELL($ode_type);

$B1 = $_GET['B1']; //this B1 has not had tags stripped but next one does
if(isset($B1)){
/////////////////////////////////////////////////
$B1 = $check_security ->_INPUT($B1);//now B1 has had tags stripped

include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_top1.php");

?>

<script>

/*
Check required form elements script-
By JavaScript Kit (http://javascriptkit.com)
Over 200+ free scripts here!
*/

function checkrequired(which){
var pass=true
if (document.images){
for (i=0;i<which.length;i++){
var tempobj=which.elements[i]
if (tempobj.name.substring(0,8)=="required"){
if (((tempobj.type=="text"||tempobj.type=="textarea")&&tempobj.value==''||tempobj.value=="http://")||(tempobj.type.toString().charAt(0)=="s"&&tempobj.selectedIndex==-1)){
pass=false
break
}
}
}
}
if (!pass){
alert("One or more of the required elements are not completed. Please complete them, then submit again!")
return false
}
else
return true
}
</script>


<div id="doc2">					
	<div style="text-align: center; id=hd">
	<div style="text-align: center">
	
	
<div style="text-align: center;">
   				<a href="http://bungeebones.com/bungee_jumpers/" class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/reg_form" class="cssbutton sample a"><span>Add Link</span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/reports" class="cssbutton sample a"><span> Reports </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/update_user.php" class="cssbutton sample a"><span> Your Profile </span></a>&nbsp;<a href="http://bungeebones.com/feedback.php" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="http://bungeebones.com/articles/terms_of_service.php/" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
					</div><div id="bd">

<form name="form1" method="GET" action="http://bungeebones.com/bungee_jumpers/reg_form/insert_directory_instr.php"  onSubmit="return checkrequired(this)">
							 
				

		

<div id="display"></div>
<?
//////////////////////////////////////////////////
$register_info = new mobile;


if($_GET['folder_name']){
$folder_name =$_GET['folder_name'];
echo '<div style="font-size: 150%;">folder_name = ', $folder_name;

	if($_GET['file_name']){
	$file_name=$_GET['file_name'];



	echo '<br>file_name = ', $file_name;
	}
	else
	{
	echo 'ERRROR: You entered a folder name to hold your distributed web directory but you did not name the file. Please return and add a name such as "index.php" being sure to use a php extension';
	}
	if($_GET['custom_title1']){
	$custom_title1 = $_GET['custom_title1'];
	echo '<br>custom_title1 = ', $custom_title1;
	}
	else
	{
	echo 'ERRROR: You entered a folder name to hold your distributed web directory and/or a file name but you did not enter a first half of your custom title. Though the script will work without one you might be losing some valuable SEO features by omitting it.';
	
	}
	if($_GET['custom_title2']){
	$custom_title2 = $_GET['custom_title2'];
	echo '<br>custom_title2 = ', $custom_title2;
	}
	else
	{
	echo 'ERRROR: You entered a folder name indicating an interest to host a distributed web directory but you did not enter a second half of your custom title. Though the script will work without one you might be losing some valuable SEO features by omitting it.';
	
	}

if($_GET['brand']){
$brand = $_GET['brand'];
	
echo '<br>You selected the  ';
		if($brand=="adv"){
		echo "AdvertiSite brand";
		}
		else
		{
		
		echo "BungeeBones brand";
		}

	}
	else
	{
	echo 'ERRROR: You entered information indicating an interest to host a distributed web directory but you did not select which brand you wanted (i.e. BungeeBones or AdvertiPage). The default brand is BungeeBones. If you click "continue" you will receive code from the BungeeBones brand. If that is not what you want then click the back button and select the AdvertiPage brand..';
	
	}



echo '</div>';
}else
{
echo'<p>&nbsp;</p><p>&nbsp;</p><div style="font-size: 150%;"><h2>You didn\'t enter required information)';
exit();
}
							


$display_freebies = $_GET['display_freebies'];

$time_period = $_GET['time_period'];
echo '<p>&nbsp;</p><div><form action="<?= $_SERVER[';
echo "'PHP_SELF']?>";
echo ' id="searchform" method="post">';
										     
										



	
		echo ' 	<input type="hidden" name="link_selected" value="'.  $link_selected .'">
			<input type="hidden" name="code_type" value="'.$code_type .'">

<input type="hidden" name="brand" value="'. $_GET['brand'].'">';
if($_GET['folder_name']){
echo '
<input type="hidden" name="folder_name" value="'. $_GET['folder_name'] .'">
<input type="hidden" name="file_name" value="'. $_GET['file_name'] .'">
<input type="hidden" name="custom_title1" value="'. $_GET['custom_title1'] .'">
<input type="hidden" name="custom_title2" value="'. $_GET['custom_title2'] .'">
<input type="hidden" name="display_freebies" value="'. $_GET['display_freebies'].'">
<input type="hidden" name="meta_descrip" value="'. $_GET['meta_descrip'].'">
<input type="hidden" name="keywords" value="'. $_GET['keywords'].'">';

	if($_GET['display_freebies']=1){
	echo'
	<input type="hidden" name="time_period" value="'. $_GET['time_period'].'">';
	}
}


$sql = "SELECT `url`, `category` FROM `links` WHERE `url`='$url'";

$result = @mysql_query($sql, $connect) or die("Couldn't execute 'Edit 3 Account' query");
	do
	{
	$test_url = $row['url'];
$existing_categories[] = $row['category'];
	}while ($row = mysql_fetch_array($result));
	$test_url_lower = strtolower($test_url);
	$url_lower = strtolower($url);
	

		
echo'
<INPUT TYPE="button" VALUE="Go Back" onClick="history.back()">
			<input type="submit" value="Continue and Finish" name="C1">
			</FORM></div>
';


?>
</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
	<div id="ft">
	<div style="text-align: center"><a href="http://BungeeBones.com">HOME</a>  <a href="http://BungeeBones.com/articles">ARTICLES</a>  <a href="http://BungeeBones.com">FAQ </a>	 <a href="http://BungeeBones.com/feedback.php"> CONTACT US </a>  <a href="http://BungeeBones.com/bungee_jumpers/reg_form">REGISTER</a>  <a href="http://BungeeBones.com/bungee_jumpers/login.php">LOGIN</a></div>
                                                                                                                                                                                                                                                                                                                

<div style="text-align: center"><a href="http://BungeeBones.com/bungee_bones">OUR LINK EXCHANGE/DIRECTORY</a> <a href="http://BungeeBones.com/subscription_sites">EXAMPLE SITES</a> </div><a target="_blank" href="http://twitter.com/Bungeebones">BB TWITTER </a>


  
</div>

</div>
</div>

<?
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_bottom1.php");

exit();
}//close ifisset$B1

$C1 = $_GET['C1'];

If(isset($C1)){

include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_top1.php");

	$street=$_GET['street'];
	$zip=$_GET['zip'];
	$phone=$_GET['phone'];
	$brand=$_GET['brand'];
	$cat_id=$_GET['cat_id'];
	$url=$_GET['url'];
	$title=$_GET['title'];
	$link_description=$_GET['link_description'];
	$multiple=$_GET['multiple'];
$start_date = time();//entered in insert query - tells when link was added
	
if(isset($_GET['folder_name'])){
$folder_name= $_GET['folder_name'];
$file_name= $_GET['file_name'];
$custom_title1= $_GET['custom_title1'];
$custom_title2= $_GET['custom_title2'];
$display_freebies= $_GET['display_freebies'];
$time_period= $_GET['time_period'];
}								
$link_selected = $_GET['link_selected'];
$code_type = $_GET['code_type'];
echo'	
<div style="text-align: center;">
   				<a href="http://bungeebones.com/bungee_jumpers/" class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/reg_form" class="cssbutton sample a"><span>Add Link</span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/reports" class="cssbutton sample a"><span> Reports</span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/update_user.php" class="cssbutton sample a"><span> Your Profile </span></a>&nbsp;<a href="http://bungeebones.com/feedback.php" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="http://bungeebones.com/articles/terms_of_service.php/" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
					</div>';

								
									echo '<div style="font-size: 175%; color:#000080; text-align: left; line-height: 200%"><p>Thank You! Your code';
										
										echo ' was created successfully 
										and is now awaiting your installation.</p>
							';


echo '<h1>Your code is below</h1>And remember! Just for installing the web directory you can get a 50% discount for any paid advertising you wish to place in BungeeBones plus the multi-level, residual income you will earn from both your own and your downline\'s paid link sales. Now use the the instructions in the accordian help section below to guide you on the install. <p>Thanks for using and contributing to BungeeBones web traffic volume to our other members.';



echo '<p>Sincerely,
<p>Robert Lefebure
<p>Owner/developer of BungeeBones<p>&nbsp;</p>';


echo'</div>';

//////////////////////////////////Begin the widget code form display////////////////////////////////////////////
if(!$folder_name==""){

?> 
<p>&nbsp;</p><p>&nbsp;></p></p><iframe id="buffer2" name="buffer2" src="http://bungeebones.com/bungee_jumpers/reg_form/accordion_widget_install.php?url=<?echo $url; ?>&folder_name=<?echo $folder_name;?>&file_name=<?echo $file_name;?>" width="700" border="0"height="275"
></iframe>
<p align="left">&nbsp;</p>
<p align="left">&nbsp;</p><p align="left">&nbsp;</p>
<?
if($code_type=="template"){
?>
<h3 style="font-size: 150%; ">Template Code Generates a Complete Page(you add text and images)</h3>
<table border="1" cellpadding="5" cellspacing="0"  bordercolor="#C0C0C0" width="100%" id="AutoNumber1">
  <tr>
    <td>
		
		
		
<p  style="font-size: 150%; text-align: left;">
To use the BungeeBones Web Directory paste the code below into your own blank web page at the location you just entered (i.e. at <?echo $url . "/" . $folder_name . "/" . $file_name ?>

and/or scroll down for the Format Two code</p> <p align="left">&nbsp;</p><p align="left">&nbsp;</p><p align="left">&nbsp;</p><hr>
</td></tr><tr><td bgcolor="cccccc">		&lt;?php
		
    $var = explode(&quot;/&quot;, $_SERVER['PATH_INFO']);<br>
    //verify that the affiliate number below is yours to insure your affiliate 
    credit and payments<br>
    $affiliate_num = <?echo $link_selected?> ;<br>
    $affiliate_num_test = $var[1] ;//repnaming header_ID<br>
    $url_cat = $var[2] ;//repnaming header_ID<br>
    $cat_record_num = $var[3] ;//part 3 of cat series<br>
    $cat_page_total = $var[4] ;//part 2 of cat series<br>
    $cat_page_id = $var[5] ;//part 2 of cat series<br>
    $link_page_id = $var[6] ;//part 2 of link series<br>
    $link_page_total = $var[7] ;//part 3 of link series<br>
    $link_record_num = $var[8] ;//part 3 of link series<br>
    <br>
    <br>
 		?&gt;<br>
&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;<br>
	&lt;html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" dir="ltr"&gt;<br>
&lt;head&gt; <br>

&lt;? 
<br>
<br>
$file ="http://BungeeBones.com/make_header/dyn_hdr2.php/$url_cat/$affiliate_num";<br>

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
///////////////////  add any of your own head info, body tag info,table, html, menu of your site here/////////<br>
///////////////////  add link to your own css file to over ride font style settings to match your site/////////
///////////////// start //// 
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


&lt;td width="72%" height="509"&gt; <br>
&lt;p align="center"&gt; <br>
      
			<br>
&lt;?<br>
    //////////////////////////////////////////////<br>
		
		?&gt;

&lt;p align="left"&gt;&lt;font size="4" color="red"&gt;Verify Your Install
&lt;p align="left"&gt;Test 1: Verify your ID Number Is Accurate: Scroll over the links (i.e. the category names) in the directory below. Depending on your browser version you may simply be able to mouseover the category names to see the url or you may have to click one. Verify that they are working. If the main page loads, but the links are broken then please contact us.
&lt;p align="left"&gt;Test 2: And as a similar test to the above, click the ADD A Link banner at the bottom of the category display. A smaller window opens and explains they are about to leave your site. Similar to above mouseover or click the banner of the bottom of that page and check the url. Is there a number after the url to BungeeBones.com? If so, the install was a success.  If not, please review the instructions, troubleshooting page or contact us.
&lt;p align="left"&gt;Test 3: If the browser didn't blast you with error messages then the dynamic headers are probably fine but checking them now may help you with your customising work. Open up the different categories and subcategories and notice the Title bar in the browser. If you aren't sure what I mean, then look at the souce code of the different pages in their &lt;head&gt; section at their meta tag info. Look to see that the title, description, and metatags are displaying properly. The title should be displaying your custom title1 and custom title2 that you set in the configuration. The current category should be sandwhiched in between them and should also be a part of the keywords tag. The category should also appear at the front of the page description. 
<br>
<br>
//&lt;?
<br>
<br>
$file="http://Bungeebones.com/link_exchange/index.php/$affiliate_num/$url_cat/$cat_record_num/$cat_page_total/$cat_page_id/$link_page_id/$link_page_total/$link_record_num";<br>
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
		<br>	right hand margin text here 
		<br>	right hand margin text here 
		<br>	right hand margin text here 
		<br>	right hand margin text here 
		<br>	right hand margin text here 
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


<?

}
else
{
////////////////////////////////////////////////////end the widegt code form display////////////////////////////

echo '<h3>Or Use The Next Two Blocks in Your Own Page template</h3>';
echo '<table border="1" cellpadding="5"><tr><td style="font-size: 150%">';
echo '<h3> Part One of Format Two Code </h3>';
echo '<p>Paste this code into one of your own website\'s template page\'s &lt;Head&gt; section, pasting over everything above the closing head tag (i.e. leave the original closing &lt;/head&gt; tag)';
echo "<p>&nbsp;</><p>&nbsp;</p>";

?>
</td></tr><tr><td bgcolor="#95B9C7">
		&lt;?php<br>
		
    $var = explode(&quot;/&quot;, $_SERVER['PATH_INFO']);<br>
    //verify that the affiliate number below is yours to insure your affiliate 
    credit and payments<br>
    $affiliate_num = <?echo $this_links_ID_num;?> ;<br>
    $affiliate_num_test = $var[1] ;//repnaming header_ID<br>
    $url_cat = $var[2] ;//repnaming header_ID<br>
    $cat_record_num = $var[3] ;//part 3 of cat series<br>
    $cat_page_total = $var[4] ;//part 2 of cat series<br>
    $cat_page_id = $var[5] ;//part 2 of cat series<br>
    $link_page_id = $var[6] ;//part 2 of link series<br>
    $link_page_total = $var[7] ;//part 3 of link series<br>
    $link_record_num = $var[8] ;//part 3 of link series<br>
    <br>
    <br>
		?&gt;<br>
&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;<br>
	&lt;html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" dir="ltr"&gt;<br>
&lt;head&gt;<br>

&lt;? <br>
<br>
<br>
$file ="http://BungeeBones.com/make_header/dyn_hdr2.php/$url_cat/$affiliate_num";<br>

$ch = curl_init();<br>
curl_setopt($ch, CURLOPT_URL, $file);<br>
curl_setopt($ch, CURLOPT_HEADER, 0);<br>
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);<br>
$data = curl_exec($ch);<br>
curl_close($ch);<br>
echo($data);<br>
?&gt;
<?
echo '</td></tr></table>';
echo '<table border="1" cellpadding="5"><tr><td style="font-size: 150%">';
echo '<h3>Part Two of Format Two</h3>';
echo '<p>Paste this code into the &lt;body&gt; of your own website\'s template page, pasting anywhere in the page you like.';
echo "<p>&nbsp;</><p>&nbsp;</p>";

?><br>
</td></tr><tr><TD bgcolor="#C9BE62">
&lt;?
<br>
<br>
$file="http://Bungeebones.com/link_exchange/index.php/$affiliate_num/$url_cat/$cat_record_num/$cat_page_total/$cat_page_id/$link_page_id/$link_page_total/$link_record_num";<br>
$ch = curl_init();<br>
curl_setopt($ch, CURLOPT_URL, $file);<br>
curl_setopt($ch, CURLOPT_HEADER, 0);<br>
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);<br>
$data = curl_exec($ch);<br>
curl_close($ch);<br>
echo($data);<br>
    ////////////////////////////////////////////////////<br>
   ?&gt;
	
<?
echo '</td></tr></table>';
?>
<h2 align="left">That Should Do It!!</h2>
<p align="left"> Check your work by opening <b>www.your-site.com/<?echo $folder_name;?>/<?echo $file_name;?> </b>with your browser. You should have a webpage there with a working and populated web directory. 
If you have any problems just drop us a message using the contact form in the menu.
<p>&nbsp;</p>


<h3 align="left">Custom CSS</h3>
<p align="left">		 

You can add any of your own metatags and/or css style settings to the above code as long as you place them immediate before the closing &lt;/head&gt; tag. <br>Yours will over-ride the default settings and will customize the directory on your site. 
   
   But if you add title or description metatags tags, however, it 
    will nullify and override the BungeeBones dynamic ones. This would make every displayed page have the same meta tag information. It is not recommended to add your own title or description tags.
	</p>

<?
}//closes else is barebones
}//closes if !folder
										
										echo '<br><p>&nbsp;</p><a href="/bungee_jumpers/reg_form/index.php">Submit Another Link</a><br><br>';
										echo '<br><a href="/advertisers/index.php">Go To Control Panel</a>';
										unset($B1);
										unset($C1);
										include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_bottom1.php");

										exit(1);
										
										
										}//closes if C1
										else// begin form
										{

$link_selected = $_GET['link_selected'];
$report_type = $_GET['report_type'];
////////////////////////////////////////////////////

include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_top1.php");
 $get_reports = new reports;
//get a list of all BB users (each user listed just once)
 $uniqueBB_user_list = $get_reports ->getAllUsers();
foreach( $uniqueBB_user_list as $key => $value){
//get each users links and store the link number in array tied to their link id number
$this_userslist_of_links[$key] = $get_reports ->getAllLinks($uniqueBB_user_list[$key]);
//get the number of links each user has enterd by getting the count of that array
// and id it by using the user id
$count_of_links[$uniqueBB_user_list[$key]]=count($this_userslist_of_links[$key]);
}
echo '<br> $this_userslist_of_links[$key] = <br>';
print_r($this_userslist_of_link);

//sort the list by users who have added the most links(desc order)
$this_userslist_of_linkssortedadescending = arsort($count_of_links);
//print out report
foreach( $count_of_links as $key => $value){
//set limits to report
if($count_of_links[$key] >3){
echo "<br>User number $key has entered ". $count_of_links[$key]." links";
}
}

$new_this_userslist_of_links  = asort($count_of_links);
print_r($new_this_userslist_of_links);

 $widgets_list = $get_reports ->getAllwidgets();
$downline_list = $get_reports ->getDownline($link_selected);
$this_users_total_links = $get_reports ->getNumLinks($user_id);
$this_userslist_of_links = $get_reports ->getAllLinks($user_id);
foreach($widgets_list as $key => $value){
echo "<br>widget list $key Link ID = ", $widgets_list[$key];
$downline_list = $get_reports ->getDownline($widgets_list[$key]);
if(count($downline_list)>0){
foreach($downline_list as $key2 => $value2){
$this_users_total_links = $get_reports ->getNumLinks($downline_list[$key2]);
echo '<br>&nbsp;&nbsp;&nbsp; Signed up User # ', $downline_list[$key2]. 'who has entered '. $this_users_total_links . ' links ';

}
}//end if count
}
?>

<div id="doc2">					
	<div style="text-align: center; id=hd">
	<div style="text-align: center">
	
<div style="text-align: center;">
   				<a href="http://bungeebones.com/bungee_jumpers/" class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/reg_form" class="cssbutton sample a"><span>Add Link</span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/reports" class="cssbutton sample a"><span> Reports </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/update_user.php" class="cssbutton sample a"><span> Your Profile </span></a>&nbsp;<a href="http://bungeebones.com/feedback.php" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="http://bungeebones.com/articles/terms_of_service.php/" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
					</div>
<div id="bd">

  <h3><a href="/bungee_jumpers/index.php">Return To Your User Control Panel</a></h3>
			   
					<?

?>
</div>
	<div id="ft">
	<div style="text-align: center"><a href="http://BungeeBones.com">HOME</a>  <a href="http://BungeeBones.com/articles">ARTICLES</a>  <a href="http://BungeeBones.com">FAQ </a>	 <a href="http://BungeeBones.com/feedback.php"> CONTACT US </a>  <a href="http://BungeeBones.com/bungee_jumpers/reg_form">REGISTER</a>  <a href="http://BungeeBones.com/bungee_jumpers/login.php">LOGIN</a></div>
                                                                                                                                                                                                                                                                                                                

<div style="text-align: center"><a href="http://BungeeBones.com/bungee_bones">OUR LINK EXCHANGE/DIRECTORY</a> <a href="http://BungeeBones.com/subscription_sites">EXAMPLE SITES</a> </div><a target="_blank" href="http://twitter.com/Bungeebones">BB TWITTER </a>

  
</div>

</div>
</div>

<?
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_bottom1.php");

}//close ifisset B1