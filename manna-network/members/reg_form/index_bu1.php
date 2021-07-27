<?
// include the configs
require_once("../config/config.php");

    
// load the login class

// load php-login components
require_once("../php-login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

 
    
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...


$user_id = $_SESSION['user_id'];

//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 
include($_SERVER['DOCUMENT_ROOT']."/members/reg_form/config.php"); //old yald, don't use db connects but use settings
include($_SERVER['DOCUMENT_ROOT']."/members/reg_form/classes/mobile_class.php");  
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
include($_SERVER['DOCUMENT_ROOT']."/classes/regional_filters_class.php");

if(array_key_exists ( 'B1' , $_GET ){
$B1 = $_GET['B1'];
}
if(isset($B1)){
/////////////////////////////////////////////////
//include($_SERVER['DOCUMENT_ROOT']."/members/template_topy.php");
$moniker="<h5>Add A Link</h5>";
$body_width="wide";
include('../../960top.php');
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
   				<a href="../" class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;
<a href="../overview.php" class="cssbutton sample a"><span>Overview</span></a>&nbsp;
<a  class="cssbutton sample b"><span>Add Link</span></a>&nbsp;
<!--<a href="http://bungeebones.com/members/reports" class="cssbutton sample a"><span>Reports</span></a>&nbsp;-->
<a href="/feedback.php?BB_user_id=<? echo $user_id; ?>" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="/index.php?option=com_content&view=article&id=5:bungeebones-terms-of-service&catid=25:the-project&Itemid=2" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="http://bungeebones.com/members/index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
					</div>
<div id="bd">

<form name="form1" method="GET" action="<?php $_SERVER['PHP_SELF']; ?>"  onSubmit="return checkrequired(this)">
							 
				

		

<div id="display"></div>
<?
//////////////////////////////////////////////////
$donate =$_GET['donate'];
$register_info = new mobile;
if(isset($_GET['regional_number'])){
$regional_number=$_GET['regional_number'];
//echo '<br>regional_number = ', $regional_number;
//$brand=$_GET['brand'];

if($_GET['is_niche']){
$is_niche=$_GET['is_niche'];
}
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
//alt_cat deprecated - form just gives a message that their currently selected cat will be the default if suggested cat rejected. deprecated 1/23/11
$alt_cat_name=$_GET['alt_cat_name'];
$suggest1=$_GET['suggest1'];

$suggest2=$_GET['suggest2'];
if($_GET['folder_name']){
$folder_name =$_GET['folder_name'];
echo '<div style="font-size: 150%;width:900px;">folder_name = ', $folder_name;

	if($_GET['file_name']){
	$file_name=$_GET['file_name'];
	echo '<br>file_name = ', $file_name;
	}
	else
	{
	echo '<p class="smallerFont" >ERROR: You entered a folder name to hold your distributed web directory but you did not name the file. Please return and add a name such as "index.php" being sure to use a php extension';
	}
	if($_GET['custom_title1']){
	$custom_title1 = $_GET['custom_title1'];
	echo '<p class="smallerFont" ><br>custom_title1 = ', $custom_title1;
	}
	else
	{
	echo '<p class="smallerFont" >ERRROR: You entered a folder name to hold your distributed web directory and/or a file name but you did not enter a first half of your custom title. Though the script will work without one you might be losing some valuable SEO features by omitting it.';
	
	}
	if($_GET['custom_title2']){
	$custom_title2 = $_GET['custom_title2'];
	echo '<br>custom_title2 = ', $custom_title2;
	}
	else
	{
	echo '<p class="smallerFont" >ERRROR: You entered a folder name indicating an interest to host a distributed web directory but you did not enter a second half of your custom title. Though the script will work without one you might be losing some valuable SEO features by omitting it.';
	
	}
if($_GET['is_niche']>0){
$get_mobile= new mobile;
$is_niche=$_GET['is_niche'];
echo '<p class="smallerFont" ><br>You selected to operate your directory as a NICHE directory covering the '.$get_mobile->getCatName($is_niche). ' category.';  
}
	//if($_GET['brand']){
	//$brand = $_GET['brand'];
		
	//echo '<br>You selected the  ';
			//if($brand=="adv"){
			//echo "AdvertiSite brand";
			//}
			//else
			//{
			
			//echo "BungeeBones brand";
			//}
	
			if($_GET['plugin']){
			$plugin = $_GET['plugin'];
				
			
				if($plugin=="joomla"){
				echo "<br>You are going to install in a JOOMLA! powered website.";
				}
				elseif($plugin=="wordpress"){
				echo "<br>You are going to install in a WordPress powered website.";
				
				}
	
			
			}

	//}
	//else
	//{
	//echo 'ERROR: You entered information indicating an interest to host a distributed web directory but you did not select which brand you wanted (i.e. BungeeBones or AdvertiPage). The default brand is BungeeBones. If you click "continue" you will receive code from the BungeeBones brand. If that is not what you want then click the back button and select the '. BRAND .'  brand..';
	
	//}

if(isset($donate) && $donate !== "Enter your instructions here"){
echo "<p class=\"smallerFont\" >You have submitted the following instructions for disbursing your proceeds of the sales to a charity.<p>";
echo $donate;
}

echo '</div>';
}else
{
echo'<p>&nbsp;</p><p>&nbsp;</p><div style="font-size: 150%;width:960px;"><p class="smallerFont" >Review the  information you entered and, if correct, click "Continue and Finish" or use the "Back" button to change the information.</div>';
}
							

$cat_id = $_GET['cat_id'];

$cat_name = $register_info->getCatName($cat_id);

if($suggest1 !=""){

echo 'You want your link added to ';
	if($suggest2 !=""){echo ' the suggested categories ';
echo $suggest1;

echo '/'.$suggest2;
	}
	else
	{
	echo 'a suggested category ';
echo $suggest1;

	}

echo ' which will be added to the '. $cat_name . ' category but also agree that if the suggestions are rejected the link will be added to the '. $cat_name . ' category (you can always edit your category at any time but it will go through the approval process again and your link will lose its seniority (i.e. if yours is a free link it will be shown last among the free links in the new category)). This registration day seniority does not affect paid link placement however. ';
}
else
{
echo '<p class="smallerFont" >category name: ', $cat_name;
$cat_path = $register_info->categoryPathfordisplay($cat_id, $regional_number);
echo '<p class="smallerFont" >category path: ', $cat_path;
}

$url = $_GET['requiredurl'];
echo '<p class="smallerFont">url: ', $url;
$title = $_GET['requiredtitle'];
echo '<p class="smallerFont" >title (in directory listing): ', $title;
$link_description = $_GET['requiredlink_description'];
echo '<p class="smallerFont" >link_description: ', $link_description;

$nofollow = $_GET['nofollow'];
echo '<p class="smallerFont" >no follow: ', $nofollow;

if($_GET['street'] != "" AND $regional_path[3] != ""){
$street=$_GET['street'];
echo '<p class="smallerFont" >street: ', $street;
}
elseif($_GET['street'] != "" and $regional_path[3] == ""){


echo '<div style="color: red"><p class="smallerFont" >You added street information but did not select a city. <br>Your Street Address cannot be displayed unless you select a city. To do so, go back to the "Add Regional Info" section, select your city from the drop down menus <b><u>AND</u></b> click the "Get ________" link that appears for your city. <br>If you choose to continue the information will not be displayed unless you update your regional city location.</div>';
}
if(!$zip==""){
$zip=$_GET['zip'];
echo '<p class="smallerFont" >>zip: ', $zip;
}
if(!$phone==""){
$phone=$_GET['phone'];
echo '<p class="smallerFont" >phone: ', $phone;
}

$display_freebies = $_GET['display_freebies'];

$time_period = $_GET['time_period'];
echo '<p>&nbsp;</p><div><form action="<?= $_SERVER[';
echo "'PHP_SELF']?>";
echo ' id="searchform" method="post">';
										     
										


if($_GET['street']){ echo '<input type="hidden" name="street" value="'. $_GET['street'].'">';}
if($_GET['zip']){ echo '<input type="hidden" name="zip" value="'. $_GET['zip'].'">';}
if($_GET['phone']){echo '  <input type="hidden" name="phone" value="'. $_GET['phone'].'">';}
if($_GET['is_niche']>0){echo '  <input type="hidden" name="is_niche" value="'. $_GET['is_niche'].'">';}	
		echo ' 	<input type="hidden" name="cat_id" value="'. $cat_id .'">
			<input type="hidden" name="url" value="'. $_GET['requiredurl'].'">
			<input type="hidden" name="title" value="'. $_GET['requiredtitle'].'">
			<input type="hidden" name="link_description" value="'. $_GET['requiredlink_description'].'">
<input type="hidden" name="nofollow" value="'. $_GET['nofollow'].'">
			<input type="hidden" name="start_date" value="'. time().'">';
			//<input type="hidden" name="brand" value="'. $_GET['brand'].'">';

if($_GET['suggest1']){
echo '
<input type="hidden" name="alt_cat_name" value="'. $_GET['alt_cat_name'] .'">
<input type="hidden" name="suggest1" value="'. $_GET['suggest1'] .'">
<input type="hidden" name="suggest2" value="'. $_GET['suggest2'] .'">';
}


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

$sql = "SELECT `url`, `category`, 'id', 'freebie' FROM `links` WHERE `url`='$url'";

$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 3 Account' query");
	do
	{
	$test_url = $row['url'];
$test_id = $row['id'];
$existing_categories[] = $row['category'];
$is_freebie[] = $row['freebie'];
	}while ($row = mysqli_fetch_array($result));
	$test_url_lower = strtolower($test_url);
	$url_lower = strtolower($url);
	

foreach($existing_categories as $key => $value){

 

if($url_lower == $test_url_lower and $existing_categories[$key] == $cat_id )
{
// this user has already submitted at least on free link already
echo "<p class=\"smallerFont\" >You have already entered that link # ".$test_id." into this category ";

}

}

	if($url_lower == $test_url_lower and $existing_categories[$key] == $cat_id )
	{
	//	include("../articles/include_top.txt");
	echo '<div style="line-height: 300%"><p align="left"><font size="7">Oops!!!</font</div>;
		<img border="0" src="/images/Embarrassed_Chimpanzee.jpg" width="200" height="160"></p>
		<p align="left">&nbsp;</p>
		<div style="line-height: 350%"><p align="left"><font size="5">You have already entered that link into the directory as a free link. You can change the current link to a paid link for a modest fee from your BungeeBones User Control Panel and then you can add it again as a  free link to a different category, but you cannot add the same link, to the same category multiple times.
			</font></p>
		<p align="left">You can use the <font size="7" color="#008080"><b>B</b></font><b><font size="7" color="#008080">BROWSER BACK BUTTON</font></b> 
			<p>to return to 
			your website registration page or the "Go Back" button below.</p>
		<p align="left">&nbsp;Thank you</p></div>
<INPUT TYPE="button" VALUE="Go Back" onClick="history.back()">
			
			</FORM></div>

';
		//  include("../articles/include_bottom.txt"); 
		//exit();
		} 
	elseif($url_lower == $test_url_lower AND $is_freebie == 0)
	{
	//	include("../articles/include_top.txt");
	echo '
<input type="hidden" name="multiple" value="1">

		<div style="line-height: 350%"><p align="left"><font size="5">Our records indicate you have already entered that link and have used your complimentary free submission
<p>You cannot continue until you make a nominal payment and convert the existing entry into a paid link. If you enter the link as a paid link it will be displayed ahead of all free links and you will be able to enter another free link. To convert to a paid link return to your Bungeebones User Control panel and add funds to your account with PayPal. Then click the appropriate check box or radio button to the left of this link\s listing.</p>


<table id="member" >
<tr><td>

Website URL - ', $url_lower;


echo '<BR>Category name - ', $cat_name;
echo '<BR> Category number - ', $cat_id;
//If($category_price ==0){echo 'Category is still a free site that you will be acquiring 12 months prepaid in it for $12';}
/*If($category_price >4 && $category_price <8){
                echo '<br><b><u>The price is '. $category_price . '</u></b> per month. <br>When prices are from $5 to $7 per month the payment arrangements are either 1)monthly basis or 2) can be "locked in" for a six month period by paying 6 month\'s payments in advance';
                }
                If($category_price <5 && $category_price > 0 ){
                echo '<br><b><u>The price is '. $category_price. ' </u></b> per month. <br>When prices are $4 or less per month, then the category listing is NOT available on a monthly basis but can be "locked in" for either a six month or 12 month period by making advance payment';
                }
       If($category_price >6 ){
                echo '<br><b><u>The price is '. $category_price . '</u></b> per month. <br>When prices are $6 per month and up are available on a monthly , quarterly, semi-annually or annual basis by payment in advance';
                }

echo '<BR>';
If($category_price == 0)
{

echo 'It is still a "free" category (i.e. hasn\'t crossed the 20 link population level yet) so you can lock in your price for the next 6 months by paying $12 ($2 a month) in advance.';
echo '<br>The price cannot be raised until ';
$this_year = date('Y');
$this_month = date('m');
$next_six_month = $this_month + 6;
$this_day = date('d');
$next_year = $this_year + 1;
echo date("M-d-Y", mktime(0, 0, 0, $next_six_month, $this_day, $this_year));
}
*/
$return_to = "http://bungeebones.com/members/reg_form/paypal.php?cat_id=".$cat_id."&url=".$url."&title=".$title."&link_description=".$link_description."&start_date=".time();
if(isset($street)){
$return_to .= "&amp;street=".$_GET['street'];}
if(isset($zip)){
$return_to .= "&amp;zip=".$_GET['zip'];}
if(isset($phone)){
$return_to .= "&amp;phone=".$_GET['phone'];}
if(isset($plugin)){
$return_to .= "&amp;plugin=".$_GET['plugin'];}
	if(isset($multiple)){
$return_to .= "&amp;multiple=".$_GET['multiple'];}
if(isset($_GET['folder_name'])){
$return_to .= "&amp;is_niche=".$_GET['is_niche'];
$return_to .= "&amp;folder_name= ".$_GET['folder_name'];
$return_to .= "&amp;file_name=". $_GET['file_name'];
$return_to .= "&amp;custom_title1= ".$_GET['custom_title1'];
$return_to .= "&amp;custom_title2= ".$_GET['custom_title2'];
$return_to .= "&amp;display_freebies= ".$_GET['display_freebies'];
$return_to .= "&amp;time_period= ".$_GET['time_period'];
}


echo '<br>Today\'s date and time ', date('r');
echo '<BR></td></tr></table>


<h2 align="center">Make A Payment</h2>
<!--<p align="left">Use these instructions ONLY IF YOU RECEIVED AN INVOICE FROM 
BUNGEEBONES!.</p>-->
<p align="left">Payment can be either by PayPal, by electronic transfer, or by money order .</p>
<a target="_blank" href="'.$return_to.'"><img src="https://www.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1"></a><p>&nbsp;</p>
<h3 align="left"><font size="5">Electronic Transfer - </font></h3>
<p align="left">IMPORTANT: When you send in an electronic transfer be sure to include in 
the <b><u>TRANSFER\'S</u></b> memo area your website URL! After you send it use 
the contact form (in the left menu) and send (copy and paste into the contact form) all the information in the gray box above. </p>

<p align="left">Send the payment of $12 (for 6 months) to:</p>
<p align="left">ROUTING NUMBER: 031176110</p>
<p align="left">ACCOUNT OR CUSTOMER NUMBER: 73325589</p>
<p align="left">

<h3>PayPal</h3>';

If($category_price == 0)
{
$cat_price_6 = 12;
echo'<input type="radio" value="6month" checked name="Subscription">$'.$cat_price_6.'</p>';
}
else
{

echo'Available Subscriptions<p>Monthly payment
<input type="radio" value="1month" checked name="Subscription"> of $ _________</p>
<p>Quarterly pre-payment <input type="radio" name="Subscription" value="3month"> 
of $ _________</p>
<p>Bi-annual pre-payment <input type="radio" name="Subscription" value="6month"> 
of $ _________</p>
<p>Annual pre-payment <input type="radio" name="Subscription" value="12month">of 
$ _________</p>
';
}


echo '<h3 align="left"><font size="5">SNAIL MAIL -</font></h3>
<p align="left">You can mail me a money order - made out to</p>
<p align="left">Robert Lefebure</p>
<p align="left">351 Lake Ave</p>
<p align="left">Maitland, FL</p>
<p align="left">32751</p>

<p align="left">Be sure to include all the details in the grey box above in your correspondence.</p>

 
			</p><p align="left">&nbsp;</p></font></div>


';
if(!isset($folder_name)){	
echo'<div style="line-height: 350%"><p align="left"><font size="5">If you later  install the web directory on your site then half of the above fees will be rebated to you as commissions. To take advantage of this fantastic advertising deal simply add the web directory to your website anytime within the next 15 days</font></p></div> '; 
}
else
{
echo'<div style="line-height: 350%"><p align="left"><font size="5">Great News! Because you chose to install the web directory on your site then half of the above fees will be rebated to your account as commissions. To take advantage of this fantastic advertising deal complete the installation of the web directory to your website anytime within the next 15 days. Remember, we are here to help with installation if you have any problems.</font></p></div> '; 

}



echo'<div style="line-height: 350%; border: 3px coral solid;"><p align="left"><font size="5">Link submittals received without </font></p></div> '; 
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


</div>
</div>

<?
//include($_SERVER['DOCUMENT_ROOT']."/members/templatebottomnsb.php");
include('../../960bottom.php');
exit();
}//close ifisset$B1
if(array_key_exists ( 'C1' , $_GET ){
$C1 = $_GET['C1'];
}
If(isset($C1)){

//include($_SERVER['DOCUMENT_ROOT']."/members/template_topy.php");
$moniker="<h5>Add A Link</h5>";
$body_width="wide";
include('../../960top.php');
	$street=htmlspecialchars($_GET['street']);

	$zip=htmlspecialchars($_GET['zip']);
	$phone=htmlspecialchars($_GET['phone']);
	//$brand=$_GET['brand'];
$plugin=htmlspecialchars($_GET['plugin']);
	$cat_id=htmlspecialchars($_GET['cat_id']);
	$url=htmlspecialchars($_GET['url']);
	$title=htmlspecialchars($_GET['title']);
	$link_description=htmlspecialchars($_GET['link_description']);
$nofollow=htmlspecialchars($_GET['nofollow']);
	$multiple=htmlspecialchars($_GET['multiple']);
$start_date = time();//entered in insert query - tells when link was added
	
if(isset($_GET['folder_name'])){
	$is_niche=htmlspecialchars($_GET['is_niche']);
$folder_name= htmlspecialchars($_GET['folder_name']);
$file_name= htmlspecialchars($_GET['file_name']);
$custom_title1= htmlspecialchars($_GET['custom_title1']);
$custom_title2= htmlspecialchars($_GET['custom_title2']);
$display_freebies= htmlspecialchars($_GET['display_freebies']);
$time_period= htmlspecialchars($_GET['time_period']);
}								

$register_info = new mobile;
if(isset($_GET['regional_number'])){
$regional_number=htmlspecialchars($_GET['regional_number']);

$regional_path = $register_info->regionPathnums($regional_number);
}
$alt_cat_name=htmlspecialchars($_GET['alt_cat_name']);
$suggest1=htmlspecialchars($_GET['suggest1']);

$suggest2=htmlspecialchars($_GET['suggest2']);
$street = mysqli_real_escape_string($connect, $street);
	$zip = mysqli_real_escape_string($connect, $zip);
	$phone = mysqli_real_escape_string($connect, $phone);
	//$brand = mysqli_real_escape_string($connect, $brand);
$is_niche = mysqli_real_escape_string($connect, $is_niche);
if($is_niche==""||$is_niche==0){
$is_niche="NULL";
}
$plugin = mysqli_real_escape_string($connect, $plugin);
	$cat_id = mysqli_real_escape_string($connect,$cat_id);
	$url = mysqli_real_escape_string($connect, $url);
	$title = mysqli_real_escape_string($connect, $title);
	$link_description = mysqli_real_escape_string($connect, $link_description);
	$multiple = mysqli_real_escape_string($connect, $multiple);
$folder_name = mysqli_real_escape_string($connect, $folder_name);
$file_name = mysqli_real_escape_string($connect, $file_name);
$custom_title1 = mysqli_real_escape_string($connect, $custom_title1);
$custom_title2 = mysqli_real_escape_string($connect, $custom_title2);
$display_freebies = mysqli_real_escape_string($connect, $display_freebies);
$time_period = mysqli_real_escape_string($connect, $time_period);

$alt_cat_name=mysqli_real_escape_string($connect, $alt_cat_name);
$suggest1=mysqli_real_escape_string($connect, $suggest1);
$suggest2=mysqli_real_escape_string($connect, $suggest2);


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
			
			</FORM></div>';
//include($_SERVER['DOCUMENT_ROOT']."/members/templatebottomnsb.php");
include('../../960bottom.php');
exit();
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


// to move this over to the new widgets table give this section a new query number and add the link id AGAIN
//the following section of code was very early attempt to retrieve the upline (parent link id) to enter in the widget table.
//Instead, ran the funtion in the 5b section further down 
if(isset($_GET['folder_name'])){
//include($_SERVER['DOCUMENT_ROOT']."/classes/widget_mgmt_class.php"); 
 // $widg_mng = new widget_mgmt;
//if($user_id != 2){
//$BB_user_ID = $widg_mng->getUserBBID($user_id);
//}
//else
//{
//$BB_user_ID = 104;
//}
 // $widg_link_pair = $widg_mng->getWidgetsUrls($BB_user_ID); // only set this this method to protect your page


//print_r($widg_link_pair);




$query5a = "INSERT INTO `widgets` (";
$query5a .= "`folder_name`,";
$query5a .= "`file_name`,";
//$query5a .= "`brand`,";
if($_GET['plugin']!==""){
$query5a .= "`plugin`,";
}
if($_GET['is_niche']!==""){
$query5a .= "`is_niche`,";
}
$query5a .= "`custom_title1`,";
$query5a .= "`custom_title2`,";
$query5a .= "`display_freebies`,";
$query5a .= "`time_period`,";
$query5a .= "`parent`,";
$query5a .= "`start_clone_date`,";
$query5a .= "`is_recip`,";
$query5a .= "`meta_descrip`,";
$query5a .= "`keywords`,";
$query5a .= "`link_id`";
}



									$query .= "   `BB_user_ID`, `freebie` ,`category` , `url` , `name` , `description`,  `start_date`, `nofollow`) values (";
									
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
//need to change the query number to match what was done above to the front half of the query dealing with this section									
if(isset($_GET['folder_name'])){

$query5b .= ") values (";
$query5b .= "'". $folder_name."',";
$query5b .= "'". $file_name."',";
//if($brand=="bun"){
//$query5b .= "'bun',";
//if they didn't select a brand default to the bungeebones brand else use what they selected (which mayy be BungeeBones anyway0
//define("BRAND", "BungeeBones");
//}
//else
//{
//$query5b .= "'". $brand."',";
//define("BRAND", "AdvertiPage");

//}
if($plugin=="joomla"){
$query5b .= "'joomla',";
define("PLUGIN_BRAND", "JOOMLA! Component");

//if they didn't select a brand default to the bungeebones brand else use what they selected (which mayy be BungeeBones anyway0
}
elseif($plugin=="wordpress"){

$query5b .= "'". $wordpress."',";
define("PLUGIN_BRAND", "WordPress Plugin");
}
if($_GET['is_niche']!==""){
$query5b .= "'". $is_niche."',";
}
$query5b .= "'". $custom_title1."',";
$query5b .= "'". $custom_title2."',";
$query5b .= "'". $display_freebies."',";
$query5b .= "'". $time_period."',";

//retrieve the "upline num" from user table (which is the link id of the new parent of this new directory)
include($_SERVER['DOCUMENT_ROOT']."/classes/widget_mgmt_class.php");
  $widg_mng = new widget_mgmt;
$parent_link_id = $widg_mng->getUplineNum($user_id);

$query5b .= "'". $parent_link_id."',";
$query5b .=  "'". time()."',";
$query5b .=  "'". $is_recip."',";
$query5b .=  "'". $meta_descrip."',";
$query5b .=  "'". $keywords."',";
}

									$query .=  " '$user_id', '0','$cat_id' ,'$url' , '$title','$link_description' , '$start_date', '$nofollow')";

									
								
	
									
									$query2 = "INSERT INTO `regional_sign_ups` (";
										if(isset($regional_path[0]))
									{
									$query2 .= "`continent`,";
									}
									if(isset($regional_path[1]))
									{
									$query2 .= "`country`,";
									}
									if(isset($regional_path[2]))
									{
									$query2 .= "`state`,";
									}
									if(isset($regional_path[3]))
									{
									$query2 .= "`city`,";
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
                                                                     
//if the submission already ahd been submitted don't resubmit anything from here down to end of next result of insert									
$sql = "SELECT `url`, `category`, `id` FROM `links` WHERE `url`='$url'";
$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 3 Account' query");
	do{
	$test_url = $row['url'];
$test_id = $row['id'];
$existing_categories[] = $row['category'];
	}while ($row = mysqli_fetch_array($result));
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

$result1 = mysqli_query($connect, $query); 
$this_links_ID_num = mysqli_insert_id($connect);
 $query2 .=  "'" .  $this_links_ID_num . "')";//finish the query string with the link id just submitted and enter the regional info
//echo 'line 854 in regform/index', $query2;
$result2 = mysqli_query($connect, $query2); 
//test data
$trans_type= 'signup';
$query3 = 'insert into `transaction_log` (`link_id` ,`BB_userID` ,`timestamp` ,`cat_id`, `trans_type`) values ('.$this_links_ID_num.','. $user_id.','. time().','. $cat_id.',\''. $trans_type . '\')';
$result3 = mysqli_query($connect, $query3); 

	if($suggest1 != ""){
	$query4 = "Insert into `suggested_cats` (
	`alt_cat_name`, `suggest1`, `suggest2`,  `link_id`)
	values(
	'$alt_cat_name',
	'$suggest1',
	'$suggest2',";
 $query4 .=  "'" .  $this_links_ID_num . "')";//finish the query string with the link id just submitted and enter the regional info
	$result4 = mysqli_query($connect, $query4); //suggested category
	}
}else
{
//echo "You have already entered that link into this category ";
echo "You have already entered that link # ".$test_id." into this category ";
}
if(isset($query5a)){

 $query5 = $query5a.$query5b;
if($this_links_ID_num==""){
$this_links_ID_num = $test_id;
}
$query5 .=  "'" .  $this_links_ID_num . "')";//finish the query string with the link id just submitted and enter the regional info
$is_a_widget = $widg_mng->checkfordupWidgets($folder_name, $file_name,$this_links_ID_num);

if($is_a_widget == '0'){
//don't insert a new widget record if there is already a widget in this folder and file location
$result5 = mysqli_query($connect, $query5) or die("Couldn't execute check for widget query"); 

//suggested category


include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/widget_mgr/widget_tree_mgmt_class.php");
  $widg_tree_mng = new widget_tree_mgmt;

$to = "robert.r.lefebure@gmail.com";
$subject = "A New Widget Installed At BungeeBones";  
$message = "Website address:".


	$url."  
and entered into category # " . $cat_id .   
"
Link ID Number: ".$this_links_ID_num.
"
Title: ".
	$title.
"
Description: ".	$link_description .
	"
Folder Name: ". $folder_name.
"    
File Name: ". $file_name.
"
As A Niche In: ". $register_info->getCatName($is_niche). ' category.'.
"
Custom  Title1: ". $custom_title1.
"    
Custom Title2:  ".$custom_title2.
"/r/n"



;

  
$from = "robert.r.lefebure@gmail.com";
$headers = "From: $from";
//mail($to,$subject,$message,$headers);


}
else
{
echo '<br><br>You already have a widget installed in the folder '. $folder_name.' and in the file named '. $file_name.' .You can edit this widget from your usercontrol panel.';
//include($_SERVER['DOCUMENT_ROOT']."/members/templatebottomnsb.php");
include('../../960bottom.php');
										exit(1);
}
}
//begin success delivery 

																		
echo'<div style="text-align: center;">
   				<a href="';

echo '/members/" class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;<a href="" class="cssbutton sample a"><span>Add Link</span></a>&nbsp;<!--<a href="..//reports" class="cssbutton sample a"><span>Reports</span></a>-->&nbsp;<a href="../feedback.php" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="../index.php?option=com_content&view=article&id=5:bungeebones-terms-of-service&catid=25:the-project&Itemid=2" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="http://bungeebones.com/members/index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
					</div>';
								if(isset($test_id)){
$this_links_ID_num = $test_id;
}	
									echo '<div><p>&nbsp;</p><p>&nbsp;</p><p style="color: red; font-size: 140%">Thank You! Your link (link#';
										echo $this_links_ID_num;
										echo ') was entered successfully';
if(isset($query5a)){
echo' (please make note of your link number and save it - <b><u>especially</u></b> since you are installing the web directory script)


';
}

if($cat_id != 10006){
echo'<p>&nbsp;</p><p style="color: red; font-size: 140%"> 		Your submitted website is now awaiting review and should be &quot;live&quot; very quickly.</p>
<p>&nbsp;</p><p style="color: red; font-size: 140%">You will soon begin receiving an ever increasing amount of web traffic to your website from the present and future web sites with the BungeeBones distributable web directory installed and that are/will be displaying your link.
<p>&nbsp;</p><p style="color: red; font-size: 140%">The link you just added will now be listed when you return to your User Control Panel. <h1 style="color:navy;">To get your own BungeeBones Web Directory for your own website (fully managed, fully brandable to your site, absolutely effortless to maintain AND FREE) <a href="http://bungeebones.com/members/index.php">go to your new User Control Panel </a> and click the "Add A Web Directory" button to the right of your new link listing or <a href="http://bungeebones.com/members/reg_form/widget_index_custom.php?link_selected='.$this_links_ID_num.'">CLICK HERE</a>
';
}
else
{
echo '<p>&nbsp;</p><p style="color: red; font-size: 140%">Your submitted domain name for parking is now awaiting review and should be &quot;live&quot; very quickly.</p>
<p>&nbsp;</p><p style="color: red; font-size: 140%">';

}
echo'</div>';
if($plugin ==""){
//////////////////////////////////Begin the widget code form display////////////////////////////////////////////
if(!$folder_name==""){

?> 
<p>&nbsp;</p><p>&nbsp;></p></p>

<iframe id="buffer2" name="buffer2" src="http://bungeebones.com/members/reg_form/accordion_widget_install.php?url=<?echo $url; ?>&folder_name=<?echo $folder_name;?>&file_name=<?echo $file_name;?>" width="500" border="0"height="275"
></iframe>
<p align="left">&nbsp;</p>
<p align="left">&nbsp;</p><p align="left">&nbsp;</p>
<h3 style="font-size: 150%; ">Two Ways To Generate A Web Directory Page</h3>
<table id="member">
  <tr>
    <td>
<p  style="font-size: 150%; text-align: left;">
One way to create your web directory is to paste the first block of code below (everything before the light blue block) into a completely blank web page at the location you just entered (i.e. at <?echo $url . "/" . $folder_name . "/" . $file_name ?>). This method will produce the working model of the directory but without any of your own page's formatting (such as menus, pictures, etc) but if you know the basics of building a web page you can identify different page areas in this template and then copy and paste the sections from your own pages into it. See the "Format One Install Instructions" above.

<p align="left">&nbsp;</p><p  style="font-size: 150%; text-align: left;">For the second way to create your web directory scroll down for the Format Two code (starting with the light blue block). It is designed for you to take the small sections of code provided and paste them into one of your own existing webpage templates. One section gets pasted in the &lt;head&gt; section of your page and the other goes in the &lt;body&gt; section. See the "Format Two Install Instructions" above.</p> <p align="left">&nbsp;</p><p align="left">&nbsp;</p><p align="left">&nbsp;</p><hr>
</td></tr><tr><td bgcolor="cccccc"><h1>Format 1 - Copy & Paste All The Code In This Block Into A Blank Webpage</h1>		&lt;?php
		
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
$file="http://Bungeebones.com/link_exchange/index.php/$affiliate_num/$url_cat/$cat_page_num/$link_page_num/$pagem_url_cat/$link_page_id/$link_page_total/$link_record_num/$regional_number";

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
	&lt;/td&gt; <br>&lt;td&gt;

<br /><br />
<table id="member"><tr><td>
<H!>NEW FEATURE!</h1>
<p align="left">The distributed web directory can become "reciprocal" and get you some very prominent ads in the other remotely hosted web directories simply by pasting the optional Reciprocal code snippet in your directory's sidebar. </p>

<p>&nbsp;</p><p>By using this reciprocal code your website will display links to all the other websites that have the directory installed. They will be displayed on your site only in their own main category (and all it's subcategories).</p>
<p>In turn, your link will be displayed in the sidebar of each and everyone of their websites in YOUR main category (and all its subcategories) as well.</p>
<p>This is an effortless reciprocal program because all you do is install the code ONETIME and BungeeBones monitors all the participants to make sure the reciprocal code is in place and operating. If so, their link is displayed on the other participants sites. If the code isn't in place and operating then their link is not displayed in the sidebar. Participating (or not) in this reciprocal program does affect your regular link placement in any way whatsoever.</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<H1>Selecting One Of These Will Cause Your Directory To Only Display That Category And Its Sub-Categories</h1>

</td></tr></table>
<p>&nbsp;</p>
<br>
<br>
//&lt;?
<br>
<br>
 $file ="http://BungeeBones.com/subscription_sites/cat_only.php/$affiliate_num/$url_cat/";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $file);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data1 = curl_exec($ch);
curl_close($ch);
echo($data1); 










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
echo '<table id="member"><tr><td style="font-size: 150%">';
echo '<h3> Part One of Format Two Code </h3>';
echo '<p>Paste this code into one of your own website\'s template page\'s &lt;Head&gt; section, pasting over everything above the closing head tag (i.e. leave the original closing &lt;/head&gt; tag)';
echo "<p>&nbsp;</><p>&nbsp;</p>";

?>
</td></tr><tr><td bgcolor="#EDF0F4">
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
$regional_number = $var[9] ;//part 3 of link series<br>
    <br>
    <br>
		?&gt;<br>
&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;<br>
	&lt;html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" dir="ltr"&gt;<br>
&lt;head&gt;<br>

&lt;? <br>
<br>
<br>
//CODE FOR DYNAMIC HEADER,META TAG, TITLE ETC <br>
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
echo '<table id="member"><tr><td style="font-size: 150%">';
echo '<h3>Part Two of Format Two</h3>';
echo '<p>Paste this code into the &lt;body&gt; of your own website\'s template page, pasting anywhere in the page you like.';
echo "<p>&nbsp;</><p>&nbsp;</p>";

?><br>
</td></tr><tr><TD bgcolor="#C9BE62">
&lt;?
<br>
<br>
//MAIN DIRECTORY DISPLAY OF CATEGORIES AND LINKS<br>

$file="http://Bungeebones.com/link_exchange/index.php/$affiliate_num/$url_cat/$cat_page_num/$link_page_num/$pagem_url_cat/$link_page_id/$link_page_total/$link_record_num/$regional_number";

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
echo '<table id="member"><tr><td style="font-size: 150%">';
echo '<h3>Part Three of Format Two - The Optional Reciprocal Program</h3>';
echo '<p>Paste this code into either the right or left sidebar of your own website\'s template page. BungeeBones will index your website with our search engine bot and if we find the recip code BungeeBones will display your link - in your particular category - in the sidebars of all the other reciprocal sites';
echo "<p>&nbsp;</><p>&nbsp;</p>";

?><br>
</td></tr><tr><TD bgcolor="#f3e2c0">
&lt;?
<br>
<br>
//OPTIONAL RECIPROCAL PROGRAM WITH OTHER DIRECTORY"S SIDEBARS<br>
 $file ="http://BungeeBones.com/subscription_sites/cat_only.php/$affiliate_num/$url_cat/";<br>
$ch = curl_init();<br>
curl_setopt($ch, CURLOPT_URL, $file);<br>
curl_setopt($ch, CURLOPT_HEADER, 0);<br>
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);<br>
$data = curl_exec($ch);<br>
curl_close($ch);<br>
echo($data);<br>?&gt;
	
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
echo '<br><p>&nbsp;</p><a href="/members/reg_form/index.php">Submit Another Link</a><br><br>';
echo '<br><a href="/members/index.php">Go To Control Panel</a><p>&nbsp;</p><p>&nbsp;</p>';
unset($B1);
unset($C1);
include('../../960bottom.php');
exit(1);
}//closes if C1
else// begin form
{



////////////////////////////////////////////////////
//include($_SERVER['DOCUMENT_ROOT']."/members/template_topy.php");
$moniker="<h5>Add A Link</h5>";
$body_width="wide";
include('../../960top.php');
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
   				<a href="../" class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;
<a href="../overview.php" class="cssbutton sample a"><span>Overview</span></a>&nbsp;
<a  class="cssbutton sample b"><span>Add Link</span></a>&nbsp;
<!--<a href="http://bungeebones.com/members/reports" class="cssbutton sample a"><span>Reports</span></a>&nbsp;-->
<a href="http://bungeebones.com/feedback.php?BB_user_id=<? echo $user_id; ?>" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="http://www.bungeebones.com/index.php?option=com_content&view=article&id=5:bungeebones-terms-of-service&catid=25:the-project&Itemid=2" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="http://bungeebones.com/members/index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
					</div>
<div id="bd">

<form name="form1" method="GET" action="<?php $_SERVER['PHP_SELF']; ?>"  onSubmit="return checkrequired(this)">
							 
				

		

<div id="display"></div>

<?
//include('accordion.html');

    $link_data = new mobile;


$var = explode("/", $_SERVER['PATH_INFO']);
//echo 'line 1335 index.php var = ';
//print_r($var);
$affiliate_num = 2353 ;
$url_cat = $var[1] ;//repnaming header_ID
$regional_number = $var[2] ;//repnaming header_ID
//echo '<br>line 1335 index.php $regional_number = ', $regional_number;
if(!isset($url_cat)||$url_cat == "")
{

$url_cat = '1'; 
$cat_id = '1';
}
else
{
$cat_id=$url_cat;
}
/*
if($cat_id==1){
echo'<div id="display"></div>
<iframe id="buffer" name="buffer" src="http://bungeebones.com/members/reg_form/accordion.html" width="500" border="0"height="400"
></iframe>';
}
else
{
echo'<div id="display"></div>
<iframe id="buffer" name="buffer" src="http://bungeebones.com/members/reg_form/accordionmini.html" width="500" border="0"height="250"
></iframe>';

}
*/
if($url_cat !==''  && $url_cat !== '1'){
$path_data = new mobile;
		$category = $url_cat;
		$nav = '<div align="center">';
		$nav .= '<a href="/members/reg_form/index.php/'.$regional_number.'"><font size="4">Top Level</font></a>';
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

If($cat_id==1){echo"<h1 style='color: red;'>STEP 1 - Choose Your First Or Main Category</h1>";
echo $cat_info;
}
elseif($cat_info =="false" and $cat_id !== "10006"){
$cat_name = $catData->getCatName($cat_id);
	echo "<h1>Step 1 - Completed</h1><h3>There Are No More Sub-Categories Under The ". $cat_name ." Category.</h3><div style='font-size=150%'> Use the contact form and send in your suggestions if you believe some should be added. <br>Thanks<br>The admin.</div>";
$cat_name = $catData->categoryPathDisplay($cat_id);
echo"<p>&nbsp;</p><h3 style='color: red;'>Your Link Will Be Listed In The ". $cat_name . " Category</h3>";
echo $nav;
/*
This iframe file uses REALLY old code from the auction RMA class days? Subscript stats used to show what? 
echo'<p align="left">
<iframe id="buffer2" name="buffer2" src="https://bungeebones.com/members/subscript_stats_dd.php?cat_id='. $cat_id . '& url= ' .  $url . '&folder_name= '. $folder_name .'&file_name= '. $file_name . '" width="900px" border="0" height="255"></iframe>';
*/

}
elseif ($cat_id== "10006")
{
$cat_name = $catData->getCatName($cat_id);
	echo "<h1 style='text-align:center;'>Parked Domain Instructions</h1><h3 style='text-align:center;'>Special Considerations For Parked Domains.</h3><div style='text-align:left;'>See the Terms Of Service for more details but basically Parked Domains are provide one free page but are not allowed nor required to have content on their page. BungeeBones places their web directory on it which helps boost advertising opportunities. Parked domains also start at one level lower in the commission structure so the commissions on all sales they make will be 25% instead of the usual 50%. They will still receive override commissions on any sites that register and become sales sites as well even if they no longer host the parked site with BungeeBones.</div>
<div style='text-align:left;'>The parked domain category and the links in it is not displayed in the distributed link directory where our member's sites are displayed. BungeeBones web directory will not be sending traffic to parked domains.</div>



<br>Thanks<br>The admin.</div>";
$cat_name = $catData->categoryPathDisplay($cat_id);
echo"<p>&nbsp;</p><h3 style='color: red;'>Your Link Will Be Listed In The ". $cat_name . " Category</h3>";
echo $nav;
echo'<p>&nbsp;</p><p>&nbsp;</p>';

}





//this could be where it checks if category selected was facebook
//if so, it still needs all the sub categories displayed. It will need to proceed as a pseudo 1 category  Any check to see if the cat id is one would need to check if it is the facebook id also
//then, don't need regional for facebook
//don't need peers
//don't need street
//don't need phone or zip
//don't need bungeebones login 
//will need facebook id, and use it as user id in links table
//should I put a facebook detector in bungeejumpers login? or FB connect? which then redirects to a copy of this form but without access user class? 
//Can the site be secure enough?

else
{
echo "

<table id=\"member\"><tr><td>
<div style='background-color:gray;color:white;width:900px'><p class=\"smallerFont\" >As categories get more links in them they will automatically be \"paginated\" to display 20 links per page. Paid links will be displayed first (ordered by their price). The free links will be displayed afterwards and eventually pushed onto lower pages (ordered by their registration date). You can purchase better positions from your user CP after your link info is entered. </p>


<p class=\"smallerFont\" >The 1st numbers in parenthesis (after each category in the list) represent the total link population in that category.  The 2nd set of numbers in parenthesis is the link population in  all sub-categories of that category. Divide the first number by 20 to calculate where your link would be displayed in that category as a free link. You can, however, jump ahead of all senior free links for just pennies worth of Bitcoin a month!</div>
<!--<p class=\"smallerFont\" >This pricing system insures the eventual highest price for the category in order to pay the websites that provide their traffic to the system and<br>2) provide an extra incentive for webmasters to be diligent in their category selection<br>3) create the highest quality product for the end user as possible by getting links entered into the most relavant category we have AT THE TIME (i.e the \"best\" category can change as the directory gets filled and more competitive).<br>4) be able to always offer a place for a webmaster to enter a <b>free link</b> into the system. 
<p class=\"smallerFont\" >The end result will be a combination of free pages and paid pages spread through the categories largely depending on webmaster supply and demand for determining the final price but with the ability to say that -->";
echo '<p>&nbsp;</p><h3 style="color: red;">Step 1 (continued) Select A Sub-Category (optional)</h3>';
$cat_name = $catData->categoryPathDisplay($cat_id);
echo"<h3 style='color: red;'>Your Current Selection Places Your Link In The ". $cat_name . " Category</h3><h4>Here Are Its Sub-categories";
echo $nav;
echo $cat_info;
echo '<h3 style="color: red;">OR, Suggest your own sub-category!</h3></td></tr><tr><td>Suggested category #1<input type=text" name="suggest1"></input></td></tr><tr><td>Suggested category#2 (will be a sub-category of suggested category #1) <input type=text" name="suggest2" ></input></td></tr>
<tr><td colspan="2"><br><font size = "1">Note: By default, whatever category you are currently in will the one that your link will be inserted into <b><u>IF your suggestion is rejected</u></b>. To use one of the sub-categories listed above as your default click the one you want and continue to fill in the form from that location.<br> </font>
<h2>Please help us make BungeeBones the highest quality web directory possible by being diligent about category selection.</h2></td></tr>
</table>';
/*
echo'<p>&nbsp;</p><p>&nbsp;</p><iframe id="buffer2" name="buffer2" src="http://bungeebones.com/members/subscript_stats_dd.php?cat_id='. $cat_id . '& url= ' .  $url . '&folder_name= '. $folder_name .'&file_name= '. $file_name . '" width="900px" border="0" height="275"></iframe>';
*/


}






$regional_number = $var[2] ;//part 3 of link series
//echo '<br> line 1487 regional number here is ', $regional_number;
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


<script type="text/javascript">
        var  GB_ROOT_DIR ="http://bungeebones.com/greybox/";
    </script>

    <script type="text/javascript" src="http://bungeebones.com/greybox/AJS.js"></script>
    <script type="text/javascript" src="http://bungeebones.com/greybox/AJS_fx.js"></script>
    <script type="text/javascript" src="http://bungeebones.com/greybox/gb_scripts.js"></script>
    <link href="http://bungeebones.com/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />

  
  

<? 

If($cat_id>1){


echo'</div></div>';
if($cat_id != 10006){
echo '<br><h3>Help Remove Dead Links And Move Your Listing Up!</h3><table id="member"><tr><td><h1 >Your Link Category Peers At A Glance</h1>
<p class="smallerFont" >Want to know how to quickly move yourself up in the rankings? You can move your listing up simply by reporting bad links in your own category! Help eliminate dead, broken, or mis-categorized links in the sites that are listed ahead of yours and move your link higher!</p>
<p class="smallerFont" >Look through this list of other sites in this category. If/when you find a bad site just click the "Report ??????????? as a defective link!" link for a quick and easy report form. We\'ll do the rest and we appreciate your help keeping our quality high.</p?

</td></tr><tr><td> <div style="height:300px;overflow:auto;">';	
//echo 'At the get links cal, regform index line 1557 index.php regional number = ', $regional_number;
$link_info = $link_data->getLinks($cat_id, $regional_number);

$orig_link_id = $link_info[0];
$orig_link_BB_user_ID = $link_info[1];
$orig_link_category = $link_info[2];
$orig_link_url = $link_info[3];
$orig_link_name = $link_info[4];
$orig_link_description = $link_info[5];
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
$orig_link_click_tally = $link_info[29];

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



$url = htmlentities(stripslashes($orig_link_url[$counterp]));
 preg_match('@^(?:http://)?([^/]+)@i',"$url", $matches);
$host = $matches[1];
// get last two segments of host name
preg_match('/[^.]+\.[^.]+$/', $host, $matches);
$strpurl = $matches[0];
include('insert_ratings_pic.php');
				

echo'
<div>

<hr><span style="color : red;"> <a target=_"blank" href='.$orig_link_url[$counterp].'>' .$orig_link_name[$counterp].'</a></span><span style="color : green;"> &nbsp;&nbsp;   '.$orig_link_description[$counterp]  .'</span>';
/*<span style="color : red;"><br />Peer Rating  ' .$PeerOverallpic .'</span><span style="color : red;">&nbsp;&nbsp;   Peer Vote Count  ' .$orig_link_peer_vote_count[$counterp].'</span></div>
				
<div><span style="color : red;"> <a target="_blank" href="/members/reg_form/peer_review_form.php?url='.$strpurl.'&selected_record='.$orig_link_id[$counterp].'&cat_id='.$cat_id.'">Cast a "Peer Review" vote!</a></span><p>
*/
echo '
<span style="font-size: 75%"><a target="_blank" href="/members/reg_form/peer_report_form.php?url='.$strpurl.'&selected_record='.$orig_link_id[$counterp].'&cat_id='.$cat_id.'"><br>Report '. $orig_link_name[$counterp] . ' as a defective or mis-categorized link!</a></span></div> 


';
					}		
}//close if link pop over 1
}//close if 10006
	echo  '</div></td></tr></table>';


	
echo '<table id="member" ><tr><td><p>&nbsp;</p><p>&nbsp;</p><div style="color: black; background-color: #ebebeb"><p>&nbsp;</p>';



if($cat_id !=10006){


	///////////////////////////////
		///////    AJAX AJAX AJAX  /////////
		////////////////////////////////
if($cat_id > 1 And $cat_id != 10006){
echo'<div>';
		include('regional_dropdown.php');
		echo'</div><div>

	
';
//This is the table for determining numbers of competitors by region and by category. It needs to be in a section teaching how to bid, not here
//echo '<iframe id="buffer2" name="buffer2" src="http://bungeebones.com/members/add_link/index.php?cat_id='.$cat_id.'&regional_number='.$regional_number.'" width="700" border="0"height="375"></iframe>';
}	
else
{
echo '<div>';
}
///////////////////////////////
		///////    AJAX AJAX AJAX  /////////
		////////////////////////////////		
	//	include('category_dropdown.php');

if($cat_id != 10006){
echo 'STEP 3 ';


       echo ' Add Your Link Info</h1>';

IF(count($regional_path)>3){
echo '<h2 style="color:red">Step 2b - Additional Regional Info (optional because you added your city location)</h2><b><p align="left">Add Your Company Street Address <br> <input type="text" name="street"  size="40">
								<p  align="left">Add Your Company Postal Code<br><input type="text" name="zip"  size="40"></b>';

}
else
{
echo'
			<tr>
				<td colspan="2">
					<h3 style="color: red">Additional Company Location Info (Optional)</h3>
					<p align="left">If you select from all the available Regional Filters dropdowns above (i.e. selected a city) then more options will appear here to enable you to add your business address to be displayed in the directory.
				</td>
				</tr>';
}

echo '
								</table>
							
							<br />
								   
						   </td>
						   
			</tr>';

echo '<div><span style="font-size: 1.25em; color : black;  ">Finish adding your site info</span></div>
<table id="member">

									<tr>
										<td width="14%" align="right"><b><font size="2">Business Phone Number (optional)</font></b></td>
										<td>&nbsp;<b><font size="2">
										
										
									<input type="text" name="phone" value="" size="30"></font></b>
								
							</td>			  
						</tr>


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
<tr border="1"><td colspan="2"><h1>For Website Designers, Developers, SEO, Professionals</h1></td></tr>

<tr border="1"><td colspan="2"><p>The owner of BungeeBones.com offers an open invitation to web professionals to use the BungeeBones Web Directory System for their clients to help drive traffic to their sites and earn both the service provider and the clients income. 
<p>If you are a web professional we provide a special arrangement where you can create "private" users without providing their email address. To see the full terms and conditions visit <a target="_blank" href="/members/reg_form/private_users.php">HERE</a>. Once you are registered as a Limited Partner, there will be additional User Name, Password, and Bitcoin Wallet Address inputs here where you can create new users for the links as you add them. They will have their own logins and access to all the regular user features except we won\'t have their contact info (only you will). So when you visit <a target="_blank" href="/members/reg_form/private_users.php">HERE</a> you will also see our confidentiality policy that applies to your customers and clients. 

<tr><td colspan="2">
<img width="90%" src="http://bungeebones.com/members/images/aboutgoogle.png">
<p>Since its <a target="_blank" href="http://en.wikipedia.org/wiki/Google_Penguin"> Penguin Update</a> some users have contacted BungeeBones with reports that Google has identified SOME sites hosting the web directory as "undesirable" or some such language. It seems ridiculuos to have to do this because by their own admittance Google easily identifies what it considers "poor linking practice". But instead of merely not counting the links for any merit they have caused much confusion in the webmaster community. As they say,it\'s hard to hit a moving target and Google is forever releasing and then changing its guidance. So for those who have something to lose with Google, they should select this no-follow tag option as Google should not be indexing their site with such a tag and, if they do,they should by no means claim anyone is trying to trick them. For those not on the top SERPs pages (the 99.9% majority) the no-follow tags are not specific to just Google and other search engines will stop indexing your page from BungeeBones too and I consider it a coin toss as to whether or not to do it but please do your own research. After all, Google could change their algorithm again tomorrow.

<h1>No Follow Tags</h1>If you want to add a "nofollow" tag to your link to keep Google from indexing it then check the following radio button. Doing so will add the nofollow tag to your link listing in all the directories. For more information see <a target="_blank" href="http://support.google.com/webmasters/bin/answer.py?hl=en&answer=96569">this Google help page</a> For what its worth, if you are the only barbershop for two hundred miles around, for example, and Google disparages or penalizes your site because of links that they clearly can determine are not detrimental to anyone then shame on them. The end user who looks for a barber shop and finds none is as much a victim as the rest of us of Google\'s rant and it will come on them in the long run.
<p>I\'ve looked (Google AND other search engines) hoping to find out if I could keep JUST Google from following links but, as yet, I have not found that possible, so, by checking the radio you will effectively be keeping all search engines from following your link because of Google. The choice is yours. 
<h3><font color="red">Check here to make your link "nofollow" because Google claims they can\'t figure it out without our help!</font><input type="radio" name="nofollow"></h3>
</td>
			</tr>
<tr><td colspan="3">
<input type="submit" value="Submit Link Info" name="B1">&nbsp;&nbsp;<input type="reset" value="Cancel" name="B2"></p>
</form>	

</td></tr>						
<tr><td colspan="3">							
   <h3><a href="/members/index.php">Return To Your User Control Panel</a></h3>
</td></tr>

</table>								

';
}
else
{
echo ' Add Your Parked Domain Name Info</h1>
<div><span style="font-size: 1.25em; color : black;  ">Finish adding your site info</span></div>
<table id="member">
									<tr>
										<td width="14%" align="right"><b><font size="2">Domain Name To Be Parked</font></b></td>
										<td>&nbsp;<b><font size="2">
										
										
									<input type="text" name="requiredurl" value="http://" size="30"></font></b> 
						<input type="hidden" name="requiredtitle"   value="parked"></font></b></td>
						
						<input type="hidden" name="requiredlink_description" value="parked">		
						<input type="hidden" name="nofollow" value="parked">		
							
</td>			  
						</tr>';




}


echo   '
<tr><td colspan="3">
<p class="smallerFont" >If all you wanted to do was to add your link then that concludes the link submission process. Submit the form and your website will be reviewed as soon as posible</p>
<p class="smallerFont" >If you wanted your link to be displayed ahead of more senior links then you can add funds (through either Pay Pal or Bitcoin) from your user control panel and purchase the page position you want.</p>
<p class="smallerFont" >Also, If You Want To Get Your Very Own Web Directory - FREE! And Managed! And with the potential to earn Income Too!- just return to your User Conrol Panel (after you click the "Submit" button below) and there will be an "Add A Widget" button to the right of your new link. </p>
</td></tr></table>

';
}
else{ echo   '
</table></div></td></tr></table>

<h1 style="color: navy; font-size: 1.25em;">
Final Step:  you must now go to the registrar where you have the domain name registered and change the Domain name server configurations to <br>NS1130.DIZINC.COM and <br>
NS1131.DIZINC.COM

</h1>';

}
 
					
}//close if cat > 1

//include($_SERVER['DOCUMENT_ROOT']."/members/templatebottomnsb.php");
include('../../960bottom.php');
}//close ifisset B1



} else {
    // the user is not logged in...

    include("../views/not_logged_in.php");
}








?>
