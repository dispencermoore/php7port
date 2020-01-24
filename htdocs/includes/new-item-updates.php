<ul class="new-item-container">

<?php
    $updatePeriodInMonths = 1;
    $r=mysql_query(getCategoryUpdatesSQL($updatePeriodInMonths));
    $updates = [];
    $even = false;
    while( $row = mysql_fetch_array($r) ) {
      $even = !$even;
      $evenoddRow = ($even) ? 'even-row' : 'odd-row';
?>
  <!--
  <li>
    <div class="new-item-title">Entity & Fact Extraction</div>
    <div class="new-item-count">1 new item</div>
  </li>
   <li>
    <div class="new-item-title">Artificial Intelligence</div>
    <div class="new-item-count">2 new items</div>
  </li>
  <li>
    <div class="new-item-title">Clustering</div>
    <div class="new-item-count">1 new item</div>
  </li>
  -->
  <li>
    <a href="/?cat=<?=$row{'id'}?>">

      <div class="new-item-title"><?=$row{'name'}?></div>
      <div class="new-item-count">
        <span class="new-item-count"><?=$row{'numNew'}?></span>
        <span class="scroll-text">new item<?=(($row{'numNew'}>1)?'s':'')?></span>
      </div>
    </a>
  </li>
          
<?php
    }
?>    

</ul>

<script>
  $(document).ready(function() {
    var numItems = $('ul.new-item-container li').length;
    (function alternate(last, next) {
      $('ul.new-item-container li:nth-child('+(last+1)+')')
        .fadeOut(function() {
          $('ul.new-item-container li:nth-child('+(next+1)+')')
            .fadeIn();
        });
      
      setTimeout(function() {
        alternate(next, (next+1)%numItems);
      }, 5000);
    })(0,0);
  })

</script>
      
<style>

  ul.new-item-container {
    list-style: none;
    margin-right: 30px;
    margin-top: 5px;
  }

  ul.new-item-container li {
    display: none;
  }

  ul.new-item-container > li > a {
    color: white;
  }

  .new-item-count {
    font-weight: 100;
  }

</style>