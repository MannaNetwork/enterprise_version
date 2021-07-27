<?php 
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/agent_cfg.php");
if(!defined('WRITER_AGENTS')){ 
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".WRITER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");


//echo '<br>in insert_price_slots_subscript_table.php<br>';
 // id | user_id | link_id | price_slot_amnt | subscribe | coin_type | cat_id | t_timestamp         | start_date | agents_ID |
$id = explode(",",$_POST['id']);
$customer_id = explode(",",$_POST['user_id']);
 $link_id = explode(",",$_POST['link_id']);
 $price_slot_amnt = explode(",",$_POST['price_slot_amnt']); 
$subscribe = explode(",",$_POST['subscribe']); 
$coin_type  = explode(",",$_POST['coin_type']); 
$cat_id  = explode(",",$_POST['cat_id']); 
$t_timestamp  = explode(",",$_POST['t_timestamp']); 
$start_date  = explode(",",$_POST['start_date']); 
$agents_ID  = explode(",",$_POST['agents_ID']);

	if(count($customer_id)>1){
		foreach($customer_id as $key => $value){
		echo '<br>$id => ', $key;
		echo '     $value  = ', $value;
		echo '<br>$price_slot_amnt = ', $price_slot_amnt[$key];

		//$sql = "update links set price_slot = ". $value . " where id = ".$link_id_array[$key];
		$sql = "update links set price_slot = ". $price_slot_amnt[$key] . ", coin_type = '".$coin_type[$key]   ."' where customer_id = ".$value." AND start_date = '". $start_date[$key]."' ";
		echo '<br> sql = ', $sql;
		$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
		}
	}
	else
	{
	$sql = "update links set price_slot = ". $price_slot_amnt . ", coin_type = '".$coin_type   ."' where customer_id = ".$value." AND start_date = '". $start_date."'";
	echo '<br> sql = ', $sql; 
	$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
	}
	if (mysqli_affected_rows($mysqli) > 0) {
	echo 'Success';
	// now either update the agents price slots subscripts table or insert a new row in it

	$sql= "select * FROM price_slots_subscripts WHERE `user_id` = $value AND `link_id` = $link_id[$key];";
	$result = mysqli_query($mysqli, $sql);
		 if (mysqli_num_rows($result)<1){  
		$query = "INSERT INTO `price_slots_subscripts` (`id`,  `user_id`,  `link_id`, `price_slot_amnt`, `subscribe`, `coin_type`, `cat_id`, `t_timestamp`, `start_date`, `agents_ID`)values('$id[$key]',  '$user_id[$key]',  '$link_id[$key]', '$price_slot_amnt[$key]', '$subscribe[$key]', '$coin_type[$key]', '$cat_id[$key]', '$t_timestamp[$key]', '$start_date[$key]', '$agents_ID[$key]') "; 
		 echo 'query = ', $query;
		$result = mysqli_query($mysqli, $query);
		} 
		else
		{  
		$query = "UPDATE `price_slots_subscripts` SET
		`id` = $id[$key],  
		`user_id` = $user_id[$key],  
		`link_id` = $link_id[$key], 
		`price_slot_amnt` = $price_slot_amnt[$key], 
		`subscribe` = $subscribe[$key], 
		`coin_type` = $coin_type[$key], 
		`cat_id` = $cat_id[$key], 
		`t_timestamp` = $t_timestamp[$key], 
		`start_date` = $start_date[$key], 
		`agents_ID` = $agents_ID[$key]
		WHERE `user_id` = $user_id[$key] AND `link_id` = $link_id[$key] AND `agents_ID` = $agents_ID[$key];
		 "; 
		 echo 'query = ', $query;
		$result = mysqli_query($mysqli, $query);
		}
	}
?>


