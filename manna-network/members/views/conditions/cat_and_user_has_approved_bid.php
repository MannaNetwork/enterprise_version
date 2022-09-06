<?php

if($debug=="2"){
echo '<br>in cat_and_user_has_approved_bid.php line 3';
echo '<p style="color:red;">You are seeing these coding messages because you have Debug turned on in /manna-configs/db_cfg/agent_config.php/</p><br>Post values from form = ';
print_r($_POST);
}
$users_balances_array = explode("|", $users_balances_string);
if($debug=="2"){
echo '<br>if($daily_minimum_bid_target < $this_links_bid){ ';
echo '<br> $daily_minimum_bid_target = ', $daily_minimum_bid_target;
echo '<br> $this_links_bid = ', $this_links_bid;
echo '<br> $cat_id = ', $cat_id;
echo '<br> $hi_low_string = ', $hi_low_string;
echo '<br> $users_balances_string (string = ', $users_balances_string;
echo '<br>';
print_r($users_balances_string);
echo '<br> $users_balances_array[0] = ', $users_balances_array[0];
echo '<br> $users_balances_array[1] = ', $users_balances_array[1];
}
$this_links_bid = number_format($this_links_bid, 8);

//we need to determine if this user's bid is above the current minimum bid target or not (they may have bought it before a price drop)? If the price spiked that info won't affect the list (i.e. $steps array) of THIS price slots display  

if(number_format($daily_minimum_bid_target,8) < $this_links_bid){
$current_index_of_max = $linkInfo->get_current_index_of_priceslot($highestpriceslot);
$current_index_of_min = $linkInfo->get_current_index_of_daily_minimum_bid_target(number_format($daily_minimum_bid_target,8));
}
else {
$current_index_of_max = $linkInfo->get_current_index_of_priceslot($highestpriceslot);
$current_index_of_min = $linkInfo->get_current_index_of_priceslot($this_links_bid);
}

$steps = $linkInfo->get_price_slots_by_minmaxindex($current_index_of_max, $current_index_of_min, $number_of_extra_price_slots);

/*echo '<h3 style="color:red;">In cat and user has approved bid - the steps value returned by get_price_slots_by_minmaxindex = ';
print_r($steps);
echo '</h3>'; */

// this function runs the 1.5 algorithm (starting at .00000001) to run the priceslots and grabs the indexes that match the low, high and adds two (the current default $number_of_extra_price_slots)
/*
$steps_display ='<div style=" width: 80%;
  margin: 0 auto;"><table style="border-collapse: collapse; table-layout:fixed;" cellpadding="40"><tr><td colspan=4>';
$steps_display .= "<tr><td colspan=4><h3>". $welcome_message ."</h3></td></tr>";
//$steps_display .= BUY_2ND_PAGE_HEADER. "</td></tr><tr><td colspan=2> <h3>".BSV_PRICE_TITLE.":".$data['USD'].'</h3></td><td  colspan=2>'. $volatility_modeler.'</td></tr>';

$steps_display .= "<tr><td colspan=2> <h3>".$crypto_coin_header.":".$data['USD'].'</h3></td><td  colspan=2>'. $volatility_modeler.'</td></tr>';
*/
include('translations/en/cat_and_user_has_approved_bid/common.php');

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

$bsv_balance_formatted = explode(".",$users_balances_array[0]);
$dmc_balance_formatted = explode(".",$users_balances_array[1]);

$steps_display .= '</td><td  colspan=2>Your Balance(s): BSV -> 0.'.$bsv_balance_formatted[1].'<br>DMC (i.e. Demo Coin) -> 0.'.$dmc_balance_formatted[1].'</td></tr>';


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
unset($currentPS);
foreach($steps as $key=>$value){
if($key == 0){
include('translations/en/cat_and_user_has_approved_bid/key0.php');
$modify_type = "<input type='hidden' name='modify_type' value='upgrade'>";
$submit_button_name = "upgrade";//This value is the name of the submit button. The translations pages create the var but can it be done from here better? Was getting two errors when modifying the current. Higher bids also named the button "purchase" (which this should correct). The other was when a user clicked their current priceslot they get Notice: Undefined variable: steps_display in /home/orlandoreferralg/public_html/manna_network/manna-network/members/views/buy_price_slot.php on line 199
	$temp_DMCpopulation = 0;
	$temp_BSVpopulation = 0;
}
elseif($key == 1){
include('translations/en/cat_and_user_has_approved_bid/key1.php');
$submit_button_name = "upgrade"; //These two $key priceslots are always empty so, therefore, are upgrades
$modify_type = "<input type='hidden' name='modify_type' value='upgrade'>";

	$temp_DMCpopulation = 0;
	$temp_BSVpopulation = 0;
}
elseif (number_format($value, 8) == $this_links_bid) {
$currentPS = "1";//flag the current bid for use in right_column.php
$submit_button_name = "no_edit line 100 cat_and_user_has_approved_bid.php";
if($this_links_bid < number_format($lowestpriceslot , 8) ){
	include('translations/en/cat_and_user_has_approved_bid/user_bid_lower_than_lowest.php');
	}
	elseif($this_links_bid == number_format($highestpriceslot, 8) ){
	include('translations/en/cat_and_user_has_approved_bid/user_bid_is_highest.php');
	}
	elseif($this_links_bid == number_format($lowestpriceslot , 8) ){
	include('translations/en/cat_and_user_has_approved_bid/user_bid_is_lowest.php');
	}
	elseif($this_links_bid > number_format($lowestpriceslot , 8) AND $this_links_bid < number_format($highestpriceslot , 8)){

	include('translations/en/cat_and_user_has_approved_bid/user_bid_between_highest_and_lowest.php');
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
	else
	{
	$temp_BSVpopulation = $linkInfo->get_population_from_Central_by_slot($cat_id, number_format($value , 8), "BSV");
	}
		
	}elseif (number_format($value , 8) < $this_links_bid ) {
$temp_DMCpopulation = $linkInfo->get_population_from_Central_by_slot($cat_id, number_format($value , 8), "DMC");
if($temp_DMCpopulation ==0){
include('translations/en/cat_and_user_has_approved_bid/downgrade.php');
$submit_button_name = "downgrade";
}
else
{
include('translations/en/cat_and_user_has_approved_bid/downgrade_between_highest_and_lowest_has_pop.php');
$submit_button_name = "downgrade";
}
		$modify_type = "<input type='hidden' name='modify_type' value='downgrade'>";
		$temp_DMCpopulation = $linkInfo->get_population_from_Central_by_slot($cat_id, number_format($value , 8), "DMC");
	} elseif (number_format($value , 8) > $this_links_bid ) {
	if($debug==2){
	echo '<br>line 141 in section elseif (number_format($value , 8) > $this_links_bid ) ';
	}
$temp_DMCpopulation = $linkInfo->get_population_from_Central_by_slot($cat_id, number_format($value , 8), "DMC");
if($temp_DMCpopulation ==0){
include('translations/en/cat_and_user_has_approved_bid/upgrade.php');
$submit_button_name = "downgrade";
}
else
{
include('translations/en/cat_and_user_has_approved_bid/upgrade_between_highest_and_lowest_has_pop.php');
$submit_button_name = "downgrade";
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
	<input type='hidden' name='old_price' value='".$this_links_bid."'>
	<input type='hidden' name='isLinkApproved' value='".$isLinkApproved."'>
	<input type='hidden' name='this_links_bid_status_on_Central' value='".$this_links_bid_status_on_Central."'>";
	
	//$isLinkApproved returns a yes or no 
	//BLOCKT_TITLE_NO_APPROVED

	 $steps_display .= $modify_type;
	$steps_display .= "<input type='hidden' name='C1' value='C1'> ";


	$steps_display .= " - ". $priceslot_label; 

	$steps_display .= " - <input type='text' name='price' value='".$value."' readonly /> <br><span class=\"dropt\" style=\"font-size: large;\" title=\".$daily_payment_mouseover.\"> USD value $".round($value * $data['USD'],2)." per day. ";
//$message = 'Line 170 This is the missing var in cat and user has approved bid.php';
	//$steps_display .= $message;
	//$daily_payment messages are in translations/cat and user has approved bid/common.php
	if($coin_type == 'bsv'){
	$num_days_funded = $users_balances_array[0]/$value;
	}
	else
	{
	$num_days_funded = $users_balances_array[1]/$value;
	}
	$steps_display .= '<b>'.$daily_payment_message.'</b><img height="42" width="42" src="views/green_arrow.png">';
	$steps_display .= '  <span style="width:500px;">'.$daily_payment_message1.$num_days_funded.$daily_payment_message2.'</span></span>';
	
$steps_display .= '<div class="wrapper">   
      <span class="mnbutton"><button class="'.$submit_button_name.'" name="'.$submit_button_name.'"  />'.$button.'</span></div>';
  $steps_display .= '</form></td><td style="vertical-align: text-top;">';
// echo '<br>LOOKING for price_slot value used in each form window - am inside the for loop so number_format($value, 8) should work? ' , number_format($value, 8);
 $price_slot = number_format($value, 8);
// echo '<br>$value (without formatting) is =', $value.'<br><br>';
 if($key==0 OR $key==1){
 $steps_display .= '<br># Of Previous Buyers - 0 <br>Your tentative rank at ALL levels*: 1st';
 }
 else
 {
 $competingBids = array(0,0,0,0,0);
       include(dirname( __FILE__, 2 ).'/includes/right_column.php');
  }     
   $steps_display .= '</td></tr> ';   
      
 } 
?>
