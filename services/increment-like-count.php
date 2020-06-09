<?php
header( 'Location: /' ) ;
if(!isset($_SESSION)){session_start();} 
include($_SERVER['DOCUMENT_ROOT'].'/_secret/mysql_pass.php');
$pMysqli = new mysqli($hostname, $username, $password, $database);
//include ($_SERVER['DOCUMENT_ROOT'].'/services/login-required.php');
$resource_id = $_REQUEST['resource_id'];
if (!isset($_SESSION["likedResourcesArray"])) {
 $_SESSION["likedResourcesArray"] = array();
 //array_push($_SESSION["likedResourcesArray"], 5);
 //array_push($_SESSION["likedResourcesArray"], 7);
 //$array = array(5, 6, 7, 8);
}


$alreadyLiked = false;

 foreach($_SESSION["likedResourcesArray"] as $value) {
  if ($value == $resource_id) {
   $alreadyLiked = true;
  }
 }

 if ($_SESSION["user"]->likeCNT >= 15) { 
    $maxLiked = true;
  }
    else{
      $maxLiked = false;
    }
 
 if(!($alreadyLiked) and !($maxLiked)) {
  array_push($_SESSION["likedResourcesArray"], $resource_id);
      $updateSql =
      "UPDATE resource SET"
      ." num_likes = num_likes + 1"
      ." WHERE id=$resource_id";

    mysqli_query($pMysqli, $updateSql);
    $_SESSION["user"]->likeCNT++;
    header('HTTP/1.1 200 OK');
}else{
    header('HTTP/1.1 304 Not Modified');
}

?>
<script>
  say_com = "<?php echo $resource_id?>";
alert(say_com);
var initialArrayVal = "<?php 
$echoStatement = "";
foreach($_SESSION["likedResourcesArray"] as $value) {
 $echoStatement = "".$echoStatement.", ".$value;
}
echo $echoStatement;

?>";
alert(initialArrayVal);
</script>