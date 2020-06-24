<!DOCTYPE html>
<html lang="en">
<head>
  <?php include ($_SERVER['DOCUMENT_ROOT'].'/services/admin-required.php'); ?>
  <?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); ?>
  <title>Add Category</title>
   <link rel="icon" 
  href="https://images.squarespace-cdn.com/content/v1/53cede1ae4b0de9f6e919b11/1410360829591-Z3M3PPXSBIHN1110ZIAL/ke17ZwdGBToddI8pDm48kMpagLdZPgiW6yD5i4KsS9VZw-zPPgdn4jUwVcJE1ZvWhcwhEtWJXoshNdA9f1qD7UnCxNA8dHvmd7460Z7fbKFSZnIIAPuX1C4iUTyn4Xd4-76gsgk4xgxAaWTBSRHt9w/favicon.ico" /> 

</head>
  
<?php
  $message = "";
  $catname = "";
  $drilldown = "";
  if(isset($_POST['catname'])) {
  	$catname = $_POST['catname'];
  }
  if(isset($_POST['drilldown'])) {
  	$drilldown = $_POST['drilldown'];
  }
  if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
    if(!empty($catname) && $drilldown != "") {
      $result = mysqli_query("INSERT INTO category (name, parent) VALUES ('$catname', $drilldown)");

      if($result)
        $message = "<div class='alert alert-success'><strong>Thanks!</strong> " . $catname . " has been added to the Hierarchy.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
      else
        $message = "<div class='alert alert-failure'>" . $catname . " could not be added to the Hierarchy.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";

    	$catname = "";
    }
    elseif (empty($catname)) {
    	$message = "<div class='alert alert-error'><strong>Error!</strong> Please provide a category name.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
    }
    elseif ($drilldown == "") {
    	$message = "<div class='alert alert-error'><strong>Error!</strong> Please provide a parent category.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
    }
  }
?>

<body>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/nav.php'); ?>

<div id="right" class="span7">
	<h2>Add a Category</h2>
	<?php echo $message; ?>
	<form id='add-category' method="POST" >
	  <label for="catname">Category Name:</label>
	  <input type="text" id="catname" name="catname" value="<?php echo $catname;?>"></input>
	  <label>Parent Category:</label>
	  <?php echo buildCategorySelect(true); ?><br>
	  <button type="submit" class="btn">Add</button>
	</form>
</div>

<script type="text/javascript">
//  $('select.drilldown').selectHierarchy({ hideOriginal: true });
</script>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>

    </body>
</html>

<?php ob_flush() ?>
