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
$lftRgtOfSelectedRegion = lftRgtRegion($tregional_num);
$lftRgtOfSelectedRegion=json_decode($lftRgtOfSelectedRegion,TRUE);
//returns something like "2568","128","15249"
$findLftGreaterThan = $lftRgtOfSelectedRegion[1];
$findRgtLessThan = $lftRgtOfSelectedRegion[2];
$locationArray = getRegionTree($findLftGreaterThan,$findRgtLessThan);
//echo '<br>in getNumberOfPagesRegional getRegionTree function returns json string'; 

$getLinksInLocationArray = json_decode($locationArray,TRUE);

//echo '<br>________________print_r($getLinksInLocationArray)____________________<br>';
//print_r($getLinksInLocationArray);
//echo '<br>____________________________________<br>';
$grossLinksList = getLinksInRegionAsJSON($category_id); //returns all links in cat that have location_id
$grossLinksList2 = json_decode($grossLinksList,TRUE);

//echo '<br>count of $grossLinksList2 = '.count($grossLinksList2);
$counter=0;
foreach($grossLinksList2 as $key=>$value){
//echo '<br>in foreach - key = '. $key.'    value = '.$value;
//echo '<br>$grossLinksList2[$key][\'location_id\'] = '.$grossLinksList2[$key]['location_id'];
	if(in_array($grossLinksList2[$key]['location_id'], $getLinksInLocationArray)){
	//echo '<br>in fi in_array - $grossLinksList2[$key][\'location_id\'] ('.$grossLinksList2[$key]['location_id'].') is in the $getLinksInLocationArray (echoed above). The counter value before incrementing is '.$counter;
	$counter++;
	//echo '<br>The counter value after incrementing is '.$counter;
	}
}

if($counter > 20){
	//begin pagination condition
	//$number_of_pages for use by the paginator
	$number_of_pages =ceil($counter/20);
}
elseif($counter > 0){
//echo '<br>in elseif($counter > 0)';
	$number_of_pages =1;
}
else
{
$number_of_pages =0;
}



echo $number_of_pages;

?>
