<?php 
include($_SERVER['DOCUMENT_ROOT']."/classes/ajax_dd_class.php");
$AJAXinfo = new ajax_info;
/*
function $region_array_single = $AJAXinfo->getRegionById($region_id){
//returns array($name, $parent,$lft,$rgt);
function $region_arrays_children = $AJAXinfo->getChildrenByParentsId($parent_level_id, $lft, $rgt)
//returns multidim array including each child and each child's id, name
*/
?>
<html>
<head>
<title>Country State City Dropdown Using Ajax</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" type="text/javascript">
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
function getCountry(continentId) {		
		
		var strURL="findCountry.php?continent="+continentId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('countrydiv').innerHTML=req.responseText;
						document.getElementById('statediv').innerHTML='<select name="state">'+
						'<option>Select State</option>'+
				        '</select>';						
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}	

function getState(countryId) {		
		
		var strURL="findState.php?country="+countryId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('statediv').innerHTML=req.responseText;
						document.getElementById('citydiv').innerHTML='<select name="city">'+
						'<option>Select City</option>'+
				        '</select>';						
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	function getCity(stateId) {		
		var strURL="findCity.php?state="+stateId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('citydiv').innerHTML=req.responseText;						
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
</script>

<style type="text/css">
body {font-family: Arial, "Trebuchet MS";font-size: 17px;color: #52B6EB; }
a{font-weight: bold;letter-spacing: -1px;color: #52B6EB;text-decoration:none;}
a:hover{color: #99A607;text-decoration:underline;}
#top{width:43%;margin-top: 25px; height:60px; border:1px solid #BBBBBB; padding:10px;}
#tutorialHead{width:43%;margin-top: 12px; height:30px; border:1px solid #BBBBBB; padding:11px;}
.tutorialTitle{width:95%;float:left;color:#99A607}
.tutorialTitle  a{float:right;margin-left:20px;}
.tutorialLink{float:right;}
table
{
margin-top:70px;
border: 1px solid #BBBBBB;
padding:25px;
height: 35px;
}
</style>
</head>
<body>
<form method="post" action="" name="form1">
<center>

    <div id='tutorialHead'>
         <div class="tutorialTitle"><b>Country State City Dropdown Using Ajax</b>
          <a href="http://php-dev-zone.com/2013/10/country-state-city-dropdown-using-ajax.html" title="Country State City Dropdown Using Ajax">Tutorial Link</a>
    </div>
</div>
<?php
//get the continent array (world ID = 1, for reference, N America is - 2568, United States is 2732
//no lft, rgt vars for first query
$continent_arrays_children = $AJAXinfo->getChildrenByParentsId("1", 0, 0);
//returns multidim array including each child and each child's id, name
$continent_id = $continent_arrays_children[0];//array of children id nums
$continent_name = $continent_arrays_children[1];//array of children names
?>
<table width="45%"  cellspacing="0" cellpadding="0">
  <tr>
    <td width="75">Continent</td>
     <td width="50">:</td>
    <td  width="150"><select name="continent" onChange="getCountry(this.value)">
	<option value="">Select Continent</option>
	<?php foreach($continent_name as $key=>$value){ ?>
	<option value="<?php echo $continent_id[$key]?>"><?php echo $continent_name[$key]?></option>
	<?php } ?>
	</select></td>
  </tr>
 <tr style="">
    <td>Country</td>
    <td width="50">:</td>
    <td ><div id="countrydiv"><select name="country" >
	<option>Select Country</option>
        </select></div></td>
  </tr>
  <tr style="">
    <td>State</td>
    <td width="50">:</td>
    <td ><div id="statediv"><select name="state" >
	<option>Select State</option>
        </select></div></td>
  </tr>
  <tr style="">
    <td>City</td>
    <td width="50">:</td>
    <td ><div id="citydiv"><select name="city">
	<option>Select City</option>
        </select></div></td>
  </tr>
  
</table>
</center>
</form>
</body>
</html>
