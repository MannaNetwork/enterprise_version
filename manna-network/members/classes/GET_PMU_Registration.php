<?php
//where is PMU? We's got WP_Registration, PLUGIN_REG..., PHPBLOCK_REG... but what is PMU?
// This is a Created copy/new fork of the class at PMU_Registration_plugin.php which is the one where new users from
// just the clone/non MU subs register at. Do they get a blog there or  get JUST bb user status?

// If they register at a clone or sub for a WPMU blog, then what? Check that process as it may/may not be different?
//A registrant at blogsbystudents may or may not want that niche. Forcing them to register there to then later only 
// blog from healthy;iving just wastses resources at registration site?
class Registration
{
    /**
     * @var object $db_connection The database connection
     */
    private $db_connection            = null;
    /**
     * @var array array with translation of language strings
     */
    private $lang                     = array();
    /**
     * @var bool success state of registration
     */
    public  $registration_successful  = false;
    /**
     * @var bool success state of verification
     */
    public  $verification_successful  = false;
    /**
     * @var array collection of error messages
     */
    public  $errors                   = array();
    /**
     * @var array collection of success / neutral messages
     */
    public  $messages                 = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */    
    public function __construct()
    {
        session_start();

        // Create internal reference to global array with translation of language strings
        $this->lang = & $GLOBALS['phplogin_lang'];
        // if we have such a POST request, call the registerNewUser() method
        if (isset($_POST["register"])) {
// for plugin, php downloads (and WPMU registrations) all we have for id of the refererer is their affiliate num/link ID so we need to do a quick query of the widgets table to get the widget ID 
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
			include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$referer_affiliate_num = $_POST['referer_affiliate_num'];// this came in with the post values via iframe from plugins on their Earn Income pages
$is_flagged = $_POST['is_remote_mu_registration'];//also is the affiliate number
$sql = "SELECT * FROM `widgets` WHERE link_id = " . $_POST['referer_affiliate_num'] ;
$result = mysqli_query($connect, $sql)or die("<p align='left'>Bold query0 - line 90"); 
                           while ($row = mysqli_fetch_array($result)) 
                          {
                 		$referer_wdgt_id = $row['id'];
		          }
//we might as well finish the three value set and get this user's email address now, but we need the BB user ID from the link table
$sql = "SELECT * FROM `links` WHERE id = " . $_POST['referer_affiliate_num'] ;
		$result = mysqli_query($connect, $sql)or die("<p align='left'>Bold query1 - line 97"); 
                           while ($row = mysqli_fetch_array($result)) 
                          {
                 		$BB_user_id = $row['BB_user_ID'];
		          }
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2accusersconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$sql = "SELECT * FROM `users` WHERE `user_id` = " . $BB_user_id ;
		$result = mysqli_query($connect, $sql)or die("<p align='left'>Bold query2 - line 105"); 
                           while ($row = mysqli_fetch_array($result)) 
                          {
                 		$referer_email = $row['user_email'];
		          }

$this->registerNewUser($_POST['user_name'], $_POST['user_email'], $_POST['user_password_new'], $_POST['user_password_repeat'], $_POST["captcha"], $referer_affiliate_num, $referer_wdgt_id, $_POST['referer_blog_id'], $referer_affiliate_num, $_POST["website_url"], $_POST["website_title"], $_POST["website_description"]);
       

//Where does yellow button go? To a list of WPMU sites they choose from to register there
//so make a new temp table (treat it the same as temp downloads). 
// delete them frpm temp after they get a sub
// also, double check how multiple registrations as a subdomain blogger on many sites affects my listing in wp_user_data (if it does)

 // if we have such a GET request, call the verifyNewUser() method
        } else if (isset($_GET["id"]) && isset($_GET["verification_code"])) {
            $this->verifyNewUser($_GET["id"], $_GET["verification_code"]);
        }
    }

    /**
     * Checks if database connection is opened and open it if not
     */
    private function databaseConnection()
    {
        // connection already opened
        if ($this->db_connection != null) {
            return true;
        } else {
            // create a database connection, using the constants from config/config.php
            try {
                $this->db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME, DB_USER, DB_PASS);
                return true;
            // If an error is catched, database connection failed
            } catch (PDOException $e) {
                $this->errors[] = $this->lang['Database error'];
                return false;
            }
        }
    }

    /**
     * handles the entire registration process. checks all error possibilities, and creates a new user in the database if
     * everything is fine
     */
//$referer_blog_id might be deprecated? it used to get a true/false value but I don't think it is used anymore in the wpmu reg, php block reg or plugin reg. These three groups have in common they don't have any previous links in BB so after they register they get detected as first time users and select their proper option.
//So why handle PHP script differently than Wordpress plugin? I think the only differences are in the email they are sent to confirm (verify this), and in the download links they get sent after confirmation? 
//So whatever it is doing now we do the same for the WPMU registrant. If the info is in the confirmation email then we send the list of urls of the WPMU sites then.
    private function registerNewUser($user_name, $user_email, $user_password, $user_password_repeat, $captcha, $wdgts_lnk_num, $wdgts_id,$referer_blog_id,$referer_affiliate_num, $registrants_website_url, $registrants_website_title, $registrants_website_description)
    {

        // we just remove extra space on username and email
        $user_name  = trim($user_name);
        $user_email = trim($user_email);

        // check provided data validity
        // TODO: check for "return true" case early, so put this first
  if (strtolower($captcha) != strtolower($_SESSION['captcha'])) {
            $this->errors[] = '<div  class="grid_12"  style="background-color:red; font-size: small; width:20%; height:20px; border: 2px solid; border-radius: 25px; padding:10px 10px 10px;  margin-left: auto ;
  margin-right: auto ;">CAPTCHA WRONG</div>';
        } elseif (empty($user_name)) {
            $this->errors[] = $this->lang['Empty Username'];
        } elseif (empty($user_password) || empty($user_password_repeat)) {
            $this->errors[] = $this->lang['Empty Password'];
        } elseif ($user_password !== $user_password_repeat) {
            $this->errors[] = $this->lang['Bad confirm password'];
        } elseif (strlen($user_password) < 6) {
            $this->errors[] = $this->lang['Password too short'];
        } elseif (strlen($user_name) > 64 || strlen($user_name) < 2) {
            $this->errors[] = $this->lang['Username bad length'];
        } 
//elseif (!preg_match('/^[a-z\d]{2,64}+\_[a-z\d]{2,64}$/i', $user_name)) {
        elseif (!preg_match('/^[a-z\d]{2,64}$/i', $user_name)) {                     

            $this->errors[] = $this->lang['Invalid username'];
        } elseif (empty($user_email)) {
            $this->errors[] = $this->lang['Empty email'];
        } elseif (strlen($user_email) > 64) {
            $this->errors[] = $this->lang['Email too long'];
        } elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = $this->lang['Invalid email'];

        // finally if all the above checks are ok
        } else if ($this->databaseConnection()) {
            // check if username or email already exists
            $query_check_user_name = $this->db_connection->prepare('SELECT user_name, user_email FROM users WHERE user_name=:user_name OR user_email=:user_email');
            $query_check_user_name->bindValue(':user_name', $user_name, PDO::PARAM_STR);
            $query_check_user_name->bindValue(':user_email', $user_email, PDO::PARAM_STR);
            $query_check_user_name->execute();
            $result = $query_check_user_name->fetchAll();

            // if username or/and email find in the database
            if (count($result) > 0) {
                for ($i = 0; $i < count($result); $i++) {
                    $this->errors[] = ($result[$i]['user_name'] == $user_name) ? $this->lang['Username exist'] : $this->lang['Email exist'];
                }
            } else {
                // check if we have a constant HASH_COST_FACTOR defined (in config/hashing.php),
                // if so: put the value into $hash_cost_factor, if not, make $hash_cost_factor = null
                $hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);

                // crypt the user's password with the PHP 5.5's password_hash() function, results in a 60 character hash string
                // the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using PHP 5.3/5.4, by the password hashing
                // compatibility library. the third parameter looks a little bit shitty, but that's how those PHP 5.5 functions
                // want the parameter: as an array with, currently only used with 'cost' => XX.
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
                // generate random hash for email verification (40 char string)
                $user_activation_hash = sha1(uniqid(mt_rand(), true));


$query_new_user_insert = $this->db_connection->prepare('INSERT INTO users (user_name, user_password_hash, user_email, user_activation_hash, user_registration_ip, wdgts_lnk_num, wdgts_ID, user_registration_datetime) VALUES(:user_name, :user_password_hash, :user_email, :user_activation_hash, :user_registration_ip, :wdgts_lnk_num, :wdgts_id, now())');
                                                                        
      $query_new_user_insert->bindValue(':user_name', $user_name, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_password_hash', $user_password_hash, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_email', $user_email, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_activation_hash', $user_activation_hash, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_registration_ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':wdgts_lnk_num', $wdgts_lnk_num, PDO::PARAM_INT);
                $query_new_user_insert->bindValue(':wdgts_id', $wdgts_id, PDO::PARAM_INT);
                 $query_new_user_insert->execute();




                // id of new user
                $user_id = $this->db_connection->lastInsertId();
                if ($query_new_user_insert) {
                    // send a verification email
                    if ($this->sendVerificationEmail($user_id, $user_email, $user_activation_hash)) {
                        // when mail has been send successfully
                        $this->messages[] = $this->lang['WPMU Blog Verification mail sent'];
                        $this->registration_successful = true;
//Since the verification email was sent we want to add all the data we have about this new user into the temp_download_b4_wdgt_insert table and wait for verification

include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
			include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
//now that they are registered but do not have a link, we add them to temp_download_b4_wdgt_insert (which is same as downloaders use)
// because members/index.php checks that table to display proper BIG yellow button 
$sql = "Insert INTO `temp_download_b4_wdgt_insert` 
( `BB_user_ID`, `download_type` , `referer_affiliate_num` , `referer_wdgt_id` , `referer_id`,`wp_user_login_registrant`,`wp_user_email_registrant` ) 
values 
( '$user_id', 'wpmu_blogger', '$referer_affiliate_num','$wdgts_id','".$_POST['referer_blog_id']."','".$_POST['user_name']."','$user_email')"; 
mysqli_query($connect, $sql);
                    } else {
                        // delete this users account immediately, as we could not send a verification email
                        $query_delete_user = $this->db_connection->prepare('DELETE FROM users WHERE user_id=:user_id');
                        $query_delete_user->bindValue(':user_id', $user_id, PDO::PARAM_INT);
                        $query_delete_user->execute();

                        $this->errors[] = $this->lang['Verification mail error'];
                    }
                } else {
                    $this->errors[] = $this->lang['Registration failed'];
                }
            }
        }
    }

    /*
     * sends an email to the provided email address
     * @return boolean gives back true if mail has been sent, gives back false if no mail could been sent
     */
    public function sendVerificationEmail($user_id, $user_email, $user_activation_hash)
    {
        $mail = new PHPMailer;

        // please look into the config/config.php for much more info on how to use this!
        // use SMTP or use mail()
        if (EMAIL_USE_SMTP) {
            // Set mailer to use SMTP
            $mail->IsSMTP();
            //useful for debugging, shows full SMTP errors
            $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            // Enable SMTP authentication
            $mail->SMTPAuth = EMAIL_SMTP_AUTH;
            // Enable encryption, usually SSL/TLS
            if (defined(EMAIL_SMTP_ENCRYPTION)) {
                $mail->SMTPSecure = EMAIL_SMTP_ENCRYPTION;
            }
            // Specify host server
            $mail->Host = EMAIL_SMTP_HOST;
            $mail->Username = EMAIL_SMTP_USERNAME;
            $mail->Password = EMAIL_SMTP_PASSWORD;
            $mail->Port = EMAIL_SMTP_PORT;
        } else {
            $mail->IsMail();
        }

        $mail->From = EMAIL_VERIFICATION_FROM;
        $mail->FromName = PMU_EMAIL_VERIFICATION_FROM_NAME;
        $mail->AddAddress($user_email);
        $mail->Subject = PMU_EMAIL_VERIFICATION_SUBJECT;
      $link = 'https://bungeebones.com/members/pmu_get_wpmu_reg_by_referer_or_affil.php?id='.urlencode($user_id).'&verification_code='.urlencode($user_activation_hash);
        $mail->Body = PMU_EMAIL_VERIFICATION_CONTENT.' '.$link;

        if(!$mail->Send()) {
            $this->errors[] = $this->lang['Verification mail not sent'] . $mail->ErrorInfo;
            return false;
        } else {
            return true;
        }
    }

    /**
     * checks the id/verification code combination and set the user's activation status to true (=1) in the database
     */
    public function verifyNewUser($user_id, $user_activation_hash)
    {
        // if database connection opened
        if ($this->databaseConnection()) {
            // try to update user with specified information
            $query_update_user = $this->db_connection->prepare('UPDATE users SET user_active = 1, user_activation_hash = NULL WHERE user_id = :user_id AND user_activation_hash = :user_activation_hash');
            $query_update_user->bindValue(':user_id', intval(trim($user_id)), PDO::PARAM_INT);
            $query_update_user->bindValue(':user_activation_hash', $user_activation_hash, PDO::PARAM_STR);
            $query_update_user->execute();



            if ($query_update_user->rowCount() > 0) {
                $this->verification_successful = true;
                $this->messages[] = $this->lang['WordPress Email Verification successful'];
//send a notice to the upnum
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2accusersconfig.php");
			include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
			       $sql = "SELECT * FROM `users` WHERE `user_id` = '$user_id' ";
			$result = mysqli_query($connect, $sql)or die("<p align='left'>Bold query3 - 1"); 
                           while ($row = mysqli_fetch_array($result)) 
                          {
                          $wdgts_lnk_num = $row['wdgts_lnk_num'];
 $user_email = $row['user_email'];
 $user_name = $row['user_name'];
$wdgts_ID = $row['wdgts_ID'];
                          }

$plugin_email = $user_email;
$to = "Soon-to-be WordPress Blogger, $plugin_email";
$subject = "Your WordPress Blog Request";
$message = "You can now log in at ANY of our active WordPress MultiUser Sites and by using the same email you can get a blog by registering at the one(s) you want a blog at. When you register at one you will get to pick the blog title and its location within that domain you've gone to. For example, if you choose \"sally-smith\" as your own blog name and are at the Blog4Bitcoin site you will get a sub-domain blog address of sally-smith.Blog4Bitcoin.club. You can create your own blog at more than one MultiUser site as well and can have different names for them as you wish too. Each blog comes with the monetizing web directory installed and maintained. All you need to do is start blogging and draw traffic to your site. 

Here is the list of current active WordPress MultiUser sites where you can register and get a blog:

HAPPY BLOGGING!
";
//now instead of trying to locate this page and location to edit the list of WPMU sites I made a page devoted to
// only that task. I could eventually make a database table of them and automate it but for now it is a php page
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
			include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
     $query="SELECT * from `wpmu_list`";
$result = mysqli_query($connect, $query)or die("<p align='left'>Bold query315 "); 
                           while ($row = mysqli_fetch_array($result)) 
                          {$wpmu_url[] = $row['url'];
}

foreach($wpmu_url as $key=>$value){
$message .=  $value; 
$message .= "\r\n";
} 

$message .= '
Dev Note:This list in PMU classes
';



$from = "info@BungeeBones.com";
$headers = "From:" . $from;


mail($to,$subject,$message,$headers);
// NOW Insert Into widgets table 
// NOTICE We need a real parent number in this download version

//a  wpmu registrant from a plugin needs to be added to the temp table so that if they login to BB/members they get a "choose a WPMU site" page and not an "add url" page.
$query="INSERT INTO `temp_download_b4_wdgt_insert` (
`download_type`,
`progress`,
`new_registrant_blog_id`,
`referer_lnk_num`,
`referer_wdgt_id`,	
`referer_affiliate_num`,
`partner_link_num`,
`wp_user_login_registrant`,
`wp_user_email_registrant`,
`BB_user_ID`,
`url`,
`title`,
`description`,
`download_time`)
values
(
'wpmu_wanter',
'$progress',
'$new_registrant_blog_id',
'$wdgts_lnk_num',
'$wdgts_ID',	
'$wdgts_lnk_num',
'$partner_link_num',
'$user_name',
'$user_email',
'$user_id',
'$url',
'$title',
'$description',
'$download_time')";
// end insert into widgets table
mysqli_query($connect, $query);
$new_wdgt_ID = mysqli_insert_id($connect);




include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/widget_mgr/widget_tree_mgmt_class.php"); 
include($_SERVER['DOCUMENT_ROOT']."/classes/price_slot_class.php"); 
//credit them some testcoin 
$credit_testcoin = new price_slot_info;
$credit_amount = .1;
$credit_testcoin->credit_testnet ($user_id, $credit_amount);
/*  don't need for wpmu registrants from plugin sites ether
$widg_mng = new widget_tree_mgmt;
$widg_mng->rebuildTree('1',1);
*/

//change this from the former referrer id (gotten from the table) 
//to $wdgts_lnk_num (gotten from the affilate number / new user's table
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
			include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
$query = "SELECT `BB_user_ID` from `links` WHERE `id` = ".$wdgts_lnk_num;
$result = mysqli_query($connect, $query)or die("<p align='left'>Bold query3 - 432 "); 
                           while ($row = mysqli_fetch_array($result)) 
                          {
                          $parent_BB_user_id = $row['BB_user_ID'];
                          }
//now get the widgets email to send them notice
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2accusersconfig.php");
			include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
			       $sql = "SELECT * FROM `users` WHERE user_id = $parent_BB_user_id ";
			$result = mysqli_query($connect, $sql)or die("<p align='left'>Bold query3 - 440 "); 
                           while ($row = mysqli_fetch_array($result)) 
                          {
                          $upnum_email = $row['user_email'];
                          }




$to = "BungeeBones Publisher, $upnum_email";
$subject = "Someone Registered To Get A Personal Blog Through Your Account";
$message = "A new user registered for a WordPress blog (and they all include the BungeeBones web directory) after coming here from your own WordPress BungeeBones plugin. They have confirmed their email address and we are awaiting their selection of their blog site. When they start blogging they may start to earn themselves (and us) commissions!

";
$from = "info@BungeeBones.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);




            } else {
                $this->errors[] = $this->lang['Activation error'];
            }
        }
    }
}
