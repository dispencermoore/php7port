<?php
header( 'Location: /' ) ;
if(!isset($_SESSION)){session_start();} 
$pMysqli = new mysqli($hostname, $username, $password, $database);

//if( isLoggedIn()
//) {   
$F_name= $_REQUEST['first-name-area'];
$L_name = $_REQUEST['last-name-area'];
$_SESSION["user"]->name = $F_name." ".$L_name; 

 if (!isset($_SESSION["user"]->id)) { 
$_SESSION["user"]->id = rand();
  }
if (!isset($_SESSION["user"]->image)) { 
$_SESSION['user']->image ="/assets/img-3rd/unknownuser.png";
}
if (!isset($_SESSION["user"]->comCNT)) { 
$_SESSION['user']->comCNT =5;
}
if (!isset($_SESSION["user"]->privilege)) { 
$_SESSION['user']->privilege = "user";
}

/*
    //insert the comment in the database
    mysqli_query($pMysqli, "INSERT INTO comments (comment, resource_id, userid)
       VALUES('$comment', '$resource_id','$user_id')");
       //if(!mysqli_errno($_SESSION["connection"])){
      mysqli_query($pMysqli, 
        "UPDATE resource SET"
        ." num_comments = num_comments + 1"
        ." WHERE id=$resource_id");
  ?>
<script type="text/JavaScript">  
    var PcomCount = "<?php echo $PcomCount; ?>"; 
    //alert(PcomCount);
     </script> ;

    <div class="cmt-cnt">
      <img src="<?= $_SESSION["user"]->image ?>"/>
      <div class="thecom">
        <h5><?= $_SESSION["user"]->name ?></h5>
        <span class="com-dt"><?= date('d-m-Y H:i') ?></span>
        <br/>
        <p><?= $comment ?></p>
      </div>
    </div><!-- end "cmt-cnt" -->

<?php
 //  }
 // endif;
//} else {
//  echo "You must be logged in";
//  header('HTTP/1.1 401 You must be signed in to comment');
//}
*/
?>