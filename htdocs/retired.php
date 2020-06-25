<?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
 <link rel="icon" 
  href="https://images.squarespace-cdn.com/content/v1/53cede1ae4b0de9f6e919b11/1410360829591-Z3M3PPXSBIHN1110ZIAL/ke17ZwdGBToddI8pDm48kMpagLdZPgiW6yD5i4KsS9VZw-zPPgdn4jUwVcJE1ZvWhcwhEtWJXoshNdA9f1qD7UnCxNA8dHvmd7460Z7fbKFSZnIIAPuX1C4iUTyn4Xd4-76gsgk4xgxAaWTBSRHt9w/favicon.ico" /> 


  <style>
    body {
/*
      background-image: url('http://www.adweek.com/files/imagecache/node-blog/blogs/istock-unfinished-business-hed-2015.jpg');
      background-repeat: no-repeat;
      background-size: contain;
*/
    }

    .section-odd {
      background-color: white;
    }

    .section-even {
      background-color: rgba(0, 0, 0, 0.28);
    }
    
    #about-content .row {
      margin-left: 0;
      margin-right: 0;
    }
  </style>
  <title>About</title>
</head>
  
<body>

  <?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/nav.php'); ?>

  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <p>We appreciate the work of all our previous staff who volunteered to build and maintain our site.</p>
        <h4>Retired Managing Editors</h4>
        <ul>
          <li>Isaac Cowhey</li>
        </ul>
        <h4>Retired Editors</h4>
        <ul>
          <li>Jonathan May</li>
          <li>Bianca Pereira</li>
        </ul>
      </div>
    </div>
  </div>
  
  <?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>

</body>
</html>

<?php ob_flush() ?>
