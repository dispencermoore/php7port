<?php 
if(!isset($_SESSION)){session_start();}
isLoggedIn();

?>   
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
          <li><a href="/main_pages/about.php">About</a></li>
          <li><a href="/main_pages/faq.php">FAQ</a></li>
          <li class="dropdown">
            <?php if( !isLoggedIn() ) { ?>
              <a href="#" class="hide-after-auth dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <span>Sign In</span>
                <span class="caret"></span>
              </a>
              <?php } else { ?>
              <a href="#" class="show-after-auth dropdown-toggle headerProfile" data-toggle="dropdown" role="button" aria-expanded="false">
                <span class="profileName" style="text-align: center; line-height: 49px;"><?= $_SESSION['user']->name ?></span>
                <span class="caret"></span>
              </a>
              <?php } ?>

            <ul class="inverse-dropdown dropdown-menu" role="menu" >
              <?php if( !isLoggedIn() ) { ?>
                <li class="hide-after-auth">
                 <form id="username" action="/includes/sign-in.php" method="post" >
             <label for= "first-name-area" style= "margin: 5px 10px" >First Name:</label>
             <input type="text" id="name-area" name="first-name-area" style= "margin: 5px 10px" ></input>
             <label for= "last-name-area" style= "margin: 5px 10px" >Last Name:</label>
             <input type="text" id="name-area" name="last-name-area" style= "margin: 5px 10px" ></input>
             <input  type ="submit" style = "font-weight: bold; width : 100%; background-color: #00b6ff; border: none"></input> 
           </form>
                </li>
              <?php } else { ?>
                <li class="show-after-auth">
                   <a id = "signoff_time" >
                     You will be signed out 24 hours after signing in                   
                   </a>
                </li>
              <?php } ?>
              </ul>              
          </li>     
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li>
            <?php include ($_SERVER['DOCUMENT_ROOT'].'/includes/new-item-updates.php'); ?>
          </li>
        </ul>

      </div>
    </nav>
    <div style= "height: 30px"></div>
