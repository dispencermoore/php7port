<div class="dropdown input-group-addon">


<span id="topic-browser-btn" 
      data-container="body" data-toggle="dropdown"
      data-placement="bottom" >
    <span class="glyphicon glyphicon-triangle-bottom"
          aria-hidden="true">
      <span class="topic-name-text">
        <?= $catTitle ?>
      </span>
    </span>
</span>



<?php
  if( !isset($countOf) ) { $countOf = 'approved_count'; }
  if( !isset($catHref) ) { $catHref = '/'; }


  $sqlQuery = "SELECT * from category where parent=0";
  if (!isAdmin()) {
      $sqlQuery.= " AND id > 0";
  }
  $sqlQuery.= " ORDER BY id";
  $r = mysql_query($sqlQuery);

  $topicHtml = "";
  while ($catrow = mysql_fetch_array($r)) {
    $subtopicHtml = writeTopicEntry($catHref, $catrow, $countOf, $cat, 0);
    $topicHtml .= $subtopicHtml;
  }

?>

          <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
            <li><a tabindex="-1" href="<?=$catHref?>">Artificial Intelligence</a></li>
<!-- 
            <li><a tabindex="-1" href="#">Regular link</a></li>
            <li class="dropdown-submenu">
              <a tabindex="-1" href="#">More options</a>
              <ul class="dropdown-menu">
                <li><a tabindex="-1" href="#">Art</a></li>
                <li><a tabindex="-1" href="#">Bottles</a></li>
              </ul>
            </li>
 -->            
            <?= $topicHtml ?>
          </ul>


</div>