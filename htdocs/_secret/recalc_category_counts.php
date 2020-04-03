<?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/utils.php'); ?>

<?php

  $resource_ids = recalcTopicApprovedCount(0);
  $resource_ids = recalcTopicPendingCount(0);

function recalcTopicApprovedCount($topic_id) {
  // get current resource_ids here
  $resource_ids = array();
  $r=mysql_query("
      SELECT resource_id FROM resource r
      LEFT JOIN resource_category rc ON r.id = rc.resource_id
      WHERE category_id=$topic_id
      AND r.approved_date IS NOT NULL
      ");
  while( $row = mysql_fetch_array($r) ) {
    // key must be a string otherwise array_merge() doesn't
    // correctly combine them later
    $resource_ids['r'.$row{'resource_id'}] = true;
  }
  
  $r=mysql_query("
      SELECT id FROM category
      WHERE parent = $topic_id
      ");
  while( $row = mysql_fetch_array($r) ) {
    $sub_resource_ids = recalcTopicApprovedCount($row{'id'});
    $resource_ids = array_merge($sub_resource_ids, $resource_ids);
  }
  
  // update current topic count
  $count = count($resource_ids);
  mysql_query("
      UPDATE category
         SET approved_count = $count
       WHERE id = $topic_id
      ");
  
  return $resource_ids;
}

function recalcTopicPendingCount($topic_id) {
  // get current resource_ids here
  $resource_ids = array();
  $r=mysql_query("
      SELECT resource_id FROM resource r
      LEFT JOIN resource_category rc ON r.id = rc.resource_id
      WHERE category_id=$topic_id
      AND r.approved_date IS NULL
      ");
  while( $row = mysql_fetch_array($r) ) {
    // key must be a string otherwise array_merge() doesn't
    // correctly combine them later
    $resource_ids['r'.$row{'resource_id'}] = true;
  }
  
  $r=mysql_query("
      SELECT id FROM category
      WHERE parent = $topic_id
      ");
  while( $row = mysql_fetch_array($r) ) {
    $sub_resource_ids = recalcTopicPendingCount($row{'id'});
    $resource_ids = array_merge($sub_resource_ids, $resource_ids);
  }
  
  // update current topic count
  $count = count($resource_ids);
  mysql_query("
      UPDATE category
         SET pending_count = $count
       WHERE id = $topic_id
      ");
  
  return $resource_ids;
}

function printArrayKeys($array) {
  foreach($array as $rid => $value) {
    echo $rid . ',';
  }
  
}
?>