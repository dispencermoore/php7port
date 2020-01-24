<!DOCTYPE html>
<html lang="en">
<head>

  <?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); ?>
  <title>Unauthorized</title>

</head>
  
<body>

  <?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/nav.php'); ?>

<div id="index" class="span7">
	<div id="resourceinfo">
		<h3>
          Sorry, you do not have access to that page.<br>
          Please <b>Sign In</b> with an account that is authorized to view that page.
		</h3>
	</div>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>

</body>
</html>

<?php ob_flush() ?>
