<?php
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
get_header();
// include the configs
require_once("config/config.php");


$user_id = $_SESSION['user_id'];



$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 
//include('_header.php');
//the following is candidate for deprecation
require_once(dirname( __FILE__, 2 )."/translations/en/add_url.js");
require_once(dirname( __FILE__, 2 )."/translations/en.php");
include(dirname(__DIR__, 3)."/manna-configs/db_cfg/agent_config.php");
include(dirname(__DIR__, 3)."/manna-network/members/css/members_menu.css");
include(dirname(__DIR__, 3)."/mannanetwork-dir/functions/functions.php");
include(dirname(__DIR__, 3)."/manna-network/members/js/mn_ajax.js");
include(dirname(__DIR__, 3)."/manna-network/members/css/members_menu.css");
include(dirname(__DIR__, 3)."/manna-network/members/functions/add_a_link.php");
include(dirname(__DIR__, 3)."/manna-network/members/functions/sanitize.php");

if(isset($_POST['confirm'])){
//link to script - https://www.phptutorial.net/php-tutorial/php-sanitize-input/
if($debug==2){
echo '<br>in confirm section POST = <br>';
print_r($_POST);
}
/*
Dev Note: Should we query manna network FIRST 

*/
//we need to check if these are in POST before we process. Out of them, they are all strings except selected_region_id so can be added to the alt_sanitize_array if they have data
$check_key_array = array('user_registration_datetime', 'page_name', 'selected_region_id', 'website_street', 'map_link', 'catkeys', 'lockeys');

$alt_sanitize_array = array('website_title', 'website_description', 'protocol');

foreach($check_key_array as $key){
	if(!array_key_exists($key,$_POST) AND !isset($_POST[$key])){
	$var_name = $key;
$$var_name = "a string";
echo '<br>$var_name = ', $var_name;

$$key = 'new_value';
echo "<br>the variable variable named $key = ${$key}";
echo '<br>the variable variable named '.$key.' now has a value of '.$$key;

	}
	else
	{
echo '<br>the key '.$key.' does not exist in POST';
	}
}
/* we can't send empty variables to manna network */
/* deprecated that sanitizing script - too many issues. For example, FILTER_SANITIZE_STRING is deprecated. 
All the discussions say prepared statements protect everything anyway - the sanitizing script was over kill
$inputs = [
'user_id' => $user_id, 
'user_registration_datetime' => $_POST['user_registration_datetime'],
'website_title' => $_POST['website_title'],
'website_description' => $_POST['website_description'],
'protocol' => $_POST['protocol'],
'website_url' => $_POST['website_url'],
'page_name' => $_POST['page_name'],
'category_id' => $_POST['selected_cat_id'],   
'location_id' => $_POST['selected_region_id'],
'website_street' => $_POST['website_street'],
'map_link' => $_POST['map_link'],
'installer_id' => $_POST['installer_id'],
'catkeys' => $_POST['catkeys'],
'lockeys' => $_POST['lockeys']
];
$fields = [
'user_id' => 'int', 
'user_registration_datetime' => 'int',
'website_title' => 'string',
'website_description' => 'string',
'protocol' => 'string',
'website_url' => 'url',
'page_name' => 'string',
'category_id' => 'int',   
'location_id' => 'int',
'website_street' => 'string',
'map_link' => 'url',
'installer_id' => 'int',
'catkeys' => 'string',
'lockeys' => 'string'
];

$data = sanitize($inputs,$fields);
if($debug==2){
echo '<h2>printr data = ';
print_r($data);
echo '</h2><br>';
}
$user_id = $data['user_id'];
$user_registration_datetime = $data['user_registration_datetime'];
$website_title = $data['website_title'];
$website_description = $data['website_description'];
$protocol = $data['protocol'];
$website_url = $data['website_url'];
$page_name = $data['page_name'];
$category_id = $data['category_id'];  
$location_id = $data['location_id'];
$website_street = $data['website_street'];
$map_link = $data['map_link'];
$installer_id = $data['installer_id'];
$catkeys = $data['catkeys'];
$lockeys = $data['lockeys'];
*/
//new sanitizing code

echo  '<br>user_id = ',$user_id;
echo  '<br>user_registration_datetime = ',$user_registration_datetime;
echo  '<br>website_title = ',$website_title;
echo  '<br>website_description = ',$website_description;
echo  '<br>protocol = ',$protocol;
echo  '<br>website_url = ',$website_url;
echo  '<br>page_name = ',$page_name;
echo  '<br>category_id = ',$category_id;  
echo  '<br>location_id = ',$location_id;
echo  '<br>website_street = ',$website_street;
echo  '<br>map_link = ',$map_link;
echo  '<br>installer_id = ',$installer_id;
echo  '<br>$catkeys = ', $catkeys;
echo  '<br> $lockeys = ', $lockeys;

//this is in functions/add_a_link.php
$commit1 = insertCustomerLink($user_id, $user_registration_datetime, $website_title, $website_description, $protocol, $website_url, $page_name, $category_id,  $location_id, $website_street, $map_link, $installer_id, $catkeys, $lockeys);
if($debug==2){
echo '<br>customer link id of this new ad (on agent\'s site) = ', $commit1;
echo '<br>Now we need to do a curl to manna\'s add a link page (i.e. a new copy of register that needs to be created)';
}
$args = array(
'remote_user_id'  => $user_id,
'user_registration_datetime'  => $user_registration_datetime,
'remote_link_id' => $commit1,
'remote_user_id' => $user_id,
'agent_id' => AGENT_ID,
'website_title'  => $website_title,
'website_description'  => $website_description,
'protocol'  => $protocol,
'website_url'  => $website_url,
'page_name'  => $page_name,
'category_id'  => $category_id,  
'location_id'  => $location_id,
'website_street'  => $website_street,
'map_link'  => $map_link,
'installer_id'  => $installer_id,
'catkeys'  => $catkeys, 
'lockeys'  => $lockeys

 );

 $url3 = "https://exchange.manna-network.com/incoming/add_a_link.php";

     $ch = curl_init();    // initialize curl handle
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_URL, $url3); 
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);          
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 50); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $args); 
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);

    $new_ad = curl_exec($ch);
    $curl_errno = curl_errno($ch);
    $curl_error = curl_error($ch);
 if ($curl_errno > 0) {
         echo "cURL Error ($curl_errno): $curl_error\n";
 } else { 
 echo '<br>curl new ad = ', $new_ad;
      if($new_ad == "New records created successfully"){
       echo '<h1 style="color:red;">There was an error submitting the new ad to the network. Please contact tech support. Thank you and sorry for any inconvenience.</h1>';
      }
      else
      {
      echo TEMP_ADDALINK_SUBMISSION1;
      }
 }

}
elseif(isset($_POST['register'])){
if($debug==2){
echo '<br>printr in register isset section post = <br>';
print_r($_POST);
}

$dont_show_array= array('captcha', 'register','cat_id', 'selected_cat_name', 'submenu','selected_region_name', 'regional','location_id', 'location_name');

echo '<div class="modalHeader"><h1 align="center">Confirm Your Registration Details For Accuracy</h1></div>
<div class="box content">
<form class = "frms" method="POST" action="" name="registerform">';

	foreach($_POST as $key=>$value){
	 if(!in_array($key, $dont_show_array, TRUE) && !empty($value)){
	      if($key=='page_name'){
	        if (strpos($value, 'Insert Your LANDING PAGE NAME HERE') === false) {
	         echo '<input type="hidden" name="'.$key.'" value="'.$value.'"><br>'. $key.'-> '.$value;
	            }
		   }
		 else
		 {
		  echo '<input type="hidden" name="'.$key.'" value="'.$value.'"><br>'. $key.'-> '.$value;
		 }
	   }
         }
    echo '<p><input type="submit" name="confirm" value="CONFIRM" /></form>';
}
else
{

include('_menu.php');

$display_blockmp = ADD_A_LINK_POLICY;
/*
$display_blockmp = '
       <div class="modalHeader"><h1 align="center">Thank You For Wanting To Add Your Link To Our Web Site & Link Directory!</h1></div>
            <p align="left">Our\'s is one of a network of many on individually owned and operated websites that co-operate together to advertise each other\'s websites and now your website will be advertised on our own site and the entire network as well! It\'s a better way for us to help even more people find your website than what just our own site could provide you by itself.</p>
        
<p  align="left">You will be provided more info about this great web directory so you can become part of this bigger effort to make your website successful!
</div> 
  <div class="box content">
'; */
include('_form.php');
//include('_footer.php');
}
get_footer();
?>
