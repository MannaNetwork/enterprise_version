<?php 
require(dirname( __FILE__, 1 ). "/functions/functions.php");

if (array_key_exists("url",$_POST))
  {
$http_host = $_POST['http_host'];
  }
$numberofpages = resend_email_verification($http_host);

if($numberofpages =="Sorry, No Links Found."){
echo "Sorry, No Links Found.";
}
else
{
echo '<br> in check if email verified', $numberofpages;
}

?>
