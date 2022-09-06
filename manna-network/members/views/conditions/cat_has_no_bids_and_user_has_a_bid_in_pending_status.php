<?php

if($debug=="2"){
echo '<br>in cat_has_no_bids_and_user_has_a_bid_in_pending_status.php ';
echo '<br>';
print_r($_POST);
echo '<br>GET =';
print_r($_GET);
}
include('translations/en/en.js');//java script constants
 include('translations/en/cat_has_no_bids_and_user_has_a_bid_in_pending_status/common.php');
/*if(isset($_POST['volatility_modeler'])){
  include('translations/en/cat_has_no_bids_and_user_has_a_bid_in_pending_status/user_modeler.php');
}
else
{ */
  include('translations/en/cat_has_no_bids_and_user_has_a_bid_in_pending_status/user_normal.php');
//}

include('js/buy_price_slots.js');

if($debug=="2"){
echo '<br>chnbauhabips if($daily_minimum_bid_target < $this_links_bid){ ';
echo '<br> $daily_minimum_bid_target = ', $daily_minimum_bid_target;
echo '<br> $this_links_bid = ', $this_links_bid;
echo '<br> It would have to get this value before this page is included $hi_low_string = ', $hi_low_string;

}
if($daily_minimum_bid_target < $this_links_bid){
//This is when the BSV price has had a price drop after the buyer has bought. It will create two priceslots above and as many of them below to reach the minumum
$current_index_of_daily_minimum_bid_target = $linkInfo->get_current_index_of_daily_minimum_bid_target($daily_minimum_bid_target);
$current_index_of_this_users_bid = $linkInfo->get_current_index_of_priceslot($this_links_bid);


if($location_id > 0){
//CREATE A NEW FUNCTION TO GET STEPS VAR BY REGION
//In this regional version, we will only need to present higher bids in the region. Since this is not applicable when there are no other bids we need to move everything here regarding Regions (i.e. the dropdown) to the other conditions pages and remove from this one. But why are there no other approved bids in this category? It is in cat 60
 $steps = $linkInfo->get_price_slots_by_minmaxindex($current_index_of_this_users_bid, $current_index_of_daily_minimum_bid_target, $number_of_extra_price_slots);
}
else
{
$steps = $linkInfo->get_price_slots_by_minmaxindex($current_index_of_this_users_bid, $current_index_of_daily_minimum_bid_target, $number_of_extra_price_slots);
}
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
/*$steps_display .= "<tr><td colspan=4><h3 style ='font-weight: bold; background-color: #bbff0077;padding: 10px;'>". $website_approval_pending_message ."</h3></td></tr><tr style="border-bottom: 1px solid #000;"<td colspan="3"><br></td></tr>";

}

$steps_display ='<div style=" width: 80%;
  margin: 0 auto;"><table style="border-collapse: collapse; table-layout:fixed;" cellpadding="40"><tr><td colspan=4>';
$steps_display .= '<tr><td colspan=4><h3>'. $welcome_message .'</h3></td></tr><tr style="border-bottom: 1px solid #000;"<td colspan="3"><br></td></tr>';
*/
$steps_display .= '<tr><td colspan=4><h3 style ="font-weight: bold; background-color: #bbff0077;padding: 10px;">'. $temp_bid_message .'</h3></td></tr><tr style="border-bottom: 1px solid #000;"<td colspan="4"><br></td></tr>';
if($isLinkApproved == "no"){
include('translations/en/not_reviewed.php');
$steps_display .= "<tr><td colspan=4><h3>". $pending_review_message ."</h3></td></tr>";
}
$steps_display .= " <tr><td> <h3 style='font-weight: bold; background-color: #bbff0077; padding: 10px;' >".$crypto_coin_header.":".$data['USD'].'</h3></td><td padding=10><h5>BSV Balance: '. ltrim($users_balances[0], '0').'</h5> </td><td padding=10 colspan=2><h5>Demo Coin Balance: '. ltrim($users_balances[1], '0').'</h5></td></tr>';
//}
//we don't have to do population checks or queries because cat has no bids so we can use presets except for the display of this links population (which will make it 1) $temp_DMCpopulation = 0; $temp_BSVpopulation = 0;

$steps = array_reverse($steps);
$count_of_priceslots = count($steps);
$count_of__populated_priceslots = count($steps) ;
foreach($steps as $key=>$value){
if (number_format($value , 8) == number_format($this_links_bid , 8)) {
include('translations/en/cat_has_no_bids_and_user_has_a_bid_in_pending_status/user_normal.php');
$modify_type = "<input type='hidden' name='modify_type' value='cancel'>";

if($coin_type == "DMC"){
$temp_DMCpopulation = 1;
$temp_BSVpopulation = 0;
}
else
{
$temp_DMCpopulation = 0;
$temp_BSVpopulation = 1;
}
	}
elseif (number_format($value , 8) < number_format($this_links_bid , 8)) {
	include('translations/en/cat_has_no_bids_and_user_has_a_bid_in_pending_status/downgrade.php');
$modify_type = "<input type='hidden' name='modify_type' value='downgrade'>";

$temp_DMCpopulation = 0;
$temp_BSVpopulation = 0;
	}
 elseif (number_format($value , 8) > number_format($this_links_bid , 8)) {
include('translations/en/cat_has_no_bids_and_user_has_a_bid_in_pending_status/upgrade.php');
$modify_type = "<input type='hidden' name='modify_type' value='upgrade'>";

$temp_DMCpopulation = 0;
$temp_BSVpopulation = 0;	
	} 
 $option_name = $key + 1;
$steps_display .= '<tr><td colspan="4"><h3 style="font-weight:bold;">Bid Option # '.$option_name.'</h3></td></tr>';
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
<input type='hidden' name='old_price' value='".$this_links_bid."'>
<input type='hidden' name='users_balances_string' value='".$users_balances_string."'> 
<input type='hidden' name='this_links_bid_status_on_Central' value='".$this_links_bid_status_on_Central."'>";




 $steps_display .= $modify_type;
$steps_display .= "<br><input type='hidden' name='C1' value='C1'> 
";
 $steps_display .= $modify_type;
$steps_display .= "<br><input type='hidden' name='C1' value='C1'> 
";

$steps_display .= " - ". $price_slot_amount_label; 

$steps_display .= " - <input type='text' name='price' value='".$value."' readonly> <br> USD value $".round($value * $data['USD'],2)." per day. ";

$steps_display .= $temp_bid_message;
/*if(isset($_POST['volatility_modeler'])){
$steps_display .= '<h5>Price Slot Selection Deactivated<br>While In Modeller Mode</h5>';
}
else
{ */
if (number_format($value , 8) == number_format($this_links_bid , 8)) {
$steps_display .= '<div class="wrapper">   
      <span class="mnbutton"><button class="'.$submit_button_name.'" name="'.$submit_button_name.'"  />'.$button.'</span></div>';

}
else
{
$steps_display .= '<div class="wrapper">   
      <span class="mnbutton"><button class="'.$submit_button_name.'" name="'.$submit_button_name.'"  />'.$button.'</span></div>';
}
 $steps_display .= '</form></td>';
 if(isset($price_slot))
    {
       include(dirname( __FILE__, 2 ).'/includes/right_column.php');
      }
      else
      {//means there are no bids in category yet
     include(dirname( __FILE__, 3 ).'/translations/en/common_no_bids.php');
      if($key==0){
     $steps_display .=  $terms_of_placement1;
      }
      elseif($key==1){
      $steps_display .=  $terms_of_placement2;
      }
      elseif($key==2)
      {
      $steps_display .=  $terms_of_placement3;
      }
      }      
      
}
?>
