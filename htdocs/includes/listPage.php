<?php
/************************************************
 * This page provides utilities specific to the
 * list pages (e.g. index.php, pending.php).
 * 
 * It also maintains certain state for the list
 * pages. For example, it tracks the last list
 * page visited, the category, page number, and
 * query state of that page.
 ************************************************/
 
 
 
 
 
 ?>
 


<script>
  function trackListPage() {
    var listPage = window.location.pathname;
    var topic = getParameterByName('cat');
    var page = getParameterByName('p');
    var query = getParameterByName('q');

//    console.log(listPage+'/'+topic+'/'+page+'/'+query);
    sessionStorage.setItem('listPage',listPage);
    sessionStorage.setItem('topic',topic);
    sessionStorage.setItem('page',page);
    sessionStorage.setItem('query',query);
  }

  $(document).ready(function() {
    trackListPage();
  });
</script>
