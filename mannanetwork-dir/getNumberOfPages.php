<?php 
require(dirname( __FILE__, 1 ). "/functions/functions.php");

if (array_key_exists("category_id",$_POST))
  {

$category_id  = $_POST['category_id'];
  }
$numberofpages = getNumberOfPages($category_id);

if($numberofpages =="Sorry, No Links Found."){
echo "Sorry, No Links Found.";
}
else
{
echo $numberofpages;
}

?>
