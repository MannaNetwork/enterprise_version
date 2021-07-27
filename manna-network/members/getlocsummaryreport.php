<!--
<!DOCTYPE html>
<html>
<head>

</head>
<body>
-->
<?php
require_once('translations/en.php');
include('classes/members_class.php');
$members_info = new members_info;
$demo_coin_allotments = $members_info->getCoinMarketCap(5);
$q = $_GET['q'];
$numRowsBCHPaid = $members_info->getNumRowsBCHPaid($q);
$numRowsDemoPaid = $members_info->getNumRowsDemoPaid($q);

if($numRowsDemoPaid > 0){
$getLowestDemoPriceSlotPaid = round($members_info->getLowestDemoPriceSlotPaid($q),8);
$getHighestDemoPriceSlotPaid = round($members_info->getHighestDemoPriceSlotPaid($q),8);
$unboughtDemoHighest = $getHighestDemoPriceSlotPaid + ($getHighestDemoPriceSlotPaid*.5);
}
else
{
$getLowestDemoPriceSlotPaid = 0;
$getHighestDemoPriceSlotPaid = 0;
$unboughtDemoHighest = round($demo_coin_allotments[0],8);;
}
if($numRowsBCHPaid > 0){
$getHighestBCHPriceSlotPaid = round($members_info->getHighestBCHPriceSlotPaid($q),8);
$unboughtBCHHighest = $getHighestBCHPriceSlotPaid + ($getHighestBCHPriceSlotPaid*.5);
$getLowestBCHPriceSlotPaid = round($members_info->getLowestBCHPriceSlotPaid($q),8);
}
else
{
$getHighestBCHPriceSlotPaid = 0;
$unboughtBCHHighest = round($demo_coin_allotments[0],8);;
$getLowestBCHPriceSlotPaid =  0;
}

if(!defined('READER_AGENTS')){ 
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/mysqli_connect.php");
if (!$mysqli) {
    die('Could not connect: ' . mysqli_error($mysqli));
}

$demo_coin_allotments = $members_info->getCoinMarketCap(5);
//$parsed_q = explode(":",$q);
$sql="SELECT * FROM links WHERE category = '".$q."'";
$result = mysqli_query($mysqli,$sql);
//get the num rows
$link_cnt_free = $result->num_rows;
$page_count = ceil($link_cnt_free/20);
$free_link_position = $link_cnt_free % 20;
$menu_str = SUMMARY_AJAX_HEADER.SUMMARY_AJAX_FREE_PAGE_COUNT1.$page_count.SUMMARY_AJAX_FREE_PAGE_COUNT2.$free_link_position.SUMMARY_AJAX_FREE_PAGE_COUNT3.SUMMARY_AJAX_NUM_LINKS.$link_cnt_free;

//echo $menu_str;
$sql="SELECT * FROM price_slots_subscripts where cat_id = '$q' AND subscribe = 1";
$result = mysqli_query($mysqli,$sql);
//get the num rows
$link_cnt_demo = $result->num_rows;

$sql="SELECT * FROM price_slots_subscripts where cat_id = '".$q."' AND subscribe = 2";
$result = mysqli_query($mysqli,$sql);
//get the num rows
$link_cnt_btc = $result->num_rows;
$page_count_btc= $link_cnt_btc/20;


$menu_str .= SUMMARY_AJAX_MIN_DEMO_BID1.round($demo_coin_allotments[1],8). SUMMARY_AJAX_MIN_DEMO_BID2.round($demo_coin_allotments[0],8). SUMMARY_AJAX_MIN_BCH_BID3.SUMMARY_AJAX_MIN_BCH_BID4.$getHighestDemoPriceSlotPaid.SUMMARY_AJAX_MIN_BCH_BID5.$unboughtDemoHighest.SUMMARY_AJAX_MIN_BCH_BID6.$getHighestBCHPriceSlotPaid.SUMMARY_AJAX_MIN_BCH_BID7.$unboughtBCHHighest.SUMMARY_AJAX_MIN_BCH_BID8;

$menu_str .= MORE_INFO_PAGE.'<a style="color:blue; text-decoration:underline;" target="_blank" href="more_info.php?catid='.$q.'">Click Here</a></div>';
echo $menu_str;

?><!--
</body>
</html> -->
