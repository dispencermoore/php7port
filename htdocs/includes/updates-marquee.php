<link rel="stylesheet" type="text/css" media="all" href="/assets/css/jquery.tickerNews.css">
<script src="/assets/js/jquery.tickerNews.min.js"></script>

<div class="footer-spacer"></div>

<div id="marquee" >
  <div class="TickerNews theme2" id="updates-marquee">
    <div class="ti_wrapper">
      <div class="ti_slide">
        <div class="ti_content category-updates">
<?php
  $showMarquee = !isset($_GET['q'])
              && (!isset($_GET['cat']) || $_GET['cat'] == 0)
              && (!isset($_GET['p']) || $_GET['p'] == 1)
              ;
  if( $showMarquee ) {
    $updatePeriodInMonths = 1;
    $r=mysql_query(getCategoryUpdatesSQL($updatePeriodInMonths));
    $updates = [];
    $even = false;
    while( $row = mysql_fetch_array($r) ) {
      $even = !$even;
      $evenoddRow = ($even) ? 'even-row' : 'odd-row';
?>
          <div class="ti_news <?=$evenoddRow?>">
            <a href="/?cat=<?=$row{'id'}?>">
              <img src="<?=$row{'image'}?>" class="topic-image">
              <span class="marquee-topic"><?=$row{'name'}?></span>
<!--              <br>-->
              <span class="scroll-text">has </span>
              <span class="new-item-count"><?=$row{'numNew'}?></span>
              <span class="scroll-text">new item<?=(($row{'numNew'}>1)?'s':'')?></span>
            </a>
          </div>
          
<?php
    }
  }
?>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  $(function(){

    // setup marquee
    if( $('.ti_news').length > 0 ) {
//      console.log('items');
      $('#marquee').css('display','inline');
      var updatesMarquee = '#updates-marquee';
      var tickerOpts = {
        base: {
          width : 10,
          time: 200
        }
      };
      $(updatesMarquee).newsTicker(tickerOpts);
    }
//    $(updatesMarquee).hover(
//        function(handlerIn) {$(updatesMarquee).stopTicker();}
//      , function(handlerOut) {$(updatesMarquee).newsTicker(tickerOpts);}
//    );
    
  });
</script>
