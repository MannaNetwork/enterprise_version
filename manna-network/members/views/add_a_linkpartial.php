<?php
//echo '<br>in views/add_a_link.php';
//print_r($_POST);
$root = dirname(dirname(dirname(dirname( __FILE__, 2 ))));

if (file_exists($root.'/wp-load.php')) {
// WP 2.6
require_once($root.'/wp-load.php');
} else {
// Before 2.6
require_once($root.'/wp-config.php');
}
/*if(!isset($_POST['confirm'])){ 
echo '<br><h1>in isset($_POST[confirm]))</h1>';
get_header();
} */
require_once(dirname( __FILE__, 2 )."/translations/en.js");
require_once(dirname( __FILE__, 2 )."/css/styles.css");
include('styles.css');
include(dirname( __FILE__, 2 ).'/css/members_menu.css');

include('views/_menu.php');

require_once(dirname( __FILE__, 4 )."/manna-configs/db_cfg/agent_config.php");
   



//include(dirname(__DIR__, 2)."/css/styles.css");
//Dev Notes: This registration form follows a complicated process to 1) display what is basically a copy of the Manna network registration form here but, when it is submitted the curl process sends all the post data to Manna network.
//All the visuals of the page are from the code below. The curl only returns the success message at the end (i.e. check your email)
//echo '<br>POST = ';
print_r($_POST);
//echo '<br>SESSION = ';
//print_r($_SESSION);
if(isset($_POST['confirm'])  && $_POST['randcheck']==$_SESSION['rand']){
//Array ( [website_title] => sadfsadfasf [website_description] =>  sasdfsdafsdg [website_url] => https://dsfdsfdsf,com [category_id] => 111 [category_named] => Business [confirm] => CONFIRM ) 
$website_title = $_POST['website_title']; 
$website_description = $_POST['website_description']; 
$website_url = $_POST['website_url'];  
$category_id = $_POST['category_id']; 
$category_named = $_POST['category_named']; 
$agent_ID = AGENT_ID; 
//$users_balances_string = $_POST['users_balances_string'];



// now that it is confirmed it has to submit it to the classes/Add_Url.php (which is a copy of Registration.php class)
$installer_id = get_option('installer_id');

//why am I using curl to the local folder?
// all we need to do is install in two tables - one here and one in MN

  include(dirname( __FILE__, 5 )."/".AGENT_FOLDERNAME."/manna-network/members/classes/AddURL.php");
$addalink = new addurl();


$new_links_id = $addalink->addNewLink($captcha, $recruiter_lnk_num, $website_title, $website_description, $website_url, $category_id, $newcatsuggestion, $location_id, $website_street, $website_district, $installer_id, $user_id);

//now send user registration to central 
		$file="http://exchange.manna-network.com/incoming/add_a_link.php";
		$args = array(
		'agent_id' => AGENT_ID,
		'remote_user_id' => $user_id,
		'remote_link_id' => $new_links_id,
		'recruiter_lnk_num' => $recruiter_lnk_num,
		'user_registration_datetime' => $user_registration_datetime,
		'website_title' => $website_title,
		'website_description' => $website_description,
		'website_url' => $website_url,
		'category_id' => $category_id,
		'newcatsuggestion' => $newcatsuggestion,
		'location_id' => $location_id,
		'website_street' => $website_street,
		'website_district' => $website_district,
		'installer_id' => $installer_id,
		'promo_credit' => $promo_amount
		);

/* deprecate $recruiter_lnk_num
$new_links_id = $addalink->addNewLink($captcha, $website_title, $website_description, $website_url, $category_id, $newcatsuggestion, $location_id, $website_street, $website_district, $installer_id, $user_id);

//now send user registration to central 
		$file="http://exchange.manna-network.com/incoming/add_a_link.php";
		$args = array(
		'agent_id' => AGENT_ID,
		'remote_user_id' => $user_id,
		'remote_link_id' => $new_links_id,
		'user_registration_datetime' => $user_registration_datetime,
		'website_title' => $website_title,
		'website_description' => $website_description,
		'website_url' => $website_url,
		'category_id' => $category_id,
		'newcatsuggestion' => $newcatsuggestion,
		'location_id' => $location_id,
		'website_street' => $website_street,
		'website_district' => $website_district,
		'installer_id' => $installer_id,
		'promo_credit' => $promo_amount
		);  */
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $file);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, array('locus_array' => $locus_array,'link_record_num' => $link_record_num,'link_page_total' => $link_page_total, 'link_page_id' => $link_page_id, 'pagem_url_cat' => $pagem_url_cat,'link_page_num' => $link_page_num, 'cat_page_num' => $cat_page_num, 'url_cat' => $url_cat, 'affiliate_num' => $affiliate_num  ));
		curl_setopt($ch, CURLOPT_POSTFIELDS,$args);

		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
    		    $curl_errno = curl_errno($ch);
		    $curl_error = curl_error($ch);
		    if ($curl_errno > 0) {
			    echo "cURL Error line 575 ($curl_errno): $curl_error\n";
		    } else {   
//echo $data ; 
//now that the user info was duplicated on M.N., all the info was duplicated from tempuser table to remote_mn_id_bridge. We can safely delete the info from tempuser

//the reason why this delete is happening is because this user's info is added to a temp table on MN until they confirm their email. Then it is copied over to links and the bridge table and will be broadcast so it can now be deleted from temp table on MN



/* we don't need to run this delete here. They are deleted when they are approved by MN. But there may be future need for this if we give enterprises the ability to approve their own links
		$file="http://exchange.manna-network.com/incoming/delete_tmps.php";
		$args = array(
		'agent_id' => AGENT_ID,
		'remote_user_id' => $user_id,
		'remote_link_id' => $link_id,
		'recruiter_lnk_num' => $recruiter_lnk_num,
		'user_registration_datetime' => $user_registration_datetime,
		'website_title' => $website_title,
		'website_description' => $website_description,
		'website_url' => $website_url,
		'category_id' => $category_id,
		'newcatsuggestion' => $newcatsuggestion,
		'location_id' => $location_id,
		'website_street' => $website_street,
		'website_district' => $website_district,
		'installer_id' => $installer_id,
		'promo_credit' => $promo_amount
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $file);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, array('locus_array' => $locus_array,'link_record_num' => $link_record_num,'link_page_total' => $link_page_total, 'link_page_id' => $link_page_id, 'pagem_url_cat' => $pagem_url_cat,'link_page_num' => $link_page_num, 'cat_page_num' => $cat_page_num, 'url_cat' => $url_cat, 'affiliate_num' => $affiliate_num  ));
		curl_setopt($ch, CURLOPT_POSTFIELDS,$args);

		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
    		    $curl_errno = curl_errno($ch);
		    $curl_error = curl_error($ch);
		    if ($curl_errno > 0) {
			    echo "cURL Error line 575 ($curl_errno): $curl_error\n";
		    } else {    
//echo '<h1> the info shou;ld be from tempuser</h1>';
		curl_close($ch);
		
}
		echo($data);
*/
}

header( "Location: http://".AGENT_URL."/".AGENT_FOLDERNAME."/manna-network/members/success.php", true, 303 );
exit($data);

//get_footer();

}

elseif(isset($_POST['register'])){
require_once(dirname( __FILE__, 2 )."/js/mn_ajax.js");

get_header();

  if (strtolower($_POST['captcha']) != strtolower($_SESSION['captcha'])) {
           // $this->errors[] = 'MESSAGE_CAPTCHA_WRONG';
echo 'MESSAGE_CAPTCHA_WRONG';
exit('MESSAGE_CAPTCHA_WRONG');
}
elseif (empty($_POST['website_title']) || empty($_POST['website_description'])|| empty($_POST['website_url'])) {
          //  $this->errors[] = $this->lang['MESSAGE_PASSWORD_EMPTY'];
echo 'MESSAGE_REQUIRED_FIELD_EMPTY';
exit('MESSAGE_REQUIRED_FIELD_EMPTY');
        } 
elseif(array_key_exists('category_id', $_POST) && isset($_POST['category_id'])){
if (!is_numeric($_POST['category_id'])){
echo 'MESSAGE_NON_NUMERIC1', $_POST['category_id'];
exit('MESSAGE_NON_NUMERIC1');
        } 
}
elseif(array_key_exists('regional_num', $_POST) && isset($_POST['regional_num'])){
if (!is_numeric($_POST['regional_num'])){
echo 'MESSAGE_NON_NUMERIC2';
exit('MESSAGE_NON_NUMERIC2');
        } 
}


 //  $this->errors[] = $this->lang['MESSAGE_PASSWORD_EMPTY'];

/* none of these from the registration class are needed but can be converted to check the link id, category id (if integers) and the string length of title and description and remove unwanted characters

Array ( [recruiter_lnk_num] => [website_title] => dsfdf [website_description] =>  dsfsdfd dsff sdffffsdfd dsfsdfdsf dsfdsfdsf dsfsdfsdf dsfsdfsdf dsfdsfsdfsdfsd [website_url] => https://gfnfgnfn.com [category_id] => 111 [subCat1] => [category_named] => Business [regional_num] => [regional_named] => [captcha] => LW39 [register] => Submit Your New Site ) 


        } elseif (empty($user_name)) {
            $this->errors[] = $this->lang['MESSAGE_USERNAME_EMPTY'];
        } elseif (empty($user_password) || empty($user_password_repeat)) {
            $this->errors[] = $this->lang['MESSAGE_PASSWORD_EMPTY'];
        } elseif ($user_password !== $user_password_repeat) {
            $this->errors[] = $this->lang['MESSAGE_PASSWORD_BAD_CONFIRM'];
        } elseif (strlen($user_password) < 6) {
            $this->errors[] = $this->lang['MESSAGE_PASSWORD_TOO_SHORT'];
        } elseif (strlen($user_name) > 64 || strlen($user_name) < 2) {
            $this->errors[] = $this->lang['MESSAGE_EMAIL_TOO_LONG'];
        } 
//elseif (!preg_match('/^[a-z\d]{2,64}+\_[a-z\d]{2,64}$/i', $user_name)) {
        elseif (!preg_match('/^[a-z\d]{2,64}$/i', $user_name)) {                     

            $this->errors[] = $this->lang['MESSAGE_USERNAME_INVALID'];
        } elseif (empty($user_email)) {
            $this->errors[] = $this->lang['MESSAGE_EMAIL_EMPTY'];
        } elseif (strlen($user_email) > 64) {
            $this->errors[] = $this->lang['MESSAGE_EMAIL_TOO_LONG'];
        } elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {

            $this->errors[] = $this->lang['MESSAGE_EMAIL_INVALID'];

        // finally if all the above checks are ok
        }  */

$dont_show_array= array('captcha', 'register');
echo '<div class="reg_form_page"><h1 align="center">Confirm Your Registration Details For Accuracy</h1>
 <div class="reg_form_content">
<form class = "frms" method="POST" action="" name="registerform">';
$rand=rand();
   $_SESSION['rand']=$rand;
echo '<input type="hidden" value="'.$rand.'" name="randcheck" />';

	foreach($_POST as $key=>$value){
if(!in_array($key, $dont_show_array, TRUE) && !empty($value)){
	echo '<input type="hidden" name="'.$key.'" value="'.$value.'"><br>', $key;
	echo '       = ', $value;
          }
	}

echo '<p><input type="submit" name="confirm" value="CONFIRM" />
   </form></div></div>';
}
else
{
require_once(dirname( __FILE__, 2 )."/js/mn_ajax.js");

get_header();

$display_blockmp = '
       <h3 align="center">'.REG_FORM_WELCOME_TITLE.'</h3>'.REG_FORM_WELCOME_BODY.'
        
<form class = "frms" method="POST" action="" name="registerform">';

if (array_key_exists ( "script_type" , $_GET ) AND isset($_GET['script_type'])) {
$display_blockmp .= '
<input type = "hidden" id="script_type" name="script_type" value="'. $_GET['script_type'].'">
<h3>In order for the'. $_GET['script_type'].' to function properly it is necessary for you to register at the ad server.</h3>
<h4>You will need to:<br>
<ul> 
<li>Register with a valid email address</li>
<li>Verify the email address</li>
<li>Login at the ad server</>
<li>Add website info (a title, description and URL)</li>
</ul>
</h3>
<h3>Doing that will also advertise your website across the entire ad network (for free!).</h3>
<h3>Please fill in the form below to get started.</h3>'; 
}

if(array_key_exists("flag", $_GET) OR isset($_GET['flag'])){
$display_blockmp .= '<input type="hidden" name="flag" value="'.$_GET['flag'].'">';
}



$display_blockmp .= '<input type="hidden" name="recruiter_lnk_num" value="'.$mn_lnk_num.'">
  <br>   <label for="website_title">'. WORDING_REGISTRATION_TITLE.'</label>
   <br>   <input id="website_title" type="text"  name="website_title" style="width: 20em;" required />
    <br>   <label for="website_description">'. WORDING_REGISTRATION_DESCRIPTION.'</label>
     <br>   <textarea  id="website_description" type="text-area"  name="website_description" required  rows="5" cols="40">&nbsp;</textarea>
      <br>   <label for="website_url">'. WORDING_REGISTRATION_URL.'</label>
      <br>    <input id="website_url" type="text"  name="website_url" value="https://Insert Your URL HERE" required /><span style="color:red;">(remove the "s" from "https" if yours is not SSL!)</span>
<hr>';

if( array_key_exists('gocat', $_GET) AND ISSET($_GET['gocat'])){
//NOTE category id comes in from main menu
$category_id = 1;
}

elseif( array_key_exists('q', $_GET) AND ISSET($_GET['q'])){
//NOTE category id comes in from main menu
$category_id = $_GET['q'];
}
elseif( array_key_exists('category_id', $_GET) AND ISSET($_GET['category_id'])){
//NOTE THIS CATEGORY ID COMES IN FROM THE PAGINATOR MENU
$category_id = $_GET['category_id'];
}
elseif(array_key_exists('category_id', $_POST) && ISSET($_POST['category_id'])){

//NOTE q comes in from dropdown 
$category_id = $_POST['category_id'];
}
else
{
$category_id = 1;

}
//both determiine what links are shown via category id var




//Begin Category AJAX
$args = array(
'regional_num' => $regional_num,
'link_record_num' => $link_record_num,
'link_page_total' => $link_page_total, 
'link_page_id' => $link_page_id, 
'pagem_url_cat' => $pagem_url_cat,
'link_page_num' => $link_page_num, 
'cat_page_num' => $cat_page_num, 
'category_id' => $category_id, 
'lnk_num' => $lnk_num,
'installer_id' => $installer_id,
'http_host' =>   $_SERVER['HTTP_HOST']
);


//dev notes: it appears curl will never work when the url is calling is on the SAME server (which MAY the case IF/WHEN an AGENT decides to use the wordpress plugin on their own site - i.e. it will break)
$handle = curl_init();
$url1 = "http://".AGENT_URL."/".AGENT_FOLDERNAME."/mannanetwork-dir/get_category_json.php";
$user_agent = $_SERVER['HTTP_USER_AGENT'];

		    $ch = curl_init();    // initialize curl handle
		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		    curl_setopt($ch, CURLOPT_URL, $url1); 
		    curl_setopt($ch, CURLOPT_FAILONERROR, 1);          
		    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);    
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
		    curl_setopt($ch, CURLOPT_TIMEOUT, 50); 
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $args); 
		    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
	
		    $jsoncatList = curl_exec($ch);
		    $curl_errno = curl_errno($ch);
		    $curl_error = curl_error($ch);
		    if ($curl_errno > 0) {
			   $display_blockmp .=  "line 163 cURL Error ($curl_errno): $curl_error\n";
		    } else {
		      $display_blockmp .=  '<div><h2>Select Category</h2>';

		$categoryList = json_decode($jsoncatList, true);
$display_blockmp .= '<select name="category_id" onchange="showSubCat1(this.value)"><option value="">'.WORDING_AJAX_MENU.'</option> ';
$display_blockmp .= "
<option value='y:60:Accessories'>Accessories</option>
<option value='y:65:Art/Photo/Music'>Art/Photo/Music</option>
<option value='y:69:Automotive'>Automotive</option>
<option value='y:10023:Bitcoin'>Bitcoin</option>
<option value='y:102:Books/Media'>Books/Media</option>
<option value='y:111:Business'>Business</option>
<option value='y:125:Careers'>Careers</option>
<option value='y:126:Clothes/Apparel'>Clothes/Apparel</option>
<option value='y:134:Commerce'>Commerce</option>
<option value='y:9:Computers'>Computers</option>
<option value='y:148:Education'>Education</option>
<option value='y:147:Electronics'>Electronics</option>
<option value='y:2198:Environment'>Environment</option>
<option value='y:2702:Finance'>Finance</option>
<option value='y:10000:Food/Restaurants'>Food/Restaurants</option>
<option value='y:1307:Games'>Games</option>
<option value='y:1330:Health'>Health</option>
<option value='y:1375:Home'>Home</option>
<option value='y:1401:Kids &amp; Teens'>Kids &amp; Teens</option>
<option value='y:1415:News'>News</option>
<option value='y:2822:Professional'>Professional</option>
<option value='y:3:Real Estate'>Real Estate</option>
<option value='y:1275:Recreation'>Recreation</option>
<option value='y:1438:Reference'>Reference</option>
";
		$display_blockmp .= '</select><br>

		      <div class="txtHint1" id="txtHint1" name="txtHint1"><b>More Subcategories Available After Selection.</b></div>
					  <div class="txtHint2" id="txtHint2" name="txtHint2"><b></b></div>
					   <div class="txtHint3" id="txtHint3" name="txtHint3"><b></b></div>
					    <div class="txtHint4" id="txtHint4" name="txtHint4"><b></b></div>
		<p id="goLink" name="goLink"><b></b></p>
		<input type="reset" onclick="deleteAllLevels(2)" class="button standard" value="Clear"><div width: 250px;style="font-size: larger; font-weight:stronger;">Your Current Selection *: <input style="font-size: larger; font-weight:stronger;width: 250px;" type="text" id="category_name"  class="category_name" name="category_named" value="">
		<input type="hidden" id="category_id" name="category_id" class ="category_id" value="" readonly>';
		
		    }
    curl_close($ch);





if( array_key_exists('gocat', $_GET) AND ISSET($_GET['gocat'])){
//NOTE category id comes in from main menu
$category_id = $_GET['gocat'];
unset($_GET['gocat']);
unset($_POST['q']);
}





//END Category AJAX
//Begin Location AJAX
$args2 = array(
'regional_num' => $regional_num,
'link_record_num' => $link_record_num,
'link_page_total' => $link_page_total, 
'link_page_id' => $link_page_id, 
'pagem_url_cat' => $pagem_url_cat,
'link_page_num' => $link_page_num, 
'cat_page_num' => $cat_page_num, 
'category_id' => $category_id, 
'lnk_num' => $lnk_num,
'http_host' =>   $_SERVER['HTTP_HOST']
);

$url2 = "http://".AGENT_URL."/".AGENT_FOLDERNAME."/mannanetwork-dir/get_regions_json.php";


    $ch = curl_init();   
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_URL, $url2); 
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);          
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 50); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $args2); 
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
//  curl_setopt($ch, CURLOPT_PORT, $port);          

    $jsonregionList = curl_exec($ch);
    $curl_errno = curl_errno($ch);
    $curl_error = curl_error($ch);
		    if ($curl_errno > 0) {
			    echo "line 256 cURL Error ($curl_errno): $curl_error\n";
		    } else {
		//echo '<h2>Select Regional Filters?</h2>';
		$display_blockmp .= '<BR><BR>'.WORDING_REGIONAL_REG_LABEL;
		$regionList = json_decode($jsonregionList, true);
//we need to convert this showSubLoc1 to include these vars (to match the function in mn_ajax.js) and make it operate like the one in register form (at least in this regions form). Vars to add are str, main_cat_nonce,currentLevel,cat_id,type {main_cat_nonce can be empty because is only used in WP) . The mn_ajax.js uses the old function. If we change the function to the new one the catageory menu should still work (because it uses the old cat function) and we can deperecate the rest of the getsubloc functions and pages
/*$display_blockmp .= '<select name="regional_num" onchange=" showSubLoc1(this.value)"><option value="">'.WORDING_AJAX_REGIONAL_REG1.'</option> ';

			$display_blockmp .= "
		<option value='y:2566:Africa'>Africa</option>
		<option value='y:2567:America - Central'>America - Central</option>
		<option value='y:2568:America - North'>America - North</option>
		<option value='y:2569:America - South'>America - South</option>
		<option value='y:2572:Asia'>Asia</option>
		<option value='y:2573:Australia/Oceania'>Australia\/Oceania</option>
		<option value='y:2756:Caribbean'>Caribbean</option>
		<option value='y:2575:Europe'>Europe</option>
		<option value='y:2740:Middle East'>Middle East</option>";
	
		$display_blockmp .= '</select><br>
		      <div id="locHint1" name="locHint1"><b>Smaller Regions Available After Selection.</b></div>
					  <div id="locHint2" name="locHint2"><b></b></div>
					   <div id="locHint3" name="locHint3"><b></b></div>
					    <div id="locHint4" name="locHint4"><b></b></div>
		<div id="locHint5" name="locHint5"><b></b></div>
		<div id="locHint6" name="locHint6"><b></b></div>
		<p id="filterLink" name="filterLink"><b></b></p>
		<input type="reset" onclick="deleteAllLevels(2)" class="button standard" value="Clear"><div width: 250px;style="font-size: larger; font-weight:stronger;">Your Current Selection *: <input style="font-size: larger; font-weight:stronger;width: 250px;" type="text" id="regional_name"  class="regional_name" name="regional_named" value="">
		<input type="hidden" id="regional_num" name="regional_num" class ="regional_num" value="" readonly>
		</td><td>		';
*/
$display_blockmp .= '<span id="mn_location_container"> 
<!--<form action="">--> <table id="mn_location_table">
<tr><td><h2>'.REGISTRATION_REGIONAL_HEADING.'</h2><select name="regional" id="regional" onchange="
showSubMenu(this.value,\'' . esc_attr( $nonce ) . '\',1,\'' . esc_attr( $selected_cat_id ) . '\',\'regions\')"><option value="">'.WORDING_AJAX_REGIONAL_REG1.'</option>';
			$display_blockmp .= "
		<option value='y:2566:Africa'>Africa</option>
		<option value='y:2567:America - Central'>America - Central</option>
		<option value='y:2568:America - North'>America - North</option>
		<option value='y:2569:America - South'>America - South</option>
		<option value='y:2572:Asia'>Asia</option>
		<option value='y:2573:Australia/Oceania'>Australia\/Oceania</option>
		<option value='y:2756:Caribbean'>Caribbean</option>
		<option value='y:2575:Europe'>Europe</option>
		<option value='y:2740:Middle East'>Middle East</option>";
	
		$display_blockmp .= '</select>&nbsp;&nbsp;&nbsp;&nbsp;<span class="dropt" style="font-size: large;" title="'.REG_BLOKT_REGIONAL_MOUSEOVER.'"><img height="42" width="42" src="/wp-content/plugins/manna-network/images/green_arrow.png"><span style="width:500px;">'.REG_BLOKT_REGIONAL_MESSAGE.'</span></span><br>
		      <div id="locHint1" name="locHint1"><b>Smaller Regions Available After Selection.</b></div>
					  <div id="locHint2" name="locHint2"><b></b></div>
					   <div id="locHint3" name="locHint3"><b></b></div>
					    <div id="locHint4" name="locHint4"><b></b></div>
		<div id="locHint5" name="locHint5"><b></b></div>
		<div id="locHint6" name="locHint6"><b></b></div>
		<p id="selectedregion" name="selectedregion"><b></b></p>
<input type="hidden" id="selected_region_id" name="selected_region_id" class ="selected_region_id" value="">
<input type="hidden" id="selected_region_name" name="selected_region_name" class ="selected_region_name" value="">	<div width: 250px;style="font-size: larger; font-weight:stronger;">Your Current Selection *: <input style="font-size: larger; font-weight:stronger;width: 250px;" type="text" id="selected_region_menu_name"  class="selected_region_menu_name" name="selected_region_menu_name" value="">

		</td><td></table></span><div id="city_street_address" name="city_street_address" class="city_street_address"><b></b></div>';
		}
	if( array_key_exists('regional_num', $_GET) AND ISSET($_GET['regional_num'])){
	//NOTE category id comes in from main menu
	$regional_num = $_GET['regional_num'];
	unset($_GET['regional_num']);
	unset($_POST['regional_num']);
	}
//END Location AJAX
if(!array_key_exists("flag", $_GET) OR !isset($_GET['flag']) OR $_GET['flag'] !== "1"  ){
$display_blockmp .= ' <h1>'.WORDING_REGISTRATION_RECIPROCAL_HEADER.
WORDING_REGISTRATION_RECIPROCAL.' </div>';

   
}

$plugin_name = basename( plugin_dir_path(  dirname( __FILE__ , 2 ) ) );

$display_blockmp .= '
    <br>     
     <img src="tools/showCaptcha.php" alt="captcha" />

      <label>'.WORDING_REGISTRATION_CAPTCHA.'</label>
        <input type="text" name="captcha" required style="width: 150px;"/>
<!-- <input type="hidden" name="installer_id" value="'.$installer_id.'"> We don\'t want to give the form submitter the option to alter the installer id. We retrieve with $installer_id = get_option(\'installer_id\'); in the last operation after they confirm the data -->
        <input type="submit" name="register" value="'.WORDING_ADD_A_LINK.'" />
   </form>
  <a href="./index.php">'. WORDING_BACK_TO_LOGIN.'</a>
';
echo  $display_blockmp;
}
get_footer();
?>
