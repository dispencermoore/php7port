<?php
if(!isset($_SESSION)){session_start();}
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <link rel="icon" 
  href="https://images.squarespace-cdn.com/content/v1/53cede1ae4b0de9f6e919b11/1410360829591-Z3M3PPXSBIHN1110ZIAL/ke17ZwdGBToddI8pDm48kMpagLdZPgiW6yD5i4KsS9VZw-zPPgdn4jUwVcJE1ZvWhcwhEtWJXoshNdA9f1qD7UnCxNA8dHvmd7460Z7fbKFSZnIIAPuX1C4iUTyn4Xd4-76gsgk4xgxAaWTBSRHt9w/favicon.ico" /> 

  <?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); ?>
  <?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/listPage.php'); ?>
  
<?php
$query = "";
if(isset($_GET['q'])) { $query = $_GET['q']; }

$MAX_RESULTS = 10;
$page = 1;
if (isset($_GET['p'])) { $page=$_GET['p']; }
$startIdx = ($page-1) * $MAX_RESULTS;

$urlAdd = "";
if(!empty($query)) {
  $urlAdd = "&q=".urlencode($query);
}
if(!empty($cat)) {
  $urlAdd .= "&cat=".$cat;
}

$numResult = countResults($subcatString, $query, $pMysqli);
$totalPages = ceil($numResult / $MAX_RESULTS);

$catTitle = getTopicName($cat, $pMysqli);
//$catdescription = getTopicDesc($cat, $pMysqli);
$catImg = getTopicImg($cat, $pMysqli);

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
<script type="text/javascript">
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
  
  
  <script>
    $(function () {
      $('.pagination').twbsPagination({
          totalPages: <?= $totalPages ?>,
          visiblePages: 3,
          href: '?p={{number}}<?=$urlAdd?>#results'
      });
      //<?=$urlAdd?>'//#results'

      if (typeof $.cookie('visited') === 'undefined'){
        $.cookie('visited', 'true', { expires: 365 });
        $('#intro-modal').modal('show');
      }
    });
  </script>
  
  <title>AI Resources</title>

</head>
  
<body>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/nav.php'); ?>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/intro.php'); ?>
<?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/search-tip.php'); ?>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/search-section.php'); ?>

  
    <!-- ############## Editors ############## -->
<?php
        $editorRs = mysqli_query($pMysqli, "
          SELECT image_url,name, profile_url FROM editor e, user u
          WHERE category_id = $cat
          AND e.editor_id = u.id");
        if( !empty($cat) && $cat != 0 && mysqli_num_rows($editorRs) ) {
?>
    <div id="editors" class="row">
      <div class="col-xs-12">

        <div>
          <span class="editor-heading"><b><?= $catTitle ?> Editors:</b> </span>
<?php
          $isFirst = true;
          while($editorRow = mysqli_fetch_array($editorRs)) {
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



<!-- search results -->  
<div class="container">
  <span class="anchor" id="results"></span>
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
                <div id="resultTotal">
                  <?= $numResult ?> results in "<?= $catTitle ?>"<?= $topicImageElement ?>
                </div>
              </th>
            </tr>
          </thead>
 -->
           <tbody>

<?php
        // ########## print search results
include($_SERVER['DOCUMENT_ROOT'].'/_secret/mysql_pass.php');
$pMysqli = new mysqli($hostname, $username, $password, $database);
        $count = 0;
        $sqlStatement = getResourceSearchSQL($subcatString, $query, $startIdx, $MAX_RESULTS);

        $rs = mysqli_query($pMysqli, $sqlStatement);
        while ($row = mysqli_fetch_array($rs)) {
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

            $catRs = mysqli_query($pMysqli, "
              SELECT c.id, c.name FROM resource_category rc
              LEFT JOIN category c ON rc.category_id = c.id
              WHERE rc.resource_id = ".$row{'id'});

            $catPath = '';
            while($catRow = mysqli_fetch_array($catRs)) {
              if( !empty($catPath) ) { $catPath .= " | "; }
              $catPath .= '<a href="?cat='.$catRow{'id'}.'">'.$catRow{'name'}.'</a>';
            }

            $likedClass = '';
            if( isLoggedIn() ) {
              $user_id = $_SESSION["user"]->id;

              $likedRs = mysqli_query( $pMysqli, 
                "SELECT COUNT(*) as cnt FROM resource_likes
                WHERE resource_id=".$row{'id'}."
                AND user_id=$user_id"
              );
              //if (!$likedRs) {    
               // printf("Error: %s\n", $user_id); }
              $likedRow = mysqli_fetch_array($likedRs);
              if( $likedRow{'cnt'} > 0 ) {
                $likedClass='liked';
              }
            }
?>

          <tr class="resource-container">
            <td class="meta-resource-column">
              <span name="like_input" id= "like_input" type="submit" class="hover-show glyphicon glyphicon-thumbs-up like <?=$likedClass?>" aria-hidden="true"  value="<?=$row{'id'}?>"
                data-resource-id="<?=$row{'id'}?>"> <?=$row{'num_likes'}?></span>
              
              <a class="hover-show" type="submit" href="/main_pages/details.php?id=<?=$row{'id'}?>&cat=<?=$cat?>#comments">
                 
                  <span class="glyphicon glyphicon-comment comment" aria-hidden="true" data-resource-id="<?=$row{'id'}?>"> <?=$row{'num_comments'}?></span>
              </a>
            </td>
            <td class="resource-column">
              <div class="resource">
                <div class="resource-title">
                  <a href="/main_pages/details.php?id=<?=$row{'id'}?>&cat=<?=$cat?>"><?=$row{'name'}?></a>
                  <span class="resource-type"><?= $typeHtml ?></span>
                </div>

<?php         if( !empty($row{'link'}) ) { ?>
                <a class="link" href="<?=$row{'link'}?>" target='_blank'>
                  <?=$row{'link'}?>
                </a>
<?php          } ?>

<?php
                $desc = strip_tags($row{'description'});
                if( strlen($desc) > 100 ) {
                  $desc = substr($desc, 0, 100) . "...";
                }
?>
                <div class="resource-desc">
                  <?= $desc ?>
                </div>
                
                <div class="view hover-show"><?=$row{'num_views'}?> views</div>

                <div class="submission hover-show">
                  Submitted by
                  <a href="<?=$row{'profile_url'}?>">
                    <img class="submitter" src="<?=$row{'image_url'}?>">
                  </a>
                  on <?= date('M d Y', strtotime($row{'approved_date'})) ?>
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
          <ul id="page-control-bottom" class="pagination pagination-sm"></ul>      
      
        </div> <!-- id=index -->
      </div> <!-- id=main -->
    </div> <!-- class=row -->
  </div> <!-- class=container -->
  
  <?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
  
</body>
</html>

<?php ob_flush() ?>
