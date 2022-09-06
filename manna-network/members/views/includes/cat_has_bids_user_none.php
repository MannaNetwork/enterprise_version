<?php 

if($debug=="2")
echo '<h4> zzzzzzz  In includes/cat_has bids_user none.php using files in translations/cat_has bids_user none</h4>';

	if(isset($lowest_price_bought) and isset($highest_price_bought)){
	   if($lowest_price_bought == $highest_price_bought){
		$steps = $linkInfo->get_price_slots($highest_price_bought, $daily_minimum_bid_target, $number_of_extra_price_slots);
		}
		else
		{
		$steps = $linkInfo->get_price_slots_no_bids($daily_minimum_bid_target, $number_of_extra_price_slots);
	       }
        }
	else
	{
	$steps = $linkInfo->get_price_slots_no_bids($daily_minimum_bid_target, $number_of_extra_price_slots);
	}
include('translations/en/cat_has_bids_user_none/welcome_message.php');
$steps_display ='<div style=" width: 80%;
  margin: 0 auto;"><table style="border-collapse: collapse; table-layout:fixed;" cellpadding="40">';
$steps_display .= "<tr><td colspan=4>". $welcome_message ."</td></tr>";
if(isset($_POST['volatility_modeler'])){
$steps_display .= "<tr  style='color:red; border: solid thin;' ><td colspan=2> <h3>".$crypto_coin_header.": $".$data['USD'].$bsv_volatility_on.'</h3></td><td  colspan=2>'.$volatility_modeler.'</td></tr>';
}
else
{
$steps_display .= "<tr style='border: solid thin;'><td colspan=2 > <h3>".$crypto_coin_header.": $".$data['USD'].'</h3></td><td  colspan=2>'. $volatility_modeler.'</td></tr>';
}
$steps = array_reverse($steps);
$lowest_bid_index = count($steps)-1;//There will always be a varying number of bids in a category but we know that the last one (now that we reversed them) will always be the lowest price slot - we will use this only to be able to display a special message for it.
$highest_bid_with_population = $lowest_bid_index - $number_of_extra_price_slots;

foreach($steps as $key=>$value){
$price_slot_amount = number_format($value , 8);
$pop_count_in_price = $linkInfo->getPricePopByCat($cat_id, $price_slot_amount, $coin_type);
if($debug=="2"){
echo '<br>$key = ', $key;
echo '... ... ... $value = ', $value;
echo '<br>$lowest priceslot = ', number_format($lowestpriceslot , 8);
echo '<br>$highwest priceslot = ', number_format($highestpriceslot , 8);

}



// This code caused mis catagroeization after the current highest AND lowest price slot when high and low wwere the same price
//the following section does the same as line 118
/*if($lowest_bid_index == $key){
if($debug=="2"){
echo '<br>IN section where $lowest_bid_index == $key';
echo '<br>This is basically the same as if(number_format($value , 8) = \', number_format($lowestpriceslot , 8)';
echo '<br>Then proceeds to perform check for population';

}
if($pop_count_in_price > 1){

	//if($pop_count_in_price > 1){ make messages accordingly else make a message about many in priceslot
	include('translations/en/cat_has_bids_user_none/lowest_with_pop_slots.php');
	}
	elseif($pop_count_in_price == 1){
	//if($pop_count_in_price > 1){ make messages accordingly - make a message about 1 in priceslot
	include('translations/en/cat_has_bids_user_none/lowest_with_pop_slots.php');
	}elseif($pop_count_in_price == 0){
	//if($pop_count_in_price > 1){ make messages accordingly - make a message about 1 in priceslot
	include('translations/en/cat_has_bids_user_none/lowest_no_pop_slots.php');
	}

}
else
*/
/*
$lowest priceslot = 0.00287630
$highwest priceslot = 0.00287630
flase for next
*/
if (number_format($value , 8)  < number_format($highestpriceslot , 8)  AND number_format($value , 8)  > number_format($lowestpriceslot , 8))  {

// these are middle and may or may not be populated if($price_slot_amount>0){ make a switch to display a metches message instead of empty
// there could be more than one
//if($pop_count_in_price > 1){ make a message accordingly else make a message about 1 in priceslot
if($pop_count_in_price > 0){
	//if($pop_count_in_price > 1){ make messages accordingly else make a message about many in priceslot

	include('translations/en/cat_has_bids_user_none/medium_with_pop_slots.php');
	}
	elseif($pop_count_in_price == 0){
//echo '<h3> in if line 62</h3>';
	//if($pop_count_in_price > 1){ make messages accordingly - make a message about 1 in priceslot
	include('translations/en/cat_has_bids_user_none/medium_no_pop_slots.php');
	}
	//else	//no population - would never happen will use the defaults loaded earlier from buy_price slot.php
 } 
/*
$lowest priceslot = 0.00287630
$highwest priceslot = 0.00287630
true for next despite and disregarding fact is also lowest
*/
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
/*
$lowest priceslot = 0.00287630
$highwest priceslot = 0.00287630
flase for next
*/
elseif (number_format($value , 8)  > number_format($highestpriceslot , 8))  {
if($debug=="2"){
echo '<br>$key = ', $key;
echo '... ... ... $value = ', $value;
echo '<br>$lowest priceslot = ', number_format($lowestpriceslot , 8);
echo '<br>$highwest priceslot = ', number_format($highestpriceslot , 8);
echo '<br>line 126 insert wrong button';
}
include('translations/en/cat_has_bids_user_none/highest_no_pop_slots.php');
}
//highest_with_pop_slots.php
 elseif (number_format($value , 8) == number_format($lowestpriceslot , 8)) {
if($debug=="2"){
echo '<br>$key = ', $key;
echo '... ... ... $value = ', $value;
echo '<br>$lowest priceslot = ', number_format($lowestpriceslot , 8);
echo '<br>$highwest priceslot = ', number_format($highestpriceslot , 8);
echo '<br>line 144 value = lowest. Shouldn\'t fire if there was only one or more bids but in same price slot';
}
//might be populated
// there could be more than one
if($pop_count_in_price > 1){
//if($pop_count_in_price > 1){ make messages accordingly else make a message about many in priceslot
	include('translations/en/cat_has_bids_user_none/lowest_with_pop_slots.php');
	}
	elseif($pop_count_in_price == 1){
//if($pop_count_in_price = 1){ make messages accordingly - make a message about 1 in priceslot
	include('translations/en/cat_has_bids_user_none/lowest_with_pop_slots.php');
	}else{
//if($pop_count_in_price = 1){ make messages accordingly - make a message about 1 in priceslot
	include('translations/en/cat_has_bids_user_none/lowest_no_pop_slots.php');
	}
}
elseif (number_format($value , 8) < number_format($lowestpriceslot , 8) AND $key < $lowest_bid_index) {
if($debug=="2"){
echo '<br>$key = ', $key;
echo '... ... ... $value = ', $value;
echo '<br>$lowest priceslot = ', number_format($lowestpriceslot , 8);
echo '<br>$highwest priceslot = ', number_format($highestpriceslot , 8);
echo '<br>line 166 value = lowest. Should fire for everything under highest and lowest price slot';
}
	//can't be populated
// can't be more than one

	include('translations/en/cat_has_bids_user_none/medium_no_pop_slots.php');
	
}
else //(number_format($value , 8) < number_format($lowestpriceslot , 8 but is NOT the lowest)) 
{
if($debug=="2"){
echo '<br>$key = ', $key;
echo '... ... ... $value = ', $value;
echo '<br>$lowest priceslot = ', number_format($lowestpriceslot , 8);
echo '<br>$highwest priceslot = ', number_format($highestpriceslot , 8);
echo '<br>line 166 value = lowest. Should fire for everything under highest and lowest price slot';
}
	//can't be populated
// can't be more than one
//if($pop_count_in_price == 1){ make a message accordingly else make a message about 1 in priceslot
//if($pop_count_in_price > 1){ make messages accordingly else make a message about many in priceslot

	include('translations/en/cat_has_bids_user_none/lowest_no_pop_slots.php');
	
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
	//insert some CSS code to present a deactivaetded button instead of a message
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

	$steps_display .= '</form></td><td style="vertical-align: text-top;"><h5>'.$population.'</h5>';
	//fill in the population reports in the right column
		if($key >1){//note: first two slots always are empty
			$dmc_array = $bsv_dmc_pieces[0];
			$price_to_send_pieces = explode(",",$bsv_dmc_pieces[1]);
			$population2 = $linkInfo->getPricePopByCat($cat_id, $price_to_send_pieces[1], 'BSV');
			$steps_display .= '<br>'.$crypto_coin_label.': '.$population2.'<br>'.$demo_coin_label.':  '.$pop_count_in_price.'</td></tr>
	';
		}
		else//top two will never have population
		{
			$steps_display .= '<br>'.$crypto_coin_label.': 0<br>'.$demo_coin_label.': 0</td></tr> ';
		}
	}
}

?>
