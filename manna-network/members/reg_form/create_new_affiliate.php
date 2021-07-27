<?
if (isset($_GET['action']) && $_GET['action'] == "log_out") {
//$test_page_protect->log_out(); // the method to log off
session_start();
session_destroy();
}
// include the configs
require_once("config/config.php");
// load the login class
// load php-login components
require_once("php-login.php");
// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...
$user_id = $_SESSION['user_id'];
$moniker="<h5>Website Advertising Co-Operative</h5>";
$body_width="wide";
include('../../960top.php');
?>

<div class="grid_2 alpha">

<?php
$url_path_prep = $_SERVER['REQUEST_URI'];//url path used in menu.php

include('menu.php');
?>

</div>

<div  class="grid_10 omega">

<TABLE id="member" CELLPADDING=4 CELLSPACING=1><FONT COLOR="#000080">

	<TR VALIGN=TOP>
	
		<TD  STYLE="padding-top: 0.04in; padding-bottom: 0in; padding-left: 0.04in; padding-right: 0.04in">
			<UL>
				<LI><FONT FACE="Andika" COLOR="#000080"><FONT SIZE=5>Get free,
				hosted affiliate registration pages</FONT></FONT>
				<LI><FONT FACE="Andika" COLOR="#000080"><FONT SIZE=5>Earn 10%
				commissions in Bitcoin</FONT></FONT>
				<LI><FONT FACE="Andika" COLOR="#000080"><FONT SIZE=5>No website
				necessary</FONT></FONT>
				<LI><FONT FACE="Andika" COLOR="#000080"><FONT SIZE=5>Can be linked
				to from anywhere</FONT></FONT>
<LI><FONT FACE="Andika" COLOR="#000080"><FONT SIZE=5>Link can be added to brochures, business cards etc.</FONT></FONT>
<LI><FONT FACE="Andika" COLOR="#000080"><FONT SIZE=5>Can add sub-affiliates and/or partner websites and earn commissions on their sales.</FONT></FONT>
			</UL>
		</TD>
	</TR>
</table>
<p>&nbsp;</p>
<h2><FONT COLOR="#000080">Were you referred here by an affiliate?</h2>
<p>If so, then for their sake please locate their affiliate page and proceed there before registering. Use the "Find Affiliate" button in the right menu and select the website they are working under (from the dropdown). Then select the actual individual from the next dropdown. If you don't know any particular individual then you have the choice of registering from that page (which will give the sale credit to the website) or you can select any individual in the dropdown and register there so that they get the credit. 
<hr>
<P ALIGN=LEFT><FONT COLOR="#000080">Participants in the Affiliates
program get all the sames features as the Partner program but without
having to install a web directory on their website. They will get a
commission of 10% rather than the 50% share that the Partners receive
since the Partners contribute their web traffic in addition to their
selling efforts. But since Affiliates don't need to install it on a
website participation is much much easier. Instead of installing the
web directory they get a series of pages on the BungeeBones web
directory which includes a demo of the web directory (click the Directory button in the right menu to see what you would get) and registration
forms. Users that register at the affiliate site receive all the same
options as those that register at a Partner site. They can, for
instance, install the web directory on their own website and earn 50%
themselves. The affiliate where they registered (their uplin) will
receive 10% of the remainder.</FONT></P>
<P ALIGN=LEFT><BR><BR>
</P>
<P ALIGN=LEFT><FONT COLOR="#000080">Affiliates Can Be:</FONT></P>

<OL>
	<LI><P ALIGN=LEFT><FONT COLOR="#000080">Those with a website who
	merely add a link </FONT><FONT COLOR="#000080"><I>and, thus, send
	customers t</I></FONT><FONT COLOR="#000080">o their affiliate page
	on the BungeeBones.com website at
	BungeeBones.com/affiliate/</FONT><FONT COLOR="#000080"><I>THEIR-Affiliate-Name
	</I></FONT>
	</P>
	<LI><P ALIGN=LEFT STYLE="font-style: normal; text-decoration: none"><FONT COLOR="#000080">Those
	without a website can still use the affiliate program to earn
	Bitcoin just by providing their link to a customer in any way they
	can (brochure, business card, billboard, etc :-) </FONT>
	</P>
<LI><P ALIGN=LEFT STYLE="font-style: normal; text-decoration: none"><FONT COLOR="#000080">Charities, Fundraisers, Schools etc can sign up their supporters as affiliates who can then go out and sell web advertising in the BungeeBones network to support their cause.
	</P>
</OL> 

 <p align="center"><font face="Arial" size="8"><a href= "http://bungeebones.com/members/affiliateregister.php"><b>Register Here If You Weren't Referred Here By An Affiliate</b></a></p></font> 


 <p align="center"><font face="Arial" size="1">&#169; COPYRIGHT 2013 ALL
        RIGHTS RESERVED BungeeBones.COM</font></td>
    </center>


</div>
<div class="clear"></div>
<div class="grid_12>
  <center>
  <table border="0" width="90%" cellspacing="0" cellpadding="0" background="img/bluebar.jpg">
    <tr>
      <td width="100%"><font size="1">&nbsp;</font></td>
    </tr>
  </table>
  </center>
</div>
<!--
</body>

</html>-->
<?
include('../../960bottom.php');
}
} else {
    // the user is not logged in...
    include("views/not_logged_in.php");
}
?>
