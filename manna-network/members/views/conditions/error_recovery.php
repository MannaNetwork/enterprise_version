<?php
echo '<h1>Error: There has been an error processing the transaction. Please contact tech support and relay the error code number ';
echo '</h1>';

/* ErrorCode1: generated on buy_price_slots.php
$this_links_bid_status_on_Central = $linkInfo->getUserPriceSlots($user_id, $agent_ID, $link_id, $cat_id, $coin_type);
// returns either "no_bids", "temp_bid", "approved_bid", or "error_detecting_bid"
*/
/*ErrorCode2: generated on buy_price_slots.php
This user has a bid in both temp and subscripts! MN failed somehow to delete from subscripts after a modification or cancellation
//returns JUST the price amount whether bid is in temp or subscribed
	$this_links_bid = $linkInfo->getUsersPriceSlotAmount($user_id, $agent_ID, $link_id, $cat_id, $coin_type);
if(!is_numeric($this_links_bid)){
$pieces = explode("|", $this_links_bid);
include('conditions/error_recovery.php');
echo "<h1>error code:2</h1>";
*/
?>
