<!DOCTYPE html>
<html lang="en">
<head>

  <?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); ?>
  <?php include ($_SERVER['DOCUMENT_ROOT'].'/services/login-required.php'); ?>
  
  <script src="/assets/js/jquery.jstree-1.0.js"></script>
  <script src="/assets/js/select-categories.js"></script>
  <script src="/assets/js/jqBootstrapValidation.js"></script>

  <script>
    var category_json = <?=buildJSTreeJson($cat, true, 'approved_count')?>;
  </script>

  <script>
    function preprocessForm() {
      var catIds = '';
      $('.category').each(function(i, cat) {
        if( catIds ) catIds += ',';
        catIds += $(cat).attr('data-catid');
      });
      if( catIds ) {
        $('#categories').val(catIds);
        return true;
      } else {
        $('#categoryInput').css('border','1px solid red');
        return false;
      }
    }
  </script>

  <title>Submit Entry</title>
</head>

<body>
  
<?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/nav.php'); ?>


<div class="container">
  <div class="row row-offcanvas row-offcanvas-left">

  	<form name="form" action="./services/insert-resource.php" method="POST" onsubmit="return preprocessForm();">

      <input type=hidden name="id" value="<?= $id ?>">
      
      <div class="form-group">
        <label for="dbname">Resource Name:</label>
        <input type="text" class="form-control" name="dbname" required="required">
      </div>
      
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="prog_lang">Programming Language:<br></label>
            <input type="text" class="form-control" name="prog_lang">
          </div>
        </div>

        <div class="col-sm-6">
           <div class="form-group">
            <label for="dataformat">Data Format:<br></label>
            <input type="text" class="form-control" name="dataformat">
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="license">License Type:<br></label>
            <input type="text" class="form-control" name="license">
          </div>
        </div>
        <script>
          $(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
        </script>
        <div class="col-sm-6">
          <div class="form-group control-group">
<!--             <label for="type">Resource Type: (e.g. Code, Data, Service)<br></label>
            <input type="text" class="form-control" name="type" required="required" value="<?= $resource['resource_type'] ?>">   -->
            <label for="type">Resource Type (check all that apply):<br></label>
            <p>

                <div class="controls">
                  <label >
                   <input 
                      type="checkbox" 
                      name="type[]" 
                      data-validation-minchecked-minchecked="1" 
                      data-validation-minchecked-message="Choose at least one" 
                      value="Code" id = "codeCheck" /> Code</label>
                  <label >
                    <input type="checkbox" name="type[]" value="Service" id = "serviceCheck"  /> Service</label>
                 <label >
                    <input type="checkbox" name="type[]" value="Data" id = "dataCheck" /> Data</label>
                </div>
            </p>
          </div>
        </div>
      </div>
      
      <div class="form-group">
        <label for="description">Short Description:</label>
        <textarea class="form-control" rows="5" wrap="virtual" name="description" required="required"></textarea>
      </div>
      
      <div class="form-group">
        <label for="categories">Select one or more Categories:</label>
        <input id="categories" type="hidden" name="categories">
        <div id='catbrowser'></div>
        <div id="categoryInput" class="form-control"></div>
      </div>

      <h2>References</h2>
      <hr>
      
      <div class="form-group">
        <label for="link">Project Website:</label>
        <input type="url" class="form-control" name="link" required="required">
      </div>

      <div class="form-group">
        <label for="paperurl">Link to paper:</label>
        <input type="url" class="form-control" name="paperurl">
      </div>


      <h2>Attribution</h2>
      <hr>

       <div class="form-group">
        <label for="author">Author:<br></label>
        <input type="text" class="form-control" name="author">
      </div>

      <div class="form-group">
        <label for="owner">Owner:<br></label>
        <input type="text" class="form-control" name="owner">
      </div>

<?php
  $submitter = 'N/A';
  $user = $_SESSION["user"];
  if( $user ) {
    $submitter = '<div>'.$user->name.'</div>'.'<img src="'.$user->image.'">';
  }
?>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="submitter">Submitter:<br></label>
            <br><?= $submitter ?>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group action-btn-container">
            <button type="cancel" class="btn btn-default" onclick="window.history.back()">Cancel</button>
            <button type="submit" class="btn btn-primary">Submit Entry</button>
          </div>
        </div>
      </div>
    </form>
  </div> <!-- class=row -->  
</div> <!-- class=container -->

<?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>

<script type="text/javascript">
//  $('.drilldown').selectHierarchy({ hideOriginal: true });
</script>

</body>
</html>

<?php ob_flush() ?>
