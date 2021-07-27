<?php
if($debug=="2"){
echo '<br>in cat_and_user_has_approved_bid.php ';
echo '<p style="color:red;">You are seeing these coding messages because you have Debug turned on in /manna-configs/db_cfg/agent_config.php/</p><br>Post values from form = ';
print_r($_POST);
}

if($debug=="2"){
echo '<br>if($daily_minimum_bid_target < $this_links_bid){ ';
echo '<br> $daily_minimum_bid_target = ', $daily_minimum_bid_target;
echo '<br> $this_links_bid = ', $this_links_bid;
echo '<br> $cat_id = ', $cat_id;
echo '<br> $hi_low_string = ', $hi_low_string;
}

//we need to determine if this user's bid is above the current minimum bid target or not (they may have bought it before a price drop)? If the price spiked that info won't affect the list (i.e. $steps array) of THIS price slots display  

if(number_format($daily_minimum_bid_target,8) < number_format($this_links_bid,8)){
$current_index_of_max = $linkInfo->get_current_index_of_priceslot($highestpriceslot);
$current_index_of_min = $linkInfo->get_current_index_of_daily_minimum_bid_target(number_format($daily_minimum_bid_target,8));
}
else {
$current_index_of_max = $linkInfo->get_current_index_of_priceslot($highestpriceslot);
$current_index_of_min = $linkInfo->get_current_index_of_priceslot($this_links_bid);
}

$steps = $linkInfo->get_price_slots_by_minmaxindex($current_index_of_max, $current_index_of_min, $number_of_extra_price_slots);
/*
$steps_display ='<div style=" width: 80%;
  margin: 0 auto;"><table style="border-collapse: collapse; table-layout:fixed;" cellpadding="40"><tr><td colspan=4>';
$steps_display .= "<tr><td colspan=4><h3>". $welcome_message ."</h3></td></tr>";
//$steps_display .= BUY_2ND_PAGE_HEADER. "</td></tr><tr><td colspan=2> <h3>".BSV_PRICE_TITLE.":".$data['USD'].'</h3></td><td  colspan=2>'. $volatility_modeler.'</td></tr>';

$steps_display .= "<tr><td colspan=2> <h3>".$crypto_coin_header.":".$data['USD'].'</h3></td><td  colspan=2>'. $volatility_modeler.'</td></tr>';
*/
$BSVpopulation = $linkInfo->get_cat_count_of_bids_approved($cat_id, "BSV");
$demo_coin_population = $linkInfo->get_cat_count_of_bids_approved($cat_id, "DMC");
$steps_display ='<div style=" width: 80%;
  margin: 0 auto;"><table style="border-collapse: collapse; table-layout:fixed;" cellpadding="40"><tr><td colspan=4>';
$steps_display .= "<tr><td colspan=4><h3>". $welcome_message ."</h3></td></tr>";

$steps_display .= "<tr><td colspan=2> <h3>".$crypto_coin_header.":".$data['USD'].'</h3>';
if($coin_type == "DMC"){
$steps_display .= '<h3>'.$crypto_coin_label." ".$population.": ".$BSVpopulation.'</h3>';
$steps_display.= '<span class="dropt" style="font-size: large;" title="'.$bsv_pop_mouseover.'">'.$bsv_pop_link_title.'<img height="42" width="42" src="views/green_arrow.png">
  <span style="width:500px;">'.$bsv_pop_blockt_message.'</span></span>';
}
$steps_display .= '</td><td  colspan=2>&nbsp;</td></tr>';

//we don't have to do population checks or queries because cat has no bids so we can use presets except for the display of this links population (which will make it 1) $temp_DMCpopulation = 0; $temp_BSVpopulation = 0;

$steps = array_reverse($steps);
$count_steps = count($steps);

/*
example echoes:
$daily_minimum_bid_target = 0.0008068290006616
$this_links_bid = 000.00085224
$cat_id = 111
$hi_low_string = 000.00127836|000.00085224 
*/
include('translations/en/cat_and_user_has_approved_bid/common.php');

foreach($steps as $key=>$value){
if($key == 0){
include('translations/en/cat_and_user_has_approved_bid/key0.php');
$modify_type = "<input type='hidden' name='modify_type' value='upgrade'>";

	$temp_DMCpopulation = 0;
	$temp_BSVpopulation = 0;
}
elseif($key == 1){
include('translations/en/cat_and_user_has_approved_bid/key1.php');
$modify_type = "<input type='hidden' name='modify_type' value='upgrade'>";

	$temp_DMCpopulation = 0;
	$temp_BSVpopulation = 0;
}
elseif ($key == $count_steps-1) {
$temp_DMCpopulation = $linkInfo->getPricePopByCat($cat_id, number_format($value , 8), "DMC");
$temp_BSVpopulation = $linkInfo->getPricePopByCat($cat_id, number_format($value , 8), "BSV");

include('translations/en/cat_and_user_has_approved_bid/downgrade_to_minimum.php');
$modify_type = "<input type='hidden' name='modify_type' value='downgrade'>";
	
	} 
	elseif (number_format($value, 8) == number_format($this_links_bid, 8)) {
if(number_format($this_links_bid, 8) == number_format($highestpriceslot, 8) ){
include('translations/en/cat_and_user_has_approved_bid/user_bid_is_highest.php');
}
elseif(number_format($this_links_bid , 8) == number_format($lowestpriceslot , 8) ){
include('translations/en/cat_and_user_has_approved_bid/user_bid_is_lowest.php');
}
elseif(number_format($this_links_bid , 8) > number_format($lowestpriceslot , 8) AND number_format($this_links_bid , 8) < number_format($highestpriceslot , 8)){
include('translations/en/cat_and_user_has_approved_bid/user_bid_between_highest_and_lowest.php');
}
elseif(number_format($this_links_bid , 8) < number_format($lowestpriceslot , 8) ){
include('translations/en/cat_and_user_has_approved_bid/user_bid_lower_than_lowest.php');
}
else{
include('translations/en/cat_and_user_has_approved_bid/user_normal.php');
}
		$modify_type = "<input type='hidden' name='modify_type' value='cancel'>";
if($coin_type=="DMC"){
// we need to get the total BSV bids to determine final position
//$BSVpopulation = $linkInfo->get_cat_count_of_bids_approved($cat_id, "BSV");
$temp_DMCpopulation = $linkInfo->get_population_from_Central_by_slot($cat_id, number_format($value , 8), "DMC");
	
}
		
	}elseif (number_format($value , 8) < number_format($this_links_bid , 8)) {
$temp_DMCpopulation = $linkInfo->get_population_from_Central_by_slot($cat_id, number_format($value , 8), "DMC");
if($temp_DMCpopulation ==0){
include('translations/en/cat_and_user_has_approved_bid/downgrade.php');
}
else
{
include('translations/en/cat_and_user_has_approved_bid/downgrade_between_highest_and_lowest_has_pop.php');

}
		$modify_type = "<input type='hidden' name='modify_type' value='downgrade'>";
		$temp_DMCpopulation = $linkInfo->get_population_from_Central_by_slot($cat_id, number_format($value , 8), "DMC");
	} elseif (number_format($value , 8) > number_format($this_links_bid , 8)) {
$temp_DMCpopulation = $linkInfo->get_population_from_Central_by_slot($cat_id, number_format($value , 8), "DMC");
if($temp_DMCpopulation ==0){
include('translations/en/cat_and_user_has_approved_bid/upgrade.php');
}
else
{
include('translations/en/cat_and_user_has_approved_bid/upgrade_between_highest_and_lowest_has_pop.php');
}

		$modify_type = "<input type='hidden' name='modify_type' value='upgrade'>";
		$temp_DMCpopulation = $linkInfo->get_population_from_Central_by_slot($cat_id, number_format($value , 8), "DMC");
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
	<input type='hidden' name='this_links_status_on_Central' value='".$this_links_status_on_Central."'>";

	 $steps_display .= $modify_type;
	$steps_display .= "<input type='hidden' name='C1' value='C1'> ";


	$steps_display .= " - ". $priceslot_label; 

	$steps_display .= " - <input type='text' name='price' value='".$value."' readonly> <br> USD value $".round($value * $data['USD'],2)." per day. ";

	$steps_display .= $message;
$steps_display .= '<div class="wrapper">   
      <span class="button"><button class="'.$submit_button_name.'" name="'.$submit_button_name.'"  />'.$button.'</span></div>';

if (number_format($value , 8) == number_format($this_links_bid , 8)) {
if($coin_type == "DMC"){
$steps_display .= '</td></form></td><td style="vertical-align: text-top;"><h5>'.$population_rank.'</h5><h5>'.$crypto_coin_label.' '.$population.': '.$BSVpopulation.'</h5>';

$steps_display .= '<br>'.$demo_coin_label.' '.$population.': '.$temp_DMCpopulation;
if($temp_DMCpopulation ==1){
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
$this_links_rank = $linkInfo->get_rank_of_bidder($link_id, $agent_ID,$cat_id, $coin_type, number_format($value , 8));
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
$steps_display .= '<br>'.$rank.' *: '.$this_links_rank.$postfix.'<br><span class="dropt" style="font-size: large;" title="'.$mouseover_rank.'">'.$link_title_rank.'<img height="42" width="42" src="views/green_arrow.png">
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
$steps_display .= '<br>'.$demo_coin_label.': '.$temp_DMCpopulation;
}
$steps_display .= '</td></tr> ';

}
/*
if (number_format($value , 8) == number_format($this_links_bid , 8)) {
if($coin_type == "DMC"){
$steps_display .= '</td></form></td><td style="vertical-align: text-top;"><h5>'.$population_rank.'</h5><h5>'.$crypto_coin_label.' '.$population.': '.$BSVpopulation.'</h5>';
$steps_display .= '<br>'.$demo_coin_label.' '.$population.': '.$temp_DMCpopulation;
if($temp_DMCpopulation ==1){
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
$this_links_rank = $linkInfo->get_rank_of_bidder($link_id, $agent_ID,$cat_id, $coin_type, number_format($value , 8));
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
$steps_display .= '<br>'.$rank.' *: '.$this_links_rank.$postfix.'<br><span class="dropt" style="font-size: large;" title="'.$mouseover_rank.'">'.$link_title_rank.'<img height="42" width="42" src="views/green_arrow.png">
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
$steps_display .= '<br>'.$demo_coin_label.': '.$temp_DMCpopulation;
}
$steps_display .= '</td></tr> ';

}*/

}


?>
