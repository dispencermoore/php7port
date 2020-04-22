<!DOCTYPE html>
<html lang="en">
<head>

  <?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); ?>
  <title>Add Resource</title>

</head>
  
<body>

  <?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/nav.php'); ?>

<div id="index" class="span7">
	<div id="resourceinfo">
		<p>
      Please email admin-at-airesources.org to add a Resource. Include as much of the following info as possible:
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
