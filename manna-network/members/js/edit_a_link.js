<script>
 function select_main_category ( selected_category )
{
  document.main_category_form.category_id.value = selected_category ;
  document.main_category_form.submit() ;
}

function getSummaryReport(catid){
//if there is a catid then it came in from the category dropdown so set its myarr value to the catid session var
//if there isn't a cat id its because I sent in an empty value from the toggle report links
var myarr = catid.split(":");
//var catid = sessionStorage.getItem("catid");

 if (catid=="") {
window.alert("In getSummaryReport  catid is empty"+ myarr[1] + "    " + myarr[2]);
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
 return;
}
else
{
 return;
}
}		
}


function showSubLoc1(str) {
var myarr = str.split(":");

 if (str=="") {
    document.getElementById("locHint1").innerHTML="";
    return;
  }

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("locHint1").innerHTML=this.responseText;
 document.getElementById("locHint2").innerHTML=still_more_locs_cont;


    }
  }
document.getElementById("location_id").value = myarr[1];
document.getElementById("location_name").value = myarr[2];

  xmlhttp.open("GET","getsubloc1.php?q="+myarr[1],true);
  xmlhttp.send();
}



function showSubLoc2(str) {

var myarr = str.split(":");
 if (str=="") {
    document.getElementById("locHint2").innerHTML="";
    return;
  }

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari

    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {

    if (this.readyState==4 && this.status==200) {

      document.getElementById("locHint2").innerHTML=this.responseText;
 document.getElementById("locHint3").innerHTML=still_more_locs_coun;


    }
  }
document.getElementById("location_id").value =  myarr[1];
document.getElementById("location_name").value =  myarr[2];
  xmlhttp.open("GET","getsubloc2.php?q="+myarr[1],true);
  xmlhttp.send();
}


function showSubLoc3(str) {

var myarr = str.split(":");

 if (str=="") {
    document.getElementById("locHint3").innerHTML="";
    return;
  }

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari

    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {

    if (this.readyState==4 && this.status==200) {

      document.getElementById("locHint3").innerHTML=this.responseText;
 document.getElementById("locHint4").innerHTML=still_more_locs_stat;


    }
  }
document.getElementById("location_id").value = myarr[1];
document.getElementById("location_name").value =  myarr[2];
  xmlhttp.open("GET","getsubloc3.php?q="+myarr[1],true);
  xmlhttp.send();
}

function showSubLoc4(str) {
var myarr = str.split(":");

  if (str=="") {
    document.getElementById("txtHint3").innerHTML="";
   return;
  }

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint3").innerHTML=this.responseText;
    }
  }
   if (myarr[0]=="y") {
document.getElementById("location_id").value =  myarr[1];
document.getElementById("location_name").value =  myarr[2];
  xmlhttp.open("GET","getsubloc4.php?q="+str,true);
  xmlhttp.send();
  }else{
document.getElementById("location_id").value = myarr[1];
document.getElementById("location_name").value =  myarr[2];
document.getElementById("locHint4").innerHTML="";
 document.getElementById("locHint5").innerHTML=still_more_locs_city;
    return;
}
}

function showSubCat1(str) {
var myarr = str.split(":");

sessionStorage.setItem('catid', myarr[1]);
 if (str=="") {
    document.getElementById("txtHint1").innerHTML="";
    return;
  }


  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint1").innerHTML=this.responseText;
 document.getElementById("txtHint2").innerHTML=still_more_cats;

    }
  }
document.getElementById("category_id").value = myarr[1];
document.getElementById("category_name").value = myarr[2];
  xmlhttp.open("GET","getsubcat1.php?q="+myarr[1],true);
  xmlhttp.send();
}




function showSubCat2(str) {
var myarr = str.split(":");
  if (str=="") {
    document.getElementById("txtHint2").innerHTML="";
    return;
  }

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint2").innerHTML=this.responseText;
 document.getElementById("txtHint3").innerHTML=still_more_cats;
    }
  }
  if (myarr[0]=="y") {
document.getElementById("category_name").value = myarr[2];
document.getElementById("category_id").value = myarr[1];
  xmlhttp.open("GET","getsubcat2.php?q="+myarr[1],true);
  xmlhttp.send();
  }else{

document.getElementById("category_name").value = myarr[2];
document.getElementById("category_id").value = myarr[1];
 document.getElementById("txtHint2").innerHTML="No More Subs";
 document.getElementById("txtHint3").innerHTML="";
    xmlhttp.send();
}
}
function showSubCat3(str) {
var myarr = str.split(":");
  if (str=="") {
    document.getElementById("txtHint3").innerHTML="";
    return;
  }

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint3").innerHTML=this.responseText;
 document.getElementById("txtHint4").innerHTML=still_more_cats;
    }
  }
   if (myarr[0]=="y") {
document.getElementById("category_name").value = myarr[2];
document.getElementById("category_id").value = myarr[1];
  xmlhttp.open("GET","getsubcat3.php?q="+myarr[1],true);
  xmlhttp.send();
  }else{
document.getElementById("category_name").value = myarr[2];
document.getElementById("category_id").value = myarr[1];
document.getElementById("txtHint3").innerHTML=no_more_subs;
}
}

function showSubCat4(str) {
var myarr = str.split(":");

 if (str=="") {
    document.getElementById("txtHint3").innerHTML="";
   return;
  }

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint3").innerHTML=this.responseText;
    }
  }
   if (myarr[0]=="y") {
document.getElementById("category_name").value = myarr[2];
document.getElementById("category_id").value = myarr[1];
  xmlhttp.open("GET","getsubcat4.php?q="+myarr[1],true);
  xmlhttp.send();
  }else{
document.getElementById("category_name").value = myarr[2];
document.getElementById("category_id").value = myarr[1];
document.getElementById("txtHint4").innerHTML=no_more_subs;
  
}
}
</script>
