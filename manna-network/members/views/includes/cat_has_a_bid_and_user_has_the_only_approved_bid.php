<?php
echo '<br>debug = ', $debug;
if($debug=="2")
echo '<br>cat_has_a_bid_and_user_has_the_only_approved_bid.php';




echo '<br>in iinclude';
exit();

$this_links_bid_string = $linkInfo->getBidByLinkID($link_id, $coin_type);
$pieces=explode("|", $this_links_bid_string);
$this_links_bid = $pieces[0];
$this_links_rank = $pieces[1];
if($daily_minimum_bid_target < $this_links_bid){
//This is when the BSV price has had a price drop after the buyer has bought. It will create two priceslots above and as many of them below to reach the minumum
$current_index_of_daily_minimum_bid_target = $linkInfo->get_current_index_of_daily_minimum_bid_target($daily_minimum_bid_target);
$current_index_of_this_users_bid = $linkInfo->get_current_index_of_priceslot($this_links_bid);
if($debug=="2"){
echo '<br> $current_index_of_this_users_bid = ', $current_index_of_this_users_bid;
echo '<br> $current_index_of_daily_minimum_bid_target = ', $current_index_of_daily_minimum_bid_target;
echo '<br>  $number_of_extra_price_slots = ', $number_of_extra_price_slots;


}
 $steps = $linkInfo->get_price_slots_by_minmaxindex($current_index_of_this_users_bid, $current_index_of_daily_minimum_bid_target, $number_of_extra_price_slots);
//we need to determine if this user's bid is above the current minimum bid target or not (they may have bought it before a price drop)? If the price spiked that info won't affect the list (i.e. $steps array) of THIS price slots display  
}
elseif($daily_minimum_bid_target > $this_links_bid){
//This is when the BSV price has had a price go down after the buyer has bought. It will raise the minimum target price (which is higher than this users bid). We will warn the user that theirs is below the minimum. They can still maintain the position but all future bidders will all be paying more and push them down.

$current_index_of_lowestpriceslot = $linkInfo->get_current_index_of_priceslot( $this_links_bid);
	$current_index_of_daily_minimum_bid_target = $linkInfo->get_current_index_of_daily_minimum_bid_target($daily_minimum_bid_target);
//now get the price of the new lowest price
$new_lowest_price = $linkInfo->get_price_of_an_index($current_index_of_daily_minimum_bid_target);

$current_index_of_this_users_bid = $linkInfo->get_current_index_of_priceslot($this_links_bid);
 $steps = $linkInfo->get_price_slots_by_minmaxindex($current_index_of_daily_minimum_bid_target,$current_index_of_this_users_bid,  $number_of_extra_price_slots);
//we need to determine if this user's bid is above the current minimum bid target or not (they may have bought it before a price drop)? If the price spiked that info won't affect the list (i.e. $steps array) of THIS price slots display  
}
else
{
$steps = $linkInfo->get_price_slots_no_bids( $daily_minimum_bid_target, $number_of_extra_price_slots);
}
if($hi_low_string != "No Bids"){
//population for reporting 
$population_array = $linkInfo->get_population_from_Central($cat_id, $hi_low_string);
$population_array =json_decode($population_array, true);
}
//there are already bids in the category
$steps_display ='<div style=" width: 80%;
  margin: 0 auto;"><table style="border-collapse: collapse; table-layout:fixed;" cellpadding="40"><tr><td colspan=4>';
$steps_display .= "<tr><td colspan=4><h3>". $welcome_message ."</h3></td></tr>";
//$steps_display .= BUY_2ND_PAGE_HEADER. "</td></tr><tr><td colspan=2> <h3>".BSV_PRICE_TITLE.":".$data['USD'].'</h3></td><td  colspan=2>'. $volatility_modeler.'</td></tr>';
if(isset($_POST['volatility_modeler'])){
$steps_display .= "<tr  style='color:red;' ><td colspan=2> <h3>".BSV_PRICE_TITLE.": $".$data['USD'].BSV_PRICE_TITLE_VOLATILE.'</h3></td><td  colspan=2>'.$volatility_modeler.'</td></tr>';
}
else
{
$steps_display .= "<tr><td colspan=2> <h3>".BSV_PRICE_TITLE.": $".$data['USD'].'</h3></td><td  colspan=2>'. $volatility_modeler.'</td></tr>';
}
$steps_display .= BUY_2ND_PAGE_HASBIDS1;

$steps = array_reverse($steps);
$count_of_priceslots = count($steps);
$lowest_bid_index = $count_of_priceslots-1;
$count_of_populated_priceslots = count($steps) ;
foreach($steps as $key=>$value){
$price_slot_amount = number_format($value , 8);
$this_links_fee = number_format($this_links_bid , 8);
$pop_count_in_price = $linkInfo->getPricePopByCat($cat_id, $price_slot_amount, $coin_type);
//echo '<br>$key = '.$key.'      $lowest_bid_index == '.$lowest_bid_index;
if($debug=="1"){
echo '<br>number_format($value , 8) = ', number_format($value , 8);
echo '<br> number_format($this_links_bid , 8)) ', number_format($this_links_bid , 8);
}

//since this link is the only live bid we know:
// 1) there is one populated priceslot
// 2) it has to be this bidder
// 3) if the lowest one isn't populated then this user must be in a higher one
// 4) the highest bid is the same as the users (they are the only bid)
//// 5) the lowest bid is the same as the users (they are the only bid)
//so if we determine that first, and if not this links slot then the rest would be higher, unpopulated

if (number_format($value , 8) == number_format($this_links_bid , 8)) {
if($debug=="1"){
echo '<br>IN section where equal - if (number_format($value , 8) == number_format($this_links_bid , 8)) {';
echo '<br>number_format($value , 8) = ', number_format($value , 8);
echo '<br> number_format($this_links_bid , 8)) ', number_format($this_links_bid , 8);
}
if(number_format($this_links_bid , 8) == number_format($new_lowest_price)){
	include('translations/en/this_user_only_live_bid/user_is_lowest_price_slot.php');
	}
	else
	{
	//echo '<h3> in if line 53</h3>';
	include('translations/en/this_user_only_live_bid/user_is_both_highest_and_medium_price_slot.php');
	}
}
elseif (number_format($value , 8) < number_format($this_links_bid , 8)) {
//we know its not the lowest - it must be highest (even when lowest it is highest (it is the sole bid) but we can offer downgrading to it
	include('translations/en/this_user_only_live_bid/downgrade_with_no_pop_slots.php');
	}
else 
{  //is an empty, the two top slots
include('translations/en/this_user_only_live_bid/upgrade_no_pop_slots.php');
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
";

$steps_display .= " - ". $crypto_coin_header; 

$steps_display .= " - <input type='text' name='price' value='".$value."' readonly> <br> USD value $".round($value * $data['USD'],2)." per day. ";

$steps_display .= $message;



if(isset($_POST['volatility_modeler'])){
$steps_display .= '<h5>Price Slot Selection Deactivated<br>While In Modeller Mode</h5>';
}
else
{
if (number_format($value , 8) == number_format($this_links_bid , 8)) {
$steps_display .= '<div class="wrapper">   
      <span class="button"><button class="'.$submit_button_name.'" name="'.$submit_button_name.'"  />'.$button.'</span></div>';

}
else
{
$steps_display .= '<div class="wrapper">   
      <span class="button"><button class="'.$submit_button_name.'" name="'.$submit_button_name.'"  />'.$button.'</span></div>';

}
$steps_display .= '</td></form></td><td style="vertical-align: text-top;"><h5>'.$population.'</h5>';
if($key >1){//note: first two slots always are empty
		$dmc_array = $bsv_dmc_pieces[0];
		$price_to_send_pieces = explode(",",$bsv_dmc_pieces[1]);
		$population = $linkInfo->getPricePopByCat($cat_id, $price_to_send_pieces[1], 'BSV');
		$steps_display .= '<br>'.$crypto_coin_label.': '.$population.'<br>'.$demo_coin_label.':  '.$pop_count_in_price.'</td></tr>
';
	}
	else//top two will never have population
	{
		$steps_display .= '<br>'.$crypto_coin_label.': 0<br>'.$demo_coin_label.': 0</td></tr> ';
	}
}




}


?>
