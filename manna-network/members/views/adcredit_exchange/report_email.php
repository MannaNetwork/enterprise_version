<?php


$subject = 'BungeeBones Buyer Claims To Have Made Payment ... more';
//create a boundary string. It must be unique
//so we use the MD5 algorithm to generate a random hash
date_default_timezone_set('America/New_York'); 
$random_hash = md5(date('r', time()));
//define the headers we want passed. Note that they are separated with \r\n

//add boundary string and mime type specification
//$headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\"";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From: admin@bungeebones.com\r\nReply-To: admin@bungeebones.com";
$message = '
<html>
<head>
  <title>The Sale Of Your Advertising Credits Needs Your Immediate Attention</title>
</head>
<body>


<hr width="600">
<table align="center" width="600" >

<tr><TD align="center" width="600">
<P align="left">Hello from BungeeBones Admin.

<P align="left">I am pleased to inform you that the buyer of your BungeeBones Advertising Credits that you posted in our Market Bulletin claims to have completed the deposit within the agreed upon time frame.';

$message .='"><p align="left"><h1 align="left">It is imperative that you check your bank account to confirm that the deposit has, indeed been made and for the amount agreed upon and to do so before the expiration of the time limit you imposed upon yourself when you posted the credits for sale. The confirmation of the deposit is totally your responsibility.</h1>
</P>';


$message .= '<h1 align="left" style="color:red">If you find the buyer has made a false or erroneous report then this will be your only opportunity to halt the irreversable transfer of the credits to the buyer at the close of that time period.</h1>
';

$message .= '
<P align="left">To put a stop to the transfer requires you to go to BungeeBones.com before the expiration of that time and login. Got to <a href="http://bungeebones.com/members/adcredit_exchange/index.php">http://bungeebones.com/members/adcredit_exchange/index.php</a>. Select the View/Edit/Cancel/Transfer Current Offers link. Then select the "All Listings" link. Find the listing that the buyer has claimed to make the deposit for (it will have flashing yellow warnings). Click the "Request Arbitration" button.</p>

<p align="left">NOTE: There is a 10% Arbitration Fee charged to you, the seller, if the arbitration decision goes in the buyer\'s favor. The buyer should have bank deposit receipts to verify the deposit. If they do not provide them then you win and your advertising credits will be immediately unfrozen. If they provide proof then you will be required to provide copies of a bank statement for the time period in question. Failing to do so will result in the decision going to the buyer. 


</TD></tr></table>
</body></html>';

echo '<br>  to = ', $user_email;
echo '<br>   message = ', $message;
$mail_sent = @mail( $user_email, $subject, $message, $headers );
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed"
echo $mail_sent ? "Mail sent" : "Mail failed";


