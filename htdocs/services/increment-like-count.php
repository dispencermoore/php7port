<?php
include ($_SERVER['DOCUMENT_ROOT'].'/includes/utils.php');
//include ($_SERVER['DOCUMENT_ROOT'].'/services/login-required.php');

if( !empty($_GET['resource_id'])
&&  isLoggedIn()
) {

  $resource_id = $_GET['resource_id'];
  $user_id = $_SESSION["user"]->id;


  $insertSql =
    "INSERT INTO resource_likes(resource_id, user_id)"
    ." VALUES($resource_id,$user_id)";

  mysql_query($insertSql);
  
  $numRowsInserted = mysql_affected_rows();
  
  if( $numRowsInserted == 1 ) {
    $updateSql =
      "UPDATE resource SET"
      ." num_likes = num_likes + 1"
      ." WHERE id=$resource_id";

    mysql_query($updateSql);
    
//    echo 'Like recorded and incremented';
    header('HTTP/1.1 200 OK');
  } else {
//    echo 'User already liked resource and cannot perform this action again';
    header('HTTP/1.1 304 Not Modified');
  }

  
} else {
//  echo "Requires resource_id query parameter.";
//  echo '<p>Click <a href="/">here</a> to return home';
  if( !isLoggedIn() ) {
    header('HTTP/1.1 401 You must be logged in');
  } else {
    header('HTTP/1.1 400 Missing resource_id');
  }
}
?>