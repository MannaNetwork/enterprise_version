<?php 
//echo '<br>THIS IS NOT IN PLUGINS! It is in dir - in plugin getLinksAllInOne.php POST = ';
//print_r($_POST); //rename to getLinksAllInOne.php
require(dirname( __FILE__, 1 ). "/functions/functions.php");

if (array_key_exists("category_id",$_POST) AND is_numeric($_POST['category_id']))
  {
   $category_id  = $_POST['category_id'];
  }

if (array_key_exists("page_num",$_POST) AND is_numeric($_POST['page_num']))
  {
   $page_num  = $_POST['page_num'];
  }
else
{
   $page_num  = 1;
}
if (array_key_exists("number_of_pages",$_POST) AND is_numeric($_POST['number_of_pages']))
  {
   $number_of_pages  = $_POST['number_of_pages'];
  }
else
{
   $number_of_pages = 1;
}
if (array_key_exists("number_of_links",$_POST) AND is_numeric($_POST['number_of_links']))
  {
   $number_of_links  = $_POST['number_of_links'];
  }
else
{
   $number_of_links = 0;
}
if (array_key_exists("tregional_num",$_POST) AND is_numeric($_POST['tregional_num']))
  {
   $tregional_num  = $_POST['tregional_num'];
  }
else
{
   $tregional_num  = 0;
}
if (array_key_exists("lft",$_POST) AND is_numeric($_POST['lft']))
  {
   $lft  = $_POST['lft'];
  }
else
{
   $lft = 0;
}
if (array_key_exists("rgt",$_POST) AND is_numeric($_POST['rgt']))
  {
   $rgt  = $_POST['rgt'];
  }
else
{
   $rgt = 0;
}

$linksList_2 = getLinksAllInOne($category_id, $page_num, $number_of_pages, $number_of_links, $tregional_num, $lft, $rgt);
if($linksList_2 =="Sorry, No Links Found."){
echo "Sorry, No Links Found.";
}
else
{
//reminder - is already json encoded by the function
echo $linksList_2;
}
?>
