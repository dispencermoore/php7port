<?php
include ($_SERVER['DOCUMENT_ROOT'].'/includes/utils.php');

if (isAdmin()) {
  //TODO now we can delete this category (and redirect to index anyway)
  $cat = "";
  if(isset($_GET['cat'])) { $cat = $_GET['cat']; }
  if($cat==0 || $cat==-1) { $cat=""; } //This is to prevent deleting the root node or the _ORPHANS node
  
  if(!empty($cat)) {
    $subcats = getSubCats($cat);
    $subcats[] = $cat;

    //First select all the resources in these categories and make them orphans
    $subcatString = "";
    foreach ($subcats as &$value) {
		if(empty($subcatString)) {
			$subcatString.="(";
		}
		else {
			$subcatString.=",";
		}
		$subcatString.=$value;
    }
    $subcatString.=")";
	

	$result = mysql_query("UPDATE resource_category SET category_id=-1 WHERE category_id IN ".$subcatString);
	if(!$result) {
		echo("ERROR running UPDATE");
	}

	//Then actually delete all these categories
	$r = mysql_query("DELETE FROM category WHERE id IN ".$subcatString);
	$result = mysql_fetch_row($r);
	if(!$result) {
		echo("ERROR running DELETE");
	}
  }
}

// No matter what redirect at the end
header('Location: /index.php');
?>