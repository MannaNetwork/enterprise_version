<?php

/**
 * Handles the user registration
 * @author Panique
 * @link http://www.php-login.net
 * @link https://github.com/panique/php-login/
 * @license http://opensource.org/licenses/MIT MIT License
*old user access table column names
*	
*id
*BB_bank_ID
*login
*pw
*real_name
*wdgts_lnk_num
*wdgts_ID
*extra_info
*tmp_mail
*access_level
*active
*ip_address
*proxy_ip_address
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

        if (array_key_exists ( "register" , $_POST ) AND isset($_POST["register"])) {
if (array_key_exists ( "user_name" , $_POST ) AND isset($_POST["user_name"])) {
$user_name = $_POST['user_name']; 
}
else
{
$user_name = ""; 
}

 if (array_key_exists ( "user_password_new" , $_POST ) AND isset($_POST["user_password_new"])) {
$user_password_new = $_POST['user_password_new']; 
}
else
{
$user_password_new = ""; 
}
 if (array_key_exists ( "user_password_repeat" , $_POST ) AND isset($_POST["user_password_repeat"])) {
$user_password_repeat = $_POST['user_password_repeat'];
} 
else
{
$user_password_repeat = ""; 
}

 if (array_key_exists ( "wdgts_lnk_num" , $_POST ) AND isset($_POST["wdgts_lnk_num"])) {
$wdgts_lnk_num = $_POST["wdgts_lnk_num"];
} 
else
{
$wdgts_lnk_num = ""; 
}
 if (array_key_exists ( "wdgts_id" , $_POST ) AND isset($_POST["wdgts_id"])) {
$wdgts_id = $_POST["wdgts_id"];
} 
else
{
$wdgts_id = ""; 
}

$this->registerNewUser(
$user_name, 
$user_password_new, 
$user_password_repeat, 
$wdgts_lnk_num, 
$wdgts_id
);  

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
    private function registerNewUser($user_name, $user_password, $user_password_repeat, $wdgts_lnk_num, $wdgts_id)
    {

      
        $user_name  = trim($user_name);
        
        // check provided data validity
        // TODO: check for "return true" case early, so put this first

     if (empty($user_name)) {
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
        } else if ($this->databaseConnection()) {
         
            $query_check_user_name = $this->db_connection->prepare('SELECT user_name FROM users WHERE user_name=:user_name');
            $query_check_user_name->bindValue(':user_name', $user_name, PDO::PARAM_STR);
            $query_check_user_name->execute();
            $result = $query_check_user_name->fetchAll();

           
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
            
$query_new_user_insert = $this->db_connection->prepare('INSERT INTO users (user_name, user_password_hash,  user_registration_ip, wdgts_lnk_num, wdgts_ID, user_registration_datetime) VALUES(:user_name, :user_password_hash,  :user_registration_ip, :wdgts_lnk_num, :wdgts_id, now())');
                                                                        
      $query_new_user_insert->bindValue(':user_name', $user_name, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_password_hash', $user_password_hash, PDO::PARAM_STR);
                                $query_new_user_insert->bindValue(':user_registration_ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':wdgts_lnk_num', $wdgts_lnk_num, PDO::PARAM_INT);
                $query_new_user_insert->bindValue(':wdgts_id', $wdgts_id, PDO::PARAM_INT);
                 $query_new_user_insert->execute();




                // id of new user
                $user_id = $this->db_connection->lastInsertId();
                if ($query_new_user_insert) {
                    // send a verification email
                   
                } else {
echo '<br>line 209 DEV registration failed';
                    $this->errors[] = $this->lang['Registration failed'];
                }
            }
        }
    }

}
