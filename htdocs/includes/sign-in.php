<?php
header( 'Location: /' ) ;
if(!isset($_SESSION)){session_start();} 
include($_SERVER['DOCUMENT_ROOT'].'/_secret/mysql_pass.php');
$pMysqli = new mysqli($hostname, $username, $password, $database);

//if( isLoggedIn()
//) {   
$F_name= $_REQUEST['first-name-area'];
$L_name = $_REQUEST['last-name-area'];
$_SESSION["user"]->name = $F_name." ".$L_name; 

 if (!isset($_SESSION["user"]->id)) { 
$_SESSION["user"]->id = rand();
  }
/*
if (!isset($_SESSION["user"]->image)) { 
    $userimg = rand(1,19);
    if ($userimg == 1 or $userimg == 2){
        $_SESSION['user']->image ="/assets/img-3rd/dog.png";
      }
    if ($userimg == 3 or $userimg == 4){
        $_SESSION['user']->image ="/assets/img-3rd/lion.png";
      }
    if ($userimg == 5 or $userimg == 6){ 
       $_SESSION['user']->image ="/assets/img-3rd/turtle.png";
      }
    if ($userimg == 7 or $userimg == 8){
        $_SESSION['user']->image ="/assets/img-3rd/jaguar.png";
      }
      if ($userimg == 9 or $userimg == 10){
        $_SESSION['user']->image ="/assets/img-3rd/bird.png";
      }
    if ($userimg == 11 or $userimg == 12){
        $_SESSION['user']->image ="/assets/img-3rd/horse.png";
      }
    if ($userimg == 13 or $userimg == 14){ 
       $_SESSION['user']->image ="/assets/img-3rd/fish.png";
      }
    if ($userimg == 15 or $userimg == 16){
        $_SESSION['user']->image ="/assets/img-3rd/cow.png";
      }
      if ($userimg == 17 or $userimg == 8){ 
       $_SESSION['user']->image ="/assets/img-3rd/blowfish.png";
      }
    if ($userimg == 19){
        $_SESSION['user']->image ="/assets/img-3rd/ghost.png";
      }
}
*/


if (!isset($_SESSION["user"]->comCNT)) { 
$_SESSION['user']->comCNT =5;
}
if (!isset($_SESSION["user"]->privilege)) { 
$_SESSION['user']->privilege = "user";
}
if (!isset($_SESSION["user"]->likeCNT)) { 
$_SESSION['user']->likeCNT = 0;
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