<? 
if (isset($_GET['action']) && $_GET['action'] == "log_out") {
	//$test_page_protect->log_out(); // the method to log off
echo '<h1>in Logout - Session Destroy</h1>';
session_start();
session_destroy();
}
// include the configs
require_once($_SERVER['DOCUMENT_ROOT']."/members/config/config.php");

    
// load the login class

// load php-login components
require_once($_SERVER['DOCUMENT_ROOT']."/members/php-login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

 
    
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...


$user_id = $_SESSION['user_id'];
$thisuser_id = $user_id;
require('config.php');
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
//include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connect.php");
//new db connection
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");

function categoryPatharr($catid){
	global $settings;
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
//include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connect.php");
//new db connection
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");


	$path = '';
	$query = 'SELECT `lft`,`rgt` FROM `categories` WHERE `id`="'.mysqli_escape_string($catid).'"';
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);
	$lft = $row['lft'];
	$rgt = $row['rgt'];
	$query = 'SELECT `name`,`id` FROM `categories` WHERE `lft` < '.$lft.' AND `rgt` > '.$rgt.' ORDER BY `lft` ASC;';
	$result = mysqli_query($connect, $query);
	while($row = @mysqli_fetch_array($result)){
	if($row['id'] != '1')
$row_name[] =  $row['name'];
	$patharr[] .= $row['name'];
		$countresult = count($row_name);
	}
$patharr[]=$countresult;
	return $patharr;
}
$selected_record = $_GET['selected_record'];
$amm=25;
$ad_count = 1;
//>>>>>>>>>>>>>>>>>>> begin pagebrowser function
$file=str_replace($_SERVER['SERVER_NAME'], "", $_SERVER['PHP_SELF']);
$var=explode("/", $file);
$url_page = $var[1] ;
$cat_1=$var[3] ;
$trip_num=$var[4] ;
$Sign_Up_Date = date('M-d-Y', mktime(0, 0, 0, date('m'),  date('d'),  date('Y')));
$Expire_Date = date('M-d-Y', mktime(0, 0, 0, date('m'),  date('d')+7,  date('Y')));
$B1 = $_POST['B1'];

$OvRt = $_POST['OvRt'];
$Titl = $_POST['Titl'];
$Desc_ad = $_POST['Desc_ad'];


$affiliate_num = $_GET['anum'];
$cat_id = $_GET['cat_id'];

IF(isset ($B1)){
	



$query = "SELECT * FROM `peer_site_ratings` WHERE  `link_id` = '$selected_record' ";
		
$result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_array($result)){
	
	$recorded_user_id = $row['user_ID'];

			if($thisuser_id == $recorded_user_id){
			
			$isold_reviewer = 'yes';
			}


}
?>
<br><BR><?

?><BR><?
IF($isold_reviewer !== 'yes'){
$query = "INSERT into peer_site_ratings (`user_ID`,`link_id`,`cat_ID` ,`OvRt`,`Titl`,`Desc_ad`) values ('$user_id','$selected_record', '$cat_id','$OvRt','$Titl','$Desc_ad' )";

$result = mysqli_query($connect, $query) or die("Couldnt execute 'update' query ".$query); 
//$query2 = "update review_directory Set rev_status = 'complete' WHERE ID=$selected_record";
//$result = mysqli_query($query2, $conn)or die("Couldn't execute 'update' query ".$query2); 
echo "Thank you for taking the time to review one of the BungeeBones listings. Your review isn't tallied immediately and won't show in the display yet (to save server resources) but it will show up the next time the totals are updated. Your website review has been saved, however, and is greatly appreciated! Thank you again.
<h2>Just Close This Window To Return To The Link Registration Form </h2>
 ";
?>
<br><BR><BR><?
}else{

Echo "You have already rated this site. Close this window to return to the form to select other sites to review.";
?>
<br><BR><BR><?
}


exit();
}//end if  
else
{
	
$sql = "SELECT * FROM  `links` WHERE id != '$selected_record' ";

$result = @mysqli_query($connect, $sql)or die("Couldn't execute 'Edit 3 Account' query");
$totalrows = mysqli_num_rows($result);
?>
<h1>Here Is The Selected Website For Your Review </h1><?
If($totalrows< 1)
{?><div align="center">
<table border="0" cellspacing="1" width="100%">
  <tr>
   <td width="100%">
    <p align="center">There are no un-reviewed sites in your peer group.
		</td>
   </tr>
   <tr>
     <td width="100%">
     
      </td>
    </tr>
    <tr>
      <td width="100%">
       
      </td>
     </tr>
    </table>
</div>
<? exit; 
 }
$numLimit = 4 ; 
$numpage=ceil($totalrows/$amm);
$count = 1;
$amm = 25;
$queryStr = "/$search_value/$search_column/$srtdata/$continent/$country/$state/$city/$category/$site_ID/$header_ID/$ad_ID/$Forsaleorwanted ";
$queryStr2 = "$begin/$num/$numBegin/$search_value/$search_column/$srtdata/$continent/$country/$state/$city/$category/$site_ID/$header_ID/$ad_ID/$Forsaleorwanted";
If(isset ($selected_record)){
$sql = "SELECT * FROM links WHERE id = '$selected_record' ";
 $result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 3 Account' query");
while ($row = mysqli_fetch_array($result)) 
{
$record_ID = $row['id'];
$id = $id.",";   
		$cat_num[1]=$row['category'];
					$website_url=$row['url'];
					$record_ID=$row['id'];						
				$title=$row['name'];
				$description=$row['description'];
	}//end while

	
	$category=$cat_num[1];

include($_SERVER['DOCUMENT_ROOT']."/members/reg_form/classes/mobile_class.php");  
$catData = new mobile;


		$nav = '<a href="'.$_SERVER['PHP_SELF'].'">Top</a>';
		$nav2 = $catData->getCatName($category);
			$categoryname = $catData->getCatName($_GET['suggest']);
		$page_title = $categoryname;
		$nav .= $settings['nav_separator'].$categoryname;
	
	///////////////////////////////////////////////////////
		
         	foreach( $cat_num as $key => $value)
          	{
          	If($key=='1'){
		$sql = "SELECT * FROM `categories` WHERE id = '$value'";
		$result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 3 Account' query");
                      while ($row = mysqli_fetch_array($result)) 
                      {
                       $cat_name[$key]=$row['name'];
											  }//end while
								}//end if
						else{
					  		$sql = "SELECT * FROM `cat_2_3` WHERE ID = '$value'";
            $result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 3 Account' query");
                      while ($row = mysqli_fetch_array($result)) 
                      {
                       $cat_name[$key]=$row['cat_2_3_name'];
							          }//end while
											 }//end else
          				 }//end foreach
							}//end if			 
else{
 $sql = "SELECT * FROM  `links` WHERE category = '$cat_1'";
         $result = @mysqli_query($connect, $sql) or die("Couldn't execute 'Edit 3 Account' query");
          while ($row = mysqli_fetch_array($result)) 
          {
          $record_ID = $row['id'];
          $id = $id.",";   
          $dwnln_revws_req = $row['dwnln_revws_req'];    
          	 		$cat_num[1]=$row['category'];
             			$cat_num[2]=$row['cat_2'];
          					$cat_num[3]=$row['cat_3'];
          				$cat_num[4]=$row['cat_4'];
          				
          					$website_url=$row['url'];
          					$record_ID=$row['id'];						
          				$title=$row['name'];
          				$description=$row['description'];
                $actual_page = ceil($count/$amm);
                      $display_block{$actual_page} = $display_block{$actual_page}."<tr>";
                      $display_block{$actual_page} = $display_block{$actual_page}."<td width='25%' ALIGN='CENTER'><font FACE='Arial' SIZE='2'> <a target='_blank' href='$website_url'>$website_url </a></font></td>";
                      $display_block{$actual_page} = $display_block{$actual_page}."<TD><a href='/members/reviewer_display.php?selected_record=$record_ID'>Populate Review Form With Details</a>></TD>";
                      $display_block{$actual_page} = $display_block{$actual_page}."</tr>";
                      }//end while
//display block 2 is beginning of table
 $display_block2 = $display_block2 . "<table border='1' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber20'> ";
  $display_block2 = $display_block2 . "<tr>";
 $display_block2 = $display_block2 . "<td>";
$display_block2 = $display_block2 . "<p align='center'>";


$display_block3 = $display_block3 . "</select>";
$display_block3 = $display_block3 . "<tr>";
$display_block3 = $display_block3 . "<td>";
$display_block3 = $display_block3 . "<p align='center'>";
$display_block3 = $display_block3 . "</p>";
$display_block3 = $display_block3 . "</td>";
$display_block3 = $display_block3 . "</tr> ";
$display_block3 = $display_block3 . "</table>";


$display_block_complete = $display_block_complete . $display_block2;
$display_block_complete = $display_block_complete . $display_block{1};
$display_block_complete = $display_block_complete . $display_block3;
} //end else
?><BR><BR>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled</title>
<style>.label { FONT-SIZE: 10pt; FONT-FAMILY: verdana; TEXT-DECORATION: none }
	A { COLOR: blue }
		</style>
		<LINK HREF="/styles/style.css" type="TEXT/CSS" rel="STYLESHEET">
</head>
<body>
		
<form action="<?echo $php_self;?>" method="post">
<input type="hidden" name="user_ID" value="2,," />
	<input type="hidden" name="directory_ID" value="" />
<input type="hidden" name="selected_record" value="<?echo $selected_record;?>" />
			<div style="PADDING-TOP: 0px; width:842; height:1155" align="center">
				<table id="table1" cellPadding="2" width="600" border="0" height="1107">
					 <tr>
                       <td valign="top" class="label" style="WIDTH: 96" align="right">&nbsp;</td>
						<td align="left" width="522" height="36">
                        The category, title and description the website owner submitted are displayed below. Please help us maintain the quality of the BungeeBones directory by reviewing and rating those items.                       
												 Select the proper rating so as to reflect the quality and relevance of those terms as they relate to the 
                        actual content in the website. The rating is NOT meant to endorse their product or service (just that the site has information about the stated category  title and description). Thank you! </td>
						<td align="left" width="294">&nbsp;</td>
					</tr>
                    <tr>
                      <td valign="top" class="label" style="WIDTH: 96" align="right">
                      <strong>The site's category</strong></td>
						<td align="left" width="522" height="36">
                          <input type="text" name="read_only" size="27" value="<?echo $cat_name[1];?>"><br>
                          Is the category the site is in relevant to the website's content?</p>
                                          </td>
						<td align="left" width="294">Category Relevancy Rating<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
                          <tr><td width="20%" bordercolor="#FFFFFF">low</td>
                            <td width="20%" bordercolor="#FFFFFF">&nbsp;</td>
                            <td width="20%" bordercolor="#FFFFFF">&nbsp;</td>
                            <td width="20%" bordercolor="#FFFFFF">&nbsp;</td>
                            <td width="20%" bordercolor="#FFFFFF">high</td>
                          </tr><tr><td width="20%" align="center" bordercolor="#FFFFFF">
                        <input type="radio" value="1" name="OvRt"> </td>
                            <td width="20%" align="center" bordercolor="#FFFFFF">
                        <input type="radio" value="2" name="OvRt"> </td>
                            <td width="20%" align="center" bordercolor="#FFFFFF">
                        <input type="radio" value="3" checked name="OvRt"> </td>
                            <td width="20%" align="center" bordercolor="#FFFFFF">
                        <input type="radio" value="4" name="OvRt"> </td>
                            <td width="20%" align="center" bordercolor="#FFFFFF">
                        <input type="radio" value="5" name="OvRt"> </td>
                          </tr>
                        </table>
</td>
					</tr>
                    <tr>
                      <td valign="top" class="label" style="WIDTH: 96" align="right"><strong><span id="lblTitle">Title</span></strong></td>
						<td align="left" width="522" height="36">
                        <input type="text" name="read_only" size="20" value="<?echo $title;?>"><br>
                        How well does the site's title reflect the site's theme?</td>
						<td align="left" width="294">Title Relevancy Rating<br>
                        <input type="radio" value="1" name="Titl">
                        <input type="radio" value="2" name="Titl">
                        <input type="radio" value="3" checked name="Titl">
                        <input type="radio" value="4" name="Titl">
                        <input type="radio" value="5" name="Titl"></td>
					</tr><tr>
						<td class="label" style="WIDTH: 96" vAlign="top" align="right">
                        <b>Description</b> <td align="left" width="522" height="36">
							<textarea rows="2" name="read_only" cols="60"><?echo $description;?></textarea><br>
                            How well does the site's description reflect the theme?</td>
						<td align="left" width="294" valign="top">Description Relevancy Rating<br>
                        <input type="radio" value="1" name="Desc_ad">
                        <input type="radio" value="2" name="Desc_ad">
                        <input type="radio" value="3" name="Desc_ad" checked>
                        <input type="radio" value="4" name="Desc_ad">
                        <input type="radio" value="5" name="Desc_ad"></td>
					
											 
									
						
</tr>
                     <tr>
						<td class="label" style="WIDTH: 96" vAlign="top" align="right" colspan="3">
                        <input type="submit" value="Submit Review Form" name="B1"></td>
</tr>
</table>
</form>

<br><br>
<?

}

} else {
    // the user is not logged in...

    include("../views/not_logged_in.php");
}

//include("../includes/mini_templatebottom1.php"); ?> 
