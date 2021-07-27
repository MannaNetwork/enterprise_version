<?php
/*
include($_SERVER['DOCUMENT_ROOT']."/classes/assignment_class.php");
//	id, sellers_link_id, sellers_widget_id, buyers_link_id, buyers_widget_id, trans_date, sellers_user_id, buyers_user_id

$assign_mng = new assignment;
$new_assign = $assign_mng->create_new_assign($sellers_link_id, $sellers_widget_id, $buyers_link_id, $buyers_widget_id, $sellers_user_id, $buyers_user_id);
$view_assign = $assign_mng->view_assign($sellers_link_id, $sellers_widget_id, $buyers_link_id, $buyers_widget_id, $sellers_user_id, $buyers_user_id);
$edit_assign = $assign_mng->edit_assign($sellers_link_id, $sellers_widget_id, $buyers_link_id, $buyers_widget_id, $sellers_user_id, $buyers_user_id);
$delete_assign = $assign_mng->delete_assign($sellers_link_id, $sellers_widget_id, $buyers_link_id, $buyers_widget_id, $sellers_user_id, $buyers_user_id);
*/
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
	<title>My Form</title>
</head>

<body>

		<p>Will need all or some of these IDs sellers_link_id, sellers_widget_id, buyers_link_id, buyers_widget_id, trans_date, sellers_user_id, buyers_user_id

<a href="generate_email_list.php">generate widget email addresses</a></br>
<a href="generate_wtm_list.php">generate list of WTM site URLs </a></br>
	<a href="create_assignment.php">create_new_assign</a></br>
<a href="view_assignment.php">view_assign</a></br>
<a href="edit_assignment.php">edit_assign</a></br>
<a href="delete_assignment.php">delete_assign</a></br>
	</p>				
	
</body>
</html>
