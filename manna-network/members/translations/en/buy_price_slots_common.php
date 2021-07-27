<?php
$confirm_downgrade_message ="<h1>Confirm Your Downgrade!</h1><h2> Your listing will receive a new Bid Seniority timestamp as well as being in a lower price slot. Ads are displayed first by price slot amount and then by their seniority (i.e. date/time that their respective price slots were purchased).  </h2>";
$confirm_upgrade_message ="<h1>Confirm Your Upgrade!</h1><h2> Your listing will also receive a new Bid Seniority timestamp. Your new position in the display may be affected slightly by seniority. Ads are displayed first by price slot amount and then by their seniority (i.e. date/time that their respective price slots were purchased).</h2>";
$regional_mouseover = "Info on how to use the regions filtering tool";
$regional_link_title = 'INFO ABOUT REGIONAL BIDDING';
$regional_dropdown_message = 'Select the region from the dropdown that you are most interested in reaching with your ad (leave empty if you wish to compete on the global level). The "tentative" rankings that each bid will likely get in that locationare reported in the right column. The ranking reported will filter out competing advertisers and bidders from other regions and locations and you will see the ranking you will achieve in that location! For an example, while the minimum bid might place you really low in the display page competing at the more expensive global level you could be displayed in the #1 spot in your city!';
define("WORDING_REGIONAL_MENU", "Rank By Location Filters");
define("SUCCESSFUL_BID_SUBMISSION1", "<h1>Thank you!</h1> 
<h4  style='text-align:left;'>The transaction has been recorded here at your agent site and also has been sent along to Manna Network to be compared with all other bids. They will be ordered highest to lowest and by seniority (i.e. according to when bought). The purchase will initiate a subscription with regular automatic daily deductions from your appropriate \"prepaid\" account (i.e. either Bitcoin or Demo coin as you have selected). The daily fee will be deducted from this point forward until any of the following: 1) cancelled by you 2) you change the price slot (doing so resets your seniority in the new price slot) or 3) there is insufficient funds in your account.</h4><h4><a href='index.php'>Return to your Member Dashboard</a>");
	 
define("SUCCESSFUL_BID_SUBMISSION2", "<h4>Your seniority date for this price slot is :");

define("BSV_VOLATILITY_MODELLER_HIGHER","Higher BSV Price");//used in the dropdown
define("BSV_VOLATILITY_MODELLER_LOWER","Lower BSV Price");//used in the dropdown
define("BSV_VOLATILITY_MODELLER_RESTORER","Restore Current BSV Price");//used in the dropdown
define("BSV_PRICE_TITLE_VOLATILE","<h5>YOU ARE OPERATING IN MODELLER MODE<BR>NO BIDS OR CHANGES ARE ENABLED<BR>SELECT THE RESTORE OPTION IN THE DROPDOWN TO THE RIGHT TO RETURN TO NORMAL</h5>");
define("BSV_PRICE_TITLE","Current BSV PRICE");
define("BLOCKT_INPUT_LABEL","Price slot amount");//on every section except buy_section1.php

define("MINIMUM_EXPLAINED1", "<h3>How we establish minimum bid (i.e. price slot) prices:</h3>Crypto currencies are known for their volatility and our unique bidding system helps take some of the sting out of price swings. We enable bids to start between ");
define("MINIMUM_EXPLAINED2", " worth of BitcoinSV (BSV) per month. We also offer a Demo Mode (which mimics the BSV system and uses the same bidding system and \"prices\" but uses free \"Demo Coin\"). Placing bids using Demo Coin also generates commissions in Demo Coin (which our members [sic. those with a Manna Network directory installed] can use to make their own purchases of better placement).<p>&nbsp</p><p>We charge on a per day basis and set the lowest price slot displayed to between ");//$5 

define("MINIMUM_EXPLAINED3", " worth of BitcoinSV to achieve a monthly fee between those amounts. The lowest available bid ("); 
define("MINIMUM_EXPLAINED4", ") represents the amount of BSV at current prices to be worth between ");//$5
define("MINIMUM_EXPLAINED5", " per month advertising expense (take the price slot daily fee posted at each price slot times 30 days times the current BSV price to check for yourself). Each higher price slot offered is incremented at one and a half times the previous price slot and new, empty price slots are generated and offered when someone purchases the top position.<p>&nbsp</p><p>Note that since the price of BSV changes, so too will the minimal price slot displayed. That means if the price decreases after your purchase then your price slot will no longer be displayed for anyone else to purchase (unless the BSV price rises again to lower the minimum). This doesn't affect your subsciption and yours will continue at that \"less than\" monthly target price.Put another way, all future buyers  in the network will only be able to get higher positions than yours and your ad position will be consistently pushed lower (but still outrank all free ads). Your fee won't change unless you cancel or upgrade it!");

define("SECTION_1_HEADER_EXPLAIN_DEMO_COINS", "
<h3>You are looking at the competition from the perspective of using your supply of \"Demo Coins\". Bear in mind that all representations of positions are \"tentative\" (i.e. bids are \"sealed\", are opened at the end of the day and other higher ones might have been submitted that day or equal bids might have been submitted earlier that day which might affect your position slightly). Demo coins are provided as a teaching tool to learn the system. Afterwards, you can optionally use BitcoinSV to bid and out rank all Demo Coin bidders</h3>");

define("SECTION_1_HEADER_EXPLAIN_BSV_COINS", "
<h3>You are looking at the competition from the perspective of using your supply of \"BitcoinSV\". Bear in mind that all representations of positions are \"tentative\" (i.e. bids are \"sealed\", are opened at the end of the day and other higher ones might have been submitted that day or equal bids might have been submitted earlier that day which might affect your position slightly). The reporting of Demo Coin as well as BSV bids are provided for reference. Demo coins are provided as a teaching tool to learn the system. Afterwards, they can optionally use BitcoinSV to bid. The key point is that even the lowest of BitcoinSV bids out rank all Demo Coin bidders</h3>");

$population = " Population"; 
$dmc_rank_title = "Rank"; 
$crypto_coin_label = "BitcoinSv";
$demo_coin_label = "Demo Coin";
$currency_pre_text = "USD value $";
$currency_post_text = " per day. ";
$bsv_volatility_on = "<h5>YOU ARE OPERATING IN MODELLER MODE<BR>NO BIDS OR CHANGES ARE ENABLED<BR>SELECT THE RESTORE OPTION IN THE DROPDOWN TO THE RIGHT TO RETURN TO NORMAL</h5>";
$crypto_coin_header = "Current BitcoinSv Market Price";
$price_slot_amount_label = "Daily Price Slot Fee";
$downgrade_success_message  = "<h1>SUCCESS!</h1><p>Your new price will take affect at the next ad reordering (i.e. tomorrow)</p>";
$upgrade_success_message  = "<h1>SUCCESS!</h1><p>Your new price will take affect at the next ad reordering (i.e. tomorrow)</p>";
$cancel_success_message  = "<h1>SUCCESS!</h1><p>Your paid ad had been canceled and your ad will now return to its original free ad status.  Your ne position will take affect at the next ad reordering (i.e. tomorrow)</p>";
$cancel_confirm_message =  "<h1>Confirm Your Cancellation!</h1><h2> (Your listing will still be advertised and it's position will revert to its original Free position according to its registration seniority)</h2>";

?>
