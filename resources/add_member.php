<?php
  require_once( "utilities.php" );
//if($_GET[ 'last_id' ]==''){
//   $last_id=0; 
//}
  $jsonData = community::add_member();
  die($jsonData);
?>