<?php
if(!isAdmin()) {
  redirect("/not-authorized.php");
}
?>
