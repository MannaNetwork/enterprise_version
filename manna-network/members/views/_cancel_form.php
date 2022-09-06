<?php
echo '<form method="post" action="'. htmlspecialchars(dirname( __FILE__, 2 )."/".AGENT_FOLDERNAME."/manna-network/members/cancelSuspend.php").'">  
  <input type="hidden" name="agent_ID" value="'.$agent_ID.'">
  <input type="hidden" name="remote_lnk_id" value="'.$link_info[0].'">';

  if (array_key_exists ( "isTemp" , $_GET ) AND isset($_GET["isTemp"])) {
echo '<input type="hidden" name="isTemp" value=1> ';
}
echo '
  <br><br>
  <input type="submit" name="submit" value="Confirm Cancellation">  
</form>

</body>
</html>';
?>
