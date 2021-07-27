<?php

#$file=eregi_replace($_SERVER['SERVER_NAME'], $_SERVER['PHP_SELF']);
#$var=explode("/", $file);
#$url_page = $var[1] ;
#$volunteer == $var[2] ;
//include("includes/mk_index.php");
$nasaadresa = $_GET['users_email'];  //please replace this with your address

$mail = $_POST['Email'];
$porukaa = $_POST['Message'];

if (preg_match("/href/i", "$porukaa")) {
exit();
}



$poruka = str_replace("\r", '<br />', $porukaa);
//START OF THANKS MESSAGE
//you may edit $thanks message. this is a message which displays when user sends mail from your site


$thanks = "
<div style='text-align: center'><br />
<b>Your message has successfuly been sent!<br /></b>
#### MESSAGE TEXT #### 
<br /><br />
$poruka
<br /><br />
#### END OF MESSAGE ####
<br /><br />
You will receive a copy of the message at your email address <b>($mail).<br />We will reply you soon as possible<br /></b></div>";

$page_html1 = 
'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" dir="ltr">
<head>
<title>BungeeBones Distributed Web Directory 2.0 Advertising System Contact Form</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />






</head>
<body bgcolor="#BDCBDE" class="sky" id="sky">
<div id="doc2">					
	<div style="text-align: center; id=hd">
			
	      	<a href="http://bungeebones.com" class="cssbutton sample a"><span> HOME </span></a>&nbsp;<a href="http://bungeebones.com/articles" class="cssbutton sample a"><span> ARTICLES </span></a>&nbsp;<a href="http://bungeebones.com/articles/faq.php" class="cssbutton sample a"><span> FAQ </span></a><a  class="cssbutton sample b"><span> CONTACT US </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/register.php" class="cssbutton sample a"><span> REGISTER </span></a>&nbsp;<a href="http://bungeebones.com/bungee_jumpers/login.php" class="cssbutton sample a"><span> LOGIN </span></a>&nbsp;<a href="http://bungeebones.com/bungee_bones" class="cssbutton sample a"><span> LINK EXCHANGE </span></a>&nbsp;<a href="http://bungeebones.com/subscription_sites" class="cssbutton sample a"><span> EXAMPLE SITES </span></a><a target="_blank" href="http://bungeebones.com/articles/interview.php" class="cssbutton sample c"><span>ABOUT </span></a>>
	    
	</div>
  <div id="bd">

  <div style="text-align: center">
    <div>&nbsp;</div>
    <div>&nbsp;</div>
  	 <a href="./bungee_jumpers/register.php"><img border="0" src="../images/logo3w.gif" alt="BungeeBones.com is a web 2.0 collaborative advertising system. Members install and distribute our unique web directory script on their web sites and create web traffic for our advertisers. In exchange they can earn some financial rewards." /></a>
  </div>
	
	<div id="custom-doc">
	<div style="text-align: center">
         
    <div>&nbsp;</div>
    <div>&nbsp;</div>';

  	
				
		
  '<div>&nbsp;</div>
  <div>&nbsp;</div>
   
  
 
	<div id="ft">
	
		 </div>
    
</div>

</body>
</html>';



//do not edit nothing below this line  until comment (ME) say so if you don't have skills with PHP
//END OF THANKS MESSAGE

if($_POST['submitform']) 
{

	$Name = $_POST['Name'];
	$Email = $_POST['Email'];
	$Message = $_POST['Message'];
	$require = $_POST['require'];
	$browser = $HTTP_USER_AGENT;
	$ip = $_SERVER['REMOTE_ADDR'];

	$dcheck = explode(",",$require);
	while(list($check) = each($dcheck)) 
	{
		if(!$$dcheck[$check]) {
		$error .= "You have not filled this : <b>$dcheck[$check]</b>.<br />";
		}
	}
	//if((!ereg(".+\@.+\..+", $Email))  (!ereg("^[a-zA-Z0-9_@.-]+$", $Email))){
	//$error .= "Wrong e-mail.<br />This e-mail address <b>$Email</b> - is not valid. Please enter correct e-mail address.";
	//}
	if($error)
	{
	echo $error;
	echo '<br /><a href="#" onClick="history.go(-1)">Please try again.</a>';
	}
	else
	{
//START OF INCOMING MESSAGE (this message goes to your inbox)
$message = "
Name: $Name:
E-mail: $Email

Message: $Message

-----------------------------
Browser: $browser
IP: $ip
";
//END OF INCOMING MESSAGE (this message goes to your inbox)

$subject = "Message from your BungeeBones.com - Message was sent by $Name"; //subject OF YOUR INBOX MESSAGE sent to you

$subject2 = "You have succesfully sent message from BungeeBones.com!"; //subject of OUTGOING MESSAGE - edit this
//OUTGOING MESSAGE TEXT
$message2 = "You have sent a message to site admin of a BungeeBones.com:
-----------------------------
From: $Name:
E-mail: $Email
	
Message: $Message

-----------------------------
";
//END OF outgoing MESSAGE


mail($nasaadresa,"$subject","$message","From: $Name <$Email>");
mail($Email,"$subject2","$message2","From: <$nasaadresa>");
//include("articles/include_top.txt");
include($_SERVER['DOCUMENT_ROOT']."/960top.php");

echo "$thanks";
include($_SERVER['DOCUMENT_ROOT']."/960bottom.php");
	}
}
else
{
//this is contact form down here, please edit if you know what are you doing... or the contact form may not be working.
include($_SERVER['DOCUMENT_ROOT']."/960top.php");

?>

<table cellpadding="15" cellspacing="15"><tr><td>
        <form name="contactform" action="<?echo $PHP_SELF ?>" method="post"><input type="hidden" name="require" value="Name,Email,Message"></input>
				     
  
				<div style="text-align: left">&nbsp;&nbsp;<b>Name:</b><input name="Name" size="40" value="Test email from me"></input>
				</div>
				<div style="text-align: left">&nbsp;<b>E-mail:</b><input name="Email" size="40" value="<?php echo $_GET['users_email'];?>"></input>
				</div>
				<div style="text-align: left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea name="Message" rows="15"  style='width:340px;'>Testing my email from Bungeebones.com to make sure I receive the automatic notice (sent to me by Bungeebones) when the buyer notifies BungeeBones and claims to have made the cash deposit to my bank account... so that I can verify it immediately and not get ripped off!</textarea>
        </div>
				<div style="text-align: left">
        <button class="cssbutton sample a" type="submit" value="Send" name="submitform"><span> SEND </span></button>
        <button class="cssbutton sample a" type="reset" value="Reset" name="reset"><span>RESET</span></button>
        </div></form>
       </td></tr></table>	
  				
  			



<?
include($_SERVER['DOCUMENT_ROOT']."/960bottom.php");
}
?>
