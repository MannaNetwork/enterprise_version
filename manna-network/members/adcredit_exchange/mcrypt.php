<?php
$key = 'Google';
/*$string = $unencrypted_bank_acct_number; 
$string2 = $unencrypted_bank_acct_name;
$iv = mcrypt_create_iv(
    mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC),
    MCRYPT_DEV_URANDOM
);

//To Encrypt:

$encrypted = base64_encode(
    $iv .
    mcrypt_encrypt(
        MCRYPT_RIJNDAEL_256,
        hash('sha256', $key, true),
        $string,
        MCRYPT_MODE_CBC,
        $iv
    )
);

$encrypted2 = base64_encode(
    $iv .
    mcrypt_encrypt(
        MCRYPT_RIJNDAEL_256,
        hash('sha256', $key, true),
        $string2,
        MCRYPT_MODE_CBC,
        $iv
    )
);
//To Decrypt:

$data = base64_decode($encrypted);
$data2 = base64_decode($encrypted2);
$iv = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC));
$iv2 = substr($data2, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC));

$decrypted = rtrim(
    mcrypt_decrypt(
        MCRYPT_RIJNDAEL_256,
        hash('sha256', $key, true),
        substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)),
        MCRYPT_MODE_CBC,
        $iv
    ),
    "\0"
);
$decrypted2 = rtrim(
    mcrypt_decrypt(
        MCRYPT_RIJNDAEL_256,
        hash('sha256', $key, true),
        substr($data2, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)),
        MCRYPT_MODE_CBC,
        $iv2
    ),
    "\0"
);

//Demo at IDEOne.com:

//echo 'Encrypted:' . "\n";
//var_dump($encrypted); // "ey7zu5zBqJB0rGtIn5UB1xG03efyCp+KSNR4/GAv14w="

//echo "\n";

echo 'Decrypted:' . "\n";
var_dump($decrypted); // " string to be encrypted "



//echo 'Encrypted2:' . "\n";
//var_dump($encrypted2); // "ey7zu5zBqJB0rGtIn5UB1xG03efyCp+KSNR4/GAv14w="

//echo "\n";

echo 'Decrypted2:' . "\n";
var_dump($decrypted2); // " string to be encrypted "
*/

?>
