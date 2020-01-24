<!DOCTYPE html>
<html lang="en">
<head>

  <?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); ?>
  <?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/listPage.php'); ?>
  <?php include ($_SERVER['DOCUMENT_ROOT'].'/services/admin-required.php'); ?>
  
  
  <link rel="stylesheet" href="/assets/css/pending.css" type="text/css">
  <script src="/assets/js/pending.js"></script>
  
<?php
$query = "";
if(isset($_GET['q'])) { $query = $_GET['q']; }

$MAX_RESULTS = 10;
$page = 1;
if (isset($_GET['p'])) { $page=$_GET['p']; }
$startIdx = ($page-1) * $MAX_RESULTS;

$urlAdd = "";
if(!empty($query)) {
  $urlAdd = "&q=".$query;
}
if(!empty($cat)) {
  $urlAdd .= "&cat=".$cat;
}

$numResult = countPendingResults($subcatString, $query);
$totalPages = ceil($numResult / $MAX_RESULTS);

$catTitle = getTopicName($cat);
$catdescription = getTopicDesc($cat);
$catImg = getTopicImg($cat);

$topicImageElement = "";
if( !empty($catImg) ) {
  $topicImageElement = "<img class='topic-img' src='$catImg'>";
} else {
  $topicBgColor = stringToColorCode($catTitle);
  $topicText = substr($catTitle, 0, 1);
  $topicImageElement = "<div class='topic-img-none' style='background: $topicBgColor'>
                          $topicText
                        </div>";
}
?>

<?php
//ONLY PRINT THIS JAVASCRIPT IF THEY ARE AN ADMIN
if(isAdmin()) {
?>
<script>
	function deleteCategory() {
		var r=confirm("Are you sure you want to delete <?= $catTitle; ?> and all of the child categories beneath it?");
		if (r==true) {
			window.location.href = window.location.origin+"/services/delete_category.php?cat="+cat;
		}
		else{
		}
	}
</script>

<?php
}
?>
  
  <!-- ########### Pagination script ############ -->
  <script>
    $(function () {

      $('.pagination').twbsPagination({
          totalPages: <?= $totalPages ?>,
          visiblePages: 3,
          href: '?p={{number}}<?=$urlAdd?>#results'
      });

    });
  </script>
  
  <title>Pending Projects</title>

</head>
  
<body>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/nav.php'); ?>
  
<?php $countOf = 'pending_count'; ?>
<?php $catHref = 'pending.php'; ?>
<?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/search-tip.php'); ?>
<?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/search-section.php'); ?>

    <!-- ############## Editors ############## -->
<?php
        $editorRs = mysql_query("
          SELECT image_url,name, profile_url FROM editor e, user u
          WHERE category_id = $cat
          AND e.editor_id = u.id");
        if( !empty($cat) && $cat != 0 && mysql_num_rows($editorRs) ) {
?>
    <div id="editors" class="row">
      <div class="col-xs-12">

        <div>
          <span class="editor-heading"><b><?= $catTitle ?> Editors:</b> </span>
<?php
          $isFirst = true;
          while($editorRow = mysql_fetch_array($editorRs)) {
            $editorName = $editorRow{'name'};

            if( $isFirst ) {
              $isFirst = false;
            } else {
              echo ', ';
            }
            echo $editorName;
          } // while($editorRow = mysql_fetch_array($editorRs)
?>
        </div>
      </div>
    </div>  
<?php   } // if( !empty($cat) && $cat != 0 ) ?>

    <div class="">
      <div class="alert alert-success col-xs-12" role="alert">
        Please review the resources below
      </div>
    </div>


<!-- search results -->  
<div class="container">
  <div class="row row-offcanvas row-offcanvas-left">
    
    
    <div id="main" class="col-xs-12 col-sm-12">
      <div id="index" class="span7">
        
        <div id="">
          <div id="page-control-top">
            <ul class="pagination pagination-sm"></ul>
          </div>
          <div id="sub-header-right">
            <span id="resultTotal"><?= $numResult ?> results in "<?= $catTitle ?>"</span>
            <?= $topicImageElement ?>
          </div>
        </div>

        <table id='searchresults' class="table table-striped">
<!--
          <thead>
            <tr>
              <th id="result-header" colspan="2">
                <div id="page-control-top">
                  <ul class="pagination pagination-sm"></ul>
                </div>
                <div id="sub-header-right">
                  <span id="resultTotal"><?= $numResult ?> results in "<?= $catTitle ?>"</span>
                  <?= $topicImageElement ?>
                </div>
              </th>
            </tr>
          </thead>
-->
           <tbody>

<?php
        // ########## print search results
        $count = 0;
        $sqlStatement = getPendingResourceSQL($subcatString, $query, $startIdx, $MAX_RESULTS);

        $rs = mysql_query($sqlStatement);
        while ($row = mysql_fetch_array($rs)) {
          $count++;

          $types = explode(",", $row{'resource_type'});
          $typeHtml = '';
          foreach($types as $type) {
            $type = trim($type);
            $typeColor = stringToColorCode($type);
            $typeHtml .= "<span class='label' style='background-color: $typeColor'>
                            $type
                          </span>";
          }

            $catRs = mysql_query("
              SELECT c.id, c.name FROM resource_category rc
              LEFT JOIN category c ON rc.category_id = c.id
              WHERE rc.resource_id = ".$row{'id'});

            $catPath = '';
            while($catRow = mysql_fetch_array($catRs)) {
              if( !empty($catPath) ) { $catPath .= " | "; }
              $catPath .= '<a href="?cat='.$catRow{'id'}.'">'.$catRow{'name'}.'</a>';
            }

            $likedClass = '';
            if( isLoggedIn() ) {
              $user_id = $_SESSION["user"]->id;

              $likedRs = mysql_query("
                SELECT COUNT(*) as cnt FROM resource_likes
                WHERE resource_id=".$row{'id'}."
                AND user_id=$user_id
                ");
              $likedRow = mysql_fetch_array($likedRs);
              if( $likedRow{'cnt'} > 0 ) {
                $likedClass='liked';
              }
            }
?>
          <tr id="resource-<?=$row{'id'}?>" class="resource-container">
            <td class="meta-resource-column">
              <span class="glyphicon glyphicon-thumbs-up like <?=$likedClass?>" aria-hidden="true" data-resource-id="<?=$row{'id'}?>"> <?=$row{'num_likes'}?></span>
              <a href="details.php?id=<?=$row{'id'}?>&cat=<?=$cat?>#comments">
                  <span class="glyphicon glyphicon-comment comment" aria-hidden="true" data-resource-id="<?=$row{'id'}?>"> <?=$row{'num_comments'}?></span>
              </a>
            </td>
            <td class="resource-column">
              <div class="resource">
                
            <div id="edit-btns-<?=$row{'id'}?>" class="editBtn-group">
              <span class="editBtn">
                <a class="btn btn-default" href="/edit_resource.php?id=<?=$row{'id'}?>">Edit</a>
              </span>
              <span class="editBtn">
                <a class="btn btn-danger" href="#"
                   onclick="return deleteResource('<?=$row{'id'}?>')">Delete</a>
              </span>
              <?php if( empty($row{'approved_date'}) ) { ?>
              <span class="editBtn">
                <a class="btn btn-success" href="#"
                   onclick="return approveResource('<?=$row{'id'}?>')">Approve</a>
              </span>
              <?php } ?>
            </div>

                
                
                <div class="resource-title">
                  <a href="details.php?id=<?=$row{'id'}?>&cat=<?=$cat?>"><?=$row{'name'}?></a>
                  <span class="resource-type"><?= $typeHtml ?></span>
                </div>

<?php         if( !empty($row{'link'}) ) { ?>
                <a class="link" href="<?=$row{'link'}?>" target='_blank'>
                  <?=$row{'link'}?>
                </a>
<?php          } ?>

<?php
                $desc = htmlspecialchars($row{'description'});
                if( strlen($desc) > 100 ) {
                  $desc = substr($desc, 0, 100) . "...";
                }
?>
                <div class="resource-desc">
                  <?= $desc ?>
                </div>
                
                <div class="view"><?=$row{'num_views'}?> views</div>

                <div class="submission">
                  Submitted by
                  <a href="<?=$row{'profile_url'}?>">
                    <img class="submitter" src="<?=$row{'image_url'}?>">
                  </a>
                  on <?= date('M d Y', strtotime($row{'last_edited_date'})) ?>
                </div>
                

              </div>

            </div> <!-- class=resource-comment -->
<?php
        } // end while
?>

<?php
// ########## If no search results
if($count==0) {
	if(empty($query)) {
		echo "There are no entries in ".$catTitle.".";
	}
	else {
	    echo "No results for '".$query."' in the ".$catTitle." category.";
	}
}
?>
                </td>
              </tr>
            </tbody>
          </table> <!-- id=searchresults -->

<?php
if($totalPages>0) {
?>
  <ul id="page-control-bottom" class="pagination pagination-sm"></ul>
<!--
            <div class="page-controls">
              <div class="row-fluid">
                <div class="col-xs-3 text-left"><?php if ($page > 1) {echo "<a href=index.php?p=".($page-1).$urlAdd.">&lt; Previous Page</a>";} else { echo "&lt; Previous Page";} ?></div>
                <div class="col-xs-6 text-center">Page <?php echo $page." of ". $totalPages; ?> </div>
                <div class="col-xs-3 text-right"><?php if ($page < $totalPages) {echo "<a href=index.php?p=".($page+1).$urlAdd.">Next Page &gt;</a>";} else { echo "Next Page &gt;";} ?></div>
              </div>
            </div>
-->
<?php
}
?>
      
      
        </div> <!-- id=index -->
      </div> <!-- id=main -->
    </div> <!-- class=row -->
  </div> <!-- class=container -->
  <?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
  
</body>
</html>

<?php ob_flush() ?>
