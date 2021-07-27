<?php 
require(dirname( __FILE__, 1 ). "/functions/functions.php");

if (array_key_exists("url",$_POST))
  {

$url = $_POST['url'];
  }
$numberofpages = checkIfRegistered($url);

if($numberofpages =="Sorry, No Links Found."){
echo "Sorry, No Links Found.";
}
else
{
echo '<br> in check if egisteed', $numberofpages;
}

?>
