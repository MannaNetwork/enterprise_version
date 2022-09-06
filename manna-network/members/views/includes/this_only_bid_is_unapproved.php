<?php
f($debug=="2"){
echo '<br>in this_only_bid_is_unapproved.php ';
echo '<br>';
print_r($_POST);
}

 include('translations/en/this_only_bid_is_unapproved/common.php');
if(isset($_POST['volatility_modeler'])){
  include('translations/en/this_only_bid_is_unapproved/user_modeler.php');
}
else
{
  include('translations/en/this_only_bid_is_unapproved/user_normal.php');
}
$this_links_bid_string = $linkInfo->getBidByLinkID($link_id, $coin_type);
$pieces=explode("|", $this_links_bid_string);
$this_links_bid = $pieces[0];
$this_links_rank = $pieces[1];

if($daily_minimum_bid_target < $this_links_bid){
//This is when the BSV price has had a price drop after the buyer has bought. It will create two priceslots above and as many of them below to reach the minumum
$current_index_of_daily_minimum_bid_target = $linkInfo->get_current_index_of_daily_minimum_bid_target($daily_minimum_bid_target);
$current_index_of_this_users_bid = $linkInfo->get_current_index_of_priceslot($this_links_bid);
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
$steps_display .= "<tr  style='color:red;' ><td colspan=2> <h3>".$crypto_coin_header.": $".$data['USD'].$bsv_volatility_on.'</h3></td><td  colspan=2>'.$volatility_modeler.'</td></tr>';
}
else
{
$steps_display .= "<tr><td colspan=2> <h3>".$crypto_coin_header.":".$data['USD'].'</h3></td><td  colspan=2>'. $volatility_modeler.'</td></tr>';
}


$steps = array_reverse($steps);
$count_of_priceslots = count($steps);
$count_of__populated_priceslots = count($steps) ;
foreach($steps as $key=>$value){
if (number_format($value , 8) == number_format($this_links_bid , 8)) {
include('translations/en/this_only_bid_is_unapproved/user_normal.php');
	}
elseif (number_format($value , 8) < number_format($this_links_bid , 8)) {
	include('translations/en/this_only_bid_is_unapproved/downgrade.php');
	}
 elseif (number_format($value , 8) > number_format($this_links_bid , 8)) {
include('translations/en/this_only_bid_is_unapproved/upgrade.php');	
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
<input type='hidden' name='C1' value='C1'> 
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
$steps_display .= '<br>'.$crypto_coin_label.': 0<br>'.$demo_coin_label.': 0</td></tr> ';
}

}
?>
