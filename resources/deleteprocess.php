<?php
//validating request from form
require_once('utilities.php');



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

$reginstance = new register;
  $jsonData = $reginstance->user_delete($parent,"users","user_id");
  print $jsonData;
?>