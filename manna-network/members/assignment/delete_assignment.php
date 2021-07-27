<?php


if($_POST['formSubmit'] == "Submit")
{

	$errorMessage = "";
if(empty($_POST['sellers_link_id']))
	{
		$errorMessage .= "<li>You forgot to enter a sellers_link_id!</li>";
	} 
if(empty($_POST['sellers_widget_id']))
	{
		$errorMessage .= "<li>You forgot to enter a sellers_widget_id!</li>";
	} 
if(empty($_POST['buyers_link_id']))
	{
		$errorMessage .= "<li>You forgot to enter a buyers_link_id!</li>";
	} 
if(empty($_POST['buyers_widget_id']))
	{
		$errorMessage .= "<li>You forgot to enter a buyers_widget_id!</li>";
	} 
if(empty($_POST['sellers_user_id']))
	{
		$errorMessage .= "<li>You forgot to enter a sellers_user_id!</li>";
	}
if(empty($_POST['buyers_user_id']))
	{
		$errorMessage .= "<li>You forgot to enter a buyers_user_id!</li>";
	}	

$sellers_link_id = $_POST['sellers_link_id']; 
$sellers_widget_id = $_POST['sellers_widget_id'];
$buyers_link_id = $_POST['buyers_link_id'];
$buyers_widget_id = $_POST['buyers_widget_id'];
$sellers_user_id = $_POST['sellers_user_id'];
$buyers_user_id = $_POST['buyers_user_id'];


	if(empty($errorMessage)) 
	{
			include($_SERVER['DOCUMENT_ROOT']."/classes/assignment_class.php");
//	id, sellers_link_id, sellers_widget_id, buyers_link_id, buyers_widget_id, trans_date, sellers_user_id, buyers_user_id

$assign_mng = new assignment;
$new_assign = $assign_mng->create_new_assign($sellers_link_id, $sellers_widget_id, $buyers_link_id, $buyers_widget_id, $sellers_user_id, $buyers_user_id);
$view_assign = $assign_mng->view_assign($sellers_link_id, $sellers_widget_id, $buyers_link_id, $buyers_widget_id, $sellers_user_id, $buyers_user_id);
$edit_assign = $assign_mng->edit_assign($sellers_link_id, $sellers_widget_id, $buyers_link_id, $buyers_widget_id, $sellers_user_id, $buyers_user_id);
$delete_assign = $assign_mng->delete_assign($sellers_link_id, $sellers_widget_id, $buyers_link_id, $buyers_widget_id, $sellers_user_id, $buyers_user_id);

		exit;
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
	<title>Commission Assignment Form</title>
</head>

<body>
<h1>Commission Assignment Form</h1>
<p style="text-align: left;">Use this form to assign both the income derived from the current subscribers of a site, the subscribers of its DOWNLINE and also any FUTURE sales or recruits of itself or its downline.
	<?php
		if(!empty($errorMessage)) 
		{
			echo("<p>There was an error with your form:</p>\n");
			echo("<ul>" . $errorMessage . "</ul>\n");
		} 
	?>
	<form action="assignment.php" method="post">
		<p>
			$sellers_link_id<input type="text" name="sellers_link_id" maxlength="50" value="<?=$sellers_link_id;?>" />
		</p>
		<p>
						$sellers_widget_id<input type="text" name="sellers_widget_id" maxlength="50" value="<?=$sellers_widget_id;?>" /><br>
			</p>	
			<p>
$buyers_link_id<input type="text" name="buyers_link_id" maxlength="50" value="<?=$buyers_link_id;?>" />
		</p>
		<p>
$buyers_widget_id<input type="text" name="buyers_widget_id" maxlength="50" value="<?=$buyers_widget_id;?>" /><br>
		</p>
			<p>
$sellers_user_id<input type="text" name="sellers_user_id" maxlength="50" value="<?=$sellers_user_id;?>" />
		</p>
		<p>
$buyers_user_id	<input type="text" name="buyers_user_id" maxlength="50" value="<?=$buyers_user_id;?>" /><br>
		</p>			
		<input type="submit" name="formSubmit" value="Submit" />
	</form>
</body>
</html>

