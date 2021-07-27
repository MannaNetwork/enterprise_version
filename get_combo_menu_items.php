<?php 
require(dirname( __FILE__, 1 ). "/functions/functions.php");

if (array_key_exists("dbID",$_POST))
  {
$dbID  = $_POST['dbID'];
  }
if (array_key_exists("menuType",$_POST))
  {
$menuType  = $_POST['menuType'];
  }
/*
//test data
$dbID = 111;
$menuType = 'categories';
*/
if(isset($dbID) && $dbID > 0 && $dbID !=""){

$menuList = getMenuForAJAX($dbID,$menuType);
//note the function returns a json encoded string so we can just echo it and no encoding is needed
echo $menuList;
}

?>
