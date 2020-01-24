<!DOCTYPE html>
<html lang="en">
<head>

  <?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); ?>
  <?php include ($_SERVER['DOCUMENT_ROOT'].'/services/admin-required.php'); ?>


  <title>Open AIR Admin</title>
</head>
  
<body>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/nav.php'); ?>


<div class="container">
  <div class="row">
	<h2>Welcome Admin</h2>
	<div class="row-fluid">
		<a class="span6" href="/index.php">Click here for active entries</a><br>
		<a class="span6" href="/pending.php">Click here for pending entries</a>
	</div>
  </div>
</div>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>

</body>
</html>

<?php ob_flush() ?>
