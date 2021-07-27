<?php
//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 
$default_price = "0.00";//this is what charge is applied to any not having a price set in the database
$default_adj = "1";
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
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

if(isset($_POST['B1'])){
$folder_name= $_POST['folder_name'];
$file_name= $_POST['file_name'];
$custom_title1= $_POST['custom_title1'];
$custom_title2= $_POST['custom_title2'];
$display_freebies= $_POST['display_freebies'];
$time_period= $_POST['time_period'];
$meta_descrip =  $_POST['meta_descrip'];
$keywords = $_POST['keywords'];
$is_niche = $_POST['is_niche'];
$donate= $_POST['donate'];
echo 'donate = ', $donate;
if($donate = "Enter your instructions here"){
echo 'hello';
}
$query="update `widgets` set `link_id`='$link_id',		
`time_period`='$time_period',
`start_clone_date`='$start_clone_date',
`is_recip`='$is_recip',
`is_niche`='$is_niche',
`display_freebies`='$display_freebies',
`custom_title1`='$custom_title1',
`custom_title2`='$custom_title2'
where `link_id` = '$link_selected'";
echo $query;

echo '$folder_name= ',$folder_name;
echo '$file_name= '.$file_name;
echo '$custom_title1= '.$custom_title1;
echo '$custom_title2= '.$custom_title2;
echo '$display_freebies= '.$display_freebies;
echo '$time_period= '.$time_period;

echo '$is_niche = ', $is_niche;
								

include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");
echo 'hello';

include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");

exit();
}
else
{
$sql="SELECT
`folder_name`,
`file_name`,
`custom_title1`,
`custom_title2`,
`display_freebies`,
`time_period`,
`is_niche`
FROM `widgets`
WHERE `link_id` = '$link_selected'";

$result = @mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result);
$folder_name = $row['folder_name'];
$file_name = $row['file_name'];
$custom_title1 = $row['custom_title1'];
$custom_title2 = $row['custom_title2'];
$display_freebies = $row['display_freebies'];
$time_period = $row['time_period'];
$is_niche = $row['is_niche'];

include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");
?>

<h1>Distributed Web Directory Configuration Settings</h1>
<p style="text-align:left; font-size: 150%">These configuration settings enable you to customize the web directory that you have installed on your website at <b>"</b><? echo $folder_name."/".$file_name;?>"</b> They can be updated as often as you like and feel free to experiment.</p>
<p style="text-align:left;"><ul><LI>Custom Title For Your Website</LI>
<ul><LI>Add a "first half" of a title and a "second half" and they will sandwhich the category name in between giving each "page" the directory displays its own, distinct name according to each category and your website.</LI></ul>
<li>Choose whether to display free links on your website and, if so, for how long.</li>
<li>Donate the proceeds from sales of paid links from your website to the charity of your choice </li>
<li>Operate your directory as a "niche" directory by choosing one of the main categories.</li>

</ul></p>

<FORM action="<? echo $_SERVER['PHP_SELF'];?>" method="POST" target="_self">
  
<input type="hidden" name="folder_name" value="<?echo $folder_name;?>">
<input type="hidden" name="file_name" value="<?echo $file_name;?>">
<p align="left"><b>Create The First Half of The Title Of Your Page </b><font color="#ff0000">(see configuring form instructions above)</font>
			
     <p align="left"> <input id="custom_title1" size="40" type="text" name="custom_title1" value="<?echo $custom_title1;?>">
       <br><span style="font-size:70%;">eg. Your domain name, the type of website (Portal, News, Shopping), a greeting (Enjoy, Visit, Surf)</span>

        <p align="left">  <p align="left"><b>Create The Second Half of The Title Of Your Page </b><font color="#ff0000">(see configuring form instructions above)</font>
        <p align="left"> <input id="custom_title2" size="40" type="text" name="custom_title2"   value="<?echo $custom_title2;?>">
         <br> <span style="font-size:70%;">eg. Links, Info, Websites etc</span>
      
		    
   
      <p align="left"><b>Do You Want To Display &quot;Free&quot; Sites?</b><font color="#ff0000">(see configuring form instructions above)</font>

      <p align="left">Yes <input type="radio" value="display_freebies" checked name="display_freebies">&nbsp; 
      No <input type="radio" name="display_freebies" value="no_display_free"></p>
      <p align="left"><b>If yes, for how long do you wish to display them on your 
      site for?</b><font color="#ff0000">(see configuring form instructions above)</font>
      <p align="left">  <select size="1" name="time_period">
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

 <br>
<p align="left"> <h2>Donate Your Web traffic To Your favorite Charity!</h2> <span style="font-size:125%;">If you wish to donate the proceeds of your directory to a charity of your choice then enter your instructions for donating to them here. Provide all info we will need in order to complete the payment. </span>
<?
echo 'donate = ', $donate;
if($donate !=="" AND $donate !== 'Enter your instructions here'){?>
<textarea name="donate" cols="40" rows="5"><?echo $donate;?></textarea><br>
<?}
else
{?>
<textarea name="donate" cols="40" rows="5">Enter your instructions here</textarea><br>
<?} ?>

         <br>

	<!--<h2>Display A "Niche" Directory Or A General Directory?</h2>
		-->

<br /><br />

<br /><br />
<table width="100%" border="1"><tr><td>
<H!>NEW FEATURE!</h1>
<p align="left">The distributed web directory can be operated as a "niche" directory and only show the sub-categories and links of one, selected main category. For example, you can operate it as a "Real Estate" Directory or a "Computer" Directory.</p>
<p>&nbsp;</p><p>If you want to help build the sub-category structure of the niche you can send along a comma separated text file of your suggested sub-categories to Robert@BungeeBones.com
<p>&nbsp;</p>
<p>&nbsp;</p>
<?
if($is_niche !==""){

echo "<p>You have previously selected to operate as a niche directory in the ", $niche;
echo " category<br>";
}
?>
<H1>Selecting One Of These Will Cause Your Directory To Only Display That Category</h1>
<select size="1" name="is_niche">
<option value="0">Niche Option</option>
<option value="60">Accessories</option>
<option value="65">Art/Photo/Music</option>
<option value="69">Automotive</option>
<option value="102">Books/Media</option>
<option value="111">Business</option>
<option value="125">Careers</option>

<option value="126">Clothing/Apparel</option>
<option value="134">Commerce</option>
<option value="9">Computers</option>
<option value="148">Education</option>
<option value="147">Electronics</option>
<option value="2198">Environment</option>
<option value="2702">Finance</option>
<option value="1307">Games</option>
 <option value="1330">Health/Medical</option>

<option value="1375">Home</option>
<option value="1401">Kids &amp; Teens</option>
<option value="1415">News</option>
<option value="2822">Professional</option>
<option value="3">Real Estate</option>
<option value="1275">Recreation</option>
<option value="1438">Reference</option>
<option value="8">Religion</option>

<option value="2799">Services</option>
<option value="2027">Shopping</option>
<option value="2068">Society</option>
<option value="2098">Sports</option>
<option value="124">Travel</option>
 </select>
</td></tr></table>
<p>&nbsp;</p>
<INPUT type="submit" name="B1" value="Submit">
<?
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");
}
} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
