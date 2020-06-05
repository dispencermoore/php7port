<?php
if(!isset($_SESSION)){session_start();} 
include ($_SERVER['DOCUMENT_ROOT'].'/includes/utils.php');
//if( isLoggedIn()
//) {   

$pMysqli = new mysqli($hostname, $username, $password, $database);
$_name;
  extract($_POST);
  if($_POST['act'] == 'add-com'){
    $comment = htmlentities($comment);
    $resource_id = htmlentities($resource_id);
    $_SESSION["user"]->comCNT = $_SESSION["user"]->comCNT - 1;
    $user_id = $_SESSION["user"]->id;
    $PcomCNT = $_SESSION["user"]->comCNT; 
    ?>
<script type="text/JavaScript">  
    alert("it got called");
     ScomCount = "<?php echo $PcomCNT; ?>";
</script>
<?php 
}

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
?>