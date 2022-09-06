<?php 
require(dirname( __FILE__, 1 ). "/functions/functions.php");

if (array_key_exists("category_id",$_POST))
  {

$category_id  = $_POST['category_id'];
  
  }
  elseif (array_key_exists("category_id",$_GET))
  {
//used for temp testing of main page - using test form 
$category_id  = $_GET['category_id'];
  
  }
if (array_key_exists("tregional_num",$_POST))
  {

$tregional_num  = $_POST['tregional_num'];
  }
 
$linksList_2 = getCombLinksAsJSON($category_id);


//reminder - is already json encoded by the function
echo $linksList_2;

?>


