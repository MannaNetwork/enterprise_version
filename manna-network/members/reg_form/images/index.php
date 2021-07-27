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
$test_access_level->access_page($_SERVER['PHP_SELF'], "", 1); // change this value to test differnet access levels (default: 1 = low and 10 high)
$id=$page_protect->id;
$user_id=$page_protect->id;

if (isset($_GET['action']) && $_GET['action'] == "log_out"){
$test_access_level->log_out(); // the method to log off
}
if (isset($_GET['action']) && $_GET['action'] == "log_out"){
$page_protect->log_out(); // the method to log off
}

include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/reg_form/config.php"); //old yald, don't use db connects but use settings
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/reg_form/classes/mobile_class.php");  
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/connect.php");



$B1 = $_GET['B1'];

if(isset($B1)){
/////////////////////////////////////////////////
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_top1.php");

?><script>

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
   				<a href="http://bungeebones.com/bungee_jumpers/" class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;<a  class="cssbutton sample b"><span>Add Link</span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/reg_form/insert_directory_instr.php" class="cssbutton sample a"><span> Get A Widget </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/update_user.php" class="cssbutton sample a"><span> Your Profile </span></a>&nbsp;<a href="http://bungeebones.com/feedback.php" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="http://www.bungeebones.com/index.php?option=com_content&view=article&id=5:bungeebones-terms-of-service&catid=25:the-project&Itemid=2" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
					</div>
<div id="bd">

<form name="form1" method="GET" action="http://bungeebones.com/bungee_jumpers/reg_form/index.php"  onSubmit="return checkrequired(this)">
							 
				

		

<div id="display"></div>
<?
//////////////////////////////////////////////////
$register_info = new mobile;
if(isset($_GET['regional_number'])){
$regional_number=$_GET['regional_number'];
//echo '<br>regional_number = ', $regional_number;
$brand=$_GET['brand'];

if($_GET['plugin']){
$plugin=$_GET['plugin'];
}
$regional_name = $register_info->getRegionName($regional_number);
//echo '<br>regional_name = ', $regional_name;
 $regional_path = $register_info->regionPath($_GET['cat_id'], $regional_number);
//echo '<br>regional_path = ', $regional_path;
//echo '<br>count of regional_path = ', count($regional_path);
//for each region in regional path display its name
foreach($regional_path as $key => $value){

if($key==0){

echo "<br>Continent = ";
echo  $regional_path[$key];
}
elseif($key==1){
echo "<br>Country = ";
echo  $regional_path[$key];
}
elseif($key==2){
echo "<br>State = ";
echo  $regional_path[$key];
}
elseif($key==3){
echo "<br>City = ";
echo  $regional_path[$key];
}
}//close foreach



}

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
	
			if($_GET['plugin']){
			$plugin = $_GET['plugin'];
				
			
				if($plugin=="joomla"){
				echo "You are going to install in a JOOMLA! powered website.";
				}
				elseif($plugin=="wordpress"){
				echo "You are going to install in a WordPress powered website.";
				
				}
	
			
			}

	}
	else
	{
	echo 'ERRROR: You entered information indicating an interest to host a distributed web directory but you did not select which brand you wanted (i.e. BungeeBones or AdvertiPage). The default brand is BungeeBones. If you click "continue" you will receive code from the BungeeBones brand. If that is not what you want then click the back button and select the '. BRAND .'  brand..';
	
	}



echo '</div>';
}else
{
echo'<p>&nbsp;</p><p>&nbsp;</p><div style="font-size: 150%;"><h2>We are sorry to see you have not opted to add a hosted web directory to your website!</h2><p align="left"> Every new hosted web directory adds to the pool of web traffic. We really need your help! Please, reconsider and go back and configure a hosted web directory for your website!
<p> To continue without your free hosted web directory script for your website review the following information and, if correct, click "Continue" or use the "Back" button to make changes.</div>';
}
							

$cat_id = $_GET['cat_id'];

$cat_name = $register_info->getCatName($cat_id);
echo '<br>category name: ', $cat_name;
$cat_path = $register_info->categoryPathfordisplay($cat_id, $regional_number);
echo '<br>category path: ', $cat_path;


$url = $_GET['requiredurl'];
echo '<br>url = ', $url;
$title = $_GET['requiredtitle'];
echo '<br>title (in directory listing): ', $title;
$link_description = $_GET['requiredlink_description'];
echo '<br>link_description = ', $link_description;

if($_GET['street'] != "" AND $regional_path[3] != ""){
$street=$_GET['street'];
echo '<br>street = ', $street;
}
elseif($_GET['street'] != "" and $regional_path[3] == ""){


echo '<div style="color: red">You added street information but but did not select a city. <br>Your Street Address cannot be displayed unless you select a city. To do so, go back to the "Add Regional Info" section, select your city from the drop down menus <b><u>AND</u></b> click the "Get ________" link that appears for your city. <br>If you choose to continue the information will not be displayed unless you update your regional city location.</div>';
}
if(!$zip==""){
$zip=$_GET['zip'];
echo '<br>zip = ', $zip;
}
if(!$phone==""){
$phone=$_GET['phone'];
echo '<br>phone = ', $phone;
}

$display_freebies = $_GET['display_freebies'];

$time_period = $_GET['time_period'];
echo '<p>&nbsp;</p><div><form action="<?= $_SERVER[';
echo "'PHP_SELF']?>";
echo ' id="searchform" method="post">';
										     
										


if($_GET['street']){ echo '<input type="hidden" name="street" value="'. $_GET['street'].'">';}
if($_GET['zip']){ echo '<input type="hidden" name="zip" value="'. $_GET['zip'].'">';}
if($_GET['phone']){echo '  <input type="hidden" name="phone" value="'. $_GET['phone'].'">';}
	
		echo ' 	<input type="hidden" name="cat_id" value="'. $cat_id .'">
			<input type="hidden" name="url" value="'. $_GET['requiredurl'].'">
			<input type="hidden" name="title" value="'. $_GET['requiredtitle'].'">
			<input type="hidden" name="link_description" value="'. $_GET['requiredlink_description'].'">
			<input type="hidden" name="start_date" value="'. time().'">
			<input type="hidden" name="brand" value="'. $_GET['brand'].'">';
if($_GET['folder_name']){
echo '
<input type="hidden" name="folder_name" value="'. $_GET['folder_name'] .'">
<input type="hidden" name="file_name" value="'. $_GET['file_name'] .'">
<input type="hidden" name="custom_title1" value="'. $_GET['custom_title1'] .'">
<input type="hidden" name="custom_title2" value="'. $_GET['custom_title2'] .'">
<input type="hidden" name="display_freebies" value="'. $_GET['display_freebies'].'">
<input type="hidden" name="plugin" value="'. $_GET['plugin'].'">';
	if($_GET['display_freebies']=1){
	echo'
	<input type="hidden" name="time_period" value="'. $_GET['time_period'].'">';
	}
}
if(isset($regional_number)){
echo'			
<input type="hidden" name="regional_number" value="'. $regional_number.'">';
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
	

foreach($existing_categories as $key => $value){

 

if($url_lower == $test_url_lower and $existing_categories[$key] == $cat_id)
{
// this user has already submitted at least on free link already
echo "You have already entered that link into this category ";
}

}

	if($url_lower == $test_url_lower and $existing_categories[$key] == $cat_id)
	{
	//	include("../articles/include_top.txt");
	echo '<div style="line-height: 300%"><p align="left"><font size="7">Oops!!!</font</div>;
		<img border="0" src="/images/Embarrassed_Chimpanzee.jpg" width="200" height="160"></p>
		<p align="left">&nbsp;</p>
		<div style="line-height: 350%"><p align="left"><font size="5">You have already entered that link into this category. You can add the link to other categories or subcategories for a modest fee, or you can add another link to this one, but you cannot add the same link, to the same category multiple times.
			</font></p>
		<p align="left">You can use the <font size="7" color="#008080"><b>B</b></font><b><font size="7" color="#008080">ROWSER BACK BUTTON</font></b> 
			<p>to return to 
			your website registration page or the "Go Back" button below.</p>
		<p align="left">&nbsp;Thank you</p></div>
<INPUT TYPE="button" VALUE="Go Back" onClick="history.back()">
			
			</FORM></div>

';
		//  include("../articles/include_bottom.txt"); 
		//exit();
		} 
	elseif($url_lower == $test_url_lower)
	{
	//	include("../articles/include_top.txt");
	echo '
<input type="hidden" name="multiple" value="1">

		<div style="line-height: 350%"><p align="left"><font size="5">Our records indicate you have already entered that link and have used your complimentary free submission
<p>If you continue you will be entering your link as a paid link in a different category  (one that is in addition to and other than than your original free, complimentary listing).</p>
<p>Please check a box below to indicate which charge you agree to</p>
<form action="php self" method="get">
  
<div>
<table width="640" cellspacing="4" border="1" cellpadding="4" bgcolor="#e5e5e5">
<tr><td colspan="3"><h2 align="center"> A Guaranteed Listing Placement On the Selected Page of the Category</h2></td></tr>
 <tr><td rowspan="5"><h4>Your Link On First Results Page<br>for $2.00 per month</h4></td></tr>
 <tr></td><td colspan="2"><font color="red"><b>Select Payment Plan Preference</b></font></tr>
<tr><td style="font-size: 75%";line-height:50%">A "Per Month" Listing (you will be billed monthly) </td><td> &nbsp;<input type="radio"  name="contract_length" value="01-01-2.00" size="1" maxlength="1" />&nbsp;<td></tr>
 <tr><td style="font-size: 75%";line-height:50%">A Two Month Listing (you will be billed every other month) </td><td>&nbsp;<input type="radio"  name="contract_length" value="01-02-2.00" size="1" maxlength="1" />&nbsp;<td></tr>
 <tr><td style="font-size: 75%";line-height:50%">A Six Month Listing (you will be billed every 6 months) </td><td>&nbsp;<input type="radio"  name="contract_length" value="01-06-2.00" size="1" maxlength="1" />&nbsp;<td></tr>

</table>
</div>
</form>

 
			</p></font></div>


';
if(!isset($brand)){	
echo'<div style="line-height: 350%"><p align="left"><font size="5">If you later reconsider your decision and do install the web directory on your site then half of the above fees will be rebated to you as commissions. To take advantage of this fantastic advertising deal simply add the web directory to your website anytime within the next 15 days</font></p></div> '; 
}
else
{
echo'<div style="line-height: 350%"><p align="left"><font size="5">Great News! Because you chose to install the web directory on your site then half of the above fees will be rebated to your account as commissions. To take advantage of this fantastic advertising deal complete the installation of the web directory to your website anytime within the next 30 days and a link from at least the home page menu to the directory. Remember, we are here to help with installation if you have any problems.</font></p></div> '; 

}



echo'<div style="line-height: 350%; border: 3px coral solid;"><p align="left"><font size="5">BILLING: The first month is free. You will receive an invoice via email. We accept all major credits through the safe and secure PayPal system. If you install the distributed web directory and make paid link sales then as soon as commissions acrue to a sufficient level ad payment fees will be retrieved from that balance and a receipt (instead of an invoice) will be emailed.. </font></p></div> '; 
echo'<INPUT TYPE="button" VALUE="Go Back" onClick="history.back()"><input type="submit" value="Continue and Finish" name="C1">
			
			
			</FORM></div>';
	//  include("../articles/include_bottom.txt"); 
		//exit();
		} 
	else
{		
echo'
<INPUT TYPE="button" VALUE="Go Back" onClick="history.back()">
			<input type="submit" value="Continue and Finish" name="C1">
			</FORM></div>
';
}


?>
</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
	<div id="ft">
	<div style="text-align: center"><a href="http://BungeeBones.com">HOME</a>  <a href="http://BungeeBones.com/articles">ARTICLES</a>  <a href="http://BungeeBones.com">FAQ </a>	 <a href="http://BungeeBones.com/feedback.php"> CONTACT US </a>  <a href="http://BungeeBones.com/bungee_jumpers/reg_form">REGISTER</a>  <a href="http://BungeeBones.com/bungee_jumpers/login.php">LOGIN</a></div>
                                                                                                                                                                                                                                                                                                                

<div style="text-align: center"><a href="http://BungeeBones.com/bungee_bones">OUR LINK EXCHANGE/DIRECTORY</a> <a href="http://BungeeBones.com/subscription_sites">EXAMPLE SITES</a> </div><a target="_blank" href="http://twitter.com/Bungeebones">BB TWITTER </a>
<div style="text-align: center">
    <a href="http://validator.w3.org/check?uri=referer"><img
        src="http://www.w3.org/Icons/valid-xhtml10-blue"
        alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a>
  </div>
  
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
$plugin=$_GET['plugin'];
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

$register_info = new mobile;
if(isset($_GET['regional_number'])){
$regional_number=$_GET['regional_number'];
$regional_path = $register_info->regionPathnums($regional_number);
}

$street = mysql_real_escape_string($street);
	$zip = mysql_real_escape_string($zip);
	$phone = mysql_real_escape_string($phone);
	$brand = mysql_real_escape_string($brand);
$plugin = mysql_real_escape_string($plugin);
	$cat_id = mysql_real_escape_string($cat_id);
	$url = mysql_real_escape_string($url);
	$title = mysql_real_escape_string($title);
	$link_description = mysql_real_escape_string($link_description);
	$multiple = mysql_real_escape_string($multiple);
$folder_name = mysql_real_escape_string($folder_name);
$file_name = mysql_real_escape_string($file_name);
$custom_title1 = mysql_real_escape_string($custom_title1);
$custom_title2 = mysql_real_escape_string($custom_title2);
$display_freebies = mysql_real_escape_string($display_freebies);
$time_period = mysql_real_escape_string($time_period);

$regional_number = mysql_real_escape_string($regional_number);
$regional_path = $register_info->regionPathnums($regional_number);
















$query = "INSERT INTO `links` (";
									if($_GET['multiple'])
									{
										if($_GET['contract_length'] ){
										$query .= "`contract_length`,";
										}
										else
										{
										echo '<div style="line-height: 300%"><p align="left"><font size="7">Oops!!!</font</div>;
		<img border="0" src="/images/Embarrassed_Chimpanzee.jpg" width="200" height="160"></p>
		<p align="left">&nbsp;</p>
		<div style="line-height: 350%"><p align="left"><font size="5">You must select a payment plan preference. . 	</font></p>
		<p align="left">You can use the <font size="7" color="#008080"><b>B</b></font><b><font size="7" color="#008080">ROWSER BACK BUTTON</font></b> 
			<p>to return to 
			plan selection form or the "Go Back" button below.</p>
		<p align="left">&nbsp;Thank you</p></div>
<form><INPUT TYPE="button" VALUE="Go Back" onClick="history.back()">
			
			</FORM></div>

';exit();
}
									}
									if($_GET['multiple'])
									{
									$query .= "`multiple`,";
									}
									if(isset($street))
									{
									$query .= "`street`,";
									}
									if(isset($zip))
									{
									$query .= "`zip`,";
									}
									if(isset($phone))
									{
									$query .= "`phone`,";
									}

if(isset($_GET['folder_name'])){
$query .= "`folder_name`,";
$query .= "`file_name`,";
$query .= "`brand`,";
if(isset($_GET['plugin'])){
$query .= "`plugin`,";
}
$query .= "`custom_title1`,";
$query .= "`custom_title2`,";
$query .= "`display_freebies`,";
$query .= "`time_period`,
";


}



									$query .= "   `BB_user_ID`, `freebie` ,`category` , `url` , `name` , `description`,  `start_date`) values (";
									
									if($_GET['contract_length'] AND $_GET['multiple']) //this should not be reached if previous filters are working but if they don't select a radio button the link should not be submited
										{
										if($_GET['contract_length'])
										{
										$query .=  "'". $_GET['contract_length']."',";
										}
	
										if($_GET['multiple']){
										$query .=  "'1',";
										}
									}
									if(isset($street))
									{//countries value
									$query .=  "'". $street."',";
									}
									if(isset($zip))
									{//states
									$query .=  "'". $zip."',";
									}
									if(isset($phone))
									{
									$query .=  "'". $phone."',";
									}
									
if(isset($_GET['folder_name'])){
$query .= "'". $folder_name."',";
$query .= "'". $file_name."',";
if($brand=="bun"){
$query .= "'bun',";
//if they didn't select a brand default to the bungeebones brand else use what they selected (which mayy be BungeeBones anyway0
define("BRAND", "BungeeBones");
}
else
{
$query .= "'". $brand."',";
define("BRAND", "AdvertiPage");

}
if($plugin=="joomla"){
$query .= "'joomla',";
define("PLUGIN_BRAND", "JOOMLA! Component");

//if they didn't select a brand default to the bungeebones brand else use what they selected (which mayy be BungeeBones anyway0
}
elseif($plugin=="wordpress"){

$query .= "'". $wordpress."',";
define("PLUGIN_BRAND", "WordPress Plugin");
}

$query .= "'". $custom_title1."',";
$query .= "'". $custom_title2."',";
$query .= "'". $display_freebies."',";
$query .= "'". $time_period."',";
}

									$query .=  " '$user_id', '1','$cat_id' ,'$url' , '$title','$link_description' , '$start_date')";

									
								
	
									
									$query2 = "INSERT INTO `regional_sign_ups` (";
										if(isset($regional_path[0]))
									{
									$query2 .= "`continents`,";
									}
									if(isset($regional_path[1]))
									{
									$query2 .= "`countries`,";
									}
									if(isset($regional_path[2]))
									{
									$query2 .= "`states`,";
									}
									if(isset($regional_path[3]))
									{
									$query2 .= "`cities`,";
									}
									$query2 .= "`link_id`) values (";

									if(isset($regional_path[0]))
									{
									//$query2 .= "`continents`,";
									$query2 .= "'".$regional_path[0]."',";
									}
									if(isset($regional_path[1]))
									{
									//$query2 .= "`countries`,";
									$query2 .= "'".$regional_path[1]."',";
									}
									if(isset($regional_path[2]))
									{
									//$query2 .= "`states`,";
									$query2 .= "'".$regional_path[2]."',";
									}
									if(isset($regional_path[3]))
									{
									$query2 .= "'".$regional_path[3]."',";
									}
                                                                     
//if the submission already ahd been submitted don't resubmit anything from here down to end of next result of insert									echo $query;
$sql = "SELECT `url`, `category` FROM `links` WHERE `url`='$url'";
$result = @mysql_query($sql, $connect) or die("Couldn't execute 'Edit 3 Account' query");
	do{
	$test_url = $row['url'];
$existing_categories[] = $row['category'];
	}while ($row = mysql_fetch_array($result));
	$test_url_lower = strtolower($test_url);
	$url_lower = strtolower($url);
foreach($existing_categories as $key => $value){
    if($url_lower == $test_url_lower and $existing_categories[$key] == $cat_id)
{
// this user has already submitted at least on free link already
//flip the switch to off
//echo "You have already entered that link into this category ";
$do_submit="false";
}

}




if(!isset($do_submit))
{

$result1 = mysql_query($query , $connect); 
$this_links_ID_num = mysql_insert_id();

 $query2 .=  "'" .  $this_links_ID_num . "')";//finish the query string with the link id just submitted and enter the regional info


$result2 = mysql_query($query2 , $connect); 

//test data
$trans_type= 'signup';
$query3 = 'insert into `transaction_log` (`link_id` ,`BB_userID` ,`timestamp` ,`cat_id`, `trans_type`) values ('.$this_links_ID_num.','. $user_id.','. time().','. $cat_id.',\''. $trans_type . '\')';


$result3 = mysql_query($query3 , $connect); 


}else
{
echo "You have already entered that link into this category ";
}																		
echo'<div style="text-align: center;">
   				<a href="http://bungeebones.com/bungee_jumpers" class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/reg_form" class="cssbutton sample a"><span>Add Link</span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/reg_form/insert_directory_instr.php" class="cssbutton sample a"><span> Get A Widget </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/update_user.php" class="cssbutton sample a"><span> Your Profile </span></a>&nbsp;<a href="http://bungeebones.com/feedback.php" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="http://www.bungeebones.com/index.php?option=com_content&view=article&id=5:bungeebones-terms-of-service&catid=25:the-project&Itemid=2" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
					</div>';
									
									echo '<div><p>Thank You! Your link (<span style="color: red">link#';
										echo $this_links_ID_num;
										echo '</span>) was entered successfully (make note of your link number and save it) 
										and is now awaiting review and should be &quot;live&quot; very quickly.</p>
								<p >By placing your link in the '. BRAND . ' system you will begin receiving an ever increasing amount of web traffic to your website from the present and future '. BRAND . '  web directories installed on our participating sites.';

if($folder_name==""){
 echo '<p style = "font-size: 200%; font-weight: strong">But, while you are here, may I take a moment to tell you about a special offer?</p>';
	if(isset($multiple)){
        echo '<p>I want to help you take advantage of the 50% rebate you can get on your advertising fees';
        }									

echo'<p>After your link is approved, and  for a limited time, I am offering free template building and tech support to get your own custom web directory working on your website. 




I will use the source code of your website to create the template for your complete, fully functional, customised, managed and populated web directory. I will then send the file to you so that all you will need to do to receive this fully managed, custom designed to your website income producing web directory is to then upload the file to your website. To receive your free web directory just <u><a href="mailto:info@BungeeBones.com?subject=Send me a FREE web directory for site #'. $this_links_ID_num .'">Mail Us and we will get it designed for you free of charge.!</a></u> You better take advantage of this now if you want a high quality web directory for your website, fully managed and free, as this is a limited time offer.</p>';
								echo'<p>Installing a web directory on your site also earns you a 50% discount when it comes time to improve your link position.
								';
}
else
{
	if(!isset($plugin)){
	echo '<h1>Your code is below</h1>And remember! Just for installing the web directory you can get a 50% discount for any paid advertising you wish to place in'. BRAND . 'plus the multi-level, residual income you will earn from both your own and your downline\'s paid link sales. Now use the the instructions in the accordian help section below to guide you on the install. <p>Thanks for using and contributing to BungeeBones web traffic volume to the other members.';
	}else
	{
	echo '<h1>Here is the link to your '. PLUGIN_BRAND ;
	If($plugin=="wordpress"){
	echo '</h1><h1><a href="http://BungeeBones.com/blog/wp-content/plugins/business-directory/downloads/BungeeBones-remotely-hosted-directory.zip">Download the BungeeBones Remotely Hosted Web Directory Plugin for WordPress</a>';
	}elseIf($plugin=="joomla"){
	echo '</h1><h1><a href="http://BungeeBones.com/downloads/joomla/com_bungeebones.zip">Download the BungeeBones Remotely Hosted Web Directory Component for Joomla!</a>';
	
	
	}
	echo ' </h1>And remember! Just for installing the web directory you can get a 50% discount for any paid advertising you wish to place in'. BRAND . 'plus the multi-level, residual income you will earn from both your own and your downline\'s paid link sales. Now use the the instructions in the accordian help section below to guide you on the install. <p>Thanks for using and contributing to BungeeBones web traffic volume to the other members.';
	}

echo '<p>&nbsp;</p>Sincerely,
<p>&nbsp;</p>Robert Lefebure
<p>&nbsp;</p>Owner/developer of '.BRAND.'<p>&nbsp;</p>';
}		


echo'</div>';
if(!isset($plugin)){
//////////////////////////////////Begin the widget code form display////////////////////////////////////////////
if(!$folder_name==""){

?> 
<p>&nbsp;</p><p>&nbsp;></p></p><iframe id="buffer2" name="buffer2" src="http://bungeebones.com/bungee_jumpers/reg_form/accordion_widget_install.php?url=<?echo $url; ?>&folder_name=<?echo $folder_name;?>&file_name=<?echo $file_name;?>" width="600" border="0"height="275"
></iframe>
<p align="left">&nbsp;</p>
<p align="left">&nbsp;</p><p align="left">&nbsp;</p>
<h3 style="font-size: 150%; ">Format One Generates a Complete Page</h3>
<table border="1" cellpadding="5" cellspacing="0"  bordercolor="#C0C0C0" width="100%" id="AutoNumber1">
  <tr>
    <td>
		
		
		
<p  style="font-size: 150%; text-align: left;">
To create a Format one Advertipage paste the code below into your own blank web page at the location you just entered (i.e. at <?echo $url . "/" . $folder_name . "/" . $file_name ?>

and/or scroll down for the Format Two code</p> <p align="left">&nbsp;</p><p align="left">&nbsp;</p><p align="left">&nbsp;</p><hr>
</td></tr><tr><td bgcolor="cccccc">		&lt;?php
		
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
$regional_number = $var[9] ;//part 3 of link series<br>
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
&lt;p align="left"&gt;Test 2: And as a similar test to the above, click the ADD A Link banner at the bottom of the category display. A smaller window opens and explains they are about to leave your site. Similar to above mouseover or click the banner of the bottom of that page and check the url. Is there a number after the url to Advertipage.com? If so, the install was a success.  If not, please review the instructions, troubleshooting page or contact us.
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
}//closes if !folder
}//close if plugin not isset										
										echo '<br><p>&nbsp;</p><a href="/bungee_jumpers/reg_form/index.php">Submit Another Link</a><br><br>';
										echo '<br><a href="/advertisers/index.php">Go To Control Panel</a>';
										unset($B1);
										unset($C1);
										include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_bottom1.php");
										exit(1);
										
										
										}//closes if C1
										else// begin form
										{



////////////////////////////////////////////////////
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_top1.php");

?><script>

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
   				<a href="http://bungeebones.com/bungee_jumpers" class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;<a  class="cssbutton sample b"><span>Add Link</span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/reg_form/insert_directory_instr.php" class="cssbutton sample a"><span> Get A Widget </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/update_user.php" class="cssbutton sample a"><span> Your Profile </span></a>&nbsp;<a href="http://bungeebones.com/feedback.php" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="http://www.bungeebones.com/index.php?option=com_content&view=article&id=5:bungeebones-terms-of-service&catid=25:the-project&Itemid=2" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
					</div>
<div id="bd">

<form name="form1" method="GET" action="http://bungeebones.com/bungee_jumpers/reg_form/index.php"  onSubmit="return checkrequired(this)">
							 
				

		

<div id="display"></div>

<?
//include('accordion.html');

    $link_data = new mobile;


$var = explode("/", $_SERVER['PATH_INFO']);
$affiliate_num = 2353 ;
$url_cat = $var[1] ;//repnaming header_ID
$regional_number = $var[2] ;//repnaming header_ID

if(!isset($url_cat)||$url_cat == "")
{

$url_cat = '1'; 
$cat_id = '1';
}
else
{
$cat_id=$url_cat;
}

if($cat_id==1){
echo'<div id="display"></div>
<iframe id="buffer" name="buffer" src="http://bungeebones.com/bungee_jumpers/reg_form/accordion.html" width="600" border="0"height="400"
></iframe>';
}
else
{
echo'<div id="display"></div>
<iframe id="buffer" name="buffer" src="http://bungeebones.com/bungee_jumpers/reg_form/accordionmini.html" width="600" border="0"height="250"
></iframe>';

}

if($url_cat !==''  && $url_cat !== '1'){
$path_data = new mobile;
		$category = $url_cat;
		$nav = '<div align="center">';
		$nav .= '<a href="/bungee_jumpers/reg_form/index.php/'.$regional_number.'"><font size="4">Top Level</font></a>';
		$nav .= $path_data->categoryPathforNav($category, $regional_number);
		//$search_nav =  searchPath($category);
		$categoryname = $path_data->getCatName($url_cat);
		$page_title = $categoryname;
		$nav .= $settings['nav_separator'].$categoryname;		
		$nav .= "</div>";
		//$searchQuery .= $path_data->searchengineQuery($category);
		//$categoryname = categoryName($url_cat);
		$page_title = $categoryname;
		$searchQuery .= $settings['se_separator'].$categoryname;
		$search_nav .= "+" . $categoryname;		
		} 
		else 
		{
		$category = '1';
  		 }


$catData = new mobile;

$cat_info = $catData->listCategories($cat_id, $regional_number);

//echo 'pop = ';
//$cat_subpop = $catData->sortRegionalifIsArray($regional_number);
//echo 'region number is ', $regional_number;
//echo '<br>cat sub pop is ', $cat_subpop;

If($cat_id==1){echo"<h1 style='color: red;'>STEP 1 - Choose Your Category</h1>";
echo $cat_info;
}
elseif($cat_info =="false"){
$cat_name = $catData->getCatName($cat_id);
	echo "<h1>Step 1 - Completed</h1><h3>There Are No Sub-Categories Under The ". $cat_name ." Category.</h3><div style='font-size=150%'> Use the contact form and send in your suggestions if you believe some should be added. <br>Thanks<br>The admin.</div>";
$cat_name = $catData->categoryPathDisplay($cat_id);
echo"<p>&nbsp;</p><h3 style='color: red;'>Your Link Will Be Listed In The ". $cat_name . " Category</h3>";
echo $nav;
echo'<p>&nbsp;</p><p>&nbsp;</p>
<iframe id="buffer2" name="buffer2" src="http://bungeebones.com/bungee_jumpers/subscript_stats_dd.php?cat_id='. $cat_id . '& url= ' .  $url . '&folder_name= '. $folder_name .'&file_name= '. $file_name . '" width="600px" border="0" height="255"></iframe>';


}






else
{
echo '<p>&nbsp;</p><h3 style="color: red;">Step 1 (continued) Select A Sub-Category (optional)</h3>';
$cat_name = $catData->categoryPathDisplay($cat_id);
echo"<h3 style='color: red;'>Your Current Selection Places Your Link In The ". $cat_name . " Category</h3>";
echo $cat_info;
echo $nav;
echo'<p>&nbsp;</p><p>&nbsp;</p>
<iframe id="buffer2" name="buffer2" src="http://bungeebones.com/bungee_jumpers/subscript_stats_dd.php?cat_id='. $cat_id . '& url= ' .  $url . '&folder_name= '. $folder_name .'&file_name= '. $file_name . '" width="600px" border="0" height="255"></iframe>';



}






$regional_number = $var[2] ;//part 3 of link series


if ($regional_number != ""){
//echo 'enter the regional value and  the number under a value to later explode it, and get the tree  when inputting all the tree into the into the data base';
echo '<input type="hidden" name="regional_number" value="'.$regional_number.'">';


}
echo '<input type="hidden" name="cat_id" value="'.$cat_id.'">';
$cat_page_id = $var[3] ;//part 2 of cat series
$cat_page_total = $var[4] ;//part 2 of cat series
$cat_record_num = $var[5] ;//part 3 of cat series
$link_page_id = $var[6] ;//part 2 of link series
$link_page_total = $var[7] ;//part 3 of link series
$link_record_num = $var[8] ;//part 3 of link series


/*if((!isset($cat_id)||$cat_id == "")||$url_cat<1){
echo 'in line 32 if';
$cat_id=$url_cat;
}
else
{
$cat_id=1;
}*/


?>
<script type="text/javascript">

function changeText2(){
var arrlength = arguments.length/3;
var arrlengthsc = arrlength+arrlength;
var c = "c";	
var sc = "sc";
for( var i = 0; i < arrlength; i++ ) {
		

document.getElementById(c+arguments[i]).innerHTML = arguments[arrlength+i];
if(arguments[arrlengthsc+i]){
document.getElementById(sc+arguments[i]).innerHTML = arguments[arrlengthsc+i];
}
}
}

</script>

<? 

If($cat_id>1){
echo '<iframe id="buffer2" name="buffer2" src="http://bungeebones.com/bungee_jumpers/add_link/index.php" width="600" border="0"height="375"></iframe>';
	///////////////////////////////
		///////    AJAX AJAX AJAX  /////////
		////////////////////////////////
if($cat_id > 1){
echo'<div>';
		include('regional_dropdown.php');
		echo'</div><div>

	
';
}	
else
{
echo '<div>';
}		
	//	include('category_dropdown.php');
echo'</div></div>';
echo '<p>&nbsp;</p><p>&nbsp;</p><table bordercolor="black"cellpadding="3" width = "700" border="1"height="175"><tr><td><h1 >Your Link Category Peers At A Glance</h1></td></tr><tr><td> <div style="width:700px;height:150px;overflow:auto;">';
	
$link_info = $link_data->getLinks($cat_id, $regional_number);

$orig_link_id = $link_info[0];
$orig_link_BB_user_ID = $link_info[1];
$orig_link_category = $link_info[2];
$orig_link_url = $link_info[3];
$orig_link_name = $link_info[4];
$orig_link_description = $link_info[5];
$orig_link_continents = $link_info[6];
$orig_link_countries = $link_info[7];
$orig_link_states = $link_info[8];
$orig_link_cities = $link_info[9];
$orig_link_street = $link_info[10];
$orig_link_zip = $link_info[11];
$orig_link_phone = $link_info[12];
$orig_link_invoice_sent = $link_info[13];
$orig_link_invoice_paid = $link_info[14];
$orig_link_freebie = $link_info[15];
$orig_link_display_freebies = $link_info[16];
$orig_link_start_date = $link_info[17];
$orig_link_time_period = $link_info[18];
$orig_link_peer_rating = $link_info[19];
$orig_link_peer_vote_count = $link_info[20];
$orig_link_public_rating = $link_info[21];
$orig_link_public_vote_count = $link_info[22];
$orig_link_start_clone_date = $link_info[23];
$orig_link_folder_name = $link_info[24];
$orig_link_file_name = $link_info[25];
$orig_link_approved_build = $link_info[26];
$orig_link_custom_title1 = $link_info[27];
$orig_link_custom_title2 = $link_info[28];
$orig_link_click_tally = $link_info[29];
$orig_link_districts = $link_info[30];

$num_links = count($orig_link_id);

if($num_links < 1){

echo '<p style = "font-size: 300%; color: green; line-height:200%">Congratulations!!! <br>There are no competitor\'s links in your selected region and you have the entire category and region to yourself! (at least for a while) <br> We wish you a long and rewarding ad experience.</p>';
}
else
{


for($counterp=0; $counterp<$num_links; $counterp++){
$peer_rating = htmlentities(stripslashes($orig_link_peer_rating[$counterp]));

$peer_vote_count = htmlentities(stripslashes($orig_link_peer_vote_count[$counterp]));
$avg_public_rating = htmlentities(stripslashes($orig_link_public_rating[$counterp]));
$public_vote_count = htmlentities(stripslashes($orig_link_public_vote_count[$counterp]));




$addressinfo = "";
if($orig_link_cities[$counterp]){
$addressinfo .= "  " . $link_data->getRegionName($orig_link_cities[$counterp]);
}
if($orig_link_districts[$counterp]){
$addressinfo .= "  " . $link_data->getRegionName($orig_link_districts[$counterp]);
}
if($orig_link_states[$counterp]){
$addressinfo .= "  " . $link_data->getRegionName($orig_link_states[$counterp]);
}
if($orig_link_countries[$counterp]){
$addressinfo .= "  " .$link_data->getRegionName($orig_link_countries[$counterp]);
}
if($orig_link_continents[$counterp]){
$addressinfo .= "  " .$link_data->getRegionName($orig_link_continents[$counterp]);
}

$street_info = "";
if($orig_link_street[$counterp]){
$addressinfo .= "  " . $orig_link_street[$counterp];
}
if($orig_link_cities[$counterp]){
$addressinfo .= "  " . $orig_link_cities[$counterp];
}
if($orig_link_zip[$counterp]){
$addressinfo .= "  " . $orig_link_zip[$counterp];
}
if($orig_link_phone[$counterp]){
$addressinfo .= "  " . $orig_link_phone[$counterp];
}

$url = htmlentities(stripslashes($orig_link_url[$counterp]));
 preg_match('@^(?:http://)?([^/]+)@i',"$url", $matches);
$host = $matches[1];
// get last two segments of host name
preg_match('/[^.]+\.[^.]+$/', $host, $matches);
$strpurl = $matches[0];
include('insert_ratings_pic.php');
				


echo'
<div>

<hr><span style="color : red;"> <a target=_"blank" href='.$orig_link_url[$counterp].'>' .$orig_link_name[$counterp].'</a></span><span style="color : green;"> &nbsp;&nbsp;   '.$orig_link_description[$counterp]  .'</span><span style="color : red;"><br />Peer Rating  ' .$PeerOverallpic .'</span><span style="color : red;">&nbsp;&nbsp;   Peer Vote Count  ' .$orig_link_peer_vote_count[$counterp].'</span></div>
				<div><span style="color : red;"> <a target="_blank" href="/reg_form/peer_review_form.php?url='.$strpurl.'&&selected_record='.$orig_link_id[$counterp].'&&cat_id='.$cat_id.'"></span><span style="font-size: 110%">Click Here To Place A "Peer Rank"  Vote For '. $orig_link_name[$counterp] . ' -</a></span></div> 

<div><span style="font-size: .75em; color : black;  "> ' . $addressinfo . '</span></div> 
';
					}		
}//close if link pop over 1
	echo  '</div></td></tr></table>';


	
echo '<p>&nbsp;</p><p>&nbsp;</p><div style="color: black; background-color: #eb8585"><p>&nbsp;</p><h1>STEP 3 - Add Your Link Info</h1>
<div><span style="font-size: 1.25em; color : black;  ">If you are at the best category and/or region for your site add the info (or otherwise please continue with category and regional selections above)</div>
<table border="1" cellpadding="4" cellspacing="4" style="border-collapse: collapse" bordercolor="#FFFFFF"  id="AutoNumber1">
									<tr>
										<td width="14%" align="right"><b><font size="2">Homepage URL</font></b></td>
										<td>&nbsp;<b><font size="2">
										
										
									<input type="text" name="requiredurl" value="http://" size="30"></font></b>
								
							</td>			  
						</tr>
						<tr>
							<td width="14%" align="right"><font size="2"><b>TITLE </b></font></td>
							<td ><b><font size="2">
										
								<input type="text" name="requiredtitle"  size="40"></font></b></td>
						
					</tr>
					<tr>
						<td width="14%" align="right"><font size="2"><b>WEBSITE DESCRIPTION </b></font></td>
						<td><b><font size="2">&nbsp;&nbsp;Descriptions limited to max 255 characters.
									
							<textarea rows="4" name="requiredlink_description" cols="40"></textarea></font></b>
					
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<h1 style="color: black">STEP 4 - Add More Company Info (Optional)</h1
					<p align="left">Attention: You need to have selected from all the available Regional Filters dropdowns (and select a city) in order for your business address and phone number to be displayed.
						<p align="left">Even if you have selected from each drop down, however, the address and telephone number are still optional.
							<p align="left">Add Your Company Street Address <input type="text" name="street"  size="40">
								<p>Add Your Company Postal Code <input type="text" name="zip"  size="40">
										<p>Add Your Company Phone Number<input type="text" name="phone"  size="40">
										</td>
									</tr>
								</table>
							
							<br />
								   
						   </td>
						   
			</tr>
		</table></div>

<input type="submit" value="Submit Link Info Now" name="B1">&nbsp;&nbsp;<input type="reset" value="Cancel" name="B2"></p>
<p>&nbsp;</p><p>OR</p>							
								
							
							   <h3><a href="/advertisers/index.php">Return To Your User Control Panel</a></h3>
<p>OR</p><p>&nbsp;</p>						
';

		
		
		
		
		
		
		
?>	

<p style="color: navy; font-size: 3em;">Now Get Your Very Own Web Directory FREE!</p>
<p>&nbsp;</p>
<div style="background-color:#e6e6e6">
<p style="color: red; font-size: 1.25em;">STEP 5 -(Optional) Create code for your personal and customised Distributed Web Directory that will deliver a fully functional web directory, complete with categories, links and management for easy installation on your website with just a few lines of code to copy and paste into your own web page template </p>
	<div id="display2"></div>
<iframe id="buffer2" name="buffer2" src="http://bungeebones.com/bungee_jumpers/reg_form/accordion_widget.html" width="600" border="0"height="275"
></iframe>
	
	
	
  
   <p align="left"><b>1) Create And Name A Folder or Directory On Your Website-</b><font color="#ff0000">(see instructions above)</font><br>(enter the name in the box below)
	
   <script type="text/javascript">
	 
function clearText(thefield){
if (thefield.defaultValue==thefield.value)
thefield.value = ""
}
	 </script><p align="left"><b>
	


			 <input  type="text" size="53" onfocus="clearText(this);clearStyle(this);"  value=""  name="folder_name" id="folder_name" ><hr>
	
 <p align="left"><b>2) Select A Name For Your Webpage On Your Website </b><font color="#ff0000">(see instructions above)</font><br>(enter the name in the box below and include the .php extension)


<p align="left"><div> <input type="text" name="file_name" onfocus="clearText(this);clearStyle(this);"   size="15" id="file_name" value="">
	
 See the <a target="_blank" href="/articles/php_tutorial.php">PHP tutorial</a> if you need help determining if you have php on your website or not.<hr>

 <p align="left"><b>3) Create The First Half of The Title Of Your Page </b><font color="#ff0000">(see instructions above)</font>
			
     <p align="left"> <input id="custom_title1" size="40" type="text" name="custom_title1" value="">
       <br><span style="font-size:70%;">eg. Your domain name, the type of website (Portal, News, Shopping), a greeting (Enjoy, Visit, Surf)</span><hr>
        <p align="left">  <p align="left"><b>4) Create The Second Half of The Title Of Your Page </b><font color="#ff0000">(see instructions above)</font>
        <p align="left"> <input id="custom_title2" size="40" type="text" name="custom_title2"   value="">
         <br> <span style="font-size:70%;">eg. Links, Info, Websites etc</span><hr>
      
		    
   
      <p align="left"><b>5) Do You Want To Display &quot;Free&quot; Sites?</b><font color="#ff0000">(see instructions above)</font>
      <p align="left">Yes <input type="radio" value="display_freebies" checked name="display_freebies">&nbsp; 
      No <input type="radio" name="display_freebies" value="no_display_free"></p>
      <p align="left"><b> If yes, for how long do you wish to display them on your 
      site for?</b><font color="#ff0000">(see instructions above)</font>
      <p align="left"> <select size="1" name="time_period">
      <option value="0">DO Not Display</option>
      <option value="1">1_month</option>
      <option value="2">2_month</option>
      <option value="3">3_month</option>
      <option value="4">4_month</option>
      <option value="5">5_month</option>
      <option value="6">6_month</option>
      <option value="7">1_year</option>
      <option selected value="8">Indefinitely</option>
      </select>
	<!--<h2>Display A "Niche" Directory Or A General Directory?</h2>
	<?
	//include('social_network/social_network_4_insert_directory.php');?>
	-->
<br /><br />
<table width="100%" border="1"><tr><td>
<p align="left">The distributed web directory is available in two brands. You can get the directory to send users to either the BungeeBones brand or the AdvertiPage brand. They are two distinct web sites with two different public images. The name "BungeeBones" is our original name but some may consider it too whimsical for their website if they are trying to display a more serious public image on their own website. That is why we developed the AdvertiPage.com brand. Each brand functions identical to each other and has the same features and policies and just portrays a different "look" to your visitor. Click the links to see the "departing message" they get as they leave your site to enter the registration process and get better insight to the differences. Then select the one you prefer.
</p></td></tr>
<tr><td>
  <p align="left"><b>7) Select The Brand You Want To Display</b><font color="#ff0000">(see instructions above)</font>
      <p align="left">      <a target="_blank" href="../../../articles/leaving_website2.php">BungeeBones.com </a><input type="radio" value="bun" checked name="brand">&nbsp; 
      <p align="left"><a target="_blank" href="../../../articles/leaving_website_to_advertipage.php">AdvertiPage.com </a><input type="radio" name="brand" value="adv"></p>
      
</td></tr><hr>
<tr><td>
  <p align="left"><b>7)Want A CMS Component or Pluggin?</b><font color="#ff0000">(available for JOOMLA! and WordPress)</font>
      <p align="left">      <a target="_blank" href="../../../articles/joomla!_web_directory_component.php">Joomla! Web Directory Component </a><input type="radio" name="plugin" value="joomla" >&nbsp; 
      <p align="left"><a target="_blank" href="../../../articles/wordpress_web_directory_plugin.php">WordPress Web Directory Plugin</a><input type="radio" name="plugin" value="wordpress"></p>
      
</td></tr>



</table>

</div><!--close colored div-->	

<p>&nbsp;</p>
								 <input type="submit" value="Submit Link Info" name="B1">&nbsp;&nbsp;<input type="reset" value="Cancel" name="B2"></p>
<p>&nbsp;</p>
<p>OR</p>
<p>&nbsp;</p>
    
							   <h3><a href="/bungee_jumpers/index.php">Return To Your User Control Panel</a></h3>
</form>	
<p>&nbsp;</p>	<p>&nbsp;</p>	   
					<?
}//close if cat > 1
?>
</div>
	<div id="ft">
	<div style="text-align: center"><a href="http://BungeeBones.com">HOME</a>  <a href="http://BungeeBones.com/articles">ARTICLES</a>  <a href="http://BungeeBones.com">FAQ </a>	 <a href="http://BungeeBones.com/feedback.php"> CONTACT US </a>  <a href="http://BungeeBones.com/bungee_jumpers/reg_form">REGISTER</a>  <a href="http://BungeeBones.com/bungee_jumpers/login.php">LOGIN</a></div>
                                                                                                                                                                                                                                                                                                                

<div style="text-align: center"><a href="http://BungeeBones.com/bungee_bones">OUR LINK EXCHANGE/DIRECTORY</a> <a href="http://BungeeBones.com/subscription_sites">EXAMPLE SITES</a> </div><a target="_blank" href="http://twitter.com/Bungeebones">BB TWITTER </a>
<div style="text-align: center">
    <a href="http://validator.w3.org/check?uri=referer"><img
        src="http://www.w3.org/Icons/valid-xhtml10-blue"
        alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a>
  </div>
  
</div>

</div>
</div>

<?
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_bottom1.php");
}//close ifisset B1