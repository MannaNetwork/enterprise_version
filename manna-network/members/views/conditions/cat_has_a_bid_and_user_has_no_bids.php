<?php
if($debug=="2"){
echo '<br>in cat_has_a_bid_and_user_has_no_bids.php ';
echo '<p style="color:red;">You are seeing these coding messages because you have Debug turned on in /manna-configs/db_cfg/agent_config.php/</p><br>Post values from form = ';
print_r($_POST);
echo '<br>$isLinkApproved imorted from buy_price_slots.php = ', $isLinkApproved;
}
//Warning: include(translations/en/cat_has_a_bid_and_user_has_no_bids/common.php): failed to open stream: No such file or directory in /home/stbitcoi/public_html/manna_network/manna-network/members/views/conditions/cat_has_a_bid_and_user_has_no_bids.php on line 8
include('translations/en/cat_has_a_bid_and_user_has_no_bids/common.php');


$current_index_of_daily_minimum_bid_target = $linkInfo->get_current_index_of_daily_minimum_bid_target($daily_minimum_bid_target);
$index_of_current_highest_bid = $linkInfo->get_current_index_of_priceslot($highestpriceslot);
$index_of_current_lowest_bid = $linkInfo->get_current_index_of_priceslot($lowestpriceslot);
if($current_index_of_daily_minimum_bid_target >= $index_of_current_lowest_bid){
$index_of_lowest_to_display =$index_of_current_lowest_bid ;
}
else
{
$index_of_lowest_to_display =$current_index_of_daily_minimum_bid_target;
}

 $steps = $linkInfo->get_price_slots_by_minmaxindex($index_of_current_highest_bid, $index_of_lowest_to_display, $number_of_extra_price_slots);
$BSVpopulation = $linkInfo->get_cat_count_of_bids_approved($cat_id, "BSV");
$demo_coin_population = $linkInfo->get_cat_count_of_bids_approved($cat_id, "DMC");
if($debug=="2"){
echo '<br> $daily_minimum_bid_target = ', $daily_minimum_bid_target;
echo '<br> $current_index_of_daily_minimum_bid_target = ', $current_index_of_daily_minimum_bid_target;
echo '<br> $highestpriceslot = ', $highestpriceslot;
echo '<br> $index_of_current_highest_bid = ', $index_of_current_highest_bid;
echo '<br> $lowestpriceslot = ', $lowestpriceslot;
echo '<br> $index_of_current_lowest_bid = ', $index_of_current_lowest_bid;
echo '<br> $hi_low_string = ', $hi_low_string;
echo '<br>$index_of_lowest_to_display= ',  $index_of_lowest_to_display;
}
$steps_display ='<div style=" width: 80%;
  margin: 0 auto;"><table style="border-collapse: collapse; table-layout:fixed;" cellpadding="40"><tr><td colspan=4>';
$steps_display .= "<tr><td colspan=4><h3>". $welcome_message ."</h3></td></tr>";
if($isLinkApproved == "no"){
include('translations/en/not_reviewed.php');
$steps_display .= "<tr><td colspan=4><h3>". $pending_review_message ."</h3></td></tr>";
}

$steps_display .= "<tr><td colspan=2> <h3>".$crypto_coin_header.":".$data['USD'].'</h3>';
if($coin_type == "DMC"){
$steps_display .= '<h3>'.$crypto_coin_label." ".$population.": ".$BSVpopulation.'</h3>';
$steps_display.= '<span class="dropt" style="font-size: large;" title="'.$bsv_pop_mouseover.'">'.$bsv_pop_link_title.'<img height="42" width="42" src="views/green_arrow.png">
  <span style="width:500px;">'.$bsv_pop_blockt_message.'</span></span>';
}
$steps_display .= '</td><td  colspan=2>'. $volatility_modeler.'</td></tr>';

$steps = array_reverse($steps);
echo '<h1>steps = ';
print_r($steps);
echo '</h1>';
foreach($steps as $key=>$value){
echo '<br>steps key = '. $key.'    value = '. $value;
if($key == 0){
include('translations/en/cat_has_a_bid_and_user_has_no_bids/key0.php');
$modify_type = "<input type='hidden' name='modify_type' value='purchase'>";
	if($coin_type == "DMC"){
	$temp_DMCpopulation = 0;
	$temp_BSVpopulation = 0;
$tentative_rank =1;
	}
	else
	{
	$temp_DMCpopulation = 0;
	$temp_BSVpopulation = 0;
$tentative_rank =1;

	}

}
elseif($key == 1){
include('translations/en/cat_has_a_bid_and_user_has_no_bids/key1.php');
$modify_type = "<input type='hidden' name='modify_type' value='purchase'>";
	if($coin_type == "DMC"){
	$temp_DMCpopulation = 0;
	$temp_BSVpopulation = 0;
$tentative_rank =1;

	}
	else
	{
	$temp_DMCpopulation = 0;
	$temp_BSVpopulation = 0;
$tentative_rank =1;

	}
//
}
elseif($key == $index_of_lowest_to_display){
$temp_DMCpopulation = $linkInfo->getPricePopByCat($cat_id, number_format($value , 8), "DMC");
include('translations/en/cat_has_a_bid_and_user_has_no_bids/purchase_minimum.php');
$modify_type = "<input type='hidden' name='modify_type' value='purchase'>";
}
elseif(number_format($value , 8) == number_format($highestpriceslot , 8)){
$temp_DMCpopulation = $linkInfo->getPricePopByCat($cat_id, number_format($value , 8), "DMC");
include('translations/en/cat_has_a_bid_and_user_has_no_bids/purchase_equal_to_highest.php');
$modify_type = "<input type='hidden' name='modify_type' value='purchase'>";
}
elseif (number_format($value , 8) < number_format($lowestpriceslot , 8)) {
	include('translations/en/cat_has_a_bid_and_user_has_no_bids/purchase_lower_than_lowest.php');
$modify_type = "<input type='hidden' name='modify_type' value='purchase'>";
$temp_DMCpopulation = 0;
$temp_BSVpopulation = 0;
}
elseif (number_format($value , 8) == number_format($lowestpriceslot , 8)) {
	include('translations/en/cat_has_a_bid_and_user_has_no_bids/purchase_equal_to_lowest.php');
$modify_type = "<input type='hidden' name='modify_type' value='purchase'>";
$temp_DMCpopulation = $linkInfo->getPricePopByCat($cat_id, number_format($value , 8), "DMC");

}
elseif(number_format($value , 8) < number_format($highestpriceslot , 8) AND number_format($value , 8) > number_format($lowestpriceslot , 8) ) {	
$temp_DMCpopulation = $linkInfo->getPricePopByCat($cat_id, number_format($value , 8), "DMC");
if($temp_DMCpopulation == 0){
include('translations/en/cat_has_a_bid_and_user_has_no_bids/purchase_between_highest_and_lowest_no_pop.php');

}

else
{
include('translations/en/cat_has_a_bid_and_user_has_no_bids/purchase_between_highest_and_lowest_has_pop.php');

}
}	
 
$steps_display .= "<tr style='background-color: rgba(255,255,224, 0.8)'><td>";
$steps_display .= '<h5>'.$pre_blockt_text_message.'</h5><br>

<span class="dropt" style="font-size: large;" title="'.$mouseover.'">'.$link_title.'<img height="42" width="42" src="views/green_arrow.png">
  <span style="width:500px;">'.$blockt_message.'</span></span>';

$steps_display .= "</td><td colspan=2>
<form name='test' action='' method='post'>
<input type='hidden' name='url' value='". $_POST['url']."'> 
<input type='hidden' name='link_id' value='".$_POST['link_id']."'> 
<input type='hidden' name='cat_id' value='".$_POST['cat_id']."'> 
<input type='hidden' name='installer_id' value='".$_POST['installer_id']."'> 
<input type='hidden' name='coin_type' value='".$_POST['coin_type']."'> 
<input type='hidden' name='agent_ID' value='".$_POST['agent_ID']."'> 
<input type='hidden' name='users_balances_string' value='".$users_balances_string."'> 
<input type='hidden' name='this_links_status_on_Central' value='".$this_links_status_on_Central."'>
<input type='hidden' name='price' value='".number_format($value , 8)."'>";

 $steps_display .= $modify_type;
$steps_display .= "<input type='hidden' name='C1' value='C1'> 
";


$steps_display .= " - ". $crypto_coin_header; 

$steps_display .= " - <input type='text' name='price' value='".$value."' readonly> <br> USD value $".round($value * $data['USD'],2)." per day. ";

$steps_display .= $message;
$steps_display .= '<div class="wrapper">   
      <span class="button"><button class="'.$submit_button_name.'" name="'.$submit_button_name.'"  />'.$button.'</span></div>';

if($coin_type == "DMC"){

if(!isset($tentative_rank)){
$tentative_rank = $linkInfo->get_tentative_rank_of_bidder($cat_id, $coin_type, number_format($value , 8));
$tentative_rank = $tentative_rank + $BSVpopulation + 1;
}

$steps_display .= '</td></form></td><td style="vertical-align: text-top;"><h5>'.$population.'</h5>';
if($tentative_rank == 1){
$postfix="st";
}
elseif($tentative_rank == 2){
$postfix="nd";
}
elseif($tentative_rank == 3){
$postfix="rd";
}
else
{
$postfix="th";
}
$steps_display .= '<br>'.$demo_coin_label.': '.$temp_DMCpopulation;
$steps_display .= '<br>'.$tentative_label.': '.$tentative_rank.$postfix;

}
else
{
$steps_display .= '<br>'.$demo_coin_label.': '.$temp_DMCpopulation;
}
$steps_display .= '</td></tr> ';


unset($tentative_rank);


} 
?>
