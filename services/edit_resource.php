<!DOCTYPE html>
<html lang="en">
<head>
 <link rel="icon" 
  href="https://images.squarespace-cdn.com/content/v1/53cede1ae4b0de9f6e919b11/1410360829591-Z3M3PPXSBIHN1110ZIAL/ke17ZwdGBToddI8pDm48kMpagLdZPgiW6yD5i4KsS9VZw-zPPgdn4jUwVcJE1ZvWhcwhEtWJXoshNdA9f1qD7UnCxNA8dHvmd7460Z7fbKFSZnIIAPuX1C4iUTyn4Xd4-76gsgk4xgxAaWTBSRHt9w/favicon.ico" /> 

  <?php include ($_SERVER['DOCUMENT_ROOT'].'/services/admin-required.php'); ?>
  
  <script src="/assets/js/jquery.jstree-1.0.js"></script>
  <script src="/assets/js/select-categories.js"></script>
  <script src="/assets/js/jqBootstrapValidation.js"></script>

  <script>
    var category_json = <?=buildJSTreeJson($cat, $pmysqli, true, 'approved_count')?>;
  </script>



<?php
$id = $_GET['id'];

$r = mysqli_query("SELECT * FROM resource WHERE id = ".$id);
$resource = mysqli_fetch_array($r);

?>
  
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
  <title>Edit <?= $resource['name'] ?></title>
  
  </head>
  
<body>



<?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/nav.php'); ?>


<div class="container">
  <div class="row row-offcanvas row-offcanvas-left">
  	<h2>Edit <?= $resource['name']; ?></h2>

  	<form name="form" action="./services/update-resource.php" method="POST" onsubmit="return preprocessForm();">
<!-- ||||||||||||||||||||||||||| -->
  <!-- <div class="control-group">
    <label for="type[]">Resource Type (check all that apply):<br></label>

    <div class="controls">
      <label class="checkbox">
        <input 
          type="checkbox" 
          name="type[]" 
          data-validation-minchecked-minchecked="1" 
          data-validation-minchecked-message="Choose at least one" 
          value="Code" id = "codeCheck" <?php echo checkedCode() ?> /> Code</label>
      <label class="checkbox">
        <input type="checkbox" name="type[]" value="Service" id = "serviceCheck" <?php echo checkedService() ?> /> Service</label>
      <label class="checkbox">
        <input type="checkbox" name="type[]" value="Data" id = "dataCheck" <?php echo checkedData() ?> /> Data</label>
    </div>
  </div> -->
<!-- |||||||||||||||||||||||||||||||||| -->
      <input type=hidden name="id" value="<?= $id ?>">
      
      <div class="form-group">
        <label for="dbname">Resource Name:</label>
        <input type="text" class="form-control" name="dbname" required="required" value="<?= $resource['name'] ?>">
      </div>
      
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="prog_lang">Programming Language:<br></label>
            <input type="text" class="form-control" name="prog_lang" value="<?= $resource['programming_lang'] ?>">
          </div>
        </div>

        <div class="col-sm-6">
           <div class="form-group">
            <label for="dataformat">Data Format:<br></label>
            <input type="text" class="form-control" name="dataformat" value="<?= $resource['data_format'] ?>">
          </div>
        </div>
      </div>

      <script>
        $(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
      </script>
      
           <?php
              function checkedCode(){
                $id = $_GET['id'];
                $r = mysqli_query("SELECT `resource_type` FROM resource WHERE id = $id");
                $row = mysqli_fetch_array($r);
                $resource_type = $row['resource_type'];
                if(strpos($resource_type, 'Code') !== false){
                  return "checked";
               } else {
                return "unchecked";
               }
              }

              function checkedService(){
                $id = $_GET['id'];
                $r = mysqli_query("SELECT `resource_type` FROM resource WHERE id = $id");
                $row = mysqli_fetch_array($r);
                $resource_type = $row['resource_type'];
                if(strpos($resource_type, 'Service') !== false){
                  return "checked";
               } else {
                return "unchecked";
               }
              }

              function checkedData(){
                $id = $_GET['id'];
                $r = mysqli_query("SELECT `resource_type` FROM resource WHERE id = $id");
                $row = mysqli_fetch_array($r);
                $resource_type = $row['resource_type'];
                if(strpos($resource_type, 'Data') !== false){
                  return "checked";
               } else {
                return "";
               }
              }

              // function isChecked(){
                // $id = $_GET['id'];
                // $r = mysqli_query("SELECT `resource_type` FROM resource WHERE id = $id");
                // $row = mysqli_fetch_array($r);
                // $resource_type = $row['resource_type'];
                // if(strpos($resource_type, 'Code') == true || strpos($resource_type, 'Service') == true || strpos($resource_type, 'Data') == true){
                  // return "";                  
                // } else {
                  // return "required = 'required'";
                // }

              // }
                   
            ?> 

            

      <div class="row">
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
                      value="Code" id = "codeCheck" <?php echo checkedCode() ?> /> Code</label>
                  <label >
                    <input type="checkbox" name="type[]" value="Service" id = "serviceCheck" <?php echo checkedService() ?> /> Service</label>
                 <label >
                    <input type="checkbox" name="type[]" value="Data" id = "dataCheck" <?php echo checkedData() ?> /> Data</label>
                </div>
            </p>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            <label for="license">License Type:<br></label>
            <input type="text" class="form-control" name="license" value="<?= $resource['license_type'] ?>">
          </div>
        </div>
      </div>
      
      <div class="form-group">
        <label for="description">Short Description:</label>
        <textarea class="form-control" rows="5" wrap="virtual" name="description" required="required"><?= $resource['description'] ?></textarea>
      </div>
      
<?php
  $categories = '';
  $rs = mysqli_query("SELECT c.* FROM resource_category rc ".
                    "LEFT JOIN category c ON rc.category_id=c.id ".
                    "WHERE rc.resource_id = " . $resource['id'] );
  while ($cat = mysqli_fetch_array($rs)) {
    $categories .= '<a class="category" data-catid="'.$cat['id'].'" onclick="return removeMe(this);">'
                   .'['.$cat['name'].'] </a>';
  }
?>
      <div class="form-group">
        <label for="categories">Select one or more Categories:</label>
        <input id="categories" type="hidden" name="categories">
        <div id='catbrowser'></div>
        <div id="categoryInput" class="form-control"><?= $categories ?></div>
      </div>

      <h2>References</h2>
      <hr>
      
      <div class="form-group">
        <label for="link">Link to data website:</label>
        <input type="url" class="form-control" name="link" required="required" value="<?= $resource['link'] ?>">
      </div>

      <div class="form-group">
        <label for="paperurl">Link to paper:</label>
        <input type="url" class="form-control" name="paperurl" value="<?= $resource['paper_url'] ?>">
      </div>


      <h2>Attribution</h2>
      <hr>

       <div class="form-group">
        <label for="author">Author:<br></label>
        <input type="text" class="form-control" name="author" value="<?= $resource['author'] ?>">
      </div>

      <div class="form-group">
        <label for="owner">Owner:<br></label>
        <input type="text" class="form-control" name="owner" value="<?= $resource['owner'] ?>">
      </div>

<?php
  $submitter = 'N/A';
  $rs = mysqli_query("SELECT * FROM user WHERE id = " . $resource['submitter_id'] );
  $user = mysqli_fetch_array($rs);
  if( $user ) {
    $submitter = '<div>'.$user['name'].'</div>'.'<img src="'.$user['image_url'].'">';
  }
?>
      <div class="form-group">
        <label for="submitter">Submitter:<br></label>
        <br><?= $submitter ?>
      </div>

      <button type="submit" class="btn btn-primary">Save Changes</button>
      <button type="cancel" class="btn btn-default" onclick="window.history.back()">Cancel</button>
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
