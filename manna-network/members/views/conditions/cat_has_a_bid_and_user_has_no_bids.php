<?php
/*echo '<br>Manual debug on in conditions/cat_has_a_bid_and_user_has_no_bids.php';
$debug=2;  */
if($debug=="2"){
echo '<br>in cat_has_a_bid_and_user_has_no_bids.php ';
echo '<p style="color:red;">You are seeing these coding messages because you have Debug turned on in /manna-configs/db_cfg/agent_config.php/</p><br>Post values from form = ';
print_r($_POST);
echo '<br>$isLinkApproved imported from buy_price_slots.php = ', $isLinkApproved;
}
//set the counter of higher paying links
$counter=0; //is tallied in right_column page
$users_balances_array = explode("|", $users_balances_string);
if($debug=="2"){
echo '<br>if($daily_minimum_bid_target < $this_links_bid){ ';
echo '<br> $daily_minimum_bid_target = ', $daily_minimum_bid_target;
echo '<br> $cat_id = ', $cat_id;
echo '<br> $hi_low_string = ', $hi_low_string;
echo '<br> $users_balances_string (string = ', $users_balances_string;
echo '<br>';
print_r($users_balances_string);
echo '<br> $users_balances_array[0] = ', $users_balances_array[0];
echo '<br> $users_balances_array[1] = ', $users_balances_array[1];
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
echo '<br>$steps array (looking for index number) = ';
print_r($steps);
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

$steps_display .= "<tr><td colspan=2> <h3>".$crypto_coin_header.": ".$data['USD'].'</h3>';
if($coin_type == "DMC"){
$steps_display .= '<h3>'.$crypto_coin_label." ".$population.": ".$BSVpopulation.'</h3>';
$steps_display.= '<span class="dropt" style="font-size: large;" title="'.$bsv_pop_mouseover.'">'.$bsv_pop_link_title.'<img height="42" width="42" src="views/green_arrow.png">
  <span style="width:500px;">'.$bsv_pop_blockt_message.'</span></span>';
}
$steps_display .= '</td><td  colspan=2>&nbsp;</td></tr>';

$steps = array_reverse($steps);

if($debug=="2"){
echo '<br>after array reverse - $steps array (looking for index number) = ';
print_r($steps);
}
foreach($steps as $key=>$value){
$countofsteps = count($steps) - 1;
if($debug==2){
echo '<H3>Test to see if this test condition is ever met. if(number_format($value , 8) < number_format($highestpriceslot , 8) AND number_format($value , 8) > number_format($lowestpriceslot , 8) ) {	</h3>';
if(number_format($value , 8) < number_format($highestpriceslot , 8) AND number_format($value , 8) > number_format($lowestpriceslot , 8) ) {	
echo '<br>number_format($value , 8) = ', number_format($value , 8);
echo '<br>number_format($highestpriceslot , 8) = ', number_format($highestpriceslot , 8);
echo '<br>number_format($lowestpriceslot , 8) = ', number_format($lowestpriceslot , 8);
}
else
{
echo 'if(number_format($value , 8) < number_format($highestpriceslot , 8) AND number_format($value , 8) > number_format($lowestpriceslot , 8) ) {	 was not met';
echo '<p style="color:red;">';
echo '<br>number_format($value , 8) = ', number_format($value , 8);
echo '<br>number_format($highestpriceslot , 8) = ', number_format($highestpriceslot , 8);
echo '<br>number_format($lowestpriceslot , 8) = ', number_format($lowestpriceslot , 8);
echo '</p>';

echo '<br>$key (from $steps array) = '.$key.' ...... value = '. $value.'...';
}
}
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
//elseif($key == $index_of_lowest_to_display){
//elseif(number_format($value, 8) == number_format($lowestpriceslot, 8)){
elseif($key == $countofsteps){
include('translations/en/cat_has_a_bid_and_user_has_no_bids/purchase_minimum.php');
$submit_button_name = "Minimum Bid";
$modify_type = "<input type='hidden' name='modify_type' value='purchase'>";
}
elseif(number_format($value , 8) == number_format($highestpriceslot , 8)){
include('translations/en/cat_has_a_bid_and_user_has_no_bids/purchase_equal_to_highest.php');
$modify_type = "<input type='hidden' name='modify_type' value='purchase'>";
$submit_button_name = "Near The Top Position";
}
/*elseif (number_format($value , 8) < number_format($lowestpriceslot , 8)) {
	include('translations/en/cat_has_a_bid_and_user_has_no_bids/purchase_lower_than_lowest.php');
	$modify_type = "<input type='hidden' name='modify_type' value='purchase'>";
$temp_DMCpopulation = 0;
$temp_BSVpopulation = 0;
}
elseif (number_format($value , 8) == number_format($lowestpriceslot , 8)) {
	include('translations/en/cat_has_a_bid_and_user_has_no_bids/purchase_equal_to_lowest.php');
$submit_button_name = "Minimum Bid";
$modify_type = "<input type='hidden' name='modify_type' value='purchase'>";
} */
elseif(number_format($value , 8) < number_format($highestpriceslot , 8) AND number_format($value , 8) > 
number_format($steps[$countofsteps] , 8) ) {	
if($debug==2){
echo '<br>number_format($steps[$countofsteps] should display the lowest priceslot amount. We use it to include either purchase_between_highest_and_lowest_no_pop.php or purchase_between_highest_and_lowest_has_pop.php depending on whether $temp_DMCpopulation == 0). It\'s value currently is ', $temp_DMCpopulation;
}
if($temp_DMCpopulation == 0){
include('translations/en/cat_has_a_bid_and_user_has_no_bids/purchase_between_highest_and_lowest_no_pop.php');
$modify_type = "<input type='hidden' name='modify_type' value='purchase'>";
$submit_button_name = "Medium Bid";
}
else
{
include('translations/en/cat_has_a_bid_and_user_has_no_bids/purchase_between_highest_and_lowest_has_pop.php');
$modify_type = "<input type='hidden' name='modify_type' value='purchase'>";
$submit_button_name = "Medium Bid";
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
<input type='hidden' name='this_links_bid_status_on_Central' value='".$this_links_bid_status_on_Central."'>
<input type='hidden' name='this_links_opposite_bid_status_on_Central' value='".$this_links_opposite_bid_status_on_Central."'>
<input type='hidden' name='price' value='".number_format($value , 8)."'>";

 $steps_display .= $modify_type;
$steps_display .= "<input type='hidden' name='C1' value='C1'> 
";


//$steps_display .= " - ". $crypto_coin_header; 


if($coin_type == 'bsv'){
$steps_display .= "<input type='text' name='price' value='".$value."' readonly /> <br>
<span class=\"dropt\" style=\"font-size: large;\" title=\".$daily_payment_mouseover.\">  USD value $".round($value * $data['USD'],2)." per day. ";
	$num_days_funded = $users_balances_array[0]/$value;
	}
	else
	{
	$num_days_funded = $users_balances_array[1]/$value;
	}
	$steps_display .= '<input type=\'text\' name=\'price\' value=\''.$value.'\' readonly /> <br>
<span class="dropt" style="font-size: large;" title="'.$daily_payment_mouseover.'"><b>'.$daily_payment_message1.$coin_type.$daily_payment_message2.'</b><img height="42" width="42" src="views/green_arrow.png">';
	
	$steps_display .= '<span style="width:500px;">'.$daily_payment_message3.$num_days_funded.$daily_payment_message4;
	if($isLinkApproved=="no"){
	$steps_display .= $daily_payment_message_unreviewed;
		}
	$steps_display .= '</span></span>';
	
$steps_display .= '<div class="wrapper">   
      <span class="mnbutton"><button class="'.$submit_button_name.'" name="'.$submit_button_name.'"  />'.$button.'</span></div>';
 $steps_display .= '</form></td><td style="vertical-align: text-top;">';
  $price_slot = number_format($value, 8);
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
