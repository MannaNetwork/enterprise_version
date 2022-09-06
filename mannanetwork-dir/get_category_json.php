<?php 
require(dirname( __FILE__, 1 ). "/functions/functions.php");
//note: can use the above for troubleshooting but it will, itself, add unparsible data to the json string. ALWAYS remember to comment it out after debugging

if (array_key_exists("selected_cat_id",$_POST))
  {
$category_id  = $_POST['selected_cat_id'];
  }
if(isset($category_id) && $category_id > 0 && $category_id !=""){

//$catList = getCategoryChildren($category_id);
$catList = getMenuForAJAX($category_id,'categories');
//now gets returned json encoded
//echo json_encode($catList);
echo $catList;
}
else
{
echo $catList;
}
?>
