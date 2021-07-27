<?

//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 


require_once("../config/config.php");

    
// load the login class

// load php-login components
require_once("../php-login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

 
    
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...

$user_id = $_SESSION['user_id'];

 
if ( isset( $_POST['sendMessage'] ) && !empty( $_POST['sendMessage'] ) ) {
 if (
 isset( $_POST['publickey'], $_POST['privatekey'] ) &&
  !empty( $_POST['publickey'] ) &&
  !empty( $_POST['privatekey'] )
 ) {
    # the key should be random binary, use scrypt, bcrypt or PBKDF2 to
    # convert a string into a key
    # key is specified using hexadecimal
    $key = pack('H*', "cbc04c7e103a0bd8c54763051bef08cb55ace029fdecae5e1d417e2ffc2a00a3");
    
    # show key size use either 16, 24 or 32 byte keys for AES-128, 192
    # and 256 respectively
    $key_size =  strlen($key);
   
 $plaintextpub = $_POST['publickey'];
 $plaintextpriv = $_POST['privatekey'];
    # create a random IV to use with CBC encoding
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    
    # creates a cipher text compatible with AES (Rijndael block size = 128)
    # to keep the text confidential 
    # only suitable for encoded input that never ends with value 00h
    # (because of default zero padding)
 $cipherpubtext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key,
                                 $plaintextpub, MCRYPT_MODE_CBC, $iv);
 $cipherprivtext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key,
                                 $plaintextpriv, MCRYPT_MODE_CBC, $iv);
    # prepend the IV for it to be available for decryption
    $cipherpubtext = $iv . $cipherpubtext;
    $cipherprivtext = $iv . $cipherprivtext;
    # encode the resulting cipher text so it can be represented by a string
    $cipherpubtext_base64 = base64_encode($cipherpubtext);
 $cipherprivtext_base64 = base64_encode($cipherprivtext);
    # === WARNING ===

    # Resulting cipher text has no integrity or authenticity added
    # and is not protected against padding oracle attacks.
    
    # --- DECRYPTION ---
    
    $cipherpubtext_dec = base64_decode($cipherpubtext_base64);
    $cipherprivtext_dec = base64_decode($cipherprivtext_base64);
    # retrieves the IV, iv_size should be created using mcrypt_get_iv_size()
    $iv_dec = substr($cipherpubtext_dec, 0, $iv_size);
     $iv_dec = substr($cipherprivtext_dec, 0, $iv_size);
    # retrieves the cipher text (everything except the $iv_size in the front)
    $cipherpubtext_dec = substr($cipherpubtext_dec, $iv_size);
 $cipherprivtext_dec = substr($cipherprivtext_dec, $iv_size);
    # may remove 00h valued characters from end of plain text
    $plainpubtext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key,
                                    $cipherpubtext_dec, MCRYPT_MODE_CBC, $iv_dec);
    $plainprivtext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key,
                                    $cipherprivtext_dec, MCRYPT_MODE_CBC, $iv_dec);
    echo  '<br>line 94 decrypted '. $plainpubtext_dec . "\n";
 echo  '<br>line 94 decrypted '. $plainprivtext_dec . "\n";
echo 'in new masterlinks/master_lnks_test.php file, going to report the post vars curl sent from reg form/index.';
print_r($_POST);

		include($_SERVER['DOCUMENT_ROOT']."/masterlinks/db_cfg/db2mstrlnksconfig.php");
		include($_SERVER['DOCUMENT_ROOT']."/masterlinks/db_cfg/connectloginmysqli.php");
  $sql = "SELECT * FROM `gourl` WHERE `userid` = ".$user_id;
$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 3 Account' query");

    $row_cnt = mysqli_num_rows($result);

    printf("Result set has %d rows.\n", $row_cnt);

    /* close result set */
    mysqli_free_result($result);
if($row_cnt <1){
     $sql = "INSERT INTO `gourl`(`pubkey`,`privkey`,`userid`)values('".$cipherpubtext_base64."', '".$cipherprivtext_base64."', '".$user_id."')";
$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 3 Account' query");
echo "<h1>Successfully Saved your GoUrl Configurations</h1>
<h3>The next deposit by one of your registered users for any amount less than your AdCredit balance will be sent to you in Bitcoin (minus the 1.5% fee that GoURL charges)";
exit(); 
}
else
{

$sql = "SELECT * FROM `gourl` WHERE `userid` = ".$user_id;
echo $sql;
$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 3 Account' query");

    $row_cnt = mysqli_num_rows($result);
while ($row = mysqli_fetch_array($result)){
$id = $row['id'];
$pubkeyencrypt = $row['pubkey'];
$privkeyencrypt = $row['privkey'];
}
echo '<br>$pubkeyencrypt from db  = ', $pubkeyencrypt;
echo '<br>$privkeyencrypt from db  = ', $privkeyencrypt;

 # --- DECRYPTION ---
    
    $cipherpubtext_dec = base64_decode($pubkeyencrypt);
    $cipherprivtext_dec = base64_decode($privkeyencrypt);
    # retrieves the IV, iv_size should be created using mcrypt_get_iv_size()
    $iv_dec = substr($cipherpubtext_dec, 0, $iv_size);
     $iv_dec = substr($cipherprivtext_dec, 0, $iv_size);
    # retrieves the cipher text (everything except the $iv_size in the front)
    $cipherpubtext_dec = substr($cipherpubtext_dec, $iv_size);
 $cipherprivtext_dec = substr($cipherprivtext_dec, $iv_size);
    # may remove 00h valued characters from end of plain text
    $plainpubtext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key,
                                    $cipherpubtext_dec, MCRYPT_MODE_CBC, $iv_dec);
    $plainprivtext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key,
                                    $cipherprivtext_dec, MCRYPT_MODE_CBC, $iv_dec);
    echo  '<br>line 136 decrypted '. $plainpubtext_dec . "\n";
 echo  '<br>line 136 decrypted '. $plainprivtext_dec . "\n";

    /* close result set */
    mysqli_free_result($result);


exit();
}
 } else {
  print 'Not all information was submitted.';

exit();
 }
}




$moniker="<h5>AdCoin/Advertising Credit Redemption Via GoURL Payment Gateways</h5>";
$body_width="wide";
include('../../960top.php');
include('user_cpanel_submenu.php');
$msg="";



$msg .= '<p style="text-align:left"; class="smallerFont">This program enables
members that have accumulated Advertising Credits (sometimes we refer
to them as Adcoins) to sell them directly to their “downline”
registered users in exchange for Bitcoin. In order to receive Bitcoin
payments using this system you must have an account at GoURL.io and have a sufficient balance of
AdCoins in your account to exchange for the Bitcoin when the user
makes their Bitcoin payment. When you receive your Bitcoin, your BungeeBones account will be reduced by an equal number of
advertising credits (the user will receive those).</p>
<p style="text-align:left"; class="smallerFont">In order to be able
to accept Bitcoin yourself you need your own payment gateway that
uses your Bitcoin address (instead of one from BungeeBones). 
</p>
<p style="text-align:left"; class="smallerFont">1) So the first step
is to get a Bitcoin wallet (if you don\'t already have one). You can
find out more and get one here:
<a target="_blank" href="https://bitcoin.org/en/choose-your-wallet">https://bitcoin.org/en/choose-your-wallet</a></p>
<p style="text-align:left"; class="smallerFont">2) <a target="_blank" href="https://gourl.io/">You will need to
create an account at GoUrl.io.</a> Then please follow the instructions
below to setup your account. Please note that GoUrl will charge you
1.5% for every transaction they process.</p>
<p style="text-align:left"; class="smallerFont">
A) Register for a free account</p>
<p style="text-align:left"; class="smallerFont">
B) Once logged in click on the Create A Payment Box link. Give the
payment box a name (which can be anything you choose). Suggestion –
BungeeBones AdCredit Payments</p>
<p style="text-align:left"; class="smallerFont">
C) Select Bitcoin as the coin type.</p>
<p style="text-align:left"; class="smallerFont">
D) Select paymentbox as the type of payment box</p>
<p style="text-align:left"; class="smallerFont">
E) Enter your Bitcoin address (from your own Bitcoin wallet) for
receiving the Bitcoin</p>
<p style="text-align:left"; class="smallerFont">
F) Enter your email address if you want email notification (optional)</p>
<p style="text-align:left"; class="smallerFont">
G) You must enter the following callback URL in the form\'s Callback
URL box</p>
<p style="text-align:left"; class="smallerFont">
	<b style="color:red";>https://Bungeebones.com/members/cryptobox-callback.php</b>
(double check this address)</p>
<p style="text-align:left"; class="smallerFont">
H) Click → Save</p>
<p style="text-align:left"; class="smallerFont">
I) You will now see your Public and Private key details which you
must enter below.</p>


</p>';

$msg .= '<form action="'.$_SERVER['PHP_SELF'].'" method="post">
    <p style="text-align:left"; class="smallerFont"><label for="publickey">Public Key</label>
  <input size="50" type="text" name="publickey" id="publickey" />
 <p style="text-align:left"; class="smallerFont"><label for="privatekey">Private Key</label>
  <input size="50" type="text" name="privatekey" id="privatekey" />
     <p style="text-align:left"; class="smallerFont"><input type="submit" name="sendMessage" id="sendMessage" value="Send GoURL Configs" />
 </p>
   </form>';




echo $msg;
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></h2></a>';


include("../../960bottom.php");


} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

