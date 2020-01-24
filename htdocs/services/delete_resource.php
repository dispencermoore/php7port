<?php
include ($_SERVER['DOCUMENT_ROOT'].'/includes/utils.php');
//include ($_SERVER['DOCUMENT_ROOT'].'/services/admin-required.php');

function tricklePendingCountUpdate($cat_id, &$updatedCats, $pending) {
  if( !array_key_exists($cat_id, $updatedCats) ) {
    $updatedCats[$cat_id] = true;
    
    // update for current category
    $sql = "UPDATE category";
    if( $pending ) {
      $sql .= " SET pending_count=pending_count-1";
    } else {
      $sql .= " SET approved_count=approved_count-1";
    }
    $sql .= " WHERE id=$cat_id";
    
    mysql_query($sql);
    $r=mysql_query("SELECT parent FROM category WHERE id=$cat_id");
    while( $row = mysql_fetch_array($r) ) {
      tricklePendingCountUpdate($row{'parent'}, $updatedCats);
    }
  }
}

$hasError = false;
$pending = false;

if (isAdmin()) {
  //TODO now we can delete this category (and redirect to index anyway)
  $id = "";
  if(isset($_GET['id'])) { $id = $_GET['id']; }
  
  if(!empty($id)) {
  	//Find out if this is a pending resource
  	$r = mysql_query("SELECT approved_date FROM resource WHERE id = ".$id);
  	$row = mysql_fetch_array($r);
  	if($row['approved_date'] == ''){
      $pending = true;
  	}

    // Manage resource categories
    $updatedCats = array();
    $r=mysql_query("SELECT category_id FROM resource_category WHERE resource_id=$id");
    while( $row = mysql_fetch_array($r) ) {
      tricklePendingCountUpdate($row{'category_id'}, $updatedCats, $pending);
    }
    
    //First delete from the resource_category table
	$r = mysql_query("DELETE FROM resource_category WHERE resource_id = ".$id);
	if(!$r) {
      echo("ERROR running UPDATE");
      $hasError = true;
	}

    //Then delete this actual entry
	$r = mysql_query("DELETE FROM resource WHERE id = ".$id);
	if(!$r) {
      echo("ERROR running UPDATE");
      $hasError = true;
	}
    
  }
}

if( !$hasError ) {
  //Redirect to pending page if resource was pending
  if($pending){
      header('location: /pending.php');
  } else { //Otherwise redirect to index
      header('Location: /index.php');
  }
}
?>