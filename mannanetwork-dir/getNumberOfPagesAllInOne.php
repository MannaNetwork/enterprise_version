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
  else
  {
 $tregional_num  = 0; 
  }
 
 if($tregional_num > 0){
  $lft_rgt = lftRgtRegion($tregional_num);
  $lft = $lft_rgt[1];
  $rgt= $lft_rgt[2];
  }
  else
 {
 $lft = 0;
 $rgt = 0;
 }
 
  $counter = getNumRowsAllInOne($category_id, $lft, $rgt);
  $count_of_counter = $counter; //note: used to store value because $counter gets changed during parsing
  	if($counter > 20){
	//$number_of_pages for use by the paginator
	$number_of_pages =ceil($counter/20);
	}
	elseif($counter > 0){
	$number_of_pages =1;
	}
	else
	{
	$number_of_pages =0;
	}
echo $number_of_pages.":".$lft.":".$rgt.":".$count_of_counter;
?>
