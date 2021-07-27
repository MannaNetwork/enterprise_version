<?php

//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 

$user_id = $_SESSION['user_id'];
/*
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2accusersconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

		$query = "SELECT user_name, user_email, user_id FROM users WHERE user_id = '".$user_id."'";

		$result = @mysqli_query($connect, $query ) or die("Couldn't execute 'get email Account' query");
do{
		$user_email = $row['user_email'];
	}while ($row = mysqli_fetch_array($result));
*/
$bs_action = $_GET['action'];

$moniker="<h5>Terms Of Service</h5>";

include('user_cpanel_submenu.php');
if($bs_action=="seller"){
include('exchange_seller_submenu.php');
}
else
{
include('exchange_buyer_submenu.php');
}

$msg ="<table id='member'><tr><td><h1>Terms of Service</h1>

<p class='smallerFont' >The following is the agreement between Robert Lefebure (aka BungeeBones) and everyone who utilizes the BungeeBones advertising credit exchange services, escrow services, and/or arbitration services. By participating in any of the listed BungeeBones services you indicate your acceptance of this agreement and your consent to be bound by it. The terms for participation in these services is as follows:
<br>&nbsp;<br>

<h2>LIMITATION OF LIABILITY</h2>

<p class='smallerFont' >Each user agrees to indemnify and hold BungeeBones harmless for any losses resulting from any use or attempted use of these services. These services are only available for lawful purposes. Applicable state or federal laws and regulations may limit these services. Sellers and buyers are responsible for determining the laws that apply to their activities in their own jurisdictions under these services. 

<br>&nbsp;<br>
<h2>LIMITATION OF  WARRANTIES</h2>

<p class='smallerFont' >You agree that your use of these services is at your sole risk. These services are provided on a strictly \"as is\" basis. BungeeBones does not provide any warranties that any services provided nor any actions requested of buyers or sellers are in compliance with their own local laws. It is the buyer's and seller's responsibility to determine if the actions required of them during these transactions are in compliance with the laws in their own jurisdictions.
<p class='smallerFont' >BungeeBones does guarantee
<ol><li>That the ad credits advertised by the seller are' indeed, in the account of the seller</li>
<li>Are not encumbered in any known way and are, therefore, available to be transeferred to a buyer upon either the seller's command, automatically by BungeeBones scripting or manually by BungeeBones administration and arbitration.</li>
</ul>
<br>&nbsp;<br>
<h2>BungeeBones RIGHTS</h2>

<p class='smallerFont' >BungeeBones may suspend or terminate your use of these services at any time, without notice for any reason, in BungeeBones' sole discretion. BungeeBones reserves the right to change this agreement at any time.
<p class='smallerFont' >In any disputes between buyers and sellers either party can initiate arbitration by proposing up to three arbitrators for the other party to select from. In the event there is no agreement between the parties as to the arbitrator to use then BungeeBones administration has the right to and that both parties agree that BungeeBones can cast the deciding vote to select an arbitrator. 
<p class='smallerFont' >In any disputes between buyers and sellers that end up in arbitration the parties agree that the arbitrators decision is final and that Bungeebones will distribute the disputed advertising credits as instructed by the arbitrator.
<p class='smallerFont' >There is no time limit placed upon BungeeBones to make a decision in an arbitration request beyond what time is \"reasonable\".
<p class='smallerFont' >The parties agree to submit any disputes with BungeeBones itself to third party arbitration and that damages will be limited to the amounts that are the subject of the arbitration and that are still in BungeeBones possession.";

$msg .="
<br>&nbsp;<br>
<h2>TERMS SPECIFIC TO BUYERS</h2>
<p class='smallerFont' >
BUYERS agree to not ACCEPT a SELLER'S offer unless they are able to get to the SELLER'S bank and make the deposit within the time period specified in the SALES AGREEMENT. 
<p class='smallerFont' >
BUYERS agree to not submit a \"Successful Deposit Report\" until AFTER they have actually deposited the correct amount of CASH (no checks, money orders, travelers checks etc) into the BUYER'S bank account and they actually have the deposit receipt from the bank IN THEIR POSSESSION! 
<p class='smallerFont' >
It is suggested that the BUYER uses a smart phone with Internet capability and 1) Wait to accept the SELLER's offer until they are at the bank lobby or drive thru 2) then make the deposit, get their receipt, get a business card or ID of the tellerand 3) THEN use the smart phone to again access the BungeeBones web page to report the successful deposit. Depending on how long it takes the teller to actually process the transaction then both the acceptance of the offer and the report by the buyer can be accomplished in as little as a few moments.  

";

$msg .="
<br>&nbsp;<br>
<h2>TERMS SPECIFIC TO SELLERS</h2>

<p class='smallerFont' >It is the SELLER'S sole responsibilty to check their bank records and verify that a deposit had indeed been made after a BUYER has submitted to BungeeBones a Successful Deposit Report and said report had been forwarded to the SELLER'S EMAIL of record. 
<p class='smallerFont' >
It is the SELLER'S sole responsibilty to REPORT a false deposit using the Report A False Deposit Report On The Buyer/Force Arbitration link in their Exchange Menu which will result in the permanent cancellation of the automatic transfer of the credits to the BUYER. NOTE: There will be a 5% Arbitration Fee charged to the SELLER IF it is found the BUYER has sufficient proof of a deposit and the SELLER has wrongfully withheld transfer of the credits to the BUYER.
<p class='smallerFont' > 
The SELLER acknowledges the risk that if a BUYER were to submit a FALSE Successful Deposit Report and the SELLER does not check their bank account to verify the deposit within the time they alloted themselves in the listing agreement then the funds will automatically and irreversibly be transferred to the buyer at the end of said time period. The SELLER agrees to assume ALL RISKS associated with a BUYER making a false report of a deposit and the SELLER not making a timely discovery of the fraudulent report. There will be no reimbursement of advertising credits to SELLERS due to the seller not verifying a Successful Deposit Report by the BUYER within the allotted time.
<p class='smallerFont' >The BungeeBones website will send an email to the SELLER'S EMAIL ADDRESS ON RECORD - $user_email - when the BUYER submits their Successful Deposit Report. The SELLER acknowledges they have <a target='_BLANK'  href='testmail.php?users_email=$user_email'>TESTED (Click here to test your email address on record - $user_email; )</a> their email to make sure they receive it properly (i.e that it is not landing in the spam filters, does have the correct address etc.) 
<p class='smallerFont' >Seller acknowledges that there is no way of knowing the time of day when a BUYER makes a deposit because they can accept the offer 24/7 from anywhere, at anytime, so it is up to the SELLER to allocate themselves plenty of time during the configuration of the offer to verify the deposit.
<p class='smallerFont' >The SELLER agrees to make every effort to complete the transfer to the BUYER (after payment) in a timely manner by manually (i.e. clicking a link in their Exchange Menu) transferring the advertising credits themselves rather than waiting for the time limit to elapse and having the system transfer the funds automatically.
<p>&nbsp;</p>
<h2>BungeeBones Role In Arbitration and Dispute Resolution Between Buyers And Sellers</h2>
<p>&nbsp;</p>
<p class='smallerFont' >IT IS IMPORTANT THAT YOU READ THIS ENTIRE SECTION
CAREFULLY BECAUSE IT AFFECTS YOUR LEGAL RIGHTS. THIS SECTION PROVIDES
THAT ANY DISPUTE
BETWEEN BUYERS AND SELLERS MUST BE RESOLVED BY BINDING ARBITRATION
THAT REPLACES THE RIGHT TO GO TO COURT BEFORE
A JUDGE OR A JURY, AND MAY LIMIT YOUR RIGHTS TO DISCOVERY OR TO
APPEAL. IT FURTHER PROVIDES THAT YOU WILL NOT BE ABLE TO BRING A
CLASS ACTION OR OTHER REPRESENTATIVE ACTION IN COURT, NOR WILL YOU BE
ABLE TO BRING ANY CLAIM IN ARBITRATION AS A CLASS ACTION OR OTHER
REPRESENTATIVE ACTION. Either BUYERS OR SELLERS may, without the
other's consent, elect mandatory, binding arbitration of any claim,
dispute, or controversy raised by either BUYERS OR SELLERS against
the other arising from this Agreement or Your use of the Information
or this Web Site or any information You receive from BUNGEEBONES. All
Claims are subject to arbitration, no matter what theory they are
based on or what remedy they seek, whether legal or equitable. </FONT>
</P>
<p class='smallerFont' >No arbitration will be consolidated with any other
arbitration proceeding without the consent of all parties. This
arbitration provision applies to and includes any Claims made and
remedies sought as part of any class action, private attorney general
action, or other representative action. By consenting to submit Your
Claims to arbitration, You may be forfeiting Your right to share in
any class action awards, including class claims where a class has not
yet been certified, even if the facts and circumstances upon which
the Claims are based already occurred or existed. 
<h2>Choosing An Arbitrator</h2>
<p class='smallerFont' >
The party filing a
Claim in arbitration must select three possible arbitrators to administer the
arbitration and provide them to the other party from whom the other party will select one. BUNGEEBONES will, in the event of the disputing parties to agree on an arbitrator, break any deadlocks between the parties and select an arbitrator from the list or any other. The arbitrator selected will apply its own rules, codes, or procedures
in effect at the time the arbitration is filed, unless any portion of
those rules, codes, or procedures is inconsistent with any specific
terms of this arbitration provision or these Terms of Use, in which
case the terms of this arbitration provision and these Terms of Use
will govern. These rules and procedures may limit the amount of
discovery available to the BUYER and/or SELLER. </FONT>
</P>
<P><BR><BR>
</P>
<p class='smallerFont' >If a BUYER prevails against a SELLER in the
arbitration of any Claim then the SELLER shall be charged a fee equal
to 10% of the amount awarded to BUYER.</FONT></P>
<br>&nbsp;<br>
";

$msg .="
<p>&nbsp;</p>
<p class='smallerFont' >&nbsp;</p>

<o>Last Updated: June 2, 2014";








echo $msg;
echo '<a href="index.php"> <h2><u>Return To Advertising Credit Exchange Main Menu</u></h2></a>';
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>

</td></tr></table>';
?>
