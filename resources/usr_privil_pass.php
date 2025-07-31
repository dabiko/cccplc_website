<?php
//validating request from a form
require_once('utilities.php');



$errorMSG='';
if (empty($_POST["pid"])) {
   $errorMSG .= "Report system has been manipulated with ,X01  ";
} else {
   $pid =$_POST['pid'];
}

if (empty($_POST["uid"])) {
    $errorMSG .= "Report system has been manipulated with , X02 ";
} else {
   $uid =$_POST['uid'];
}
//
//if (empty($_POST["post_id"])) {
//   $post=0;
//} else {
//   $post =$_POST['post_id'];
    
//}

//echo $condition.", ".$message.", ".$video.", ".$holder;
if( $errorMSG ==''){
//fill the require fields
    

$reginstance =new priv_manager;
  $jsonData = $reginstance->_usr_prog($pid,$uid);
  print $jsonData;
}
else{
    die('uiderrorx28044445555555544 msg:'.$errorMSG);
}

?>