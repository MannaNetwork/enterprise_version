<?php 
require(dirname( __FILE__, 1 ). "/functions/functions.php");
//echo '<br>in plugin comget_links_json_first_page.php POST = ';
//print_r($_POST);
if (array_key_exists("category_id",$_POST))
  {

$category_id  = $_POST['category_id'];
  }

if (array_key_exists("page_num",$_POST))
  {
$page_num  = $_POST['page_num'];
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
$tregional_num  = 0;
}
//since this is loading the NON AJAX results page it is always 1 so the POST page_num is redundant
$linksList_2 = combgetLinksAsJSONbyPageNumReg($category_id, $page_num, $tregional_num);

if($linksList_2 =="Sorry, No Links Found."){
echo "Sorry, No Links Found.";
}
else
{
//reminder - is already json encoded by the function
echo $linksList_2;
}
?>
