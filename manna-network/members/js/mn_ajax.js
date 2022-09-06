<script>
function showSubMenu(str, currentLevel,cat_id,type) 
{
/*
Process description:
1) Query remote server, receive JSON string of next menu items
2) Create the next html menu from the data - store as variable "output"
3) Add the next holder for the next menu to ouput var - name it with # currentlevel + 1
4) Replace the div created by previous menu with the new code (note the name of the replaced div will be the same as the current level number)

*/
var myarr = str.split(":");
/*window.alert('myarr[0] = '+myarr[0]);
window.alert('selected catid myarr[1] = '+myarr[1]);
window.alert('selected cat name myarr[2] = '+myarr[2]);
*/
var nextLevel= parseFloat(currentLevel) + 1;
if(type=="regions"){
var currentBlockNameStr= 'locHint'+(parseFloat(currentLevel));
var nextBlockNameStr= 'locHint'+(parseFloat(currentLevel) + 1);
}
else
{
var currentBlockNameStr= 'catHint'+(parseFloat(currentLevel));
var nextBlockNameStr= 'catHint'+(parseFloat(currentLevel) + 1);
}

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
var data = this.responseText;


var combo_list = JSON.parse(data);
/* Am leaving these window alerts because the comparison operator (if =) gave me so much trouble.

window.alert('combo_list just before if not = '+combo_list);
window.alert('typeof combo_list before if = '+ typeof(combo_list));
window.alert('JSON.stringify( just before if not = '+JSON.stringify(combo_list));
var nosubs='"NO MORE SUB CATEGORIES"';
window.alert('nosubs with added quotes = '+nosubs);
window.alert('typeof( nosubs with added quotes = '+typeof(nosubs));
var noregs= '"Sorry, No More Regional Filters Found."'
//if(nosubs !== JSON.stringify(combo_list) || noregs !== JSON.stringify(combo_list)){ 
if(typeof(combo_list)!=='string'){
window.alert('testing if(combo_list != "NO MORE SUB CATEGORIES" || combo_list != "Sorry, No More Regional Filters Found.") - wasn\'t found and entered test area');
window.alert('typeof combo_list in test if = '+ typeof(combo_list));
window.alert('combo_list = ' +combo_list);  

} */
if(typeof(combo_list)!=='string'){
//window.alert('CL is not a string');
//}
//if(combo_list !== "NO MORE SUB CATEGORIES" || combo_list !== "Sorry, No More Regional Filters Found."){
//NO MORE SUB CATEGORIES

var output = '<select name="';
	if(type=="regions"){
	output += 'selected_region_id" onchange="showSubMenu(this.value,\''+nextLevel+'\',\''+myarr[1]+'\',\''+type+'\')">';
	output += '<option value="">' + wording_ajax_regional_menu1 + '</option>';
	}
	else
	{
	output += 'selected_cat_id" onchange="showSubMenu(this.value,\''+nextLevel+'\',\''+myarr[1]+'\',\''+type+'\')">';
	output += '<option value="">' + wording_ajax_menu1 + '</option>';
	}
 
	for ( j = 0; j < combo_list.length; j++) {
		if ( '' !== combo_list[j].name ) {
			if ( combo_list[j].lft + 1 < combo_list[j].rgt ) {
			//y or n tells the AJAX functions whether there are any more subcategories
				output += "<option value='y:" + combo_list[j].id + ':' + combo_list[j].name + "'>" + combo_list[j].name + '</option>';
			} else {
				output += "<option value='n:" + combo_list[j].id + ':' + combo_list[j].name + "'>" + combo_list[j].name + '</option>';
				}
			}
		}
	if(type=="regions"){
	output += '<input type="hidden" id="location_name" name="location_name" class ="location_name" value="">';
	output += '<input type="hidden" id="location_id" name="location_id" class ="location_id" value="'+myarr[1]+'"></select>';
	//window.alert('before get element- currentBlockNameStr = '+currentBlockNameStr+'and output = '+output);
	      document.getElementById(currentBlockNameStr).innerHTML=output+'<div class="'+nextBlockNameStr+'" id="'+nextBlockNameStr+'" name="'+nextBlockNameStr+'" >'+still_more_cats_reg+'</div>';
	      document.getElementById("selected_region_menu_name").value = myarr[2];
	      document.getElementById("location_name").value = myarr[2];
	document.getElementById("selected_region_name").value = myarr[2];
	document.getElementById("selected_region_id").value = myarr[1];
	}
	else
	{
	//selected_cat_menu_name
	output += '<input type="hidden" id="cat_name" name="cat_name" class ="cat_name" value="">';
	output += '<input type="hidden" id="cat_id" name="cat_id" class ="cat_id" value="'+myarr[1]+'"></select>';
	    document.getElementById(currentBlockNameStr).innerHTML=output+'<div class="'+nextBlockNameStr+'" id="'+nextBlockNameStr+'" name="'+nextBlockNameStr+'" >'+still_more_cats+'</div>';
	//window.alert('before document.getElementById("selected_cat_menu_name").value = (myarr[2]) = '+myarr[2]);

	   document.getElementById("selected_cat_menu_name").value = myarr[2];
	document.getElementById("selected_cat_name").value = myarr[2];
	//window.alert('cat_id line 93 = '+cat_id);
	//window.alert('before doc get elbyid (before in was string) selected_cat_id asmyarr[1]= '+myarr[1]);
	document.getElementById("selected_cat_id").value = myarr[1]; 
	}
}
else//if(combo_list == "NO MORE SUB CATEGORIES" || combo_list == "Sorry, No More Regional Filters Found.")
{
// window.alert('found "Sorry, No More Regional Filters Found" from data ='+data);

 document.getElementById(currentBlockNameStr).innerHTML=combo_list+'<div class="'+nextBlockNameStr+'" id="'+nextBlockNameStr+'" name="'+nextBlockNameStr+'" style="background-color: yellow;"></div>';
	 if(type=="regions"){
	 document.getElementById("selected_region_id").value = myarr[1];
	  document.getElementById("selected_region_menu_name").value = myarr[2];
	 document.getElementById("city_street_address").innerHTML="<span>Your street address (optional)<input type='text' name='city_street_address' value='' />       Link To Map (optional)<input type='text' name='map_link' value='' /></span>";
	 }
	 else
	 {
	 //window.alert('cat_id line 48 = '+cat_id);
//window.alert('selected_cat_id in else (was not a string) as myarr[1]= before document.getElementById("selected_cat_id"'+myarr[1]);
	 document.getElementById("selected_cat_id").value = myarr[1]; 
	 document.getElementById("selected_cat_menu_name").value = myarr[2];
	}
}   
    
    ///////
 }
  }
//document.getElementById("tregional_num").value = myarr[1];
//document.getElementById("regional_name").value = myarr[2];
if(type=="regions"){
  xmlhttp.open("GET","getsubloc1.php?tregional_num="+myarr[1]+"&type=regions");
}
else
{
xmlhttp.open("GET","getsubloc1.php?q="+myarr[1]+"&type=categories");
}
  xmlhttp.send();
}



function getAdDisplayPage(catid, pageid,mn_agent_url,mn_agent_folder){
 if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
 } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
var data = this.responseText;
var ads = JSON.parse(data);
 var output = "<h1>Results</h1>";
for ( j = 0; j < ads.length; j++) {
output += "<tr class='mn_ads'><td id='mn_url'>><a target='_blank' href='http://" + ads[j].url + "'>"+ads[j].name + "</a></td></tr><tr  class='mn_ads'><td id=]mn_description'> " +ads[j].description + ")</td></tr>";
}
  document.getElementById("mn_results_table").innerHTML=output;
  }
 }
xmlhttp.open("GET","/wp-content/plugins/manna-network/incl_links_ajax_crl.php?catid="+catid+"&pageid="+pageid+"&mn_agent_url="+mn_agent_url+"&mn_agent_folder="+ mn_agent_folder,true);
  xmlhttp.send();
}

function updatelinks(str) {
str = '<caption>More Results Pages</caption><tbody>' + str + '</tbody></table>';
window.alert("str = " +str);
document.getElementById("mn_results_table").innerHTML = str;
} 

function updatecategoryButton ( current_category){
var mycatarr = current_category.split(":");
var mycaturl = document.getElementById("goLink").innerHTML;
var myregurl = document.getElementById("filterLink").innerHTML;
	 if(mycaturl.indexOf("&") > 0 || mycaturl.indexOf("&") > 0 ){
	    var origcaturl = mycaturl.split("&");
var leftside = origcaturl[0];
var rightside = origcaturl[1];
		//we need to find which side of the & that the q (or category) var is on
		if(leftside.indexOf("q=") > -1){
		var insertcaturl = '<a href="?q=' + mycatarr[1] + '&' + rightside;
		
document.getElementById("goLink").innerHTML=insertcaturl;
document.getElementById("filterLink").innerHTML=insertcaturl;
		}
		else if(rightside.indexOf("q=") > -1){ 
		var insertcaturl = leftside + '&q=' + mycatarr[1] + '"><h1>GO</h1></a>';
		document.getElementById("goLink").innerHTML=insertcaturl;
document.getElementById("filterLink").innerHTML=insertcaturl;
		}

	}
	else if(mycaturl.indexOf("?") > 0 ){
	var wholecaturl = mycaturl.split("?");
	var insertcaturl = '<a href="?q=' + mycatarr[1] + '"><h1>GO</h1></a>';
	document.getElementById("goLink").innerHTML=insertcaturl; 
	}
	else
	{
	if(myregurl.indexOf("?") > 0 ){
		
		//we already retrieved the filter url with var myregurl = document.getElementById("filterLink").innerHTML;	
		var origregurl = myregurl.split('"><h1>');
		var leftside = origregurl[0];
		var rightside = origregurl[1];
		
		//we KNOW the regional_num var is on the left side
		var insertcaturl = leftside + '&q=' + mycatarr[1] + '"><h1>GO</h1></a>';
		//window.alert("In updateURLButton  the REGIONAL NUM = was detected on the LEFT side Q INSERTED ON RIGHT SIDE OF new insertcaturl = " + insertcaturl);
		document.getElementById("goLink").innerHTML=insertcaturl;
		document.getElementById("filterLink").innerHTML=insertcaturl;
		}
		else
		{		
			var checkForFilters = document.getElementById("filterLink").innerHTML;
			if(checkForFilters.indexOf("href") > 0){
			//we need to add regional_num to the url
			var afterQMFilterLink = checkForFilters.split("=");
			var TempFilterLink = afterQMFilterLink[1].split('"><h1>');
			var insertcaturl = '<a href="?q=' + mycatarr[1] + 'regional_num='+TempFilterLink[0] +'"><h1>GO</h1></a>';
			} 
			else
			{
			var insertcaturl = '<a href="?q=' + mycatarr[1] + '"><h1>GO</h1></a>';
			document.getElementById("goLink").innerHTML=insertcaturl; 
			}
		}
	}//close else
}

function updateregionalButton (current_regional_num){
var myregarr = current_regional_num.split(":");
var myregurl = document.getElementById("filterLink").innerHTML;
var mycaturl = document.getElementById("goLink").innerHTML;

	 if(myregurl.indexOf("&") > 0 || myregurl.indexOf("&") > 0 ){
	    var origregurl = myregurl.split("&");
		var leftside = origregurl[0];
 		var rightside = origregurl[1];
		
		//we need to find which side of the & that the q (or category) var is on
		if(leftside.indexOf("regional_num=") > -1){
		
		var insertregurl = '<a href="?regional_num=' + myregarr[1] + '&' + rightside;
		
document.getElementById("goLink").innerHTML=insertregurl;
document.getElementById("filterLink").innerHTML=insertregurl;
		}
		else if(rightside.indexOf("regional_num=") > -1){ 
		var insertregurl = leftside + 'regional_num=' + myregarr[1] + '"><h1>GO</h1></a>';
		
document.getElementById("goLink").innerHTML=insertregurl;
document.getElementById("filterLink").innerHTML=insertregurl;
		}  
	}
	else if(myregurl.indexOf("?") > 0 ){
var wholeregurl = myregurl.split("?");
	var insertregurl = '<a href="?regional_num=' + myregarr[1] + '"><h1>GO</h1></a>';
	document.getElementById("filterLink").innerHTML=insertregurl; 

	}
	else
	{
//there is no link yet here but there may be one at the other dropdown
		if(mycaturl.indexOf("?") > 0 ){
	//we already retrieved the filter url with var mycaturl = document.getElementById("goLink").innerHTML;	
		var origcaturl = mycaturl.split('"><h1>');
		var leftside = origcaturl[0];
		var rightside = origcaturl[1];
		//we KNOW the cat id var is on the left side
		var insertregurl = leftside + 'regional_num=' + myregarr[1] + '"><h1>GO</h1></a>';
		document.getElementById("goLink").innerHTML=insertregurl;
		document.getElementById("filterLink").innerHTML=insertregurl;
		}
		else //we are free to create and insert a link from scratch
		{		
		
			var insertregurl = '<a href="?regional_num=' + myregarr[1] + '"><h1>GO</h1></a>';
			document.getElementById("filterLink").innerHTML=insertregurl; 
			
		}
	}//close else
}




 function select_main_category ( selected_category )
{
  document.main_category_form.category_id.value = selected_category ;
  document.main_category_form.submit() ;
}

 function select_page ( selected_page )
{
  document.paginator_form.page_number.value = selected_page ;
  document.paginator_form.submit() ;
}

function getSummaryReport(catid){
//if there is a catid then it came in from the category dropdown so set its myarr value to the catid session var
//if there isn't a cat id its because I sent in an empty value from the toggle report links
var myarr = catid.split(":");
//var catid = sessionStorage.getItem("catid");

 if (catid=="") {
    document.getElementById("summary").innerHTML="";
    return;
  }


var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
document.getElementById("summary_header").value = wording_ajax_summary_header;
      document.getElementById("summary").innerHTML=this.responseText;
    }
  }

document.getElementById("summary_header").value = wording_ajax_summary_header;
document.getElementById("summary").value = myarr[1];
  xmlhttp.open("GET","getsummaryreport.php?q="+myarr[1],true);
  xmlhttp.send();

}

function getLocationReport(catid, regionalid){
//if there is a catid then it came in from the category dropdown so set its myarr value to the catid session var
//if there isn't a cat id its because I sent in an empty value from the toggle report links
var myarr = catid.split(":");

 if (catid=="") {
    document.getElementById("summary2").innerHTML="";
    return;
  }
}


function deleteAllLevels(form_num) {		
if(form_num == 2){
document.getElementById("location_id").value = '';
document.getElementById("location_name").value = '';
document.getElementById('locHint1').innerHTML= '';
document.getElementById('locHint2').innerHTML= '';
document.getElementById('locHint3').innerHTML= '';
document.getElementById('locHint4').innerHTML= '';
document.getElementById('summary').innerHTML= '';
document.getElementById('expanded').innerHTML= '';
document.getElementById('filterLink').innerHTML= '';
document.getElementById('goLink').innerHTML= '';
 return;
}
else
{
if(form_num == 1){

document.getElementById('category_id').value = '';
document.getElementById('category_name').value = '';
document.getElementById('txtHint1').innerHTML= '';
document.getElementById('txtHint2').innerHTML= '';
document.getElementById('txtHint3').innerHTML= '';
document.getElementById('txtHint4').innerHTML= '';
document.getElementById('summary').innerHTML= '';
document.getElementById('expanded').innerHTML= '';
document.getElementById('filterLink').innerHTML= '';
document.getElementById('goLink').innerHTML= '';
 return;
}
else
{
 return;
}
}		
}
//
//This is old function - renamed to showsubmenu (above)


function loadDoc() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("demo").innerHTML =
            this.responseText;
       }
    };
  xmlhttp.open("GET","/wp-content/plugins/manna-network/ajax_info.txt", true);
    xhttp.send();
}




</script>
