<!DOCTYPE html>
<html lang="en">
<head>
	 <link rel="icon" 
  href="https://images.squarespace-cdn.com/content/v1/53cede1ae4b0de9f6e919b11/1410360829591-Z3M3PPXSBIHN1110ZIAL/ke17ZwdGBToddI8pDm48kMpagLdZPgiW6yD5i4KsS9VZw-zPPgdn4jUwVcJE1ZvWhcwhEtWJXoshNdA9f1qD7UnCxNA8dHvmd7460Z7fbKFSZnIIAPuX1C4iUTyn4Xd4-76gsgk4xgxAaWTBSRHt9w/favicon.ico" /> 

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
