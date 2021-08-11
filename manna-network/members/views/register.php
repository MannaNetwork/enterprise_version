  <?php


//dev note: registrations come into this page from the WP plugins and php scripts (verify PHP) with the "CONFIRM" variable populated which tricks this form into sot displaying the registration form (because it is the origianl registration page) but instead treats the incoming POST as one submitted by the form itself and proceeds to process the data as a form submittal (i.e. it adds the remote user's registration to the enterprise's data base).

//dev notes: I couldn't get curl to work with the dvelopment server's SSL so have to run it as http on dev server. The var below is used to switch out of that functionality if curl is working with SSL
$curl_security = "http://";//Add an "s" to make curl use SSL

//this will look for the server/host name on agent's site in case they installed the widget without registering.
$precleaned_host = $_SERVER['HTTP_HOST'];
$cleaned_host = str_replace("www.", "", $precleaned_host);
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
get_header();
//submit button value - register

if(isset($_POST['confirm'])){
echo '<div style="width:700px; margin:auto;">';
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
}
echo '</div>';
}
elseif(isset($_POST['register'])){


unset($error_test);
$error_test = "";
echo '<div class="reg_form_page"><h1 align="center">Confirm Your Registration Details For Accuracy</h1>
 <div class="reg_form_content">
<form class = "frms" method="POST" action="" name="registerform">';

	foreach($_POST as $key=>$value){
if(!in_array($key, $dont_show_array, TRUE) && !empty($value)){

	echo '<input type="hidden" name="'.$key.'" value="'.$value.'"><br>', $key;
	echo '       = ', $value;
if($key == "recruiter_lnk_num"){
if($value == ""){
echo '&nbsp;&nbsp;<h4 style="color:red;">&nbsp;&nbsp;'.$key.'&nbsp;&nbsp;'.REGISTRATION_GENERAL_ERROR1.REGISTRATION_LNK_NUM1.REGISTRATION_GENERAL_ERROR2.$value.'</h4>';
$error_test = 'failed';
echo '<br> recruiter link number is empty = '.$key;
}
if(!is_numeric($value)){
echo '&nbsp;&nbsp;<h4 style="color:red;">&nbsp;&nbsp;'.$key.'&nbsp;&nbsp;'.REGISTRATION_GENERAL_ERROR1.REGISTRATION_LNK_NUM2.REGISTRATION_GENERAL_ERROR2.$value.'</h4>';
$error_test = 'failed';
} 
}

if($key == "user_email"){
if($value==""){
echo '<h3 style="color:red;">You must supply your email</h3>';
$error_test = 'failed';
}
else
{
if (!filter_var($value, FILTER_VALIDATE_EMAIL)){
  
  echo '<h3 style="color:red;">'.$value.' is not a valid email address format';
$error_test = 'failed';
}
}
}
if($key == "user_password_new"){
if($_POST['user_password_repeat'] !== $_POST['user_password_new']){
echo '<h3 style="color:red;">Passwords don\'t  match</h3>';
$error_test = 'failed';
}
if(empty($_POST['user_password_new']))
{
echo "<h3 style='color:red;'>You must supply a password in both locations</h3>";
$error_test = 'failed';
}
$user_password_new_subject = $value;
$user_password_new_pattern = '/^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).*$/';
preg_match($user_password_new_pattern, $user_password_new_subject, $user_password_new_matches);

if(!preg_match($user_password_new_pattern, $user_password_new_subject, $user_password_new_matches)){
echo "<h3 style='color:red;'>Password must be at least 8 characters and contain at least one of each of the following: Capitalized letter,  lower cased letter, number, special character</h3>";
$error_test = 'failed';
}
} 
if($key == "user_password_repeat"){
if($_POST['user_password_repeat'] !== $_POST['user_password_new']){
echo '<h3 style=\'color:red;\'>Passwords don\'t  match</h3>';
$error_test = 'failed';
}
if(empty($_POST['user_password_repeat']))
{
echo "<h3 style='color:red;'>You must supply a password in both locations</h3>";
$error_test = 'failed';
echo '<br> error key = '.$key;
}
$user_password_repeat_subject = $value;
//$user_password_repeat_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,15}$/';
  $user_password_repeat_pattern = '/^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).*$/';
preg_match($user_password_repeat_pattern, $user_password_repeat_subject, $user_password_repeat_matches);


//if(!$user_password_repeat_matches[0]){
if(!preg_match($user_password_repeat_pattern, $user_password_repeat_subject, $user_password_repeat_matches)){

echo "<h3 style='color:red;'>Password must be at least 8 characters and contain at least one of each of the following: Capitalized letter,  lower cased letter, number, special character</h3>";
// echo '&nbsp;&nbsp;<h4 style="color:red;">&nbsp;&nbsp;'. $message.'</h4>';
$error_test = 'failed';
}
} 
if($key == "website_title"){
if(empty($_POST['website_title']))
{
echo "<h3 style='color:red;'>You must supply a title for your ad listing</h3>";
$error_test = 'failed';
}
$website_title_subject = $value;
$website_title_pattern = '/^[a-zA-Z0-9 ]*/';

preg_match($website_title_pattern, $website_title_subject, $website_title_matches);

if(!$website_title_matches[0]){
echo "<h3 style='color:red;'>Only alphabet characters, numbers and white space allowed</h3>";
$error_test = 'failed';
}
}

if($key == "website_description"){
if(empty($_POST['website_description']))
{
echo "<h3 style='color:red;'>You must supply a description for you ad listing</h3>";
$error_test = 'failed';
}
$website_description_subject = $value;
$website_description_pattern = '/^[a-zA-Z0-9 ]*/';

preg_match($website_description_pattern, $website_description_subject, $website_description_matches);
if(!$website_description_matches[0]){
echo "<h3 style='color:red;'>Only alphabets, numbers and white space allowed</h3>";
$error_test = 'failed';
}
} 
if($key == "website_url"){
if (!filter_var($value, FILTER_VALIDATE_URL)) {
       echo("<h3 style='color:red;'>$value is not a valid URL</h3>");
$error_test = 'failed';
}
} 
if($key == "selected_cat_id"){
if(empty($_POST['selected_cat_id']))
{
echo "<h3 style='color:red;'>You must select a category for your  ad listing</h3>";
$error_test = 'failed';
}
else
{
echo '<input type="hidden" name="selected_cat_id" value="'.$_POST['selected_cat_id'].'">';

}
} 


if($key == "selected_region_id"){
if(!empty($_POST['selected_region_id']))
{
echo '<input type="hidden" name="selected_region_id" value="'.$_POST['selected_region_id'].'">';
}
} 
}
}
if($error_test == 'failed'){
echo '<h2 style="color:red;">Errors were detected! Please use the browser back button, correct the errors and resubmit the form. </h2>';
}
else
{
echo '<p><input type="submit" name="confirm" value="CONFIRM" />';
}
echo '   </form></div></div>';
}
else
{

require_once(dirname( __FILE__, 4 )."/manna-configs/db_cfg/agent_config.php");
require_once(dirname( __FILE__, 3 )."/members/translations/en.js");
if (!defined('REGISTRATION_CATEGORY_HEADING')) {
require_once(dirname( __FILE__, 3 )."/members/translations/en.php");
}

include(dirname( __FILE__, 5 ))."/wp-content/plugins/manna-network/endorsements/views/include_form.php";

   
   $display_blockmp .= '
  <a href="./index.php">'. WORDING_BACK_TO_LOGIN.'</a></div>
';
echo  $display_blockmp;
}
include(dirname( __FILE__, 3 )."/members/js/registration.js");
echo '<style>
span.dropt {border-bottom: thin dotted; background: #ffeedd;}
span.dropt:hover {text-decoration: none; background: #ffffff; z-index: 6; }
span.dropt span {position: absolute; left: -9999px;
  margin: 20px 0 0 0px; padding: 3px 3px 3px 3px;
  border-style:solid; border-color:black; border-width:1px; z-index: 6;}
span.dropt:hover span {left: 2%; background: #ffffff;} 
span.dropt span {position: absolute; left: -9999px;
  margin: 4px 0 0 0px; padding: 3px 3px 3px 3px; 
  border-style:solid; border-color:black; border-width:1px;}
span.dropt:hover span {margin: 20px 0 0 170px; background: #ffffff; z-index:6;} 
</style>';

get_footer();

?>

