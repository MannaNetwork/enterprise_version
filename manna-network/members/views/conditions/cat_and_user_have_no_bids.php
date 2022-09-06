<?php

if($debug == 2){
echo '<br>line 3 of cat and user has no bids <br>print_r POST = ';
print_r($_POST);
echo '<br> in user_and_cat_have_no_bids.php';
}
//echo '<br> in //user_and_cat_have_no_bids - dirname( __FILE__, 3 ) = '. dirname( __FILE__, 3 ).'/translations/en/user_and_cat_have_no_bids/common.php';

  include(dirname( __FILE__, 3 ).'/translations/en/common.php');
  include(dirname( __FILE__, 3 ).'/translations/en/user_and_cat_have_no_bids/user_normal.php');

$users_balances_array = explode("|", $users_balances_string);
if($debug=="2"){
//echo '<br>if($daily_minimum_bid_target < $this_links_bid){ ';
//echo '<br> $daily_minimum_bid_target = ', $daily_minimum_bid_target;
//echo '<br> $this_links_bid = ', $this_links_bid; doesn't have one - that's why it is landing on this page
echo '<br> $cat_id = ', $cat_id;
echo '<br> $hi_low_string = ', $hi_low_string;
echo '<br> $users_balances_string (string = ', $users_balances_string;
echo '<br>';
print_r($users_balances_string);
echo '<br> $users_balances_array[0] = ', $users_balances_array[0];
echo '<br> $users_balances_array[1] = ', $users_balances_array[1];
}	
$steps = $linkInfo->get_price_slots_no_bids($daily_minimum_bid_target, $number_of_extra_price_slots);
if($debug == 2){
echo '<br>in cat and user have no bids - steps = ';
print_r($steps);
}

$steps_display ='<div style=" width: 80%;
  margin: 0 auto;"><table style="border-collapse: collapse; table-layout:fixed;" cellpadding="40"><tr><td colspan=4>';
$steps_display .= '<tr><td colspan=4><h3>';
//echo '<h3>in cat and user has no bids line 26 - $_POST[\'location_id\'] value before "if" condition = ';
//echo $_POST['location_id'];
if($_POST['location_id'] > 0){
$steps_display .= $welcome_message_regional ;
}
else
{
$steps_display .= $welcome_message ;
}
$steps_display .= "<tr><td colspan=2> <h3>".$crypto_coin_header.":".$data['USD'].'</h3>';
if($coin_type == "DMC"){
$steps_display .= '<h3>'.$crypto_coin_label." ".$population.": ".$BSVpopulation.'</h3>';
$steps_display.= '<span class="dropt" style="font-size: large;" title="'.$bsv_pop_mouseover.'">'.$bsv_pop_link_title.'<img height="42" width="42" src="views/green_arrow.png">
  <span style="width:500px;">'.$bsv_pop_blockt_message.'</span></span>';
}

$bsv_balance_formatted = explode(".",$users_balances_array[0]);
$dmc_balance_formatted = explode(".",$users_balances_array[1]);

$steps_display .= '</td><td  colspan=2>Your Balance(s): BSV -> 0.'.$bsv_balance_formatted[1].'<br>DMC (i.e. Demo Coin) -> 0.'.$dmc_balance_formatted[1].'</td></tr>';
$steps_display .='</h3></td></tr><tr style="border-bottom: 1px solid #000;"<td colspan="3"><br></td></tr>';
$steps = array_reverse($steps);

foreach($steps as $key=>$value){
if ($key == 0) {
$pre_blockt_text_message = $top_pre_blockt_text_message;
   $message = $blockt_message; //using the same message on user_and_cat_have_no_bids.php. Other pages can have different messages
$button = $top_submit_button_title;
$link_title = $top_link_title;
if($_POST['location_id'] > 0){
//$mouseover = $top_blockt_mouseover;
$mouseover = $top_regional_mouseover;
}
else
{
$mouseover = $top_blockt_mouseover;
}
} elseif ($key == 1) {
$pre_blockt_text_message = $med_blockt_text_message;
     $message = $blockt_message;
$button = $med_submit_button_title;
$link_title = $med_link_title;
$mouseover = $med_blockt_mouseover;
} else{
$pre_blockt_text_message = $low_pre_blockt_text_message;
     $message = $blockt_message;
$button = $low_submit_button_title;
$link_title = $low_link_title;
$mouseover = $low_blockt_mouseover;
}
$option_name = $key + 1;
$steps_display .= '
<tr><td colspan="3"><h3 style="font-weight:bold;">Bid Option # '.$option_name.'</h3></td></tr><tr style="border-bottom: 1px solid #000;"><td><h5>'.$pre_blockt_text_message.'</h5><br>
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
<input type='hidden' name='modify_type' value='purchase'>
<input type='hidden' name='this_links_bid_status_on_Central' value='".$this_links_bid_status_on_Central."'>
<input type='hidden' name='this_links_opposite_bid_status_on_Central' value='".$this_links_opposite_bid_status_on_Central."'>";

$steps_display .= "<input type='text' name='price' value='".$value."' readonly> <br> USD value $".round($value * $data['USD'],2)." per day. ";

$steps_display .= '<div class="wrapper">   
      <span class="mnbutton"><button class="'.$submit_button_name.'" name="'.$submit_button_name.'" >'.$button.'</span></div></td>';
//$steps_display .= '</form></td><td style="vertical-align: text-top;"><h5>'.$population.'</h5>';
//$steps_display .= '<br>'.$crypto_coin_label.': 0<br>'.$demo_coin_label.': 0</td></tr> ';

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
      else
      {
      $steps_display .=  $terms_of_placement3;
      }
      }

}

?>
