<?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Resource</title>
 <link rel="icon" 
  href="https://images.squarespace-cdn.com/content/v1/53cede1ae4b0de9f6e919b11/1410360829591-Z3M3PPXSBIHN1110ZIAL/ke17ZwdGBToddI8pDm48kMpagLdZPgiW6yD5i4KsS9VZw-zPPgdn4jUwVcJE1ZvWhcwhEtWJXoshNdA9f1qD7UnCxNA8dHvmd7460Z7fbKFSZnIIAPuX1C4iUTyn4Xd4-76gsgk4xgxAaWTBSRHt9w/favicon.ico" /> 

</head>
  
<body>

  <?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/nav.php'); ?>

<div id="index" class="span7">
	<div id="resourceinfo">
		<p style="font-family:'verdana'"> <br> <br>
      Please email <img src="/assets/img/contact-email-blue.png" height="" width="175"/>to add a Resource. Include as much of the following info as possible:
		</p>
    <ul>
      <li>Name</li>
      <li>Url Link to Resource</li>
      <li>Url Link to Paper</li>
      <li>Description</li>
      <li>License Type</li>
      <li>Author</li>
      <li>Owner</li>
      <li>Programming Language (if applicable)</li>
      <li>Category (please see Categories next to Seach box)</li>
    </ul>
	</div>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>

</body>
</html>

<?php ob_flush() ?>
