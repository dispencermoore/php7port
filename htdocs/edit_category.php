<!DOCTYPE html>
<html lang="en">
<head>

  <?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); ?>
  <?php include ($_SERVER['DOCUMENT_ROOT'].'/services/admin-required.php'); ?>

  <script type="text/javascript" src="assets/js/jwysiwyg/jquery.wysiwyg.js"></script>
  <script type="text/javascript" src="assets/js/jwysiwyg/plugins/autoload/jquery.autoload.js"></script>
  <script type="text/javascript" src="assets/js/jwysiwyg/plugins/wysiwyg.autoload.js"></script>
  <script type="text/javascript" src="assets/js/jwysiwyg/controls/wysiwyg.image.js"></script>
  <script type="text/javascript" src="assets/js/jwysiwyg/controls/wysiwyg.link.js"></script>
  <script type="text/javascript" src="assets/js/jwysiwyg/controls/wysiwyg.table.js"></script>

  <link rel="stylesheet" href="assets/js/jwysiwyg/jquery.wysiwyg.css" type="text/css" />
  <script type="text/javascript">
  $(function() {
    $("#wysiwyg").wysiwyg({
      plugins: { autoload: true },
      initialContent: ""
    });
  });

  </script>

<?php
    $resourcetitle = getCategoryTitle($cat);
	$description = getCategoryDesc($cat);
	$message="";
	// $con = mysqli_connect("ec2-54-243-13-79.compute-1.amazonaws.com","openai","theaiisclosed","openair");
	// if (mysqli_connect_errno($con))
	// 	echo "Failed to connect to MySQL: " . mysqli_connect_error();

	if (isset($_POST['cancel'])) {
		redirect(str_replace("edit_category.php", "", $activepage));
	}

	if(isset($_POST['edited'])){
		$description = addslashes($_POST['edited']);
		$result = mysql_query("UPDATE category SET description='$description' WHERE name='$resourcetitle'");
		if($result) {
			// $message = "<div class='alert alert-success'><strong>Thanks!</strong> " . $resourcetitle . " description has been updated.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
			redirect(str_replace("edit_category.php", "", $activepage));
  		}
		else
			$message = "<div class='alert alert-failure'>" . $resourcetitle . " description could not be updated.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
	}
?>

  <title>Edit <?= $resourcetitle ?></title>
  
  </head>
  
<body>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/nav.php'); ?>

  <div id="right" class="span7">
	<h2>Editing Topic: <?php echo $resourcetitle ?></h2>
	<?php echo $message; ?>
	<form id='edit-category' method="POST" >
    <input name='cat' type='hidden' value="<?php echo $cat ?>"></input>
	<textarea id="wysiwyg" name='edited' class="descriptioneditor"><?php echo $description; ?></textarea>
<!--     <textarea id="wysiwyg" rows='7' name='edited' wrap='virtual'><?php echo $description; ?></textarea><br> -->
	
    <button type="submit" name="save" class="btn btn-primary">Save</button>
    <button type="submit" name="cancel" class="btn">Cancel</button>
	</form>
  </div>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>

    </body>
</html>

<?php ob_flush() ?>
