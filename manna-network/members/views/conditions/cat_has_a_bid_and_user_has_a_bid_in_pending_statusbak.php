<?php
if($debug=="2"){
echo '<br>in cat_has_a_bid_and_user_in_pending_status.php ';
echo '<br>';
print_r($_POST);
}

 include('translations/en/cat_has_bids_user_in_pending_status/common.php');
if(isset($_POST['volatility_modeler'])){
  include('translations/en/cat_has_bids_user_in_pending_status/user_modeler.php');
}
else
{
  include('translations/en/cat_has_bids_user_in_pending_status/user_normal.php');
}

if($debug=="2"){
echo '<br> $daily_minimum_bid_target = ', $daily_minimum_bid_target;
echo '<br> $this_links_bid = ', $this_links_bid;
echo '<br> line 21 conditions $hi_low_string = ', $hi_low_string;
}

$this_links_bid = number_format($this_links_bid, 8);

if(number_format($daily_minimum_bid_target,8) < $this_links_bid){
$current_index_of_max = $linkInfo->get_current_index_of_priceslot($highestpriceslot);
$current_index_of_min = $linkInfo->get_current_index_of_daily_minimum_bid_target(number_format($daily_minimum_bid_target,8));
}
else {
$current_index_of_max = $linkInfo->get_current_index_of_priceslot($highestpriceslot);
$current_index_of_min = $linkInfo->get_current_index_of_priceslot($this_links_bid);
}

$steps = $linkInfo->get_price_slots_by_minmaxindex($current_index_of_max, $current_index_of_min, $number_of_extra_price_slots);

if($hi_low_string != "No Bids"){
//population for reporting 
$population_array = $linkInfo->get_population_from_Central($cat_id, $hi_low_string);
$population_array =json_decode($population_array, true);
}

//there are already bids in the category
$steps_display ='<div style=" width: 80%;
  margin: 0 auto;"><table style="border-collapse: collapse; table-layout:fixed;" cellpadding="40"><tr><td colspan=4>';
$steps_display .= '<tr><td colspan=4><h3>'. $welcome_message .'</h3></td></tr><tr style="border-bottom: 1px solid #000;"<td colspan="3"><br></td></tr>';





if(isset($_POST['volatility_modeler'])){
$steps_display .= "<tr  style='color:red;' ><td colspan=2> <h3>".$crypto_coin_header.": $".$data['USD'].$bsv_volatility_on.'</h3></td><td  colspan=2>'.$volatility_modeler.'</td></tr>';
}
else
{
$steps_display .= "<tr><td colspan=2> <h3>".$crypto_coin_header.":".$data['USD'].'</h3></td><td  colspan=2>'. $volatility_modeler.'</td></tr>';
}


$steps = array_reverse($steps);
$count_steps = count($steps);
$BSVpopulation = $linkInfo->get_cat_count_of_bids_approved($cat_id, "BSV");

foreach($steps as $key=>$value){
if($key == 0){
include('translations/en/cat_has_bids_user_in_pending_status/key0.php');
$modify_type = "<input type='hidden' name='modify_type' value='upgrade'>";

	$temp_DMCpopulation = 0;
	$temp_BSVpopulation = 0;
}
elseif($key == 1){
include('translations/en/cat_has_bids_user_in_pending_status/key1.php');
$modify_type = "<input type='hidden' name='modify_type' value='upgrade'>";

	$temp_DMCpopulation = 0;
	$temp_BSVpopulation = 0;
}
 
elseif(number_format($value, 8) == $this_links_bid) {
echo '<br>line 80';
	if($this_links_bid < number_format($lowestpriceslot , 8) ){
echo '<br>line 83';
	include('translations/en/cat_has_bids_user_in_pending_status/user_bid_lower_than_lowest.php');
	}
	elseif($this_links_bid == number_format($highestpriceslot, 8) ){
echo '<br>line 87';
	include('translations/en/cat_has_bids_user_in_pending_status/user_bid_is_highest.php');
	}
	elseif($this_links_bid == number_format($lowestpriceslot , 8) ){
echo '<br>line 90';
	include('translations/en/cat_has_bids_user_in_pending_status/user_bid_is_lowest.php');
	}
	elseif($this_links_bid > number_format($lowestpriceslot , 8) AND $this_links_bid < number_format($highestpriceslot , 8)){
echo '<br>line 95';
	include('translations/en/cat_has_bids_user_in_pending_status/user_bid_between_highest_and_lowest.php');
	}
	else{
echo '<br>line 99';
	include('translations/en/cat_has_a_bid_and_user_has_a_bid_in_pending_status/user_normal.php');
	}
			$modify_type = "<input type='hidden' name='modify_type' value='cancel'>";
	if($coin_type=="DMC"){
	// we need to get the total BSV bids to determine final position
	//$BSVpopulation = $linkInfo->get_cat_count_of_bids_approved($cat_id, "BSV");
	$temp_DMCpopulation = $linkInfo->get_population_from_Central_by_slot($cat_id, number_format($value , 8), "DMC");
	}
	else
	{
	$temp_BSVpopulation = $linkInfo->get_population_from_Central_by_slot($cat_id, number_format($value , 8), "BSV");
	}
}
elseif (number_format($highestpriceslot, 8) == number_format($value, 8)) {
if($coin_type=="DMC"){
	// we need to get the total BSV bids to determine final position
	//$BSVpopulation = $linkInfo->get_cat_count_of_bids_approved($cat_id, "BSV");
	$temp_DMCpopulation = $linkInfo->get_population_from_Central_by_slot($cat_id, number_format($value , 8), "DMC");
	}
	else
	{
	$temp_BSVpopulation = $linkInfo->get_population_from_Central_by_slot($cat_id, number_format($value , 8), "BSV");
	}
include('translations/en/cat_has_bids_user_in_pending_status/current_highest.php');
if($this_links_bid > number_format($value, 8)) {
$modify_type = "<input type='hidden' name='modify_type' value='downgrade'>";
}
}
elseif (number_format($lowestpriceslot, 8) == number_format($value, 8)) {
if($coin_type=="DMC"){
	// we need to get the total BSV bids to determine final position
	//$BSVpopulation = $linkInfo->get_cat_count_of_bids_approved($cat_id, "BSV");
	$temp_DMCpopulation = $linkInfo->get_population_from_Central_by_slot($cat_id, number_format($value , 8), "DMC");
	}
	else
	{
	$temp_BSVpopulation = $linkInfo->get_population_from_Central_by_slot($cat_id, number_format($value , 8), "BSV");
	}
include('translations/en/cat_has_bids_user_in_pending_status/current_lowest.php');
if($this_links_bid > number_format($value, 8)) {
$modify_type = "<input type='hidden' name='modify_type' value='downgrade'>";
}
}
elseif(number_format($value, 8) <= number_format($highestpriceslot, 8) AND number_format($value, 8) >= number_format($lowestpriceslot, 8)) {
echo '<br>line 129';
//is a priceslot between highest and lowest
if($coin_type=="DMC"){
	// we need to get the total BSV bids to determine final position
	//$BSVpopulation = $linkInfo->get_cat_count_of_bids_approved($cat_id, "BSV");
	$temp_DMCpopulation = $linkInfo->get_population_from_Central_by_slot($cat_id, number_format($value, 8), "DMC");
	}
	else
	{
	$temp_BSVpopulation = $linkInfo->get_population_from_Central_by_slot($cat_id, number_format($value, 8), "BSV");
	}
if(number_format($value, 8) > $this_links_bid){
include('translations/en/cat_has_bids_user_in_pending_status/upgrade.php');
}
else
{
include('translations/en/cat_has_bids_user_in_pending_status/downgrade.php');

}
$modify_type = "<input type='hidden' name='modify_type' value='cancel'>";

}
  $option_name = $key + 1;
$steps_display .= '<tr><td colspan="3"><h3 style="font-weight:bold;">Bid Option # '.$option_name.'</h3></td></tr>';
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
<input type='hidden' name='old_price' value='".$_POST['old_price']."'> 

<input type='hidden' name='this_links_status_on_Central' value='".$this_links_status_on_Central."'>";

 $steps_display .= $modify_type;
$steps_display .= "<input type='hidden' name='C1' value='C1'> 
";

$steps_display .= " - ". $crypto_coin_header; 

$steps_display .= " - <input type='text' name='price' value='".$value."' readonly> <br> USD value $".round($value * $data['USD'],2)." per day. ";

$steps_display .= $message;




	
	if (number_format($value , 8) == $this_links_bid) {
	$steps_display .= '<div class="wrapper">   
	      <span class="button"><button class="'.$submit_button_name.'" name="'.$submit_button_name.'"  />'.$button.'</span></div>';

	}
	else
	{
	$steps_display .= '<div class="wrapper">   
	      <span class="button"><button class="'.$submit_button_name.'" name="'.$submit_button_name.'"  />'.$button.'</span></div>';

	}
	//$steps_display .= '</td></form></td><td style="vertical-align: text-top;"><h5>'.$population.'</h5>';
	//$steps_display .= '<br>'.$crypto_coin_label.': '.$temp_BSVpopulation.'<br>'.$demo_coin_label.': '.$temp_DMCpopulation.'</td></tr> ';

	//}
	
	if (number_format($value , 8) == $this_links_bid) {
		if($coin_type == "DMC"){
		$steps_display .= '</td></form></td><td style="vertical-align: text-top;"><h5>'.$population_rank.'</h5><h5>'.$crypto_coin_label.' '.$population.': '.$BSVpopulation.'</h5>';
$temp_DMCpopulation = $temp_DMCpopulation + 1;
$steps_display .= '<br>'.$demo_coin_label.' '.$population.': '.$temp_DMCpopulation;
if($temp_DMCpopulation >1){
$steps_display .= $personalize;
}
else
{
$steps_display .= " (including yours)";
}
}
else
{
$steps_display .= '<br>'.$crypto_coin_label.': '.$temp_DMCpopulation;
}
//$this_links_rank = $linkInfo->get_rank_of_bidder($link_id, $agent_ID,$cat_id, $coin_type, number_format($value , 8));

$this_links_rank = $linkInfo->get_rank_of_bidder_by_price(number_format($value , 8), $link_id, $agent_ID,$cat_id, $coin_type);
//$this_links_rank = $linkInfo->get_cat_count_of_bids_approved($cat_id, $coin_type) + 1;
if($BSVpopulation > 0){
$this_links_rank = $this_links_rank + $BSVpopulation;
}
if($this_links_rank == 1){
$postfix="st";
}
elseif($this_links_rank == 2){
$postfix="nd";
}
elseif($this_links_rank == 3){
$postfix="rd";
}
else
{
$postfix="th";
}
$steps_display .= '<br>'.$dmc_rank_title.' *: '.$this_links_rank.$postfix.'<br><span class="dropt" style="font-size: large;" title="'.$mouseover_rank.'">'.$link_title_rank.'<img height="42" width="42" src="views/green_arrow.png">
	  <span style="width:500px;">'.$blockt_message_rank.'</span></span>';;
}
else
{
if($coin_type == "DMC"){
$steps_display .= '</td></form></td><td style="vertical-align: text-top;"><h5>'.$population.'</h5>';
$steps_display .= '<br>'.$demo_coin_label.': '.$temp_DMCpopulation;
}
else
{
$steps_display .= '<br>'.$demo_coin_label.': '.$temp_BSVpopulation;
}
$steps_display .= '</td></tr> ';

}
}




?>
