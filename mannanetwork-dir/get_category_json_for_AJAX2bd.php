<?php 
require(dirname( __FILE__, 1 ). "/functions/functions.php");

if (array_key_exists("category_id",$_POST))
  {
$category_id  = $_POST['category_id'];
  }
echo '<br>in get categoy fo json $category_id = ', $category_id;
if(isset($category_id) && $category_id > 0 && $category_id !=""){

$catList = getCategoryChildrenForAJAX($category_id);
//now gets returned json encoded
//echo json_encode($catList);
echo $catList;
}

?>
