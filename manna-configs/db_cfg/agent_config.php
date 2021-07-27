<?php
$debug = 2;//change to zero or comment out (ex. // in front of the line) to deactivate. Debug on is very useful when editting the various comments, popup, link titles and buttons of the buy_priceslot.php page (which proceeds to "include" various pages and messages depending on state of the ads and the user's bids. It's major function is to display the name of the included page it is currently in which presents the context that the messages need to operate in.

//NOTE: the following default AGENT_FOLDERNAME setting can be adjusted according to your folder naming preference. Just be sure that you match the name changes you make here to  those you make renaming the actual bitcoin_ad_agency folder. You can also place the script deeper in the file structure by adding the additional folders here - example define("AGENT_FOLDERNAME", "new_folder_name/bitcoin_ad_agency");
if (!defined('AGENT_FOLDERNAME')) {
define("AGENT_FOLDERNAME", "manna_network");
}
if (!defined('AGENT_URL')) {
define("AGENT_URL", "orlandoreferralgroup.com");//be SURE to NOT include the http:// nor an https:// 
}
if (!defined('CURL_SECURITY')) {
define("CURL_SECURITY", "https://");//had an issue in the development server where curl would not work using the dev server's SSL setup. We have a constant for all url requests to set it either https or http 
}
//IMPORTANT - YOU MUST REGISTER WITH THE MANNA NETWORK ADMINISTRATION TO GET A VALID AGENT ID! Get it from Manna Network admin (robert.r.lefebvre@protonmail.com 
if (!defined('AGENT_ID')) {
define("AGENT_ID", ??);//get it from Manna Network admin (robert.r.lefebvre@protonmail.com
//define("AGENT_ID", "1");//bad example WRONG  NOTE has quotes around number 
//Correct example - define("AGENT_ID", 1);
}

if (!defined('INSTALLER_ID')) {
define("INSTALLER_ID", 4);//get it from https://manna-network.cash/agents/register.php
}
//IMPORTANT - YOU MUST CONTACT MANNA NETWORK ADMINISTRATION TO GET A VALID $exchange_pw in order to send and receive updated link, bids and categories!
$exchange_pw = "2a05PE8AfNuGlc5nHoDAzBkvSaoOdA2DKCDIkQhqI3yVF7BmwAfLHQ";////get it from Manna Network admin (robert.r.lefebvre@protonmail.com


//DO NOT CHANGE THESE SETTINGS
$monthly_target_fee_in_dollar_value = 5;//Establishes what is basically the minimal fee (in dollars terms) that will be offerred by the priceslots order form. ex. 6 would be aiming for $6 monthly fee value in BSV. It takes the current BSV price, gets the decimal representation of the amount of BSV equal to this number and divides it by 30 days. That decimal is the lowest price someone can pay for better placement

$number_of_extra_price_slots = 2;// This setting adds additional price slots for higher amounts than the minimum. The default setting of 2, therefore, places two higher (but always empty of previous bidders) over the existing high bidder (except when there are no bids in the category yet - then it will place the lowest required bid (about $5/month USD worth of crypto) plus two [for a total of three empty price slots]. Usually this won't need to be changed. 
$lnk_num = 1;//DO NOT CHANGE! This is a local link number only (not the same as your original one at Manna Network). You will be prompted at click the Add URL at the top of the agent-dir/index.php and add your link info as your own first link in your own web directory and will receive the local link number of 1


?>
