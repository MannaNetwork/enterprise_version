<?php
//echo '$_SERVER[DOCUMENT_ROOT] = ', $_SERVER['DOCUMENT_ROOT'];
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
get_header();
//include('bootstrap_header.php'); 
//including the agent config brings in the administrative auths which prevents access via login. Since registration is occurring from remote sites (I'm pretty sure) then there is probably different configs 9i.e. they don't include agent configs) in the registration process
//include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/agent_cfg.php");
//configs
include('styles.css');

echo '<div style="
width: 80%;
height: 1000px;
padding-top: 25px;
padding-bottom: 35px;
padding-left: 5px;
padding-right: 10px;
border: 25px solid;
margin: 0 auto;
"><h1 style ="text-align:center;">Bidding Tips And Strategies</h1>';
echo '<p>Preface: One of the hurdles in launching and operating a crypto-currency-only co-operative (or company) was its (i.e. crypto\'s) volatility. Our unique bidding and purchase system goes a long way towards mitigating those value swings by offsetting their effect with better position and/or more traffic. ';
echo '<p>&nbsp;</p>
<h4>What Is A "Price Slot"</h4>
<p>Basically, a "Price Slot" is the daily fee an advertiser subscribes to pay for a tentative position in the web directory\'s results display page. There are 20 links displayed per web directory results page. In theory each of those 20 potential positions could receive a unique bid from 20 individuals and, so, there is a maximum of twenty potential price slots per web directory display page. But that is unlikely because of the pricing method. Each price slot is one and a half-times higher than the previous one. A purchase of the number one (top) position automatically causes the creation of another to offer to others to outbid them by that one and a half-times higher increment. But in order to avoid overpricing, others can simply match the same bid as previously purchased position and take up a position (or price slot) below that previous bid. Both the first and second listings will be paying the same amounts as could a third, fourth, fifth etc. So while there is a slim possibility of twenty potential price slots on a page there probably will be two or three. They will remain in that order until someone comes along and purchases higher priced ones above what they are paying. The new bidder will cause the lower bidders to all be pushed down one position. In our vernacular, that new bidder bought a higher priced "Price Slot" while the others occupy the lower priced "price slots". Each price slot is expressed as a decimal percentage of the crypto currency we are using. Our bidding chart calculates and shows the value of that crypto in fiat currency terms for reference. 
<p>&nbsp;</p>
<p>Another factor affecting placement is the date and time the price slot was purchased (we call it "seniority"). Those that buy in to a previously populated price slot receive a later time stamp than the current occupants. When the links (or ads) are displayed in the directory they are ordered, first, by the price slot amount but, when there are more than one in the same price slot, then those are ordered from oldest to newest. 
<p>&nbsp;</p>
<p>The combination of both the price slot price and seniority affecting positioning introduces some opportunities for bidders to develop some game theory and strategies based on such factors as whether the crypto price will go up or down and/or whether such price fluctuations are permanent or just a temporary change. Another factor might be how fast the Manna Network is growing and whether the amount of web traffic is increasing (it might be better to take a slight loss for a little while to be made up by getting more web traffic in the future). 
<p>&nbsp;</p>
<h4>Scenario #1: A rising crypto price</h4>
<p>Once you have placed a bid (and or made a purchase - we use both terms interchangeably) for a certain position, that position is always at risk of a higher bidder (or a number of them) offering more for the position and pushing yours down the list accordingly. But if the crypto price is expected to rise there will also be less chance others will be willing to chance the higher price in both crypto terms and actual value. What I mean is we all tend the think in terms of each our own local currencies. So when the price of crypto goes up the cost of our advertising does too. The advertisers will abandon their current price slot for a lower one when that happens but they also lose seniority and start at the bottom of their newly selected (but lower priced) price slot. It may be wiser/more profitable to maintain the higher fees if the network is growing and delivering more value in return. Paying more for a better product is a fair deal that, at the same time, forces competitors for your position to bear an even higher price to displace yours. 
<p>&nbsp;</p>
<h4>Scenario #2: A falling crypto price</h4>
<p>If and/or when the crypto price falls after you acquire it you effectively are getting the same amount of advertising and web traffic for less money. Normally, a business would try to raise their prices in such a situation as their profits shrink along with the lower prices but in our system we leave it to your competition to increase their bids (or you can even increase your own bid without waiting for them to out bid you). If and/or when the advertisers feel the price drop is long-term it would incentivize them to bid higher in crypto price terms (but lower in their local currencies than it used to be). 
<p>&nbsp;</p>
<p>&nbsp;</p>
</div>';

//include('bootstrap_footer.php');
get_footer();
?>
