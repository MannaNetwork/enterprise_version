<?


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


$var = explode("/", $_SERVER['PATH_INFO']);

$url_cat = $var[1] ;
$link_id = $var[2] ;
if($url_cat != 10033){
exit();
}


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
include($_SERVER['DOCUMENT_ROOT']."/members/reg_form/classes/modify_link_class.php");  
if(!isset($website_id)){
$website_id = $link_id;

}
else
{
$website_id= $_GET['website_id'];//3733&
}
if(isset($url_cat)){
$cat_id_orig = $url_cat;//3076
}
else
{
$cat_id_orig = $_GET['cat_id_orig'];
}

if (isset($_GET['website_id'])){
$website_id= htmlspecialchars($_GET['website_id']);
if (!preg_match('/^\d+$/', $website_id)) die("You have an improper website_id. Please return to your <a href='../index.php'>user Control panel</a> ."); }
if (isset($_GET['cat_id_orig'])){
//$cat_id_orig= htmlspecialchars($_GET['cat_id_orig']);
$cat_id_orig = stripslashes($cat_id_orig);

if (!preg_match('/^\d+$/', $cat_id_orig)) die("You have an improper cat_id_orig. Please return to your <a href='../index.php'>user Control panel</a> ."); }

$B1 = $_GET['B1'];

if(isset($B1)){
/////////////////////////////////////////////////
$moniker="<h5>Edit</h5>";
$body_width="wide";
include($_SERVER['DOCUMENT_ROOT']."/960top.php");
 

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
   				<a href="http://bungeebones.com/members/" class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;<a  class="cssbutton sample b"><span>Add Link</span></a>&nbsp;<a href="http://bungeebones.com/members/update_user.php" class="cssbutton sample a"><span> Your Profile </span></a>&nbsp;<a href="http://bungeebones.com/feedback.php" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="http://www.bungeebones.com/index.php?option=com_content&view=article&id=5:bungeebones-terms-of-service&catid=25:the-project&Itemid=2" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="http://bungeebones.com/members/index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
					</div>
<div id="bd">

<form name="form1" method="GET" action="http://bungeebones.com/members/reg_form/index_edit.php"  onSubmit="return checkrequired(this)">
							 
				

		

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
$alt_cat_name=$_GET['alt_cat_name'];
$suggest1=$_GET['suggest1'];

$suggest2=$_GET['suggest2'];
if($_GET['folder_name']){
$folder_name =$_GET['folder_name'];
echo '<div style="font-size: 150%;">folder_name = ', $folder_name;

	if($_GET['file_name']){
	$file_name=$_GET['file_name'];
	echo '<br>file_name = ', $file_name;
	}
	else
	{
	echo 'ERROR: You entered a folder name to hold your distributed web directory but you did not name the file. Please return and add a name such as "index.php" being sure to use a php extension';
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
if($_GET['is_niche']>0){
$get_mobile= new mobile;
$is_niche=$_GET['is_niche'];
echo '<br>You selected to operate your directory as a NICHE directory covering the '.$get_mobile->getCatName($is_niche). ' category.';  
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
echo "<p>You have submitted the following instructions for disbursing your proceeds of the sales to a charity.<p>";
echo $donate;
}

echo '</div>';
}else
{
echo'<p>&nbsp;</p><p>&nbsp;</p><div style="font-size: 150%;">Review the  information you entered and, if correct, click "Continue and Finish" or use the "Back" button to change the information.</div>';
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

echo ' which will be added to the '. $cat_name . ' category but also agree that if the suggestions are rejected the link will be added to the '. $alt_cat_name . ' category (but you can still edit your category at any time also)';
}
else
{
echo '<p style="font-size:125%;">Your link will remain in its current category</p>';
}

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
										     
										
if($_GET['cat_id_orig']){ echo '<input type="hidden" name="cat_id_orig" value="'. $_GET['cat_id_orig'].'">';}
if($_GET['website_id']){ echo '<input type="hidden" name="website_id" value="'. $_GET['website_id'].'">';}


if($_GET['street']){ echo '<input type="hidden" name="street" value="'. $_GET['street'].'">';}
if($_GET['zip']){ echo '<input type="hidden" name="zip" value="'. $_GET['zip'].'">';}
if($_GET['phone']){echo '  <input type="hidden" name="phone" value="'. $_GET['phone'].'">';}
if($_GET['is_niche']>0){echo '  <input type="hidden" name="is_niche" value="'. $_GET['is_niche'].'">';}	
		echo ' 	<input type="hidden" name="cat_id" value="'. $cat_id .'">
			<input type="hidden" name="url" value="'. $_GET['requiredurl'].'">
			<input type="hidden" name="title" value="'. $_GET['requiredtitle'].'">
			<input type="hidden" name="link_description" value="'. $_GET['requiredlink_description'].'">
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


$sql = "SELECT `url`, `category`, 'id' FROM `links` WHERE `url`='$url'";

$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 3 Account' query");
	do
	{
	$test_url = $row['url'];
$test_id = $row['id'];
$existing_categories[] = $row['category'];
	}while ($row = mysqli_fetch_array($result));
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
	<div style="text-align: center"><a href="http://BungeeBones.com">HOME</a>  <a href="http://BungeeBones.com/articles">ARTICLES</a>  <a href="http://BungeeBones.com">FAQ </a>	 <a href="http://BungeeBones.com/feedback.php"> CONTACT US </a>  </div>
                                                                                                                                                                                                                                                                                                                

<div style="text-align: center"><a href="http://BungeeBones.com/bungee_bones">OUR LINK EXCHANGE/DIRECTORY</a> <a href="http://BungeeBones.com/subscription_sites">EXAMPLE SITES</a> </div><a target="_blank" href="http://twitter.com/Bungeebones">BB TWITTER </a>
<div style="text-align: center">
    <a href="http://validator.w3.org/check?uri=referer"><img
        src="http://www.w3.org/Icons/valid-xhtml10-blue"
        alt="Valid XHTML 1.0 Transitional" height="31" width="88" ></a>
  </div>
  
</div>

</div>
</div>

<?
include($_SERVER['DOCUMENT_ROOT']."/960bottom.php");
exit();
}//close ifisset$B1

$C1 = $_GET['C1'];

If(isset($C1)){
$moniker="<h5>Top</h5>";
$body_width="wide";
include($_SERVER['DOCUMENT_ROOT']."/960top.php");
	$street=htmlspecialchars($_GET['street']);

	$zip=htmlspecialchars($_GET['zip']);
	$phone=htmlspecialchars($_GET['phone']);
	//$brand=$_GET['brand'];
$plugin=htmlspecialchars($_GET['plugin']);
	$cat_id=htmlspecialchars($_GET['cat_id']);
	$url=htmlspecialchars($_GET['url']);
	$title=htmlspecialchars($_GET['title']);
	$link_description=htmlspecialchars($_GET['link_description']);
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

$alt_cat_name=htmlspecialchars($_GET['alt_cat_name']);
$suggest1=htmlspecialchars($_GET['suggest1']);

$suggest2=htmlspecialchars($_GET['suggest2']);
$street = mysqli_real_escape_string( $connect, $street);
	$zip = mysqli_real_escape_string( $connect, $zip);
	$phone = mysqli_real_escape_string( $connect, $phone);
	//$brand = mysqli_real_escape_string( $connect, $brand);
$is_niche = mysqli_real_escape_string( $connect, $is_niche);
if($is_niche==""||$is_niche==0){
$is_niche="NULL";
}
$plugin = mysqli_real_escape_string( $connect, $plugin);
	$cat_id = mysqli_real_escape_string( $connect, $cat_id);
	$url = mysqli_real_escape_string( $connect, $url);
	$title = mysqli_real_escape_string( $connect, $title);
	$link_description = mysqli_real_escape_string( $connect, $link_description);
	$multiple = mysqli_real_escape_string( $connect, $multiple);
$folder_name = mysqli_real_escape_string( $connect, $folder_name);
$file_name = mysqli_real_escape_string( $connect, $file_name);
$custom_title1 = mysqli_real_escape_string( $connect, $custom_title1);
$custom_title2 = mysqli_real_escape_string( $connect, $custom_title2);
$display_freebies = mysqli_real_escape_string( $connect, $display_freebies);
$time_period = mysqli_real_escape_string( $connect, $time_period);


$alt_cat_name=mysqli_real_escape_string( $connect, $alt_cat_name);
$suggest1=mysqli_real_escape_string( $connect, $suggest1);
$suggest2=mysqli_real_escape_string( $connect, $suggest2);


$query = "INSERT INTO `links` (";

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



									$query .= "   `BB_user_ID`, `freebie` ,`category` , `url` , `name` , `description`,  `start_date`) values (";
									
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

									$query .=  " '$user_id', '0','$cat_id' ,'$url' , '$title','$link_description' , '$start_date')";

									
								
	
									
									
                                                                     
//if the submission already ahd been submitted don't resubmit anything from here down to end of next result of insert									echo $query;
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
$this_links_ID_num = mysqli_insert_id();



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
}
if(isset($query5a)){

 $query5 = $query5a.$query5b;
if($this_links_ID_num==""){
$this_links_ID_num = $test_id;
}
$query5 .=  "'" .  $this_links_ID_num . "')";//finish the query string with the link id just submitted and enter the regional info
//echo 'line 760 $ = ', $query5;

}
//begin success delivery 

																		
echo'<div style="text-align: center;">
   				<a href="http://bungeebones.com/members" class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;<a href="http://bungeebones.com/members/reg_form" class="cssbutton sample a"><span>Add Link</span></a>&nbsp;<a href="http://bungeebones.com/feedback.php" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="http://www.bungeebones.com/index.php?option=com_content&view=article&id=5:bungeebones-terms-of-service&catid=25:the-project&Itemid=2" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="http://bungeebones.com/members/index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
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
echo'<p>&nbsp;</p><p style="color: red; font-size: 140%"> 		Your submitted website is now awaiting review and should be &quot;live&quot; again very quickly.</p>
<p>&nbsp;</p><p style="color: red; font-size: 140%">You will soon begin receiving an ever increasing amount of web traffic to your website from the present and future web sites with the BungeeBones distributable web directory installed and that are/will be displaying your link.';
/*
		if($folder_name==""){
		echo '<p>&nbsp;</p><p style = "font-size: 140%; font-weight: strong">But, while you are here, may I take a moment to ask you again to consider installing a web directory on your website?</p>';
						

			echo'<p style = "font-size: 140%;">By installing a web directory you not only get to share in the building of what could be a great web advertising social network but could eventually reap financial rewards as well. Adding a web directory increases the web traffic to the network and increases its advertising power for everyone.

 <p>&nbsp;</p><p style = "font-size: 140%;"><p>&nbsp;</p>A demo of the distributed web directory is available to help show HOW EASY IT IS to install and customise it. <p>You can download the file (along with simple instructions) and install it on your site in just a few minutes. See it in action <a href="http://bungeebones.com/demo/demo.php">HERE</a>
<ol><li>To install it simply create a folder on your website named "demo" (so that its address would be www.your-site.com/demo)</li>
<li>Then copy and paste the code from the demo.php file (that you can download from the demo page)onto a new page and save it in that folder and name it "demo.php" (so that its address will be www.your-site.com/demo/demo.php)</li>
</ol>


			</p>';
			
			}
			else
			{
				if($plugin==""){
				echo '<h1>Your code is below</h1>And remember! Just for installing the web directory you can get a 50% discount for any paid advertising you wish to place plus the multi-level, residual income you will earn from both your own and your downline\'s paid link sales. 
<p>
<p>Perhaps as a way to help you with the install you might like to try installing the "demo" version first? It can serve as an aid and a reference point to help with the final installation. There are just a few steps to getting the demo working on your site and should only take a couple of minutes...
<ol><li>Create a folder on your website named "demo" so that its address would be www.your-site.com/demo</li>
<li>Copy and paste the code from the first block below onto a new page and save it in that folder and named "demo.php" so that its address will be www.your-site.com/demo/demo.php</li>
</ol>

<H2>The demo web directory should be fully functional in its default demo mode.</h2>
Now use the the instructions in the accordian help section below to guide you in the final install and customisation. <p>Thanks for using and contributing to BungeeBones web traffic volume.';
				}else
				{
				echo '<h1>Here is the link to your '. PLUGIN_BRAND ;
				If($plugin=="wordpress"){
				echo '</h1><h1><a href="http://BungeeBones.com/blog/wp-content/plugins/business-directory/downloads/BungeeBones-remotely-hosted-directory.zip">Download the BungeeBones Remotely Hosted Web Directory Plugin for WordPress</a>';
	}elseIf($plugin=="joomla"){
				echo '</h1><h1><a href="http://BungeeBones.com/downloads/joomla/com_bungeebones.zip">Download the BungeeBones Remotely Hosted Web Directory Component for Joomla!</a>';
				
				
				}
				echo ' </h1>And remember! Just for installing the web directory you can get a 50% discount for any paid advertising you wish to place plus the multi-level, residual income you will earn from both your own and your downline\'s paid link sales. Now use the the instructions in the accordian help section below to guide you on the install. <p>Thanks for using and contributing to BungeeBones web traffic volume to the other members.';
				}
			
			echo '<p>&nbsp;</p>Sincerely,
			<p>&nbsp;</p>Robert Lefebure
			<p>&nbsp;</p>Owner/developer of BungeeBones.com<p>&nbsp;</p>';
			}	*/	


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
<table border="1" cellpadding="5" cellspacing="0"  bordercolor="#C0C0C0" width="100%" id="AutoNumber1">
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
<table width="100%" border="1"><tr><td>
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
echo '<table border="1" cellpadding="5"><tr><td style="font-size: 150%">';
echo '<h3> Part One of Format Two Code </h3>';
echo '<p>Paste this code into one of your own website\'s template page\'s &lt;Head&gt; section, pasting over everything above the closing head tag (i.e. leave the original closing &lt;/head&gt; tag)';
echo "<p>&nbsp;</p><p>&nbsp;</p>";

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
echo '<table border="1" cellpadding="5"><tr><td style="font-size: 150%">';
echo '<h3>Part Two of Format Two</h3>';
echo '<p>Paste this code into the &lt;body&gt; of your own website\'s template page, pasting anywhere in the page you like.';
echo "<p>&nbsp;</p><p>&nbsp;</p>";

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
echo '<table border="1" cellpadding="5"><tr><td style="font-size: 150%">';
echo '<h3>Part Three of Format Two - The Optional Reciprocal Program</h3>';
echo '<p>Paste this code into either the right or left sidebar of your own website\'s template page. BungeeBones will index your website with our search engine bot and if we find the recip code BungeeBones will display your link - in your particular category - in the sidebars of all the other reciprocal sites';
echo "<p>&nbsp;</p><p>&nbsp;</p>";

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
										include($_SERVER['DOCUMENT_ROOT']."/960bottom.php");
										exit(1);
										
										
										}//closes if C1
										else// begin form
										{



////////////////////////////////////////////////////
$moniker="<h5>Edit</h5>";
$body_width="wide";
include($_SERVER['DOCUMENT_ROOT']."/960top.php");

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
   				<a href="http://bungeebones.com/members" class="cssbutton sample a"><span>User CP Home</span></a>&nbsp;<a  class="cssbutton sample b"><span>Add Link</span></a>&nbsp;<a href="http://bungeebones.com/feedback.php" class="cssbutton sample a"><span> Support </span></a>&nbsp;<a href="http://www.bungeebones.com/index.php?option=com_content&view=article&id=5:bungeebones-terms-of-service&catid=25:the-project&Itemid=2" class="cssbutton sample a"><span> Terms Of Service </span></a>&nbsp;<a href="http://bungeebones.com/members/index.php?action=log_out" class="cssbutton sample a"><span> LOG Out </span></a>&nbsp;
					</div>
<div id="bd">

<form name="form1" method="GET" action="http://bungeebones.com/members/reg_form/index_edit.php"  onSubmit="return checkrequired(this)">
							 
				

		

<div id="display"></div>

<?
//include('accordion.html');

    $link_data = new mobile;

/*
$var = explode("/", $_SERVER['PATH_INFO']);

$url_cat = $var[1] ;//repnaming header_ID
//$regional_number = $var[2] ;//repnaming header_ID
$cat_id_orig = $var[1] ;//repnaming header_ID
$website_id = $var[2] ;//repnaming header_ID
*/
if(!isset($url_cat)||$url_cat == "")
{

$url_cat = '1'; 
$cat_id = '1';
}
else
{
$cat_id=$url_cat;
}


if($url_cat !==''  && $url_cat !== '1'){
$mpath_data = new modify;
$path_data = new mobile;
		$category = $url_cat;
		$nav = '<div align="center">';
		$nav .= '<a href="/members/reg_form/index_edit.php/1/'.$website_id.'"><font size="4">Top Level</font></a>';
		$nav .= $mpath_data->categoryPathforNav($category, $regional_number, $cat_id_orig, $website_id);
		//$search_nav =  searchPath($category);
		$categoryname = $path_data->getCatName($url_cat);
		$page_title = $categoryname;
		$nav .= $settings['nav_separator'].$categoryname;
$nav .= "IMPORTANT - Clicking \"Top Level\" lets you move your link to a different main category"; 		
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
$catModify = new modify;
$cat_info = $catModify->listCategories($cat_id, $regional_number, $cat_id_orig, $website_id);

//echo 'pop = ';
//$cat_subpop = $catData->sortRegionalifIsArray($regional_number);
//echo 'region number is ', $regional_number;
//echo '<br>cat sub pop is ', $cat_subpop;
/*
If($cat_id==1){echo"<h1 style='color: red;'>STEP 1 - Check And/Or Change Your Category</h1>";
$cat_name_orig = $catModify->categoryPathDisplay($cat_id_orig);
echo"<h3 style='color: red;'>Your Current (But From Here On Referred To As Your Original) Link Location Was/Is ";
echo $cat_name_orig;
echo '<p align="left">Your link is currently located in this path and category:<br><p align="left">To relocate it to a different location select the desired categories. Be aware, however, that free links are displayed according to their seniority in their current category. Relocating your link will cause you loss of your current seniority and you will be at the bottom of your newly selected one';
echo $cat_info;
}
elseif($cat_info =="false"){
$cat_name = $catData->getCatName($cat_id);
	echo "<h1>Step 1 - Completed</h1><h3>Your Current (But From Here On Referred To As Your Original) Link Location Was/Is". $cat_name ." And There Are No Sub-Categories Under The ". $cat_name ." Category.</h3><div style='font-size=150%'> Use the contact form and send in your suggestions if you believe some should be added. <br>Thanks<br>The admin.</div>";
$cat_name = $catData->categoryPathDisplay($cat_id);
echo"<p>&nbsp;</p><h3 style='color: red;'>Your Link Is Listed In The ". $cat_name . " Category</h3>";
echo $nav;
echo'<p>&nbsp;</p><p>&nbsp;</p>
<iframe id="buffer2" name="buffer2" src="http://bungeebones.com/members/subscript_stats_dd.php?cat_id='. $cat_id . '& url= ' .  $url . '&folder_name= '. $folder_name .'&file_name= '. $file_name . '" width="500px" border="0" height="255"></iframe>';


}






else
{

echo '<p>&nbsp;</p><h3 style="color: red;">Step 1 (continued) Select A Sub-Category (optional)</h3>';
$cat_name = $catData->categoryPathDisplay($cat_id);

$cat_name_orig = $catModify->categoryPathDisplay($cat_id_orig);

echo"<h3 style='color: red;'>Your Current Selection Places Your Link In The ". $cat_name . " Category</h3>
<h3>Your Original Local Was/Is ".$cat_name_orig."
<p style='text-align: left;'>If you want to move your link into a sub-category of your current one select from one below.</P>
<p style='text-align: left;'>To move your link into a different main category select the \"Top Level\" link at the top of the list to return to the main category list and select there.</p>


<p style='text-align: left;'>The numbers in parenthesis after each category in the list represent 1st, the total link population in that category and 2nd, the link population in  all sub-categories of that category. If the first number is above 20 then \"somebody\" will be getting pushed to a lower page. 
";

echo $nav;
echo $cat_info;
echo '<table width="75%"><tr><td  colspan="2"><h3 style="color: red;">OR, Suggest your own sub-category!</h3></td></tr><tr><td>Suggested category #1<input type=text" name="suggest1"></input></td><td>Suggested category#2 (will be a sub-category of suggested category #1) <input type=text" name="suggest2" ></input></td></tr>
<tr><td colspan="2">Select an alternate category (if your suggestion(s) is/are rejected.)<br><font size = "1">Note: This "Alternate category" input is a little bit redundant but clarifies which category you want as a backup. If you leave it empty your backup will be whatever category you are currently at. To use one of the above sub-categories as your backup click the one you want and proceed to fill in the form from that location.<br> </font><input type=text" name="alt_cat_name"></input></td></tr>
</table>';
echo '<h2>We take category placement seriously</h2>';

echo'<p>&nbsp;</p><p>&nbsp;</p><iframe id="buffer2" name="buffer2" src="http://bungeebones.com/members/subscript_stats_dd.php?cat_id='. $cat_id . '& url= ' .  $url . '&folder_name= '. $folder_name .'&file_name= '. $file_name . '" width="500px" border="0" height="275"></iframe>';



}

*/
if ($regional_number != ""){
//echo 'enter the regional value and  the number under a value to later explode it, and get the tree  when inputting all the tree into the into the data base';
echo '<input type="hidden" name="regional_number" value="'.$regional_number.'">';


}
echo '<input type="hidden" name="cat_id_orig" value="'.$cat_id_orig.'">';

echo '<input type="hidden" name="website_id" value="'.$website_id.'">';
/*$cat_page_id = $var[3] ;//part 2 of cat series
$cat_page_total = $var[4] ;//part 2 of cat series
$cat_record_num = $var[5] ;//part 3 of cat series
$link_page_id = $var[6] ;//part 2 of link series
$link_page_total = $var[7] ;//part 3 of link series
$link_record_num = $var[8] ;//part 3 of link series
*/

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

echo '<p>&nbsp;</p><p>&nbsp;</p><table bordercolor="black"cellpadding="3" width = "100%" border="1"height="175"><tr><td><h1 >Your Link Category Peers At A Glance</h1></td></tr><tr><td> <div style="width:100%;height:150px;overflow:auto;">';
	
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

<hr><span style="color : red;"> <a target=_"blank" href='.$orig_link_url[$counterp].'>' .$orig_link_name[$counterp].'</a></span><span style="color : green;"> &nbsp;&nbsp;   '.$orig_link_description[$counterp]  .'</span><span style="color : red;"><br />Peer Rating  ' .$PeerOverallpic .'</span><span style="color : red;">&nbsp;&nbsp;   Peer Vote Count  ' .$orig_link_peer_vote_count[$counterp].'</span></div>
				<div><span style="color : red;"> <a target="_blank" href="/reg_form/peer_review_form.php?url='.$strpurl.'&&selected_record='.$orig_link_id[$counterp].'&&cat_id='.$cat_id.'"></span><span style="font-size: 110%">Click Here To Place A "Peer Rank"  Vote For '. $orig_link_name[$counterp] . ' -</a></span></div> 


';
					}		
}//close if link pop over 1
	echo  '</div></td></tr></table>';


//now we need to retrieve all the old information of this link in order to populate the form fields below with the information 
//$var = explode("/", $_SERVER['PATH_INFO']);

//$url_cat = $var[1] ;//repnaming header_ID
//$regional_number = $var[2] ;//repnaming header_ID
//$cat_id_orig = $var[3] ;//repnaming header_ID
//$website_id = $var[4] ;//repnaming header_ID
$link_info_array = $catModify->getLinkInfo ($website_id, $cat_id_orig);
//array($title ,$url ,$description,$street,$postal code,$phone number);

$title = $link_info_array['0'];

$url = $link_info_array['1'];

$description = $link_info_array['2'];
$street = $link_info_array['3'];
$postal_code = $link_info_array['4'];
$phone_number = $link_info_array['5'];
//}



	
echo '<table width = "500" ><tr><td><p>&nbsp;</p><p>&nbsp;</p><div style="color: black; background-color: #ebebeb"><p>&nbsp;</p><h1 style="color: red";>Edit Your Link Info If You Wish (except the URL)</h1>
<div><span style="font-size: 1.25em; color : black;  ">If you are at the best category and/or region for your site and wish to edit the info (or otherwise please continue with category and regional selections above)</span></div>
<table border="1" cellpadding="4" cellspacing="4" style="border-collapse: collapse" bordercolor="#FFFFFF"  id="AutoNumber1">
									<tr>
										<td width="14%" align="right"><b><font size="2">Homepage URL</font></b></td>
										<td>&nbsp;<b><font size="2">
										
										
									<input type="text" name="requiredurl" readonly value="'.$url.'" size="30"></font></b>
	<input type="hidden" name = "cat_id_orig" value="'.$cat_id_orig
.'">
<input type= "hidden" name="website_id" value="'.$website_id.'">						
							</td>			  
						</tr>
						<tr>
							<td width="14%" align="right"><font size="2"><b>TITLE </b></font></td>
							<td ><b><font size="2">
										
								<input type="text" name="requiredtitle" value="'.$title.'" size="40"></font></b></td>
						
					</tr>
					<tr>
						<td width="14%" align="right"><font size="2"><b>WEBSITE DESCRIPTION </b></font></td>
						<td><b><font size="2">&nbsp;&nbsp;Descriptions limited to max 255 characters.
									
							<textarea rows="4" name="requiredlink_description" cols="40">'.$description.'</textarea></font></b>
					
				</td>
			</tr>

			<tr>
				<td colspan="2">
					<h1 style="color: red">Add More Company Info (Optional)</h1
					<p align="left">Attention: You need to have selected from all the available Regional Filters dropdowns (and select a city) in order for your business address and phone number to be displayed.
						<p align="left">Even if you have selected from each drop down, however, the address and telephone number are still optional.
							<p align="left">Add Your Company Street Address <input type="text" name="street" value="'.$street.'"  size="40">
								<p>Add Your Company Postal Code <input type="text" name="zip" value="'.$postal_code.'" size="40">
										<p>Add Your Company Phone Number<input type="text" name="phone" value="'.$phone_number.'" size="40">
										</td>
									</tr>
								</table>
							
							<br />
								   
						   </td>
						   
			</tr>
		</table></div></td></tr></table>

<input type="submit" value="Submit Link Info" name="B1">&nbsp;&nbsp;<input type="reset" value="Cancel" name="B2"></p>
<p>&nbsp;</p><p>OR</p>							
								
							
   <h3><a href="/members/index.php">Return To Your User Control Panel</a></h3>
';

?>
</form>	
<p>&nbsp;</p>	<p>&nbsp;</p>	   
					<?
}//close if cat > 1
?>
</div>
	<div id="ft">
	<div style="text-align: center"><a href="http://BungeeBones.com">HOME</a>  <a href="http://BungeeBones.com/articles">ARTICLES</a>  <a href="http://BungeeBones.com">FAQ </a>	 <a href="http://BungeeBones.com/feedback.php"> CONTACT US </a> </div>                                                                                                                                                                                                                                                                                                               

<div style="text-align: center"><a href="http://BungeeBones.com/bungee_bones">OUR LINK EXCHANGE/DIRECTORY</a> <a href="http://BungeeBones.com/subscription_sites">EXAMPLE SITES</a> </div><a target="_blank" href="http://twitter.com/Bungeebones">BB TWITTER </a>
<div style="text-align: center">
    <a href="http://validator.w3.org/check?uri=referer"><img
        src="http://www.w3.org/Icons/valid-xhtml10-blue"
        alt="Valid XHTML 1.0 Transitional" height="31" width="88" ></a>
  </div>
  
</div>

</div>
</div>

<?
include($_SERVER['DOCUMENT_ROOT']."/960bottom.php');");
}//close ifisset B1
} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}
