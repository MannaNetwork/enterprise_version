<?
if (isset($_GET['action']) && $_GET['action'] == "log_out") {
	//$test_page_protect->log_out(); // the method to log off
echo '<h1>in Logout - Session Destroy</h1>';
session_start();
session_destroy();
}
// include the configs
require_once($_SERVER['DOCUMENT_ROOT']."/members/config/config.php");

    
// load the login class

// load php-login components
require_once($_SERVER['DOCUMENT_ROOT']."/members/php-login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

 
    
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...


$user_id = $_SESSION['user_id'];

//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 
$moniker="<h5>BungeeBones For Professionals</h5>";
$body_width="wide";
include($_SERVER['DOCUMENT_ROOT']."/960top.php");?>



<table id="member">
<tr><td>

<H1 CLASS="western">Private User Registration</H1>
<p class="smallerFont" >Private User Registration is a way for
professionals in the web businesses (such as designers, developers,
SEO, hosting companies etc) to provide BungeeBones related services
to their customers at various levels of service and confidentiality. 
</P>
<p class="smallerFont" ><BR>
</P>
<p class="smallerFont" >In order
 to help build trust between BungeeBones and the
professions listed, I've instituted a way for them to register their customer as a separate user and, at the same time, for them to keep
their customer's email addresses private and not disclose them to BungeeBones. Hopefully this small gesture will help companies feel comfortable knowing BungeeBones will not be contacting nor soliciting their customers. Admittedly, while this is
not a totally secure prevention to BungeeBones contacting your
customer (which is against my policy anyway - see below) it provides
an obvious extra obstacle.
</P>
<p class="smallerFont" ><BR>
</P>
<H2 CLASS="western">Benefits Of Providing BungeeBones To Your
Customers</H2>
<p class="smallerFont" >Nearly every customer is interested in
how to get traffic to their web site. Your customers look to you for
advice, experience and technical assistance. While the benefits that would
accrue to the BungeeBones network if those listed were to offer the BungeeBones web directory to their
customers are obvious (the network would rapidly gain
traffic, sales locations (at each installation), advertising, and
income) there are even more benefits to the installers than there are
for BungeeBones itself. Every benefit listed above also applies to
our Commercial members because BungeeBones is set up as a
multi-level, long-term, residual commission based system. As the
network grows so does the income from your own contributions and your downlines.</P>
<p class="smallerFont" >Since all of the listed professions deal directly with the
customers they have a special opportunity to educate, endorse, recommend
"sell" BungeeBones to them directly. But BungeeBones is so new,
so different that not even many of the "pros" know about it. What
that means is that the early adopters among the professionals will
have a marketing edge against their competitors by providing your
customers extra web traffic AND the opportunity to earn income to
boot (and all absolutely free). There will be a benefit your
customer's will get by dealing with you that they won't get from
your competitors.</P>
<H2 CLASS="western">Downside Risks</H2>
<p class="smallerFont" >So what could be the risks to the early adopters of BungeeBones among those in
the  designers, developers, SEO, hosting company fields?</P>
<uL>
	<LI><p class="smallerFont" >Perhaps the technology is flawed? That could be, and that
	would also be a concern of your customers. But the expertise and
	experience that you have is what they look to you for in the first
	place. Who better than you to "kick the tires" of Bungeebones?</P>
	<LI><p class="smallerFont" >Perhaps the income opportunity is a gimmick? Well, in
	comparison to what? I present BungeeBones as an "Adsense
	Alternative" which is, to say the least, a bold statement. But the
	reality is that BungeeBones doesn't have to push Adsense or any
	other income generator off of a site but, rather, is content to sit
	on its own, very quite "web directory" or "links" page all
	by its lonesome. At worst, BungeeBones is getting web traffic that
	would have left the site without generating any income anyway and would otherwise
	simply be going to waste</P>
	<LI><p class="smallerFont" >Google might get pissed! Well, I think I may have already
	done that.  Some of those using Analytics have contacted me
	informing me that Google has picked up their link on one of the
	multiple installations of BungeeBones. They can't detect all the
	sites BungeeBones gets installed on so never has anyone ever listed
	more than a couple locations. So I did start offering a "fix" to
	those whom Google attitude matters. I installed the option to make a
	link in the directory "no follow". That means the listing is not
	looking to the search engine for any benefits from the link. The tag
	applies only to the links that choose to use it.<BR><BR>The irony is that BungeeBones
	wasn't designed to "spoof" search engines and I expect
	that to all blow over. The fact that Google doesn't detect all
	locations shows the limits of their search engine. In the "old
	days" search engines handled their limitations by supplementing
	their results with human provided helps. Human edited web
	directories have always been a source of quality links to search
	engines and that is exactly what BungeeBones is. Our links are
	reviewed, reviewed again by link submitters in the category and have
	a number of incentives built into the system for everyone to
	participate in keeping the links up to date and properly
	categorized. BungeeBones linking strategy has, to me, always been
	"white hat" and eventually I believe Google will realize that
	and use it to improve their search results.</P>
	<LI><p class="smallerFont" >Start ups are risky! Yupp, that is true. BungeeBones uses
	terminology often used in venture capital circles (venture capital
	is risky business) but what is so different about BungeeBones is
	that it is all based on web traffic and NOT on cash. The capital it
	is seeking for others to invest consists entirely of web traffic.
	BungeeBones asks website owners to invest traffic that would
	otherwise go to waste so how risky is that? The risk to well
	established sites is obviously greater and is a genuine concern of
	well established websites. BungeeBones is similar to that well
	established web traffic building system known as "link exchange"
	in many ways. BungeeBones, like link exchange, has greater appeal
	for newer sites with little or nothing to lose. But unlike link
	exchange, BungeeBones provides successful websites a stake with
	long-term residual income to help retain them in the system.</P>
</uL>
<p class="smallerFont" ><BR>
</P>
<p class="smallerFont" ><BR>
</P>
<H2 CLASS="western">Privacy, Non-Compete, Disclosure Policy</H2>
<p class="smallerFont" >I do provide small time web design
and/or hosting to just a few acquaintances. I also have some
experience in tech support for a hosting company. I have no interest or inclination to enter
either of those two areas. I also have no interest in SEO. I say that to put at
ease any that think BungeeBones might go after their customers.</P>
<p class="smallerFont" ><BR>
</P>
<p class="smallerFont" >But there are important matters related
to income that may need to be communicated involving such things as
tax compliance, "know your customer" regulations etc. The recent
move of BungeeBones to a Bitcoin only based payment system does help
avoid some of those regulations I believe but I think you agree that
because there is money involved my hands may be tied on certain
issues.  
</P>
<p class="smallerFont" ><BR>
</P>
<p class="smallerFont" ><BR>
</P>
<H2 CLASS="western">Terms Of The Private User Program</H2>
<p class="smallerFont" ><BR>
</P>
<OL>
	<LI><p class="smallerFont" >A company, business, individual in
	the web related professions that is involved directly with the
	public and their websites may want to keep the identity and contact
	information of their customer private for multiple reasons. Those
	businesses wishing to do so and wishing to offer BungeeBones related
	services such as installation, web traffic monitoring, purchasing,
	commission disbursement, Bitcoin wallet management etc may apply to
	become "Limited Commercial Advertisers".</P>
	<LI><p class="smallerFont" >Limited Commercial Advertisers can
	request individual user names and password logins for each
	individual link submitted from their own Bungeebones User Control
	Panel. That will enable that new site to have its own private user
	control panel and all the same features and benefits of an
	individual membership. The Limited Commercial Advertiser has the
	login information and can login on the website owner's behalf, can
	set up a web directory under that separate account, can set up a
	Bitcoin wallet and even view/request earnings and traffic reports.</P>
	<LI><p class="smallerFont" >The LCA will provide the initial
	user name and password, along with a Bitcoin wallet address  unique
	to that user account. Missing any of that information will prevent
	either login and/or funds withdrawal. 
	</P>
	<LI><p class="smallerFont" >Limited Commercial Advertisers can
	provide the login information to the website owner(s) but with some
	restrictions and/or loss of privacy/functionality.</P>
</OL>
<UL>
	<LI><p class="smallerFont" >Once the owner has login
	capabilities the owner can change the password and effectively lock
	the LCA out of the BungeeBones User Control Panel of that link.
	BungeeBones will NOT reset the password in such a case where the
	owner has changed the password  AND changed the wallet address.  
	</P>
	<LI><p class="smallerFont" >The owners will be required to
	provide and confirm their email address before being able to change
	the wallet address</P>
</UL>
<p class="smallerFont" ><BR>
</P>
<p class="smallerFont" >The above policy should enable two
scenarios for the LCAs to perform. They will be able to provide
complete BungeeBones management services of everything from
installation to bidding to commission payment requests etc. It will
also enable the LCAs to set up BungeeBones accounts for their
customers, train them briefly in its use and "turn the keys" over
to them by letting them change the password and the wallet address.</P>
<p class="smallerFont" ><BR>
</P>
<p class="smallerFont" ><BR>
</P>
<p class="smallerFont" ><BR>
</P>
<p class="smallerFont" >Please use the form below to register
your login , password and unique Bitcoin wallet address for the new
user account: 
</P>

<h1>Coming Soon!</h1>
<!--
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <label for="login">Login:</label>
  <input type="text" name="login" size="20" value="<?php echo (isset($_POST['login'])) ? $_POST['login'] : $my_access->user; ?>"><br>
  <label for="password">Password:</label>
  <input type="password" name="password" size="8" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>"><br>
  <label for="login">Unique Bitcoin Wallet Address*:</label>
  <input type="text" name="bitcoin_wallet" size="36" value="<?php echo (isset($_POST['bitcoin_wallet'])) ? $_POST['bitcoin_wallet'] : $my_access->user; ?>"><br>

  <br>
  <input type="submit" name="Submit" value="Register New Private User">
</form>
-->
<br>
<p class="smallerFont" >If you are not familar with Bitcoin wallets then you might want to take a look at my <a target=_blank" href="bitcoin_wallet_primer.php">Bitcoin Wallet Primer for Professionals</a>
<p class="smallerFont" >><b><?php echo (isset($error)) ? $error : "&nbsp;"; ?></b></p>
</td></tr></table>

<?
include($_SERVER['DOCUMENT_ROOT']."/960bottom.php");
} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
?>
