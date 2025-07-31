<?php
  require_once( "utilities.php" );
//if($_GET[ 'last_id' ]==''){
//   $last_id=0; 
//}
  $post_id = (int)$_GET['post_id'];
  $limi = (int)$_GET['limi'];
  $jsonData = postal::gethomecomments($post_id,$limi);
  print $jsonData;
?>