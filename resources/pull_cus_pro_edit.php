<?php
  require_once( "utilities.php" );
//if($_GET[ 'last_id' ]==''){
//   $last_id=0; 
//}
  $tab = $_GET[ 'tab' ];
$test= new dynamic_puller;
$jsonData=$test->get_cus_cred($tab);
print $jsonData;
?>