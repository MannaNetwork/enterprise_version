<?php 
require(dirname( __FILE__, 1 ). "/functions/functions.php");

if (array_key_exists("category_id",$_POST))
  {

$category_id  = $_POST['category_id'];
  }

if (array_key_exists("link_page_num",$_POST))
  {
$page_num  = $_POST['link_page_num'];
  }
else
{
$page_num  = 1;
}
if (array_key_exists("tregional_num",$_POST))
  {
$tregional_num  = $_POST['tregional_num'];
  }
else
{
$tregional_num  = 1;
}
//since this is loading the NON AJAX results page it is always 1 so the POST page_num is redundant
$linksList_2 = getLinksAsJSONbyPageNumReg($category_id, $page_num, $tregional_num);

if($linksList_2 =="Sorry, No Links Found."){
echo "Sorry, No Links Found.";
}
else
{
//reminder - is already json encoded by the function
echo $linksList_2;
}
?>
