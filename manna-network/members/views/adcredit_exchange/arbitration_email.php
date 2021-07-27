<?php


$subject = 'BungeeBones Seller Files Arbitration Request In Your Pending Transaction';
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

<P align="left">I regret to inform you that the seller of the BungeeBones Advertising Credits that you entered into a transaction with to purchase advertising credits through our Market Bulletin has filed a request for arbitration from BungeeBones Administration. As a result, the transfer of their credits to your account has been put on hold pending the arbitration process.';

$message .='<p align="left"><h1 align="left">We seriously hope you retained the deposit receipt from the bank and any other helpful proof you made of the deposit (such as a business card from a teller, a picture of you or your car at the bank\'s drive through, a GPS location etc). The confirmation of the deposit is totally your responsibility.</h1>
</P>';


$message .= '<h1 align="left" style="color:red">If it is found that the seller has made a false or erroneous report then this will be your only opportunity to halt the return of the credits to the seller.</h1>
';

$message .= '
<P align="left">To put a stop to the transfer requires you to email robert@BungeeBones.com and send copies of any and all information/receipts etc that you have.</p>

<p align="left">NOTE: There is a 5% Arbitration Fee charged to the seller if the arbitration decision goes in your favor. You should have bank deposit receipts to verify the deposit. If you do not provide them the seller wins. Arbitration can include split disbursements between the parties. If you do provide proof then the seller will be required to provide their proof such as copies of a bank statement for the time period in question. Their failure to do so will result in the decision going to the you (the buyer) and BungeeBones will transfer the credits to your account.

I apologize for the delay. Perhaps the seller\'s bank made an error. Perhaps the seller made an error. It\'s even possible the seller is making a false report. Perhaps you made the error. All of those possibilities are beyond the control of BungeeBones. Your quick response to this request will help achieve a prompt solution.

<p align="left">Thank you,
<p align="left">Robert Lefebure
<br>Owner/Develop/Head Administrator
<br>BungeeBones.com


</TD></tr></table>
</body></html>';

echo '<br>  to = ', $user_email;
echo '<br>   message = ', $message;
$mail_sent = @mail( $user_email, $subject, $message, $headers );
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed"
echo $mail_sent ? "Mail sent" : "Mail failed";


