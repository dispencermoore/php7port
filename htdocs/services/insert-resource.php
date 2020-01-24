<?php
include ($_SERVER['DOCUMENT_ROOT'].'/includes/utils.php');
include ($_SERVER['DOCUMENT_ROOT'].'/services/login-required.php');

function tricklePendingCountUpdate($cat_id, &$updatedCats) {
  if( !array_key_exists($cat_id, $updatedCats) ) {
    $updatedCats[$cat_id] = true;
    
    // update for current category
    mysql_query("UPDATE category
                 SET pending_count=pending_count+1
                 WHERE id=$cat_id");
    $r=mysql_query("SELECT parent FROM category WHERE id=$cat_id");
    while( $row = mysql_fetch_array($r) ) {
      tricklePendingCountUpdate($row{'parent'}, $updatedCats);
    }
  }
}

if( !empty($_POST['dbname'])
&&  !empty($_POST['link'])
&&  !empty($_POST['description'])
&&  !empty($_POST['categories'])
// &&  !empty($_POST['type']) 
//&&  !empty($_POST['license'])
) {

  $dbname = addslashes($_POST['dbname']);
  $prog_lang = addslashes($_POST['prog_lang']);
  $dataformat = addslashes($_POST['dataformat']);
  $type = addslashes(implode(', ', $_POST['type']));
  $license = addslashes($_POST['license']);
  $description = addslashes($_POST['description']);
  $link = addslashes($_POST['link']);
  $paperurl = addslashes($_POST['paperurl']);  
  $author = addslashes($_POST['author']);
  $owner = addslashes($_POST['owner']);
  $user_id = $_SESSION["user"]->id;

  $insertSql = "INSERT INTO resource (name, link, description, resource_type, license_type, 
  submitter_id, programming_lang, data_format, paper_url, owner, author, last_edited_date) 
  VALUES ('$dbname', '$link', '$description', '$type', '$license', 
  $user_id, '$prog_lang', '$dataformat', '$paperurl', '$owner', '$author', now())";

  $result = mysql_query($insertSql);

  $id = mysql_insert_id();

  // Manage resource categories
  $categories = addslashes($_POST['categories']);  
  $catPieces = explode(',', $categories);
  $updatedCats = array();
  foreach($catPieces as $cat_id) {
    mysql_query("INSERT INTO resource_category(resource_id,category_id)"
               ." VALUES($id,'$cat_id')");
    tricklePendingCountUpdate($cat_id, $updatedCats);
  }

  // mysqli_close($con);
  if($result)
    redirect('/submit-success.php');
} else {
  
  if( empty($_POST['dbname']) ) echo '<br>Requires dbname.';
  if( empty($_POST['link']) ) echo '<br>Requires link.';
  if( empty($_POST['description']) ) echo '<br>Requires description.';
  if( empty($_POST['categories']) ) echo '<br>Requires categories.';
  if( empty($_POST['type'])  ) echo '<br>Requires type.';
//  if( empty($_POST['license']) ) echo '<br>Requires license.';
  
  echo '<p>Click <a href="/submit.php">here</a> to try again';
}
?>