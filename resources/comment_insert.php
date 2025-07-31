<?php

//validating request from form
require_once('utilities.php');
session_start();
 $errorMSG='';
if (empty($_POST["msg"])) {
    $errorMSG .= "comment is required,  ";
} else {
   $msg =$_POST['msg'];
}

if (empty($_POST["post_id"])) {
    $errorMSG .= "accessory one is required,  ";
} else {
   $post_id =$_POST['post_id'];
}

if (empty($_POST["parent"])) {
    $parent =0;
} else {
   $parent =$_POST['parent'];
}

if (empty($_POST["token_id"])) {
 $errorMSG .= "accessory three is required,  ";
   }
    else{
        $token=$_POST['token_id'];
    }
//echo $condition.", ".$message.", ".$video.", ".$holder;

  $jsonData = comments::comment_insert($msg,$post_id,$parent,$token);
  die($jsonData);
?>