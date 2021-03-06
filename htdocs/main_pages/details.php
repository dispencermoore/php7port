<?php if(!isset($_SESSION)){session_start();}  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" 
  href="https://images.squarespace-cdn.com/content/v1/53cede1ae4b0de9f6e919b11/1410360829591-Z3M3PPXSBIHN1110ZIAL/ke17ZwdGBToddI8pDm48kMpagLdZPgiW6yD5i4KsS9VZw-zPPgdn4jUwVcJE1ZvWhcwhEtWJXoshNdA9f1qD7UnCxNA8dHvmd7460Z7fbKFSZnIIAPuX1C4iUTyn4Xd4-76gsgk4xgxAaWTBSRHt9w/favicon.ico" /> 

  <?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); ?>
  
  <link rel="stylesheet" href="/assets/css/comments.css" type="text/css">
  <script src="/assets/js/comments.js"></script>

  <link rel="stylesheet" href="/assets/css/details.css" type="text/css">
  <script src="/assets/js/details.js"></script>

  <script>
    $(function () {
      if( window.location.href.indexOf('#comments') > -1 ) {
        $('a[href="#comments"]').tab('show');
        $('#comment-area').focus();
      }
    });
  </script>
<?php

include($_SERVER['DOCUMENT_ROOT'].'/_secret/mysql_pass.php');
$pMysqli = new mysqli($hostname, $username, $password, $database);
  incrementViewCount($id,$pMysqli);

  $catTitle = getTopicName($cat, $pMysqli);

    
  $r=mysqli_query($pMysqli, getResourceSQL($id));

  $resourceRs = mysqli_fetch_assoc($r);

  $catStmt="
  SELECT c.id, c.name FROM resource_category rc
  LEFT JOIN category c ON rc.category_id = c.id
  WHERE rc.resource_id = ".$resourceRs{'id'};

  $catRs = mysqli_query($pMysqli, $catStmt);

  $catPath = '';
  while($catRow = mysqli_fetch_array($catRs)) {
    if( !empty($catPath) ) { $catPath .= " | "; }
    $catPath .= '<a href="/?cat='.$catRow{'id'}.'">'.$catRow{'name'}.'</a>';
  }

  $likedClass = '';
  if( isLoggedIn() ) {
    $user_id = $_SESSION["user"]->id;

    $likedRs = mysqli_query($pMysqli, "
      SELECT COUNT(*) as cnt FROM resource_like
      WHERE resource_id=".$resourceRs{'id'}."
      AND user_id=$user_id
      ");
    $likedRow = mysqli_fetch_array($likedRs);
    if( $likedRow{'cnt'} > 0 ) {
      $likedClass='liked';
    }
  }
?>
   
  <title><?=$resourceRs{'name'}?></title>
</head>
  
<body>

  <?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/nav.php'); ?>


  
  <div class="container">
    
    <div id="detail-brief">

    <div class="row">
      <div class="col-xs-12">
        <!-- ############## Header ############### -->
        <h2 id="detail-title"><?=$resourceRs{'name'}?></h2>

        <!-- ############## Admin Functions ############### -->
        <?php if( isAdmin() ) { ?>
        <input type="hidden" name="id" value="<?= $resourceRs{'id'} ?>" />
        <div class="editBtn-group">
          <span class="editBtn">
            <a class="admin-href" href="#"
               href="/edit_resource.php?id=<?=$resourceRs{'id'}?>">Edit</a>
          <span class="editBtn">
            <a id="deleteBtn"
               class="admin-href" href="#"
               onclick="return deleteResource('<?=$resourceRs{'id'}?>')">Delete</a>
            <span id="deleteSuccess">Deleted</span>
          </span>
          <?php if( empty($resourceRs{'approved_date'}) ) { ?>
          <span class="editBtn">
            <a id="approveBtn"
               class="admin-href" href="#"
               onclick="return approveResource('<?=$resourceRs{'id'}?>')">Approve</a>
            <span id="approveSuccess">Approved</span>
          </span>
          <?php } ?>
        </div>
        <?php } ?>
      </div>
    </div>

    <div class="row ">
      <div class="col-xs-12">

        <!-- ############## Submitter ############### -->
        <span class="detail-submission">
          Submitted by
          <a href="<?=$resourceRs{'profile_url'}?>">
            <img class="submitter" src="<?=$resourceRs{'image_url'}?>">
          </a>
          on <?= date('M d Y', strtotime($resourceRs{'approved_date'})) ?>
        </span>

        <!-- ############## Links and Meta ############### -->
        <?php
          $mailto = 'admin@airesources.org';
          $subject = 'Post-' . $resourceRs{'id'} . ' Flagged';
          $who = "";
          if( isLoggedIn() ) {
            $who = $_SESSION["user"]->name . ' (' . $_SESSION["user"]->id . ') has';
          } else {
            $who = "I have";
          }
            $body = "$who the following comment about this post: ";
            $mail_link = 'mailto:'.$mailto.'?subject='.$subject.'&body='.$body;
        ?>

        <span class="glyphicon glyphicon-thumbs-up action-link like <?=$likedClass?>" aria-hidden="true" data-resource-id="<?=$resourceRs{'id'}?>"> <?=$resourceRs{'num_likes'}?></span>

        <a href="https://twitter.com/share"  onclick = "PasslikeCNT()" class="twitter-share-button" data-via="OpenAIResources">Tweet</a>
    }
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        
        <a id="flag-resource" href="<?=$mail_link?>">
          <span class="glyphicon glyphicon-flag" aria-hidden="true"></span>
          Suggest Revision
        </a>

      </div>
    </div>



    <!-- ############## Author/ Owner ############### -->
    <!-- ############## Project & Paper Links ############### -->
<?php
    $MAX_LINK_LEN = 40;
    $author = '';
    if( !empty($resourceRs{'author'}) )
        $author = " ".$resourceRs{'author'};
    $owner = '';
    if( !empty($resourceRs{'owner'}) )
        $owner = "".$resourceRs{'owner'};

    if( !empty($resourceRs{'link'}) ) {
      $proj_url = $resourceRs{'link'};
      if( strlen($proj_url) > $MAX_LINK_LEN )  {
        $proj_url = substr($proj_url, 0, $MAX_LINK_LEN).'...';
      }
    }

    if( !empty($resourceRs{'paper_url'}) ) {
      $paper_url = $resourceRs{'paper_url'};
      if( strlen($paper_url) > $MAX_LINK_LEN )  {
        $paper_url = substr($paper_url, 0, $MAX_LINK_LEN).'...';
      }
    }
?>

    <div class="row">
      <div class="col-xs-6">
        <span class="author"><b>By:</b> <?= $resourceRs{'author'} ?></span>
      </div>

      <div class="col-xs-6">
        <b>Project:</b>
        <a class="link" href="<?=$resourceRs{'link'}?>" target='_blank'>
          <?= $proj_url ?>
        </a>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-6">
        <span class="owner"><b>From:</b> <?= $resourceRs{'owner'} ?></span>
      </div>
      <div class="col-xs-6">
        <b>Paper:</b>
        <a class="link" href="<?=$resourceRs{'paper_url'}?>" target='_blank'>
          <?= $paper_url ?>
        </a>
      </div>
    </div>



  </div>
    

    
    
    <!-- ############## Tab Area ############### -->
    <div id="detail-tabpanel" class="row">
      <div class="col-xs-12">
        
        <div role="tabpanel">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
              <a href="#summary" aria-controls="summary" role="tab" data-toggle="tab">Summary</a>
            </li>
            <li role="presentation">
              <a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">Comments (<span id="comment-count"><?=$resourceRs{'num_comments'}?></span>)</a>
            </li>
          </ul>
        </div>

        <div class="tab-content">

          <!-- ############## Summary ############### -->
          <div role="tabpanel" class="tab-pane active" id="summary">

            <!-- ############## Resource Types / License ############### -->
<?php
            $types = explode(",", $resourceRs{'resource_type'});
            $typeHtml = '';
            foreach($types as $type) {
              $type = trim($type);
              $typeColor = stringToColorCode($type);
              $typeHtml .= "<span class='label' style='background-color: $typeColor'>
                              $type
                            </span>";
            }
?>
            <div class="row">
              <div class="col-xs-2 detail-field">Resource Type:</div>
              <div class="col-xs-4">
                <span class="resource-type"><?= $typeHtml ?></span>
              </div>
              <div class="col-xs-2 detail-field">License:</div>
              <div class="col-xs-4">
                <?= $resourceRs{'license_type'} ?>
              </div>
            </div>

            <!-- ############## Programming Language  / Data Format ############### -->
            <div class="row">
              <div class="col-xs-2 detail-field">Language:</div>
              <div class="col-xs-4">
                <?= $resourceRs{'programming_lang'} ?>
              </div>
              <div class="col-xs-2 detail-field">Data Format:</div>
              <div class="col-xs-4">
                <?= $resourceRs{'data_format'} ?>
              </div>
            </div>

            <!-- ############## Description ############### -->
            <div class="row">
              <div class="col-xs-12 detail-field">
                <h4>Description</h4>
              </div>
            </div>
            <div id="detail-desc" class="row">
              <div class="col-xs-12">
                <?= strip_tags($resourceRs{'description'}) ?>
              </div>
            </div>

            <!-- ############## Topic ############### -->
            <div class="row">
              <div class="col-xs-12 detail-field">
                Categorized in: <?=$catPath?>
              </div>
            </div>

          </div> <!-- tabpanel=summary -->

          <!-- ############## Comments ############### -->
          <div role="tabpanel" class="tab-pane" id="comments">

            <!-- comment form -->
            <div class="new-com-cnt">
              <label id="comment-label" style="color: grey">Sign in to Comment</label>
              <textarea id="comment-area" class="the-new-com"></textarea>
              <div data-resource-id="<?=$resourceRs{'id'}?>" class="bt-add-com">Post comment</div>
              <div class="bt-cancel-com">Cancel</div>
            </div>
            <div class="clear"></div>

            <!-- previous comments -->
<?php 
include($_SERVER['DOCUMENT_ROOT'].'/_secret/mysql_pass.php');
 $pMysqli = new mysqli($hostname, $username, $password, $database);
            $sql = mysqli_query($pMysqli, "SELECT * FROM comments c
                                LEFT JOIN user u ON c.userid=u.id
                                WHERE resource_id = ".$resourceRs{'id'}
                              ." ORDER BY c.date DESC")
                    or die(mysqli_error());;
            while($affcom = mysqli_fetch_assoc($sql)){
              $commenter_name = $affcom['c_name'];
              if (is_null($commenter_name)){
                $commenter_name = $affcom['name'];
              }
              $commenter_img = $affcom['c_image_url'];
              if (is_null($commenter_img)){
                $commenter_img = $affcom['image_url'];
              }
              $commenter_profile = $affcom['profile_url'];
              $comment = $affcom['comment'];
              $date = $affcom['date'];
?>
              <div class="cmt-cnt">
                <?php if( !empty($commenter_profile) ) { ?><a href="<?php echo $commenter_name ?>"><?php } ?>
                  <img src="<?php echo $commenter_img ?>" />
                <?php if( !empty($commenter_profile) ) { ?></a><?php } ?>
                <div class="thecom">
                  <h5>
                    <?php if( !empty($commenter_profile) ) { ?><a href="<?php echo $commenter_name ?>"><?php } ?>
                      <?= $commenter_name; ?>
                    <?php if( !empty($commenter_profile) ) { ?></a><?php } ?>
                  </h5>
                  <span data-utime="1371248446" class="com-dt"><?php echo $date; ?></span>
                  <br/>
                  <p>
                    <?php echo $comment; ?>
                  </p>
                </div>
              </div><!-- end "cmt-cnt" -->
<?php 
            } // end while
?>
            </div> <!-- class=comments -->
            <!-- ######### end comments ############# -->
        </div> <!-- tabpanel contents -->
      </div> <!-- tab panel -->
    </div>
  </div> <!-- class=container -->

  <?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>


</body>
</html>

<?php ob_flush() ?>
