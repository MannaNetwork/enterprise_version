<?php
$numGlobalCompetitors = $linkInfo->getCountGlobalPriceSlots($cat_id, $coin_type, $price_slot);
if(!is_numeric($numGlobalCompetitors)){
$numGlobalCompetitors = 0;
}
if(isset($currentPS) && $currentPS ==1){
$numGlobalCompetitors = $numGlobalCompetitors-1;
}
if(isset($location_id) AND $location_id > 0){
//first, get the buyer's tree - an array of the upline of the buyer's selected region";
$buyers_tree = $linkInfo->getRegionsSubTree($location_id);
$numLevelsBuyerTree = count($buyers_tree[0]); //used in foreach
//Then, we get all the paying links that also have a location_id. NOTE-we retrieve anything with a location_id > 0 and is in this category
$regionalPaidLinksList = $linkInfo->getPaidRegionalLinksByCatId($cat_id, $coin_type);
//returns array($paid_loc_link_id, $location_id, $price_slot); OR "No Results"
$region_display_block = "";//reset
foreach($regionalPaidLinksList[0] as $key=>$value){
	$regionalPaidLinksList[2][$key] = str_replace('000.','0.',$regionalPaidLinksList[2][$key]);
	$links_regions_array = $linkInfo->getRegionsSubTree($regionalPaidLinksList[1][$key]);
	//for each ad/link, the function returns something like Array ( [0] => Array ( [0] => 1 [1] => 2568 [2] => 2732 ) [1] => Array ( [0] => 0 [1] => 1 [2] => 2568 ) [2] => Array ( [0] => Main [1] => America - North [2] => United States ) [3] => Array ( [0] => 1 [1] => 128 [2] => 919 ) [4] => Array ( [0] => 18136 [1] => 15249 [2] => 15248 ) ) 
	if($regionalPaidLinksList[2][$key] >= $price_slot){
		for($complevs=1;$complevs<=$numLevelsBuyerTree-1;$complevs++){
			if (array_key_exists($complevs, $links_regions_array[0]) AND $buyers_tree[0][$complevs] == $links_regions_array[0][$complevs]){
		$competingBids[$complevs] = $competingBids[$complevs] +1;
			}
		}
	}
}
//we only count competitors IF they are in the same level(s) as the buyer (by using $numLevelsBuyerTree). 
for($lev=1;$lev<=$numLevelsBuyerTree-1;$lev++){
//add st, nd, rd or th to the number version of rank report
	 $readablecounterByLevel = $linkInfo->ordinal($competingBids[$lev]+1);
	switch ($lev) {
	  case 1:
	  //for the few instances where north, south, central are placed behind America, we'll switch them (for readability)
	  $pos = strpos($buyers_tree[2][$lev], " - ");
		if ($pos !== false) {
		$temp_name = explode("-", $buyers_tree[2][$lev]);
		$buyers_tree[2][$lev] = $temp_name[1]."-".$temp_name[0];
		}
	   $region_display_block .= '<br><b>'.$buyers_tree[2][$lev].' Competitors: '. $competingBids[$lev].'</b>';
	   $region_display_block .= '<br>&nbsp;&nbsp;&nbsp;<u>Tentative Rank In '.$buyers_tree[2][$lev].': '. $readablecounterByLevel.'</u>';
	    break;
	  case 2:
	  $region_display_block .= '<br><b>'.$buyers_tree[2][$lev].' Competitors: '. $competingBids[$lev].'</b>';
	  $region_display_block .= '<br>&nbsp;&nbsp;&nbsp;<u>Tentative Rank In '.$buyers_tree[2][$lev].': '. $readablecounterByLevel.'</u>';
	    break;
	  case 3:
	   $region_display_block .= '<br><b>'.$buyers_tree[2][$lev].' Competitors: '. $competingBids[$lev].'</b>';
	   $region_display_block .= '<br>&nbsp;&nbsp;&nbsp;<u>Tentative Rank In '.$buyers_tree[2][$lev].': '. $readablecounterByLevel.'</u>';
	    break;
	    case 4:
	   $region_display_block .= '<br><b>'.$buyers_tree[2][$lev].' Competitors: '. $competingBids[$lev].'</b>';
	   $region_display_block .= '<br>&nbsp;&nbsp;&nbsp;<u>Tentative Rank In '.$buyers_tree[2][$lev].': '. $readablecounterByLevel.'</u>';
	    break;
	  default:
	    echo "<br>Global Competitors<br>Run the regular function w/o location_id";
	} 
}//close for loop
//add the global competitors at top of regional list - hopefully it will show when advertiser doesn't have any location ID
$readablecounterGlobal = $linkInfo->ordinal($numGlobalCompetitors+1);
$steps_display .= '<br>Global Competitors: '.$numGlobalCompetitors.'</b>';
$steps_display .= '<br>&nbsp;&nbsp;&nbsp;<u>Tentative Rank At Global Level: '. $readablecounterGlobal.'</u>';
$steps_display .= $region_display_block.'</span>'; 
}
else
{
$readablecounterGlobal = $linkInfo->ordinal($numGlobalCompetitors+1);
$steps_display .= '<br>Global Competitors: '.$numGlobalCompetitors.'</b>';
$steps_display .= '<br>&nbsp;&nbsp;&nbsp;<u>Tentative Rank At Global Level: '. $readablecounterGlobal.'</u>';
$steps_display .= '</span>'; 
}
?>
