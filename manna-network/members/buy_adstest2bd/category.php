<?

include($_SERVER['DOCUMENT_ROOT']."/mobile/classes/mobile_class.php"); 
//   include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/cp_demo/change_link_cat_class.php");  
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/cp_demo/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/cp_demo/connect.php");
//include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/cp_demo/incl_mail_trans_func.php");
//include_once('../../bungee_jumpers/PHPMailer_v2.0.0/class.phpmailer.php');
//include('auction/connect.php');

//
$data=$_GET['data'];

$val=$_GET['val'];
$cat_id=$_GET['cat_id'];
$affiliate_num=$_GET['affiliate_num'];
 
//$mysql['username'] = 'bungeebo_demo'; // mysql username
	//$mysql['password'] = 'demo'; // mysql password
	//$mysql['db'] = 'bungeebo_demo'; // mysql database name
	//$mysql['host'] = 'localhost'; // mysql hostname (usually localhost)


$mysql['username'] = 'bungeebo_dbuser1'; // mysql username
	$mysql['password'] = 'Y1e2s3h4u5a6'; // mysql password
	$mysql['db'] = 'bungeebo_peerreviewdirectory'; // mysql database name
	$mysql['host'] = 'localhost'; // mysql hostname (usually localhost)




//mysql_pconnect($dbhost,$dbuser,$dbpass) or die ("Unable to connect to MySQL server");
mysql_connect($mysql['host'],$mysql['username'],$mysql['password']);
mysql_select_db($mysql['db']);
//if ($data=='states') {  // first dropdown


 if ($data=='main_cat') {  // first dropdown
 
  echo '<input type="hidden" name="main_cat_data" value="<?echo $val;?>">';
 
  echo "<select name='main_cat' onChange=\"dochangecat('sub_cat1', this.value)\">\n";
  echo "<option value='0'>HYPER D</option>\n";
$query = "SELECT * FROM `categories` WHERE parent = 1 order by`name`";
  
		        	$result = mysql_query($query);
            
 // $result=mysql_db_query($dbname,"select `id`, `name` from categories_regional2 order by `name` WHERE lft > 169 and rgt < 183");
  while(list($id, $name)=mysql_fetch_array($result)){
    if($id==$cat_id){
   echo "<option selected value=\"$id\" >$name</option> \n" ;
	}
else
{
 echo "<option value=\"$id\" >$name</option> \n" ;
}		
  }
	 
	}
//add states
elseif ($data=='sub_cat1') {  // second dropdown
echo '<input type="hidden" name="sub_cat1_data" value="<?echo $val;?>">';



  echo "<select name='sub_cat1' onChange=\"dochangecat('sub_cat2', this.value)\">\n";
  echo "<option value='0'>Choose SubCat1</option>\n";
$query = "SELECT * FROM `categories` WHERE parent=$val ORDER BY name";
  
		        	$result = mysql_query($query);
            
 // $result=mysql_db_query($dbname,"select `id`, `name` from categories_regional2 order by `name` WHERE lft > 169 and rgt < 183");
  while(list($id, $name)=mysql_fetch_array($result)){
       echo "<option value=\"$id\" >$name</option> \n" ;
  }



} else if ($data=='sub_cat2') { // third dropdown

   echo "<select name='sub_cat2' onChange=\"dochangecat('sub_cat3', this.value)\">\n";
 
  echo "<option value='0'>Choose SubCat2</option>\n";                   
  //$result=mysql_db_query($dbname,"SELECT `id`, `city` FROM cities WHERE `state_id` = '$val' ORDER BY `city` ");
  
	$query = "SELECT * FROM `categories` WHERE parent=$val ORDER BY name";
  
		        	$result = mysql_query($query);

	while(list($id, $name)=mysql_fetch_array($result)){
       echo "<option value=\"$id\" >$name</option> \n" ;
  }


} else if ($data=='sub_cat3') { // fourth dropdown
 // echo "<select name='cities' >\n";
	  echo "<select name='sub_cat3' onChange=\"dochangecat('sub_cat4', this.value)\">\n";

  echo "<option value='0'>Choose SubCat3</option>\n";  
	                 
  //$result=mysql_db_query($dbname,"SELECT `id`, `city` FROM cities WHERE `state_id` = '$val' ORDER BY `city` ");
  
	$query = "SELECT * FROM `categories` WHERE parent=$val ORDER BY name";
  
		        	$result = mysql_query($query);

	while(list($id, $name)=mysql_fetch_array($result)){
       echo "<option value=\"$id\" >$name</option> \n" ;
  }

	 
	
}else if ($data=='sub_cat4') { // display link
  echo "display link";
	   
	$query = "SELECT * FROM `categories` WHERE parent=$val ORDER BY name";
  
		        	$result = mysql_query($query);

	while(list($id, $name)=mysql_fetch_array($result)){
       //echo "<option value=\"$id\" >$name</option> \n" ;
  }
	}
echo "</select>\n";

  If($val>0){
$catName = new mobile;

$cat_name = $catName->getCatName($val);
 echo "<br><a href='http://bungeebones.com/mobile/index.php/".$val."'><font size='1'>GET ".$cat_name . "</font></a>";


//get all cats with same name as top level cat
//$sub_cat1_name = $link_data->getCatName($val);
//$sub_cat1_same_cat_name_array = $link_data->getSameCatName($sub_cat1_name);//returns the ids

//for each, get its path
//display, with a radio button, which will place the link in that category also
//foreach($sub_cat1_same_cat_name_array as $key => $value){
//echo '<br>key = ', $key;
//echo '<br>value = ', $value;
//$path[] = $link_data->make_Cat_path_links($value);
//echo $link_data->make_Cat_path_links($value); 
// echo "<br>", $link_data->cookie_Trail($value);


//}
//$path = $link_data->make_Cat_path_links($value);




}elseif($data=="sub_cat4"){
echo'make link do its stuff';
}
    
?>
