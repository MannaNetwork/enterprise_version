<?php
 echo '<H2>Manually turned debug on in conditions/cat has a bid and user in pending status</h2>';
echo '<br> The welcome message is wrong. It\'s not the website that needs to be reviewed. The cron needs to be run in order to move the link position';
$debug=2; 
if($debug=="2"){
echo '<br>in cat_has_bids_user_has_a_bid_in_pending_status.php line 3';
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
$users_balances_array = explode("|", $users_balances_string);
$this_links_bid = number_format($this_links_bid, 8);

//we need to determine 1) if this user's pending bid will be the new top bid or 2) if this user's bid is above the current minimum bid target or not (they may have bought it before a price drop)? If the price spiked that info won't affect the list (i.e. $steps array) of THIS price slots display  
if($this_links_bid > number_format($highestpriceslot, 8))  {
$current_index_of_max = $linkInfo->get_current_index_of_priceslot($this_links_bid);
$current_index_of_min = $linkInfo->get_current_index_of_daily_minimum_bid_target(number_format($daily_minimum_bid_target,8));
}
elseif(number_format($daily_minimum_bid_target,8) < $this_links_bid){
$current_index_of_max = $linkInfo->get_current_index_of_priceslot($highestpriceslot);
$current_index_of_min = $linkInfo->get_current_index_of_daily_minimum_bid_target(number_format($daily_minimum_bid_target,8));
}

else {
$current_index_of_max = $linkInfo->get_current_index_of_priceslot($highestpriceslot);
$current_index_of_min = $linkInfo->get_current_index_of_priceslot($this_links_bid);
}

$steps = $linkInfo->get_price_slots_by_minmaxindex($current_index_of_max, $current_index_of_min, $number_of_extra_price_slots);
$BSVpopulation = $linkInfo->get_cat_count_of_bids_approved($cat_id, "BSV");
$demo_coin_population = $linkInfo->get_cat_count_of_bids_approved($cat_id, "DMC");
include('translations/en/cat_has_bids_user_in_pending_status/common.php');
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


foreach($steps as $key=>$value){
if($key == 0){
include('translations/en/cat_has_bids_user_in_pending_status/key0.php');
$submit_button_name = "upgrade"; //These two $key priceslots are always empty so, therefore, are upgrades
$modify_type = "<input type='hidden' name='modify_type' value='upgrade'>";

	$temp_DMCpopulation = 0;
	$temp_BSVpopulation = 0;
}
elseif($key == 1){
include('translations/en/cat_has_bids_user_in_pending_status/key1.php');
$submit_button_name = "upgrade"; //These two $key priceslots are always empty so, therefore, are upgrades
$modify_type = "<input type='hidden' name='modify_type' value='upgrade'>";

	$temp_DMCpopulation = 0;
	$temp_BSVpopulation = 0;
}
elseif (number_format($value, 8) == $this_links_bid) {
//Give every translations include new value for submit button name - $submit_button_name = "current"; //This value works with any value just don't give it value "purchase" because every one of these are the current bid by this user
if($this_links_bid < number_format($lowestpriceslot , 8) ){
	include('translations/en/cat_has_bids_user_in_pending_status/user_bid_lower_than_lowest.php');
	$submit_button_name = "current"; //This value works with any value just don't give it value "purchase"
	}
	elseif($this_links_bid == number_format($highestpriceslot, 8) ){
	include('translations/en/cat_has_bids_user_in_pending_status/user_bid_is_highest.php');
	$submit_button_name = "current"; //This value works with any value just don't give it value "purchase"
	}
	elseif($this_links_bid == number_format($lowestpriceslot , 8) ){
	include('translations/en/cat_has_bids_user_in_pending_status/user_bid_is_lowest.php');
	$submit_button_name = "current"; //This value works with any value just don't give it value "purchase"
	}
	elseif($this_links_bid > number_format($lowestpriceslot , 8) AND $this_links_bid < number_format($highestpriceslot , 8)){
	include('translations/en/cat_has_bids_user_in_pending_status/user_bid_between_highest_and_lowest.php');
	$submit_button_name = "current"; //This value works with any value just don't give it value "purchase"
	}
	else{
	include('translations/en/cat_has_bids_user_in_pending_status/user_normal.php');
	$submit_button_name = "current"; //This value works with any value just don't give it value "purchase"
	}
		$modify_type = "<input type='hidden' name='modify_type' value='current'>";	
	if($coin_type=="DMC"){
	// we need to get the total BSV bids to determine final position
	//$BSVpopulation = $linkInfo->get_cat_count_of_bids_approved($cat_id, "BSV");
	$temp_DMCpopulation = $linkInfo->get_population_from_Central_by_slot($cat_id, number_format($value , 8), "DMC");
	}
	else
	{
	$temp_BSVpopulation = $linkInfo->get_population_from_/home/robert/Documents/backups/Central_by_slot($cat_id, number_format($value , 8), "BSV");
	}
		
	}elseif (number_format($value , 8) < $this_links_bid ) {
$temp_DMCpopulation = $linkInfo->get_population_from_Central_by_slot($cat_id, number_format($value , 8), "DMC");
if($temp_DMCpopulation ==0){
include('translations/en/cat_has_bids_user_in_pending_status/downgrade.php');
$submit_button_name = "downgrade"; //This value works with any value just don't give it value "purchase"
}
else
{
include('translations/en/cat_has_bids_user_in_pending_status/downgrade_between_highest_and_lowest_has_pop.php');
$submit_button_name = "downgrade"; //This value works with any value just don't give it value "purchase"
}
		$modify_type = "<input type='hidden' name='modify_type' value='downgrade'>";
		$temp_DMCpopulation = $linkInfo->get_population_from_Central_by_slot($cat_id, number_format($value , 8), "DMC");
	} elseif (number_format($value , 8) > $this_links_bid ) {
$temp_DMCpopulation = $linkInfo->get_population_from_Central_by_slot($cat_id, number_format($value , 8), "DMC");
if($temp_DMCpopulation ==0){
include('translations/en/cat_has_bids_user_in_pending_status/upgrade.php');
$submit_button_name = "upgrade";
}
else
{
include('translations/en/cat_has_bids_user_in_pending_status/upgrade_between_highest_and_lowest_has_pop.php');
$submit_button_name = "upgrade";
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

	 $steps_display .= $modify_type;
	$steps_display .= "<input type='hidden' name='C1' value='C1'> ";


	$steps_display .= " - ". $priceslot_label; 

	//$steps_display .= " - <input type='text' name='price' value='".$value."' readonly> <br> USD value $".round($value * $data['USD'],2)." per day. ";
	$steps_display .= " - <input type='text' name='price' value='".$value."' readonly> <br><span class=\"dropt\" style=\"font-size: large;\" title=\".$daily_payment_mouseover.\"> USD value $".round($value * $data['USD'],2)." per day. ";
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
