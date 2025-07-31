<?php
  require_once( "utilities.php" );
//if($_GET[ 'last_id' ]==''){
//   $last_id=0; 
//}
  $tab = $_GET[ 'tab' ];
  $id = $_GET[ 'id' ];
$test= new dynamic_puller;
$jsonData=$test->get_tab($tab,$id);
print $jsonData;
?>