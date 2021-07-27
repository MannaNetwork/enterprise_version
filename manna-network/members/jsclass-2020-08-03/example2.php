<?php
require("class.js.php");
?><!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Subscription</title>

<!--
  The JS class configured with the member $tocopy = 0 or instancied with the second
  parameter to 0 was required by the page to be instantiated with reading of the
  subscription.ini file to generate the javascript script in the page.

  Types of date formats :
  0 : D/M/Y = verified, ok
  1 : D.M.Y = verified, ok
  2 : D/M-y = verified, ok
  3 : M-D-y = verified, ok
  4 : Y-M-D = verified, ok
  5 : Y.M.D = verified, ok
  6 : d.m.Y = verified, ok
  7 : YMD   = verified, ok
  Type of hour formats :
  HH:MN:SS  = verified, ok
  HH:MN     = verifief, ok
// -->

<?php $script = new js("subscription",0); ?>

<style type="text/css">
h1  { font-family:times; font-size:20pt; font-style:italic; color:#000080; }
.c1 { padding-left:6px; padding-right:6px; vertical-align:top; border:1px solid grey; text-align:center; background-color:#000080; color:#FFFFFF; }
.c2 { padding-left:6px; padding-right:6px; vertical-align:top; border:1px solid grey; border-left:0px; text-align:center; background-color:#000080; color:#FFFFFF; }
.c3 { padding-left:6px; padding-right:6px; padding-top:2px; padding-bottom:2px; vertical-align:top; border:1px solid grey; border-top: 0px; text-align:right; }
.c4 { padding-left:6px; padding-right:6px; padding-top:2px; padding-bottom:2px; vertical-align:top; border:1px solid grey; border-left:0px; border-top: 0px; }
.c5 { padding-left:6px; padding-right:6px; border:1px solid grey; text-align:center; background-color:#909090; color:#000000; font-style:italic; }
.c6 { padding-left:6px; padding-right:6px; border:1px solid grey; border-left:0px; text-align:center; background-color:#D0D0D0; color:#000090; font-style:italic; }
</style>
</head>

<body>
<h1>Sports club registration</h1>

<p>The JS Class included in the page has generated the javascript</p>

<form mathod="post" name="subscription" action="javascript:alert('All is OK. Form sent !')" onsubmit="return verif()">
<table border="0" cellpadding="0" cellspacing="0">
<tr>
  <td class="c1">Label</td>
  <td class="c2">Value</td>
  <td class="c5">html</td>
  <td class="c5">JS class</td>
</tr><tr>
  <td class="c3">Last name</td>
  <td class="c4"><input type="text" name="lname" size="25"></td>
  <td class="c6">text</td>
  <td class="c6">text</td>
</tr><tr>
  <td class="c3">First name</td>
  <td class="c4"><input type="text" name="fname" size="25"></td>
  <td class="c6">text</td>
  <td class="c6">text</td>
</tr><tr>
  <td class="c3">Sex</td>
  <td class="c4"><input type="radio" name="sex" value="M">Male<br/><input type="radio" name="sex" value="M">Female</td>
  <td class="c6">radio</td>
  <td class="c6">radio</td>
</tr><tr>
  <td class="c3">Birthday</td>
  <td class="c4"><input type="text" name="bday" size="10"> (<?php $script->fmtdate(); ?>)</td>
  <td class="c6">text</td>
  <td class="c6">date</td>
</tr><tr>
  <td class="c3">eMail Address</td>
  <td class="c4"><input type="text" name="email" size="55"></td>
  <td class="c6">text</td>
  <td class="c6">mail</td>
</tr><tr>
  <td class="c3">Phone number</td>
  <td class="c4"><input type="text" name="phone" size="12"></td>
  <td class="c6">text</td>
  <td class="c6">text</td>
</tr><tr>
  <td class="c3">Level of studies</td>
  <td class="c4">
    <input type="radio" name="studies" value="0">Primary school<br/>
    <input type="radio" name="studies" value="0">High scool<br/>
    <input type="radio" name="studies" value="0">University
  </td>
  <td class="c6">radio</td>
  <td class="c6">radio</td>
</tr><tr>
  <td class="c3">Sports</td>
  <td class="c4">
    <input type="checkbox" name="athl" value="at">Athletism<br/>
    <input type="checkbox" name="volley" value="vo">Volley ball<br/>
    <input type="checkbox" name="foot" value="fo">Football<br/>
    <input type="checkbox" name="swim" value="s">Swimming<br/>
    <input type="checkbox" name="none" value="no">None<br/>
  </td>
  <td class="c6">checkbox</td>
  <td class="c6">checkbox</td>
</tr><tr>
  <td class="c3">Contribution</td>
  <td class="c4"><input type="text" name="cont" size="10"> &nbsp; ($100 < contrib. < $500)</td>
  <td class="c6">text</td>
  <td class="c6">num</td>
</tr><tr>
  <td class="c3">Role</td>
  <td class="c4">
    <select name="idrol">
      <option value="null">--- Choose a role</option>
      <option value="pl">Player</option>
      <option value="ar">Arbitrator</option>
      <option value="ma">Manager</option>
      <option value="co">Coach</option>
    </select>
  </td>
  <td class="c6">select</td>
  <td class="c6">list</td>
</tr><tr>
  <td class="c3">Beginning date</td>
  <td class="c4"><input type="text" name="begdate" size="10"> (<?php $script->fmtdate(); ?>)</td>
  <td class="c6">text</td>
  <td class="c6">date</td>
</tr><tr>
  <td class="c3">Prefered hour</td>
  <td class="c4"><input type="text" name="prefh" size="5"> (<?php $script->fmthour(); ?>)</td>
  <td class="c6">text</td>
  <td class="c6">hour</td>
</tr><tr>
  <td class="c3">Observations</td>
  <td class="c4"><textarea rows="5" cols="50" name="obs"></textarea></td>
  <td class="c6">textarea</td>
  <td class="c6">text</td>
</tr><tr>
  <td class="c3">Validation</td>
  <td class="c4" style="background-color:#80FFFF; color:red"><input type="checkbox" name="ok" value="ok"> I have read the rules, I accept the conditions</td>
  <td class="c6">checkbox</td>
  <td class="c6">valid</td>
</tr>
</table>
<input type="submit" name="submit" value="Submit">
</form>
<pre>

<!-- ------------------ Verifications : form.ini, JS Class's arrays ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<?php
require("subscription.ini");
echo "\n\n";
$script->debug();
?>
</pre>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>

</html>