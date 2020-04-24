session_start();

<?php ini_set('“memory_limit”','”16M“');



include($_SERVER['DOCUMENT_ROOT'].'/_secret/mysql_pass.php');

$conn = mysqli_init(); 
$_SESSION["connection"] = mysqli_real_connect($conn, $hostname, $username, $password, $database); 
$db = mysqli_select_db($conn, $database) or die("Unable to connect to $database"); 
$pMysqli = true; 
$pMysqli = new mysqli('127.0.0.1', 'root', 'asa192526', 'openair');

#function SPmysqli(){
# global $pMysqli;
#}
#SPmysqli();
//if (isset($_SESSION["user"]->commentCT){
//$_SESSION["user"]->commentCT = 5;
//}
function redirect($url, $permanent = false) {
  if ($permanent) {
    header('HTTP/1.1 301 Moved Permanently');
  }
  header('Location: '.$url);
  exit();
}

/****************************************
 * User stuff
 ****************************************/

/***************
 * Inserts user into user table if not exist.
 * Otherwise, just updates lastLogin time.
 * Returns user along with privilege level.
 **************/
function loginUser($response, $pMysqli) {
  if( $response['auth']['info'] ) {
    $default_privilege = 'user';
    $provider_id = $response['auth']['uid'];
    $provider_type = $response['auth']['provider'];
    $now = date(DATE_ATOM );

    $user = new stdClass;
    $user->provider_id = $provider_id;
    $user->provider_type = $provider_type;
    $user->name = $response['auth']['info']['name'];
    $user->image = $response['auth']['info']['image'];
    $profile_url = "";
    if( $provider_type == 'Facebook' ) {
      $profile_url = $response['auth']['info']['urls']['facebook'];
    } else
    if( $provider_type == 'Twitter' ) {
      $profile_url = $response['auth']['info']['urls']['twitter'];
    }
    
    $r = mysqli_query($pMysqli,"SELECT * FROM user WHERE provider_id = '".$provider_id."'"
                     ." AND provider_type = '".$provider_type."'");
    if($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
      // if exists, update fields that may have changed along with lastLogin
      mysqli_query($pMysqli,"UPDATE user SET"
                  ." name = '".$user->name."', "
                  ." image_url = '".$user->image."', "
                  ." lastLogin = '".$now."'"
                  ." WHERE provider_id = '".$provider_id."'"
                  ." AND provider_type = '".$provider_type."'");
      $user->id = $row{'id'};
      $user->privilege = $row{'privilege'};
    } else {
      mysqli_query($pMysqli, "
          INSERT INTO user(provider_id, provider_type, 
                           name, image_url, profile_url,
                           privilege, lastLogin)
                    VALUES('$provider_id','$provider_type',
                           '$user->name','$user->image','$profile_url',
                           '$default_privilege','$now')
                           ");
      $user->id = mysqli_insert_id();
      $user->privilege = $default_privilege;
    }

    return $user;
  } else {
    return null;
  }
}
$_SESSION["commentCoun"] = 0;

function isLoggedIn() {
  return isset($_SESSION["user"]);
}

function isAdmin() {
  if( isset($_SESSION["user"]) ) {
    return ($_SESSION["user"]->privilege == 'admin');
  }
  return false;
}

/****************************************
 * Topic/Category stuff
 ****************************************/

function getCategoryUpdatesSQL($withinMonths) {
  $sqlStatement="
    SELECT c.*, count(distinct r.id) AS numNew
    FROM resource r, resource_category rc, category c
    WHERE r.approved_date > DATE_SUB(now(), INTERVAL $withinMonths MONTH)
    AND r.id = rc.resource_id
    AND c.id = rc.category_id
    GROUP BY c.id"
    ;
  return $sqlStatement;
}

function writeTopicEntry($catHref, $row, $countOf, $selectedCat, $level, $pMysqli) {
  $id = isset($row['id']) ? $row['id'] : '';
  $name = isset($row['name']) ? $row['name'] : '';
  if( $countOf == 'pending_count' ) {
    $name .= ' (' . $row{'pending_count'} . ')';    
  } else
  if( $countOf == 'approved_count' ) {
    $name .= isset($row{'approved_count'}) ? $row{'approved_count'} : '';
    //$name .= ' (' . $row{'approved_count'} . ')';
  }
  $icon = ($level == 0) ? 'glyphicon-plus' : 'glyphicon-minus';

  $children = "";
  $filter_id = 0;
  //echo $id;
  $sqlQuery = "SELECT * from category where parent=".$id;
  //echo $id;
  if (!isAdmin()) {
      $sqlQuery.= " AND id > 0";
  }
  $sqlQuery.= " ORDER BY id";

  $r_sub = mysqli_query($pMysqli, $sqlQuery);

 //if (!$pMysqli -> query( "SELECT * from category where parent=".$id)) {
 // echo("Error description: " . $pMysqli -> error);
//}

  if((mysqli_num_rows($r_sub) == 0 || !$r_sub) and mysqli_num_rows($r_sub) < 153) {
    $topic = "<li><a tabindex='-1' href='$catHref?cat=$id'>$name</a></li>";
  } else {
    $topic = "<li class='dropdown-submenu'>
                <a tabindex='-1' href='$catHref?cat=$id'>$name</a>
              ";
    $topic .= "<ul class='dropdown-menu'>";
    while ($row_sub = mysqli_fetch_array($r_sub, MYSQLI_ASSOC)) {
      $topic .= writeTopicEntry( $catHref, $row_sub, $countOf, $selectedCat, $level+1, $pMysqli);
    }
      $topic .= "</ul>";
  }
  $topic .= "</li>";
  
  return $topic;
}

function createCategoryEntry($row, $countOf, $pMysqli) {
  $id = $row{'id'};
  $name = $row{'name'};
  if( $countOf == 'pending_count' ) {
    $name .= ' (' . $row{'pending_count'} . ')';    
  } else
  if( $countOf == 'approved_count' ) {
    $name .= ' (' . $row{'approved_count'} . ')';
  }
  $singleData = str_replace("NAME_REPLACE", $name, '{ "data" : "NAME_REPLACE", "attr": { "id": "ID_REPLACE"}, "metadata" : { id : ID_REPLACE, name : "NAME_REPLACE" }, "children" : [ CHILDREN_REPLACE ] }');
  $singleData = str_replace("ID_REPLACE", $id, $singleData);

  $children = "";
  $filter_id = 0;
  $sqlQuery = "SELECT * from category where parent=".$id;
  if (!isAdmin()) {
      $sqlQuery.= " AND id > 0";
  }
  $sqlQuery.= " ORDER BY id";

  $r_sub = mysqli_query($pMysqli, $sqlQuery);
  while ($row_sub = mysqli_fetch_array($r_sub, MYSQLI_ASSOC)) {
      if(!empty($children)) {
          $children .= ",";
      }
      $children .= createCategoryEntry($row_sub, $countOf);
  }

  return str_replace("CHILDREN_REPLACE", $children, $singleData);
}

/****
 * $openNode(true,false) determines if tree is opened to a node or not
 ************/
function buildJSTreeJson($cat, $openNode, $countOf, $pMysqli) {
  $MAIN_JSON = '{ 
		"json_data" : {
			"data" : [
				{ "data" : "Artificial Intelligence", "attr": { "id": "0" }, "metadata" : { id : 0, name: "Artificial Intelligence" }, "children" : [THE_DATA] }
			]
		},
		"plugins" : [ "themes", "json_data", "ui", "sort" ],
		"ui" : { "initially_select" : [ OPEN_REPLACE ] },
		"core": { "initially_open" : [ OPEN_REPLACE ] },
		"sort" : function (a, b) {return this.get_text(a) > this.get_text(b) ? 1 : -1; },
		"themes" : {
            "dots" : false
        }
	}';
  
  $data = "";

  $sqlQuery = "SELECT * from category where parent=0";
  if (!isAdmin()) {
      $sqlQuery.= " AND id > 0";
  }
  $sqlQuery.= " ORDER BY id";
  $r = mysqli_query($pMysqli, $sqlQuery);

  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
      if(!empty($data)) {
          $data .= ",";
      }
      $singleData = createCategoryEntry($row, $countOf);
      $data .= $singleData;
  }

  $json = str_replace("THE_DATA", $data, $MAIN_JSON);

  if( $openNode ) {
    if(empty($cat)) {
      $opencat = "0";
      if(isset($_GET['id']) && $_GET['id'] != '') {
        $r = mysqli_query($pMysqli, "SELECT category_id from resource_category where resource_id=".$_GET['id']);
        $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
        if(!is_null($row)) {
            $opencat = "\"".$row{'category_id'}."\"";
        }
      }

      $json = str_replace("OPEN_REPLACE", $opencat, $json);
    } else {
      $json = str_replace("OPEN_REPLACE", "\"".$cat."\"", $json);
    }
  } else {
    $json = str_replace("OPEN_REPLACE", "\"0\"", $json);
  }
  
  return $json;
}

function getTopicName($cat, $pMysqli) {
  $resourcetitle = "";

  if(empty($cat)) {
      $resourcetitle = "Artificial Intelligence";
  }
  else {
    $r = mysqli_query($pMysqli,  "SELECT name from category where id=".$cat);
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    if(is_null($row)) {
      $resourcetitle = "Artificial Intelligence";
    }
    else {
        $resourcetitle = $row{'name'};
    }
  }
  
  return $resourcetitle;
}

function getTopicDesc($cat, $pMysqli) {
  $resourcedescription = "";

  if(empty($cat)) {
      $resourcedescription = "This site contains a community-curated directory of open source code and open access data for AI researchers. You can navigate through the directory via the menu on the left or the search box  below. Please help us grow the directory by using the the \"Submit an Entry\" button (see the upper right corner of this page) to send us information about open AI resources (code or data) that are not listed here. ";

  }
  else {
    $r = mysqli_query($pMysqli,"SELECT id, name, description, parent from category where id=".$cat);
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    if(is_null($row)) {
        $resourcedescription = "The category does not exist.";
    }
    else {
        $resourcedescription = $row{'description'};
    }
  }
  
  return $resourcedescription;
}

function getTopicImg($cat, $pMysqli) {
  $img = "";

  if(empty($cat)) {
      $cat = 0;
  }
//  else {
    $r = mysqli_query($pMysqli, "SELECT image from category where id=".$cat);
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    if(is_null($row)) {
      $img = "http://www.dailygalaxy.com/.a/6a00d8341bf7f753ef019affc63311970d-pi";
    }
    else {
        $img = $row{'image'};
    }
//  }
  
  return $img;
}

function getCategoryOptions($catId, $nameprefix, $pMysqli) {
  $options = "";
  $result = mysqli_query($pMysqli,"SELECT * FROM category WHERE id != -1 AND parent=".$catId);
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $options .= "<option value='".$row['id']."'>".$nameprefix." ".$row['name']."</option>";
    $options .= getCategoryOptions($row['id'], $nameprefix." ".$row['name']." &gt; ");
  }

  return $options;
}

function buildCategorySelect($withAI, $name = 'drilldown') {
  $select = "<select class='drilldown' name='$name'>
               <option value=''>-- Select Category --</option>";
  if($withAI) {
    $select.= "<option value='0'>Artificial Intelligence</option>";
  }
  $select .= getCategoryOptions(0, "");
  $select .= "</select>";
  return $select;
}

function buildSubCatSqlCondition($cat) {
  $pMysqli = new mysqli('127.0.0.1', 'root', 'asa192526', 'openair');
  //first get all the categories that we should be searching on
  if(empty($cat)) {$cat = 0;}
  $subcats = getSubCats($cat, $pMysqli);
  $subcats[] = $cat;
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
  return $subcatString;
}

function getSubCats($catId, $pMysqli) {
  $pMysqli = new mysqli('127.0.0.1', 'root', 'asa192526', 'openair');
  $subcats = array();

  $r = mysqli_query($pMysqli, "SELECT id FROM category WHERE parent=".$catId);
  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
    $subcats[] = $row{'id'};

    $subSubCats = getSubCats($row{'id'}, $pMysqli);

    foreach ($subSubCats as &$value) {
      $subcats[] = $value;
    }
  }

  $subcats = array_diff($subcats, array(-1));

  return $subcats;
}

/****************************************
 * Search stuff
 ****************************************/

function countResults($subcatString, $query, $pMysqli) { 
 $pMysqli = new mysqli('127.0.0.1', 'root', 'asa192526', 'openair');
  $sqlStatement = "
    SELECT count(DISTINCT r.id)
      FROM resource r
    LEFT JOIN resource_category rc ON r.id=rc.resource_id
    WHERE r.approved_date IS NOT NULL
    AND rc.category_id IN $subcatString
    ";
  if(!empty($query)) {
    $query = mysqli_escape_string($pMysqli, $query); 
//    $sqlStatement.=" AND (r.name like '%".$query."%' OR r.description like '%".$query."%')";
    $queryCond = "MATCH(name,description,owner,author) AGAINST ('$query' IN BOOLEAN MODE)";
    $sqlStatement.=" AND $queryCond";
    $sqlStatement.=" ORDER BY $queryCond DESC, num_likes DESC";
  } else {
    $sqlStatement.=" ORDER BY num_likes DESC";
  }

  //echo '~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~';
  // echo $sqlStatement;
  //echo '~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~';
  $r = mysqli_query($pMysqli, $sqlStatement); //first parameter has to be a mysqli thing?
  $row = mysqli_fetch_row($r); //removed MYSQLI_ASSOC after $r
  return $row[0];
}

function getResourceSearchSQL($subcatString, $query, $startIdx, $MAX_RESULTS) {
 $pMysqli = new mysqli('127.0.0.1', 'root', 'asa192526', 'openair');
  $sqlStatement="
  SELECT DISTINCT r.id, r.name, r.description, 
         r.owner, r.link, r.paper_url,
         r.license_type, r.resource_type,
         r.author, r.approved_date,
         r.num_views, r.num_likes, r.num_comments,
         u.image_url, u.profile_url
    FROM resource r
  LEFT JOIN resource_category rc ON r.id=rc.resource_id
  LEFT JOIN user u ON r.submitter_id = u.id
  WHERE r.approved_date IS NOT NULL
  AND rc.category_id IN $subcatString
  ";

  if(!empty($query)) {
    $query = mysqli_escape_string($pMysqli, $query);
//    $sqlStatement.=" AND (r.name like '%".$query."%' OR r.description like '%".$query."%')";
    $queryCond = "MATCH(r.name,description,owner,author) AGAINST ('$query' IN BOOLEAN MODE)";
    $sqlStatement.=" AND $queryCond";
    $sqlStatement.=" ORDER BY $queryCond DESC, num_likes DESC, r.name";
  } else {
    $sqlStatement.=" ORDER BY num_likes DESC, r.name";    
  }
  $sqlStatement.=" LIMIT $startIdx, $MAX_RESULTS";
  
  return $sqlStatement;
}

function countPendingResults($subcatString, $pMysqli) {
  $r=mysqli_query($pMysqli, "
    SELECT count(DISTINCT r.id)
      FROM resource r
    LEFT JOIN resource_category rc ON r.id=rc.resource_id
    WHERE r.approved_date IS NULL
    AND rc.category_id IN $subcatString
     ");
  $row = mysqli_fetch_row($r, MYSQLI_ASSOC);
  return $row[0];
}

/***
 * Don't use query but keep it for consistency with getResourceSearchSQL()
 */
function getPendingResourceSQL($subcatString, $query, $startIdx, $MAX_RESULTS) {

  $sqlStatement="
  SELECT DISTINCT r.id, r.name, r.description, 
         r.owner, r.link, r.paper_url,
         r.license_type, r.resource_type,
         r.author, r.last_edited_date, r.approved_date,
         r.num_views, r.num_likes, r.num_comments,
         u.image_url, u.profile_url
    FROM resource r
  LEFT JOIN resource_category rc ON r.id=rc.resource_id
  LEFT JOIN user u ON r.submitter_id = u.id
  WHERE r.approved_date IS NULL
  AND rc.category_id IN ".$subcatString."
  ";

  if(!empty($query)) {
    $query = mysqli_escape_string($query); //might need to stay as mysql_escape_string
//    $sqlStatement.=" AND (r.name like '%".$query."%' OR r.description like '%".$query."%')";
    $queryCond = "MATCH(r.name,description,owner,author) AGAINST ('$query' IN BOOLEAN MODE)";
    $sqlStatement.=" AND $queryCond";
    $sqlStatement.=" ORDER BY $queryCond DESC, num_likes DESC, r.name";
  } else {
    $sqlStatement.=" ORDER BY r.name ASC, r.name";    
  }
  $sqlStatement.=" LIMIT $startIdx, $MAX_RESULTS";
  
  return $sqlStatement;
}

function getResourceSQL($resource_id) {

  $sqlStatement="
  SELECT DISTINCT r.id, r.name, r.description, 
         r.owner, r.link, r.paper_url,
         r.license_type, r.resource_type,
         r.author, r.approved_date,
         r.num_views, r.num_likes, r.num_comments,
         u.image_url, u.profile_url,
         r.programming_lang, r.data_format
    FROM resource r
    LEFT JOIN user u ON r.submitter_id = u.id
  WHERE r.id = '$resource_id'";
  
  return $sqlStatement;
}

/****************************************
 * Meta-Resource stuff
 ****************************************/

function incrementViewCount($resource_id, $pMysqli) {
  $updateSql =
    "UPDATE resource SET"
    ." num_views=num_views+1"
    ." WHERE id=$resource_id";

  $result = mysqli_query($pMysqli, $updateSql);
}


/****************************************
 * Misc stuff
 ****************************************/
function stringToColorCode($str) {
  return '#'.substr(md5($str), 0, 6);
}

?>
