    <nav id="nav" class="navbar navbar-inverse navbar-default navbar-fixed-top" role="navigation">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <a class="navbar-brand" href="/"><img src='/assets/img/airesources-logo.png'/></a>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="nav navbar-nav">
          <!-- <li><a href="submit.php">Add Resource</a></li> -->
          <li><a href="add-resource.php">Add Resource</a></li>
          <?php if(isAdmin()) { ?><li><a href="pending.php">Pending</a></li><?php } ?>
          <li><a href="about.php">About</a></li>
          <li><a href="faq.php">FAQ</a></li>
<!--           <li class="dropdown">
            <?php if( !isLoggedIn() ) { ?>
              <a href="#" class="hide-after-auth dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <span>Sign In</span>
                <span class="caret"></span>
              </a>
              <?php } else { ?>
              <a href="#" class="show-after-auth dropdown-toggle headerProfile" data-toggle="dropdown" role="button" aria-expanded="false">
                <img class="profileImg" src="<?= $_SESSION['user']->image ?>">
                <span class="profileName"><?= $_SESSION['user']->name ?></span>
                <span class="caret"></span>
              </a>
              <?php } ?>

            <ul class="inverse-dropdown dropdown-menu" role="menu">
              <?php if( !isLoggedIn() ) { ?>
                <li class="hide-after-auth">
                  <a href="/auth/twitter">
                    <img id="twitterLoginBtn" src="/assets/img-3rd/sign-in-twitter.png">
                  </a>
                </li>
                <li class="hide-after-auth">
                  <a href="/auth/facebook">
                    <img id="facebookLoginBtn" src="/assets/img-3rd/sign-in-facebook.png">
                  </a>
                </li>
              <?php } else { ?>
                <li class="show-after-auth">
                  <a href="/services/logout.php">
                    Log Off
                  </a>
                </li>
              <?php } ?>
              </ul>              
          </li>   -->        
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li>
            <?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/new-item-updates.php'); ?>
          </li>
        </ul>

      </div>
    </nav>
    <div class="header-spacer"></div>
