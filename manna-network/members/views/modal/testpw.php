<?php
   
if(isset($_POST['C1'])){


$password = $_POST['testpw'];;

require($_SERVER['DOCUMENT_ROOT']."/members/classes/class.password-entropy-estimator.php");
$ent = new password_entropy_estimator;
//include('../affiliate_top.php');
echo '<h1> The Information Entropy of your entry is ... ', $ent->entropy($password); // 85 bits

echo' Bits </h1>';
echo '<h2>As an example, something like McF-GU*".k9B[ has an Information Entropy of 85 bits.</h2>'; 
echo '<h2>We like to see all BungeeBones users have a score of at least 85 but for those that add the web directory script to their site and earn Bitcoin* we recommend a more secure score of at least 115 bits.</h2>';
echo '<h3>*We keep all Bitcoin away from ANY web based attack by storing it ALL in OFFLINE wallets. Hackers may not see this message, however, and just because they see the word "Bitcoin" they make the site a target. The request for super-strong password creations isn\'t to keep your earnings safe but, rather, just to keep the operation of the website from being compromised. I greatly appreciate your cooperation with this.</h3>'; 
echo 'To repeat the trial enter another test password and submit <br>or close this modal to return to registration form
<FORM name="F5" action="'. $_SERVER['PHP_SELF'].'" method="POST">
Enter the password you want to test:<input type="text" name="testpw"></>

<INPUT type="submit" name="C1" value="Test Password">
</form>';
//include('../affiliate_bottom.php');
}
else
{
//include('../affiliate_top.php');
?>

<div style="bgcolor:grey"><p>
 <h1>Entropy as a measure of password strength</h1>

<p>It is usual in the computer industry to specify password strength in terms of information entropy, measured in bits, a concept from information theory. Instead of the number of guesses needed to find the password with certainty, the base-2 logarithm of that number is given, which is the number of "entropy bits" in a password. A password with, say, 42 bits of strength calculated in this way would be as strong as a string of 42 bits chosen randomly, say by a fair coin toss. Put another way, a password with 42 bits of strength would require 242 attempts to exhaust all possibilities during a brute force search. Thus, adding one bit of entropy to a password doubles the number of guesses required, which makes an attacker's task twice as difficult. On average, an attacker will have to try half of the possible passwords before finding the correct one </p>

<p>Enter your intended password in the form below and it will report the information entropy value of what you entered (NOTE: this password is not saved. You must close this modal and return to registration form and enter it there).
<p style="text-align: left;">
<FORM name="F3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
Enter the password you want to test:<input type="text" name="testpw"></>

<INPUT type="submit" name="C1" value="Test Password">
</form>

</div>

<?
//include('../affiliate_bottom.php');
}
