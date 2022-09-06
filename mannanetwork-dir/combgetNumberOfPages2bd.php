<?php 
 
require(dirname( __FILE__, 1 ). "/functions/functions.php");

if (array_key_exists("category_id",$_POST))
  {

$category_id  = $_POST['category_id'];
  }

$number_of_pages = combgetNumberOfPages($category_id);
if($number_of_pages =="0" || $number_of_pages ==0){
echo json_encode("Sorry, No Links Found.");
}
else
{
echo json_encode($number_of_pages);
}

?>
