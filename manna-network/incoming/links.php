
<?php 

foreach($_POST as $key=>$value){
$file_handle = fopen($key.'.json', 'w');
fwrite($file_handle, $value);
fclose($file_handle); 

}
/*
$json_string = json_encode($_POST);

$file_handle = fopen('my_filename.json', 'w');
fwrite($file_handle, $json_string);
fclose($file_handle); 
*/

/*

Sql = SELECT * FROM `agent_broadcasts` LIMIT 1There are no agent broadcasts in agent broadcasts table 
Array ( 
[0] => 
Array ( 
[0] => 1 
[1] => 2 [2] => 3 [3] => 4 [4] => 5 [5] => 6 [6] => 7 [7] => 8 [8] => 9 [9] => 10 [10] => 12 ) 

[1] => 
Array ( 
[0] => 1stwebtrafficbank.com 
[1] => agent1.com 
[2] => agent2.com 
[3] => agent3.com 
[4] => agent-to-agent.com 
[5] => agent-to-central.com 
[6] => agent-to-downline.com 
[7] => downline.com 
[8] => central.com 
[9] => webtrafficbank.com 
[10] => dsfdsafdsaf.com ) 


[2] => Array ( [0] => 1stwebtrafficbank [1] => manna-network [2] => agent2 [3] => manna-network [4] => manna-network [5] => manna-network [6] => manna-network [7] => manna-network [8] => manna-network [9] => webtrafficbank [10] => tdtdtdtdtd ) 

[3] => Array ( [0] => 55 [1] => 55 [2] => 55 [3] => 55 [4] => 55 [5] => 55 [6] => 55 [7] => 55 [8] => 55 [9] => 55 [10] => 55 ) 

[4] => Array ( [0] => robert.r.lefebvre@gmail.com [1] => robert.r.lefebvre@gmail.com [2] => robert.r.lefebvre@gmail.com [3] => robert.r.lefebvre@gmail.com [4] => robert.r.lefebvre@gmail.com [5] => robert.r.lefebvre@gmail.com [6] => robert.r.lefebvre@gmail.com [7] => robert.r.lefebvre@gmail.com [8] => robert.r.lefebvre@gmail.com [9] => robert.r.lefebvre@gmail.com [10] => tester1@tester.com ) 

[5] => Array ( [0] => 2018-08-15 [1] => 2018-08-15 [2] => 2018-08-15 [3] => 2018-08-15 [4] => 2018-08-15 [5] => 2018-08-15 [6] => 2018-08-15 [7] => 2018-08-15 [8] => 2018-08-15 [9] => 2018-08-15 [10] => 2018-08-15 ) 

[6] => Array ( [0] => JuW/.dvSh20Xieua1jZgp [1] => DR2bhR9Vu4Fk9Hrxqps24 [2] => Xxz6Wj16yg5tiiuk9unn7 [3] => znCpD3zrlIHzjTaJXL03a [4] => lzp7yZhBMxBYFgV7D.Meu [5] => CGp.bZDjrMOn3Zt3Yq/ST [6] => EeNkLlqwE0I83yt04ypFQ [7] => cwqiPTWWKL3Es/jKV3SEj [8] => pCwtWkUrUPCWC540yettJ [9] => gMhn8qkP/qg8szVQy2YgI [10] => W8ClQ/hoI6fYzUYsc/C/B ) 

[7] => Array ( [0] => $2a$05$JuW/.dvSh20Xieua1jZgp.KzULwZ3RMT87AOpILWExm5.AT7p4elW [1] => $2a$05$DR2bhR9Vu4Fk9Hrxqps24.kQsFaakuwDjY2vJEfAKNokClR3BjSha [2] => $2a$05$Xxz6Wj16yg5tiiuk9unn7..E1SxYWc7U1R0T4ay.yKgnJLQ/pAnT6 [3] => $2a$05$znCpD3zrlIHzjTaJXL03a.od7NGFaF6R.kThmju71ywhI5E7Spwrm [4] => $2a$05$lzp7yZhBMxBYFgV7D.Meu.bj6OOFWjFp1G0h85uY3sCNzJAoukINy [5] => $2a$05$CGp.bZDjrMOn3Zt3Yq/ST.5fL353YEFIKNGKjmK7yfKrqIRgjbZcW [6] => $2a$05$EeNkLlqwE0I83yt04ypFQ.m3.6vc6RlDwvvtXpA9IUGFFVrCtreNW [7] => $2a$05$cwqiPTWWKL3Es/jKV3SEj.mG34VB9k4C9ekXTc0jx1QRwh/R5TSCO [8] => $2a$05$pCwtWkUrUPCWC540yettJ.HE.rURin1RYd.UY9QgiyvLFJBh6t82u [9] => $2a$05$gMhn8qkP/qg8szVQy2YgI.6OBFWe0wPHrBJtkyDlXAdtV0nxkPHdm [10] => $2a$05$W8ClQ/hoI6fYzUYsc/C/B.U3Yxvu7C2.TyPWvafLHEQT07GOdSEsG ) ) 





$user_id = explode(",",$_POST['user_id']); 
$MN_user_id = explode(",",$_POST['MN_user_id'] ); 
$url = explode(",",$_POST['url'] ); 
$name = explode(",",$_POST['name'] ); 
$description = explode(",",$_POST['description'] ); 
$no_follow = explode(",",$_POST['no_follow'] ); 
$category_id = explode(",",$_POST['category_id'] ); 
$location_id = explode(",",$_POST['location_id'] ); 
$website_street = explode(",",$_POST['website_street'] ); 
$website_district = explode(",",$_POST['website_district'] );

foreach($user_id as $key=>$value){
echo '<hr><br>user_id = ', $user_id[$key];
echo '<br>MN_user_id = ', $MN_user_id[$key];
echo '<br>url = ', $url[$key];
echo '<br>name = ', $name[$key];
echo '<br>description = ', $description[$key];
echo '<br>no_follow = ', $no_follow[$key];
echo '<br>category_id = ', $category_id[$key];
echo '<br>location_id = ', $location_id[$key];
echo '<br>website_street = ', $website_street[$key];
echo '<br>website_district = ', $website_district[$key];

}
*/


?>


