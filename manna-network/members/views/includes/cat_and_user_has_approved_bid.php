<?php
if($debug=="2")
echo '<br>in cat_and_user_has_approved_bid.php';
include('translations/en/cat_and_user_has_approved_bid/welcome_message.php');


//this one gets the rank from the database table but was checking local (i.e. the enterprise database). That is wrong. It needs to check on central which uses the same function used on buy_price_slot page - the getUserPriceSlotsFromCentral function. It returns an array of both DMC and BSV bids though. the script then explodes that array and calls the 
$this_links_bid_string = $linkInfo->getBidByLinkID($link_id, $coin_type);
$pieces=explode("|", $this_links_bid_string);
$this_links_bid = $pieces[0];
$this_links_rank = $pieces[1];

	$current_index_of_lowestpriceslot = $linkInfo->get_current_index_of_priceslot( $lowestpriceslot);
	$current_index_of_highestpriceslot = $linkInfo->get_current_index_of_priceslot( $highestpriceslot);
if($debug=="2"){

echo '<br>$current_index_of_lowestpriceslot = ', $current_index_of_lowestpriceslot;
echo '<br>$current_index_of_highestpriceslot = ', $current_index_of_highestpriceslot;

}
	$current_index_of_daily_minimum_bid_target = $linkInfo->get_current_index_of_daily_minimum_bid_target($daily_minimum_bid_target);
        $current_index_of_this_users_bid = $linkInfo->get_current_index_of_priceslot($this_links_bid);
//this page is working on ORG, not on ask and this logic seems screwy?
//We know the page has to display from the highest to the lowest no matter what this links bid is!
/*if($daily_minimum_bid_target < $this_links_bid){
  $current_index_of_daily_minimum_bid_target = $linkInfo->get_current_index_of_daily_minimum_bid_target($daily_minimum_bid_target);
  $current_index_of_this_users_bid = $linkInfo->get_current_index_of_priceslot($this_links_bid);
   $steps = $linkInfo->get_price_slots_by_minmaxindex($current_index_of_this_users_bid, $current_index_of_daily_minimum_bid_target, $number_of_extra_price_slots);
  }
  elseif($daily_minimum_bid_target > $this_links_bid){
  $current_index_of_lowestpriceslot = $linkInfo->get_current_index_of_priceslot( $this_links_bid);
  $current_index_of_daily_minimum_bid_target = $linkInfo->get_current_index_of_daily_minimum_bid_target($daily_minimum_bid_target);
  //now get the price of the new lowest price
   $new_lowest_price = $linkInfo->get_price_of_an_index($current_index_of_daily_minimum_bid_target);
  $current_index_of_this_users_bid = $linkInfo->get_current_index_of_priceslot($this_links_bid);
  $steps = $linkInfo->get_price_slots_by_minmaxindex($current_index_of_daily_minimum_bid_target,$current_index_of_this_users_bid,  $number_of_extra_price_slots);
  }
  else
  {
  $steps = $linkInfo->get_price_slots_no_bids( $daily_minimum_bid_target, $number_of_extra_price_slots);
  }
*/
$steps = $linkInfo->get_price_slots_by_minmaxindex($current_index_of_highestpriceslot,$current_index_of_daily_minimum_bid_target,  $number_of_extra_price_slots);

$steps_display ='<div style=" width: 80%;
  margin: 0 auto;"><table style="border-collapse: collapse; table-layout:fixed;" cellpadding="40" >';
$steps_display .= '<tr><td colspan=4>'.$welcome_message.'</td></tr>';
if(isset($_POST['volatility_modeler'])){
$steps_display .= "<tr  style='color:red;' ><td colspan=2> <h3>".$crypto_coin_header.": $".$data['USD'].$bsv_volatility_on.'</h3></td><td  colspan=2>'.$volatility_modeler.'</td></tr>';
}
else
{
$steps_display .= "<tr><td colspan=2> <h3>".$crypto_coin_header.": $".$data['USD'].'</h3></td><td  colspan=2>'. $volatility_modeler.'</td></tr>';
}
//$steps_display .= "<tr><td colspan=4><h3>line 58 ".BUY_2ND_PAGE_HASBIDS1."</h3></td></tr>";

$steps = array_reverse($steps);
$count_of_priceslots = count($steps);
$count_of__populated_priceslots = count($steps) ;
$lowest_bid_index = $count_of_priceslots-1;
//BLOCKT_UPGRADE_TERMS
foreach($steps as $key=>$value){
//we use these next two vars as comparison operators in the include message pages. They aren't used on this page but do NOT delete assuming they are unused!
$price_slot_amount = number_format($value , 8);
$this_links_fee = number_format($this_links_bid , 8);
$pop_count_in_price = $linkInfo->getPricePopByCat($cat_id, $price_slot_amount, $coin_type);
	   //we can't know their rank compared to other temps yet but can find the total purchased already
// we can either post that in the message and/or right column but we'll also handled it in the include

if($debug=="2"){
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

if(number_format($this_links_bid , 8) == number_format($new_lowest_price)){
	if($pop_count_in_price >0){
	  include('translations/en/cat_and_user_has_approved_bid/user_is_lowest_price_slot.php_with_comp.php');
	}
	else
	{
	  include('translations/en/cat_and_user_has_approved_bid/user_is_lowest_price_slot_no_comp.php');
	}
}
	else
	{
	//echo '<h3> in if line 53</h3>';
	//include('translations/en/cat_and_user_has_approved_bid/user_is_both_highest_and_medium_price_slot.php');
if($pop_count_in_price >0){
	  include('translations/en/cat_and_user_has_approved_bid/user_is_both_highest_and_medium_price_slot_with_comp.php');
	}
	else
	{
	  include('translations/en/cat_and_user_has_approved_bid/user_is_both_highest_and_medium_price_slot_no_comp.php');
	}



	}
//$this_links_rank_json = $linkInfo->get_rank_of_bidder($link_id, $agent_ID,$cat_id, $coin_type, number_format($this_links_bid , 8));
$this_links_rank = $linkInfo->get_rank_of_bidder_by_price(number_format($this_links_bid , 8), $remote_link_id, $agent_ID,$cat_id, $coin_type);
   	echo '<br>$this_links_rank = ', $this_links_rank_json;
	
	//temp setting waiting for above function to work
	$this_links_rank = 5;
}
elseif (number_format($value , 8) < number_format($this_links_bid , 8)) {
//we know its not the lowest - it must be highest (even when lowest it is highest (it is the sole bid) but we can offer downgrading to it
	//include('translations/en/this_user_only_live_bid/downgrade_with_no_pop_slots.php');
if($pop_count_in_price >0){
	  include('translations/en/cat_and_user_has_approved_bid/downgrade_with_comp.php');
	}
	else
	{
	  include('translations/en/cat_and_user_has_approved_bid/downgrade_no_comp.php');
	}
	

}
elseif (number_format($value , 8)  == number_format($highestpriceslot , 8))  {
// will always be populated if($price_slot_amount>0){ make a switch to display a metches message instead of empty
// there could be more than one
//if the highest bid and lowest BID (don't confuse lowest bid with lowest priceslot) are the same then this will operate too
//but the message of highest bid should explain the situation best. If not, might need another conditional statement and message page
if($debug=="2"){
echo '<br>$key = ', $key;
echo '... ... ... $value = ', $value;
echo '<br>$lowest priceslot = ', number_format($lowestpriceslot , 8);
echo '<br>$highwest priceslot = ', number_format($highestpriceslot , 8);
echo '<br>line 109 insert wrong button using highest_with_pop_slots.php';
}
if($pop_count_in_price > 1){
	//if($pop_count_in_price > 1){ make messages accordingly else make a message about many in priceslot
	include('translations/en/cat_has_bids_user_none/highest_with_pop_slots.php');
	}
	elseif($pop_count_in_price == 1){
	//if($pop_count_in_price > 1){ make messages accordingly - make a message about 1 in priceslot
	include('translations/en/cat_has_bids_user_none/highest_with_pop_slots.php');
	}
	//else	//no population - would never happen will use the defaults loaded earlier from buy_price slot.php
	
	}
else 
{  //is an empty, the two top slots
//include('translations/en/cat_and_user_has_approved_bid/upgrade_no_pop_slots.php');
if($pop_count_in_price >0){
	  include('translations/en/cat_and_user_has_approved_bid/upgrade_with_comp.php');
	}
	else
	{
	  include('translations/en/cat_and_user_has_approved_bid/upgrade_no_comp.php');
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

	//fill in the population reports in the right column
	if($key >1){//note: first two slots always are empty
		//$dmc_array = $bsv_dmc_pieces[0];
		//$pop_count_in_price$price_to_send_pieces = explode(",",$bsv_dmc_pieces[1]);
		$populationBSV = $linkInfo->getPricePopByCat($cat_id, number_format($value , 8), 'BSV');
		$steps_display .= '<br>'.$crypto_coin_label.': '.$populationBSV.'<br>'.$demo_coin_label.':  '.$pop_count_in_price;


if(isset($this_links_rank)AND number_format($value , 8) == number_format($this_links_bid , 8)){
 $steps_display .= '<br>'.DMC_RANK_TITLE;
 $steps_display .= '<br>'.$this_links_rank;
}
 $steps_display .= '</td></tr>';
	}
	else//top two will never have population
	{
		$steps_display .= '<br>'.$crypto_coin_label.': 0<br>'.$demo_coin_label.': 0';
if(isset($this_links_rank)AND number_format($value , 8) == number_format($this_links_bid , 8)){
 $steps_display .= '<br>'.DMC_RANK_TITLE;
 $steps_display .= '<br>'.$this_links_rank;
}
 $steps_display .= '</td></tr> ';
	}

}




}


?>
