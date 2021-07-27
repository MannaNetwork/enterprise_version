  <?php


//dev note: registrations come into this page from the WP plugins and php scripts (verify PHP) with the "CONFIRM" variable populated which tricks this form into sot displaying the registration form (because it is the origianl registration page) but instead treats the incoming POST as one submitted by the form itself and proceeds to process the data as a form submittal (i.e. it adds the remote user's registration to the enterprise's data base).

//dev notes: I couldn't get curl to work with the dvelopment server's SSL so have to run it as http on dev server. The var below is used to switch out of that functionality if curl is working with SSL
$curl_security = "http://";//Add an "s" to make curl use SSL

//this will look for the server/host name on agent's site in case they installed the widget without registering.
$precleaned_host = $_SERVER['HTTP_HOST'];
$cleaned_host = str_replace("www.", "", $precleaned_host);
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
get_header();
/* check if this is coming in from an email verification or is included by registration page
id=11&verification_code
*/
if(array_key_exists('id', $_GET) AND array_key_exists('verification_code', $_GET) ){
//include('bootstrap_header.php'); 
}
if ($registration->errors) {
    foreach ($registration->errors as $error) {
        echo "<h2>Registration Error: ".$error."</h2>";
    }
}

// show positive messages
if ($registration->messages) {
    foreach ($registration->messages as $message) {
        echo "<h2>Registration Message: ".$message."</h2>";
    }
}



 if (!$registration->registration_successful && !$registration->verification_successful) { 
  if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
       echo "<h2>Login Error: ".$error."</h2>";
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
 echo "<h2>Login Message: ".$message."</h2>";
        }
    }
}

// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo '<h1 style="color:red;">&nbsp;&nbsp;'.$error.'</h1>';;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo '&nbsp;&nbsp;<h1 style="color:red;">&nbsp;&nbsp;'. $message.'</h1>';
        }
    }
}

//check 
// load mysqli connect
//the four constants (each to use four db users, permiisions, passwords and dbs) are READER_CUSTOMERS, WRITER_CUSTOMERS (for the public=facing users db) and READER_AGENTS, WRITER_AGENTS for the agents db - which is, essentially, the backend administrative db to handle syncing with the network. 
if (!defined('AGENT_FOLDERNAME')) {
include(dirname(__DIR__, 3)."/manna-configs/db_cfg/agent_config.php");
}
if (!defined('READER_AGENTS')) {
include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
}
include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_AGENTS);
include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");

 $mysqli = new mysqli($servername, $username, $password,DB_NAME_AGENTS);
        // Check connection
          if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
           } 
/* Dev note: Previous errors when sending non-utf8 data to mysql caused me to comment this out without even testing. It is likely unneccessary because all data sent gets sanitized and char set when inserted into the table at Manna Network
if (!mysqli_set_charset($mysqli, "utf8")) {
    printf("Error loading character set utf8: %s\n", mysqli_error($mysqli));
    exit();
} else {
    printf("Current character set: %s\n", mysqli_character_set_name($mysqli));
}
*/


if(array_key_exists('user_name', $_GET) AND $_GET['user_name']  =="change_me")
                {   
//Dev NOTE: IF the incoming GET value coming in has "change me"it means the "membership" version (the php script or wordpress plugin) hasn't configured their script on their site correctly
//Two things can be wrong
// 1) The deafult setting "change me" is still there (they need their link_num (reported to them as their affiliate number)or
// 2) They entered a wrong link_id
//We can only check for one accurately

echo '<h1 style="color:red";>We have detected that you have not finished configuring your application! This will prevent you from earning commissions! Please insert your link id number in the first line of the mannanetwork-dir/index.php file where it has the line of code <b>$lnk_num = "change_me" ;</b> and insert your link number '.$link_id_at_local.' in place of the phrase <b>"change_me"</b>';
echo '<h1 style="color:red";>The entire line should read<br>$lnk_num = '.$link_id_at_local.'; <br>when you are done</h1>';

echo '<h1 style="color:red";>RETURN TO PREVIOUS PAGE, <a href="http://'.$_GET['remote_server'].'/mannanetwork-dir/index.php">PREVIOUS PAGE</a> SELECT "ADD URL" TAB AGAIN, AND THE CORRECT CONFIGURATION SHOULD CAUSE THIS NOTICE TO NOT APPEAR</h1>';

}


/*
		$banned_ips = array('198.2.200.97','117.242.25.25','137.175.11.97','137.175.9.65','142.0.138.33','192.74.229.97','198.2.198.161','198.2.200.97','198.200.51.1',
		'125.73.56.54',
		'137.175.29.33',
		'137.175.9.193',
		'142.0.135.1',
		'142.4.102.225',
		'142.4.109.195',
		'142.4.117.132',
		'198.2.193.226',
		'198.2.196.161',
		'198.2.198.33',
		'198.2.198.98',
		'198.2.203.194',
		'198.2.216.114',
		'198.2.216.57',
		'218.93.127.107',
		'142.4.109.196'
		);



		if (getenv('HTTP_X_FORWARDED_FOR')) {
			$pipaddress = getenv('HTTP_X_FORWARDED_FOR');
			$ipaddress = getenv('REMOTE_ADDR');

					if(in_array("$pipaddress", $banned_ips)){
					echo "<h1>Your Proxy IP address is : ".$pipaddress. "(via $ipaddress)" ;
					echo "<img src='../images/Embarrassed_Chimpanzee.jpg'> AND IT HAS BEEN BANNED FOR ABUSING THIS SYSTEM. ALL AVENUES OF REPORTING YOU TO GOVERNMENT AGENCIES, 				ISPs, EMAIL HOSTS ETC ARE BEING PURSUED</h1>";
					exit();
					}

		    } else {
			$ipaddress = getenv('REMOTE_ADDR');
					if(in_array("$ipaddress", $banned_ips)){
					echo "<h1>Your  IP address is : ".  $ipaddress ;
					echo " <img src='../images/Embarrassed_Chimpanzee.jpg'> AND IT HAS BEEN BANNED FOR ABUSING THIS SYSTEM. ALL AVENUES OF REPORTING YOU TO GOVERNMENT AGENCIES, ISPs, EMAIL HOSTS ETC ARE BEING PURSUED</h1>";
					exit();
//you can also add a redirect here. I'll sometimes redirect them to the law enforcement agency in their country (based on their ip) IPs from Russia, for example, can be directed to the KGB website. US ip addresses can be redirected to the FBI
					}
		       // echo "Your IP address is : $ipaddress";
		}

*/


$display_blockmp = '

  <div class="box content">
<form class = "frms" method="POST" action="" name="registerform">';
if(array_key_exists("flag", $_GET) OR isset($_GET['flag'])){
$display_blockmp .= '<input type="hidden" name="flag" value="'.$_GET['flag'].'">';
}
if(array_key_exists("installer_id", $_GET) OR isset($_GET['installer_id'])){
$display_blockmp .= '<input type="hidden" name="installer_id" value="'.$_GET['installer_id'].'">';
}
$display_blockmp .= '<label for="user_name">'.WORDING_REGISTRATION_USERNAME.'</label>
  <input id="user_name" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" style="width: 20em;" required />
   <label for="user_email">'.WORDING_REGISTRATION_EMAIL.'</label>
    <input id="user_email" type="email" name="user_email" style="width: 20em;" required />
  <br>     <label for="user_password_new">'. WORDING_REGISTRATION_PASSWORD.'</label>
    <br>    <input id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" style="width: 20em;" required autocomplete="off" />
    <br>     <label for="user_password_repeat">'. WORDING_REGISTRATION_PASSWORD_REPEAT.'</label>
   <br>       <input id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" style="width: 20em;" required autocomplete="off" />
  <br>   <label for="website_title">'. WORDING_REGISTRATION_TITLE.'</label>
   <br>   <input id="website_title" type="text"  name="website_title" style="width: 20em;" required />
    <br>   <label for="website_description">'. WORDING_REGISTRATION_DESCRIPTION.'</label>
     <br>   <textarea  id="website_description" type="text-area"  name="website_description" required  rows="5" cols="40">&nbsp;</textarea>
      <br>   <label for="website_url">'. WORDING_REGISTRATION_URL.'</label>
      <br>    <input id="website_url" type="text"  name="website_url" value="https://Insert Your URL HERE" required /><span style="color:red;">(remove the "s" from "https" if yours is not SSL!)</span>
<hr>';



$sql="SELECT * FROM categories WHERE parent = 1 ORDER by name";

$result = mysqli_query($mysqli,$sql);

$display_blockmp .='<br><div style=" border: 4px dotted red;padding-top: 50px;
    padding-right: 30px;
    padding-bottom: 50px;
    padding-left: 80px;">
<label for="WORDING_REGISTRATION_CATEGORY">'. WORDING_REGISTRATION_CATEGORY.'</label>

<table cellpadding="10">
<tr><td>

<!--<form action="'. htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8").'">-->
<span>
<select name="category_id" onchange="showSubCat1(this.value), getSummaryReport(this.value)">


<!--<select name="category_id" onchange="showSubCat1(this.value)">-->
<option value="">Select a Main Category:</option>
 ';

while($row = mysqli_fetch_array($result)) {
$display_blockmp .="<option value='y:" . $row['id']  .":".$row['name'] . "'>".$row['name']."</option>";

}


		$display_blockmp .='</select>
		        <br>
		         <div id="txtHint1" name="txtHint1"><b>More Subcategories Available After Selection.</b></div>
		          <div id="txtHint2" name="txtHint2"><b></b></div>
		           <div id="txtHint3" name="txtHint3"><b></b></div>
		            <div id="txtHint4" name="txtHint4"><b></b></div>
		     
		       <input type="reset" onclick="deleteAllLevels(1)" class="button standard" value="Clear">
		   <!-- </form>-->';
	//display the category id input AFTER the AJAX form, and try to populate it with the javascript result

	//we need to run the getNumRowsPaid($cat_id) function and getNumRowsDemo($cat_id) and getNumRowsFree($cat_id) function in members_class.php but with the ajax get ranking function
	$display_blockmp .='<div width: 250px;style="font-size: larger; font-weight:stronger;">Your Current Selection *: <input style="font-size: larger; font-weight:stronger;width: 250px;" type="text" id="category_name"  class="category_name" name="category_named" value="">
<input type="hidden" id="category_id" name="category_id" class ="category_id" value="" readonly>
</div>
</td>
<td width style=" vertical-align: text-top;">
	<div style="width: 500px;">
		<table width = "100%">
		<tr><td  id="summary_header" class="summary_header" name="summary_header">
		<div class="summary" id="summary" name="summary"></div>
<div class="accordian" id="accordian" name="accordian"></div>
		</td></tr>
		</table>
	</div>
</td></tr>
</table>'.WORDING_CATEGORY_SUGGESTION.'
		      <input type="text" name="newcatsuggestion" style="width: 20em;"/>

</div>';



$sql="SELECT * FROM categories_regional2 WHERE parent = 1 ORDER by name";
$result = mysqli_query($mysqli,$sql);

$display_blockmp .='<br><div style=" border: 4px dotted blue;padding-top: 50px;
    padding-right: 30px;
    padding-bottom: 50px;
    padding-left: 80px;">
<label for="WORDING_REGISTRATION_LOCATION">'.WORDING_REGISTRATION_LOCATION.'</label>
<table cellpadding="10"><tr><td><!--<form action="'. htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8").'">-->

<select name="mainLocs" onchange="showSubLoc1(this.value), getLocationReport(this.value)">
<option value="">Select Your Continent:</option>
 ';
while($row = mysqli_fetch_array($result)) {
$display_blockmp .="<option value='y:" . $row['id']  .":".$row['name'] . "'>".$row['name']."</option>";
}


$display_blockmp .='</select>
<br>
<div id="locHint1" name="locHint1"><b>More Sub Locations Available After Selection.</b></div>
<div id="locHint2" name="locHint2"><b></b></div>
<div id="locHint3" name="locHint3"><b></b></div>
<div id="locHint4" name="locHint4"><b></b></div>
<div id="locHint5" name="locHint5"><b></b></div>
<input type="reset" onclick="deleteAllLevels(2)" class="button standard" value="Clear"><!-- </form>-->';


//display the category id input AFTER the AJAX form, and try to populate it with the javascript result
$display_blockmp .='<div style="font-size: larger; font-weight:stronger;">Your Current Location Selection : <input style="font-size: larger; font-weight:bold;width: 350px;" type="text" id="location_name" class="location_name" name="location_named" value="" ><input  type="hidden" id="location_id" class="location_id" name="location_id" value="" readonly></div></td>
<td width style=" vertical-align: text-top;">
	<div style="width: 500px;">
		<table width = "100%">
		<tr><td  id="summary_header2" class="summary_header2" name="summary_header2">
		<div class="summary2" id="summary2" name="summary2"></div>
		</td></tr>
		</table>
	</div>
</td>
</tr></table>';






mysqli_close($mysqli);

$display_blockmp .='
    <label for="website_street">'. WORDING_REGISTRATION_STREET.'</label>
     <input id="website_street" type="text"  name="more_info_website_street" style="width: 350px;"/>
      <label for="website_district">'. WORDING_REGISTRATION_DISTRICT.'</label>
        <input id="website_district" type="text"  name="website_district" style="width: 350px;"/></div>';

if(!array_key_exists("flag", $_GET) OR !isset($_GET['flag']) OR $_GET['flag'] !== "1"  ){
$display_blockmp .= ' <h1>'.WORDING_REGISTRATION_RECIPROCAL_HEADER.
WORDING_REGISTRATION_RECIPROCAL.'
     <div style="width:600px; margin:auto; background-color: #f2f2f2; color: #666666; padding-left: 10px; padding-right: 10px; padding-top: 5px; padding-bottom: 5px;">

      <label for="widget_software_links">'. WIDGET_SOFTWARE_LINKS.'</label>
       <a style="color:blue; text-decoration:underline;" target="_blank" href="download_wp_plugin.zip">Wordpress Plugin (two minute installation)</a>
        <hr> 
         <a style="color:blue; text-decoration:underline;" target="_blank" href="download_php_script.zip">PHP Script </a>
         <hr>
           
   </div>';
}
$display_blockmp .= '
    <br>     
     <img src="tools/showCaptcha.php" alt="captcha" />
      <label>'.WORDING_REGISTRATION_CAPTCHA.'</label>
        <input type="text" name="captcha" required style="width: 150px;"/>
        <input type="submit" name="register" value="'.WORDING_REGISTER.'" />
   </form>
</div></div>
  <a href="./index.php">'. WORDING_BACK_TO_LOGIN.'</a>
';
echo  $display_blockmp;

 } 
get_footer();
if(array_key_exists('id', $_GET) AND array_key_exists('verification_code', $_GET) ){
//include('bootstrap_footer.php');
}
?>

