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
$moniker="<h5>A Primer About Bitcoin Wallets</h5>";
$body_width="wide";
include($_SERVER['DOCUMENT_ROOT']."/960top.php");?>



<table id="member">
<tr><td>
<H1 CLASS="western">Bitcoin Primer for Professionals</H1>
<p class="smallerFont" >This paper is for web professionals dealing with the public and will deal with learning how to teach your customers to keep their Bitcoins safe from hackers and from thieves. Fortunately, since Bitcoin is an entirely web-based currency many of the recommended security practices are already commonly understood and practiced. So, as a starting point, we can say to make sure your customer already knows and follows basic Internet safety and security measures.


</P>
<p class="smallerFont" ><BR>
</P>
<p class="smallerFont" >Once you are confident your customer knows and practices solid Internet security practices we can look at things that are specific to Bitcoin. The best resource I have found regarding the basic technologies upon which Bitcoin is built are a <a target="_blank" href="https://www.youtube.com/results?search_query=khan+academy+bitcoin+playlist&oq=khan+academy+Bitcoin&gs_l=youtube.1.1.0l2.3904.10908.0.15072.20.10.0.10.10.0.111.784.8j2.10.0...0.0...1ac.1.11.youtube.Lv3nT4p5V48">series of tutorial videos put out by Khan Academy</a>.
</P>
<p class="smallerFont" ><BR>
</P>
<H2 CLASS="western">The Positively Most Absolute Safest Way For You Or Your
Customers To Store Bitcoin</H2>
<p class="smallerFont" >By far, the most secure way to keep any digital file safe (and that is whether it is Bitcoin wallet or some other important digital file) is to keep it off the Internet and stored in a secured location (perhaps even a safe if there is enough at stake). Fortunately there is a Bitcoin wallet that does exactly that named <a target="_blank" href="https://bitcoinarmory.com/">Armory</a>. And that is my recommendation for you to install for your customers use in their BungeeBones Commission Account</P>
<p class="smallerFont" >Armory is actually installed twice and are referred to as Armory online wallet and Armory offline wallet. The concept is simple. The online wallet (the one exposed to potential hacking) is a read only file and cannot, under any circumstances, issue a Bitcoin payment. You might liken the read-only online Bitcoin wallet to the bank statement you receive in the mail. No one can spend the money in your account even if they get a copy of the statement. The offline wallet, on the other hand, has the authority to issue payments from the Bitcoin account. You might liken the offline wallet to a checkbook. The person with the checkbook can write checks just like the offline wallet can issue payments. But just as turning a check into cash is a two step process (writing/receiving the check and taking it somewhere to get "cashed") so to is Armory. The offline wallet is not capable of communicating with the peer-to-peer Bitcoin network telling them it has authorized the transaction. A simple transfer of the authorization to a temporary storage medium such as a USB thumb drive and then to the online wallet enables the transfer to be made. The authorization is for only the amount the off-line wallet issued however. </P>
<H2 CLASS="western">Downside Risks</H2>
<p class="smallerFont" >So what could be the risks of using Bitcoin?</P>
<OL>
	<LI><p class="smallerFont" >The use of the term "wallet" was adapted to Bitcoin because of it having very similar chacteristics as cash. If you lose a wallet full of cash, you are likely out your cash. The same is true if someone gets access to your Bitcoin wallet.</P>
	<LI><p class="smallerFont" >If you ever have had a hard drive fail you've experienced the unreliability of hardware and probably suffered the effects of not having data properly backed up. The same risks are there for Bitcoin that are, for the most part, stored on hardware. There is a provision of an alternate method that is provided by Armory, however, in the form of Paper Wallets. A Paper Wallet contains all the information necessary to get a "lost" wallet's contents back in the event of a hardware failure or even theft. Since all Bitcoin transactions are stored "in the cloud" the Bitcoins owned by any particular wallet are always still there. The "problem" is that Bitcoin's security is so strong that if you lose the encrpted key to the wallet you nor anyone else will ever get access to it again. A paper wallet is the digital key information that can be typed into a new wallet that will identify itself as the proper owner of the funds in that "cloud" wallet account. </P>

<li>There is a learning curve and, unlike something like email, lack of user experience can have a bigger effect on the pocketbook. That's why I think BungeeBones advertising and payments systems can be a perfect leaning environment. BungeeBones can, upon request, remit commission payments to the user's Bitcoin wallet (hopefully a secure offline one). They can then safely see the successful transfer in their read-only online wallet while their funds are safe in their offline wallet. With transaction fees of $.06 AT MOST one can safely conduct a large number of learning transactions for little costs.</li>
</OL>
<p class="smallerFont" ><BR>
</P>
<p class="smallerFont" ><BR>
</P>
<H2 CLASS="western">Privacy Policy</H2>
<p class="smallerFont" >Privacy and Bitcoin have, from its release, have gone together but certain regulatory agencies seem determined to see what is going on behind Bitcoin transactions. If you have been watching Bitcoin related news events you are aware of some of the recent rulings. </P>
<p class="smallerFont" >Bear in mind, though, that everything related to BungeeBones is not only website (by ip address), but more importantly, domain name based. Website ownership can be determined, in most cases, with a simple "Whois" search on the domain name. Granted there are some ways to keep the owner's identity more private but I'm confident that those techniques are nothing more than a brief annoyance to any government official wanting to know who owns a domain.</p>
<p class="smallerFont" >The fact that every participant has a public in ICANN certainly diminishes the need to maintain the privacy standard as strictly as the main Bitcoin community holds to it. But it sort of comes as a mixed blessing as far as BungeeBones participation is concerned because of "KYC" (Know Your Customer) regulations. Bitcoin is such a new and different technology that it is going to take some time for the lawmakers to catch up. Think of the dawning of the automobile age upon a society with horse and buggy laws. Many things need to be changed. KYC is being applied to "money transmitters". While BungeeBones is in no way a money transmitting platform (it was partly for the reason of avoiding appearing as a money transmitter and falling under KYC compliance that I stopped accepting PayPal) the fact that all that needs to be done to "Know" my customer is to do a whois search provides a nice compliance cushion.

<p class="smallerFont" ><BR>
</P>
<p class="smallerFont" >But there are important matters related
to income and commissions that may need to be determined involving such things as
tax compliance. The recent
move of BungeeBones to a Bitcoin only based payment system does help
with some of those regulations. For example, every transaction is recorded in the Bitcoin block chain so if one knows the wallet(s) involved the data is there to find out the amount and time of the transaction. What I don't know, however, is whether the person ever converted the Bitcoin to cash or when or for how much. At most I would ever be able to report is the amount of Bitcoin I sent. The tax regulations at the recipients end determine how the proceeds will be treated. Again, Bitcoin is so knew tax regulators are scrambling to try to categorize it. I know there are different accounting systems such as "accrual" that might be used for Bitcoin but all those matters are still largely undecided.  
</P>
<p class="smallerFont" ><BR>
</P>
<p class="smallerFont" ><BR>
</P>
<H2 CLASS="western">Terms And Conditions Of BungeeBones Payment of Bitcoin Commissions</H2>
<p class="smallerFont" ><BR>
</P>
<OL>
	<LI><p class="smallerFont" >A company, business, individual in
	the web related professions that is involved directly with the
	public and their websites that offers BungeeBones related
	services such as installation, web traffic monitoring, purchasing,
	commission disbursement, Bitcoin wallet management as a "Limited Commercial Advertisers" can choose to place their own wallet on their customers site or their customers. Since ownership of a wallet cannot be determined I am in no way liable nor resposible for any misappropriation, misapplied payments or fraud perpetrated by any LCA.</P>
	<LI><p class="smallerFont" >Since the Limited Commercial Advertisers can
	request individual user names and password logins for each
	individual link submitted from their own Bungeebones User Control
	Panel and doing that will enable that site to have its own private user
	control panel and all the same features and benefits of an
	individual membership, and that the Limited Commercial Advertiser has the
	login information and can login just as the website owner, can
	set up a web directory under that separate account, can set up a
	Bitcoin wallet and even view/request earnings and traffic reports, then establishing a clear ownership of the BungeeBones account by the owner (rather than the LCA) and to clearly delineate the tax liabilty of any proceeds is entirely the responsibility of the LCA. The LCA will hold the owner of this BungeeBones.com website harmless in any litigation or losses resulting from conflicts regarding tax liability on accounts they create.</P>
	<LI><p class="smallerFont" >The LCA will provide the initial
	user name and password, along with a Bitcoin wallet address  unique
	to that user account. The LCA will retain the owner's email and other contact information and will serve as contact agent for all matters concerning the owner of the domain and website. 
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
</td></tr></table>

<?
include($_SERVER['DOCUMENT_ROOT']."/960bottom.php");
} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
?>
