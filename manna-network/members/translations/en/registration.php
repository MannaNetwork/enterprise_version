<?php

/**
 * Please note: we can use unencoded characters like ö, é etc here as we use the html5 doctype with utf8 encoding
 * in the application's header (in views/_header.php). To add new languages simply copy this file,
 * and create a language switch in your root files.
 */

// login & registration classes
define("WORDING_CATEGORY_HEADER", "<h4>SELECT CATEGORY</h4>");
define("WORDING_LINKEXCHANGE_PAGE_NAME", "PAGE");
define("WORDING_REGIONAL_FILTERS_LABEL", "<h4>FILTER BY<BR>LOCATION</h4>");
define("WORDING_REGIONAL_REG_LABEL", "<h4>OFFER BY<BR>LOCATION</h4>");
define("WORDING_AJAX_1", "More Subcategories Available After Selection");
define("WORDING_AJAX_2", "Still More Subcategories To Choose From");
define("WORDING_AJAX_MENU1", "Select a Sub-Category (optional)");
define("WORDING_AJAX_MENU2", "A Deeper Sub-Category? (optional)");
define("WORDING_AJAX_MENU_EDIT", "Change Your Category (optional - caution: will reset your seniority)");

define("WORDING_AJAX_REGIONAL_FILTER_LABEL", "Smaller Regions Available After Selection");
define("WORDING_AJAX_REGIONAL_MENU1", "Filter By Your Region (optional)");
define("WORDING_AJAX_REGIONAL_MENU2", "Filter By State (optional)");
define("WORDING_AJAX_REGIONAL_MENU3", "Filter By City (optional)");

define("WORDING_AJAX_REGIONAL_REG_LABEL", "Smaller Regions Available After Selection");
define("WORDING_AJAX_REGIONAL_REG1", "Offer By Region (optional)");
define("WORDING_AJAX_REGIONAL_REG2", "Offer By State (optional)");
define("WORDING_AJAX_REGIONAL_REG3", "Offer By City (optional)");


define("SUMMARY_AJAX_HEADER", "<h4>The report below will be adjusted to reflect the bidding and competition in the category and/or location you selected. As a general rule, the higher the category or location, the lower your free link will be displayed or the more expensive the bid required to get better placement will be.</h4> ");
define("SUMMARY_AJAX_NUM_LINKS", "<p>Total links in the category: ");
define("SUMMARY_AJAX_FREE_PAGE_COUNT1", "<p>Your free link will begin being displayed on page ");
define("SUMMARY_AJAX_FREE_PAGE_COUNT2", " at the ");
define("SUMMARY_AJAX_FREE_PAGE_COUNT3", " position. ");
define("SUMMARY_AJAX_MIN_DEMO_BID1", "<p>You will receive free \"Demo Coin\" to bid with in the amount of ");
define("SUMMARY_AJAX_MIN_DEMO_BID2", "<p>The minimum Demo Coin bid (enough to place your link ahead of all free links) is ");
define("SUMMARY_AJAX_MIN_BCH_BID1", " (per month). <p>There are ");
define("SUMMARY_AJAX_MIN_BCH_BID2", " BitcoinSV paying advertisers in this category. <p>The lowest BCH price (per month) is ");
define("SUMMARY_AJAX_MIN_BCH_BID3", "");
define("SUMMARY_AJAX_MIN_BCH_BID4", " (per month) <p> The hightest Demo Coin bidder currently is ");
define("SUMMARY_AJAX_MIN_BCH_BID5", " (per month) <p>Price to acquire the top Demo Coin display position ");
define("SUMMARY_AJAX_MIN_BCH_BID6", " (per month).<p> The highest BitcoinSV bidder currently is ");
define("SUMMARY_AJAX_MIN_BCH_BID7", " (per month) <p>Price to acquire the top BitcoinSV(i.e. overall # 1) display position: ");
define("SUMMARY_AJAX_MIN_BCH_BID8", " (BCH per month)");

define("MORE_INFO_PAGE", '<div style="width: 500px; margin-left: auto ;
margin-right: auto ;">For <b>More Info</b> about the bidding system ');

define("MORE_INFO_PAGEEND", 'Click Here</a></div>');


define("WORDING_AJAX_FREE_POSITION0", "<ul><li><u><b>Free sites</b></u> are listed and ordered according to their seniority (i.e. the date/time they registered).
</li><li><u><b>\"Demo coins\"</b></u> are given to each new listing in the ad network (you will receive ");



define("WORDING_AJAX_FREE_POSITION01", " demo coin) which can be used to <u>purchase better position</u>.</li><li><u><b>The site you registered at </b></u> will \"earn\" a 50% commission of the demo coin you spend. </li><li><u><b>The demo system</b></u> demonstrates not only how to bid for better position but also how websites with our API earn income from the subscribers they registered. They can, thus, maintain their own bidding positions just from the commissions of new recruits.
</li><li><u><b> Ads paid with BitcoinSV</b></u> are even better. They are displayed ahead of both Demo paying ads and free ads.And like with the demo coin, the website where the advertiser registered at earn commission but this time in real money (i.e. cryptocurrency) that has value. They can still spend it to buy better positions or they can withdraw them as \"profit\" from their website! </li>");
define("WORDING_AJAX_FREE_POSITION1", "<li><u><b>Your free listing</b></u> will initially be positioned at the ");
define("WORDING_AJAX_FREE_POSITION2", " position which will be on page ");
define("WORDING_AJAX_FREE_POSITION3", ", position ");
define("WORDING_AJAX_DEMO_POSITION1", " of the category. If you use the free \"Demo Coin\" (which you will receive immediately after registration) to bid for better position, then the minimum bid (");
define("WORDING_AJAX_DEMO_POSITION1B", " demo coin) would move your listing ahead of all free links and up to position ");

define("REG_FORM_WELCOME_TITLE", "Thank You For Wanting To Add Your Link To Our Classified Section!");
define("REG_FORM_WELCOME_BODY", "<p align='left'>Our's is one of a network of many on individually owned and operated websites that co-operate together to advertise each other\'s websites and now your website will be advertised on our own site and the entire network as well! It\'s a better way for us to help even more people find your website than what just our own site could provide you by itself.</p>
<p align='left'>You will be provided more info about this great web directory so you can become part of this bigger effort to make your website successful!");
define("WORDING_AJAX_DEMO_POSITION2", ", which will be on page ");
define("WORDING_AJAX_DEMO_POSITION3", ", position ");
define("WORDING_AJAX_DEMO_POSITION4", ", </li><li> There are already ");
define("WORDING_AJAX_DEMO_POSITION5", ", <u>advertisers</u> that have bid using their demo coin AND ");
define("WORDING_AJAX_DEMO_POSITION6", ", advertisers that have bid using BitcoinSV (for a total of ");
define("WORDING_AJAX_DEMO_POSITION7", " <b>advertisers that would still listed ahead of yours</b> if you bid the <u>minimum</u> with your free demo coin).</li><li><u><b> You can bid more </b></u>than the minimum with your Demo Coin and achieve higher positions among the Demo Coin group but your allotment won't last as long. </li><li><u><b>To maintain your Demo Coin balance</b></u> you can install our web directory app on your website and earn them from subscribers that register there (they each also receive demo coins when they register). You can also outbid them with even the minimum bid amount of BitcoinSV.</li><li><u><b> If you aren't familar with crypto currency</b></u> you can take our course at <a style='text-decoration:underline;color:blue;' target='_blank' href='http://bitcoin101.today'>Bitcoin101.today</a> for just $1.01.</li> ");
define("WORDING_AJAX_DEMO_POSITION8", "<li><u><b>The highest \"Demo Coin\" bidder</b></u> in your selected category has paid ");
define("WORDING_AJAX_DEMO_POSITION9", " for their top position among the Demo Coin group. It will cost you one-and-a-half times that to claim #1 of the Demo Coin bidders ");

define("WORDING_AJAX_BCH_POSITION1", "</li><li><u><b>The highest \"BitcoinSV\" bidder</b></u> in your selected category has paid ");
define("WORDING_AJAX_BCH_POSITION2", " for their top position of all. It will cost you one-and-a-half times that to claim #1 of the BCH bidders ");
define("WORDING_AJAX_BCH_POSITION3", "</li><li><u><b>The lowest \"BitcoinSV\" bidder</b></u> in your selected category has paid ");
define("WORDING_AJAX_BCH_POSITION4", " for their bottom position (lowest to be ahead of all demo coin and free ads).</li></ul> ");
define("WORDING_AJAX_BCH_POSITION5", "<li><u><b>The lowest \"Demo Coin\" bidder</b></u> in your selected category has paid ");
define("WORDING_AJAX_BCH_POSITION6", " for their bottom position (lowest to be ahead of all free ads).</li>");

define("WORDING_AJAX_EXPANDED_REPORT_HEADER","<h4>Your Present Ad Position Would BE (expanded)...</h4>");

define("WORDING_AJAX_SUMMARY_REPORT_HEADER","<h4>Your Present Ad Position Would BE (summary) ...</h4>");
define("MESSAGE_WEBSITE_TITLE_EMPTY", "<h3>Website Title field was empty</h3>");
define("MESSAGE_WEBSITE_URL_EMPTY", "<h3>Website URL field was empty</h3>");
define("MESSAGE_WEBSITE_DESCRIPTION_EMPTY", "<h3>Website Description field was empty</h3>");
define("MESSAGE_WEBSITE_STREET_FULL", "<h3>Website Street field has info with no city selected</h33>");
define("MESSAGE_MAIN_CAT_EMPTY", "<h3>You didn't select a catageory</h3>");
define("MESSAGE_LOCATION_ID_EMPTY_STREET_FILLED", "<h3>The Website Street field has info with no city selected</h3>");
define("MESSAGE_WEBSITE_TITLE_BAD_LENGTH", "<h3>The Website Title field has too few or too many characters (6-64)</h33>");
define("MESSAGE_WEBSITE_DESCRIPTION_TOO_LONG", "<h3>The Website Description field has too many characters (255 max)</h3>");
define("MESSAGE_WEBSITE_URL_TOO_LONG", "<h3>The Website Description field has too many characters (255 max)</h3>");
define("MESSAGE_ACCOUNT_NOT_ACTIVATED", "<h3>Your account is not activated yet. Please click on the confirm link in the mail.</h3>");
define("MESSAGE_CAPTCHA_WRONG", "<h3>Captcha was wrong!</h3>");
define("MESSAGE_CATEGORY_ID_BAD", "<h3>Category ID was wrong!</h3>");
define("MESSAGE_LOCATION_ID_BAD", "<h3>Location ID wrong!</h3>");
define("MESSAGE_COOKIE_INVALID", "<h3>Invalid cookie</h3>");
define("MESSAGE_DATABASE_ERROR", "<h3>Database connection problem.</h3>");
define("MESSAGE_EMAIL_ALREADY_EXISTS", "<h3>This email address is already registered. Please use the \"I forgot my password\" page if you don't remember it.</h3>");
define("MESSAGE_EMAIL_CHANGE_FAILED", "<h3>Sorry, your email changing failed.</h3>");
define("MESSAGE_EMAIL_CHANGED_SUCCESSFULLY", "<h3>Your email address has been changed successfully. New email address is </h3>");
define("MESSAGE_EMAIL_EMPTY", "<h3>Email cannot be empty</h33>");
define("MESSAGE_EMAIL_INVALID", "<h3>Your email address is not in a valid email format</h3>");
define("MESSAGE_EMAIL_SAME_LIKE_OLD_ONE", "<h3>Sorry, that email address is the same as your current one. Please choose another one.</h3>");
define("MESSAGE_EMAIL_TOO_LONG", "<h3>Email cannot be longer than 64 characters</h3>");
define("MESSAGE_LINK_PARAMETER_EMPTY", "<h3>Empty link parameter data.</h3>");
define("MESSAGE_LOGGED_OUT", "<h3>You have been logged out.</h3>");
// The "login failed"-message is a security improved feedback that doesn't show a potential attacker if the user exists or not
define("MESSAGE_LOGIN_FAILED", "<h3>Login failed.</h3>");
define("MESSAGE_OLD_PASSWORD_WRONG", "<h3>Your OLD password was wrong.</h3>");
define("MESSAGE_PASSWORD_BAD_CONFIRM", "<h3>Password and password repeat are not the same</h3>");
define("MESSAGE_PASSWORD_CHANGE_FAILED", "<h3>Sorry, your password changing failed.</h3>");
define("MESSAGE_PASSWORD_CHANGED_SUCCESSFULLY", "<h3>Password successfully changed!</h3>");
define("MESSAGE_PASSWORD_EMPTY", "<h3>Password field was empty</h3>");
define("MESSAGE_PASSWORD_RESET_MAIL_FAILED", "<h3>Password reset mail NOT successfully sent! Error: </h3>");
define("MESSAGE_PASSWORD_RESET_MAIL_SUCCESSFULLY_SENT", "<h3>Password reset mail successfully sent!</h3>");
define("MESSAGE_PASSWORD_TOO_SHORT", "<h3>Password has a minimum length of 6 characters</h3>");
define("MESSAGE_PASSWORD_WRONG", "<h3>Wrong password. Try again.</h3>");
define("MESSAGE_PASSWORD_WRONG_3_TIMES", "<h3>You have entered an incorrect password 3 or more times already. Please wait 30 seconds to try again.</h3>");

define("MESSAGE_REGISTRATION_ACTIVATION_NOT_SUCCESSFUL", "<h3>Sorry, no such id/verification code combination here...</h3>");
define("MESSAGE_REGISTRATION_ACTIVATION_SUCCESSFUL", "<h3>Activation was successful! You can now log in!</h3>");
define("MESSAGE_REGISTRATION_FAILED", "<h3>Sorry, your registration failed. Please go back and try again.</h3>");
define("MESSAGE_ADD_LINK_FAILED", "<h3>Sorry, your attempt to add a new link failed. Please go back and try again.</h3>");
define("MESSAGE_RESET_LINK_HAS_EXPIRED", "<h3>Your reset link has expired. Please use the reset link within one hour.</h3>");
define("MESSAGE_VERIFICATION_MAIL_ERROR", "<h3>Sorry, we could not send you an verification mail. Your account has NOT been created.</h3>");
define("MESSAGE_VERIFICATION_MAIL_NOT_SENT", "<h3>Verification Mail NOT successfully sent! Error: </h3>");
define("MESSAGE_VERIFICATION_MAIL_SENT", "<h3>Your account has been created successfully and we have sent you an email. Please click the VERIFICATION LINK within that mail. If you do not see it in your in box be sure to check your spam folder (if found there, be sure to indicate to your email program it is NOT spam). </h3>");
define("MESSAGE_USER_DOES_NOT_EXIST", "<h3>This user does not exist</h3>");
define("MESSAGE_USERNAME_BAD_LENGTH", "<h3>Username cannot be shorter than 2 or longer than 64 characters</h3>");
define("MESSAGE_USERNAME_CHANGE_FAILED", "<h3>Sorry, your chosen username renaming failed</h3>");
define("MESSAGE_USERNAME_CHANGED_SUCCESSFULLY", "<h3>Your username has been changed successfully. New username is </h3>");
define("MESSAGE_USERNAME_EMPTY", "<h3>Username field was empty</h3>");
define("MESSAGE_USERNAME_EXISTS", "<h3>Sorry, that username is already taken. Please choose another one.</h3>");
define("MESSAGE_USERNAME_INVALID", "<h3>Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters</h3>");
define("MESSAGE_USERNAME_SAME_LIKE_OLD_ONE", "<h3>Sorry, that username is the same as your current one. Please choose another one.</h3>");


// views
define("WORDING_BACK_TO_LOGIN", "<h3>Back to Login Page</h3>");
define("WORDING_BACK_TO_MEMBER_HOME", "<h3>Back to Member Home</h3>");
define("WORDING_CHANGE_EMAIL", "<h3>Change email</h3>");
define("WORDING_CHANGE_PASSWORD", "<h3>Change password</h3>");
define("WORDING_CHANGE_USERNAME", "<h3>Change username</h3>");
define("WORDING_CURRENTLY", "<h3>currently</h3>");
define("WORDING_EDIT_USER_DATA", "<h3>Edit user data</h3>");
define("WORDING_EDIT_YOUR_CREDENTIALS", "<h3>You are logged in and can edit your credentials here</h3>");
define("WORDING_FORGOT_MY_PASSWORD", "<h3>I forgot my password</h3>");
define("WORDING_LOGIN", "Log in");
define("WORDING_LOGOUT", "<h3>Log out</h3>");
define("WORDING_NEW_EMAIL", "<h3>New email</h3>");
define("WORDING_NEW_PASSWORD", "<h3>New password</h3>");
define("WORDING_NEW_PASSWORD_REPEAT", "<h3>Repeat new password</h3>");
define("WORDING_NEW_USERNAME", "<h3>New username (username cannot be empty and must be azAZ09 and 2-64 characters)</h3>");
define("WORDING_OLD_PASSWORD", "<h3>Your OLD Password</h3>");
define("WORDING_PASSWORD", "<h3>Password</h3>");
define("WORDING_PROFILE_PICTURE", "<h3>Your profile picture (from gravatar):</h3>");
define("WORDING_REGISTER", "Register");
define("WORDING_ADD_A_LINK", "Submit Your New Site");
define("WORDING_REGISTER_NEW_ACCOUNT", "<h3>Register new account</h3>");
define("MESSAGE_WEBSITE_CATEGORY_EMPTY", "<h3>Please select the best category describing your website or business</h3>");
define("WORDING_REGISTRATION_CATEGORY_HEADING", "Select A Category");
define("WORDING_REGISTRATION_REGIONAL_HEADING", "Add A Location (Optional)");
define("WORDING_REGISTRATION_TITLE", "<h3>Title - Please enter a description (a heading or title) for your website or business. It will be the heading for your listing</h3>");
define("WORDING_REGISTRATION_URL", "<h3>Your Website URL - it is strongly suggested and very useful that you prepare a landing page specifically for this ad. Enter the URL here.</h3>");
define("WORDING_REGISTRATION_DESCRIPTION", "<h3>Description - Enter a 50 to 255 character description of your website or business</h3>");
define("WORDING_REGISTRATION_CATEGORY", "<h3><b>Category (required) -</b> Select the BEST category for your website or business listing from among either main categories or subcategories (Hint: the higher the category, the more the competition).</h3>");

define("WORDING_CATEGORY_SUGGESTION", "Have a category suggestion for YOUR website? Enter it here and, if approved, we will add it and your listing there (instead of your LAST selected one*)!");

define("WORDING_REGISTRATION_LOCATION", "<h3><b>Location (optional) - </b>Locations will be used by the end users to \"filter\" to your listing from among irrelevant results outside their area.</h3>");
define("WORDING_REGISTRATION_STREET", "<h3>Street Address - <b>IF</b> you selected a city then, optionally, you can also add your street addess to your listing.</h3>");
define("WORDING_REGISTRATION_DISTRICT", "<h3>Add (optional) District, Boroughs, Regions, Neighborhood etc (optional) - Examples: Bronx, Lakes District, New England etc. (IF applicable) </h3>");
define("WORDING_REGISTRATION_RECIPROCAL_HEADER", "<h2>Earn Income From Reciprocal Linking</h2><p style='text-align:left;font-weight:bold;'>CHECK HERE TO EARN!</b><br>");
define("WORDING_REGISTRATION_RECIPROCAL", " Check here to accept the terms (read the wiki), then download and install our script - FREE!</h1>. 
<p style='text-align:left;'>Install our script on your website and you become a full member of the cooperative with the following benefits:
<ul><li>Receive approximately 8 week's worth of Free \"Manna Demo\" coin (usable for getting your ad listing ahead of earlier placed and more senior ad listings)</li>
<li>Receive 50% commissions* on whatever your registered advertisers ever spend for their advertising in the network (you receive commissions in either and/or both the demo coins as well as the BitcoinSV they spend). We give every new registrant (i.e. advertiser) approximately 8 week's worth of Demo coin too which generates commissions for you to continue to purchase better placement. you get</li>
<li>You/we offer the same opportunity to earn to each of your advertisers! When they install the script, you get additional override commissions on their sales!</li>
<li>You receive commissions on your own purchases of better placement effectively getting a 50% member's discount on your own ad purchases</li>
</ul>
* Commissions earned as \"Demo Coin\" are spendable and transferable to other members but are not backed nor redeemable for anything other than for better placement in the Manna Network. Commissions earned from ads purchased with BitcoinSV, on the other hand, are redeemable for BitcoinSV.");
define("WORDING_EMAIL_VERIFIED1", "<h3  style='text-align:left;'>Your registration and web site information was successfully placed in the Manna Network queue for administrative review. Please allow 24-48 hours for this process and for your website listing to appear in the Manna Network member's websites.</h3><h3 style=' text-align:left;'>The link approval process does  NOT hinder your ability to correctly install any of our Bitcoin-earning scripts. If you are eager to get started earning Bitcoin with your website, use the contact form download the latest scripts from http://Github.com/Manna-Network. </h3>
<h3 style=' text-align:left;'>Neither does the link approval process hinder your ability to bid (sic. purchase) better placement for your link/ad. We have credited your account with \"Demo Coin\" which you can use to actually \"buy\" better placement. It has no redemption value but demonstrates how you can use your BitcoinSv (once you get some). </h3><h3 style='color:red;text-align:left;'>The configurations you will need for installing your BitcoinSV earning script are:<br> Agent_ID = '");
define("WORDING_EMAIL_VERIFICATION2", '<br> and your link or affiliate ID = ');
define("WORDING_EMAIL_VERIFICATION3", '</h3><h3 style="text-align:left;">Now you can also log in to your User Control Panel to:<br>1) Advertise more of your websites<br>2) Bid For Better Placement for free using the free "demo coins" we credited to your account.<br>3) Learn about Bitcoin<br> 4) Get your free BitcoinSV-earning web directory for your own website (a nice feature just by itself).<br><br> <a href="./');
define("WORDING_EMAIL_VERIFICATION4", "<h3 style='text-align:left;'>Here is the link:</a> to your member control panel.</h3>");
define("WORDING_AJAX_1", "<h3>More Subcategories Available After Selection");//x
define("WORDING_AJAX_2", "<h3>Still More Subcategories To Choose From");

define("WORDING_AJAX_MENU", "Select a Category (required)");
define("WORDING_AJAX_MENU1", "Select a Sub-Category (optional)");
define("WORDING_AJAX_MENU2", "A Deeper Sub-Category? (optional)");

define("WORDING_AJAX_MENU_EDIT", "Change Category (resets seniority)");


define("SUMMARY_AJAX_HEADER", "<h4>The report below will be adjusted to reflect the bidding and competition in the category and/or location you selected. As a general rule, the higher the category or location, the lower your free link will be displayed or the more expensive the bid required to get better placement will be.</h4> ");
define("SUMMARY_AJAX_NUM_LINKS", "<p>Total links in the category: ");
define("SUMMARY_AJAX_FREE_PAGE_COUNT1", "<p>Your free link will begin being displayed on page ");
define("SUMMARY_AJAX_FREE_PAGE_COUNT2", " at the ");
define("SUMMARY_AJAX_FREE_PAGE_COUNT3", "  position. ");
define("SUMMARY_AJAX_MIN_DEMO_BID1", "<p>You will receive free \"Demo Coin\" to bid with in the amount of ");
define("SUMMARY_AJAX_MIN_DEMO_BID2", "<p>The minimum Demo Coin bid (enough to place your link ahead of all free links) is ");
define("SUMMARY_AJAX_MIN_BCH_BID1", " (per month). <p>There are ");
define("SUMMARY_AJAX_MIN_BCH_BID2", " BitcoinSV paying advertisers in this category. <p>The lowest BCH price (per month) is ");
define("SUMMARY_AJAX_MIN_BCH_BID3", "");
define("SUMMARY_AJAX_MIN_BCH_BID4", " (per month) <p> The hightest Demo Coin bidder currently is  ");
define("SUMMARY_AJAX_MIN_BCH_BID5", " (per month) <p>Price to acquire the top Demo Coin display position ");
define("SUMMARY_AJAX_MIN_BCH_BID6", " (per month).<p> The highest BitcoinSV bidder currently is  ");
define("SUMMARY_AJAX_MIN_BCH_BID7", " (per month) <p>Price to acquire the top BitcoinSV(i.e. overall # 1) display position: ");
define("SUMMARY_AJAX_MIN_BCH_BID8", " (BCH per month)");

define("MORE_INFO_PAGE", '<div  style="width: 500px;  margin-left: auto ;
  margin-right: auto ;">For <b>More Info</b> about the bidding system ');

define("MORE_INFO_PAGEEND", 'Click Here</a></div>');


/*
define("EXPANDED_AJAX_NUM_LINKS", "The total number of free, non-paying links, <b>PLUS</b> paying \"Demo coin\" links <b>PLUS</b> paying BitcoinSV links listed ahead of your's in this category is: ");
define("EXPANDED_AJAX_FREE_PAGE_COUNT1", "At 20 links displayed per page, your free link will be displayed on page ");
define("EXPANDED_AJAX_FREE_PAGE_COUNT2", " at the ");
define("EXPANDED_AJAX_FREE_PAGE_COUNT3", "  position. ");
define("EXPANDED_AJAX_MIN_DEMO_BID1", "<p>You will receive free \"Demo Coin\" in the amount of ");
define("EXPANDED_AJAX_MIN_DEMO_BID2", " (which represents approximately $100 worth of free advertising). You can use it to purchase a \"price slot\" and position your link ahead of all free listings and ahead of other, lower paying demo coin bidders (if you choose). The minimum bid (enough to place your link ahead of all free links) is approximately $5 (nominal value) worth of demo coin or: ");
define("EXPANDED_AJAX_MIN_BCH_BID1", "<p>There are ");
define("EXPANDED_AJAX_MIN_BCH_BID2", " BitcoinSV paying advertisers in this category. To be listed ahead of theirs, make a deposit of BitcoinSV and purchase a price slot at whatever level among the BitcoinSV links you wish. The lowest price is ");
define("EXPANDED_AJAX_MIN_BCH_BID3", " (approximately only around $5 worth a month). That payment will display your link ahead of all free and all demo paying advertisers.");
define("EXPANDED_AJAX_MIN_BCH_BID4", "<p> The hightest bidder currently is  ");
define("EXPANDED_AJAX_MIN_BCH_BID5", " and to acquire the top display position will require you to select any of the higher price slots, with the next highest being one-and-one-half times the current top price slot ");
*/

define("WORDING_AJAX_FREE_POSITION0", "<ul><li><u><b>Free sites</b></u> are listed and ordered according to their seniority (i.e. the date/time they registered).
</li><li><u><b>\"Demo coins\"</b></u>  are given to each new listing in the ad network (you will receive ");



define("WORDING_AJAX_FREE_POSITION01", " demo coin) which can be used to <u>purchase better position</u>.</li><li><u><b>The site you registered at </b></u> will \"earn\" a 50% commission of the demo coin you spend. </li><li><u><b>The demo system</b></u> demonstrates not only how to bid for better position but also how websites with our API earn income from the subscribers they registered. They can, thus, maintain their own bidding positions just from the commissions of new recruits.
</li><li><u><b> Ads paid with BitcoinSV</b></u>  are even better. They are displayed ahead of both Demo paying ads and free ads.And like with the demo coin, the website where the advertiser registered at earn commission but this time in real money (i.e. cryptocurrency) that has value. They can still spend it to buy better positions or they can withdraw them as \"profit\" from their website! </li>");
define("WORDING_AJAX_FREE_POSITION1", "<li><u><b>Your free listing</b></u> will initially be positioned at the ");
define("WORDING_AJAX_FREE_POSITION2", " position which will be on page ");
define("WORDING_AJAX_FREE_POSITION3", ", position ");
define("WORDING_AJAX_DEMO_POSITION1", " of the category. If you use the free \"Demo Coin\" (which you will receive immediately after registration) to bid for better position, then the minimum bid (");
define("WORDING_AJAX_DEMO_POSITION1B", " demo coin) would move your listing ahead of all free links and up to position ");


define("WORDING_AJAX_DEMO_POSITION2", ", which will be on page ");
define("WORDING_AJAX_DEMO_POSITION3", ", position ");
define("WORDING_AJAX_DEMO_POSITION4", ", </li><li> There are already ");
define("WORDING_AJAX_DEMO_POSITION5", ", <u>advertisers</u> that have bid using their demo coin AND ");
define("WORDING_AJAX_DEMO_POSITION6", ", advertisers that have bid using BitcoinSV (for a total of ");
define("WORDING_AJAX_DEMO_POSITION7", " <b>advertisers that would still listed ahead of yours</b> if you bid the <u>minimum</u> with your free demo coin).</li><li><u><b> You can bid more </b></u>than the minimum with your Demo Coin and achieve higher positions among the Demo Coin group but your allotment won't last as long. </li><li><u><b>To maintain your Demo Coin balance</b></u> you can install our web directory app on your website and earn them from subscribers that register there (they each also receive demo coins when they register). You can also outbid them with even the minimum bid amount of BitcoinSV.</li><li><u><b> If you aren't familar with crypto currency</b></u> you can take our course at <a style='text-decoration:underline;color:blue;' target='_blank' href='http://bitcoin101.today'>Bitcoin101.today</a> for just $1.01.</li> ");
define("WORDING_AJAX_DEMO_POSITION8", "<li><u><b>The highest \"Demo Coin\" bidder</b></u> in your selected category has paid ");
define("WORDING_AJAX_DEMO_POSITION9", " for their top position among the Demo Coin group. It will cost you one-and-a-half times that to claim #1 of the Demo Coin bidders ");

define("WORDING_AJAX_BCH_POSITION1", "</li><li><u><b>The highest \"BitcoinSV\" bidder</b></u> in your selected category has paid ");
define("WORDING_AJAX_BCH_POSITION2", " for their top position of all. It will cost you one-and-a-half times that to claim #1 of the BCH bidders  ");
define("WORDING_AJAX_BCH_POSITION3", "</li><li><u><b>The lowest \"BitcoinSV\" bidder</b></u> in your selected category has paid ");
define("WORDING_AJAX_BCH_POSITION4", " for their bottom position (lowest to be ahead of all demo coin and free ads).</li></ul> ");
define("WORDING_AJAX_BCH_POSITION5", "<li><u><b>The lowest \"Demo Coin\" bidder</b></u> in your selected category has paid ");
define("WORDING_AJAX_BCH_POSITION6", " for their bottom position (lowest to be ahead of all free ads).</li>");

define("WORDING_AJAX_EXPANDED_REPORT_HEADER","<h4>Your Present Ad Position Would BE (expanded)...</h4>"); 

define("WORDING_AJAX_SUMMARY_REPORT_HEADER","<h4>Your Present Ad Position Would BE (summary) ...</h4>"); 


define("WIDGET_INSTALL_LOCATION", "<h3>After installion, enter the location here to activate commissions (optional):</h3>");
define("WIDGET_BITCOINCASH_ADDRESS", "<h3><b>After installion</b>, you will need a BitcoinSV address address to receive earnings (An example of a Bitcoin/BitcoinSV address - 1BvBMSEYstWetqTFn5Au4m4GFg7xJaNVN2) where your commission earnings can be sent (upon request). Need to learn about this? Need a BitcoinSV wallet? Take the begginner course below. </h3>");
define("WIDGET_SOFTWARE_LINKS", "<h3>Reciprocal Linking - Get your reciprocal linking software from the links below!</h3>");

define("WORDING_REGISTRATION_CAPTCHA", "<h3>Please enter these characters</h3>");
define("WORDING_REGISTRATION_EMAIL", "<h3>Email - Please provide a real email address! You'll get a verification mail with an activation link (your ad/link will not be displayed without a response).</h3>");
define("WORDING_REGISTRATION_PASSWORD", "<h3>Password - (min. 6 characters!)</h3>");
define("WORDING_REGISTRATION_PASSWORD_REPEAT", "<h3>Password (again)</h3>");
define("WORDING_REGISTRATION_USERNAME", "<h3>Username (only letters and numbers, 2 to 64 characters)</h3>");
define("WORDING_REMEMBER_ME", "<h3>Keep me logged in (for 2 weeks)</h3>");
define("WORDING_REQUEST_PASSWORD_RESET", "<h3>Request a password reset. Enter your username and you'll get a mail with instructions:</h3>");
define("WORDING_RESET_PASSWORD", "Reset my password");
define("WORDING_SUBMIT_NEW_PASSWORD", "<h3>Submit new password</h3>");
define("WORDING_USERNAME", "<h3>Username</h3>");
define("WORDING_YOU_ARE_LOGGED_IN_AS", "<h3>You are logged in as </h3>");

//blokct section link titles -cat_and_user_has_bids.php
//normal price mode
/*define("BLOCKT_EMPTY_TOP_LINK_TITLE","Empty Top Position");
define("BLOCKT_EMPTY_MED_LINK_TITLE","Empty Medium Position");
define("BLOCKT_EMPTY_LOWER_LINK_TITLE","Empty Lower Position");
define("BLOCKT_USERS_LINK_TITLE","Info Re: Your Position"); */
//price_volatility_modeler_mode
/*define("BLOCKT_EMPTY_TOP_LINK_TITLE_VM","Effects On Empty Top Position");
define("BLOCKT_EMPTY_MED_LINK_TITLE_VM","Effects On Empty Medium Position");
define("BLOCKT_EMPTY_LOWEST_LINK_TITLE_VM","Effects On Empty Lower Position");
define("BLOCKT_USERS_LINK_TITLE_VM","Effects On Your Position");

define("EFFECT_ON_USER", "Your priceslot will continue as normal (you will still pay the same price, your ad will be displayed according to its rank etc.) but this price slot falls below the monthly minimum target price so it will no longer be displayed to bew bidders.");
*/
//displayed in regular <td>
define("TD_NO_LONGER_DISPLAYED", "<h3>This Will No Longer Be Displayed</h3><p>And it is not available for purchase. Please select a higher (i.e. active) price slot.");
define("TD_ADDED_TO_DISPLAY", "<h3>This Additional Lower One Be Displayed</h3><p>It is now available for purchase or to downgrade your bid. ");
//displayed in users bid <td>
define("TD_USER_NO_LONGER_DISPLAYED", "This Will No Longer Be Displayed To Others");
define("TD_USER_ADDED_TO_DISPLAY", "<h3>Your Priceslot Will, Again, Be Displayed For Others To Purchase (With Less Seniority Than You)</h3>");
define("BLOCKT_USERS_LINK_TITLE_VM","Effects On Your Position");


define("BUY_2ND_PAGE_HEADER", "<h1>Select Your Ad Position</h1>
<p>Selecting from the below list of \"Price Slots\" will enroll your site (on a subscription type basis) for placement in a \"relative and tenatative\" across the entire Manna Network Distributed Ad Network.  
<p>\"Relative and tenatative\" means that the order that ads are actually displayed in is subject to change DAILY. The order is determined daily when new bids and subscriptions are compared and the links are ordered in the following priorities: 1) the coin type (BSV paying bids are listed first, Demo Coin bids next and then, lastly free links) 2) Within those three groupings the links are ordered according to the Price Slot selected (highest to lowest) and 3) Seniority (determined by when the price slot subscription was first acquired). Note that seniority orders the links when there is multiple subscribers to the same price slot and also the remaining free advertisers.
<p>Purchases are \"relative and tentative\" because other higher or lower payments can and do arrive that can move your ad higher or lower in the display. Most of the time these movements up or down are minor and occur slowly over time but can also be volatile (escpecially if the crypto prices have been volatile). As the value of the BSV changes, so too does the value you are paying for your price slot. Yourself and others will react differently to the trends and move their placement accordingly. 
<p> Notice that the next higher price slot will always be priced 1.5 times the next lower one.</td></tr>
<tr><td colspan=3> <h3>Current BitcoinSV USD Price ");

define("BUY_2ND_PAGE_NOBIDS1","<tr><td colspan=4><h3>Since there are no current bids in this category, you can bid the minimum and be #1 !!!!. Game theory hint: If you think the price of BSV will be going down you might want to firm your grasp by selecting higher price slots (because the actual price of your ad will come down as BSV price drops)</h3></td></tr>");
define("THIS_ONLY_BID_IS_NO_APPROVED","<tr><td colspan=4><h3>While there are no current bids in this category, yours is pending the review of your website. Your bid will not be processed until your website has been reviewed. This notice will change once it is and your bid will show up as one in the listed population.</h3></td></tr>"); 
define("BUY_2ND_PAGE_HASBIDS1","<tr><td colspan=4><h3><h3>You can upgrade by matching any higher bid (even if it already is populated) or selecting any empty higher price slots. Note the top price slots are always empty. Each price slot is priced 1.5 times the previous one and there will be new one(s) autogenerated after a new top bid is selected (i.e. for the next potential top bidder)</h3></td></tr>");
define("BUY_TOP", "Become The New Highest Bidder (Hold The #1 Spot). <br>You can select this price slot and be #1!");
define("BUY_TOP_BUTTON", "Be #1! Purchase/Subscribe");
/* moved to price normal
define("UPGRADE_TOP", "You can get ahead of bidders in your current price slot who purchased earlier than yourself (or those that have bid higher than yourself) and become the new top bidder and hold the new #1 spot!<h3>Terms And Conditions</h3><p>You can increase/upgrade your bid at any time. As always, the bids are ordered by priceslot amount and then by their purchase date/time. Upgrading results in a new purchase date (i.e. a different date/time than you have with your current price slot purchase). If the price slot you select has bids already (the population numbers in the right column will report that) then yours will definitely be listed behind those. In addition, if there are other new bids in the same priceslot that were submitted earlier today than yours then yours will be displayed behind theirs.");






define("UPGRADE_TOP_BUTTON", "Upgrade Current Position");
*/

define("BUY_MED", "Middle Bids <br>(Between top and lowest)");
define("BUY_MED_BUTTON", "Middle! Purchase/Subscribe");
define("UPGRADE_MED", "Middle Bids <br>(Between top and lowest) <br>You can upgrade to this price slot!");
define("UPGRADE_MED_BUTTON", "Upgrade Current Position");
define("DOWNGRADE_MED", "Middle Bids <br>(Between top and lowest) <br>You can downgrade to this price slot!");
define("DOWNGRADE_MED_BUTTON", "Downgrade Current Position");
define("CANCEL_BUTTON","Cancel My Current Bid");
define("BUY_LOWEST", "Lowest Bidder (Hold This Spot). <br>You can select this price slot and be ahead of all free advertisers!");
define("BUY_LOWEST_BUTTON", "Lowest Price! Purchase/Subscribe");
define("DOWNGRADE_LOWEST", "Lowest Bidder (Hold This Spot). <br>You can select this price slot and be ahead of all free advertisers!");
define("DOWNGRADE_LOWEST_BUTTON", "Downgrade To Lowest Position? Downgrade");
define("NO_BIDS_CTA", "Be Top #1!");
define("NO_BIDS_LOWEST", "You can select here and be ahead of all free links!");
define("NO_BIDS_HIGHEST", "Higher bids (than minimum) are made available to provide a \"cushion\" and protect your position (see bidding tips).");
define("PRICESLOT_POPULATION","Priceslot Population");

//define("OWNS_TOP1", "Congratulations!");
//define("OWNS_TOP2", "You Own The #1 Spot!");
//define("BSV_PRICE_TITLE","Currrent BSV PRICE");/* moved to commons

//define("BLOCKT_PRE_IF", "Your Current Bid");
//define("DMC_RANK_TITLE", "Your Current Rank Is");
define("BLOCKT_PRE_IF_TEMP", "Your Current Bid And Web Site Are Pending Review");
//define("BLOCKT_INPUT_LABEL","Price slot amount");/* moved to commons
define("BLOCKT_INPUT_LABEL_WARNING","<span style='color:red;'>Warning: This will cancel & replace your current bid & bid seniority. </span>");
define("BLOCKT_TITLE_APPROVED", '"Approved">Your Website And Bid have been processed');
define("BLOCKT_TITLE_APPROVED_WHY_PAD1", '"There\'s some good reasons.">Why Bid More Than Your Current Bid?');

define("BLOCKT_TITLE_APPROVED_WHY_PAD2", '"More good reasons.">Why Bid Even Higher?');

define("BLOCKT_TITLE_NO_APPROVED", '"Bid Is Pending">Your website is going through the review process.');
define("BLOCKT_TITLE_NO_APPROVED_WHY_PAD1", '"There\'s some good reasons.">You Can Still Upgrade Your Bid!');

define("BLOCKT_TITLE_No_APPROVED_WHY_PAD2", '"More good reasons.">You Can Still Upgrade Your Bid?');

define("BLOCKT_TITLE_NEW_LOWEST", '"New Minimum Bid">How this affects you ... ');
define("BLOCKT_TITLE_NO_BIDS", '"Price Slot Bidding Tips">Price Slot Bidding Tips');
define("BLOCKT_TITLE_TEMP_CURRENT_BID", '"More Tips About Bidding">More Info About Your Current Bid');

define("BLOCKT_TITLE_NO_BIDS_LOWEST", '"Ahead of ALL FREE Advertisers!">Ahead of ALL FREE Advertisers!');
define("BLOCKT_TITLE_NO_BIDS_WHY_PAD1", '"There\'s some good reasons.">Why Bid More Than Your Current Bid?');
define("BLOCKT_TITLE_NO_BIDS_WHY_PAD2", '"More good reasons.">Why Bid Even Higher?');

define("BLOCKT_TITLE_TEMP_WHY_PAD1", '"There\'s some good reasons.">Why Bid More Than Your Current Bid?');
define("BLOCKT_TITLE_TEMP_WHY_PAD2", '"More good reasons.">Why Bid Even Higher?');
define("BLOCKT_TITLE_HIGHER_SLOT", '"See Price Slot Reports And Bidding Tips">See Price Slot Reports And Bidding Tips');
define("BLOCKT_TITLE_LOWER_SLOT", '"See Price Slot Reports And Bidding Tips">See Price Slot Reports And Bidding Tips');
define("BLOCKT_TEMP_CURRENT_BID", "<h3>About Your Bid</h3><p>Yours is the first bid in this category. You will very likely get the top position but we can't guarantee it (click the \"Bidding Tips\" link below for more info on that) but, basically, other bids for the same amount or higher than your bid may have already been received. If that happens, yours will only be moved down one spot for each earlier or higher bid. Also, future higher bids can move your position down as well.");
define("BLOCKT_TEMP_WHY_PAD1", "<h3>Hedge Your Bid</h3><p>As explained below, all purchases (or bids) are subject to there having been an earlier buyer or buyers (for the same amount) which would outrank yours and move you down slightly. You can reduce the risk of that simply by buying a higher price slot (see the next price slot tip above for more info).");
define("BLOCKT_TEMP_WHY_PAD2", "<h3>There's More!</h3><p>But if another buyer get's the same idea (to buy one spot higher than the lowest) then your purchase would still be junior to it and displayed after it. We provide this one, extra price slot for those that want to \"make sure\". <p>Note: all bids/purchases are reviewed once a day and arranged according to price and, then, by their purchase date/time. That determines their ranking which is then broadcast to the network and repositions the ads in the displays.");

define("BLOCKT_NO_BIDS_WHY_PAD1", "<h3>Hedge Your Bid</h3><p>As explained below, all purchases (or bids) are subject to there having been an earlier buyer or buyers (for the same amount) which would outrank yours and move you down slightly. You can reduce the risk of that simply by buying a higher price slot (see the next price slot tip above for more info).");
define("BLOCKT_NO_BIDS_WHY_PAD2", "<h3>There's More!</h3><p>But if another buyer get's the same idea (to buy one spot higher than the lowest) and has already submitted the bid then theirs would have more seniority and your purchase would be junior to it and displayed after it. We provide this one, extra price slot for those that want to \"make sure\". <p>Note: all bids/purchases are reviewed once a day and arranged according to price and, then, by their purchase date/time. That determines their ranking which is then broadcast to the network and repositions the ads in the displays.");


define("BLOCKT_APPROVED_WHY_PAD1", "<h3>Hedge Your Bid</h3><p>As explained below, all purchases (or bids) are subject to there having been an earlier buyer or buyers (for the same amount) which would outrank yours and move you down slightly. You can reduce the risk of that simply by buying a higher price slot (see the next price slot tip above for more info).");
define("BLOCKT_APPROVED_WHY_PAD2", "<h3>There's More!</h3><p>But if another buyer get's the same idea (to buy one spot higher than the lowest) and has already submitted the bid then theirs would have more seniority and your purchase would be junior to it and displayed after it. We provide this one, extra price slot for those that want to \"make sure\". <p>Note: all bids/purchases are reviewed once a day and arranged according to price and, then, by their purchase date/time. That determines their ranking which is then broadcast to the network and repositions the ads in the displays.");







define("BLOCKT_NO_BIDS_LOWEST_BID", "<h3>Lowest Available Bid</h3><p>This is the lowest price slot available (see the section below for how we derive it). Yours is the first and only bid in this category. You will very likely get the top position but we can't guarantee it (click the \"Bidding Tips\" link below for more info on that) but, basically, other bids for the same amount or higher than your bid may have already been received(bids are only opened once a day and no reporting is done of already submitted or upgraded bids). If that happens, yours will only be moved down one spot for each earlier or higher bid. Also, future higher bids can move your position down as well.");
define("BLOCKT_NEW_LOWEST_BID", "<h3>New Lowest Available Bid</h3><p>This is the result of a lower BSV price. In order to achieve a minimum bid of approximately $5 USD a month, this is now going to be the lowest price slot available. Price slots that were lower than this one will no longer displayed nor available to be selected. When your purchased price slot is lower than this one it will be effected slightly. You will still be charged the same low price. But since every bidder will now be outbidding you, expect to be moved down further from the top as they do (or you can increase your bid now)");
define("BLOCKT_NEW_LOWEST_BID_MODELLING", "<h3>This Would Be The New Lowest Available Bid</h3><p>This would become the lowest price slot available to new bidders. Previously displayed price slots that were lower than this one would no longer be displayed nor available to be selected. If your purchased price slot is lower than this one it wouldn't be effected. You would still be charged the same low price and could cancel it. But if that was the case then expect to be moved down further from the top since every bidder would then be outbidding you and gaining seniority in those price slots. This modelling helps show how expected BSV price movements might shape your strategy.");

define("BLOCKT_NO_LONGER_DISPLAYED_MODELLING", "<h3>This Would No Longer Be Displayed</h3><p>If this was the real BSV price it would say this price slot is not available for purchase and for you to select a higher (i.e. active) price slot.");




define("BLOCKT_NO_APPROVED_WHY_PAD1", "<h3>Hedge Your Bid</h3><p>As explained below, all purchases (or bids) are subject to there having been an earlier buyer or buyers (for the same amount) which would outrank yours and move you down slightly. You can reduce the risk of that simply by buying a higher price slot (see the next price slot tip above for more info).");
define("BLOCKT_NO_APPROVED_WHY_PAD2", "<h3>There's More!</h3><p>But if another buyer get's the same idea (to buy one spot higher than the lowest) and has already submitted the bid then theirs would have more seniority and your purchase would be junior to it and displayed after it. We provide this one, extra price slot for those that want to \"make sure\". <p>Note: all bids/purchases are reviewed once a day and arranged according to price and, then, by their purchase date/time. That determines their ranking which is then broadcast to the network and repositions the ads in the displays.");
define("BLOCKT_NO_APPROVED_LOWEST_BID", "<h3>Lowest Available Bid</h3><p>This is the lowest price slot available (see the section below for how we derive it). Yours is the first and only bid in this category. You will very likely get the top position but we can't guarantee it (click the \"Bidding Tips\" link below for more info on that) but, basically, other bids for the same amount or higher than your bid may have already been received(bids are only opened once a day and no reporting is done of already submitted or upgraded bids). If that happens, yours will only be moved down one spot for each earlier or higher bid. Also, future higher bids can move your position down as well.");


define("BLOCKT", "<h3>Stats</h3><p>Current Bitcoin Bids<p>Current Demo Coin Bids<p>Current Bids Higher Than This One<p>Current Bids Lower Than This One");
define("BLOCKT2", "Bidding Tips");

define("BLOCKT_APPROVED_BEGIN", "<h3>Results</h3><p>Your website has been processed, approved and is now displayed on all the web directories of the member of the Manna Network Co-operative Ad Network");
define("BLOCKT_APPROVED_MID1", "<p>Yours is the only bid (so far) and your website listing is displayed in the top position in this category");
define("BLOCKT_APPROVED_MID2", "<p>There are ");

 define("BLOCKT_APPROVED_MID3", " bids (so far) and your website listing is displayed in the ");
define("BLOCKT_APPROVED_MID4", " position in this category");
define("BLOCKT_APPROVED_END", "<p>Any future bidders can match your bid (and be listed right behind yours) or they can select a higher price slot and be listed ahead of yours. If/when that occurs it will push your listing down by as many higher bidders there are in the category but you will still be listed ahead of the rest for the same daily fee<p>Your account will be debited once a day. Be sure to keep an adequate balance. If/when there are insufficient funds your listing reverts to its previous free status and position. You will have lost the seniority (i.e. the date and time the position was purchased) and could only be relisted (at the same price) behind others that already are in that price slot.");


define("BLOCKT_NO_APPROVED", "<h3>Pending</h3><p>Your bid is being processed, pending approval and admission of your website into the web directories of the members of the Manna Network Co-operative Ad Network<p>Yours may or may not be the only bid submitted in this category. Bids in the same priceslot are ordered by the date/time their bid was submitted (not their approval date/time).So excepting and reserving that other bids for the same amount have been previously submitted, your website listing (once your website is approved) will likely be displayed in the top position in this category<p>Any future bidders can match your bid (and be listed right behind yours) or they can select a higher price slot and be listed ahead of yours. If/when that occurs it will push your listing down by as many higher bidders there are in the category but you will still be listed ahead of the rest for the same daily fee<p>Your account will be debited once a day. Be sure to keep an adequate balance. If/when there are insufficient funds your listing reverts to its previous free status and position. You will have lost the seniority (i.e. the date and time the position was purchased) and could only be relisted (at the same price) behind others that already are in that price slot.");
define("BLOCKT2_APPROVED", "Bidding Tips");

/* moved to commons
define("MINIMUM_EXPLAINED1", "<h3>How we establish minimum bid (i.e. price slot) prices:</h3>Crypto currencies are known for their volatility and our unique bidding system helps take some of the sting out of price swings. We enable bids to start between ");
define("MINIMUM_EXPLAINED2", " worth of BitcoinSV (BSV) per month (DEMO Coin mode mimics the BSV one by using the same \"prices\"). We charge on a per day basis and set the lowest price slot displayed to between ");//$5 

define("MINIMUM_EXPLAINED3", " worth of BitcoinSV to achieve a monthly fee between those amounts. The lowest available bid ("); 
define("MINIMUM_EXPLAINED4", ") represents the amount of BSV (or Demo Coin) at current prices to be worth between ");//$5
define("MINIMUM_EXPLAINED5", " per month advertising expense (take that amount times 30 days times the current BSV price to check for yourself). <p>&nbsp</p><p>Note that since the price of BSV changes, so too will the minimal price slot displayed. That means if the price decreases after your purchase then your price slot may no longer be displayed for anyone else to purchase. This doesn't affect your subsciption and it will continue at that \"less than\' monthly target price. What it does mean is that all future buyers will only be able to get higher positions than yours and your ad position will be consistently pushed lower (but still outranks all free ads).");


define("SUCCESSFUL_BID_SUBMISSION1", "<h1>Thank you!</h1> 
<h4  style='text-align:left;'>The transaction has been recorded here at your agent site and also has been sent along to Manna Network to be compared with all other bids. They will be ordered highest to lowest and by seniority (i.e. according to when bought). The purchase will initiate a subscription with regular automatic daily deductions from your appropriate \"prepaid\" account (i.e. either Bitcoin or Demo coin as you have selected). The daily fee will be deducted from this point forward until any of the following: 1) cancelled by you 2) you change the price slot (doing so resets your seniority in the new price slot) or 3) there is insufficient funds in your account.</h4><h4><a href=''>Return to your Member Dashboard</a>");
	 
define("SUCCESSFUL_BID_SUBMISSION2", "<h4>Your seniority date for this price slot is :");
*/
define("NEW_MINIMUM_BID","ATTN:<BR> NEW MINIMUM BID<BR>");
define("BLOCKT_NEW_MINIMUM_BID","HOW THIS AFFECTS YOU");
define("BLOCKT_NEW_MINIMUM_BID_MESSAGE1","<h5>This affects the bidding display</h5><p>We have a minimum opening target of $");
define("BLOCKT_NEW_MINIMUM_BID_MESSAGE2"," per month and a decrease in the dollar value of BSV causes an adjustment in the price slots we offer. We will not be making priceslots below the New Minimum Bid available for new bidders. Your purchase and possession of your below-minimum price slot will continue for as long as you like. But since we will only be offering higher price slots then every new bidder (even the lowest) will push your link further from the top spot.");

define("BSV_VOLATILITY_MODELLER","<h3>BSV Volatility Modeller</h3><h5>See how price slots are affected by higher/lower Bitcoin prices</h5>  <p>Selecting one of these will alter the current BSV price by the amount listed which will cause changes to the fee amounts displayed in the price slots below.</p>");

define("BSV_VOLATILITY_MODELLER_ON","<h3>You ARE OPERATING IN BSV Volatility Modeller MODE</h3><h5>The price slots displayed may have been affected by the higher/lower Bitcoin prices you selected</h5>  <p>It shows how the current BSV price will cause changes to the fee amounts displayed in the price slots offering to bidders.</p><h6>Select the RESTORE option in the dropdown to return to normal");
/*
define("BSV_VOLATILITY_MODELLER_HIGHER","Higher BSV Price");//used in the dropdown
define("BSV_VOLATILITY_MODELLER_LOWER","Lower BSV Price");//used in the dropdown

define("BSV_VOLATILITY_MODELLER_RESTORER","Restore Current BSV Price");//used in the dropdown
*/
define("BSV_PRICE_TITLE_VOLATILE","<h5>YOU ARE OPERATING IN MODELLER MODE<BR>NO BIDS OR CHANGES ARE ENABLED<BR>SELECT THE RESTORE OPTION IN THE DROPDOWN TO THE RIGHT TO RETURN TO NORMAL</h5>");
define("REG_BLOKT_CATEGORY_MESSAGE", "<p>CATEGORY</p>
<p>The category you select affects your ad campaign results. You
should (as a rule) select the highest (but most descriptive) that you
can UNLESS there is so much competition there from other advertisers
that you will be too low in the display. If that is the situation you
can select a lower level category (which should also be more specific
to your business, service or blog topic) and you will face far less
competition. You can also bid for better placement using either \"DEMO COIN\" (a supply of them will be credited to you) or with BitcoinSV.</p>");
define("REG_BLOKT_CATEGORY_MOUSEOVER", "Category Selection Help");
define("REG_BLOKT_REGIONAL_MESSAGE", "<p>Regional Filtering</p>
<p>The main purpose for the regional option is to enable the END USER
(sic. The Internet users viewing the ads) to filter out ad results
from unwanted locations and find advertisers. Some businesses don’t
draw customers from any specific region or location so they can leave
this option empty. The way it works is the viewer selects the
location they want to limit the results to. Only listings in a
country selected will appear, for example (but results from all fifty
states in the USA would also appear) but if the viewer selects a
specific state (or city) then only those will appear..</p>");
define("REG_BLOKT_REGIONAL_MOUSEOVER", "Regional Selection Help");
define("REG_BLOKT_URL_MESSAGE", "<p>CREATE A LANDING PAGE</p>
<p>It is strongly suggested you create a landing page so that you can
track the results of the ad campaign yourself. Note, it doesn’t
have to be unique content (because we have a No Index/No Follow meta
tag on the directory to avoid duplicate content search engine
problems). You can do something as simple as making a duplicate of
your home page (with a different name of course) and entering that
url here. To track the results of the advertising campaign go into
your own stats software (example: AWStats in CPanel) to see how much
traffic you are receiving from the ad network (you can be pretty
certain the traffic came from the ad network if the only links to
that page are the ones in the ad network).</p>");
define("REG_BLOKT_URL_MOUSEOVER", "URL/Landing Page Help");
define("REG_BLOKT_DESCRIPTION_MESSAGE", "<p>Add An Ad Description</p>
<p>Try to come up with an exciting and interesting GENERAL
description of your main goods, services or blog topic. Attention
e-commerce sites: DO NOT add individual products (the ad will be
rejected without notice).</p>");
define("REG_BLOKT_DESCRIPTION_MOUSEOVER", "Description Help");
define("REG_BLOKT_PASSWORD_MESSAGE", "<p>Password</p>
<p>Create a VERY secure password for your account. That is important
because the Manna Network uses a crypo-currency payment system and it
draws hackers (at your control panel login). Use a secure password to
keep anyr funds safe .</p>");
define("REG_BLOKT_PASSWORD_MOUSEOVER", "Password Help");
define("REG_BLOKT_EMAIL_MESSAGE", "<p>Use A Valid Email Address</p>
<p>You will be sent a verification email before your ad will be
processed. It also gives you access to your Control Panel where you
can add more ads, edit existing ads and bid for better position. 
</p>");
define("REG_BLOKT_EMAIL_MOUSEOVER", "Email Info");
define("REG_BLOKT_TITLE_MESSAGE","<p>ADD AN AD TITLE</p>
<p>Create something exciting and descriptive about your business or
website. Try to make it eye-catching and informative about the goods
or services you provide or, if yours is a blog site then enter
something describing your main topic.</p>");
define("REG_BLOKT_TITLE_MOUSEOVER", "Title Hint");
define("ADD_URL_WELCOME_TITLE", "You Can Add More Ads To Our Classified Cooperative!");
 define("ADD_URL_WELCOME_BODY", "<p align='left' style=\"color:black;\">You can 1) insert more ads (but place them in different categories and create unique landing pages for each) or 2) insert other websites THAT YOU OPERATE (don't add websites operated by others [have them register their own sites themselves]).</p>
 <p  align='left' style=\"color:black;\">Let us mention, again, about how you can add this great, free web directory to your own site so you can become part of this bigger effort to make your website successful!");

