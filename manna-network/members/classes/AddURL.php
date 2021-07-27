<?php

/**
 * Handles the user registration
 * @author Panique
 * @link http://www.php-login.net
 * @link https://github.com/panique/php-login/
 * @license http://opensource.org/licenses/MIT MIT License
*/

class addurl
{
/** deprecate $recruiter_lnk_num
function addNewLink($captcha, $website_title, $website_description, $website_url, $category_id, $newcatsuggestion, $location_id, $website_street, $website_district, $installer_id, $user_id)
*/
 
   function addNewLink($captcha, $recruiter_lnk_num, $website_title, $website_description, $website_url, $category_id, $newcatsuggestion, $location_id, $website_street, $website_district, $installer_id, $user_id)
    {
//echo '<br>in func';
if (!defined('WRITER_CUSTOMERS')) {
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/auth_constants.php");
		}
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/".WRITER_CUSTOMERS);
		include(dirname(__DIR__, 3)."/manna-configs/db_cfg/mysqli_connect.php");

     if (strtolower($captcha) != strtolower($_SESSION['captcha'])) {
            $this->errors[] = 'MESSAGE_CAPTCHA_WRONG';
}
/* none of these from the registration class are needed but can be converted to check the link id, category id (if integers) and the string length of title and description and remove unwanted characters



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
        }  
/** deprecate recruiter_lnk_num
if (!($stmt = $mysqli->prepare("INSERT INTO customer_links (user_id, user_registration_datetime, website_title, website_description, website_url, category_id, newcatsuggestion, location_id, website_street, website_district, installer_id) VALUES (?,?,?,?,?,?,?,?,?,?,?)"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
$user_registration_datetime = time();
if (!$stmt->bind_param('iisssisissi',$user_id, $user_registration_datetime, $website_title, $website_description, $website_url, $category_id, $newcatsuggestion, $location_id, $website_street, $website_district, $installer_id)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}
*/


if (!($stmt = $mysqli->prepare("INSERT INTO customer_links (user_id, recruiter_lnk_num,  user_registration_datetime, website_title, website_description, website_url, category_id, newcatsuggestion, location_id, website_street, website_district, installer_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
$user_registration_datetime = time();
if (!$stmt->bind_param('iiisssisissi',$user_id, $recruiter_lnk_num, $user_registration_datetime, $website_title, $website_description, $website_url, $category_id, $newcatsuggestion, $location_id, $website_street, $website_district, $installer_id)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}
if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}
$new_links_id = $stmt->insert_id;
return $new_links_id;
$stmt->close();
if($new_links_id > 0){
//add a check whether site is already a member would be an improvement (then omit message about becoming a member if they already are)
echo '<h1 style="text-align:center;">Your addition of another website to the Manna Network has been successful. It is now awaiting approval. In the mean time, you can still purchase better placement for it (with the free Demo coin you received). Placing a bid also moves you to the top of the queue for reviewing! If you haven\'t done so already,  you can install a FREE Manna Network "Classifieds Section" API on your site and become a member! You can place a bid for better placement by returning to your member control panel and click the "Get Better Placement" link by this new ad you submitted.</h1>';
    }
/*
echo '<br>in AddURL.php (all caps) ', $query_new_user_lnk_insert;   
$result2 = mysqli_query($mysqli, $query_new_user_lnk_insert);

       if (!$query_new_user_lnk_insert) {
                    $this->errors[] = $this->lang['MESSAGE_ADD_LINK_FAILED'];
                } */
         //   }
        }
   
    /*
     * change this to send emails to the upline 
     * @return boolean gives back true if mail has been sent, gives back false if no mail could been sent
     
    public function sendVerificationEmail($user_id, $user_email, $user_activation_hash, $flag)
    {
        $mail = new PHPMailer;
        // please look into the config/config.php for much more info on how to use this!
        // use SMTP or use mail()
  if (EMAIL_USE_SMTP) {
            $mail->IsSMTP();
            $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = EMAIL_SMTP_AUTH;
              if (defined(EMAIL_SMTP_ENCRYPTION)) {
                $mail->SMTPSecure = EMAIL_SMTP_ENCRYPTION;
            }
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


  $link = "https://".AGENT_URL."/".AGENT_FOLDERNAME."/manna-network/members/register.php".'?id='.urlencode($user_id).'&verification_code='.urlencode($user_activation_hash).'&flag='.$flag;


        // the link to your register.php, please set this value in config/email_verification.php
       $mail->Body = EMAIL_VERIFICATION_CONTENT.' '.$link;

      if(!$mail->Send()) {
       $this->errors[] = $this->lang['MESSAGE_VERIFICATION_MAIL_NOT_SENT'] . $mail->ErrorInfo;
       return false;
         } else {
            return true;
        }
    } */
}
