function howManyRadiosPaid($category, $link_id, $coin_type){

$get_info = new price_slot_info;
$price_slot_info_array = $get_info->getBasePrice();
//id 	is_active 	base_price 	adj_factor 	total_slots 	t_timestamp 
//$price_slot_info_array = $get_info->getPriceSlotGen($category);
$price_slot_timestamp = $price_slot_info_array[5];
$price_slot_log_id = $price_slot_info_array[0];//doesn't seem to be used anywhere
$adj_factor = $price_slot_info_array[3];
$base_price = $price_slot_info_array[2];
$total_slots = $price_slot_info_array[4];
$this_users_last_bought = $get_info->getThisUsersLastBoughtPriceSlot($category, $link_id);
//array = $id, $user_id, $price_slot_amnt
$this_users_id = $this_users_last_bought[0];
$this_users_user_id = $this_users_last_bought[1];
$this_users_price_amnt = $this_users_last_bought[2];
$top_bought_price_array = $get_info->getTopBoughtPriceSlot($category);
$top_buyer_id = $top_bought_price_array[0];
$top_buyer_price_amnt = $top_bought_price_array[1];
$top_buyer_user_id = $top_bought_price_array[2];
$top_buyer_link_id = $top_bought_price_array[3];
$count_of_top_links = $get_info->getCountBoughtSlots($category, $coin_type);

if($adj_factor==""|| $adj_factor==0){
echo '<h2 style="color:red;">adj_factor is empty - there must not be an entry for this category in getBasePrice table', $category;
echo ' which will throw division by zero errors</h2>';
}

$top_buyer_num_of_pages = (log10(intval($top_buyer_price_amnt))-log10($base_price))/log10(1+$adj_factor);
$top_buyer_num_of_pages = round($top_buyer_num_of_pages);
$this_users_num_of_pages = (log10(intval($this_users_price_amnt))-log10($base_price))/log10(1+$adj_factor);
$this_users_num_of_pages = round($this_users_num_of_pages);
$top_buyer_num_of_pages = $top_buyer_num_of_pages +1;
$this_users_num_of_pages = $this_users_num_of_pages +1;
return array($top_buyer_num_of_pages, $this_users_num_of_pages, $count_of_top_links, $top_buyer_link_id);
}

function howManyRadiosFree($category, $link_id){
//this function is missing check  when users current is not equal to one of offered prices (i.e. the price went up/down since they bought it). Something like that need to be added as special admin page. It will have to update every current paid link. Select all freebies and update their amounts and email their users. At end of billing cycle, if no funds or authorization renewed they lose seniority. Probably won't/shouldn't change prices of GEN often as a result of them having to re-authorize ... or, have as part of the registration get their permission to raise or lower a certain percent w/o needing reauthorization

$get_info = new price_slot_info;
$price_slot_info_array = $get_info->getBasePrice();
//id 	is_active 	base_price 	adj_factor 	total_slots 	t_timestamp 

//$price_slot_info_array = $get_info->getPriceSlotGen($category);
//array($timestamp,$id,$adj_factor,$base_price, $Google_price);
$price_slot_timestamp = $price_slot_info_array[5];
$price_slot_log_id = $price_slot_info_array[0];//doesn't seem to be used anywhere
$adj_factor = $price_slot_info_array[3];
$base_price = $price_slot_info_array[2];
$total_slots = $price_slot_info_array[4];
$top_bought_price_array = $get_info->getTopBoughtPriceSlot($category);
//returns $bid_info = array($id, $price_slot_amnt, $user_id, $link_id, $count);
//array = $id, $price_slot_amnt, $user_id, $link_id
//[0] => [1] => 1.20 [2] => 2 [3] => 2523 [4] =>
$top_buyer_id = $top_bought_price_array[0];
$top_buyer_price_amnt = $top_bought_price_array[1];
$top_buyer_user_id = $top_bought_price_array[2];
$top_buyer_link_id = $top_bought_price_array[3];
$count_of_top_links = $get_info->getCountBoughtSlots($category);
if($top_buyer_price_amnt == $base_price)
{
$top_buyer_num_of_slots = 1;
}
else
{
//does the count of links matter? should return them just to post to table data
$top_buyer_num_of_slots = (log10($top_buyer_price_amnt)-log10($base_price))/log10(1+$adj_factor);
$top_buyer_num_of_slots = round($top_buyer_num_of_slots);
$top_buyer_num_of_slots = $top_buyer_num_of_slots +1;
}
return array($top_buyer_num_of_slots,$count_of_top_links);
}

//also need one for demo coin - copied from paid and never was active
 function howManyRadiosDemo($category, $link_id, $coin_type){

$get_info = new price_slot_info;
$price_slot_info_array = $get_info->getBasePrice();
//id 	is_active 	base_price 	adj_factor 	total_slots 	t_timestamp 
//$price_slot_info_array = $get_info->getPriceSlotGen($category);
$price_slot_timestamp = $price_slot_info_array[5];
$price_slot_log_id = $price_slot_info_array[0];//doesn't seem to be used anywhere
$adj_factor = $price_slot_info_array[3];
$base_price = $price_slot_info_array[2];
$total_slots = $price_slot_info_array[4];
$this_users_last_bought = $get_info->getThisUsersLastBoughtPriceSlot($category, $link_id);
//array = $id, $user_id, $price_slot_amnt
$this_users_id = $this_users_last_bought[0];
$this_users_user_id = $this_users_last_bought[1];
$this_users_price_amnt = $this_users_last_bought[2];
$top_bought_price_array = $get_info->getTopBoughtPriceSlot($category);
$top_buyer_id = $top_bought_price_array[0];
$top_buyer_price_amnt = $top_bought_price_array[1];
$top_buyer_user_id = $top_bought_price_array[2];
$top_buyer_link_id = $top_bought_price_array[3];
$count_of_top_links = $get_info->getCountBoughtSlots($category, $coin_type);

if($adj_factor==""|| $adj_factor==0){
echo '<h2 style="color:red;">adj_factor is empty - there must not be an entry for this category in getBasePrice table', $category;
echo ' which will throw division by zero errors</h2>';
}

$top_buyer_num_of_pages = (log10(intval($top_buyer_price_amnt))-log10($base_price))/log10(1+$adj_factor);
$top_buyer_num_of_pages = round($top_buyer_num_of_pages);
$this_users_num_of_pages = (log10(intval($this_users_price_amnt))-log10($base_price))/log10(1+$adj_factor);
$this_users_num_of_pages = round($this_users_num_of_pages);
$top_buyer_num_of_pages = $top_buyer_num_of_pages +1;
$this_users_num_of_pages = $this_users_num_of_pages +1;
return array($top_buyer_num_of_pages, $this_users_num_of_pages, $count_of_top_links, $top_buyer_link_id);
}

