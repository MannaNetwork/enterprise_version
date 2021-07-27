<?php
echo ' <h3 style="color:red;">Congratulations on getting your new web directory <br>and income opportunity!</h3>';
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
 $url = $_POST['site_url'];
 $sql="select * from `links` where `url` like '%$url%'";
 $result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit members index 558");
 $num_results_in_links = mysqli_num_rows($result);
  	if( $num_results_in_links >0) 
  	  {
        	//search the links table for url - if there, we need to make sure the info is in widgets table too.
		//how is it possible (iss it possible) for a site to get into links table and not widgets? Yes, if they download the 	script from their "earn income" link by the link listing in their CP
		while ($row = mysqli_fetch_array($result)){
		$link_id = $row['id'];	}
		//since we got a link, they must be verified! Otherwise, BB won't let them login and the reg form only adds to temp
		//so, we check widgets, copy to there if not, and delete temp record	
		$sql="select * from `widgets` where `link_id` = $link_id";
		$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit members index 558");
		$num_results_in_widgets = mysqli_num_rows($result);
			if( $num_results_in_widgets < 1) 
			{
				while ($row = mysqli_fetch_array($result)){
				$temp_id=$row['id']; }
		                $sql="select * from `temp_download_b4_wdgt_insert` where `url` like '%$url%'";
		  		$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit members index 558");
		  		$num_results_in_temp = mysqli_num_rows($result);
				  if( $num_results_in_temp >0) 
				   {
					//search the temp table for url - 
					//if there, we need to copy the info to widgets table
		        		while ($row = mysqli_fetch_array($result)){
					$temp_id=$row['id'];		
					$new_email = $row['wp_user_email_registrant'];
					$BB_user_ID = $row['BB_user_ID'];
					$url2 = $row['url'];
					$title = $row['title'];
					$description = $row['description']; 
					$referer_lnk_num = $row['referer_lnk_num']; 
					$referer_wdgt_id = $row['referer_wdgt_id']; }
		
					//copy the info from temp into links/widgets and run tree rebuild
					include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
					include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
					$sql="INSERT into `widgets`(`link_id`, `parent`,`time_period`,`version`,`start_clone_date`,`end_clone_date`)VALUES ('$link_id','$referer_wdgt_id','8','$url','$date->getTimestamp()','0000-00-00 00:00:00')";
					$result2 = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit no link id regular 558");
					    if($result2){$widget_inserted="true";}
						if($widget_inserted == "true"){ 
						
						$sql = "DELETE FROM `temp_download_b4_wdgt_insert` WHERE `id` = $temp_id";
						$result2 = mysqli_query($connect, $sql);
						include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/widget_mgr/widget_tree_mgmt_class.php");
						$parent=0;
						$lft=1;
						$rebuild = new widget_tree_mgmt;
						$rebuild->rebuildTree(1, 1);
echo '<h1>Success! Phase 1 - <br>BungeeBones Server Configuration Complete</h1>';
						}//close if($widget_inserted == "true"
				}//close IF $num_results_in_temp >0
			} //close if $num_results_in_widgets  < 1
			else//is IN WIDGETS TABLE
			{
			//check the temp table - Wedetermined 1) is in links 2) is in widgets 
			// now we check temp if is in temp, registration is complete
			include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
			include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
			$sql = "DELETE FROM `temp_download_b4_wdgt_insert` WHERE `id` = $temp_id";
			$result2 = mysqli_query($connect, $sql);
                        echo '<h1>Success! Phase 1 - </h1>';
			echo '<h1>BungeeBones Server Configuration Complete</h1>';
		       }//close else //is IN WIDGETS TABLE
	echo '<h3 style="color:red;">Now, for the last step to get it to display properly, you need to login to <a target="_blank" href="'.$url.'/wp-admin"><u>your WP DASHBOARD </u></a>and configure the Affiliate Number settings. This is necessary for you to get credited properly too! </h3>
	<h2> YOUR BUNGEEBONES AFFILIATE NUMBER IS ... ';
	if(isset($new_user_affiliate_num)){
	echo $new_user_affiliate_num;
	}
	 elseif(isset($link_id)){
	 echo $link_id;
	}
	   echo'</h2>
	<h4> To configure it, click the "BungeeBones" button in the left menu of your Dashboard and add it to the form as the screenshot indicates.</h4>
	<img width="90%"src="http://Bungeebones.com/link_exchange/wp_errors/screenshot.png">
	<h3>For more information, login with your BungeeBones user credentials at the server site <a target=_blank" href="http://BungeeBones.com/members/index.php">BungeeBones.com</a> </h3>';
	}//close has link
	else//has NO LINK
	{ //check if in temp
	   $sql="select * from `temp_download_b4_wdgt_insert` where `url` like '%$url%'";
  		$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit members index 558");
  		$num_results_in_temp = mysqli_num_rows($result);
		  if( $num_results_in_temp >0) 
		   {
			//search the temp table for url - 
			//if there, we need to copy the info to widgets table
        		while ($row = mysqli_fetch_array($result)){
			$temp_id=$row['id'];		
			$new_email = $row['wp_user_email_registrant'];
			$BB_user_ID = $row['BB_user_ID'];
			$url2 = $row['url'];
			$title = $row['title'];
			$description = $row['description']; }

			//copy the info from temp into links/widgets and run tree rebuild
			include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
			include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
			$sql="INSERT INTO `links`(`BB_user_ID`, `category`,`url`, `name`, `description`, `approved`,  `freebie`, `start_date`, `nofollow`) VALUES ('$BB_user_ID','10033','$url','$title','$description','true','0','$now','on')";
			$result = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit no link id regular 557");
			if($result){$link_inserted="true";} 
			$link_id = mysqli_insert_id($connect);
			
				if($link_inserted=="true"){
				$date = new DateTime();
					$sql="INSERT into `widgets`(`link_id`, `parent`,`time_period`,`version`,`start_clone_date`,`end_clone_date`)VALUES ('$link_id','$wdgts_ID','8','$url','$date->getTimestamp()','0000-00-00 00:00:00')";
					$result2 = mysqli_query($connect, $sql) or die("Couldn't execute 'Edit no link id regular 558");
					    if($result2){$widget_inserted="true";}
						if($widget_inserted == "true"){ 
						$sql = "DELETE FROM `temp_download_b4_wdgt_insert` WHERE `id` = $temp_id";
						$result2 = mysqli_query($connect, $sql);
						include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/widget_mgr/widget_tree_mgmt_class.php");
						$parent=0;
						$lft=1;
						$rebuild = new widget_tree_mgmt;
						$rebuild->rebuildTree(1, 1);
						}//close if($widget_inserted == "true"
					}//close if($link_inserted=="true")
		}
		else //$num_results_in_temp  == 0) 
		{
		//is not in  links, nor temp - we have a rogue!
			echo '<h2>We have not detected your website\'s address in the BungeeBones database? In order for the script to work you need 1) A BungeeBones account and 2) To add your website information. </h2><h2>If you acquired your script through an affiliate please return to their web directory to register there so that they get proper credit. </h2>';
			echo '<h2>Otherwise, you can register at <a target="_blank" href="http://Bungeebones.com/members/index.php">Bungeebones.com</a></h2>';
			echo '<h2>Thank You!</h2>';
			exit();
		}
       }//close has no link
?>