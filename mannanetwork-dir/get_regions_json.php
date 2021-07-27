<?php 
require(dirname( __FILE__, 1 ). "/functions/functions.php");
if (array_key_exists("tregional_num",$_POST))
  {
$regional_num  = $_POST['tregional_num'];
  }

if(isset($regional_num)){

//$regionList = getRegionsForAJAX($regional_num);
$regionList = getMenuForAJAX($regional_num,'regions');

echo $regionList;
}

?>
