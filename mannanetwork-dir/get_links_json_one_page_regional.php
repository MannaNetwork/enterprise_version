<?php 
require(dirname( __FILE__, 1 ). "/functions/functions.php");

if (array_key_exists("category_id",$_POST))
  {
$category_id  = $_POST['category_id'];
  }
  elseif (array_key_exists("category_id",$_GET))
  {
$category_id  = $_GET['category_id'];
  }
if (array_key_exists("tregional_num",$_POST))
  {
$tregional_num  = $_POST['tregional_num'];
  }
$lftRgtOfSelectedRegion = lftRgtRegion($tregional_num);
$lftRgtOfSelectedRegion=json_decode($lftRgtOfSelectedRegion,TRUE);
//returns something like "2568","128","15249"
$findLftGreaterThan = $lftRgtOfSelectedRegion[1];
$findRgtLessThan = $lftRgtOfSelectedRegion[2];
$locationArray = getRegionTree($findLftGreaterThan,$findRgtLessThan);
$getLinksInLocationArray = json_decode($locationArray,TRUE);
$grossLinksList_2 = getLinksInRegionAsJSON($category_id); //returns all links in cat that have location_id
$grossLinksList_2 = json_decode($grossLinksList_2,TRUE);
$linksList_2=array();
foreach($grossLinksList_2 as $key=>$value){
//returns  [name] [description] [url] [location_id]
	if(in_array($grossLinksList_2[$key]['location_id'], $getLinksInLocationArray)){
	   array_push($linksList_2, $grossLinksList_2[$key]);
	}
}

$linksList_2 = json_encode($linksList_2, true);

echo $linksList_2;
 
?>


