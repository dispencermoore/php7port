<?php
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

include ($_SERVER['DOCUMENT_ROOT'].'/includes/utils.php');

$app = new \Slim\Slim();
$app->contentType("application/json");


/************************
 * Routes
 ***********************/
$app->get('/category/updates/:withinMonths','getCategoryUpdates');
$app->get('/resource/:id','getResource');
$app->delete('/resource/:id'
  , requireAdmin($app)
   ,'delResource'
);
$app->post('/resource/approval/:id'
  , requireAdmin($app)
  , 'approveResource'
);



/************************
 * Route Functions
 ***********************/
function requireAdmin($app) {
  return function() use ($app) {
    if(!isAdmin()) {
      $app->contentType('text/plain');
      $app->halt(401, 'Admin Privileges Required');
    }
  };
}

function getCategoryUpdates($withinMonths) {
  $r=mysql_query(getCategoryUpdatesSQL($withinMonths));
  $updates = [];
  while( $row = mysql_fetch_array($r) ) {
    array_push($updates, array(
        "name" => $row{'name'}
      , "image" => $row{'image'}
      , "numNew" => $row{'numNew'}
      ));
  }

  echo json_encode($updates);
}


function getResource($id) {
  $r=mysql_query(getResourceSQL($id));
  $row = mysql_fetch_assoc($r);

  $resource = array(
    "name" => $row{'name'}
    
    );
  echo json_encode($resource);
}

function delResource($id) {
  $user_id = $_SESSION["user"]->id;

  //Gets name of entry for logging
  $r = mysql_query("SELECT `name` FROM resource WHERE id = ".$id); 
  $row = mysql_fetch_array($r);
  $entry_name = $row['name'];

  if(!empty($id)) {
    $pending = false;

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
      halt(500, "ERROR running UPDATE");
      $hasError = true;
	}

    //Then delete this actual entry
	$r = mysql_query("DELETE FROM resource WHERE id = ".$id);

  if(!$r) {
      halt(500, "ERROR running UPDATE");
      $hasError = true;
  }
  
    //Then logs the deletion
  $r = mysql_query("SELECT `name` FROM user WHERE id = ".$user_id); 
  $row = mysql_fetch_array($r);
  $user_name = $row['name'];


  $r = mysql_query("INSERT INTO user_action (user_id, username, entry_id, entry_name, action) VALUES ('".$user_id."','".$user_name."','".$id."','".$entry_name."','delete')");

	if(!$r) {
      halt(500, "ERROR running UPDATE");
      $hasError = true;
	}

  }
  echo '{"status":"deleted"}';

}

function approveResource($id) {
  $user_id = $_SESSION["user"]->id;
  $r=mysql_query("
      UPDATE resource
         SET approved_date = now(),
             approved_by = '$user_id'
       WHERE id=$id
       ");
   //Then logs the approval 

  $r = mysql_query("SELECT `name` FROM user WHERE id = $user_id"); 
  $row = mysql_fetch_array($r);
  $user_name = $row['name'];

  $r = mysql_query("SELECT `name` FROM resource WHERE id = $id"); 
  $row = mysql_fetch_array($r);
  $entry_name = $row['name'];

  $r = mysql_query("INSERT INTO user_action (user_id, username, entry_id, entry_name, action) VALUES ('".$user_id."','".$user_name."','".$id."','".$entry_name."','approval')");

  if(!$r) {
      halt(500, "ERROR running UPDATE");
      $hasError = true;
  }
  updateCount($id);

  echo '{"status":"approved"}';
}


/************************
 * Heper Functions
 ***********************/
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
      tricklePendingCountUpdate($row{'parent'}, $updatedCats, $pending);
    }
  }
}

/************************
 * Start REST server
 ***********************/
$app->run();

?>
