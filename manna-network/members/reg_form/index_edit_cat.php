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
$var = explode("/", $_SERVER['PATH_INFO']);

$url_cat = $var[1] ;
if($url_cat==""){$url_cat=1;}
$link_id = $var[2] ;
 
 if (isset($link_id)){
$link_id= htmlspecialchars($link_id);
if (!preg_match('/^\d+$/', $link_id)) die("You have an improper link id. Please return to your <a href='../index.php'>user Control panel</a> ."); }
//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/reg_form/config.php"); //old yald, don't use db connects but use settings
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/reg_form/classes/mobile_class.php");  
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/db_cfg/connectloginmysqli.php");
include($_SERVER['DOCUMENT_ROOT']."/classes/regional_filters_class.php");
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/reg_form/classes/edit_link_class.php"); 

if(ISSET($_GET['B1'])){

}
else
{



$link_info = new edit;
$getarray = $link_info->getLinkInfo ($link_id, $url_cat);

//print_r($getarray);
//$sendarray = array($title ,$url ,$description,$street,$postal_code,$phone_number);
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_top_4login.php");

?>
<form name="form1" method="GET" action="http://bungeebones.com/bungee_jumpers/reg_form/index_edit.php"  onSubmit="return checkrequired(this)">
<div id="display"></div>
<?
  $link_data = new mobile;

if($url_cat !==''  && $url_cat !== '1'){
$mpath_data = new edit;
$path_data = new mobile;
		
		$nav = '<div align="center">';
		$nav .= '<a href="/bungee_jumpers/reg_form/index_edit_cat.php/1/'. $link_id.'"><font size="4">Top Level</font></a>';
		$nav .= $mpath_data->categoryPathforNav($url_cat, $regional_number, $url_cat, $link_id);
		//$search_nav =  searchPath($category);
		$categoryname = $path_data->getCatName($url_cat);
		$page_title = $categoryname;
		$nav .= $settings['nav_separator'].$categoryname;		
		$nav .= "</div>";
		//$searchQuery .= $path_data->searchengineQuery($category);
		//$categoryname = categoryName($url_cat);
		$page_title = $categoryname;
		$searchQuery .= $settings['se_separator'].$categoryname;
		$search_nav .= "+" . $categoryname;		
		} 
		else 
		{
		$category = '1';
  		 }


$catData = new mobile;
$catModify = new edit;

$cat_info = $catModify->listCategories($url_cat, $regional_number, $url_cat, $link_id);

//echo 'pop = ';
//$cat_subpop = $catData->sortRegionalifIsArray($regional_number);
//echo 'region number is ', $regional_number;
//echo '<br>cat sub pop is ', $cat_subpop;

If($url_cat==1){echo"<h1 style='color: red;'>Choose Your MAIN Category</h1>";
if(isset($_GET['cat_id_orig'])){
$cat_name_orig = $catModify->categoryPathDisplay($_GET['cat_id_orig']);
echo"<h3 style='color: red;'>Your Current (But From Here On Referred To As Your Original) Link Location Was/Is ";
echo $cat_id_orig;
echo '<p align="left">Your link is currently located in this path and category:<br>';
echo $cat_info;

echo '<p align="left">To relocate it to a different location select the desired categories. Be aware, however, that free links are displayed according to their seniority in their current category. Relocating your link will cause you loss of your current seniority and you will be at the bottom of your newly selected one';
}
}
elseif($cat_info =="false"){
$cat_name = $catData->getCatName($url_cat);
	echo "<h1>Step 1 - Completed</h1><h3>There Are No Sub-Categories Under The ". $cat_name ." Category.</h3><div style='font-size=150%'> Use the contact form and send in your suggestions if you believe some should be added. <br>Thanks<br>The admin.</div>";
$cat_name = $catData->categoryPathDisplay($url_cat);
echo"<p>&nbsp;</p><h3 style='color: red;'>Your Link Will Be Listed In The ". $cat_name . " Category</h3>";
echo $nav;
echo'<p>&nbsp;</p><p>&nbsp;</p>
<iframe id="buffer2" name="buffer2" src="http://bungeebones.com/bungee_jumpers/subscript_stats_dd.php?cat_id='. $url_cat . '& url= ' .  $url . '&folder_name= '. $folder_name .'&file_name= '. $file_name . '" width="500px" border="0" height="255"></iframe>';


}






else
{

echo '<p>&nbsp;</p><h3 style="color: red;">Select A Sub-Category</h3>';
$cat_name = $catData->categoryPathDisplay($url_cat);
$cat_name_orig = $catModify->categoryPathDisplay($url_cat);
echo"<h3 style='color: red;'>Your Link Is In The ". $cat_name . " Category</h3>

<p style='text-align: left;'>Listed below are the sub-categories. If you select one and submit the form your link will be moved there. If you want to move your link to an entirely different MAIN category then click the Top Level link in the Cookie Trail.</P>";
}
echo "
<p style='text-align: left;'>As categories get more links in them they automatically are \"paginated\" to display 20 links per page. Paid links will be displayed first (ranked by highest bids first). The free links (ordered by seniority) will be pushed on to lower pages. </p>


<p style='text-align: left;'>The numbers in parenthesis after each category in the list represent 1) the total link population in that category and 2) the link population in  all sub-categories of that category. If the first number is above 20 then \"someone\" is getting pushed to a lower page (including new free links).
<p>This pricing system insures fairness to the websites that submit their traffic to the system and still provide the highest quality product for the end user as possible by getting links entered into the most relevant category we have AT THE TIME (i.e the \"best\" category can change as the directory gets filled and more competitive). We also want to be able to always offer a place for a webmaster to enter a <b>free link</b> into the system. 
<p>The end result will be a combination of free pages and paid pages spread through the categories largely depending on webmaster supply and demand for determining the final price but still with the ability to say that --> \"There will always be a place for a free link in the directory\".

<p>&nbsp;</p><p>To find out the going market price of a category name/keyword use this <a target='_blank' href='https://adwords.google.com/o/Targeting/Explorer?__c=1000000000&__u=1000000000&ideaRequestType=KEYWORD_STATS#search.none'>Google PPC estimator tool</a> The opening price for one entire month in the directory in all categories equates to what just ONE click costs. Being the first to bid makes your link the TOP in the list (until someone outbids you) and for that small a price why not do that?";

echo $nav;
echo $cat_info;
echo '<table width="75%"><tr><td  colspan="2"><h3 style="color: black;">OR, Suggest your own sub-category!</h3></td></tr><tr><td>Suggested category #1<input type=text" name="suggest1"></input></td><td>Suggested category#2 (will be a sub-category of suggested category #1) <input type=text" name="suggest2" ></input></td></tr>
</table>';
echo '<h2>We take category placement seriously</h2>';

echo'<p>&nbsp;</p><p>&nbsp;</p><iframe id="buffer2" name="buffer2" src="http://bungeebones.com/bungee_jumpers/subscript_stats_dd.php?cat_id='. $url_cat . '& url= ' .  $url . '&folder_name= '. $folder_name .'&file_name= '. $file_name . '" width="500px" border="0" height="275"></iframe>';



echo '<input type="hidden" name="url_cat" value="'.$url_cat.'">';

echo '<input type="hidden" name="link_id" value="'.$link_id.'">';

?>
<script type="text/javascript">

function changeText2(){
var arrlength = arguments.length/3;
var arrlengthsc = arrlength+arrlength;
var c = "c";	
var sc = "sc";
for( var i = 0; i < arrlength; i++ ) {
document.getElementById(c+arguments[i]).innerHTML = arguments[arrlength+i];
if(arguments[arrlengthsc+i]){
document.getElementById(sc+arguments[i]).innerHTML = arguments[arrlengthsc+i];
}}}
</script>
<? 

echo '<div>';
		
	//	include('category_dropdown.php');
echo'</div></div>';
echo '<p>&nbsp;</p><p>&nbsp;</p><table bordercolor="black"cellpadding="3" width = "500" border="1"height="175"><tr><td><h1 >Your Link Category Peers At A Glance</h1></td></tr><tr><td> <div style="width:500px;height:150px;overflow:auto;">';
	$link_data = new mobile;
$link_info = $link_data->getLinks($url_cat, $regional_number);

$orig_link_id = $link_info[0];
$orig_link_BB_user_ID = $link_info[1];
$orig_link_category = $link_info[2];
$orig_link_url = $link_info[3];
$orig_link_name = $link_info[4];
$orig_link_description = $link_info[5];
$orig_link_street = $link_info[10];
$orig_link_zip = $link_info[11];
$orig_link_phone = $link_info[12];
$orig_link_invoice_sent = $link_info[13];
$orig_link_invoice_paid = $link_info[14];
$orig_link_freebie = $link_info[15];
$orig_link_display_freebies = $link_info[16];
$orig_link_start_date = $link_info[17];
$orig_link_time_period = $link_info[18];
$orig_link_peer_rating = $link_info[19];
$orig_link_peer_vote_count = $link_info[20];
$orig_link_public_rating = $link_info[21];
$orig_link_public_vote_count = $link_info[22];
$orig_link_click_tally = $link_info[29];

$num_links = count($orig_link_id);
echo 'num links = ', $num_links;
if($num_links < 1){

echo '<p style = "font-size: 300%; color: green; line-height:200%">Congratulations!!! <br>There are no competitor\'s links in your selected region and you have the entire category and region to yourself! (at least for a while) <br> We wish you a long and rewarding ad experience.</p>';
}
else
{

for($counterp=0; $counterp<$num_links; $counterp++){
$peer_rating = htmlentities(stripslashes($orig_link_peer_rating[$counterp]));

$peer_vote_count = htmlentities(stripslashes($orig_link_peer_vote_count[$counterp]));
$avg_public_rating = htmlentities(stripslashes($orig_link_public_rating[$counterp]));
$public_vote_count = htmlentities(stripslashes($orig_link_public_vote_count[$counterp]));



$url = htmlentities(stripslashes($orig_link_url[$counterp]));
 preg_match('@^(?:http://)?([^/]+)@i',"$url", $matches);
$host = $matches[1];
// get last two segments of host name
preg_match('/[^.]+\.[^.]+$/', $host, $matches);
$strpurl = $matches[0];
include('insert_ratings_pic.php');
				


echo'
<div>

<hr><span style="color : red;"> <a target=_"blank" href='.$orig_link_url[$counterp].'>' .$orig_link_name[$counterp].'</a></span><span style="color : green;"> &nbsp;&nbsp;   '.$orig_link_description[$counterp]  .'</span><span style="color : red;"><br />Peer Rating  ' .$PeerOverallpic .'</span><span style="color : red;">&nbsp;&nbsp;   Peer Vote Count  ' .$orig_link_peer_vote_count[$counterp].'</span></div>
				<div><span style="color : red;"> <a target="_blank" href="/reg_form/peer_review_form.php?url='.$strpurl.'&&selected_record='.$orig_link_id[$counterp].'&&cat_id='.$cat_id.'"></span><span style="font-size: 110%">Click Here To Place A "Peer Rank"  Vote For '. $orig_link_name[$counterp] . ' -</a></span></div> 


';
					}		

	echo  '</div></td></tr></table>';


//now we need to retrieve all the old information of this link in order to populate the form fields below with the information 

$link_info_array = $catModify->getLinkInfo ($link_id, $url_cat);

//array($title ,$url ,$description,$street,$postal code,$phone number);
$title = $link_info_array['0'];
$url = $link_info_array['1'];
$description = $link_info_array['2'];
$street = $link_info_array['3'];
$postal_code = $link_info_array['4'];
$phone_number = $link_info_array['5'];
//}



	
echo '<table width = "500" ><tr><td><p>&nbsp;</p><p>&nbsp;</p><div style="color: black; background-color: #ebebeb"><p>&nbsp;</p><h1 style="color: red";> Edit Your Link Info</h1>
<div><span style="font-size: 1.25em; color : black;  ">If you are at the best category for your site add the info (or otherwise please continue with category selections above)</span></div>
<table border="1" cellpadding="4" cellspacing="4" style="border-collapse: collapse" bordercolor="#FFFFFF"  id="AutoNumber1">
									<tr>
										<td width="14%" align="right"><b><font size="2">Homepage URL</font></b></td>
										<td>&nbsp;<b><font size="2">
										
										
									<input type="text" name="requiredurl" readonly value="'.$url.'" size="30"></font></b>
	<input type="hidden" name = "url_cat" value="'.$url_cat
.'"><input type="hidden" name = "cat_id_orig" value="';
if(isset($cat_id_orig)){
$cat_id_orig;
}
else
{
$url_cat;
}
echo '">
<input type= "hidden" name="link_id" value="'.$link_id.'"></td>	</tr>
<tr><td width="14%" align="right"><font size="2"><b>TITLE </b></font></td>
<td ><b><font size="2"><input type="text" name="requiredtitle" value="';

echo  $title;
echo '" size="40"></font></b></td>
						
					</tr>
					<tr>
						<td width="14%" align="right"><font size="2"><b>WEBSITE DESCRIPTION </b></font></td>
						<td><b><font size="2">&nbsp;&nbsp;Descriptions limited to max 255 characters.
									
							<textarea rows="4" name="requiredlink_description" cols="40">'.$description.'</textarea></font></b>
					
				</td>
			</tr>

			
								</table>
							
							<br />
								   
						   </td>
						   
			</tr>
		</table></div></td></tr></table>

<h1 style="color: navy; font-size: 1.25em;">If all you wanted to do was to edit your link then that concludes the process. Submit the form and your website will be reviewed again as soon as posible</h1>
<h1 style="color: navy; font-size: 1.25em;">Now If You Want To Get Your Very Own Web Directory - FREE! And Managed! And earning You Income Too!- Then There Are Just A Few More Form Inputs To Make To Get One For Your Website .... just return to your User Conrol Panel and there will be an "Add A Widget" button to the right of your new link. A two minute process will provide you the code for your fully operating web directory.</h1>
<input type="submit" value="Submit Link Info" name="B1">&nbsp;&nbsp;<input type="reset" value="Cancel" name="B2"></p>
<p>&nbsp;</p><p>OR</p>							
								
							
   <h3><a href="/bungee_jumpers/index.php">Return To Your User Control Panel</a></h3>
';

?>
</form>	
<?
}
?>
</div>
	<div id="ft">
	<div style="text-align: center"><a href="http://BungeeBones.com">HOME</a>  <a href="http://BungeeBones.com/articles">ARTICLES</a>  <a href="http://BungeeBones.com">FAQ </a>	 <a href="http://BungeeBones.com/feedback.php"> CONTACT US </a>  <a href="http://BungeeBones.com/bungee_jumpers/reg_form">REGISTER</a>  <a href="http://BungeeBones.com/bungee_jumpers/login.php">LOGIN</a></div>
                                                                                                                                                                                                                                                                                                                

<div style="text-align: center"><a href="http://BungeeBones.com/bungee_bones">OUR LINK EXCHANGE/DIRECTORY</a> <a href="http://BungeeBones.com/subscription_sites">EXAMPLE SITES</a> </div><a target="_blank" href="http://twitter.com/Bungeebones">BB TWITTER </a>
<div style="text-align: center">
    <a href="http://validator.w3.org/check?uri=referer"><img
        src="http://www.w3.org/Icons/valid-xhtml10-blue"
        alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a>
  </div>
  
</div>

</div>
</div>

<?
include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_explo_bot.php");
}//close if not isset B1
} else {
echo '<h1> the user is not logged in...</h1>';

    include($_SERVER['DOCUMENT_ROOT']."/members/views/not_logged_in.php");
}
