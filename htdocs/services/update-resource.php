<?php
include ($_SERVER['DOCUMENT_ROOT'].'/includes/utils.php');
include ($_SERVER['DOCUMENT_ROOT'].'/services/admin-required.php');

if( !empty($_POST['id'])
&&  !empty($_POST['dbname'])
&&  !empty($_POST['link'])
&&  !empty($_POST['description'])
&&  !empty($_POST['categories'])
// &&  !empty($_POST['type']) 
//&&  !empty($_POST['license'])
) {

//	$result = mysql_query("SELECT * FROM resource_type WHERE name='$_POST[resource]'");
//	$row = mysql_fetch_array($result);
//	$resource = $row['id'];
//	$result = mysql_query("SELECT * FROM license_type WHERE name='$_POST[license]'");
//	$row = mysql_fetch_array($result);
//	$license = $row['id'];
//	$result = mysql_query("SELECT * FROM significance_type WHERE name='$_POST[significance]'");
//	$row = mysql_fetch_array($result);
//	$significance = $row['id'];

	$id = $_POST['id'];
	$dbname = addslashes($_POST['dbname']);
	$prog_lang = addslashes($_POST['prog_lang']);
	$dataformat = addslashes($_POST['dataformat']);
	// $type = addslashes($_POST['type']);
  $type = addslashes(implode(', ', $_POST['type']));

	$license = addslashes($_POST['license']);
	$description = addslashes($_POST['description']);
	$link = addslashes($_POST['link']);
	$paperurl = addslashes($_POST['paperurl']);  
	$author = addslashes($_POST['author']);
	$owner = addslashes($_POST['owner']);

    $updateSql =
      "UPDATE resource SET"
      ." name='$dbname'"
      .", programming_lang='$prog_lang'"
      .", data_format='$dataformat'"
      .", resource_type='$type'"
      .", license_type='$license'"
      .", description='$description'"
      .", link='$link'"
      .", paper_url='$paperurl'"
      .", author='$author'"
      .", owner='$owner'"
      .", last_edited_date=now()"
      ." WHERE id=$id";

	$result = mysql_query($updateSql);

     //Then logs the edit
  $user_id = $_SESSION["user"]->id;
  
  $r = mysql_query("SELECT `name` FROM user WHERE id = $user_id"); 
  $row = mysql_fetch_array($r);
  $user_name = $row['name'];

  $r = mysql_query("SELECT `name` FROM resource WHERE id = $id"); 
  $row = mysql_fetch_array($r);
  $entry_name = $row['name'];

  $r = mysql_query("INSERT INTO user_action (user_id, username, entry_id, entry_name, action) VALUES ('".$user_id."','".$user_name."','".$id."','".$entry_name."','edit')");

  if(!$r) {
      halt(500, "ERROR running UPDATE");
      $hasError = true;
  }
  
  
    // Manage resource categories
    mysql_query("DELETE FROM resource_category WHERE resource_id = $id");
  
  	$categories = addslashes($_POST['categories']);  
    $catPieces = explode(',', $categories);
    foreach($catPieces as $cat) {
      mysql_query("INSERT INTO resource_category(resource_id,category_id)"
                 ." VALUES($id,'$cat')");
    }

//	if($_POST['drilldown'] != '') {
//		mysql_query("UPDATE resource_category SET category_id = $_POST[drilldown] where resource_id = '$id'");
//	}
//		
	$r = mysql_query("SELECT * FROM resource WHERE id ='$id'");
  	$row = mysql_fetch_array($r);
//  	if($result && $row['approved_date'] == '')
//  		redirect("/pending.php");
//	else if($result)
		redirect("/details.php?id=".$id);
} else {
  
  if( empty($_POST['id']) ) echo '<br>Requires id.';
  if( empty($_POST['dbname']) ) echo '<br>Requires dbname.';
  if( empty($_POST['link']) ) echo '<br>Requires link.';
  if( empty($_POST['description']) ) echo '<br>Requires description.';
  if( empty($_POST['categories']) ) echo '<br>Requires categories.';
  if( empty($_POST['type'])  ) echo '<br>Requires type.';
//  if( empty($_POST['license']) ) echo '<br>Requires license.';
  
  $backLink = '/index.php';
  if(isset($_POST['id'])){
    $backLink = "/edit_resource.php?id=".$_POST['id'];
  }
  
  echo '<p>Click <a href="'.$backLink.'">here</a> to try again';
}
?>