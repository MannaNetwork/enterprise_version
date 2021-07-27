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
//$category_id = 125;
//$tregional_num  = 0;

$linksList = getCombLinksAsJSON($category_id, $tregional_num);
if($linksList =="Sorry, No Links Found."){
echo "Sorry, No Links Found.";
}
else
{
//reminder - is already json encoded by the function
echo $linksList;
}
?>


