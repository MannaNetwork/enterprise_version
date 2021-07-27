<?php 

if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
require_once('../libraries/password_compatibility_library.php');
}
require_once('../config/config.php');
require_once('../lang/en.php');
require_once('../libraries/PHPMailer.php');
require_once('../classes/Login.php');
$login = new Login();

if ($login->isUserLoggedIn() == true) {    
$user_id = $_SESSION['user_id'];
$phpself = basename(__FILE__);
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
include($_SERVER['DOCUMENT_ROOT']."/classes/ajax_dd_class.php");
$AJAXinfo = new ajax_info;


if(isset($_POST['C1'])){
//The message var acts as a switch when sent to the functions calling them to make the transaction instead of reporting it. It then have all the functions on this page make a $message var instead of echos and then forward it in the header url for printing on the success page as a record
//echo '<br> in index, echoing POST and looking for buyer type';
//print_r($_POST);
 $today = date('F j, Y, g:i a');
echo 'Today in C1 = ', $today;
}
elseif(isset($_POST['B1'])){
//The message var acts as a switch when sent to the functions calling them to make the transaction instead of reporting it. It then have all the functions on this page make a $message var instead of echos and then forward it in the header url for printing on the success page as a record
//echo '<br> in index, echoing POST and looking for buyer type';
//print_r($_POST);
 $today = date('F j, Y, g:i a');
echo 'Today in B1 = ', $today;
}
else
{

?>
<html>
<head>
<title>Country State City Dropdown Using Ajax</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/css/reset.css" />
<link rel="stylesheet" href="/css/text.css" />
<link rel="stylesheet" href="/css/960.css" />
<link rel="stylesheet" href="/css/demo.css" />
<link rel="stylesheet" type="text/css" href="/css/ddcolortabs.css" />
<link rel="stylesheet" type="text/css" href="/css/custom.css" />
<link rel="stylesheet" type="text/css" href="/customize_btn.css" />
<!--<link rel="stylesheet" href="css/responsive.css">--> 
	<link rel='stylesheet' href="/css/camera.css">
 <!--[if lt IE 9]>
		<script src="/js/html5.js"></script>
		<script src="/js/css3-mediaqueries.js"></script>
	<![endif]-->
<script type="text/javascript" src="/js/dropdowntabs.js">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="jquery.chained.min.js"></script>
<script language="javascript" type="text/javascript">
function getXMLHTTP() { //function to return the xml http object
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
		
		var strURL="findCountryWithCurl.php?continent="+continentId;
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
function submitform()
{
    document.forms["ajax_dd_form"].submit();
}	
function getContinentURL(continentId) {		
		
		var strURL="findCountryURL.php?continent="+continentId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
					/*	document.getElementById('countrydivURL').innerHTML=req.responseText;*/
		document.getElementById('continentdivURL').innerHTML= '<td width="45"><a href="javascript: submitform()">Submit</a></td>';

					
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
function deleteContinentURL(continentId) {		
		
		var strURL="findCountryURL.php?continent="+continentId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
					/*	document.getElementById('countrydivURL').innerHTML=req.responseText;*/
		document.getElementById('continentdivURL').innerHTML= '<td width="45">&nbsp;</td>';

					
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}

function getCountryURL(continentId) {		
		
		var strURL="findCountryURL.php?continent="+continentId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
					document.getElementById('countrydivURL').innerHTML= '<td width="45"><a href="javascript: submitform()">Submit</a></td>';				
                                    
					 } else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
function deleteCountryURL(continentId) {		
		
		var strURL="findCountryURL.php?continent="+continentId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
		document.getElementById('countrydivURL').innerHTML= '<td width="45">&nbsp;</td>';

					
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
		
		var strURL="findStateWithCurl.php?country="+countryId;
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
function getStateURL(continentId) {		
		
		var strURL="findCountryURL.php?continent="+continentId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
					document.getElementById('statedivURL').innerHTML= '<td width="45"><a href="javascript: submitform()">Submit</a></td>';				
                                    
					 } else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
function deleteStateURL(continentId) {		
		
		var strURL="findCountryURL.php?continent="+continentId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
					/*	document.getElementById('countrydivURL').innerHTML=req.responseText;*/
		document.getElementById('statedivURL').innerHTML= '<td width="45">&nbsp;</td>';

					
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
		var strURL="findCityWithCurl.php?state="+stateId;
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

function getCityURL(continentId) {		
		
		var strURL="findCountryURL.php?continent="+continentId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
					document.getElementById('citydivURL').innerHTML= '<td width="45"><a href="javascript: submitform()">Submit</a></td>';				
                                    
					 } else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
function deleteCityURL(continentId) {		
		
		var strURL="findCountryURL.php?continent="+continentId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
					/*	document.getElementById('countrydivURL').innerHTML=req.responseText;*/
		document.getElementById('citydivURL').innerHTML= '<td width="45">&nbsp;</td>';

					
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

<!-- this next tag is supposed to make this load into the parent even as an iframe-->
<base target="_parent" /> 
</head>
<body onload="ajax_dd_form.reset()";>
<?
include($_SERVER['DOCUMENT_ROOT']."/960top_regform.php");
include($_SERVER['DOCUMENT_ROOT']."/members/user_cpanel_submenu.php");
?>
<form id= "ajax_dd_form" method="post" action="http://bungeebones.com/members/ajaxchained_dd/form.php" name="ajax_dd_form">

<input type="hidden" name = "link_id" value="<?echo $_GET[link_id];?>">
<center>

    <div id='tutorialHead'>
         <div class="tutorialTitle"><b>Country State City Dropdown SEO Enhancement</b>
  </div>
</div>
<?php

$continent_arrays_children = $AJAXinfo->getChildrenByParentsId("1");
//returns multidim array including each child and each child's id, name
$continent_id = $continent_arrays_children[0];//array of children id nums
$continent_name = $continent_arrays_children[1];//array of children names
?>
<table width="45%"  cellspacing="0" cellpadding="0">
  <tr>
    <td width="45">Continent</td>
     <td width="5">:</td>

    <td  width="150"><select name="continent" onChange="getCountry(this.value), getContinentURL(this.value), deleteStateURL(this.value), deleteCountryURL(this.value), deleteCityURL(this.value)">
	<option value="" selected>Select Continent</option>
	<?php foreach($continent_name as $key=>$value){ ?>
	<option value="<?php echo $continent_id[$key]?>"><?php echo $continent_name[$key]?></option>
	<?php } ?>
	</select></td><td id="continentdivURL" width="45">&nbsp;</td>
  </tr>
 <tr style="">
    <td>Country</td>
    <td width="5">:</td>
    <td ><div id="countrydiv"><select name="country" >
	<option>Select Country</option>
        </select></div></td><td id="countrydivURL" width="45">&nbsp;</td>
  </tr>
  <tr style="">
    <td>State</td>
    <td width="5">:</td>
    <td ><div id="statediv"><select name="state" >
	<option>Select State</option>
        </select></div></td><td id="statedivURL" width="45">&nbsp;</td>
  </tr>
  <tr style="">
    <td>City</td>
    <td width="5">:</td>
    <td ><div id="citydiv"><select name="city">
	<option>Select City</option>
        </select></div></td><td id="citydivURL" width="45">&nbsp;</td>
  </tr>
  
</table>
</center>
</form>

<?
include($_SERVER['DOCUMENT_ROOT']."/960bottom.php");
}//close B1
} else {
    // the user is not logged in...
    include("views/not_logged_in.php");
}
?>
