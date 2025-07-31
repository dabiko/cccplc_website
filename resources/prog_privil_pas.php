<?php
//validating request from form
require_once('utilities.php');



$errorMSG='';
if (empty($_GET["parent"])) {
    $parent=0;
} else {
   $parent =$_GET['parent'];
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
$reginstance =new priv_manager;
  $jsonData = $reginstance->_dept_prog($parent);
  print $jsonData;
?>