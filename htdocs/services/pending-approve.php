<?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/utils.php'); ?>
<?php include ($_SERVER['DOCUMENT_ROOT'].'/services/admin-required.php'); ?>

<?php

function updateCount($resource_id) {
  // update for current categories of given resource
  mysql_query("
      UPDATE category c SET
        approved_count = approved_count+1
        ,pending_count = pending_count-1
      WHERE id IN (SELECT category_id FROM resource_category WHERE resource_id=$resource_id)
      ");

  $r=mysql_query("
      SELECT DISTINCT parent FROM category
      WHERE id IN (SELECT category_id FROM resource_category WHERE resource_id=$resource_id)
      ");
  $updatedCats = array();
  while( $row = mysql_fetch_array($r) ) {
    trickleCountUpdate($row{'parent'}, $updatedCats);
  }
}

function trickleCountUpdate($cat_id, &$updatedCats) {
  if( !array_key_exists($cat_id, $updatedCats) ) {
    $updatedCats[$cat_id] = true;
    
    mysql_query("
        UPDATE category c SET
          approved_count = approved_count+1
          ,pending_count = pending_count-1
        WHERE id = $cat_id
        ");

    $r=mysql_query("
        SELECT DISTINCT parent FROM category
        WHERE id = $cat_id
        ");
    while( $row = mysql_fetch_array($r) ) {
      trickleCountUpdate($row{'parent'}, $updatedCats);
    }
    
  }
}

if(isset($_POST['approve'])){
  $id = $_POST['id'];
  $user_id = $_SESSION["user"]->id;
  $r=mysql_query("
      UPDATE resource
         SET approved_date = now(),
             approved_by = '$user_id'
       WHERE id=$id
       ");

  updateCount($id);
  
  redirect("/details.php?id=$id");
} else {
  redirect("/pending.php");
}

?>
