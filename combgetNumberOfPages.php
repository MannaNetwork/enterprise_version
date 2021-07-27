<?php 
 
require(dirname( __FILE__, 1 ). "/functions/functions.php");

if (array_key_exists("category_id",$_POST))
  {

$category_id  = $_POST['category_id'];
  }

if (array_key_exists("tregional_num",$_POST))
  {

$tregional_num  = $_POST['tregional_num'];
  }

$number_of_pages = combgetNumberOfPages($category_id, $tregional_num);
if($number_of_pages =="Sorry, No Links Found."){
echo "Sorry, No Links Found.";
}
else
{
echo $number_of_pages;
}

?>
