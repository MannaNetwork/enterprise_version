<?php

/**
 * Handles the user registration
 * @author Panique
 * @link http://www.php-login.net
 * @link https://github.com/panique/php-login/
 * @license http://opensource.org/licenses/MIT MIT License
*/

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
$user_name = ""; 
$user_email = "";  
$user_password_new = "";  
$user_password_repeat = "";  
$captcha = "";  
$recruiter_lnk_num = "";  
$website_title = "";
 $website_description = "";
 $website_url = "";
 $category_id = "";
$newcatsuggestion = "";
 $location_id = "";
 $website_street = "";
 $website_district = "";
// showing the register view (with the registration form, and messages/errors)

if (!defined('AGENT_FOLDERNAME')) {
include(dirname(__DIR__, 3)."/manna-configs/db_cfg/agent_config.php");
}
        if (array_key_exists ( "register" , $_POST ) AND isset($_POST["register"])) {
if (array_key_exists ( "user_name" , $_POST ) AND isset($_POST["user_name"])) {
$user_name = $_POST['user_name']; 
}
 if (array_key_exists ( "user_email" , $_POST ) AND isset($_POST["user_email"])) {
$user_email = $_POST['user_email']; 
}
 if (array_key_exists ( "user_password_new" , $_POST ) AND isset($_POST["user_password_new"])) {
$user_password_new = $_POST['user_password_new']; 
}
 if (array_key_exists ( "user_password_repeat" , $_POST ) AND isset($_POST["user_password_repeat"])) {
$user_password_repeat = $_POST['user_password_repeat'];
} 

 if (array_key_exists ( "recruiter_lnk_num" , $_POST ) AND isset($_POST["recruiter_lnk_num"])) {
$recruiter_lnk_num = $_POST["recruiter_lnk_num"];
} 
else
{
$recruiter_lnk_num = "";
}
 if (array_key_exists ( "captcha" , $_POST ) AND isset($_POST["captcha"])) {
$captcha = $_POST["captcha"];
} 

///////////////  Website Info ////////////////////////
if (array_key_exists ( "website_title" , $_POST ) AND isset($_POST["website_title"])) {
$website_title = $_POST["website_title"];
$website_title = (strlen($website_title) > 24) ? substr($website_title,0,22).'...' : $website_title;
}
if (array_key_exists ( "website_description" , $_POST ) AND isset($_POST["website_description"])) {
$website_description = $_POST["website_description"];
$website_description = (strlen($website_description) > 224) ? substr($website_description,0,220).'...' : $website_description;
}
if (array_key_exists ( "website_url" , $_POST ) AND isset($_POST["website_url"])) {
$website_url = $_POST["website_url"];
$website_url = (strlen($website_url) > 59) ? substr($website_url,0,55).'...' : $website_url;
}
if (array_key_exists ( "category_id" , $_POST ) AND isset($_POST["category_id"])) {
$category_id = $_POST["category_id"];
}
if (array_key_exists ( "flag" , $_POST ) AND isset($_POST["flag"])) {
$flag = 1;
}
else
{
$flag = 0;
}
if (array_key_exists ( "newcatsuggestion" , $_POST ) AND isset($_POST["newcatsuggestion"])) {
$newcatsuggestion = $_POST["newcatsuggestion"];
$newcatsuggestion = (strlen($newcatsuggestion) > 49) ? substr($newcatsuggestion,0,45).'...' : $newcatsuggestion;
}
if (array_key_exists ( "location_id," , $_POST ) AND isset($_POST["location_id,"])) {
$location_id = $_POST["location_id,"];
}
if (array_key_exists ( "website_street" , $_POST ) AND isset($_POST["website_street"])) {
$website_street = $_POST["website_street"];
$website_street = (strlen($website_street) > 79) ? substr($website_street,0,75).'...' : $website_street;
}
if (array_key_exists ( "website_district" , $_POST ) AND isset($_POST["website_district"])) {
$website_district = $_POST["website_district"];
$website_district = (strlen($website_district) > 59) ? substr($website_district,0,55).'...' : $website_district;
}
if (array_key_exists ( "wants_tobea_widget" , $_POST ) AND isset($_POST["wants_tobea_widget"])) {
$wants_tobea_widget = $_POST["wants_tobea_widget"];
}else
{
$wants_tobea_widget = 0;
}

$this->registerNewUser($user_name, $user_email, $user_password_new, $user_password_repeat, $captcha, $recruiter_lnk_num, $website_title, $website_description, $website_url, $category_id, $newcatsuggestion, $location_id, $website_street, $website_district, $wants_tobea_widget, $flag);  


        // if we have such a GET request, call the verifyNewUser() method
        } else if (isset($_GET["id"]) && isset($_GET["verification_code"])) {
 if (array_key_exists ( "flag" , $_GET ) AND isset($_GET["flag"])) {
$flag = $_GET["flag"];
} 

            $this->verifyNewUser($_GET["id"], $_GET["verification_code"], $flag);
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

//stbitcoi_writcus_auth.php
//stbitcoi_writcus_auth.php
$PREFIX = EXPLODE("_", READER_CUSTOMERS);
include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".$PREFIX[0]."_writcus_auth.php");

                $this->db_connection = new PDO('mysql:host='.$servername.';dbname='. $dbname, $username, $password, 
  array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                return true;
            // If an error is catched, database connection failed
            } catch (PDOException $e) {

                $this->errors[] = $this->lang['MESSAGE_DATABASE_ERROR'];
                return false;
            }
        }
    }

    /**
     * Checks if database connection is opened and open it if not
     */
    private function databaseConnectionLimited()
    {

        // connection already opened
        if ($this->db_connection != null) {
            return true;
        } else {
            // create a database connection, using the constants from config/config.php
            try {

$PREFIX = EXPLODE("_", READER_CUSTOMERS);
include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".$PREFIX[0]."_writcus_auth.php");


              
      $pdo = new PDO('mysql:host='.$servername.';dbname='.$dbname, $username, $password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
      $pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );          
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                return true;
            // If an error is catched, database connection failed
            } catch (PDOException $e) {

                $this->errors[] = $this->lang['MESSAGE_DATABASE_ERROR'];
                return false;
            }
        }
    }

    /**


     * handles the entire registration process. checks all error possibilities, and creates a new user in the database if
     * everything is fine
     */
    private function registerNewUser($user_name, $user_email, $user_password, $user_password_repeat, $captcha, $recruiter_lnk_num, $website_title, $website_description, $website_url, $category_id, $newcatsuggestion, $location_id, $website_street, $website_district, $wants_tobea_widget, $flag)
    {

        // we just remove extra space on username and email
        $user_name  = trim($user_name);
        $user_email = trim($user_email);

        // check provided data validity
        // TODO: check for "return true" case early, so put this first

     if (strtolower($captcha) != strtolower($_SESSION['captcha'])) {
            $this->errors[] = 'MESSAGE_CAPTCHA_WRONG';
        } elseif (empty($user_name)) {
            $this->errors[] = $this->lang['MESSAGE_USERNAME_EMPTY'];
        } elseif (empty($user_password) || empty($user_password_repeat)) {
            $this->errors[] = $this->lang['MESSAGE_PASSWORD_EMPTY'];
        } elseif ($user_password !== $user_password_repeat) {
            $this->errors[] = $this->lang['MESSAGE_PASSWORD_BAD_CONFIRM'];
        } elseif (strlen($user_password) < 6) {
            $this->errors[] = $this->lang['MESSAGE_PASSWORD_TOO_SHORT'];
        } elseif (strlen($user_name) > 64 || strlen($user_name) < 2) {
            $this->errors[] = $this->lang['MESSAGE_EMAIL_TOO_LONG'];
        } 
//elseif (!preg_match('/^[a-z\d]{2,64}+\_[a-z\d]{2,64}$/i', $user_name)) {
        elseif (!preg_match('/^[a-z\d]{2,64}$/i', $user_name)) {                     

            $this->errors[] = $this->lang['MESSAGE_USERNAME_INVALID'];
        } elseif (empty($user_email)) {
            $this->errors[] = $this->lang['MESSAGE_EMAIL_EMPTY'];
        } elseif (strlen($user_email) > 64) {
            $this->errors[] = $this->lang['MESSAGE_EMAIL_TOO_LONG'];
        } elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {

            $this->errors[] = $this->lang['MESSAGE_EMAIL_INVALID'];

        // finally if all the above checks are ok
        } else if ($this->databaseConnection()) {
            // check if username or email already exists

            $query_check_user_name = $this->db_connection->prepare('SELECT user_name, user_email FROM users WHERE user_name=:user_name OR user_email=:user_email');
            $query_check_user_name->bindValue(':user_name', $user_name, PDO::PARAM_STR);
            $query_check_user_name->bindValue(':user_email', $user_email, PDO::PARAM_STR);
            $query_check_user_name->execute();
            $result = $query_check_user_name->fetchAll();
//$query_check_user_name->debugDumpParams();
            // if username or/and email find in the database
            if (count($result) > 0) {
                for ($i = 0; $i < count($result); $i++) {
                    $this->errors[] = ($result[$i]['user_name'] == $user_name) ? $this->lang['MESSAGE_USERNAME_EXISTS'] : $this->lang['MESSAGE_EMAIL_ALREADY_EXISTS'];
echo '<h2>There Is An Error In The Data You Provided. Perhaps the user name is already used. Perhaps the email is already used. Are you already registered?</h2>';
                }
            } else {


               // check if we have a constant HASH_COST_FACTOR defined (in config/hashing.php),
                // if so: put the value into $hash_cost_factor, if not, make $hash_cost_factor = null
              //  $hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);
 $hash_cost_factor = 10;
                // crypt the user's password with the PHP 5.5's password_hash() function, results in a 60 character hash string
                // the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using PHP 5.3/5.4, by the password hashing
                // compatibility library. the third parameter looks a little bit shitty, but that's how those PHP 5.5 functions
                // want the parameter: as an array with, currently only used with 'cost' => XX.
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
                // generate random hash for email verification (40 char string)
                $user_activation_hash = sha1(uniqid(mt_rand(), true));


$query_new_user_insert = $this->db_connection->prepare('INSERT INTO users (user_name, user_password_hash, user_email, user_activation_hash, user_registration_ip, recruiter_lnk_num,  user_registration_datetime, website_title, website_description, website_url, category_id, newcatsuggestion, location_id, website_street, website_district, wants_tobea_widget) VALUES(:user_name, :user_password_hash, :user_email, :user_activation_hash, :user_registration_ip, :recruiter_lnk_num,  :user_registration_datetime, :website_title, :website_description, :website_url, :category_id, :newcatsuggestion, :location_id, :website_street, :website_district, :wants_tobea_widget);');
                                                                        
      $query_new_user_insert->bindValue(':user_name', $user_name, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_password_hash', $user_password_hash, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_email', $user_email, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_activation_hash', $user_activation_hash, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_registration_ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':recruiter_lnk_num', $recruiter_lnk_num, PDO::PARAM_INT);
               
//$user_registration_datetime = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
$user_registration_datetime = time();
 $query_new_user_insert->bindValue(':user_registration_datetime', $user_registration_datetime, PDO::PARAM_STR);

 $query_new_user_insert->bindValue(':website_title', $website_title, PDO::PARAM_STR);
 $query_new_user_insert->bindValue(':website_description', $website_description, PDO::PARAM_STR);
 $query_new_user_insert->bindValue(':website_url', $website_url, PDO::PARAM_STR);
$query_new_user_insert->bindValue(':category_id', $category_id, PDO::PARAM_INT);
$query_new_user_insert->bindValue(':newcatsuggestion',   $newcatsuggestion, PDO::PARAM_STR);

$query_new_user_insert->bindValue(':location_id', $location_id, PDO::PARAM_INT);

 $query_new_user_insert->bindValue(':website_street', $website_street, PDO::PARAM_STR);
 $query_new_user_insert->bindValue(':website_district', $website_district, PDO::PARAM_STR);
$query_new_user_insert->bindValue(':wants_tobea_widget', intval($wants_tobea_widget), PDO::PARAM_INT);
                 $query_new_user_insert->execute();


//$query_new_user_insert->debugDumpParams();

                // id of new user
                $user_id = $this->db_connection->lastInsertId();

//echo '<h1>Last Insert ID = ', $user_id;



                if ($query_new_user_insert) {

$query_new_user_lnk_insert = $this->db_connection->prepare('INSERT INTO customer_links (customer_id, user_id, recruiter_lnk_num,  user_registration_datetime, website_title, website_description, website_url, category_id, newcatsuggestion, location_id, website_street, website_district, wants_tobea_widget) VALUES(:customer_id, :user_id, :recruiter_lnk_num, :user_registration_datetime, :website_title, :website_description, :website_url, :category_id, :newcatsuggestion, :location_id, :website_street, :website_district, :wants_tobea_widget);');
                                                                        
      $query_new_user_lnk_insert->bindValue(':customer_id', $user_id, PDO::PARAM_INT);
$query_new_user_lnk_insert->bindValue(':user_id', $user_id, PDO::PARAM_INT);
                $query_new_user_lnk_insert->bindValue(':recruiter_lnk_num', $recruiter_lnk_num, PDO::PARAM_INT);
$user_registration_datetime =  mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
 $query_new_user_lnk_insert->bindValue(':user_registration_datetime', $user_registration_datetime, PDO::PARAM_STR);
 $query_new_user_lnk_insert->bindValue(':website_title', $website_title, PDO::PARAM_STR);
 $query_new_user_lnk_insert->bindValue(':website_description', $website_description, PDO::PARAM_STR);
 $query_new_user_lnk_insert->bindValue(':website_url', $website_url, PDO::PARAM_STR);
$query_new_user_lnk_insert->bindValue(':category_id', $category_id, PDO::PARAM_INT);
$query_new_user_lnk_insert->bindValue(':newcatsuggestion',   $newcatsuggestion, PDO::PARAM_STR);

$query_new_user_lnk_insert->bindValue(':location_id', $location_id, PDO::PARAM_INT);

 $query_new_user_lnk_insert->bindValue(':website_street', $website_street, PDO::PARAM_STR);
 $query_new_user_lnk_insert->bindValue(':website_district', $website_district, PDO::PARAM_STR);
$wants_tobea_widget = intval($wants_tobea_widget);
$query_new_user_lnk_insert->bindValue(':wants_tobea_widget', $wants_tobea_widget, PDO::PARAM_INT);

                 $query_new_user_lnk_insert->execute();

                    // send a verification email

                  if ($this->sendVerificationEmail($user_id, $user_email, $user_activation_hash, $flag)) {
                        // when mail has been send successfully

                        $this->messages[] = $this->lang['MESSAGE_VERIFICATION_MAIL_SENT'];
                        $this->registration_successful = true;

//widgets table describe - id, url, link_id, wp_domain, is_parked, parent, lft, rgt, time_period, start_clone_date, last_update, end_clone_date, display_freebies 
 // $query_new_user_insert->debugDumpParams();

                // id of new user
                $new_customer_link_id = $this->db_connection->lastInsertId();

echo MESSAGE_VERIFICATION_MAIL_SENT;
                  } else {
                        // delete this users account immediately, as we could not send a verification email
                      $query_delete_user = $this->db_connection->prepare('DELETE FROM users WHERE user_id=:user_id');
                     $query_delete_user->bindValue(':user_id', $user_id, PDO::PARAM_INT);
                     $query_delete_user->execute();

                      $this->errors[] = $this->lang['MESSAGE_VERIFICATION_MAIL_ERROR'];
                   } 


       } else {
                    $this->errors[] = $this->lang['MESSAGE_REGISTRATION_FAILED'];
                }
            }
        }
    }

    /*
     * sends an email to the provided email address
     * @return boolean gives back true if mail has been sent, gives back false if no mail could been sent
     */
    public function sendVerificationEmail($user_id, $user_email, $user_activation_hash, $flag)
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
        $mail->FromName = EMAIL_VERIFICATION_FROM_NAME;
        $mail->AddAddress($user_email);
        $mail->Subject = EMAIL_VERIFICATION_SUBJECT;

   //     $link = EMAIL_VERIFICATION_URL.'?id='.urlencode($user_id).'&verification_code='.urlencode($user_activation_hash);


  $link = "https://".AGENT_URL."/".AGENT_FOLDERNAME."/manna-network/members/register.php".'?id='.urlencode($user_id).'&verification_code='.urlencode($user_activation_hash).'&flag='.$flag;


        // the link to your register.php, please set this value in config/email_verification.php
       $mail->Body = EMAIL_VERIFICATION_CONTENT.' '.$link;

      if(!$mail->Send()) {
       $this->errors[] = $this->lang['MESSAGE_VERIFICATION_MAIL_NOT_SENT'] . $mail->ErrorInfo;
       return false;
         } else {
            return true;
        }
    }

    /**
     * checks the id/verification code combination and set the user's activation status to true (=1) in the database
     */




    public function verifyNewUser($user_id, $user_activation_hash, $flag)
    {
//echo '<br>In the verify new user func and flag = ', $flag;
include(dirname(__DIR__, 3)."/manna-configs/db_cfg/agent_config.php");


        // if database connection opened
        if ($this->databaseConnection()) {

           // try to update user with specified information
            $query_update_user = $this->db_connection->prepare('UPDATE users SET user_active = 1, user_activation_hash = NULL WHERE user_id = :user_id AND user_activation_hash = :user_activation_hash');
            $query_update_user->bindValue(':user_id', intval(trim($user_id)), PDO::PARAM_INT);
            $query_update_user->bindValue(':user_activation_hash', $user_activation_hash, PDO::PARAM_STR);
            $query_update_user->execute();
//I added the if isset flag to prevent the initial configuring submission of the agent's own site to their database from sending anything to the Manna network.com website
          
$user_active=1;
     $query_check_update = $this->db_connection->prepare('SELECT user_name FROM users WHERE user_id = :user_id AND user_active = :user_active');
            $query_check_update->bindValue(':user_id', intval(trim($user_id)), PDO::PARAM_INT);
            $query_check_update->bindValue(':user_active', intval(trim($user_active)), PDO::PARAM_INT);
            $query_check_update->execute();
            $result = $query_check_update->fetchAll();
//$query_check_update->debugDumpParams();

if (count($result) > 0) {
   echo '<h1>User email verified</h1>';

		if($flag != 1){
                $this->verification_successful = true;
                $this->messages[] = $this->lang['MESSAGE_REGISTRATION_ACTIVATION_SUCCESSFUL'];
		//Now that the user has verified their email, we retrieve their original info to submit it to the network

		$query = $this->db_connection->prepare('SELECT id, recruiter_lnk_num,  user_registration_datetime, website_title, website_description, website_url, category_id, newcatsuggestion, location_id, website_street, website_district, wants_tobea_widget FROM customer_links
		WHERE customer_id=:user_id');
		 $query->bindValue(':user_id', $user_id, PDO::PARAM_INT);
		 $query->execute();
		$row = $query->fetch();           
	//	$query->debugDumpParams();

		$link_id = $row['id'];
		$recruiter_lnk_num = $row['recruiter_lnk_num'];
		$user_registration_datetime = $row['user_registration_datetime'];
		$website_title = $row['website_title'];
		$website_description = $row['website_description'];
		$website_url = $row['website_url'];
		$category_id = $row['category_id'];
		$newcatsuggestion = $row['newcatsuggestion'];
		$location_id = $row['location_id'];
		$website_street = $row['website_street'];
		$website_district = $row['website_district'];
		$wants_tobea_widget = $row['wants_tobea_widget'];


		// look for promos NOTE PDO Can't do LIMIT 
	//stbitcoi_readage_auth.php

		if (!defined('READER_AGENTS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/_readage_auth.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_AGENTS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/agent_config.php");
		$sql = "SELECT * FROM promo_codes ORDER BY `id` DESC LIMIT 1";
		$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
		$num_promo_codes = mysqli_num_rows($result);
		if($num_promo_codes > 0){
		while($row = mysqli_fetch_array($result)){
		$this_last_title = $row['promo_title'];
		$promo_description = $row['promo_description']; 
		$coin_type = $row['coin_type']; 
		$promo_amount = $row['promo_amount']; 
		}

	if (!defined('READER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/_readage_auth.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".READER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/agent_config.php");

		//now credit the user locally
		 if ($this->databaseConnection()) {
		
		$query_new_user_insert = $this->db_connection->prepare('INSERT INTO balance (user_id, customer_id, amount_DMC, amount_BCH, txid) VALUES(:user_id, :customer_id, :amount_DMC, :amount_BCH, :txid);');
				                                                        
		      $query_new_user_insert->bindValue(':user_id', $user_id, PDO::PARAM_INT);
				$query_new_user_insert->bindValue(':customer_id', $user_id, PDO::PARAM_INT);
				$query_new_user_insert->bindValue(':amount_DMC', $promo_amount, PDO::PARAM_STR);
				$query_new_user_insert->bindValue(':amount_BCH', '0', PDO::PARAM_STR);
				$query_new_user_insert->bindValue(':txid', $this_last_title, PDO::PARAM_STR);
				   $query_new_user_insert->execute();
				//$query_new_user_insert->debugDumpParams();
			} //close  db connection

		}
		else
		{
		$promo_amount = 0;
		}

		//now send user registration to central 
		$file="http://exchange.manna-network.com/incoming/register.php";
		$args = array(
		'agent_id' => AGENT_ID,
		'remote_user_id' => $user_id,
		'remote_link_id' => $link_id,
		'recruiter_lnk_num' => $recruiter_lnk_num,
		'user_registration_datetime' => $user_registration_datetime,
		'website_title' => $website_title,
		'website_description' => $website_description,
		'website_url' => $website_url,
		'category_id' => $category_id,
		'newcatsuggestion' => $newcatsuggestion,
		'location_id' => $location_id,
		'website_street' => $website_street,
		'website_district' => $website_district,
		'wants_tobea_widget' => $wants_tobea_widget,
		'promo_credit' => $promo_amount
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $file);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, array('locus_array' => $locus_array,'link_record_num' => $link_record_num,'link_page_total' => $link_page_total, 'link_page_id' => $link_page_id, 'pagem_url_cat' => $pagem_url_cat,'link_page_num' => $link_page_num, 'cat_page_num' => $cat_page_num, 'url_cat' => $url_cat, 'affiliate_num' => $affiliate_num  ));
		curl_setopt($ch, CURLOPT_POSTFIELDS,$args);

		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
    		    $curl_errno = curl_errno($ch);
		    $curl_error = curl_error($ch);
		    if ($curl_errno > 0) {
			    echo "cURL Error line 575 ($curl_errno): $curl_error\n";
		    } else {    

		curl_close($ch);
		echo($data);
}


                  }//close if flag !=
			else
			{
			//Leave a brief message to the new agent
			echo '<h1>Your own link information was successfully added to your own database</h1>';
echo '<p>Now your website is configured as an "agency" site in the network with your own agent ID and the #1 link id (within your own web directory). The two together provide your website a unique id in the manna network to credit you with all the users that register through your web directory and through their websites (if they, too, install our scripts)</p>';
echo '<br>nbsp;<hr><p>You can now offer this web directory page to your website visotors and offer them FREE advertising and the opportunity to earn Bitcoin SV. Make a link to the directory page. Let your site visitors enjoy it as a feature of your site, offer free advertising to your friends and associates. promote it as much as you like!</p>
<h3>The url you want to send them to is the <a href="../../../../../agent-dir/index.php">agent-dir/index.php page</a>.</h3>
<h4>Use the above link to add more websites if you wish and they will be submitted to the manna Network for inclusion and distribution to the other agent and members sites as well<h4>';


			}

		}//close if ($query_update_user->rowCount() > 0)
		else
		{
		echo '<h1 style="color:red; text-align:center;">Registration Failed!<br> Please Contact Administration. <br> Sorry for the inconvenience.</h1>';
		}
		if($flag != 1){
$precleaned_host = $_SERVER['HTTP_HOST'];
$cleaned_host = str_replace("www.", "", $precleaned_host);
			echo '<h3 style="color:red; text-align:center;">Your registration and web site information was successfully placed in the Manna Network queue for administrative review. Please allow 24-48 hours for this process and for your website listing to appear in the manna network member\'s websites.</h3>
				<h3 style="color:red; text-align:center;">The link approval process does  NOT hinder your ability to correctly install any of our Bitcoin-earning scripts. If you are eager to get started earning Bitcoin with your website, use the contact form download the latest scripts from http://Github.com/Manna-Network. The correct configurations you will need are: Agent_ID = '.AGENT_ID.' and your link or affiliate ID = '.$link_id.'. </h3>

<h3>You can also log in to your User Control Panel to:<br>1) Advertise more of your websites<br>2) Bid For Better Placement for free using the free "demo coins" we credited your account with.<br><br> <a href="./">Here is the link:</a> to your member control panel.
';
		   }
		} else {
                $this->errors[] = $this->lang['MESSAGE_REGISTRATION_ACTIVATION_NOT_SUCCESSFUL'];

            }
      
    }
}
