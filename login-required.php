<?php
if(!isLoggedIn()) {
  redirect("/not-authorized.php");
}
?>
