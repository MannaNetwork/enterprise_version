<?

include($_SERVER['DOCUMENT_ROOT']."/mobile/classes/mobile_class.php"); 
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/cp_demo/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/cp_demo/connect.php");

$data=$_GET['data'];

$val=$_GET['val'];
$cat_id=$_GET['cat_id'];
$affiliate_num=$_GET['affiliate_num'];
$mysql['username'] = 'bungeebo_dbuser1'; // mysql username
	$mysql['password'] = 'Y1e2s3h4u5a6'; // mysql password
	$mysql['db'] = 'bungeebo_peerreviewdirectory'; // mysql database name
	$mysql['host'] = 'localhost'; // mysql hostname (usually localhost)



mysql_connect($mysql['host'],$mysql['username'],$mysql['password']);
mysql_select_db($mysql['db']);

 if ($data=='main_cat') {  // first dropdown
 
  echo '<input type="hidden" name="main_cat_data" value="<?echo $val;?>">';
   echo "<select name='main_cat' onChange=\"dochangecat('sub_cat1', this.value)\">\n";
  echo "<option value='0'>HYPER D</option>\n";
$query = "SELECT * FROM `categories` WHERE parent = 1 order by`name`";
 $result = mysql_query($query);
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
   while(list($id, $name)=mysql_fetch_array($result)){
       echo "<option value=\"$id\" >$name</option> \n" ;
  }



} else if ($data=='sub_cat2') { // third dropdown

   echo "<select name='sub_cat2' onChange=\"dochangecat('sub_cat3', this.value)\">\n";
 
  echo "<option value='0'>Choose SubCat2</option>\n";                   
  	$query = "SELECT * FROM `categories` WHERE parent=$val ORDER BY name";
         	$result = mysql_query($query);

	while(list($id, $name)=mysql_fetch_array($result)){
       echo "<option value=\"$id\" >$name</option> \n" ;
  }


} else if ($data=='sub_cat3') { // fourth dropdown
 // echo "<select name='cities' >\n";
	  echo "<select name='sub_cat3' onChange=\"dochangecat('sub_cat4', this.value)\">\n";

  echo "<option value='0'>Choose SubCat3</option>\n";  
	                 
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
  }
	}
echo "</select>\n";

  If($val>0){
$catName = new mobile;

$cat_name = $catName->getCatName($val);
 echo "<br><a href='http://bungeebones.com/mobile/index.php/".$val."'><font size='1'>GET ".$cat_name . "</font></a>";

}elseif($data=="sub_cat4"){
echo'make link do its stuff';
}
    
?>
