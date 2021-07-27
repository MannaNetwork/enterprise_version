<?php


define("UPGRADE_TOP", "You can get ahead of bidders in your current price slot who purchased earlier than yourself (or those that have bid higher than yourself) and become the new top bidder and hold the new #1 spot!<h3>Terms And Conditions</h3><p>You can increase/upgrade your bid at any time. As always, the bids are ordered by priceslot amount and then by their purchase date/time. Upgrading results in a new purchase date (i.e. a different date/time than you have with your current price slot purchase). If the price slot you select has bids already (the population numbers in the right column will report that) then yours will definitely be listed behind those. In addition, if there are other new bids in the same priceslot that were submitted earlier today than yours then yours will be displayed behind theirs.");

define("UPGRADE_TOP_BUTTON", "Upgrade Current Position");
//drop the vm here and in the code and accomplish the wording change via the include this vs normal page
define("BLOCKT_EMPTY_TOP_LINK_TITLE","Effects On Empty Top Position");
define("BLOCKT_EMPTY_MED_LINK_TITLE","Effects On Empty Medium Position");
define("BLOCKT_EMPTY_LOWER_LINK_TITLE","Effects On Empty Lower Position");
define("BLOCKT_USERS_LINK_TITLE","Effects On Your Position");
define("EFFECT_ON_USER", "Your priceslot will continue as normal (you will still pay the same price, your ad will be displayed according to its rank etc.) but this price slot falls below the monthly minimum target price so it will no longer be displayed to bew bidders.");

define("UPGRADE_MED", "You can get ahead of bidders in your current price slot who purchased earlier than yourself (or those that have bid higher than yourself) and gain better position without paying top prices.<h3>Terms And Conditions</h3><p>You can increase/upgrade your bid at any time. As always, the bids are ordered by priceslot amount and then by their purchase date/time. Upgrading results in a new purchase date (i.e. a different date/time than you have with your current price slot purchase). If the price slot you select has bids already (the population numbers in the right column will report that) then yours will definitely be listed behind those. In addition, if there are other new bids in the same priceslot that were submitted earlier today than yours then yours will be displayed behind theirs.");
define("UPGRADE_MED_BUTTON", "Upgrade Current Position");
define("DOWNGRADE_LOWER", "You can save money by dropping to a lower priceslot.<h3>Terms And Conditions</h3><p>You can decrease/downgrade your bid at any time. As always, the bids are ordered by priceslot amount and then by their purchase date/time. Downgrading results in a new purchase date (i.e. a different date/time than you have with your current price slot purchase). If the price slot you select has bids already (the population numbers in the right column will report that) then yours will definitely be listed behind those. In addition, if there are other new bids in the same priceslot that were submitted earlier today than yours then yours will be displayed behind theirs.");
define("DOWNGRADE_LOWER_BUTTON", "Effects Of Lowering Your Position");
//TD_USER_NO_LONGER_DISPLAYED
//BLOCKT_PRE_IF
//DMC_RANK_TITLE

echo '<br> constant = ', UPGRADE_TOP;
echo '<br> constant = ', UPGRADE_TOP_BUTTON;
echo '<br> constant = ', BLOCKT_EMPTY_TOP_LINK_TITLE;
echo '<br> constant = ', BLOCKT_EMPTY_MED_LINK_TITLE;
echo '<br> constant = ', BLOCKT_EMPTY_LOWER_LINK_TITLE;
echo '<br> constant = ', BLOCKT_USERS_LINK_TITLE;
echo '<br> constant = ', UPGRADE_MED;
echo '<br> constant = ', UPGRADE_MED_BUTTON;
echo '<br> constant = ', DOWNGRADE_LOWER;
echo '<br> constant = ', DOWNGRADE_LOWER_BUTTON;
echo '<br> constant = ', TD_NO_LONGER_DISPLAYED;
echo '<br> constant = ', TD_ADDED_TO_DISPLAY;
echo '<br> constant = ', TD_USER_NO_LONGER_DISPLAYED;
echo '<br> constant = ', TD_USER_ADDED_TO_DISPLAY;
echo '<br> constant = ', BLOCKT_USERS_LINK_TITLE_VM;
echo '<br> constant = ', TD_USER_DOWNGRADE","TD_USER_DOWNGRADE;
?>
