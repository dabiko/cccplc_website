<?php
//validating request from a form
require_once('pull_cards.php');



$errorMSG='';
if (empty($_GET["parent_id"])) {
    $parent=0;
} else {
   $parent =$_GET['parent_id'];
}

//if (empty($_POST["child_id"])) {
//   $child=0;
//} else {
//   $child =$_POST['child_id'];
//}
//
//if (empty($_POST["post_id"])) {
//   $post=0;
//} else {
//   $post =$_POST['post_id'];
    
//}
$query= new register_now;
  $jsonData = $query->user_spec($parent);
  
 echo $jsonData;

?>