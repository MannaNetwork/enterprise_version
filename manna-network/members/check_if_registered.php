<?php
 $args3 = array(
'http_host' =>   $_SERVER['HTTP_HOST']
 );

 $url3 = "https://exchange.manna-network.com/incoming/check_if_registered.php";

     $ch = curl_init();    // initialize curl handle
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_URL, $url3); 
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);          
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 50); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $args3); 
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);

    $links_list_3 = curl_exec($ch);
    $curl_errno = curl_errno($ch);
    $curl_error = curl_error($ch);
 if ($curl_errno > 0) {
         echo "cURL Error ($curl_errno): $curl_error\n";
 } else { 
        $decoded =  json_decode($links_list_3, true);
      return $decoded;
 }
    ?>
